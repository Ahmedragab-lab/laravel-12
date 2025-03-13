<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Traits\LivewireResource;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;

class Categories extends Component
{
    use LivewireResource;

    public $name;
    public $search = '';
    public $productSearch = '';
    public $image;

    public function rules()
    {
        return [
            'name' => 'required|unique:categories,name,' . $this->obj?->id,
            'image' => 'nullable',
        ];
    }

    public function beforeSubmit()
    {
        $this->data['slug'] = Str::slug($this->name);

        if ($this->image && $this->image instanceof UploadedFile) { 
            if ($this->obj) {
                if ($this->obj->image !== $this->image) { 
                    delete_file($this->obj->image);
                    $this->data['image'] = store_file($this->image, 'categories');
                }
            } else {
                $this->data['image'] = store_file($this->image, 'categories');
            }
        }
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
