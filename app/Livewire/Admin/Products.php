<?php

namespace App\Livewire\Admin;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Traits\LivewireResource;
use Livewire\Component;
use Illuminate\Support\Str;

class Products extends Component
{
    use LivewireResource;

    public $name, $description, $price, $category_id, $brand_id, $images = [], $is_featured = false, $in_stock = false, $on_sale = false, $search;
    public $productToDelete;

    public function rules()
    {
        return [
            'name' => 'required|unique:products,name,' . $this->obj?->id,
            'description' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
        ];
    }

    public function beforeSubmit()
    {
        $this->data['slug'] = Str::slug($this->name);
        $this->data['images'] = json_encode($this->images);

    }

    public function render()
    {
        $products = Product::with(['category', 'brand'])
            ->when(!empty($this->search), function ($q) {
                $q->where('name', 'LIKE', "%" . $this->search . "%");
            })
            ->latest('id')
            ->paginate(10);

        $categories = Category::all();
        $brands = Brand::all();
        

        return view('livewire.admin.products', compact('products', 'categories', 'brands'))
            ->extends('admin.layouts.master')
            ->section('content');
    }

    public function itemId(Product $product)
    {
        $this->name = $product->name;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->category_id = $product->category_id;
        $this->brand_id = $product->brand_id;
        $this->images = json_decode($product->images, true) ?? [];
        $this->is_featured = $product->is_featured;
        $this->in_stock = $product->in_stock;
        $this->on_sale = $product->on_sale;
    }

    public function delete(Product $product)
    {
        $product->delete();
        session()->flash('success', 'تم الحذف بنجاح');
    }
}
