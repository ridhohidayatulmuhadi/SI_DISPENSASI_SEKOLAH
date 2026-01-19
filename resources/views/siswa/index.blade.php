@extends('layouts.app')

@section('title', 'Data Siswa')

@section('content')
<div class="space-y-6">
    <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex flex-col md:flex-row justify-between items-center gap-4">
        <div>
            <h1 class="text-2xl font-black text-gray-800 tracking-tight uppercase">Data Siswa</h1>
            <p class="text-sm text-gray-500">Manajemen database siswa dan filter data</p>
        </div>

        <a href="{{ route('siswa.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-2xl font-bold transition-all shadow-lg shadow-blue-600/20 flex items-center gap-2 w-full md:w-auto justify-center">
            <i class="ti ti-plus text-lg"></i> Tambah Siswa
        </a>
    </div>

    {{-- Filter Bar --}}
    <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 flex flex-col md:flex-row gap-4 items-center">
        <div class="relative w-full md:w-72 group">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400 group-focus-within:text-blue-600">
                <i class="ti ti-search text-lg"></i>
            </span>
            <input type="text" id="search" placeholder="Cari Nama / NIS..." 
                   class="w-full bg-gray-50 border border-gray-200 rounded-xl pl-10 pr-4 py-2.5 focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all">
        </div>

        <div class="relative w-full md:w-48">
            <select id="kelas" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all appearance-none cursor-pointer">
                <option value="">Semua Kelas</option>
                <option value="X">Kelas X</option>
                <option value="XI">Kelas XI</option>
                <option value="XII">Kelas XII</option>
            </select>
            <i class="ti ti-chevron-down absolute right-3 top-3 text-gray-400 pointer-events-none"></i>
        </div>
        
        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest ml-auto hidden md:block">
            Menampilkan Live Data
        </p>
    </div>

    <div class="bg-white shadow-sm rounded-3xl border border-gray-100 overflow-hidden">
        <div id="table-wrapper">
            @include('siswa.partials.table')
        </div>
    </div>
</div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {

        // ===== LIVE SEARCH =====
        const searchInput = document.getElementById('search');
        const kelasSelect = document.getElementById('kelas');
        const tableWrapper = document.getElementById('table-wrapper');

        function fetchData() {
            const search = searchInput.value;
            const kelas = kelasSelect.value;

            fetch(`{{ route('siswa.index') }}?search=${encodeURIComponent(search)}&kelas=${encodeURIComponent(kelas)}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(res => res.text())
                .then(html => tableWrapper.innerHTML = html);
        }

        searchInput.addEventListener('keyup', fetchData);
        kelasSelect.addEventListener('change', fetchData);

        // ===== DELETE CONFIRM =====
        tableWrapper.addEventListener('submit', function(e) {
            if (e.target.classList.contains('delete-form')) {
                e.preventDefault();

                Swal.fire({
                    title: 'Yakin?',
                    text: 'Data siswa akan dihapus',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        e.target.submit();
                    }
                });
            }
        });

    });
</script>
