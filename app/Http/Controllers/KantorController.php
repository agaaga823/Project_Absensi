<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KantorController extends Controller
{
    // Menampilkan form tambah lokasi kantor
    public function index()
    {
        return view('admin.office.kantor');
    }

    public function create()
    {
        return view('admin.office.create');
    }
}
