<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionManagement extends Component
{
    public $permissions, $roles, $tab = 'role', $role_name, $selected_permissions, $selected_role_id;

    public function tabChange($tab){
        $this->tab = $tab;
    }

    public function createRole(){
       $this->role_name = $this->selected_permissions = $this->selected_role_id = null;
    }

    public function selectRole(Role $role){
        $this->selected_role_id = $role->id;
        $this->role_name = $role->name;
        $this->selected_permissions = $role->permissions()->pluck('id');
    }

    public function submitRole(){
        $this->validate([
            'role_name' => 'required|string'
        ]);
        $role = Role::updateOrCreate(
            ['id' => $this->selected_role_id ?? null],
            ['name' => $this->role_name]
        );
        $role->syncPermissions($this->selected_permissions);
        $this->role_name = $this->selected_permissions = $this->selected_role_id = null;
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully Done']);
    }

    public function deleteRole(Role $role){
        if(auth()->user()->hasRole($role->name)){
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'You can not delete your self']);
        }else{
            $role->delete();
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully Done']);
        }
    }

    public function render()
    {
        $this->permissions = Permission::all();
        $this->roles = Role::latest()->get();
        return view('livewire.permission-management')->layout('layouts.backend.app');
    }
}
