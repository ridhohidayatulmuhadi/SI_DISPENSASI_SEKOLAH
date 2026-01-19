<div class="overflow-x-auto">
    <table class="w-full text-left">
        <thead class="bg-gray-50/50 text-gray-400 text-[10px] uppercase tracking-widest font-bold border-b border-gray-100">
            <tr>
                <th class="px-6 py-4">Siswa</th>
                <th class="px-6 py-4">NIS</th>
                <th class="px-6 py-4 text-center">Kelas</th>
                <th class="px-6 py-4">Jurusan</th>
                <th class="px-6 py-4 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse ($siswa as $item)
                <tr class="hover:bg-blue-50/30 transition-colors group">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center font-bold text-xs shadow-sm">
                                {{ strtoupper(substr($item->nama, 0, 2)) }}
                            </div>
                            <span class="font-bold text-gray-700 group-hover:text-blue-700 transition-colors">{{ $item->nama }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500 font-mono">{{ $item->nis }}</td>
                    <td class="px-6 py-4 text-center">
                        <span class="bg-gray-100 text-gray-600 px-3 py-1 rounded-lg text-xs font-black uppercase">
                            {{ $item->kelas }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-sm font-medium text-gray-600 italic">
                            {{ $item->jurusan->nama }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex justify-center items-center gap-2">
                            <a href="{{ route('siswa.edit', $item->id) }}" 
                               class="p-2 bg-amber-50 text-amber-600 hover:bg-amber-600 hover:text-white rounded-xl transition-all">
                                <i class="ti ti-edit text-lg"></i>
                            </a>
                            <form method="POST" action="{{ route('siswa.destroy', $item->id) }}" class="delete-form inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 bg-red-50 text-red-600 hover:bg-red-600 hover:text-white rounded-xl transition-all">
                                    <i class="ti ti-trash text-lg"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-20 text-center">
                        <div class="flex flex-col items-center">
                            <i class="ti ti-users-minus text-6xl text-gray-200 mb-3"></i>
                            <p class="text-gray-400 font-medium">Data siswa tidak ditemukan</p>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($siswa->hasPages())
<div class="p-6 border-t border-gray-50">
    {{ $siswa->links() }}
</div>
@endif