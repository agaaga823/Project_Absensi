<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    public function index()
    {
        return view('admin.user.pengguna');
    }

    public function create()
    {
        return view('admin.user.create');
    }
}
