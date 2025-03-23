<?php

namespace App\Livewire\Admin;
use App\Models\Animal;
use App\Traits\livewireResource;
use Livewire\Component;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
class Animals extends Component
{
    use livewireResource;
    public $name, $search;
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
            'name' => 'required|unique:animals,name,' . $this->obj?->id,
            'age' => 'nullable',
        ];
    }
    // public function beforeSubmit()
    // {
    //     $this->data['slug'] = Str::slug($this->name);
    //     if ($this->logo && $this->logo instanceof UploadedFile) {
    //         if ($this->obj) {
    //             if ($this->obj->logo !== $this->logo) {
    //                 delete_file($this->obj->logo);
    //                 $this->data['logo'] = store_file($this->logo, 'brands');
    //             }
    //         } else {
    //             $this->data['logo'] = store_file($this->logo, 'brands');
    //         }
    //     }
    // }

    public function render()
    {
    $animals = Animal::orderBy($this->sortBy, $this->sortDir)
        ->when($this->filter, function ($query) {
            $query->where('name', 'like', '%' . $this->filter . '%');
        })
        ->paginate($this->perPage);

    return view('livewire.admin.animals', compact('animals'))->extends('admin.layouts.master')->section('content');
    }
}
