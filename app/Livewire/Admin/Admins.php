<?php
namespace App\Livewire\Admin;

use App\Models\Role;
use App\Models\User;
use App\Traits\livewireResource;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;

class Admins extends Component
{
    use livewireResource;
    public $model = User::class;
    public $name, $email, $password, $type='admin', $image, $phone, $search,$role_id;
    public $admin;
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
            'image' => 'nullable',
            'phone' => 'nullable|numeric',
            'role_id' => ['required'],
        ];
    }

    public function beforeSubmit()
    {
        unset($this->data['role_id']);

        $this->data['type'] = 'admin';
        if ($this->password) {
            $this->data['password'] = bcrypt($this->password);
        } else {
            unset($this->data['password']);
        }

        if ($this->image && $this->image instanceof UploadedFile) {
            if ($this->obj && $this->obj->image !== $this->image) {
                delete_file($this->obj->image);
            }
            $this->image = $this->data['image'] = store_file($this->image, 'admins');
        }

    }

    public function afterSubmit()
    {
        $this->obj?->addRole($this->role_id);
    }
    public function whileEditing()
    {
        $this->role_id = $this->obj->role?->id;
    }

    public function render()
    {
        $roles = Role::all();
        $admins = User::where('type', 'admin')
            ->when($this->search, fn($q) => $q->where('name', 'LIKE', "%" . $this->search . "%"))
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage);

        return view('livewire.admin.admins', compact('admins', 'roles'))
            ->extends('admin.layouts.master')
            ->section('content');
    }
}
