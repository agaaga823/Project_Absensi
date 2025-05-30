<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function adminDashboard()
    {
        $totalUsers = User::where('role', 'user')->count();
        return view('admin.dashboard', compact('totalUsers'));
    }
}
