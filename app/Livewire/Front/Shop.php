<?php

namespace App\Livewire\Front;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Color;
use App\Models\Size;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
#[Title('Shop')]
class Shop extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $search = '';
    #[Url]
    public $selectedCategories = [];
    #[Url]
    public $selectedBrands = [];
    #[Url]
    public $selectedColors = [];
    #[Url]
    public $selectedSizes = [];
    #[Url]
    public $minPrice = 10;
    #[Url]
    public $maxPrice = 1000;
    protected $listeners = ['refresh' => '$refresh'];
    public function render()
    {
        $categories = Category::all();
        $brands = Brand::isActive()->withCount('products')->get();
        $colors = Color::all();  // جلب الألوان من الجدول
        $sizes = Size::all();
        $products = Product::with(['category', 'brand', 'color','size', 'images'])
        ->when($this->search, fn ($q) => $q->where('product_name', 'like', '%' . $this->search . '%'))
        ->when($this->selectedBrands, fn ($q) => $q->whereIn('brand_id', $this->selectedBrands))
        ->when($this->selectedCategories, fn ($q) => $q->whereIn('category_id', $this->selectedCategories))
        ->when($this->selectedColors, function ($q) {
            $q->whereHas('color', function ($query) {
                $query->whereIn('colors.id', $this->selectedColors);
            });
        })
        ->when($this->selectedSizes, function ($q) {
            $q->whereHas('size', function ($query) {
                $query->whereIn('sizes.id', $this->selectedSizes);
            });
        })
        ->when($this->minPrice !== null && $this->maxPrice !== null, function ($q) {
            return $q->whereBetween('price', [$this->minPrice, $this->maxPrice]);
        })
        ->latest('id')
        ->paginate(6);
        // $products = Product::latest()->paginate(9);
        return view('livewire.front.shop', compact('brands', 'products', 'colors','sizes','categories'))
        ->extends('front.layouts.master')
        ->section('content');
    }
    public function updatedSelectedCategories()
    {
        $this->resetPage();
        $this->dispatch('refreshPage', ['url' => route('shop')]);
    }

    public function updatedSelectedBrands()
    {
        $this->resetPage();
        $this->dispatch('refreshPage', ['url' => route('shop')]);
    }
    public function updatedMinPrice()
    {
        $this->resetPage();
        $this->dispatch('refreshPage', ['url' => route('shop')]);
    }

    public function updatedMaxPrice()
    {
        $this->resetPage();
        $this->dispatch('refreshPage', ['url' => route('shop')]);
    }
    public function toggleColor($colorId)
    {
        if (in_array($colorId, $this->selectedColors)) {
            $this->selectedColors = array_diff($this->selectedColors, [$colorId]);
        } else {
            $this->selectedColors[] = $colorId;
        }

        $this->resetPage();
        $this->dispatch('refreshPage', [
            'url' => route('shop')
        ]);
    }
    public function toggleSize($sizeId)
    {
        if (in_array($sizeId, $this->selectedSizes)) {
            $this->selectedSizes = array_diff($this->selectedSizes, [$sizeId]);
        } else {
            $this->selectedSizes[] = $sizeId;
        }
        $this->resetPage();
        $this->dispatch('refreshPage', [
            'url' => route('shop')
        ]);
    }
}
