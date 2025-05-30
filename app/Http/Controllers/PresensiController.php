<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presensi;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class PresensiController extends Controller
{
    public function index()
    {
        // Ambil data presensi untuk user yang login, urutkan berdasarkan tanggal terbaru
        $presensis = Presensi::with('user') // Eager load relasi user
                            ->where('id', Auth::id())
                            ->orderBy('tanggal_presensi', 'desc')
                            ->orderBy('jam_masuk', 'desc')
                            ->get();

        return view('presensi.presensi', compact('presensis'));
    }

    public function create()
    {
        return view('presensi.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jam_masuk' => 'required|date',
            'jam_keluar' => 'required|date|after:jam_masuk',
            'lokasi' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid.',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            Presensi::create([
                'user_id' => Auth::id(),
                'tanggal_presensi' => Carbon::parse($request->jam_masuk)->format('Y-m-d'),
                'jam_masuk' => Carbon::parse($request->jam_masuk)->format('H:i:s'),
                'jam_keluar' => Carbon::parse($request->jam_keluar)->format('H:i:s'),
                'lokasi' => $request->lokasi,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Presensi berhasil disimpan.'
            ]);
        } catch (\Exception $e) {
            \Log::error('Error saving presensi: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan presensi. Terjadi kesalahan server.'
            ], 500);
        }
    }
}
