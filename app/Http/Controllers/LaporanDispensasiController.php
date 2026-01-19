<?php

namespace App\Http\Controllers;

use App\Exports\LaporanDispensasiExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\SuratDispensasi;
use Illuminate\Http\Request;
use App\Models\LogDispensasi;

class LaporanDispensasiController extends Controller
{
    public function index(Request $request)
    {
        $surat = SuratDispensasi::withTrashed()
            ->with(['siswa.jurusan', 'jenisSurat', 'logs'])
            ->whereHas('logs', function ($q) use ($request) {
                $q->where('status', 'dispen');

                if ($request->tanggal_dari) {
                    $q->whereDate('waktu', '>=', $request->tanggal_dari);
                }

                if ($request->tanggal_sampai) {
                    $q->whereDate('waktu', '<=', $request->tanggal_sampai);
                }
            })
            ->get()
            ->groupBy(function ($item) {
                return $item->siswa->kelas . '|' . $item->siswa->jurusan->nama;
            });

        return view('laporan.index', compact('surat'));
    }


    public function exportExcel()
    {
        return Excel::download(
            new LaporanDispensasiExport,
            'laporan-dispensasi.xlsx'
        );
    }
}
