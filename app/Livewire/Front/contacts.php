<?php

namespace App\Livewire\Front;

use App\Models\Contact;
use Livewire\Component;
use Livewire\Attributes\Title;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

#[Title('اتصل بنا')]
class Contacts extends Component
{
    public $name;
    public $phone;
    public $email;
    public $message;

    protected $rules = [
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'email' => 'required|email|max:255',
        'message' => 'required|string',
    ];
    public function updated($fields){
        $this->validateOnly($fields,[
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);
    }
    public function ValidationAttributes(){
        return [
            'name' => 'الاسم',
            'phone' => 'رقم الهاتف',
            'email' => 'البريد الالكتروني',
            'message' => 'الرسالة',
        ];
    }
    public function submit()
    {
        $this->validate();

        // Save data to the 'contacts' table
        Contact::create([
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'message' => $this->message,
        ]);
        LivewireAlert::title('تم الارسال بنجاح')->success()->show();
        $this->reset(['name', 'phone', 'email', 'message']);
    }

    public function render()
    {
        return view('livewire.front.contacts')->extends('front.layouts.master')->section('content');
    }
}
