<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dispensasi') | SMKN 2 MOJOKERTO</title>

    <link rel="icon" type="image/png" href="{{ asset('images/smkn_2.png') }}">

    @vite('resources/css/app.css')

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">

    <style>
        /* Scrollbar styling untuk area konten */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
</head>


<body class="bg-gray-100 overflow-hidden font-sans">

    <div class="flex h-screen w-full">

        <aside class="w-64 bg-blue-800 text-white flex-shrink-0 flex flex-col border-r border-blue-900 shadow-xl">
            <div class="p-5 flex items-center gap-3 border-b border-blue-700 bg-blue-900/40">
                <img src="{{ asset('images/smkn_2.png') }}" alt="Logo" class="h-10 w-auto">
                <div class="flex flex-col">
                    <span class="text-sm font-bold leading-tight tracking-wide">SISTEM DISPENSASI</span>
                    <span class="text-[10px] text-blue-200 font-medium">SMKN 2 MOJOKERTO</span>
                </div>
            </div>

            <nav class="flex-1 overflow-y-auto p-4 space-y-2 custom-scrollbar">

                {{-- Dashboard --}}
                <a href="{{ route('dashboard') }}"
                    class="group flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200
                    {{ request()->routeIs('dashboard')
                        ? 'bg-white text-blue-800 shadow-md font-bold'
                        : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">
                    <i class="ti ti-layout-dashboard text-xl"></i>
                    <span>Dashboard</span>
                </a>

                {{-- Data Master Group --}}
                <div class="pt-4 pb-2">
                    <span class="px-4 text-[10px] font-bold text-blue-300 uppercase tracking-widest">Data Master</span>
                </div>

                <a href="{{ route('jurusan.index') }}"
                    class="group flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200
                    {{ request()->routeIs('jurusan.*')
                        ? 'bg-white text-blue-800 shadow-md font-bold'
                        : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">
                    <i class="ti ti-list-details text-xl"></i>
                    <span>Data Jurusan</span>
                </a>

                <a href="{{ route('siswa.index') }}"
                    class="group flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200
                    {{ request()->routeIs('siswa.*')
                        ? 'bg-white text-blue-800 shadow-md font-bold'
                        : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">
                    <i class="ti ti-school text-xl"></i>
                    <span>Data Siswa</span>
                </a>

                <a href="{{ route('jenis-surat.index') }}"
                    class="group flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200
                    {{ request()->routeIs('jenis-surat.*')
                        ? 'bg-white text-blue-800 shadow-md font-bold'
                        : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">
                    <i class="ti ti-mail-cog text-xl"></i>
                    <span>Jenis Surat</span>
                </a>

                {{-- Transaksi Group --}}
                <div class="pt-4 pb-2">
                    <span class="px-4 text-[10px] font-bold text-blue-300 uppercase tracking-widest">Layanan</span>
                </div>

                <a href="{{ route('surat-dispensasi.index') }}"
                    class="group flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200
                    {{ request()->routeIs('surat-dispensasi.*')
                        ? 'bg-white text-blue-800 shadow-md font-bold'
                        : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">
                    <i class="ti ti-mail-opened text-xl"></i>
                    <span>Surat Dispensasi</span>
                </a>

                <a href="{{ route('laporan.dispensasi') }}"
                    class="group flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200
                    {{ request()->routeIs('laporan.dispensasi')
                        ? 'bg-white text-blue-800 shadow-md font-bold'
                        : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">
                    <i class="ti ti-file-report text-xl"></i>
                    <span>Laporan</span>
                </a>

            </nav>

            <div
                class="p-4 bg-blue-900/30 text-[10px] text-blue-300 text-center uppercase tracking-widest border-t border-blue-700">
                v1.0 Offline Server
            </div>
        </aside>

        <div class="flex-1 flex flex-col min-w-0 bg-gray-50 overflow-hidden">

            <header
                class="h-16 bg-white shadow-sm px-8 flex justify-between items-center flex-shrink-0 z-10 border-b border-gray-200">
                <div class="flex items-center gap-2">
                    <div class="w-1 h-6 bg-blue-600 rounded-full mr-2"></div>
                    <h1 class="text-lg font-bold text-gray-800 uppercase tracking-tight">
                        @yield('title', 'Dashboard')
                    </h1>
                </div>

                <div class="flex items-center gap-6">
                    <div class="hidden md:flex flex-col items-end border-r pr-6 border-gray-200">
                        <span id="current-time" class="text-sm font-bold text-blue-800"></span>
                        <span id="current-date" class="text-[10px] text-gray-500 uppercase font-medium"></span>
                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button
                            class="bg-red-50 hover:bg-red-100 text-red-600 border border-red-200 px-4 py-2 rounded-xl flex items-center gap-2 text-sm font-bold transition-all duration-200">
                            <i class="ti ti-logout text-lg"></i>
                            <span class="hidden sm:inline">Logout</span>
                        </button>
                    </form>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto p-8 custom-scrollbar">
                <div class="max-w-[1400px] mx-auto">
                    @yield('content')
                </div>
            </main>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>

    <script>
        // Fungsi Jam Real-time di Navbar
        function updateClock() {
            const now = new Date();
            const timeOptions = {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: false
            };
            const dateOptions = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };

            document.getElementById('current-time').innerText = now.toLocaleTimeString('id-ID', timeOptions);
            document.getElementById('current-date').innerText = now.toLocaleDateString('id-ID', dateOptions);
        }
        setInterval(updateClock, 1000);
        updateClock();
    </script>

    @stack('scripts')

    {{-- Notifikasi SweetAlert dari Session --}}
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: "{{ session('success') }}",
                timer: 2500,
                showConfirmButton: false,
                borderBox: 'rounded-2xl'
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan',
                text: "{{ session('error') }}",
                confirmButtonColor: '#1e40af'
            });
        </script>
    @endif

</body>

</html>
