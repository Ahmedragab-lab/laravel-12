<?php
namespace App\Livewire\Admin;

use App\Models\Color;
use App\Traits\LivewireResource;
use Livewire\Component;
use Illuminate\Support\Str;

class Colors extends Component
{
    use LivewireResource;

    public $name;
    public $color_code = '#ffffff'; // Default to white
    public $search = '';
    public $productSearch = '';

    public function rules()
    {
        return [
            'name' => 'required|unique:colors,name,' . $this->obj?->id,
            'color_code' => 'required|regex:/^#[0-9A-Fa-f]{6}$/', // Validate HEX code
        ];
    }

    public function beforeSubmit()
    {
        $this->data['slug'] = Str::slug($this->name);
        $this->data['color_code'] = $this->color_code; // Save the color code
    }

    public function render()
    {
        $colors = Color::with(['related_products'])
            ->withCount('related_products')
            ->when($this->search, fn($q) => $q->where('name', 'LIKE', "%" . $this->search . "%"))
            ->latest('id')->paginate(10);

        return view('livewire.admin.colors', compact('colors'))
            ->extends('admin.layouts.master')
            ->section('content');
    }
}
