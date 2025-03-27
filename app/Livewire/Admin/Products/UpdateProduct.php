<?php

namespace App\Livewire\Admin\Products;

use Livewire\Component;
use App\Models\Size;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Product;
use App\Models\Category;
use App\Models\Image;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use App\Traits\livewireResource;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Livewire\WithFileUploads;

class UpdateProduct extends Component
{
    use WithFileUploads;

    public $product_id;
    public $product;
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
    public $existing_images = [];

    public $new_category_name = '', $new_category_image = null;
    public $new_brand_name = '', $new_brand_image = null;
    public $new_color_name = '', $new_color_code = '',$color_code = '';
    public $new_size_name = '';
    public $categories = [];
    public $brands = [];
    public $colors = [];
    public $sizes = [];
    public function hydrate()
    {
        $this->dispatch('refreshSelect2');
    }
    public function mount($id)
    {
        $this->product = Product::findOrFail($id);
        $this->product_id = $id;
        $this->product_name = $this->product->product_name;
        $this->category_id = $this->product->category_id;
        $this->brand_id = $this->product->brand_id;
        $this->expiration_date = $this->product->expiration_date;
        $this->discount = $this->product->discount;
        $this->price = $this->product->price;
        $this->stock = $this->product->stock;
        $this->description = $this->product->description;
        $this->status = $this->product->status;
        $this->image = $this->product->image;
        $this->color_ids = $this->product->colors->pluck('id')->toArray();
        $this->size_ids = $this->product->sizes->pluck('id')->toArray();
        $this->products_images = $this->product->images->toArray();
        $this->categories = Category::latest()->get();
        $this->brands = Brand::latest()->get();
        $this->colors = Color::latest()->get();
        $this->sizes  = Size::latest()->get();
        $this->dispatch('refreshSelect2');
    }

    public function rules()
    {
        return [
            'product_name' => 'required|unique:products,product_name,' . $this->product_id,
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
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
    public function render()
    {
        // $categories = Category::latest()->get();
        // $brands = Brand::latest()->get();
        // $colors = Color::latest()->get();
        // $sizes  = Size::latest()->get();
        return view('livewire.admin.products2.update-product')
        ->extends('admin.layouts.master')
        ->section('content');
    }
    public function submit()
    {
        $this->validate();
        // dd($this->color_ids);

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
                'status' => $this->stock > 0 ? 1 : 0
            ];
            if ($this->image && $this->image instanceof UploadedFile) {
                if ($this->product->image && $this->product->image != 'products/LOGO.png') {
                    delete_file($this->product->image);
                }
                $imagePath = store_file($this->image, 'products');
                $data['image'] = $imagePath;
            }
            $data['creator'] = Auth::user()->id;
            $data['code'] = 'ECO-' . Carbon::now()->year . '-' . uniqid();
            $data['sku'] = 'SKU' . Carbon::now()->year . '-' . uniqid();
            $this->product->update($data);
            $this->product->colors()->sync($this->color_ids);
            $this->product->sizes()->sync($this->size_ids);
            if (!empty($this->products_images)) {
                $i = $this->product->images()->count() + 1;
                foreach ($this->products_images as $file) {
                    if ($file instanceof UploadedFile) {
                        $file_name = time() . $file->getClientOriginalName();
                        $file_size = $file->getSize();
                        $file_type = $file->getMimeType();
                        $file_path = store_file($file, 'products_images');

                        $this->product->images()->create([
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

            session()->flash('success', 'تم تحديث ام المنتج بنجاح');
            return $this->redirect(route('products2'));
        } catch (\Exception $e) {
            $this->addError('submit', 'Failed to update product: ' . $e->getMessage());
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
    public function removeAttachment($index)
    {

        if (isset($this->products_images[$index])) {
            Image::where('id', $this->products_images[$index]['id'])->delete();
            unset($this->products_images[$index]);
            $this->products_images = array_values($this->products_images);
        }
    }
}
