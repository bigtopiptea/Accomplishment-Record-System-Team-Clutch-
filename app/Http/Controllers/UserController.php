<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Validation\Rule as ValidationRule;

class UserController extends Controller
{
    public function index(Request $request)

    {
        Auth::user()->roles->pluck('name');

        return Inertia::render('Users/Users', [
            'users' => User::when($request->user, function ($query, $user) {
                $query->where('email', 'LIKE', '%' . $user . '%');
            })->with('roles')->paginate(5)
        ]);
    }

    public function create()
    {
        Auth::user()->roles->pluck('name');

        $roles = Role::all();
        return Inertia::render('Users/CreateUsers', ['roles' => $roles]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', Rules\Password::defaults()],
            'selectRole' => ['required'],
            'position' => ['required']
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'position' => $request->position,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($request->selectRole);

        return Redirect::route('users.index', $user)->with(['success'  => 'Account Created Successfully!']);
    }

    public function edit($id, User $users)
    {
        Auth::user()->roles->pluck('name');

        $users = User::find($id);

        // $users = User::with('roles')->get();
        $roles = Role::all();

        // return Inertia::render('Users/EditUser', ['users' => $users, 'roles' => $roles]);
        return Inertia::render('Users/EditUser', [
            'users' => [
                'id' => $users->id,
                'name' => $users->name,
                'email' => $users->email,
                'position' => $users->position,
                'roles' => $users->roles,
            ]
        ]);
    }

    public function profile($id)
    {
        Auth::user()->roles->pluck('name');

        $users = User::find($id);

        return Inertia::render('Users/Profile', [
            'users' => [
                'id' => $users->id,
                'name' => $users->name,
                'password' => $users->password,
                'email' => $users->email,
                'roles' => $users->roles
            ]
        ]);
    }

    public function listofhoh()
    {
        $users = User::role('head of office')
            ->with('tasks')
            ->get();

        return Inertia::render('Users/HeadOfOfficeTask', ['users' => $users]);
    }

    public function hohCheckList($id)
    {
        $users = User::find($id);

        return Inertia::render('Users/ListofTaskByHoH', [
            'users' =>  $users->tasks,
        ]);
    }

    public function updateProfile($id, Request $request)
    {
        $users = User::find($id);

        $data = FacadesRequest::validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'max:50', 'email', ValidationRule::unique('users')->ignore($users->id)],
        ]);
        $users->update($data);

        return Redirect::route('users.index')->with(['toast' => ['message' => "Account Updated Successfully!"]]);
    }

    public function update($id, Request $request)
    {
        $users = User::find($id);

        $data = FacadesRequest::validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'max:50', 'email', ValidationRule::unique('users')->ignore($users->id)],
            'position' => ['required'],
            'role' => ['required'],
        ]);

        $users->update($data);

        return Redirect::route('users.index')->with(['success' => "Account Updated Successfully!"]);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return Redirect::route('users.index')->with(['success' => "Account Deleted Successfully!"]);
    }
}
