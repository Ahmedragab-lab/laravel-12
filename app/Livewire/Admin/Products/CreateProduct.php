<?php

namespace App\Livewire\Admin\Products;

use App\Models\Size;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use App\Traits\livewireResource;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Livewire\WithFileUploads;

class CreateProduct extends Component
{
    use WithFileUploads;
    public $product_name;
    public $category_id;
    public $brand_id;
    public $expiration_date;
    public $discount;
    public $price;
    public $stock;
    public $description;
    public $image;
    public $status = 0;
    public $color_ids = [];
    public $size_ids = [];
    public $products_images = [];

    public $new_category_name = '',$new_category_image = null;
    public $new_brand_name = '',$new_brand_image = null;
    public $new_color_name = '',$new_color_code = '',$color_code = '';
    public $new_size_name = '';
    public $categories = [];
    public $brands = [];
    public $colors = [];
    public $sizes = [];
    public function mount()
    {
        $this->categories = Category::latest()->get();
        $this->brands = Brand::latest()->get();
        $this->colors = Color::latest()->get();
        $this->sizes  = Size::latest()->get();
        $this->dispatch('refreshSelect2');
    }
    public function hydrate()
    {
        $this->dispatch('refreshSelect2');
    }

    public function render()
    {
        // $categories = Category::latest()->get();
        // $brands = Brand::latest()->get();
        // $colors = Color::latest()->get();
        // $sizes  = Size::latest()->get();
        return view('livewire.admin.products2.create-product')
        ->extends('admin.layouts.master')
        ->section('content');
    }
    public function rules()
    {
        return [
            'product_name' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required',
            'expiration_date' => 'nullable',
            'discount' => 'nullable',
            'price' => 'nullable',
            'stock' => 'nullable',
            'image' => 'nullable',
            'description' => 'nullable',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, $this->rules());
    }
    public function ValidationAttributes(){
        return [
            'product_name' => 'اسم المنتج',
            'category_id' => 'القسم',
            'brand_id' => 'العلامة التجارية',
        ];
    }
    public function submit()
    {
        $this->validate();
        try {
            $data = [
                'product_name' => $this->product_name,
                'slug' => Str::slug($this->product_name),
                'category_id' => $this->category_id,
                'brand_id' => $this->brand_id,
                'expiration_date' => $this->expiration_date,
                'discount' => $this->discount ?? 0,
                'price' => $this->price ?? 0,
                'stock' => $this->stock ?? 0,
                'description' => $this->description,
                'creator' => Auth::id(),
                'code' => 'ECO-' . Carbon::now()->year . '-' . uniqid(),
                'status' => $this->stock > 0 ? 1 : 0
            ];
            if ($this->image && $this->image instanceof UploadedFile) {
                if (isset($data['image']) && $data['image'] != 'products/LOGO.png') {
                    delete_file($data['image']);
                }
                $imagePath = store_file($this->image, 'products');
                $data['image'] = $imagePath;
            }
            $product = Product::create($data);
            if (!empty($this->color_ids)) {
                $product->colors()->sync($this->color_ids);
            }

            if (!empty($this->size_ids)) {
                $product->sizes()->sync($this->size_ids);
            }
            if (!empty($this->products_images)) {
                $i = $product->images()->count() + 1;
                foreach ($this->products_images as $file) {
                    if ($file instanceof UploadedFile) {
                        $file_name = time() . $file->getClientOriginalName();
                        $file_size = $file->getSize();
                        $file_type = $file->getMimeType();
                        $file_path = store_file($file, 'products_images');

                        $product->images()->create([
                            'file_name' => $file_name,
                            'file_nametype' => 'products_images',
                            'file_size' => $file_size,
                            'file_type' => $file_type,
                            'file_status' => true,
                            'file_sort' => $i,
                        ]);

                        $i++;
                    }
                }
            }
            session()->flash('success', 'Product created successfully');
            return $this->redirect(route('products2'));
        } catch (\Exception $e) {
            $this->addError('submit', 'Failed to create product: ' . $e->getMessage());
        }
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
        $this->dispatch('refreshSelect2');
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
        $this->dispatch('refreshSelect2');
    }
    public function saveColor()
    {
        $this->validate([
            'new_color_name' => 'required|string|max:255|unique:colors,name',
            'new_color_code' => 'nullable|string|max:255',
        ]);
        $color = Color::create([
            'name' => $this->new_color_name,
            'color_code'=> $this->new_color_code,
            'slug' => Str::slug($this->new_color_name),
            'creator'=> auth()->user()->id,
        ]);
        $this->color_ids[] = $color->id;
        $this->reset(['new_color_name', 'new_color_code']);
        $this->colors = Color::latest()->get();
        session()->flash('success', 'تم الاضافة بنجاح');
        $this->dispatch('refreshSelect2');
    }

    public function saveSize()
    {
        $this->validate([
            'new_size_name' => 'required|string|max:255|unique:sizes,name',
        ]);
        $size = Size::create([
            'name' => $this->new_size_name,
            'slug' => Str::slug($this->new_size_name),
            'creator'=> auth()->user()->id,
        ]);
        $this->size_ids[] = $size->id;
        $this->reset(['new_size_name']);
        session()->flash('success', 'تم الاضافة بنجاح');
        $this->dispatch('refreshSelect2');
    }


}
