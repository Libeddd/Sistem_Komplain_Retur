<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Edit Admin - Komplain & Retur</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100..700,0..1&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#5048e5",
                        "background-light": "#f6f6f8",
                        "background-dark": "#121121",
                    },
                    fontFamily: {
                        "display": ["Inter", "sans-serif"]
                    },
                    borderRadius: {"DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px"},
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .active-nav { background-color: #5048e5; color: white; }
    </style>
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-slate-900 dark:text-slate-100 antialiased h-screen overflow-hidden flex">

<aside class="w-64 bg-white dark:bg-slate-900 border-r border-slate-200 dark:border-slate-800 flex flex-col hidden md:flex transition-all">
    <div class="h-16 flex items-center px-6 border-b border-slate-200 dark:border-slate-800 gap-3">
        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-primary text-white shadow-lg shadow-primary/20">
            <span class="material-symbols-outlined text-[20px]">cycle</span>
        </div>
        <h1 class="text-lg font-bold tracking-tight">Komplain & Retur</h1>
    </div>
    <nav class="flex-1 px-4 py-4 space-y-1">
        <a href="{{ url('/dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
            <span class="material-symbols-outlined">home</span>
            <span class="text-sm font-medium">Dashboard</span>
        </a>
        <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors" href="{{ url('/manajemen-komplain') }}">
            <span class="material-symbols-outlined">inventory_2</span>
            <span class="text-sm font-medium">Manajemen Komplain</span>
        </a>
        <a class="flex items-center gap-3 px-3 py-2 rounded-lg active-nav" href="{{ route('admin.index') }}">
            <span class="material-symbols-outlined">shield_person</span>
            <span class="text-sm font-medium">Manajemen Admin</span>
        </a>
    </nav>
    <div class="p-4 border-t border-slate-200 dark:border-slate-800">
        <a href="{{ route('logout') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-red-500 hover:bg-red-50 dark:hover:bg-red-900/10 transition-colors font-semibold text-sm">
            <span class="material-symbols-outlined text-[20px]">logout</span> Sign Out
        </a>
    </div>
</aside>

    <div class="flex-1 flex flex-col overflow-hidden">
        
        <header class="h-16 border-b border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 px-8 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.index') }}" class="p-2 rounded-full hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors flex items-center justify-center text-slate-500">
                    <span class="material-symbols-outlined">arrow_back</span>
                </a>
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">edit_square</span>
                    <h2 class="text-lg font-bold">Edit Admin</h2>
                </div>
            </div>
            <button id="theme-toggle" class="p-2 rounded-full hover:bg-slate-200 dark:hover:bg-slate-800 transition-colors">
                <span class="material-symbols-outlined dark:hidden">dark_mode</span>
                <span class="material-symbols-outlined hidden dark:block text-yellow-400">light_mode</span>
            </button>
        </header>        

        <main class="flex-1 overflow-y-auto p-4 sm:p-6 md:p-8 pb-20 md:pb-8">
            <div class="mb-6 md:mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <h1 class="text-2xl font-black tracking-tight text-slate-900 dark:text-white">Edit Akun Admin</h1>
                    <p class="text-sm text-slate-500 mt-1">Perbarui data profil atau ubah password admin.</p>
                </div>
            </div>

            <div class="max-w-2xl bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm p-6 sm:p-8">
                
                @if ($errors->any())
                    <div class="mb-6 bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 p-4 rounded-lg text-sm border border-red-200 dark:border-red-800">
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.update', $admin->id) }}" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700 dark:text-slate-300" for="name">Nama Lengkap</label>
                        <div class="relative group">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors">person</span>
                            <input class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 py-3 pl-11 pr-4 text-slate-900 dark:text-white focus:border-primary focus:ring-primary/20 transition-all outline-none" id="name" name="name" value="{{ old('name', $admin->name) }}" required type="text"/>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700 dark:text-slate-300" for="email">Alamat Email</label>
                        <div class="relative group">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors">mail</span>
                            <input class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 py-3 pl-11 pr-4 text-slate-900 dark:text-white focus:border-primary focus:ring-primary/20 transition-all outline-none" id="email" name="email" value="{{ old('email', $admin->email) }}" required type="email"/>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-slate-100 dark:border-slate-800">
                        <h3 class="text-sm font-bold text-slate-900 dark:text-white mb-4">Ubah Password <span class="text-xs font-normal text-slate-500">(Opsional)</span></h3>
                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-slate-700 dark:text-slate-300" for="password">Password Baru</label>
                            <div class="relative group">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors">lock</span>
                                <input class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 py-3 pl-11 pr-4 text-slate-900 dark:text-white focus:border-primary focus:ring-primary/20 transition-all outline-none" id="password" name="password" placeholder="••••••••" type="password"/>
                            </div>
                            <p class="text-xs text-slate-500 mt-1">Kosongkan jika tidak ingin mengubah password.</p>
                        </div>
                    </div>

                    <button class="w-full rounded-lg bg-primary py-3 text-sm font-bold text-white shadow-lg shadow-primary/30 hover:bg-primary/90 focus:ring-4 focus:ring-primary/20 transition-all flex justify-center items-center gap-2" type="submit">
                        <span class="material-symbols-outlined text-[18px]">save</span>
                        Simpan Perubahan
                    </button>
                </form>
            </div>
        </main>
    </div>

    <script>
        const themeToggleBtn = document.getElementById('theme-toggle');
        if(themeToggleBtn) {
            themeToggleBtn.addEventListener('click', function() {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.theme = 'light';
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.theme = 'dark';
                }
            });
        }
    </script>

    <!-- Mobile Bottom Navigation -->
    <nav class="md:hidden fixed bottom-0 w-full bg-white dark:bg-slate-900 border-t border-slate-200 dark:border-slate-800 flex justify-around items-center h-16 z-50 px-2 pb-safe">
        <a href="{{ url('/dashboard') }}" class="flex flex-col items-center justify-center gap-1 text-slate-400 hover:text-primary transition-colors w-full h-full">
            <span class="material-symbols-outlined text-[24px]">home</span>
            <span class="text-[10px] font-bold">Dashboard</span>
        </a>
        <a href="{{ url('/manajemen-komplain') }}" class="flex flex-col items-center justify-center gap-1 text-slate-400 hover:text-primary transition-colors w-full h-full">
            <span class="material-symbols-outlined text-[24px]">inventory_2</span>
            <span class="text-[10px] font-medium">Komplain</span>
        </a>
        <a href="{{ route('admin.index') }}" class="flex flex-col items-center justify-center gap-1 text-primary w-full h-full">
            <span class="material-symbols-outlined text-[24px]">shield_person</span>
            <span class="text-[10px] font-medium">Admin</span>
        </a>
        <a href="{{ route('logout') }}" class="flex flex-col items-center justify-center gap-1 text-slate-400 hover:text-red-500 transition-colors w-full h-full">
            <span class="material-symbols-outlined text-[24px]">logout</span>
            <span class="text-[10px] font-medium">Keluar</span>
        </a>
    </nav>
</body>
</html>
