<?php

namespace App\Livewire\Admin\Products;

use App\Models\Product;
use Livewire\Component;

class ShowProduct extends Component
{
    public $product;
    public function mount($id){
        $this->product = Product::findOrFail($id);
    }
    public function render()
    {
        return view('livewire.admin.products2.show-product')
        ->extends('admin.layouts.master')
        ->section('content');
    }
}
