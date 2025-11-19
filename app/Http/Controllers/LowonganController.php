<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lowongan;
use App\Models\Departemen;

class LowonganController extends Controller
{
    public function index()
    {
        $lowongans = Lowongan::with('departemen', 'creator', 'updater')->paginate(10);
        return view('lowongan.index', compact('lowongans'));
    }

    public function create()
    {
        $departemens = Departemen::all();
        return view('lowongan.create', compact('departemens'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'dept_id' => 'required|exists:master_departemen,id',
            'posisi' => 'required|string|max:255',
            'quota' => 'required|integer|min:1',
            'deskripsi' => 'required|string',
        ]);

        Lowongan::create([
            'dept_id' => $request->dept_id,
            'posisi' => $request->posisi,
            'quota' => $request->quota,
            'deskripsi' => $request->deskripsi,
            'user_create' => auth()->id(),
        ]);

        return redirect()->route('lowongan.index')->with('success', 'Lowongan berhasil ditambahkan!');
    }

    public function show(Lowongan $lowongan)
    {
        $lowongan->load('departemen', 'pendaftars');
        return view('lowongan.show', compact('lowongan'));
    }

    public function edit(Lowongan $lowongan)
    {
        $departemens = Departemen::all();
        return view('lowongan.edit', compact('lowongan', 'departemens'));
    }

    public function update(Request $request, Lowongan $lowongan)
    {
        $request->validate([
            'dept_id' => 'required|exists:master_departemen,id',
            'posisi' => 'required|string|max:255',
            'quota' => 'required|integer|min:1',
            'deskripsi' => 'required|string',
        ]);

        $lowongan->update([
            'dept_id' => $request->dept_id,
            'posisi' => $request->posisi,
            'quota' => $request->quota,
            'deskripsi' => $request->deskripsi,
            'user_update' => auth()->id(),
        ]);

        return redirect()->route('lowongan.index')->with('success', 'Lowongan berhasil diperbarui!');
    }

    public function destroy(Lowongan $lowongan)
    {
        $lowongan->delete();
        return redirect()->route('lowongan.index')->with('success', 'Lowongan berhasil dihapus!');
    }
}

