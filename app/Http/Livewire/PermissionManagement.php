<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class PermissionManagement extends Component
{
    public $permissions;

    public function mount(){
        $this->permissions = Permission::all();
    }
    public function render()
    {
        return view('livewire.permission-management')->layout('layouts.backend.app');
    }
}
