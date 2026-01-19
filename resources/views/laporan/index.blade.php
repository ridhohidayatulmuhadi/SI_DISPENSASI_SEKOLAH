@extends('layouts.app')

@section('title', 'Laporan Histori Dispensasi')

@section('content')
    <div class="space-y-6">
        {{-- Header & Filter Card --}}
        <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 p-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
                <div>
                    <h2 class="text-2xl font-black text-gray-800 uppercase tracking-tight">Laporan Dispensasi</h2>
                    <p class="text-sm text-gray-500">Rekapitulasi histori izin keluar masuk siswa</p>
                </div>

                {{-- iki export-excel masih eror --}}
                {{-- <a href="{{ route('laporan-dispensasi.export-excel', request()->all()) }}"
                    class="flex items-center gap-2 px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white rounded-2xl font-bold transition-all shadow-lg shadow-emerald-600/20 text-sm">
                    <i class="ti ti-file-spreadsheet text-lg"></i> Export Excel
                </a> --}}
            </div>

            {{-- Filter Form --}}
            <form method="GET" class="flex flex-wrap gap-4 p-6 bg-gray-50 rounded-3xl border border-gray-100">
                <div class="flex-1 min-w-[200px]">
                    <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2 ml-1">Dari
                        Tanggal</label>
                    <input type="date" name="tanggal_dari" value="{{ request('tanggal_dari') }}"
                        class="w-full border-none bg-white rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 transition-all shadow-sm">
                </div>

                <div class="flex-1 min-w-[200px]">
                    <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2 ml-1">Sampai
                        Tanggal</label>
                    <input type="date" name="tanggal_sampai" value="{{ request('tanggal_sampai') }}"
                        class="w-full border-none bg-white rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 transition-all shadow-sm">
                </div>

                <div class="flex items-end gap-2">
                    <button type="submit"
                        class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-bold text-sm transition-all shadow-md shadow-blue-600/10">
                        Filter
                    </button>
                    <a href="{{ route('laporan.dispensasi') }}"
                        class="px-6 py-2 bg-white hover:bg-gray-100 text-gray-600 border border-gray-200 rounded-xl font-bold text-sm transition-all">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        {{-- Data List --}}
        <div class="space-y-8">
            @forelse ($surat as $group => $items)
                @php
                    [$kelas, $jurusan] = explode('|', $group);
                @endphp

                <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
                    {{-- Group Header --}}
                    <div class="bg-gray-800 px-8 py-4 flex justify-between items-center">
                        <h3 class="text-white font-bold tracking-widest uppercase text-sm">
                            Kelas {{ $kelas }} <span class="text-gray-400 mx-2">|</span> {{ $jurusan }}
                        </h3>
                        <span class="bg-gray-700 text-gray-300 px-3 py-1 rounded-lg text-xs font-mono">
                            {{ count($items) }} Records
                        </span>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-gray-50">
                                    <th class="px-8 py-4 text-xs font-bold uppercase text-gray-400">No</th>
                                    <th class="px-4 py-4 text-xs font-bold uppercase text-gray-400">Nama Siswa</th>
                                    <th class="px-4 py-4 text-xs font-bold uppercase text-gray-400">Jenis</th>
                                    <th class="px-4 py-4 text-xs font-bold uppercase text-gray-400">Status Terakhir</th>
                                    <th class="px-4 py-4 text-xs font-bold uppercase text-gray-400">Waktu Log</th>
                                    <th class="px-4 py-4 text-xs font-bold uppercase text-gray-400">Keterangan</th>
                                    <th class="px-8 py-4 text-xs font-bold uppercase text-gray-400 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @foreach ($items as $i => $item)
                                    @php
                                        $logTerakhir = $item->logs->sortByDesc('waktu')->first();
                                        $status = $logTerakhir->status ?? 'unknown';

                                        // Logika Terlambat
                                        $waktuKembali = \Carbon\Carbon::parse($logTerakhir->waktu);
                                        $batasWaktu = \Carbon\Carbon::parse($item->waktu_kembali_batas);
                                        $isTerlambat = $status === 'kembali' && $waktuKembali->greaterThan($batasWaktu);
                                    @endphp
                                    <tr
                                        class="hover:bg-gray-50/50 transition-colors {{ $isTerlambat ? 'bg-red-50/30' : '' }}">
                                        <td class="px-8 py-4 text-sm text-gray-400 font-mono">{{ $i + 1 }}</td>
                                        <td class="px-4 py-4">
                                            <div class="font-bold text-gray-800 uppercase text-sm leading-none">
                                                {{ $item->siswa->nama }}</div>
                                            <div class="text-[10px] text-gray-400 mt-1 font-mono italic">
                                                {{ $item->siswa->nis }}</div>
                                        </td>
                                        <td class="px-4 py-4">
                                            <span
                                                class="text-xs font-semibold px-2 py-1 bg-blue-50 text-blue-600 rounded-lg">
                                                {{ $item->jenisSurat->nama }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-4">
                                            <div class="flex flex-col gap-1">
                                                @if ($status === 'dispen')
                                                    <span
                                                        class="inline-flex items-center gap-1.5 py-1 px-3 rounded-full text-xs font-bold bg-amber-100 text-amber-600 w-fit">
                                                        <span
                                                            class="w-1.5 h-1.5 rounded-full bg-amber-600 animate-pulse"></span>
                                                        Sedang Di Luar
                                                    </span>
                                                @else
                                                    <span
                                                        class="inline-flex items-center gap-1.5 py-1 px-3 rounded-full text-xs font-bold bg-emerald-100 text-emerald-600 w-fit">
                                                        <i class="ti ti-check text-sm"></i>
                                                        Sudah Kembali
                                                    </span>

                                                    @if ($isTerlambat)
                                                        <span
                                                            class="text-[10px] font-black text-red-500 uppercase tracking-tighter ml-1">
                                                            <i class="ti ti-alert-triangle"></i> Terlambat
                                                            {{ $waktuKembali->diffForHumans($batasWaktu, true) }}
                                                        </span>
                                                    @endif
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-4 py-4 text-xs text-gray-600 leading-tight">
                                            {{ $logTerakhir->waktu->translatedFormat('d M Y') }}<br>
                                            <span
                                                class="font-bold text-gray-400 font-mono text-[10px] uppercase">{{ $logTerakhir->waktu->format('H:i') }}
                                                WIB</span>
                                        </td>
                                        {{-- Kolom Keterangan: Dibuat full (tanpa truncate) --}}
                                        <td class="px-4 py-4 text-xs text-gray-500 italic leading-relaxed min-w-[200px]">
                                            {{ $logTerakhir->catatan ?? '-' }}
                                        </td>
                                        <td class="px-8 py-4 text-center">
                                            @if ($status === 'dispen')
                                                <form action="{{ route('surat-dispensasi.kembali', $item) }}"
                                                    method="POST" class="form-kembali">
                                                    @csrf
                                                    <button type="submit"
                                                        class="p-2 bg-white border border-green-200 text-green-600 hover:bg-green-600 hover:text-white rounded-xl transition-all shadow-sm"
                                                        title="Tandai Sudah Kembali">
                                                        <i class="ti ti-door-enter text-lg"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <div
                                                    class="w-10 h-10 mx-auto flex items-center justify-center bg-gray-50 text-gray-300 rounded-xl">
                                                    <i
                                                        class="ti ti-circle-check text-xl {{ $isTerlambat ? 'text-red-300' : '' }}"></i>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-[2rem] p-16 text-center border-2 border-dashed border-gray-100">
                    <div
                        class="w-20 h-20 bg-gray-50 text-gray-300 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="ti ti-database-off text-4xl"></i>
                    </div>
                    <h3 class="text-gray-400 font-bold uppercase tracking-widest italic">Tidak ada data ditemukan</h3>
                </div>
            @endforelse
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('submit', function(e) {
            if (!e.target.classList.contains('form-kembali')) return;
            e.preventDefault();
            Swal.fire({
                title: 'Konfirmasi Kembali',
                text: 'Tandai siswa ini telah kembali ke lingkungan sekolah?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Sudah Kembali',
                confirmButtonColor: '#16a34a',
                cancelButtonColor: '#6b7280',
                customClass: {
                    popup: 'rounded-[2rem]',
                    confirmButton: 'rounded-xl px-6 py-3 font-bold',
                    cancelButton: 'rounded-xl px-6 py-3 font-bold'
                }
            }).then((result) => {
                if (result.isConfirmed) e.target.submit();
            });
        });
    </script>
@endpush
