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
    public $productId, $product_name, $description, $price, $category_id, $brand_id, $discount, $stock, $status='0';
    public $categories = [], $brands = [], $colors = [], $sizes = [];
    public $selectedColors = [], $selectedSizes = [];
    public $isEditMode = false;
    public $new_category_name, $new_category_image;
    public $new_brand_name, $new_brand_image;
    public $new_color_name, $new_color_code;
    public $new_size_name;
    public $size_id = [];
    public $color_id = [];

    protected $listeners = ['editorUpdated'];

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
            'new_category_name' => 'nullable|string|max:255|unique:categories,name',
            'new_category_image' => 'nullable|image|max:2048',
            'new_brand_name' => 'nullable|string|max:255|unique:brands,name',
            'new_brand_image' => 'nullable|image|max:2048',
            'new_color_name' => 'nullable|string|max:255|unique:colors,name',
            'new_size_name' => 'nullable|string|max:255|unique:sizes,name',
        ];
    }

    public function editorUpdated($content)
    {
        $this->description = $content;
        $this->dispatch('refreshEditor'); // Reinitialize CKEditor after update

    }
    public function updateColor($data)
    {
        $this->selectedColors = $data['color_id'];
        $this->dispatch('refreshSelect2'); // Reinitialize Select2 after update
    }

    public function updateSize($data)
    {
        $this->selectedSizes = $data['size_id'];
        $this->dispatch('refreshSelect2'); // Reinitialize Select2 after update
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
    
        // Load existing colors and sizes for the product
        $this->selectedColors = $product->color()->pluck('colors.id')->toArray();
        $this->selectedSizes = $product->size()->pluck('sizes.id')->toArray();
    
        $this->discount = $product->discount;
        $this->stock = $product->stock;
        $this->status = $product->status;
    }
    

    public function submit()
    {
        $this->validate();

        $data = [
            'product_name' => $this->product_name,
            'description' => $this->description,
            'price' => $this->price,
            'category_id' => $this->category_id,
            'brand_id' => $this->brand_id,
            'discount' => $this->discount,
            'stock' => $this->stock,
            'status' => $this->status,
        ];
        // dd($data);

        if ($this->isEditMode) {
            $product = Product::find($this->productId);
            $product->update($data);
            $product->color()->sync($this->selectedColors);
            $product->size()->sync($this->selectedSizes);
        } else {
            $product = Product::create($data);
            $product->color()->attach($this->selectedColors);
            $product->size()->attach($this->selectedSizes);
        }

        session()->flash('success', $this->isEditMode ? 'تم التحديث بنجاح' : 'تم الإنشاء بنجاح');

        return redirect()->route('products3');
    }
    

    public function render()
    {
        return view('livewire.admin.product3.add-product3')
            ->extends('admin.layouts.master')
            ->section('content');
    }
}
