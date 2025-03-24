<?php

namespace App\Livewire\Admin;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Livewire\Component;
use Illuminate\Support\Str;

class CreateProduct3 extends Component
{
    public $productId, $product_name, $description, $price, $category_id, $brand_id;
    public $categories = [], $brands = [];
    public $colors = [], $sizes = []; // Added properties for colors and sizes

    public $isEditMode = false;

    public function mount($id = null)
    {
        $this->categories = Category::all();
        $this->brands = Brand::all();

        if ($id) {
            $this->isEditMode = true;
            $this->loadProduct($id);
        }
    }

    protected function rules()
    {
        return [
            'product_name' => 'required|unique:products,product_name,' . $this->productId,
            'description' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'colors' => 'array', // Validation for colors
            'sizes' => 'array',  // Validation for sizes
        ];
    }

    public function loadProduct($id)
    {
        $product = Product::findOrFail($id);

        $this->productId = $product->id;
        $this->product_name = $product->product_name;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->category_id = $product->category_id;
        $this->brand_id = $product->brand_id;
        $this->colors = $product->colors ?? []; // Assuming colors are stored as an array
        $this->sizes = $product->sizes ?? [];   // Assuming sizes are stored as an array
    }

    public function submit()
    {
        $this->validate();

        $data = [
            'product_name' => $this->product_name,
            'slug' => Str::slug($this->product_name),
            'description' => $this->description,
            'price' => $this->price,
            'category_id' => $this->category_id,
            'brand_id' => $this->brand_id,
            'colors' => $this->colors, // Save colors
            'sizes' => $this->sizes,   // Save sizes
        ];

        if ($this->isEditMode) {
            Product::find($this->productId)->update($data);
            session()->flash('success', 'تم التحديث بنجاح');
        } else {
            Product::create($data);
            session()->flash('success', 'تم الإنشاء بنجاح');
        }

        return redirect()->route('products3');
    }

    public function render()
    {
        return view('livewire.admin.product3.add-product3')
            ->extends('admin.layouts.master')
            ->section('content');
    }
}
