<?php

namespace App\Livewire\Front;

use Livewire\Component;
use Livewire\Attributes\Title;
#[Title('Shop')]
class Shop extends Component
{
    public function render()
    {
        return view('livewire.front.shop')->extends('front.layouts.master')->section('content');
    }
}
