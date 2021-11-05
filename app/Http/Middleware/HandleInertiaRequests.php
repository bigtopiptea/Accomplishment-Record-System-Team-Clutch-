<?php

namespace App\Http\Middleware;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Inertia\Middleware;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request)
    {
        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $request->user(),
            ],
            'allRoles' => [
                'role' => Role::all(),
            ],
            'permissions' => [
                'permission' => Permission::all(),
            ],
            'toast' => function (){
                return Session::get('toast');
            },
            'success' => function (){
                return Session::get('success');
            },
            'error' => function (){
                return Session::get('error');
            },
            'userRole' => [
                'userRole' => User::all(),
            ],
        ]);
    }
}
