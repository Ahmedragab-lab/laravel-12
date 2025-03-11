<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Traits\LivewireResource;
use Livewire\Component;
use Illuminate\Support\Str;

class Categories extends Component
{
    use LivewireResource;

    public $name;
    public $search = '';
    public $productSearch = '';


    public function rules()
    {
        return [
            'name' => 'required|unique:categories,name,' . $this->obj?->id,
        ];
    }

    public function beforeSubmit()
    {
        $this->data['slug'] = Str::slug($this->name);
    }

    public function render()
    {
        $categories = Category::with(['products'])->withCount('products')
        ->when($this->search,fn($q) => $q->where('name', 'LIKE', "%" . $this->search . "%"))
        ->latest('id')->paginate(10);

        return view('livewire.admin.categories', compact('categories'))
            ->extends('admin.layouts.master')
            ->section('content');
    }


}
