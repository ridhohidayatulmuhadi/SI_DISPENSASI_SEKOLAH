@extends('layouts.app')

@section('title', 'Jenis Surat')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">
    <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex flex-col md:flex-row justify-between items-center gap-4">
        <div>
            <h1 class="text-2xl font-black text-gray-800 tracking-tight uppercase">Jenis Surat</h1>
            <p class="text-sm text-gray-500">Kategori surat dispensasi yang tersedia</p>
        </div>

        <a href="{{ route('jenis-surat.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-2xl font-bold transition-all shadow-lg shadow-blue-600/20 flex items-center gap-2">
            <i class="ti ti-plus text-lg"></i> Tambah Kategori
        </a>
    </div>

    <div class="bg-white shadow-sm rounded-3xl border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50/50 text-gray-400 text-[10px] uppercase tracking-widest font-bold border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4">Nama Surat</th>
                        <th class="px-6 py-4">Deskripsi</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse ($jenisSurat as $item)
                        <tr class="hover:bg-blue-50/30 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center">
                                        <i class="ti ti-mail text-xl"></i>
                                    </div>
                                    <span class="font-bold text-gray-700 group-hover:text-blue-700 transition-colors">{{ $item->nama }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-gray-500 line-clamp-1 italic">
                                    {{ $item->deskripsi ?? 'Tidak ada deskripsi' }}
                                </p>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center items-center gap-2">
                                    <a href="{{ route('jenis-surat.edit', $item->id) }}"
                                       class="p-2 bg-amber-50 text-amber-600 hover:bg-amber-600 hover:text-white rounded-xl transition-all">
                                        <i class="ti ti-edit text-lg"></i>
                                    </a>

                                    <form action="{{ route('jenis-surat.destroy', $item->id) }}" method="POST" class="inline"
                                          onsubmit="return confirmDelete(this)">
                                        @csrf
                                        @method('DELETE')
                                        <button class="p-2 bg-red-50 text-red-600 hover:bg-red-600 hover:text-white rounded-xl transition-all">
                                            <i class="ti ti-trash text-lg"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-20 text-center text-gray-400">
                                <i class="ti ti-mail-off text-5xl mb-2 block"></i>
                                Belum ada data jenis surat
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function confirmDelete(form) {
        Swal.fire({
            title: 'Hapus Kategori?',
            text: 'Ini akan memengaruhi data surat yang sudah ada.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#ef4444',
            borderRadius: '1.5rem'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
        return false;
    }
</script>
@endsection