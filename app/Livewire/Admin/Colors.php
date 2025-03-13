<?php

namespace App\Livewire\Admin;

use App\Models\Color;
use App\Traits\LivewireResource;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;

class Colors extends Component
{
    use LivewireResource;

    public $name;
    public $search = '';
    public $productSearch = '';

    public function rules()
    {
        return [
            'name' => 'required|unique:colors,name,' . $this->obj?->id,
        ];
    }

    public function beforeSubmit()
    {
        $this->data['slug'] = Str::slug($this->name);

        if ($this->image && $this->image instanceof UploadedFile) { 
            if ($this->obj) {
                if ($this->obj->image !== $this->image) { 
                    delete_file($this->obj->image);
                    $this->data['image'] = store_file($this->image, 'colors');
                }
            } else {
                $this->data['image'] = store_file($this->image, 'colors');
            }
        }
    }

    public function render()
    {
        $colors = color::with(['related_products'])->withCount('related_products')
        ->when($this->search,fn($q) => $q->where('name', 'LIKE', "%" . $this->search . "%"))
        ->latest('id')->paginate(10);

        return view('livewire.admin.colors', compact('colors'))
            ->extends('admin.layouts.master')
            ->section('content');
    }
}
