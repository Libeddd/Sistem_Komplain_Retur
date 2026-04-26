<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Detail Komplain - Approved</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = { darkMode: "class", theme: { extend: { colors: { "primary": "#5048e5", "background-dark": "#121121" }, fontFamily: { "display": ["Inter", "sans-serif"] } } } }
    </script>
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>
<body class="bg-[#f6f6f8] dark:bg-background-dark font-display text-slate-900 dark:text-slate-100 antialiased">
    <div class="flex min-h-screen">
        <main class="flex-1 p-8 max-w-6xl mx-auto w-full">
            
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center gap-4">
                    <a href="{{ url('/manajemen-komplain') }}" class="p-2 hover:bg-slate-200 dark:hover:bg-slate-800 rounded-lg transition-colors">
                        <span class="material-symbols-outlined">arrow_back</span>
                    </a>
                    <div>
                        <h1 class="text-2xl font-black tracking-tight">Detail Komplain</h1>
                        <p class="text-sm text-slate-500">ID Komplain: #CMP-9275 / Pesanan: ORD-2026-X883</p>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <span class="px-3 py-1.5 rounded-full bg-blue-100 text-blue-700 text-xs font-bold uppercase tracking-widest flex items-center gap-1">
                        <span class="material-symbols-outlined text-[14px]">verified</span> Approved
                    </span>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white dark:bg-slate-900 p-6 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800">
                        <h3 class="text-lg font-bold mb-4 flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">attachment</span> Bukti Visual Produk
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <p class="text-xs font-bold text-slate-400 uppercase">Foto Produk</p>
                                <div class="aspect-video bg-slate-100 dark:bg-slate-800 rounded-xl flex items-center justify-center">
                                    <span class="material-symbols-outlined text-4xl text-slate-300">image</span>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <p class="text-xs font-bold text-slate-400 uppercase">Video Unboxing</p>
                                <div class="aspect-video bg-slate-100 dark:bg-slate-800 rounded-xl flex items-center justify-center">
                                    <span class="material-symbols-outlined text-4xl text-slate-300">play_circle</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-slate-900 p-6 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800">
                        <div class="flex items-start justify-between mb-4">
                            <h3 class="text-lg font-bold">Detail Kendala</h3>
                            <span class="px-3 py-1.5 rounded-lg bg-amber-100 text-amber-600 text-xs font-bold border border-amber-200">Tidak Sesuai : Salah Warna</span>
                        </div>
                        <div class="bg-slate-50 dark:bg-slate-800 p-4 rounded-lg border border-slate-100 dark:border-slate-700">
                            <p class="text-slate-600 dark:text-slate-300 italic text-sm">"Pesan Mouse Wireless warna Hitam, tapi yang datang warna Pink."</p>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-white dark:bg-slate-900 p-6 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800">
                        <h3 class="text-lg font-bold mb-4">Informasi Customer</h3>
                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between"><span class="text-slate-500">Nama:</span><span class="font-bold">Citra Kirana</span></div>
                            <div class="flex justify-between border-b pb-3"><span class="text-slate-500">Email:</span><span class="font-bold">citra@email.com</span></div>
                            
                            <div class="pt-2">
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">Detail Refund</p>
                                <div class="bg-slate-50 dark:bg-slate-800 p-3 rounded-xl space-y-2 border border-slate-100 dark:border-slate-700">
                                    <div class="flex justify-between">
                                        <span class="text-slate-500 text-xs">Metode:</span>
                                        <span class="font-bold text-xs">ShopeePay (E-Wallet)</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-slate-500 text-xs">No. Akun:</span>
                                        <span class="font-bold text-xs">081234567890</span>
                                    </div>
                                    <div class="flex justify-between pt-2 border-t border-slate-200 dark:border-slate-600">
                                        <span class="text-slate-700 dark:text-slate-300 font-bold">Nominal:</span>
                                        <span class="text-primary font-black">Rp150.000</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 mb-6 bg-blue-50 dark:bg-blue-900/10 border border-blue-200 dark:border-blue-900/30 p-5 rounded-xl">
                            <h4 class="text-sm font-bold text-blue-800 dark:text-blue-400 mb-2 flex items-center gap-1">
                                <span class="material-symbols-outlined text-[18px]">local_shipping</span> Menunggu Barang
                            </h4>
                            <p class="text-xs text-blue-600 dark:text-blue-300 leading-relaxed">
                                Menunggu customer mengirimkan barang retur.
                            </p>
                        </div>

                        <div id="action-buttons" class="space-y-3 mt-8">
                            <button onclick="setujuiKomplain()" class="w-full py-3.5 bg-emerald-600 text-white rounded-xl font-bold shadow-lg hover:bg-emerald-700 transition-all">
                                Barang Telah Sampai
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        function setujuiKomplain() {
            if(confirm("Apakah Anda yakin ingin menyetujui komplain ini?")) {
                alert("Status berhasil diubah menjadi In Progress.");
                window.location.href = "manajemen-komplain.html";
            }
        }
    </script>
</body>
</html>
