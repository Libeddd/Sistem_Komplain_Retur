<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Home</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
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
            },
          },
        }
      </script>
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>
<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 antialiased">
    
    <nav class="sticky top-0 z-50 bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border-b border-slate-200 dark:border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-3">
                    <div class="size-9 bg-primary rounded-lg flex items-center justify-center text-white shadow-lg shadow-primary/20">
                        <span class="material-symbols-outlined">cycle</span>
                    </div>
                    <span class="text-xl font-bold tracking-tight">Komplain & Retur</span>
                </div>
                
                <div class="flex items-center gap-3 md:gap-4">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-semibold">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-slate-500">{{ ucfirst(Auth::user()->role) }}</p>
                    </div>
                    <div class="size-10 rounded-full bg-slate-200 dark:bg-slate-700 bg-cover bg-center" style="background-image: url('https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=5048e5&color=fff')"></div>
                    
                    <button id="theme-toggle" class="p-2 ml-1 rounded-full hover:bg-slate-200 dark:hover:bg-slate-800 transition-colors">
                        <span class="material-symbols-outlined dark:hidden">dark_mode</span>
                        <span class="material-symbols-outlined hidden dark:block text-yellow-400">light_mode</span>
                    </button>

                    <div class="h-8 w-px bg-slate-200 dark:bg-slate-700 hidden sm:block ml-1"></div>
                    
                    <a href="{{ route('logout') }}" class="flex items-center gap-2 px-2 md:px-3 py-2 rounded-lg text-red-500 hover:bg-red-50 dark:hover:bg-red-900/10 transition-colors font-semibold text-sm" title="Log Out">
                        <span class="material-symbols-outlined text-[20px]">logout</span>
                        <span class="hidden sm:block">Keluar</span>
                    </a>
                </div>

            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-12">
            <div>
                <h1 class="text-3xl font-extrabold tracking-tight">Halo, {{ Auth::user()->name }}!</h1>
                <p class="text-slate-500 mt-1">Pantau status pengembalian barang dan ajukan komplain baru di sini.</p>
            </div>
            <a href="{{ url('/form') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-primary text-white font-bold rounded-xl shadow-lg shadow-primary/30 hover:bg-primary/90 hover:-translate-y-0.5 transition-all">
                <span class="material-symbols-outlined">add_circle</span>
                Ajukan Komplain
            </a>
        </div>

        <div class="space-y-6">
            <div class="flex items-center justify-between border-b border-slate-200 dark:border-slate-800 pb-4">
                <h2 class="text-xl font-bold flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">history</span>
                    Riwayat Komplain Anda
                </h2>
                <span class="text-sm font-medium text-slate-500">Menampilkan {{ $complaints->count() }} Komplain</span>
            </div>

            @if($complaints->isEmpty())
                <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 p-12 text-center shadow-sm">
                    <span class="material-symbols-outlined text-6xl text-slate-300 dark:text-slate-700 mb-4 block">inbox</span>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">Belum ada komplain</h3>
                    <p class="text-slate-500 mt-1">Anda belum pernah mengajukan komplain atau pengembalian barang.</p>
                </div>
            @else
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    @foreach($complaints as $complaint)
                    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden flex flex-col">
                        <div class="p-6 border-b border-slate-100 dark:border-slate-800 flex justify-between items-start">
                            <div>
                                <span class="text-[10px] font-bold uppercase tracking-widest text-slate-400">ID Komplain</span>
                                <p class="text-sm font-bold text-primary">{{ $complaint->complaint_code }}</p>
                            </div>
                            @if($complaint->status == 'pending')
                                <span class="px-3 py-1 rounded-full bg-amber-100 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400 text-xs font-bold flex items-center gap-1">
                                    <span class="size-1.5 rounded-full bg-amber-500 animate-pulse"></span> Pending
                                </span>
                            @elseif($complaint->status == 'approved')
                                <span class="px-3 py-1 rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 text-xs font-bold flex items-center gap-1">
                                    <span class="size-1.5 rounded-full bg-blue-500 animate-pulse"></span> Diproses
                                </span>
                            @elseif($complaint->status == 'rejected')
                                <span class="px-3 py-1 rounded-full bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400 text-xs font-bold flex items-center gap-1">
                                    Ditolak
                                </span>
                            @else
                                <span class="px-3 py-1 rounded-full bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 text-xs font-bold flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[14px]">check_circle</span> Done
                                </span>
                            @endif
                        </div>

                        <div class="p-6 space-y-5">
                            <div class="flex gap-3">
                                @if($complaint->proof_image_path)
                                    <div class="w-24 h-24 rounded-lg bg-cover bg-center border-2 border-dashed border-slate-200 dark:border-slate-700" style="background-image: url('{{ Storage::url($complaint->proof_image_path) }}')"></div>
                                @else
                                    <div class="w-24 h-24 rounded-lg bg-slate-100 dark:bg-slate-800 flex flex-col items-center justify-center border-2 border-dashed border-slate-200 dark:border-slate-700">
                                        <span class="material-symbols-outlined text-slate-400">image</span>
                                        <span class="text-[9px] font-bold text-slate-400 uppercase mt-1">Tanpa Foto</span>
                                    </div>
                                @endif

                                @if($complaint->unboxing_video_path)
                                    <div class="w-24 h-24 rounded-lg bg-slate-100 dark:bg-slate-800 flex flex-col items-center justify-center border-2 border-solid border-primary/20 cursor-pointer hover:bg-primary/5 transition-colors" onclick="window.open('{{ Storage::url($complaint->unboxing_video_path) }}', '_blank')">
                                        <span class="material-symbols-outlined text-primary">play_circle</span>
                                        <span class="text-[9px] font-bold text-primary uppercase mt-1">Lihat Video</span>
                                    </div>
                                @else
                                    <div class="w-24 h-24 rounded-lg bg-slate-100 dark:bg-slate-800 flex flex-col items-center justify-center border-2 border-dashed border-slate-200 dark:border-slate-700">
                                        <span class="material-symbols-outlined text-slate-400">videocam_off</span>
                                        <span class="text-[9px] font-bold text-slate-400 uppercase mt-1">Tanpa Video</span>
                                    </div>
                                @endif
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider">No. Seri Order</h4>
                                    <p class="text-sm font-medium mt-1">{{ $complaint->order_number }}</p>
                                </div>
                                <div>
                                    <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Metode Refund</h4>
                                    <p class="text-sm font-medium mt-1">{{ strtoupper($complaint->refund_method) }}</p>
                                </div>
                            </div>

                            <div>
                                <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Deskripsi Kerusakan</h4>
                                <p class="text-sm text-slate-600 dark:text-slate-400 mt-1 italic">"{{ $complaint->description }}"</p>
                            </div>
                        </div>

                        @if($complaint->status == 'done')
                            <div class="px-6 py-4 bg-emerald-50 dark:bg-emerald-900/10 mt-auto flex justify-between items-center text-[11px] font-bold text-emerald-600/70 uppercase tracking-tight">
                                <span>Selesai pada: {{ \Carbon\Carbon::parse($complaint->completed_at)->format('d M Y') }}</span>
                                <span class="flex items-center gap-1 italic">Dana telah dikembalikan</span>
                            </div>
                        @else
                            <div class="px-6 py-4 bg-slate-50 dark:bg-slate-800/50 mt-auto flex justify-between items-center text-[11px] font-bold text-slate-400 uppercase">
                                <span>Diajukan pada: {{ $complaint->created_at->format('d M Y') }}</span>
                            </div>
                        @endif
                    </div>
                    @endforeach
                </div>
            @endif

        </div>
    </main>

    <!-- Script for Theme Toggle -->
    <script>        // Toggle theme
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
</body>
</html>
