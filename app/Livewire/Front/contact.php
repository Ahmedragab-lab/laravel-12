<?php

namespace App\Livewire\Front;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\Contact as ContactModel;

#[Title('contact')]
class Contact extends Component
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

    public function submit()
    {
        $this->validate();

        // Save data to the 'contacts' table
        ContactModel::create([
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'message' => $this->message,
        ]);

        // Reset form fields
        $this->reset(['name', 'phone', 'email', 'message']);

    }

    public function render()
    {
        return view('livewire.front.contact')->extends('front.layouts.master')->section('content');
    }
}
