<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Traits\LivewireResource;
use Livewire\Component;
use Illuminate\Support\Str;

class Categories extends Component
{
    use LivewireResource;

    public $name, $search;
    public $categoryToDelete;

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
        $categories = Category::when(!empty($this->search), function ($q) {
            $q->where('name', 'LIKE', "%" . $this->search . "%");
        })
        ->latest('id')
        ->paginate(10);
    
        return view('livewire.admin.categories', compact('categories'))
            ->extends('admin.layouts.master')
            ->section('content');
    }
    
    public function itemId(Category $category)
    {
        $this->name = $category->name;
    }

    public function delete(Category $category)
    {
        $category->delete();

        session()->flash('success', 'تم الحذف بنجاح');
    }
}
