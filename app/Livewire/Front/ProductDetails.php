<?php

namespace App\Livewire\Front;
use Livewire\Attributes\Title;
use App\Models\Product;
use Livewire\Component;
#[Title('Product Details')]
class ProductDetails extends Component
{
    public $product;
    public $product_id;
    public $slug;
    public $productImages = [];
    public function mount($slug){
        $this->slug = $slug;
        $this->product = Product::where('slug', $slug)->firstOrFail();
    }
    public function render()
    {
        return view('livewire.front.product-details')
        ->extends('front.layouts.master')
        ->section('content');
    }
}
