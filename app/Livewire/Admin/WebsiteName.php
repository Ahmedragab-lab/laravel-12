<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class WebsiteName extends Component
{
    protected $listeners = ['refreshComponent'=>'$refresh'];
    public function render()
    {
        return view('livewire.admin.website-name');
    }
}
