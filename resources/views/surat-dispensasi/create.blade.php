@extends('layouts.app')

@section('title', 'Buat Dispensasi')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
            <div class="flex items-center gap-4 mb-8">
                <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center">
                    <i class="ti ti-file-plus text-2xl"></i>
                </div>
                <div>
                    <h2 class="text-xl font-black text-gray-800 uppercase tracking-tight">Form Surat Dispensasi</h2>
                    <p class="text-sm text-gray-500">Input data siswa yang akan meninggalkan jam pelajaran</p>
                </div>
            </div>

            <form action="{{ route('surat-dispensasi.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Siswa dengan TomSelect --}}
                    <div class="md:col-span-2">
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2 ml-1">Cari Nama
                            Siswa</label>
                        <select name="siswa_id" id="siswa-select" class="w-full">
                            <option value="">Ketik nama siswa...</option>
                            @foreach ($siswa as $item)
                                <option value="{{ $item->id }}" data-kelas="{{ $item->kelas }}"
                                    data-jurusan="{{ $item->jurusan->nama }}">
                                    {{ $item->nama }} ({{ $item->nis }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Read Only Info --}}
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2 ml-1">Tingkat
                            Kelas</label>
                        <input type="text" id="kelas" readonly
                            class="w-full bg-gray-100 border-none rounded-2xl px-4 py-3 text-gray-500 font-bold italic">
                    </div>
                    <div>
                        <label
                            class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2 ml-1">Jurusan</label>
                        <input type="text" id="jurusan" readonly
                            class="w-full bg-gray-100 border-none rounded-2xl px-4 py-3 text-gray-500 font-bold italic">
                    </div>

                    <hr class="md:col-span-2 border-gray-50">

                    {{-- Detail Izin --}}
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2 ml-1">Jenis
                            Keperluan</label>
                        <select name="jenis_surat_id"
                            class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-4 py-3 appearance-none cursor-pointer">
                            <option value="">Pilih Keperluan</option>
                            @foreach ($jenisSurat as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label
                                class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2 ml-1">Pelajaran
                                Ke</label>
                            <select name="kembali_pelajaran_ke"
                                class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-4 py-3">
                                @for ($i = 1; $i <= 10; $i++)
                                    <option value="{{ $i }}">Jam Ke-{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2 ml-1">Batas
                                Waktu</label>
                            <input type="time" name="waktu_kembali_batas"
                                class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-4 py-3">
                        </div>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2 ml-1">Alasan
                            Detail</label>
                        <textarea name="alasan" rows="3" placeholder="Tulis alasan lebih lengkap di sini..."
                            class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-4 py-3 focus:ring-4 focus:ring-blue-500/10 transition-all"></textarea>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-4 pt-6">
                    <button type="submit"
                        class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-black py-4 rounded-2xl shadow-lg shadow-blue-600/20 transition-all uppercase tracking-widest text-sm">
                        Konfirmasi & Cetak
                    </button>
                    <a href="{{ route('surat-dispensasi.index') }}"
                        class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold py-4 rounded-2xl transition-all text-center uppercase tracking-widest text-sm">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        new TomSelect('#siswa-select', {
            placeholder: 'Cari nama siswa...',
            allowEmptyOption: true,
            create: false,
            maxItems: 1,

            searchField: ['text'], // WAJIB
            sortField: {
                field: 'text',
                direction: 'asc'
            },

            selectOnTab: false,
            closeAfterSelect: true,
            hideSelected: true,
            dropdownParent: 'body'
        });

        // AUTO PILIH KELAS DAN JURUSAN
        const siswaSelect = document.getElementById('siswa-select');
        const kelasInput = document.getElementById('kelas');
        const jurusanInput = document.getElementById('jurusan');

        siswaSelect.addEventListener('change', function() {
            const option = siswaSelect.options[siswaSelect.selectedIndex];
            kelasInput.value = option.getAttribute('data-kelas') || '';
            jurusanInput.value = option.getAttribute('data-jurusan') || '';
        });
    </script>
@endpush
