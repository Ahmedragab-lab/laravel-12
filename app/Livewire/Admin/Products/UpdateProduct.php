<?php

namespace App\Livewire\Admin\Products;

use Livewire\Component;
use App\Models\Size;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use App\Traits\livewireResource;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class UpdateProduct extends Component
{
    use livewireResource;
    public $search ,$name,$color_code;
    public $product_name, $category_id, $brand_id, $expiration_date, $discount, $price, $stock,$status, $description;
    public $new_category_name = '',$new_category_image = null;
    public $new_brand_name = '',$new_brand_image = null;
    public $new_color_name = '',$new_color_code = '';
    public $new_size_name = '';
    public $size_id = [];
    public $color_id = [];
    public $products_images = [];
    public $image='';
    public $brand;
    public $content;
    public $filter = '';
    public $sortBy = 'created_at';
    public $sortDir = 'DESC';
    public $perPage = 10;
    protected $model = Product::class;
    public function setSortBy($sortByField){
        if($this->sortBy === $sortByField){
            $this->sortDir = ($this->sortDir == "ASC") ? 'DESC' : "ASC";
            return;
        }
        $this->sortBy = $sortByField;
        $this->sortDir = 'DESC';
    }

    public function mount($id){
        $product = Product::findOrFail($id);
        $this->obj = $product;
        $this->product_name = $product->product_name;
        $this->category_id = $product->category_id;
        $this->brand_id = $product->brand_id;
        $this->expiration_date = $product->expiration_date;
        $this->discount = $product->discount;
        $this->price = $product->price;
        $this->stock = $product->stock;
        $this->status = $product->status;
        $this->description = $product->description;
        $this->color_id = $product->color->pluck('id')->toArray();
        $this->size_id = $product->size->pluck('id')->toArray();
        $this->products_images = $product->images()->get();
    }
    public function rules()
    {
        return [
            // 'name' => 'required|unique:brands,name,' . $this->obj?->id,
            'product_name' => 'required|unique:products,product_name,' . $this->obj?->id,
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
    public function render()
    {
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        $colors = Color::latest()->get();
        $sizes  = Size::latest()->get();
        return view('livewire.admin.products2.update-product', compact('categories','brands','colors','sizes'))
        ->extends('admin.layouts.master')
        ->section('content');
    }

    public function beforeSubmit()
    {
        // Add slug to data
        $this->data['slug'] = Str::slug($this->product_name);
        $this->data['creator'] = Auth::user()->id;
        $this->data['code'] = 'ECO-' . Carbon::now()->year . '-' . uniqid();
    }
    public function beforeCreate()
    {
        if (!isset($this->data['status'])) {
            $this->data['status'] = 0;
        }
    }
    public function afterCreate()
    {
        $this->syncRelationships();
        $this->handleProductImages();
    }
    public function afterUpdate()
    {
        $this->syncRelationships();
        $this->handleProductImages();
    }
    protected function syncRelationships()
    {
        if (!empty($this->color_id)) {
            $this->obj->color()->sync($this->color_id);
        }
        if (!empty($this->size_id)) {
            $this->obj->size()->sync($this->size_id);
        }
    }
    protected function handleProductImages()
    {
        if ($this->image && $this->image instanceof UploadedFile) {
            if ($this->obj->image && $this->obj->image != 'products/LOGO.png') {
                delete_file($this->obj->getRawOriginal('image'));
            }
            $imagePath = store_file($this->image, 'products');
            $this->obj->update(['image' => $imagePath]);
        }
        if (!empty($this->products_images)) {
            $i = $this->obj->images()->count() + 1;
            foreach ($this->products_images as $file) {
                if ($file instanceof UploadedFile) {
                    $file_name = time() . $file->getClientOriginalName();
                    $file_size = $file->getSize();
                    $file_type = $file->getMimeType();
                    $file_path = store_file($file, 'products_images');

                    $this->obj->images()->create([
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
    }
    public function whileEditing()
    {
        if ($this->obj) {
            $this->color_id = $this->obj->color->pluck('id')->toArray();
            $this->size_id = $this->obj->size->pluck('id')->toArray();
            $this->products_images = $this->obj->images()->get();
            $this->description = $this->obj->description;
        }
        // $this->dispatch('refreshSelect2');
    }


    public function afterSubmit(){
        // $this->render();
        return redirect()->route('products2');
        // return redirect()->back()->with('success', 'تم الحفظ بنجاح');
        // $this->screen = 'index';
        // session()->flash('success', 'تم الحفظ بنجاح');

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
        $this->size_id = $size->id;
        $this->new_size_name = '';
        // LivewireAlert::title('تم الاضافة بنجاح')->success()->show();
        session()->flash('success', 'تم الاضافة بنجاح');
    }

    public function hydrate()
{
    if ($this->obj && $this->obj->exists) {
        $this->obj->load(['color', 'size', 'images']);
    }
}
}
