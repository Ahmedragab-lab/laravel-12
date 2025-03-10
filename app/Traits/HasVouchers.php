<?php

namespace App\Traits;

use App\Models\Invoice;
use App\Models\Voucher;
use App\Enums\VoucherType;
use App\Models\PaymentMethod;
use App\Models\WorkshopInvoice;
use App\Models\ContractorInvoice;
use App\Observers\ClientObserver;
use Illuminate\Support\Facades\DB;
use App\Livewire\Admin\Workshop\Index;
use App\Livewire\Admin\Workshop\Workshops;
use App\Livewire\Admin\Contractors\Contractors;

trait HasVouchers
{
    public $invoice, $rest, $status, $retrieve_payment_method_id;
    public array $payments = [];

    public $retrieved_amount, $retrieved_tax, $retrieved_total;
    public $new_total, $new_tax, $new_amount, $new_discount, $retrieved_discount;

    public function calculateAll(): void
    {

        if ($this->getTotalPaid() > $this->invoice->rest) {
            $this->dispatch('alert', type: 'error', message: 'لا يمكنك دفع قيمة اكبر من المتبقي');
            $this->rest = $this->invoice->rest;

            foreach ($this->payments as $key => $payment) {
                $this->payments[$key]['amount'] = 0;
            }
            return;
        }
        $this->rest = $this->invoice->rest - $this->getTotalPaid();

    }

    public function getTotalPaid()
    {
        return collect($this->payments)->sum('amount');
    }

    public function pay(): void
    {
        if ($this->getTotalPaid() === 0) {
            $this->dispatch('alert', type: 'error', message: 'يحب تسديد الفاتورة');
            return;
        }
        if (!$this->invoice->client?->account_id) {
            (new ClientObserver())->created($this->invoice->client);
        }
        $this->invoice->update([
            'status' => $this->getTotalPaid() === $this->invoice->rest ? 'paid' : 'partially_paid',
            'paid' => $this->invoice->paid + $this->getTotalPaid(),
            'rest' => $this->invoice->rest - $this->getTotalPaid(),
        ]);
        $this->createPaymentVouchers($this->invoice);
        $this->reset('payments', 'invoice');
        $this->dispatch('alert', type: 'success', message: 'تم الدفع بنجاح');
    }

    public function getInvoiceName()
    {
        $invoice_type = get_called_class();
        if ($invoice_type === Contractors::class) {
            return 'مقاولات';
        }
        return 'ورش';
    }

    private function createPaymentVouchers($invoice): void
    {
        $payments = $this->payments;
        $invoice_name = $this->getInvoiceName();

        if (!empty($payments)) {
            foreach ($payments as $payment) {
                $payment_method = PaymentMethod::find($payment['payment_method_id']);
                if ($payment['amount'] > 0) {
                    $invoice->payments()->create($payment);
                    $payment_voucher = Voucher::create([
                        'date' => date('Y-m-d'),
                        'type' => VoucherType::PAY_INVOICE,
                        'description' => 'سداد فاتورة ' . $invoice_name . ' رقم ' . $invoice->id . ' - ' . $payment_method?->name,
                        'contractor_invoice_id' => $invoice instanceof ContractorInvoice ? $invoice->id : null,
                        'workshop_invoice_id' => $invoice instanceof WorkshopInvoice ? $invoice->id : null,
                        'invoice_id' => $invoice instanceof Invoice ? $invoice->id : null,
                    ]);

                    $payment_voucher->accounts()->createMany(
                        [
                            [
                                'account_id' => $invoice->client->account_id,
                                'credit' => 0,
                                'debit' => $payment['amount'],
                                'description' => $payment_voucher->description,
                            ],
                            [
                                'account_id' => $payment_method?->account_id,
                                'credit' => $payment['amount'],
                                'debit' => 0,
                                'description' => $payment_voucher->description,
                            ]
                        ]
                    );
                }
            }
        }
    }

    public function removeItem($key)
    {
        unset($this->items[$key]);
        $this->calculateRetrievedAmount();
    }

    public function calculateRetrievedAmount(): void
    {
        $this->new_amount = array_reduce($this->items, function ($carry, $item) {
            return $carry + $item['total_before_tax'];
        });
        $proportion = $this->new_amount / $this->invoice->total_before_tax;

        if (get_called_class() === Invoice::class) { // tax be in total of invoice not every item
            $this->new_tax = round($this->invoice->tax * $proportion, 2);
        }else{
            $this->new_tax = array_reduce($this->items, function ($carry, $item) {
                return $carry + $item['tax'];
            },0);
        }

        if ($this->invoice->discount > 0) {
            $this->new_discount = round($this->invoice->discount * $proportion, 2);
        } else {
            $this->new_discount = 0;
        }

        $this->new_total = $this->new_amount + $this->new_tax - $this->new_discount;

        $this->retrieved_amount = $this->invoice->total_before_tax - $this->new_amount;
        $this->retrieved_tax = $this->invoice->tax - $this->new_tax;
        $this->retrieved_discount = $this->invoice->discount - $this->new_discount;
        $this->retrieved_total = ($this->retrieved_amount + $this->retrieved_tax) - $this->retrieved_discount;
    }

    private function getSalesAccount()
    {
        $invoice_type = get_called_class();
        if ($invoice_type === Contractors::class) {
            return setting('contractors_revenue_account_id');
        }
        if ($invoice_type === Index::class) {
            return setting('workshops_revenue_account_id');
        }

        return setting('spare_parts_revenue_account_id');

    }

    public function retrieve()
    {
        $data = $this->validate([
            'retrieve_payment_method_id' => 'required',
            'retrieved_amount' => 'required',
            'retrieved_tax' => 'nullable',
            'retrieved_total' => 'required',
        ]);
        try {
            DB::beginTransaction();
            $invoice = $this->invoice;

            $sales_tax_account = setting('sales_tax_account_id');
            $sales_account = $this->getSalesAccount();
            $sales_discount_account = setting('sales_discount_account_id');

            $payment_method = PaymentMethod::find($data['retrieve_payment_method_id']);

            $voucher = Voucher::create([
                'contractor_invoice_id' => $invoice instanceof ContractorInvoice ? $invoice->id : null,
                'workshop_invoice_id' => $invoice instanceof WorkshopInvoice ? $invoice->id : null,
                'date' => date('Y-m-d'),
                'type' => VoucherType::RETRIEVE,
                'description' => 'استرجاع فاتورة ' . $this->getInvoiceName() . ' رقم ' . $invoice->id . ' - ' . $payment_method?->name,
            ]);
            $voucher->accounts()->create([
                'account_id' => $sales_account,
                'credit' => 0,
                'debit' => $this->retrieved_amount,
                'description' => $voucher->description,
            ]);

            if ($invoice->tax > 0) {
                $voucher->accounts()->create([
                    'account_id' => $sales_tax_account,
                    'credit' => 0,
                    'debit' => $this->retrieved_tax,
                    'description' => $voucher->description,
                ]);
            }
            if ($this->retrieved_discount > 0) {
                $voucher->accounts()->create([
                    'account_id' => $sales_discount_account,
                    'credit' => $this->retrieved_discount,
                    'debit' => 0,
                    'description' => $voucher->description,
                ]);
            }

            $voucher->accounts()->create([
                'account_id' => $invoice->client?->account_id,
                'credit' => $this->retrieved_total,
                'debit' => 0,
                'description' => $voucher->description,
            ]);

            /* Payment */

            $voucher = Voucher::create([
                'date' => date('Y-m-d'),
                'type' => VoucherType::PAY_RETRIEVE,
                'description' => 'سداد مرتجع فاتورة رقم ' . $invoice?->id . ' - ' . $payment_method?->name,
                'contractor_invoice_id' => $invoice instanceof ContractorInvoice ? $invoice->id : null,
                'workshop_invoice_id' => $invoice instanceof WorkshopInvoice ? $invoice->id : null,
            ]);

            $voucher->accounts()->createMany(
                [
                    [
                        'account_id' => $payment_method?->account_id,
                        'credit' => $this->retrieved_total,
                        'debit' => 0,
                        'description' => $voucher->description,
                    ],
                    [
                        'account_id' => $invoice->client?->account_id,
                        'credit' => 0,
                        'debit' => $this->retrieved_total,
                        'description' => $voucher->description,
                    ]
                ]

            );

            $status = $this->new_total == $invoice->rest ? 'retrieved' : 'partially_retrieved';
            $invoice->update([
                'status' => $status,
                'total_before_tax' => $this->new_amount ?? 0,
                'tax' => $this->new_tax ?? 0,
                'total' => $this->new_total ?? 0,
                'discount' => $this->new_discount ?? 0,
                'paid' => $this->new_total ?? 0,
                'retrieved' => $this->retrieved_total ?? 0
            ]);
            $invoice->items()->delete();
            $invoice->items()->createMany($this->items);

            $this->dispatch('alert', type: 'success', message: 'تم إعادة المبلغ بنجاح ');
            session()->flash('success', 'تم إعادة المبلغ بنجاح ');
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('error', type: 'error', message: 'حدث خطا ما ');
            session()->flash('error', 'حدث خطا ما '.$e->getMessage());
        }
    }


}