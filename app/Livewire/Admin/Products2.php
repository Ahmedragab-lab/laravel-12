<?php

namespace App\Livewire\Admin;

use App\Models\Product;
use App\Traits\livewireResource;
use Livewire\Component;

class Products2 extends Component
{
    use livewireResource;
    public $name, $search,$brand_id,$logo;
    public $brand;
    public $filter = '';
    public $sortBy = 'created_at';
    public $sortDir = 'DESC';
    public $perPage = 10;
    public function setSortBy($sortByField){
        if($this->sortBy === $sortByField){
            $this->sortDir = ($this->sortDir == "ASC") ? 'DESC' : "ASC";
            return;
        }
        $this->sortBy = $sortByField;
        $this->sortDir = 'DESC';
    }
    public function rules()
    {
        return [
            // 'name' => 'required|unique:brands,name,' . $this->obj?->id,
            // 'logo' => 'nullable',
            'category_id' => 'required',
            'brand_id' => 'required',
            'product_name' => 'required',
            'expiration_date' => 'nullable',
            'discount' => 'nullable',
            'price' => 'nullable',
            'stock' => 'nullable',
            'image' => 'nullable',
            'description' => 'nullable',
        ];
    }
    public function render()
    {
        $products = Product::with(['category','brand','color','size','images'])->orderBy($this->sortBy,$this->sortDir)->paginate($this->perPage);
        return view('livewire.admin.products2.index', compact('products'))->extends('admin.layouts.master')->section('content');
    }
}
