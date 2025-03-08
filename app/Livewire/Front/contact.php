<?php

namespace App\Livewire\Front;

use Livewire\Component;
use Livewire\Attributes\Title;
#[Title('contact')]
class Contact extends Component
{
    public function render()
    {
        return view('livewire.front.contact')->extends('front.layouts.master')->section('content');
    }
}
