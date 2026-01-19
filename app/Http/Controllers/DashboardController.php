<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\JenisSurat;
use App\Models\SuratDispensasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'jumlahSiswa' => Siswa::count(),
            'jumlahJenisSurat' => JenisSurat::count(),
            'jumlahSurat' => SuratDispensasi::count(),
            // Ambil 5 dispensasi terbaru beserta log-nya
            'suratTerbaru' => SuratDispensasi::with(['siswa', 'jenisSurat', 'logs'])
                ->latest()
                ->take(5)
                ->get(),
        ];

        return view('dashboard', $data);
    }
}
