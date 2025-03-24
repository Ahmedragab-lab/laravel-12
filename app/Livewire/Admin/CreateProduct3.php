<?php

namespace App\Livewire\Admin;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Size;
use Livewire\Component;
use Illuminate\Support\Str;

class CreateProduct3 extends Component
{
    public $productId, $product_name, $description, $price, $category_id, $brand_id;
    public $categories = [], $brands = [], $colors = [], $sizes = [];
    public $selectedColors = [], $selectedSizes = [];
    public $isEditMode = false;

    public function mount($id = null)
    {
        $this->categories = Category::all();
        $this->brands = Brand::all();
        $this->colors = Color::all();
        $this->sizes = Size::all();

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
            'selectedColors' => 'array',
            'selectedSizes' => 'array',
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
        $this->selectedColors = $product->colors()->pluck('id')->toArray();
        $this->selectedSizes = $product->sizes()->pluck('id')->toArray();
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
        ];

        if ($this->isEditMode) {
            $product = Product::find($this->productId);
            $product->update($data);
            $product->colors()->sync($this->selectedColors);
            $product->sizes()->sync($this->selectedSizes);
            session()->flash('success', 'تم التحديث بنجاح');
        } else {
            $product = Product::create($data);
            $product->colors()->attach($this->selectedColors);
            $product->sizes()->attach($this->selectedSizes);
            session()->flash('success', 'تم الإنشاء بنجاح');
        }

        return redirect()->route('products3');
    }

    public function updatedSelectedColors($value)
    {
        $this->selectedColors = $value;
    }

    public function updatedSelectedSizes($value)
    {
        $this->selectedSizes = $value;
    }

    public function render()
    {
        return view('livewire.admin.product3.add-product3')
            ->extends('admin.layouts.master')
            ->section('content');
    }
}
