<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function index()
    {
        $jurusan = Jurusan::orderBy('nama')->get();
        return view('jurusan.index', compact('jurusan'));
    }

    public function create()
    {
        return view('jurusan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100|unique:jurusans,nama',
        ]);

        Jurusan::create([
            'nama' => $request->nama,
        ]);

        return redirect()
            ->route('jurusan.index')
            ->with('success', 'Jurusan berhasil ditambahkan');
    }

    public function edit(Jurusan $jurusan)
    {
        return view('jurusan.edit', compact('jurusan'));
    }

    public function update(Request $request, Jurusan $jurusan)
    {
        $request->validate([
            'nama' => 'required|string|max:100|unique:jurusans,nama,' . $jurusan->id,
        ]);

        $jurusan->update([
            'nama' => $request->nama,
        ]);

        return redirect()
            ->route('jurusan.index')
            ->with('success', 'Jurusan berhasil diupdate');
    }

    public function destroy(Jurusan $jurusan)
    {
        if ($jurusan->siswa()->exists()) {
            return back()->with('error', 'Jurusan masih dipakai oleh siswa');
        }

        $jurusan->delete();

        return back()->with('success', 'Jurusan berhasil dihapus');
    }
}
