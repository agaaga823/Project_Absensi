<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PresensiController extends Controller
{
    public function index()
    {
        return view('presensi.presensi');
    }

    public function create()
{
    // Contoh data statis
    $jamMasuk = '08:50:25';
    $jamKeluar = '17:20:11';
    
    return view('presensi.create', compact('jamMasuk', 'jamKeluar'));
}
}
