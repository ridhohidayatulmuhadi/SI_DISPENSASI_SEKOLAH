@extends('layouts.app')

@section('title', 'Tambah Jurusan')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
            <div class="flex items-center gap-4 mb-8">
                <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center">
                    <i class="ti ti-plus text-2xl"></i>
                </div>
                <div>
                    <h2 class="text-xl font-black text-gray-800 uppercase tracking-tight">Tambah Jurusan Baru</h2>
                    <p class="text-sm text-gray-500">Input nama kompetensi keahlian baru</p>
                </div>
            </div>

            <form action="{{ route('jurusan.store') }}" method="POST">
                @csrf
                <div class="mb-8">
                    <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2 ml-1">Nama
                        Jurusan</label>
                    <input type="text" name="nama"
                        class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all @error('nama') border-red-500 @enderror"
                        placeholder="Contoh: Rekayasa Perangkat Lunak" value="{{ old('nama') }}" required autofocus>
                    @error('nama')
                        <p class="text-red-500 text-xs mt-2 ml-1 font-medium flex items-center gap-1">
                            <i class="ti ti-alert-circle"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-col sm:flex-row gap-3">
                    <button type="submit"
                        class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-2xl shadow-lg shadow-blue-600/20 transition-all flex items-center justify-center gap-2">
                        <i class="ti ti-device-floppy text-lg"></i> Simpan Data
                    </button>
                    <a href="{{ route('jurusan.index') }}"
                        class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold py-3 px-6 rounded-2xl transition-all text-center">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
