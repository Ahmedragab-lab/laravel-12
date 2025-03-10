<?php

namespace App\Livewire\Admin;

use App\Models\Brand;
use App\Traits\livewireResource;
use Livewire\Component;
use Illuminate\Support\Str;
class Brands extends Component
{
    use livewireResource;
    public $name, $search,$brand_id;
    public function rules()
    {
        return [
            'name' => 'required|unique:brands,name,' . $this->obj?->id,
        ];
    }
    public function beforeSubmit()
    {
        $this->data['slug'] = Str::slug($this->name);
    }
    public function render()
    {
        $brands = Brand::where(function ($q) {
            if ($this->search) {
                $q->where('name', 'LIKE', "%" . $this->search . "%");
            }
        })->latest('id')->paginate(10);
        return view('livewire.admin.brands', compact('brands'))->extends('admin.layouts.master')->section('content');
    }

   

    public function delete(Brand $brand)
    {
        $brand->delete();
        session()->flash('success', 'تم الحذف بنجاح');
    }
}
