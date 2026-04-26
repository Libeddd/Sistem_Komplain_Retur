<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100..700,0..1&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
        <a class="flex items-center gap-3 px-3 py-2 rounded-lg active-nav">
            <span class="material-symbols-outlined">home</span>
            <span class="text-sm font-medium">Dashboard</span>
        </a>
        <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors" href="{{ url('/manajemen-komplain') }}">
            <span class="material-symbols-outlined">inventory_2</span>
            <span class="text-sm font-medium">Manajemen Komplain</span>
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
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">home</span>
                <h2 class="text-lg font-bold">Dashboard</h2>
            </div>
            <button id="theme-toggle" class="p-2 rounded-full hover:bg-slate-200 dark:hover:bg-slate-800 transition-colors">
                <span class="material-symbols-outlined dark:hidden">dark_mode</span>
                <span class="material-symbols-outlined hidden dark:block text-yellow-400">light_mode</span>
            </button>
        </header>        

        <main class="flex-1 overflow-y-auto p-4 sm:p-6 md:p-8 pb-20 md:pb-8">
            <div class="mb-6 md:mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <h1 class="text-2xl font-black tracking-tight text-slate-900 dark:text-white">Dashboard Overview</h1>
                    <p class="text-sm text-slate-500 mt-1">Ringkasan performa dan analitik komplain retur.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white dark:bg-slate-900 p-6 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm border-l-4 border-l-slate-400">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Total Masuk</span>
                    <p class="text-3xl font-extrabold mt-2 text-slate-800 dark:text-slate-100">{{ $total }}</p>
                </div>
                <div class="bg-white dark:bg-slate-900 p-6 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm border-l-4 border-l-amber-500">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Pending Review</span>
                    <p class="text-3xl font-extrabold mt-2 text-amber-600">{{ $pending }}</p>
                </div>
                <div class="bg-white dark:bg-slate-900 p-6 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm border-l-4 border-l-blue-500">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Approved</span>
                    <p class="text-3xl font-extrabold mt-2 text-blue-600">{{ $approved }}</p>
                </div>
                <div class="bg-white dark:bg-slate-900 p-6 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm border-l-4 border-l-emerald-500">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Done (Selesai)</span>
                    <p class="text-3xl font-extrabold mt-2 text-emerald-600">{{ $done }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                <div class="bg-white dark:bg-slate-900 p-6 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-sm font-bold text-slate-900 dark:text-white uppercase tracking-wider">Top Produk Komplain</h3>
                        <span class="material-symbols-outlined text-slate-400">inventory</span>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900 dark:text-white leading-tight">
                        {{ $topProduct ? $topProduct->product_name : 'Belum Ada Data' }}
                    </h4>
                    <div class="flex items-center gap-2 mt-2">
                        <span class="px-2 py-1 bg-red-100 text-red-600 text-xs font-bold rounded">
                            {{ $topProduct ? $topProduct->total : 0 }} Kasus
                        </span>
                        <span class="text-xs text-slate-500">Tertinggi saat ini</span>
                    </div>
                </div>

                <div class="bg-white dark:bg-slate-900 p-6 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-sm font-bold text-slate-900 dark:text-white uppercase tracking-wider">Kategori Dominan</h3>
                        <span class="material-symbols-outlined text-slate-400">broken_image</span>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900 dark:text-white leading-tight">
                        {{ $topCategory ? $topCategory->damage_category : 'Belum Ada Data' }}
                    </h4>
                    <div class="flex items-center gap-2 mt-2">
                        <span class="px-2 py-1 bg-amber-100 text-amber-600 text-xs font-bold rounded">
                            {{ $topCategory ? $topCategory->total : 0 }} Kasus
                        </span>
                        <span class="text-xs text-slate-500">Dari total retur</span>
                    </div>
                </div>

                <div class="bg-white dark:bg-slate-900 p-6 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm flex flex-col">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-sm font-bold text-slate-900 dark:text-white uppercase tracking-wider">Grafik Tipe Kerusakan</h3>
                        <span class="material-symbols-outlined text-slate-400">pie_chart</span>
                    </div>
                    <div class="relative flex-1 w-full min-h-[120px]">
                        <canvas id="trendChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden flex flex-col">
                <div class="px-6 py-5 border-b border-slate-200 dark:border-slate-800 flex justify-between items-center">
                    <div>
                        <h2 class="text-lg font-bold text-slate-900 dark:text-white">History Komplain Selesai</h2>
                        <p class="text-xs text-slate-500 mt-1">Daftar retur dan refund yang telah berstatus Done.</p>
                    </div>
                    <a href="{{ url('/manajemen-komplain') }}" class="text-sm text-primary font-bold hover:underline">Lihat Semua</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm whitespace-nowrap">
                        <thead class="bg-slate-50 dark:bg-slate-800/50 text-slate-500 dark:text-slate-400">
                            <tr>
                                <th class="px-6 py-4 font-bold uppercase tracking-wider text-xs">ID Komplain</th>
                                <th class="px-6 py-4 font-bold uppercase tracking-wider text-xs">Customer</th>
                                <th class="px-6 py-4 font-bold uppercase tracking-wider text-xs">Produk</th>
                                <th class="px-6 py-4 font-bold uppercase tracking-wider text-xs">Status</th>
                                <th class="px-6 py-4 font-bold uppercase tracking-wider text-xs">Tanggal Selesai</th>
                                <th class="px-6 py-4 font-bold uppercase tracking-wider text-xs text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 dark:divide-slate-800">
                            @forelse($latestComplaints as $complaint)
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                                <td class="px-6 py-4 font-bold text-primary">{{ $complaint->complaint_code }}</td>
                                <td class="px-6 py-4 font-medium">{{ $complaint->user->name }}</td>
                                <td class="px-6 py-4 text-slate-500">{{ $complaint->product_name }}</td>
                                <td class="px-6 py-4">
                                    @if($complaint->status == 'pending')
                                        <span class="px-3 py-1 rounded-full bg-amber-100 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400 text-xs font-bold flex items-center gap-1 w-max">
                                            <span class="size-1.5 rounded-full bg-amber-500 animate-pulse"></span> Pending
                                        </span>
                                    @elseif($complaint->status == 'approved')
                                        <span class="px-3 py-1 rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 text-xs font-bold flex items-center gap-1 w-max">
                                            <span class="size-1.5 rounded-full bg-blue-500 animate-pulse"></span> Diproses
                                        </span>
                                    @elseif($complaint->status == 'rejected')
                                        <span class="px-3 py-1 rounded-full bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400 text-xs font-bold flex items-center gap-1 w-max">
                                            Ditolak
                                        </span>
                                    @else
                                        <span class="px-3 py-1 rounded-full bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 text-xs font-bold flex items-center gap-1 w-max">
                                            <span class="material-symbols-outlined text-[14px]">check_circle</span> Done
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-slate-500">
                                    {{ $complaint->completed_at ? \Carbon\Carbon::parse($complaint->completed_at)->format('d M Y') : '-' }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <span class="inline-flex items-center gap-1 px-3 py-1.5 text-slate-500 text-xs">Detail (TBD)</span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-slate-500">Belum ada komplain.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('trendChart').getContext('2d');
            
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode(array_keys($chartData)) !!},
                    datasets: [{
                        label: 'Jumlah Kasus',
                        data: {!! json_encode(array_values($chartData)) !!}, // Angka per tipe kerusakan
                        backgroundColor: [
                            '#ef4444', // Merah
                            '#f59e0b', // Kuning
                            '#3b82f6', // Biru
                            '#8b5cf6'  // Ungu
                        ],
                        borderRadius: 4,
                        barThickness: 16
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#1e293b',
                            padding: 10,
                            cornerRadius: 8,
                            displayColors: true,
                            callbacks: {
                                label: function(context) {
                                    return ' ' + context.raw + ' Kasus Retur';
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: '#f1f5f9', drawBorder: false },
                            ticks: { color: '#64748b' }
                        },
                        x: {
                            grid: { display: false },
                            ticks: { color: '#64748b', font: { size: 10 } }
                        }
                    }
                }
            });
        });
    </script>
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
        <a href="{{ url('/dashboard') }}" class="flex flex-col items-center justify-center gap-1 text-primary w-full h-full">
            <span class="material-symbols-outlined text-[24px]">home</span>
            <span class="text-[10px] font-bold">Dashboard</span>
        </a>
        <a href="{{ url('/manajemen-komplain') }}" class="flex flex-col items-center justify-center gap-1 text-slate-400 hover:text-primary dark:hover:text-primary transition-colors w-full h-full">
            <span class="material-symbols-outlined text-[24px]">inventory_2</span>
            <span class="text-[10px] font-medium">Manajemen</span>
        </a>
        <a href="{{ route('logout') }}" class="flex flex-col items-center justify-center gap-1 text-slate-400 hover:text-red-500 transition-colors w-full h-full">
            <span class="material-symbols-outlined text-[24px]">logout</span>
            <span class="text-[10px] font-medium">Keluar</span>
        </a>
    </nav>
</body>
</html>



