<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kantor;

class KantorController extends Controller
{
    public function index()
    {
        $kantors = Kantor::all();
        return view('admin.office.kantor', compact('kantors'));
    }

    public function create()
    {
        return view('admin.office.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'radius' => 'required|numeric',
        ]);

        Kantor::create($request->all());

        return redirect()->route('admin.kantor')->with('success', 'Lokasi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kantor = Kantor::findOrFail($id);
        return view('admin.office.edit', compact('kantor'));
    }

    public function update(Request $request, $id)
    {
        $kantor = Kantor::findOrFail($id);

        $request->validate([
            'nama' => 'required',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'radius' => 'required|numeric',
        ]);

        $kantor->update($request->all());

        return redirect()->route('admin.kantor')->with('success', 'Lokasi berhasil diupdate.');
    }

    public function destroy($id)
    {
        $kantor = Kantor::findOrFail($id);
        $kantor->delete();

        return redirect()->route('admin.kantor')->with('success', 'Lokasi berhasil dihapus.');
    }
}
