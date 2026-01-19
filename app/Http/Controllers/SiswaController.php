<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $kelas  = $request->kelas;

        $siswa = Siswa::query()
            ->when($search, function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('nis', 'like', "%{$search}%")
                    ->orWhereHas('jurusan', function ($q) use ($search) {
                        $q->where('nama', 'like', "%{$search}%");
                    });
            })
            ->when($kelas, function ($q) use ($kelas) {
                $q->where('kelas', $kelas); // FIX: exact match
            })
            ->orderBy('nama')
            ->paginate(10);

        // 🔥 INI KUNCI UTAMANYA
        if ($request->ajax()) {
            return view('siswa.partials.table', compact('siswa'))->render();
        }

        return view('siswa.index', compact('siswa'));
    }


    public function create()
    {
        return view('siswa.create', [
            'jurusans' => Jurusan::orderBy('nama')->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|unique:siswa,nis',
            'nama' => 'required',
            'kelas' => 'required|in:X,XI,XII',
            'jurusan_id' => 'required|exists:jurusans,id',
        ]);

        Siswa::create([
            'nis' => $request->nis,
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'jurusan_id' => $request->jurusan_id,
        ]);

        return redirect()->route('siswa.index')
            ->with('success', 'Data siswa berhasil ditambahkan');
    }

    public function edit(Siswa $siswa)
    {
        return view('siswa.edit', [
            'siswa'    => $siswa,
            'jurusans' => Jurusan::orderBy('nama')->get()
        ]);
    }

    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'nis' => 'required|unique:siswa,nis,' . $siswa->id,
            'nama' => 'required',
            'kelas' => 'required|in:X,XI,XII',
            'jurusan_id' => 'required|exists:jurusans,id',
        ]);

        $siswa->update([
            'nis' => $request->nis,
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'jurusan_id' => $request->jurusan_id,
        ]);


        return redirect()->route('siswa.index')
            ->with('success', 'Data siswa berhasil diubah');
    }

    public function destroy(Siswa $siswa)
    {
        $siswa->delete();

        return redirect()->route('siswa.index')
            ->with('success', 'Data siswa berhasil dihapus');
    }
}
