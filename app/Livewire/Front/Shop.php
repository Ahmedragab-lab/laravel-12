<?php

namespace App\Livewire\Front;

use Livewire\Component;

class Shop extends Component
{
    public function render()
    {
        return view('livewire.front.shop')->extends('front.layouts.master')->section('content');
    }
}
