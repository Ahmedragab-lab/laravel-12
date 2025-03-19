<?php
namespace App\Livewire\Admin;

use App\Models\User;
use App\Traits\livewireResource;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;

class Users extends Component
{
    use livewireResource;

    public $name, $email, $password, $type, $logo, $search;
    public $user;
    public $filter = '';
    public $sortBy = 'created_at';
    public $sortDir = 'DESC';
    public $perPage = 10;

    public function setSortBy($sortByField)
    {
        if ($this->sortBy === $sortByField) {
            $this->sortDir = ($this->sortDir == "ASC") ? 'DESC' : "ASC";
            return;
        }
        $this->sortBy = $sortByField;
        $this->sortDir = 'DESC';
    }

    public function rules()
    {
        return [
            'name' => 'required|unique:users,name,' . $this->obj?->id,
            'email' => 'required|email|unique:users,email,' . $this->obj?->id,
            'password' => 'nullable|min:6',
            'type' => 'required|in:user,admin',
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
                    $this->data['logo'] = store_file($this->logo, 'users');
                }
            } else {
                $this->data['logo'] = store_file($this->logo, 'users');
            }
        }
    }

    public function render()
    {
        $users = User::when($this->search, fn($q) => $q->where('name', 'LIKE', "%" . $this->search . "%"))
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage);

        return view('livewire.admin.users', compact('users'))
            ->extends('admin.layouts.master')
            ->section('content');
    }
}
