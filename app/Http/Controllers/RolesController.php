<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    public function index()
    {

        Auth::user()->roles->pluck('name');

        $roles = Role::all();

        return Inertia::render('Roles/Roles', ['roles' => $roles]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'role_name'  => ['required']
        ]);

        $role = Role::create([
            'name' => $request->role_name,
        ]);

        return Redirect::back()->with(['toast' => ['message' => "Role Added Successfully!"]]);
    }

    public function edit($id)
    {
        $role = Role::findOrfail($id);

        return Inertia::render('Roles/RoleEdit', [
            'roles' => [
                'role_id' => $role->id,
                'role_name' => $role->name
            ],
        ]);
    }

    public function update($id, Request $request)
    
    {
        $role = Role::findOrFail($id);
        $role->name = $request->role_name;

        $role->save();

        return Redirect::route('roles.index')->with(['toast' => ['message' => 'Role Edit Successfully!']]);

    }
    public function destroy(Role $role)
    {
        $role->delete();
        return Redirect::route('roles.index')->with(['toast' => ['message' => "Role Deleted Successfully!"]]);
    }
}
