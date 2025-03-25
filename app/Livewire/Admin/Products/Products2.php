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
use Livewire\Attributes\On;
use Livewire\WithPagination;

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
        $product->delete();
        session()->flash('success', 'تم الحذف بنجاح');
    }




}
