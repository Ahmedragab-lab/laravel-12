<?php

namespace App\Livewire\Admin;

use App\Models\Size;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Traits\livewireResource;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Illuminate\Http\UploadedFile;
class Products2 extends Component
{
    use livewireResource;
    public $search ,$name;
    public $product_name, $category_id, $brand_id, $expiration_date, $discount, $price, $stock, $description;
    public $new_category_name = '',$new_category_image = null;
    public $new_brand_name = '',$new_brand_image = null;
    public $new_color_name = '',$new_color_code = '';
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
            'product_name' => 'required',
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
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        $colors = Color::latest()->get();
        $sizes  = Size::latest()->get();
        $products = Product::with(['category','brand','color','size','images'])->orderBy($this->sortBy,$this->sortDir)->paginate($this->perPage);
        return view('livewire.admin.products2.index', compact('products','categories','brands','colors','sizes'))->extends('admin.layouts.master')->section('content');
    }


    public function mount(){

    }
    public function saveCategory()
    {
        $this->validate([
            'new_category_name' => 'required|string|max:255|unique:categories,name',
            'new_category_image' => 'nullable',
        ]);
        $category = Category::create([
            'name' => $this->new_category_name,
            'slug' => Str::slug($this->new_category_name),
        ]);
        if ($this->new_category_image && $this->new_category_image instanceof UploadedFile) {
            $imagePath = store_file($this->new_category_image, 'categories');
            $category->update([
                'image' => $imagePath
            ]);
        }
        $this->category_id = $category->id;
        $this->new_category_name = '';
        $this->new_category_image = null;
        // LivewireAlert::title('تم الاضافة بنجاح')->success()->show();
        session()->flash('success', 'تم الاضافة بنجاح');
    }
    public function saveBrand()
    {
        $this->validate([
            'new_brand_name' => 'required|string|max:255|unique:brands,name',
            'new_brand_image' => 'nullable',
        ]);
        $brand = Brand::create([
            'name' => $this->new_brand_name,
            'slug' => Str::slug($this->new_brand_name),
            'creator'=> auth()->user()->id,
        ]);
        if ($this->new_brand_image && $this->new_brand_image instanceof UploadedFile) {
            $imagePath = store_file($this->new_brand_image, 'brands');
            $brand->update([
                'logo' => $imagePath
            ]);
        }
        $this->brand_id = $brand->id;
        $this->new_brand_name = '';
        $this->new_brand_image = null;
        // LivewireAlert::title('تم الاضافة بنجاح')->success()->show();
        session()->flash('success', 'تم الاضافة بنجاح');
    }
    public function saveColor()
    {
        $this->validate([
            'new_color_name' => 'required|string|max:255|unique:colors,name',
        ]);
        $color = Color::create([
            'name' => $this->new_color_name,
            'color_code'=> $this->new_color_code,
            'slug' => Str::slug($this->new_color_name),
            'creator'=> auth()->user()->id,
        ]);
        $this->color_id = $color->id;
        $this->new_color_name = '';
        // LivewireAlert::title('تم الاضافة بنجاح')->success()->show();
        session()->flash('success', 'تم الاضافة بنجاح');
    }

}
