<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserPermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id', 'desc')->select('id', 'name', 'email')->get();
        return view('backend.user-permission.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $permissions = Permission::select('name')->get();
        return view('backend.user-permission.user-permission-edit', compact('user', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
           'permissions' => 'required'
        ]);
        $user = User::findOrFail($id);
        //if any user self try to remove own permission of "manage user permission" system will response a alert
        // and this operation will not be completed.
        if (auth()->user()->id == $id){
            if (!in_array("manage user permission", $request->permissions)) {
                toastr()->error('Sorry you can not remove your own permission of "manage user permission', 'Error!');
                return back();
            }
        }
        try {
            $user->syncPermissions([$request->permissions]);
            toastr()->success('Successfully permission updated', 'Success!');
            return back();
        }catch (\Exception $exception){
            toastr()->error($exception->getMessage(), 'Error!');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function editUserRole($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::select('name')->get();
        return view('backend.user-permission.user-role-edit', compact('user', 'roles'));
    }

    public function updateUserRole(Request $request, $id)
    {
        $request->validate([
            'roles' => 'required'
        ]);
        $user = User::findOrFail($id);
        try {
            $user->syncRoles([$request->roles]);
            toastr()->success('Successfully role updated', 'Success!');
            return back();
        }catch (\Exception $exception){
            toastr()->error($exception->getMessage(), 'Error!');
            return back();
        }
    }
}
