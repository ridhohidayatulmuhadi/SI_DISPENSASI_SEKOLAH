@extends('layouts.app')

@section('title', 'Preview Surat Dispensasi')

@section('content')
    <div class="max-w-4xl mx-auto space-y-6">
        <div class="flex justify-between items-center bg-white p-4 rounded-2xl shadow-sm border border-gray-100">
            <a href="{{ route('surat-dispensasi.index') }}"
                class="flex items-center gap-2 text-gray-500 hover:text-gray-800 font-bold px-4 py-2 transition-all">
                <i class="ti ti-arrow-left text-lg"></i> Kembali
            </a>

            <div class="flex gap-3">
                @if ($surat->statusTerakhir() === 'dispen')
                    <a href="{{ route('surat-dispensasi.edit', $surat) }}"
                        class="flex items-center gap-2 bg-amber-50 text-amber-600 hover:bg-amber-600 hover:text-white px-5 py-2 rounded-xl font-bold transition-all border border-amber-200">
                        <i class="ti ti-edit text-lg"></i> Ubah Data
                    </a>
                @endif

                <a href="{{ route('surat-dispensasi.cetak', $surat) }}" target="_blank"
                    class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-xl font-bold transition-all shadow-lg shadow-blue-600/20">
                    <i class="ti ti-printer text-lg"></i> Cetak PDF
                </a>
            </div>
        </div>

        <div
            class="bg-white p-12 md:p-16 rounded-[2rem] shadow-xl border border-gray-50 relative overflow-hidden min-h-[800px]">
            {{-- Watermark Status --}}
            <div class="absolute top-10 right-[-40px] rotate-45">
                @if ($surat->statusTerakhir() === 'dispen')
                    <span
                        class="bg-amber-100 text-amber-600 px-12 py-1 font-black text-xs uppercase tracking-widest border border-amber-200">Siswa
                        Di Luar</span>
                @else
                    <span
                        class="bg-emerald-100 text-emerald-600 px-12 py-1 font-black text-xs uppercase tracking-widest border border-emerald-200">Sudah
                        Kembali</span>
                @endif
            </div>

            {{-- Kop Surat --}}
            <div class="text-center border-b-4 border-double border-gray-800 pb-6 mb-10">
                <h1 class="text-2xl font-black uppercase tracking-tighter text-gray-900">SMK NEGERI 2 MOJOKERTO</h1>
                <p class="text-sm text-gray-600 italic">
                    Jl. Raya Pulo Rejo, Kota Mojokerto, Jawa Timur<br>
                    <span class="not-italic">Telp. (0321) 123456 • Website: smkn2mojokerto.sch.id</span>
                </p>
            </div>

            {{-- Judul Surat --}}
            <div class="text-center mb-10">
                <h2 class="text-xl font-bold uppercase underline decoration-2 underline-offset-4">SURAT DISPENSASI</h2>
                <p class="text-sm font-mono mt-1 text-gray-500">Nomor: {{ $surat->id }}/DISP/SMK2/{{ date('Y') }}</p>
            </div>

            {{-- Narasi Pembuka --}}
            <p class="text-gray-800 leading-relaxed mb-6">
                Yang bertanda tangan di bawah ini, menerangkan dengan sebenarnya bahwa:
            </p>

            {{-- Identitas Siswa --}}
            <div class="bg-gray-50/50 p-6 rounded-2xl mb-8 border border-gray-100">
                <table class="w-full text-gray-800">
                    <tr class="h-8">
                        <td class="w-1/3 font-medium text-gray-500 uppercase text-xs tracking-wider">Nama Lengkap</td>
                        <td class="w-4">:</td>
                        <td class="font-bold text-lg uppercase">{{ $surat->siswa->nama ?? 'Siswa Tidak Ditemukan' }}</td>
                    </tr>
                    <tr class="h-8">
                        <td class="text-gray-500 uppercase text-xs tracking-wider font-medium">Nomor Induk Siswa</td>
                        <td>:</td>
                        <td class="font-mono">{{ $surat->siswa->nis ?? '-' }}</td>
                    </tr>
                    <tr class="h-8">
                        <td class="text-gray-500 uppercase text-xs tracking-wider font-medium">Kelas / Jurusan</td>
                        <td>:</td>
                        <td class="font-bold uppercase text-blue-700">{{ $surat->siswa->kelas ?? '-' }}
                            {{ $surat->siswa->jurusan->nama ?? '-' }}</td>
                    </tr>
                </table>
            </div>

            {{-- Isi Perizinan --}}
            <div class="space-y-4 text-gray-800 leading-relaxed text-justify mb-10">
                <p>
                    Adalah benar siswa tersebut diberikan izin dispensasi untuk keperluan
                    <span class="font-bold px-1 bg-yellow-100 uppercase">{{ $surat->jenisSurat->nama }}</span>
                    pada tanggal <span
                        class="font-bold uppercase">{{ \Carbon\Carbon::parse($surat->tanggal_mulai)->translatedFormat('d F Y') }}</span>.
                </p>
                <p>
                    Siswa yang bersangkutan diwajibkan kembali mengikuti kegiatan belajar mengajar pada
                    <span class="font-bold uppercase underline">jam pelajaran ke-{{ $surat->kembali_pelajaran_ke }}</span>
                    dengan batas waktu maksimal pukul <span
                        class="font-bold">{{ \Carbon\Carbon::parse($surat->waktu_kembali_batas)->format('H:i') }}
                        WIB</span>.
                </p>

                <div class="mt-4 p-4 border-l-4 border-gray-200 italic bg-gray-50 text-gray-600">
                    "{{ $surat->alasan }}"
                </div>
            </div>

            {{-- Penutup & TTD --}}
            <div class="grid grid-cols-2 gap-4 mt-16">
                <div class="text-center">
                    {{-- Area Kosong untuk paraf piket/keamanan jika perlu --}}
                </div>
                <div class="text-center flex flex-col items-center">
                    <p class="text-gray-700">Mojokerto, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                    <p class="font-bold mt-1 text-xs uppercase tracking-widest">Mengetahui,</p>
                    <div class="h-24"></div> {{-- Space TTD --}}
                    <p class="font-black underline uppercase text-gray-900 leading-none">Kepala Tata Usaha</p>
                    <p class="text-[10px] text-gray-500 mt-1 uppercase font-mono tracking-tighter">NIP. 19820304 201001 1
                        012</p>
                </div>
            </div>
        </div>
    </div>
@endsection
