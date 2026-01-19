@extends('layouts.app')

@section('title', 'Data Jurusan')

@section('content')
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-50 flex justify-between items-center bg-white">
            <div>
                <h2 class="text-xl font-black text-gray-800 tracking-tight">DATA JURUSAN</h2>
                <p class="text-sm text-gray-500">Kelola daftar kompetensi keahlian sekolah</p>
            </div>
            <a href="{{ route('jurusan.create') }}"
                class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl font-bold transition-all shadow-lg shadow-blue-600/20 flex items-center gap-2 text-sm">
                <i class="ti ti-plus text-lg"></i> Tambah Jurusan
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50/50 text-gray-400 text-[10px] uppercase tracking-widest font-bold">
                    <tr>
                        <th class="px-6 py-4 text-center w-20">No</th>
                        <th class="px-6 py-4">Nama Jurusan</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse ($jurusan as $item)
                        <tr class="hover:bg-blue-50/50 transition-colors group">
                            <td class="px-6 py-4 text-center text-sm font-medium text-gray-500">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-bold text-gray-700 group-hover:text-blue-700 transition-colors">
                                    {{ $item->nama }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center items-center gap-2">
                                    <a href="{{ route('jurusan.edit', $item) }}"
                                        class="p-2 bg-amber-50 text-amber-600 hover:bg-amber-600 hover:text-white rounded-xl transition-all duration-200"
                                        title="Edit Jurusan">
                                        <i class="ti ti-edit text-lg"></i>
                                    </a>

                                    <form action="{{ route('jurusan.destroy', $item) }}" method="POST"
                                        class="inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="p-2 bg-red-50 text-red-600 hover:bg-red-600 hover:text-white rounded-xl transition-all duration-200"
                                            title="Hapus Jurusan">
                                            <i class="ti ti-trash text-lg"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <i class="ti ti-folder-off text-5xl text-gray-200 mb-2"></i>
                                    <p class="text-gray-400 font-medium">Belum ada data jurusan</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
