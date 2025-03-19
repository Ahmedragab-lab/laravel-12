<?php

namespace App\Traits;

use ReflectionClass;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

trait livewireResource
{
    public  $obj, $screen = 'index', $keys, $data;
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public function __construct()
    {
        $this->setModelName();
        $this->keys = array_keys($this->rules());
    }
    protected function setModelName()
    {
        $reflector = new ReflectionClass($this);
        $model = $reflector->name;

        $array = explode('\\', $model);
        $model = str_replace('Controller', '', end($array));
        $model = Str::singular($model);
        //dd($model);
        if (!isset($this->model)) {
            if (class_exists('App\\Models\\' . $model)) {

                $this->model = 'App\\Models\\' . $model;
            } elseif (class_exists('App\\' . $model)) {
                $this->model = 'App\\' . $model;
            } elseif (class_exists('App\\Model\\' . $model)) {
                $this->model = 'App\\Model\\' . $model;
            }
        }
        // dd($this->model);
    }

    public function beforeSubmit()
    {
    }
    public function beforeCreate()
    {
    }

    public function submit()
    {
        $this->data = $this->validate();
        $this->beforeSubmit();

        if ($this->obj) {
            $this->beforeUpdate();
            $this->obj->update($this->data);
            $this->afterUpdate();
        } else {
            $this->beforeCreate();
            $this->obj = $this->model::create($this->data);
            $this->afterCreate();
        }
        $this->handleAttachments();
        $this->afterSubmit();
        $this->obj = null;
        $this->resetInputs();
        $this->screen = 'index';
        // $this->dispatch('alert', ['ss','sss']);
        session()->flash('success', 'تم الحفظ بنجاح');
    }
    protected function handleAttachments()
    {
        if (!empty($this->attachments) && $this->obj && method_exists($this->obj, 'attachments')) {
            // Remove existing attachments
            $this->obj->attachments->each(function ($attachment) {
                if (!in_array($attachment->file,$this->attachments)){
                    delete_file($attachment->file);
                    $attachment->delete();
                }
            });

            // Add new attachments
            foreach ($this->attachments as $attachment) {
                if ($attachment instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile) {
                    $this->obj->attachments()->create([
                        'department_id' => $this->obj->id,
                        'file' => store_file($attachment, 'attachments'),
                        'name' => $attachment->getClientOriginalName(),
                    ]);
                }
            }
        }
    }

    public function afterSubmit()
    {
    }
    public function afterCreate()
    {
    }

    public function whileEditing()
    {
    }
    public function beforeUpdate()
    {
    }

    public function edit($id)
    {
        $edit = $this->model::findOrFail($id);
        $this->obj = $edit;
        $array = $this->keys;
        if (key_exists('password', $this->rules())) {
            array_splice($array, array_search('password', $array), 1);
        }
        foreach ($array as $key) {
            $this->$key = $edit->$key;
        }
        $this->whileEditing();

        $this->screen = 'edit';
    }

    public function afterUpdate()
    {
    }

    public function delete($id)
    {
        if (!$this->beforeDelete($id)) {
            return;
        }

        $delete = $this->model::findOrFail($id);
        $delete->delete();

        session()->flash('success', 'تم الحذف بنجاح');
    }


    public function updatedScreen()
    {
        if ($this->screen == 'index') {
            $this->resetInputs();
        }
    }

    public function resetInputs()
    {
        $this->reset($this->keys);
    }

    public function removeAttachment($key)
    {
        unset($this->attachments[$key]);
    }
}
