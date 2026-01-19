@extends('layouts.app')

@section('title', 'Ubah Surat Dispensasi')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 p-8">
        
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center">
                    <i class="ti ti-edit text-2xl"></i>
                </div>
                <div>
                    <h2 class="text-xl font-black text-gray-800 uppercase tracking-tight">Ubah Dispensasi</h2>
                    <p class="text-sm text-gray-500">Sesuaikan data izin atau batas waktu kembali</p>
                </div>
            </div>
            
            @if($suratDispensasi->statusTerakhir() === 'kembali')
                <span class="bg-emerald-100 text-emerald-600 px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-widest border border-emerald-200">
                    Siswa Sudah Kembali
                </span>
            @endif
        </div>

        <form action="{{ route('surat-dispensasi.update', $suratDispensasi) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Siswa (Disabled/Readonly dalam edit biasanya lebih aman) --}}
                <div class="md:col-span-2">
                    <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2 ml-1">Nama Siswa</label>
                    <select name="siswa_id" id="siswa-select" class="w-full">
                        @foreach ($siswa as $item)
                            <option value="{{ $item->id }}" 
                                data-kelas="{{ $item->kelas }}"
                                data-jurusan="{{ $item->jurusan->nama }}"
                                {{ old('siswa_id', $suratDispensasi->siswa_id) == $item->id ? 'selected' : '' }}>
                                {{ $item->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Informasi Kelas & Jurusan (Auto-filled) --}}
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2 ml-1">Kelas</label>
                    <input id="kelas" type="text" value="{{ $suratDispensasi->siswa->kelas }}" readonly
                        class="w-full bg-gray-100 border-none rounded-2xl px-4 py-3 text-gray-500 font-bold italic">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2 ml-1">Jurusan</label>
                    <input id="jurusan" type="text" value="{{ $suratDispensasi->siswa->jurusan->nama }}" readonly
                        class="w-full bg-gray-100 border-none rounded-2xl px-4 py-3 text-gray-500 font-bold italic">
                </div>

                <hr class="md:col-span-2 border-gray-50">

                {{-- Pengaturan Waktu --}}
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2 ml-1">Jenis Keperluan</label>
                    <select name="jenis_surat_id" class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-4 py-3 focus:ring-4 focus:ring-blue-500/10 transition-all appearance-none">
                        @foreach ($jenisSurat as $item)
                            <option value="{{ $item->id }}"
                                {{ old('jenis_surat_id', $suratDispensasi->jenis_surat_id) == $item->id ? 'selected' : '' }}>
                                {{ $item->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2 ml-1">Jam Kembali</label>
                        <select name="kembali_pelajaran_ke" class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-4 py-3">
                            @for ($i = 1; $i <= 10; $i++)
                                <option value="{{ $i }}" {{ old('kembali_pelajaran_ke', $suratDispensasi->kembali_pelajaran_ke) == $i ? 'selected' : '' }}>
                                    Ke-{{ $i }}
                                </option>
                            @endfor
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2 ml-1">Batas Pukul</label>
                        <input type="time" name="waktu_kembali_batas"
                            value="{{ old('waktu_kembali_batas', $suratDispensasi->waktu_kembali_batas) }}"
                            class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-4 py-3 {{ $suratDispensasi->statusTerakhir() === 'kembali' ? 'opacity-50 cursor-not-allowed' : '' }}"
                            {{ $suratDispensasi->statusTerakhir() === 'kembali' ? 'readonly' : '' }}>
                    </div>
                </div>

                {{-- Alasan --}}
                <div class="md:col-span-2">
                    <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2 ml-1">Alasan / Keterangan</label>
                    <textarea name="alasan" rows="4" class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-4 py-3 focus:ring-4 focus:ring-blue-500/10 transition-all">{{ old('alasan', $suratDispensasi->alasan) }}</textarea>
                    @error('alasan')
                        <p class="text-red-600 text-[10px] mt-1 font-bold uppercase ml-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <div class="flex flex-col sm:flex-row gap-4 pt-6">
                <button type="submit" class="flex-1 bg-amber-500 hover:bg-amber-600 text-white font-black py-4 rounded-2xl shadow-lg shadow-amber-500/20 transition-all uppercase tracking-widest text-sm">
                    Simpan Perubahan
                </button>
                <a href="{{ route('surat-dispensasi.index') }}" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold py-4 rounded-2xl transition-all text-center uppercase tracking-widest text-sm">
                    Batal
                </a>
            </div>

        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Inisialisasi TomSelect agar serasi dengan create
    new TomSelect('#siswa-select', {
        placeholder: 'Pilih siswa...',
        maxItems: 1,
        searchField: ['text'],
        closeAfterSelect: true,
    });

    // Script auto-fill data kelas/jurusan saat ganti siswa
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