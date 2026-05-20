<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Manajemen Admin - Komplain & Retur</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>
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
        <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors" href="{{ url('/dashboard') }}">
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
        <header class="h-16 border-b border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 px-6 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">shield_person</span>
                <h2 class="text-lg font-bold">Manajemen Admin</h2>
            </div>
            <button id="theme-toggle" class="p-2 rounded-full hover:bg-slate-200 dark:hover:bg-slate-800 transition-colors">
                <span class="material-symbols-outlined dark:hidden">dark_mode</span>
                <span class="material-symbols-outlined hidden dark:block text-yellow-400">light_mode</span>
            </button>
        </header>

        <main class="flex-1 overflow-y-auto p-4 md:p-6 pb-20 md:pb-6 flex flex-col">
            <div class="mb-6 md:mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <h1 class="text-2xl font-black tracking-tight">Manajemen Admin</h1>
                    <p class="text-sm text-slate-500 mt-1">Kelola akun pengelola sistem komplain</p>
                </div>
                <a href="{{ route('admin.add') }}" class="inline-flex items-center gap-2 bg-primary hover:bg-primary/90 text-white px-4 py-2 rounded-lg text-sm font-bold shadow-lg shadow-primary/20 transition-all">
                    <span class="material-symbols-outlined text-[20px]">person_add</span>
                    Tambah Admin Baru
                </a>
            </div>
            
            @if (session('success'))
                <div class="mb-6 bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 dark:text-emerald-400 p-4 rounded-lg text-sm border border-emerald-200 dark:border-emerald-800 flex items-center gap-2">
                    <span class="material-symbols-outlined">check_circle</span>
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 p-4 rounded-lg text-sm border border-red-200 dark:border-red-800 flex items-center gap-2">
                    <span class="material-symbols-outlined">error</span>
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden flex flex-col h-full">

                <div class="overflow-x-auto flex-1">
                    <table class="w-full text-left text-sm whitespace-nowrap">
                        <thead class="bg-slate-50 dark:bg-slate-800/50 text-slate-500 dark:text-slate-400 sticky top-0 border-b border-slate-200 dark:border-slate-700">
                            <tr>
                                <th class="px-6 py-3 font-bold uppercase tracking-wider text-xs">ID User</th>
                                <th class="px-6 py-3 font-bold uppercase tracking-wider text-xs">Nama Lengkap</th>
                                <th class="px-6 py-3 font-bold uppercase tracking-wider text-xs">Email</th>
                                <th class="px-6 py-3 font-bold uppercase tracking-wider text-xs text-center">Aksi</th>
                            </tr>
                        </thead>
                        
                        <tbody class="divide-y divide-slate-200 dark:divide-slate-800">
                            @forelse($admins as $admin)
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                                <td class="px-6 py-4 font-bold text-slate-500">#{{ $admin->id }}</td>
                                <td class="px-6 py-4 font-medium">
                                    <div class="flex items-center gap-2">
                                        {{ $admin->name }}
                                        @if($admin->id === Auth::id())
                                            <span class="px-2 py-0.5 bg-primary/10 text-primary text-[10px] font-bold rounded-full uppercase">Anda</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-slate-500">{{ $admin->email }}</td>
                                <td class="px-6 py-4 flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.edit', $admin->id) }}" class="inline-flex items-center justify-center p-2 text-slate-400 hover:text-blue-500 hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded-lg transition-colors" title="Edit">
                                        <span class="material-symbols-outlined text-[18px]">edit</span>
                                    </a>
                                    
                                    @if($admin->id !== Auth::id())
                                    <form action="{{ route('admin.destroy', $admin->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun admin ini?');" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center justify-center p-2 text-slate-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors" title="Hapus">
                                            <span class="material-symbols-outlined text-[18px]">delete</span>
                                        </button>
                                    </form>
                                    @else
                                    <button disabled class="inline-flex items-center justify-center p-2 text-slate-200 dark:text-slate-700 rounded-lg cursor-not-allowed" title="Anda tidak bisa menghapus akun Anda sendiri">
                                        <span class="material-symbols-outlined text-[18px]">delete</span>
                                    </button>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-slate-500">Belum ada admin selain Anda.</td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
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
        <a href="{{ url('/dashboard') }}" class="flex flex-col items-center justify-center gap-1 text-slate-400 hover:text-primary dark:hover:text-primary transition-colors w-full h-full">
            <span class="material-symbols-outlined text-[24px]">home</span>
            <span class="text-[10px] font-bold">Dashboard</span>
        </a>
        <a href="{{ url('/manajemen-komplain') }}" class="flex flex-col items-center justify-center gap-1 text-slate-400 hover:text-primary w-full h-full">
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
