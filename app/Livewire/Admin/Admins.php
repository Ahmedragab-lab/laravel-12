<?php
namespace App\Livewire\Admin;

use App\Models\User;
use App\Traits\livewireResource;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;

class Admins extends Component
{
    use livewireResource;
    public $model = User::class;
    public $name, $email, $password, $type, $image, $phone, $search;
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
            // 'image' => 'nullable|image|max:2048',
            'phone' => 'nullable|numeric',
        ];
    }

    public function beforeSubmit()
    {
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

    public function beforeDelete($id)
    {
        // dd(auth()->id());
        if (auth()->id() === (int) $id) {
            session()->flash('error', 'لا يمكنك حذف حسابك الحالي.');
            return false;
        }
        return true;
    }

    public function render()
    {
        $admins = User::where('type', 'admin') 
            ->when($this->search, fn($q) => $q->where('name', 'LIKE', "%" . $this->search . "%"))
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage);

        return view('livewire.admin.admins', compact('admins'))
            ->extends('admin.layouts.master')
            ->section('content');
    }
}
