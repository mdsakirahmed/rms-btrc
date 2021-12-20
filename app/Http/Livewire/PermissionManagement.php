<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionManagement extends Component
{
    public $permissions, $roles, $tab = 'role', $role_name, $selected_permissions, $selected_role;

    public function tabChange($tab){
        $this->tab = $tab;
    }

    public function createRole(){
       $this->role_name = $this->selected_permissions = $this->selected_role = null;
    }

    public function selectRole(Role $role){
        $this->selected_role = $role;
        $this->role_name = $role->name;
        $this->selected_permissions = [0 => false];
        foreach($this->permissions as $permission){
            if($role->hasPermissionTo($permission->name)){
                array_push($this->selected_permissions, true);
            }else{
                array_push($this->selected_permissions, false);
            }
        }
    }

    public function submitRole(){
        if($this->selected_role){
            $this->validate(['role_name' => 'required|string|unique:roles,name,'.$this->selected_role->id]);
            $this->selected_role->update(['name' => $this->role_name]);
        }else{
            $this->validate(['role_name' => 'required|string|unique:roles,name']);
            Role::create(['name' => $this->role_name]);
            $this->role_name = null;
        }
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully Done']);
    }

    public function checkPermission($permission){
        if($this->selected_role){
            if($this->selected_role->hasPermissionTo($permission)){
                //rm permission
                $this->selected_role->revokePermissionTo($permission);
            }else{
               //add permission
               $this->selected_role->givePermissionTo($permission);
            }
            $this->dispatchBrowserEvent('alert',  ['type' => 'success',  'message' => 'Successfully Done']);
        }else{
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'Role not selected']);
        }
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
