<?php

namespace App\Livewire\Front;

use Livewire\Component;
use Livewire\Attributes\Title;
#[Title('cart')]
class Cart extends Component
{
    public function render()
    {
        return view('livewire.front.cart')->extends('front.layouts.master')->section('content');
    }
}
