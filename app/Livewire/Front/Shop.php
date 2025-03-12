<?php

namespace App\Livewire\Front;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Color;
use Livewire\Component;
use Livewire\Attributes\Title;
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
    public $selectedColors = [];  // متغير لتخزين الألوان المختارة
    // public $selectedBrands = [];
    // protected $queryString = [
    //     'search' => ['except' => ''],
    //     'selectedBrands' => ['except' => []],
    // ];
    public function render()
    {
        $brands = Brand::isActive()->withCount('products')->get();
        $colors = Color::all();  // جلب الألوان من الجدول
        $products = Product::with(['category', 'brand', 'color'])
        // ->when($this->search, fn ($q) => $q->where('name', 'like', '%' . $this->search . '%'))
        // ->when($this->selectedBrands, fn ($q) => $q->whereIn('brand_id', $this->selectedBrands))
        ->when($this->selectedColors, function ($q) {
            $q->whereHas('color', function ($query) {
                $query->whereIn('colors.id', $this->selectedColors);
            });
        })
        ->latest('id')
        ->paginate(6);
        // $products = Product::latest()->paginate(9);
        return view('livewire.front.shop', compact('brands', 'products', 'colors'))
        ->extends('front.layouts.master')
        ->section('content');
    }
    public function toggleColor($colorId)
    {
        if (in_array($colorId, $this->selectedColors)) {
            $this->selectedColors = array_diff($this->selectedColors, [$colorId]);
        } else {
            $this->selectedColors[] = $colorId;
        }

        $this->resetPage();
    }
    

    // public function updatedSearch()
    // {
    //     $this->resetPage();
    // }

    // public function updatedSelectedBrands()
    // {
    //     $this->resetPage();
    // }

    // public function toggleBrand($brandId)
    // {
    //     if (in_array($brandId, $this->selectedBrands)) {
    //         $this->selectedBrands = array_diff($this->selectedBrands, [$brandId]);
    //     } else {
    //         $this->selectedBrands[] = $brandId;
    //     }
    // }
}
