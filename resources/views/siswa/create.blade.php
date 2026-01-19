@extends('layouts.app')

@section('title', 'Tambah Siswa')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
        <div class="flex items-center gap-4 mb-8">
            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center">
                <i class="ti ti-user-plus text-2xl"></i>
            </div>
            <div>
                <h2 class="text-xl font-black text-gray-800 uppercase tracking-tight">Tambah Siswa Baru</h2>
                <p class="text-sm text-gray-500">Daftarkan siswa baru ke dalam sistem dispensasi</p>
            </div>
        </div>

        <form action="{{ route('siswa.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- NIS --}}
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2 ml-1">NIS (Nomor Induk Siswa)</label>
                    <input type="text" name="nis" value="{{ old('nis') }}" 
                           placeholder="Contoh: 12345"
                           class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all @error('nis') border-red-500 @enderror">
                    @error('nis') <p class="text-red-500 text-[10px] mt-1 ml-1 font-bold">{{ $message }}</p> @enderror
                </div>

                {{-- Nama --}}
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2 ml-1">Nama Lengkap</label>
                    <input type="text" name="nama" value="{{ old('nama') }}"
                           placeholder="Masukkan nama siswa"
                           class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all @error('nama') border-red-500 @enderror">
                    @error('nama') <p class="text-red-500 text-[10px] mt-1 ml-1 font-bold">{{ $message }}</p> @enderror
                </div>

                {{-- Kelas --}}
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2 ml-1">Tingkat Kelas</label>
                    <select name="kelas" class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all appearance-none cursor-pointer">
                        <option value="">Pilih Kelas</option>
                        @foreach (['X', 'XI', 'XII'] as $k)
                            <option value="{{ $k }}" @selected(old('kelas') == $k)>Kelas {{ $k }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Jurusan --}}
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2 ml-1">Kompetensi Keahlian</label>
                    <select name="jurusan_id" class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all appearance-none cursor-pointer">
                        <option value="">Pilih Jurusan</option>
                        @foreach ($jurusans as $j)
                            <option value="{{ $j->id }}" @selected(old('jurusan_id') == $j->id)>{{ $j->nama }}</option>
                        @endforeach
                    </select>
                    @error('jurusan_id') <p class="text-red-500 text-[10px] mt-1 ml-1 font-bold">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-50">
                <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-2xl shadow-lg shadow-blue-600/20 transition-all flex items-center justify-center gap-2 text-sm uppercase tracking-wider">
                    <i class="ti ti-device-floppy text-lg"></i> Simpan Data
                </button>
                <a href="{{ route('siswa.index') }}" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold py-4 rounded-2xl transition-all text-center text-sm uppercase tracking-wider">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection