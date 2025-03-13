<?php
namespace App\Livewire\Admin;

use App\Models\Size;
use App\Traits\LivewireResource;
use Livewire\Component;
use Illuminate\Support\Str;

class Sizes extends Component
{
    use LivewireResource;

    public $name;
    public $size_code = '#ffffff'; // Default to white
    public $search = '';
    public $productSearch = '';

    public function rules()
    {
        return [
            'name' => 'required|unique:sizes,name,' . $this->obj?->id,
            'size_code' => 'required|regex:/^#[0-9A-Fa-f]{6}$/', // Validate HEX code
        ];
    }

    public function beforeSubmit()
    {
        $this->data['slug'] = Str::slug($this->name);
        $this->data['size_code'] = $this->size_code; // Save the size code
    }

    public function render()
    {
        $sizes = Size::with(['related_products'])
            ->withCount('related_products')
            ->when($this->search, fn($q) => $q->where('name', 'LIKE', "%" . $this->search . "%"))
            ->latest('id')->paginate(10);

        return view('livewire.admin.sizes', compact('sizes'))
            ->extends('admin.layouts.master')
            ->section('content');
    }
}
