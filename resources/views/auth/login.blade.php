<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin | Sistem Dispensasi</title>

    <link rel="icon" type="image/png" href="{{ asset('images/smkn_2.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
</head>

<body class="bg-slate-50 min-h-screen flex items-center justify-center p-4">

    <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-[10%] -left-[10%] w-[40%] h-[40%] bg-blue-100 rounded-full blur-3xl opacity-50"></div>
        <div class="absolute -bottom-[10%] -right-[10%] w-[40%] h-[40%] bg-blue-50 rounded-full blur-3xl opacity-50">
        </div>
    </div>

    <div class="w-full max-w-md z-10">
        <div class="text-center mb-8">
            <img src="{{ asset('images/smkn_2.png') }}" alt="Logo SMKN 2"
                class="h-24 w-auto mx-auto mb-4 drop-shadow-md">
            <h1 class="text-2xl font-black text-slate-800 tracking-tight uppercase">
                Admin Login
            </h1>
            <p class="text-slate-500 text-sm font-medium">
                Sistem Dispensasi SMKN 2 Mojokerto
            </p>
        </div>

        <div class="bg-white rounded-3xl shadow-xl shadow-blue-900/5 border border-slate-100 p-10">

            @if ($errors->any())
                <div
                    class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-6 flex items-center gap-3">
                    <i class="ti ti-alert-circle text-xl"></i>
                    <p class="text-sm font-medium">{{ $errors->first() }}</p>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <label
                        class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2 ml-1">Username</label>
                    <div class="relative group">
                        <span
                            class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400 group-focus-within:text-blue-600 transition-colors">
                            <i class="ti ti-user text-xl"></i>
                        </span>
                        <input type="text" name="username" placeholder="Masukkan username" required autofocus
                            class="w-full bg-slate-50 border border-slate-200 rounded-2xl pl-11 pr-4 py-3 focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all placeholder:text-slate-400">
                    </div>
                </div>

                <div>
                    <label
                        class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2 ml-1">Password</label>
                    <div class="relative group">
                        <span
                            class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400 group-focus-within:text-blue-600 transition-colors">
                            <i class="ti ti-lock text-xl"></i>
                        </span>
                        <input type="password" name="password" placeholder="••••••••" required
                            class="w-full bg-slate-50 border border-slate-200 rounded-2xl pl-11 pr-4 py-3 focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all placeholder:text-slate-400">
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-blue-700 hover:bg-blue-800 text-white font-bold py-3.5 rounded-2xl shadow-lg shadow-blue-700/20 transform active:scale-[0.98] transition-all flex items-center justify-center gap-2">
                    <span>Masuk Ke Sistem</span>
                    <i class="ti ti-arrow-right text-lg"></i>
                </button>
            </form>
        </div>

        <div class="text-center mt-8">
            <p class="text-xs font-semibold text-slate-400 uppercase tracking-[0.2em]">
                &copy; {{ date('Y') }} Tata Usaha SMKN 2 MOJOKERTO
            </p>
        </div>
    </div>

</body>

</html>
