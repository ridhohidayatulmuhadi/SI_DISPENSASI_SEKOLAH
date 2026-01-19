@extends('layouts.app')

@section('title', 'Dashboard Overview')

@section('content')
    <div class="space-y-8">

        {{-- Welcome Header --}}
        <div
            class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-2xl font-black text-gray-800 uppercase tracking-tight">Selamat Datang, Admin 👋</h2>
                <p class="text-sm text-gray-500">Pantau pergerakan siswa dan status dispensasi secara real-time.</p>
            </div>
            <a href="{{ route('surat-dispensasi.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-2xl font-black transition-all flex items-center gap-2 w-fit shadow-lg shadow-blue-600/20 uppercase tracking-widest text-xs">
                <i class="ti ti-plus text-lg"></i>
                Buat Dispensasi Baru
            </a>
        </div>

        {{-- Stats Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            {{-- Total Siswa --}}
            <div
                class="bg-white p-6 rounded-[2rem] shadow-sm border border-gray-100 hover:border-blue-300 transition-all group">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Siswa</p>
                        <h3 class="text-3xl font-black text-gray-800 mt-1">{{ $jumlahSiswa }}</h3>
                    </div>
                    <div
                        class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center group-hover:bg-blue-600 group-hover:text-white transition-all">
                        <i class="ti ti-school text-2xl"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-[10px] font-bold text-gray-400 uppercase tracking-tighter">
                    <span class="text-blue-500 mr-1 italic">Total</span> siswa
                </div>
            </div>

            {{-- Jenis Surat --}}
            <div
                class="bg-white p-6 rounded-[2rem] shadow-sm border border-gray-100 hover:border-indigo-300 transition-all group">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Kategori</p>
                        <h3 class="text-3xl font-black text-gray-800 mt-1">{{ $jumlahJenisSurat }}</h3>
                    </div>
                    <div
                        class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center group-hover:bg-indigo-600 group-hover:text-white transition-all">
                        <i class="ti ti-mail-cog text-2xl"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-[10px] font-bold text-gray-400 uppercase tracking-tighter">
                    <span class="text-indigo-500 mr-1 italic">Jenis</span> surat izin
                </div>
            </div>

            {{-- Total Izin --}}
            <div
                class="bg-white p-6 rounded-[2rem] shadow-sm border border-gray-100 hover:border-amber-300 transition-all group">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Total Izin</p>
                        <h3 class="text-3xl font-black text-gray-800 mt-1">{{ $jumlahSurat }}</h3>
                    </div>
                    <div
                        class="w-12 h-12 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center group-hover:bg-amber-600 group-hover:text-white transition-all">
                        <i class="ti ti-history text-2xl"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-[10px] font-bold text-gray-400 uppercase tracking-tighter">
                    <span class="text-amber-500 mr-1 italic">Keseluruhan</span> riwayat
                </div>
            </div>

            {{-- Server Status --}}
            <div
                class="bg-white p-6 rounded-[2rem] shadow-sm border border-gray-100 hover:border-emerald-300 transition-all group">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Status</p>
                        <h3 class="text-xl font-black text-emerald-600 mt-1 uppercase tracking-tight italic">Terhubung</h3>
                    </div>
                    <div
                        class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center group-hover:bg-emerald-600 group-hover:text-white transition-all">
                        <i class="ti ti-access-point text-2xl animate-pulse"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-[10px] font-bold text-gray-400 uppercase tracking-tighter italic">
                    Local Offline Server V.1
                </div>
            </div>
        </div>

        {{-- Terbaru Table --}}
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-8 border-b border-gray-50 flex justify-between items-center bg-gray-50/50">
                <h3 class="font-black text-gray-800 uppercase tracking-widest text-sm flex items-center gap-3">
                    <span class="w-2 h-6 bg-blue-600 rounded-full"></span>
                    Dispensasi Terbaru
                </h3>
                <a href="{{ route('surat-dispensasi.index') }}"
                    class="text-xs text-blue-600 font-black uppercase tracking-tighter hover:bg-blue-50 px-4 py-2 rounded-xl transition-all">
                    Lihat Semua <i class="ti ti-arrow-narrow-right"></i>
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-white text-gray-400 text-[10px] uppercase tracking-[0.2em] font-black">
                        <tr>
                            <th class="px-8 py-5">Waktu Update</th>
                            <th class="px-8 py-5">Siswa & Kelas</th>
                            <th class="px-8 py-5">Keperluan</th>
                            <th class="px-8 py-5">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($suratTerbaru ?? [] as $item)
                            @php
                                $logTerakhir = $item->logs->sortByDesc('waktu')->first();
                                $status = $logTerakhir->status ?? 'unknown';

                                // Logika Terlambat
                                $waktuKembali = \Carbon\Carbon::parse($logTerakhir->waktu);
                                $batasWaktu = \Carbon\Carbon::parse($item->waktu_kembali_batas);
                                $isTerlambat = $status === 'kembali' && $waktuKembali->greaterThan($batasWaktu);
                            @endphp
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-8 py-5">
                                    <div class="text-sm font-bold text-gray-700">{{ $logTerakhir->waktu->diffForHumans() }}
                                    </div>
                                    <div class="text-[10px] text-gray-400 uppercase font-mono">
                                        {{ $logTerakhir->waktu->format('H:i') }} WIB</div>
                                </td>
                                <td class="px-8 py-5">
                                    <div class="font-black text-gray-800 uppercase text-sm leading-none">
                                        {{ $item->siswa->nama }}</div>
                                    <div class="text-[10px] text-gray-400 mt-1 font-bold italic">Kelas
                                        {{ $item->siswa->kelas }} {{ $item->siswa->jurusan->nama }}</div>
                                </td>
                                <td class="px-8 py-5 text-sm font-bold text-gray-500 italic">
                                    {{ $item->jenisSurat->nama }}
                                </td>
                                <td class="px-8 py-5">
                                    <div class="flex flex-col gap-1">
                                        @if ($status === 'dispen')
                                            <span
                                                class="w-fit px-3 py-1 bg-amber-100 text-amber-600 rounded-lg text-[10px] font-black uppercase tracking-tighter flex items-center gap-1">
                                                <span class="w-1.5 h-1.5 bg-amber-600 rounded-full animate-pulse"></span> Di
                                                Luar
                                            </span>
                                        @else
                                            <span
                                                class="w-fit px-3 py-1 bg-emerald-100 text-emerald-600 rounded-lg text-[10px] font-black uppercase tracking-tighter flex items-center gap-1">
                                                <i class="ti ti-check"></i> Kembali
                                            </span>
                                            @if ($isTerlambat)
                                                <span
                                                    class="text-[9px] font-black text-red-500 uppercase flex items-center gap-1">
                                                    <i class="ti ti-alert-triangle"></i> Terlambat!
                                                </span>
                                            @endif
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-8 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center opacity-30 grayscale">
                                        <i class="ti ti-mood-empty text-5xl mb-2"></i>
                                        <p class="text-xs font-black uppercase tracking-widest italic">Belum ada aktifitas
                                            hari ini</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
