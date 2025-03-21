<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;


class Setting extends Component
{
    use WithFileUploads;

    public $logo_img,$icon_img;
    public $site_name,$url,$sms_status,$phone,$sms_username,$sms_sender,$sms_password,$email,$tax_enabled,
    $tax_rate,$tax_no,$address,$build_num,$unit_num,$postal_code,$delete_transfer,$extra_number,
    $capital,$activate_medicines,$active_scan_and_lab,$new_invoice_form,$complaint,$message_status,
    $status,$from_morning,$to_morning,$from_evening,$to_evening;

    protected $rules = [
        'logo_img' => ['nullable', 'image', 'max:1024'],
        'icon_img' => ['nullable', 'image', 'max:1024'],
        'site_name' => 'required|string',
        'url' => 'required',
        'sms_status' => ['boolean','nullable'],
        'phone' => 'required|numeric',
        'sms_username' => 'required|string',
        'sms_sender' => 'required|string',
        'sms_password' => 'required|string',
        'email' => 'required|email',
        'tax_enabled' => ['boolean','nullable'],
        'tax_rate' => 'required|numeric',
        'tax_no' => 'required|string',
        'address' => 'required|string',
        'build_num' => 'required|numeric',
        'unit_num' => 'required|numeric',
        'postal_code' => 'required|numeric',
        'delete_transfer' => ['boolean','nullable'],
        'extra_number' => 'required|numeric',
        'capital' => 'required|numeric',
        'activate_medicines' => ['boolean','nullable'],
        'active_scan_and_lab' => ['boolean','nullable'],
        'new_invoice_form' => ['boolean','nullable'],
        'complaint' => ['boolean','nullable'],
        'message_status' => ['string','nullable'],
        'status' => ['boolean','nullable'],
        'from_morning' => ['date_format:H:i','nullable'],
        'to_morning' => ['date_format:H:i','nullable'],
        'from_evening' => ['date_format:H:i','nullable'],
        'to_evening' => ['date_format:H:i','nullable'],
    ];

    public function updated($fields){
        $this->validateOnly($fields,[
            'logo_img' => ['nullable', 'image', 'max:1024'],
            'icon_img' => ['nullable', 'image', 'max:1024'],
            'site_name' => 'required|string',
            'url' => 'required',
            'sms_status' => ['boolean','nullable'],
            'phone' => 'required|numeric',
            'sms_username' => 'required|string',
            'sms_sender' => 'required|string',
            'sms_password' => 'required|string',
            'email' => 'required|email',
            'tax_enabled' => ['boolean','nullable'],
            'tax_rate' => 'required|numeric',
            'tax_no' => 'required|string',
            'address' => 'required|string',
            'build_num' => 'required|numeric',
            'unit_num' => 'required|numeric',
            'postal_code' => 'required|numeric',
            'delete_transfer' => ['boolean','nullable'],
            'extra_number' => 'required|numeric',
            'capital' => 'required|numeric',
            'activate_medicines' => ['boolean','nullable'],
            'active_scan_and_lab' => ['boolean','nullable'],
            'new_invoice_form' => ['boolean','nullable'],
            'complaint' => ['boolean','nullable'],
            'message_status' => ['string','nullable'],
            'status' => ['boolean','nullable'],
            'from_morning' => ['date_format:H:i','nullable'],
            'to_morning' => ['date_format:H:i','nullable'],
            'from_evening' => ['date_format:H:i','nullable'],
            'to_evening' => ['date_format:H:i','nullable'],
        ]);
    }
    public function ValidationAttributes(){
        return [
           'site_name' => __('admin.Site name'),
        'url' => __('admin.url'),
        'sms_status' => __('admin.SMS status'),
        'phone' => __('admin.phone'),
        'sms_username' => __('admin.SMS Username'),
        'sms_sender' => __('admin.SMS Sender'),
        'sms_password' => __('admin.SMS Password'),
        'email' => __('admin.email'),
        'tax_enabled' => __('admin.Tax enabled'),
        'tax_rate' => __('admin.Tax rate'),
        'tax_no' => __('admin.Tax number'),
        'address' => __('admin.address'),
        'build_num' => __('admin.Build number'),
        'unit_num' => __('admin.Unit number'),
        'postal_code' => __('admin.Postal code'),
        'delete_transfer' => __('admin.Delete transfer patients'),
        'extra_number' => __('admin.Extra number'),
        'capital' => __('admin.Capital'),
        'activate_medicines' => __('admin.Activate medicines'),
        'active_scan_and_lab' => __('admin.Active scan and lab'),
        'new_invoice_form' => __('admin.New invoice form'),
        'complaint' => __('admin.Complaint'),
        'message_status' => __('admin.Message status'),
        'status' => __('admin.Status'),
        'from_morning' => __('admin.from'),
        'to_morning' => __('admin.to'),
        'from_evening' => __('admin.from'),
        'to_evening' => __('admin.to'),
        ];
    }
    public function update(){
        $data = $this->validate();
        if($this->logo_img){
            delete_file(setting('logo_img'));
            $data['logo_img']=store_file($this->logo_img,'settings');
        }else{
            $data['logo_img']=setting('logo_img');
        }
        if($this->icon_img){
            delete_file(setting('icon_img'));
            $data['icon_img']=store_file($this->icon_img,'settings');
        }else{
            $data['icon_img']=setting('icon_img');
        }
        setting($data)->save();
        // $this->emitTo('admin.website-name','refreshComponent');
        $this->dispatch('refreshComponent');
        LivewireAlert::title('تم التعديل بنجاح')->success()->show();

    }

    public function mount(){
        $this->site_name = setting('site_name');
        $this->url = setting('url');
        $this->sms_status = setting('sms_status');
        $this->phone = setting('phone');
        $this->sms_username = setting('sms_username');
        $this->sms_sender = setting('sms_sender');
        $this->sms_password = setting('sms_password');
        $this->email = setting('email');
        $this->tax_enabled = setting('tax_enabled');
        $this->tax_rate = setting('tax_rate');
        $this->tax_no = setting('tax_no');
        $this->address = setting('address');
        $this->build_num = setting('build_num');
        $this->unit_num = setting('unit_num');
        $this->postal_code = setting('postal_code');
        $this->delete_transfer = setting('delete_transfer');
        $this->extra_number = setting('extra_number');
        $this->capital = setting('capital');
        $this->activate_medicines = setting('activate_medicines');
        $this->active_scan_and_lab = setting('active_scan_and_lab');
        $this->new_invoice_form = setting('new_invoice_form');
        $this->complaint = setting('complaint');
        $this->message_status = setting('message_status');
        $this->status = setting('status');
        $this->from_morning = setting('from_morning');
        $this->to_morning = setting('to_morning');
        $this->from_evening = setting('from_evening');
        $this->to_evening = setting('to_evening');
    }
    public function render()
    {
        return view('livewire.admin.setting');
    }
}
