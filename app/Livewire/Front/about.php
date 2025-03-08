<?php

namespace App\Livewire\Front;

use Livewire\Component;
use Livewire\Attributes\Title;
#[Title('about')]
class About extends Component
{
    public function render()
    {
        return view('livewire.front.about')->extends('front.layouts.master')->section('content');
    }
}
