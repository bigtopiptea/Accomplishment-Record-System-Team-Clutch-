<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasRole('head of office')) {
            return Inertia::render('Dashboard/HeadofficeDashboard');
        } elseif (Auth::user()->hasRole('admin')) {
            return Inertia::render('Dashboard/AdminDashboard');
        } elseif (Auth::user()->hasRole('staff')) {
            return Inertia::render('Dashboard/StaffDashboard');
        }
    }
}
