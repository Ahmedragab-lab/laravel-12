<?php

namespace App\Livewire\Admin;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Livewire\Component;
use Illuminate\Support\Str;

class Products3 extends Component
{
    public $product_name, $description, $price, $category_id, $brand_id, $images = [], $is_featured = false, $in_stock = false, $on_sale = false, $search;
    public $productToDelete;
    public $obj;
    public $data = [];
    public function rules()
    {
        return [
            'product_name' => 'required|unique:products,product_name,' . $this->obj?->id,
            'description' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
        ];
    }

    public function beforeSubmit()
    {
        $this->data['slug'] = Str::slug($this->product_name);
        $this->data['images'] = json_encode($this->images);
    }

    public function submit()
    {
        $this->validate();

        $this->beforeSubmit();

        if ($this->obj) {
            $this->obj->update($this->data);
            session()->flash('success', 'تم التحديث بنجاح');
        } else {
            Product::create($this->data);
            session()->flash('success', 'تم الإنشاء بنجاح');
        }

        $this->resetForm();
    }

    public function resetForm()
    {
        $this->product_name = null;
        $this->description = null;
        $this->price = null;
        $this->category_id = null;
        $this->brand_id = null;
        $this->images = [];
        $this->is_featured = false;
        $this->in_stock = false;
        $this->on_sale = false;
        $this->obj = null;
        $this->data = [];
    }

    public function render()
    {
        $products = Product::with(['category', 'brand'])
            ->when(!empty($this->search), function ($q) {
                $q->where('product_name', 'LIKE', "%" . $this->search . "%");
            })
            ->latest('id')
            ->paginate(10);

        $categories = Category::all();
        $brands = Brand::all();

        return view('livewire.admin.products3', compact('products', 'categories', 'brands'))
            ->extends('admin.layouts.master')
            ->section('content');
    }

    public function itemId(Product $product)
    {
        $this->obj = $product;
        $this->product_name = $product->product_name;
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
