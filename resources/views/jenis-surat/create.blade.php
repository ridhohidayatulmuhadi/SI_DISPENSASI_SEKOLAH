@extends('layouts.app')

@section('title', 'Tambah Jenis Surat')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
        <div class="flex items-center gap-4 mb-8">
            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center">
                <i class="ti ti-mail-plus text-2xl"></i>
            </div>
            <div>
                <h2 class="text-xl font-black text-gray-800 uppercase tracking-tight">Tambah Jenis Surat</h2>
                <p class="text-sm text-gray-500">Definisikan kategori keperluan dispensasi baru</p>
            </div>
        </div>

        <form action="{{ route('jenis-surat.store') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2 ml-1">Nama Jenis Surat</label>
                <input type="text" name="nama" value="{{ old('nama') }}" required autofocus
                       placeholder="Contoh: Dispensasi Lomba / Organisasi"
                       class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all @error('nama') border-red-500 @enderror">
                @error('nama') <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2 ml-1">Deskripsi Singkat</label>
                <textarea name="deskripsi" rows="3"
                          placeholder="Jelaskan penggunaan kategori surat ini..."
                          class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all">{{ old('deskripsi') }}</textarea>
            </div>

            <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-gray-50">
                <button class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-2xl shadow-lg shadow-blue-600/20 transition-all flex items-center justify-center gap-2">
                    <i class="ti ti-device-floppy text-lg"></i> Simpan Kategori
                </button>
                <a href="{{ route('jenis-surat.index') }}" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold py-4 rounded-2xl transition-all text-center">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection