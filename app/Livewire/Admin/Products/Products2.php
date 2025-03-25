<?php

namespace App\Livewire\Admin\Products;

use App\Models\Size;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Str;
use App\Traits\livewireResource;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Illuminate\Http\UploadedFile;
use Carbon\Carbon;
use DB;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Illuminate\Support\Facades\File;

class Products2 extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $filter = '';
    public $sortBy = 'created_at';
    public $sortDir = 'DESC';
    public $perPage = 10;
    public $search = '', $search_brand = '', $search_category = '',$search_admin = '',$search_brand_id = '',
    $search_category_id = '',$search_color_id = '',$search_size_id = '';
    protected $model = Product::class;
    public $selected_ids = [];
    public $selectAll = false;
    public $allproducts = '';

    // Bulk delete method
    public function deleteBulk()
    {
        // Validate that some products are selected
        if (empty($this->selected_ids)) {
            session()->flash('error', 'Please select products to delete');
            return;
        }
        // dd($this->selected_ids);
        $products = Product::whereIn('id', $this->selected_ids)->get();
        try {
            DB::beginTransaction();
            foreach ($products as $product) {
                if ($product->image && $product->image != 'courses/LOGO.png') {
                    delete_file($product->getRawOriginal('image'));
                }
                if ($product->images()->count() > 0) {
                    foreach ($product->images as $media) {
                        $imagePath = 'uploads/products_images/' . $media->file_name;
                        if (File::exists($imagePath)) {
                            File::delete($imagePath);
                        }
                        $media->delete();
                    }
                }
                $product->delete();
            }
            DB::commit();
            $this->selected_ids = [];
            $this->selectAll = false;
            session()->flash('success', count($products) . ' products deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Bulk delete error: ' . $e->getMessage());
            session()->flash('error', 'Failed to delete products. ' . $e->getMessage());
        }
        $this->resetPage();
    }
    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selected_ids = Product::pluck('id')->toArray();
        } else {
            $this->selected_ids = [];
        }
    }
    public function resetFilters(){
        $this->search = '';
        $this->search_brand = '';
        $this->search_category = '';
        $this->search_admin = '';
        $this->search_brand_id = '';
        $this->search_category_id = '';
        $this->search_color_id = '';
        $this->search_size_id = '';
    }
    public function setSortBy($sortByField){
        if($this->sortBy === $sortByField){
            $this->sortDir = ($this->sortDir == "ASC") ? 'DESC' : "ASC";
            return;
        }
        $this->sortBy = $sortByField;
        $this->sortDir = 'DESC';
    }

    public function render()
    {
        $admins = User::where('type','admin')->get();
        $active = Product::where('status',1)->count();
        $unactive = Product::where('status',0)->count();
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        $colors = Color::latest()->get();
        $sizes  = Size::latest()->get();
        $query = Product::with(['category','brand','color','size','images']);
        if (request()->filled('brand_id')) {
            $query = $query->where('brand_id', request('brand_id'));
        }
        if ($this->search) {
            $query = $query->where('product_name', 'like', '%' . $this->search . '%');
        }
        if ($this->search_brand) {
            $query = $query->whereHas('brand', function ($q) {
                $q->where('name', 'like', '%' . $this->search_brand . '%');
            });
        }
        if($this->search_brand_id){
            $query = $query->where('brand_id', $this->search_brand_id);
        }
        if($this->search_category_id){
            $query = $query->where('category_id', $this->search_category_id);
        }
        if($this->search_color_id){
            $query = $query->whereHas('color', function ($q) {
                $q->where('colors.id', $this->search_color_id);
            });
        }
        if($this->search_size_id){
            $query = $query->whereHas('size', function ($q) {
                $q->where('sizes.id', $this->search_size_id);
            });
        }
        if ($this->search_category) {
            $query = $query->whereHas('category', function ($q) {
                $q->where('name', 'like', '%' . $this->search_category . '%');
            });
        }
        if ($this->search_admin) {
            $query = $query->where('creator', 'like', '%' . $this->search_admin . '%');
        }
        if ($this->filter=='active') {
            $query = $query->where('status', 1);
        }elseif ($this->filter=='unactive') {
            $query = $query->where('status', 0);
        }
        $products = $query->orderBy($this->sortBy,$this->sortDir)
                          ->paginate($this->perPage);
        return view('livewire.admin.products2.index', compact('products','categories','brands','colors','sizes','active','unactive','admins'))
        ->extends('admin.layouts.master')
        ->section('content');
    }



    public function delete($id)
    {
        $product = Product::findOrFail($id);
        if ($product->image != 'courses/LOGO.png') {
            delete_file($product->getRawOriginal('image'));
        }
        if($product->images()->count() > 0){
            foreach ($product->images as $media){
                if (File::exists('uploads/products_images/'. $media->file_name)){
                    unlink('uploads/products_images/'. $media->file_name);
                }
                $media->delete();
            }
        }
        $product->delete();
        session()->flash('success', 'تم الحذف بنجاح');
    }




}
