<?php

namespace App\Http\Controllers;

use App\Models\SuratDispensasi;
use App\Models\Siswa;
use App\Models\JenisSurat;
use App\Models\LogDispensasi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class SuratDispensasiController extends Controller
{
    public function index()
    {
        $surat = SuratDispensasi::with(['siswa', 'jenisSurat'])
            ->orderByDesc('created_at')
            ->get();

        return view('surat-dispensasi.index', compact('surat'));
    }

    public function create()
    {
        $siswa = Siswa::all()->filter(fn($s) => !$s->masihDispen());
        $jenisSurat = JenisSurat::orderBy('nama')->get();

        return view('surat-dispensasi.create', compact('siswa', 'jenisSurat'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'siswa_id'               => 'required',
            'jenis_surat_id'         => 'required',
            'kembali_pelajaran_ke'   => 'required|integer|min:1|max:12',
            'waktu_kembali_batas' => 'required',
            'alasan'                 => 'required',
        ]);

        $siswa = Siswa::findOrFail($request->siswa_id);

        if ($siswa->masihDispen()) {
            return back()
                ->withInput()
                ->with('error', 'Siswa masih dalam status dispensasi dan belum kembali');
        }

        $surat = SuratDispensasi::create([
            'siswa_id'             => $request->siswa_id,
            'jenis_surat_id'       => $request->jenis_surat_id,
            'tanggal_mulai'        => now()->toDateString(),
            'kembali_pelajaran_ke' => $request->kembali_pelajaran_ke,
            'waktu_kembali_batas' => $request->waktu_kembali_batas,
            'alasan'               => $request->alasan,
        ]);

        $surat->logs()->create([
            'status'   => 'dispen',
            'waktu'    => now(),
            'catatan'  => 'Siswa mulai dispensasi',
        ]);


        return redirect()->route('surat-dispensasi.index')
            ->with('success', 'Surat dispensasi berhasil dibuat');
    }

    public function show(SuratDispensasi $suratDispensasi)
    {
        return view('surat-dispensasi.show', [
            'surat' => $suratDispensasi
        ]);
    }

    public function cetak(SuratDispensasi $suratDispensasi)
    {
        $suratDispensasi->load(['siswa', 'jenisSurat']);

        $pdf = Pdf::loadView(
            'surat-dispensasi.pdf',
            compact('suratDispensasi')
        )->setPaper('A4', 'portrait');

        return $pdf->stream('surat-dispensasi.pdf');
    }

    public function edit(SuratDispensasi $suratDispensasi)
    {
        $siswa = Siswa::orderBy('nama')->get();
        $jenisSurat = JenisSurat::orderBy('nama')->get();

        return view('surat-dispensasi.edit', compact(
            'suratDispensasi',
            'siswa',
            'jenisSurat'
        ));
    }

    public function update(Request $request, SuratDispensasi $suratDispensasi)
    {
        $request->validate([
            'siswa_id'         => 'required',
            'jenis_surat_id'   => 'required',
            'waktu_kembali_batas'    => 'required',
            'alasan'           => 'required',
        ]);

        $suratDispensasi->update([
            'siswa_id'             => $request->siswa_id,
            'jenis_surat_id'       => $request->jenis_surat_id,
            'kembali_pelajaran_ke' => $request->kembali_pelajaran_ke,
            'alasan'               => $request->alasan,
        ]);


        return redirect()
            ->route('surat-dispensasi.index')
            ->with('success', 'Surat dispensasi berhasil diperbarui');
    }

    public function kembali(SuratDispensasi $surat)
    {
        $batas = \Carbon\Carbon::parse(
            $surat->tanggal_mulai . ' ' . $surat->waktu_kembali_batas
        );

        $terlambat = now()->greaterThan($batas);

        $surat->logs()->create([
            'status' => 'kembali',
            'waktu'  => now(),
            'catatan' => $terlambat
                ? 'Siswa kembali ke sekolah (TERLAMBAT)'
                : 'Siswa kembali ke sekolah',
        ]);

        return back()->with('success', 'Siswa ditandai telah kembali');
    }

    public function destroy(SuratDispensasi $suratDispensasi)
    {
        // TIDAK MENGIZINKAN HAPUS SAAT MASIH DISPEN
        if ($suratDispensasi->statusTerakhir() === 'dispen') {
            return back()->with('error', 'Tidak bisa menghapus surat yang masih DISPEN');
        }

        $suratDispensasi->delete();

        return redirect()
            ->route('surat-dispensasi.index')
            ->with('success', 'Surat dispensasi berhasil dihapus');
    }
}
