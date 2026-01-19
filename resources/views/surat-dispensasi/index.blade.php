@extends('layouts.app')

@section('title', 'Surat Dispensasi')

@section('content')
<div class="space-y-6">
    <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex flex-col md:flex-row justify-between items-center gap-4">
        <div>
            <h1 class="text-2xl font-black text-gray-800 tracking-tight uppercase">Surat Dispensasi</h1>
            <p class="text-sm text-gray-500">Monitoring izin keluar masuk siswa secara real-time</p>
        </div>
        <a href="{{ route('surat-dispensasi.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-2xl font-bold transition-all shadow-lg shadow-blue-600/20 flex items-center gap-2">
            <i class="ti ti-plus text-lg"></i> Buat Surat Baru
        </a>
    </div>

    <div class="bg-white shadow-sm rounded-3xl border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50/50 text-gray-400 text-[10px] uppercase tracking-widest font-bold border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4 text-center">No</th>
                        <th class="px-6 py-4">Informasi Siswa</th>
                        <th class="px-6 py-4">Keperluan</th>
                        <th class="px-6 py-4">Waktu & Batas</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse ($surat as $s)
                        <tr class="hover:bg-blue-50/30 transition-colors group text-sm">
                            <td class="px-6 py-4 text-center font-medium text-gray-400">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col">
                                    <span class="font-bold text-gray-700 group-hover:text-blue-700">{{ optional($s->siswa)->nama ?? 'Siswa dihapus' }}</span>
                                    <span class="text-[10px] text-gray-400 uppercase font-semibold">
                                        {{ $s->siswa->kelas ?? '-' }} - {{ $s->siswa->jurusan->nama ?? '-' }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 bg-indigo-50 text-indigo-600 rounded-lg text-[11px] font-bold uppercase">
                                    {{ $s->jenisSurat->nama }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col leading-tight">
                                    <span class="text-gray-600 font-medium">{{ \Carbon\Carbon::parse($s->tanggal_mulai)->format('d M Y') }}</span>
                                    <span class="text-[11px] text-red-500 font-bold uppercase">Batas: {{ $s->waktu_kembali_batas ?? '--:--' }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @if ($s->statusTerakhir() === 'dispen')
                                    <span class="inline-flex items-center gap-1.5 py-1 px-3 rounded-full text-xs font-bold bg-amber-100 text-amber-600">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-600 animate-pulse"></span> Di Luar
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 py-1 px-3 rounded-full text-xs font-bold bg-emerald-100 text-emerald-600">
                                        <i class="ti ti-check text-sm"></i> Selesai
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center items-center gap-1">
                                    <a href="{{ route('surat-dispensasi.show', $s) }}" class="p-2 bg-gray-100 text-gray-600 hover:bg-gray-800 hover:text-white rounded-xl transition-all" title="Detail">
                                        <i class="ti ti-search text-lg"></i>
                                    </a>

                                    @if ($s->statusTerakhir() === 'dispen')
                                        <a href="{{ route('surat-dispensasi.edit', $s) }}" class="p-2 bg-amber-50 text-amber-600 hover:bg-amber-600 hover:text-white rounded-xl transition-all" title="Ubah">
                                            <i class="ti ti-edit text-lg"></i>
                                        </a>
                                    @else
                                        <span class="p-2 text-gray-300 cursor-not-allowed" title="Terkunci">
                                            <i class="ti ti-lock text-lg"></i>
                                        </span>
                                    @endif

                                    @if ($s->statusTerakhir() !== 'dispen')
                                        <form action="{{ route('surat-dispensasi.destroy', $s) }}" method="POST" class="inline form-hapus">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="p-2 bg-red-50 text-red-600 hover:bg-red-600 hover:text-white rounded-xl transition-all">
                                                <i class="ti ti-trash text-lg"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-20 text-center text-gray-400 italic">Belum ada data surat dispensasi hari ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('submit', function(e) {
            if (!e.target.classList.contains('form-hapus')) return;

            e.preventDefault();

            Swal.fire({
                title: 'Yakin?',
                text: 'Surat akan dihapus permanen',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    e.target.submit();
                }
            });
        });
    </script>
@endpush
