<?php

namespace App\Livewire\Admin;

use App\Models\Brand;
use App\Traits\livewireResource;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
class Brands extends Component
{
    use livewireResource;
    public $name, $search,$brand_id,$logo;
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
            'name' => 'required|unique:brands,name,' . $this->obj?->id,
            'logo' => 'nullable',
        ];
    }
    public function beforeSubmit()
    {
        $this->data['slug'] = Str::slug($this->name);
        if ($this->logo && $this->logo instanceof UploadedFile) {
            if ($this->obj) {
                if ($this->obj->logo !== $this->logo) {
                    delete_file($this->obj->logo);
                    $this->data['logo'] = store_file($this->logo, 'brands');
                }
            } else {
                $this->data['logo'] = store_file($this->logo, 'brands');
            }
        }
    }

    public function render()
    {
        $brands = Brand::with(['products'])->withCount('products')
        ->when($this->search,fn($q) => $q->where('name', 'LIKE', "%" . $this->search . "%"))
        ->orderBy($this->sortBy,$this->sortDir)->paginate($this->perPage);
        return view('livewire.admin.brands', compact('brands'))->extends('admin.layouts.master')->section('content');
    }
}
