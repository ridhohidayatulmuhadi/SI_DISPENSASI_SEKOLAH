<?php

namespace App\Http\Controllers;

use App\Models\JenisSurat;
use Illuminate\Http\Request;

class JenisSuratController extends Controller
{
    public function index()
    {
        $jenisSurat = JenisSurat::orderBy('nama')->get();
        return view('jenis-surat.index', compact('jenisSurat'));
    }

    public function create()
    {
        return view('jenis-surat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
        ]);

        JenisSurat::create($request->all());

        return redirect()->route('jenis-surat.index')
            ->with('success', 'Jenis surat berhasil ditambahkan');
    }

    public function edit(JenisSurat $jenisSurat)
    {
        return view('jenis-surat.edit', compact('jenisSurat'));
    }

    public function update(Request $request, JenisSurat $jenisSurat)
    {
        $request->validate([
            'nama' => 'required',
        ]);

        $jenisSurat->update($request->all());

        return redirect()->route('jenis-surat.index')
            ->with('success', 'Jenis surat berhasil diubah');
    }

    public function destroy(JenisSurat $jenisSurat)
    {
        $jenisSurat->delete();

        return redirect()->route('jenis-surat.index')
            ->with('success', 'Jenis surat berhasil dihapus');
    }
}
