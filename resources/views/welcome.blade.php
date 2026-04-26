<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Welcome - Komplain & Retur</title>

    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#5048e5",
                        "primary-dark": "#3f39b6",
                        "background-light": "#f6f6f8",
                        "background-dark": "#121121",
                    },
                    fontFamily: {
                        "display": ["Inter", "sans-serif"]
                    },
                    borderRadius: { "DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "2xl": "1rem", "full": "9999px" },
                    animation: {
                        'fade-in-up': 'fadeInUp 0.8s ease-out forwards',
                        'float': 'float 6s ease-in-out infinite',
                    },
                    keyframes: {
                        fadeInUp: {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-15px)' },
                        }
                    }
                },
            },
        }
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        /* Glassmorphism utilities */
        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .dark .glass {
            background: rgba(18, 17, 33, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }

        .dark ::-webkit-scrollbar-thumb {
            background: #334155;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        .dark ::-webkit-scrollbar-thumb:hover {
            background: #475569;
        }
    </style>
</head>

<body
    class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 antialiased overflow-x-hidden transition-colors duration-300">

    <!-- Ambient Background Blobs -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
        <div class="absolute -top-40 -right-40 w-96 h-96 bg-primary/20 dark:bg-primary/10 rounded-full blur-3xl"></div>
        <div class="absolute top-40 -left-20 w-72 h-72 bg-blue-400/20 dark:bg-blue-900/20 rounded-full blur-3xl"></div>
    </div>

    <!-- Navbar -->
    <nav class="fixed w-full z-50 glass transition-all duration-300" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center gap-3 group cursor-pointer" onclick="window.scrollTo(0,0)">
                    <div
                        class="size-10 bg-primary rounded-xl flex items-center justify-center text-white shadow-lg shadow-primary/30 group-hover:scale-105 transition-transform duration-300">
                        <span class="material-symbols-outlined">cycle</span>
                    </div>
                    <span
                        class="text-xl sm:text-2xl font-bold tracking-tight bg-clip-text text-transparent bg-gradient-to-r from-slate-900 to-primary dark:from-white dark:to-primary">Komplain
                        & Retur</span>
                </div>

                <div class="flex items-center gap-2 sm:gap-4">
                    <button id="theme-toggle"
                        class="p-2 rounded-full hover:bg-slate-200 dark:hover:bg-slate-800 transition-colors">
                        <span class="material-symbols-outlined dark:hidden">dark_mode</span>
                        <span class="material-symbols-outlined hidden dark:block text-yellow-400">light_mode</span>
                    </button>

                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/home') }}"
                                class="px-4 sm:px-5 py-2.5 rounded-lg font-semibold text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors text-sm sm:text-base">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="flex items-center gap-1 px-2 sm:px-5 py-2.5 rounded-lg font-semibold text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                                <span class="material-symbols-outlined sm:hidden text-[20px]">login</span>
                                <span class="hidden sm:block">Masuk</span>
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="px-4 sm:px-6 py-2 sm:py-2.5 bg-primary text-white font-bold rounded-xl shadow-lg shadow-primary/30 hover:bg-primary-dark hover:-translate-y-0.5 transition-all text-sm sm:text-base">Daftar</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <div class="relative z-10 pt-20">
        <!-- Hero Section -->
        <section class="min-h-[90vh] flex items-center relative overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full py-12 lg:py-0">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

                    <div class="space-y-8 animate-fade-in-up">
                        <div
                            class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-primary/10 dark:bg-primary/20 text-primary dark:text-blue-300 font-semibold text-sm">
                            <span class="size-2 rounded-full bg-primary animate-ping"></span>
                            Platform Resolusi Cepat
                        </div>

                        <h1 class="text-4xl sm:text-5xl lg:text-7xl font-extrabold tracking-tight leading-tight">
                            Solusi Komplain & Retur <br />
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-blue-500">Tanpa
                                Ribet.</span>
                        </h1>

                        <p class="text-lg text-slate-600 dark:text-slate-400 max-w-xl leading-relaxed">
                            Kami memahami waktu Anda berharga. Ajukan pengembalian barang atau komplain dengan mudah,
                            pantau status secara real-time, dan dapatkan resolusi instan.
                        </p>

                        <div class="flex flex-wrap items-center gap-4 pt-4">
                            <a href="#features"
                                class="px-8 py-4 bg-primary text-white font-bold rounded-xl shadow-xl shadow-primary/30 hover:bg-primary-dark hover:-translate-y-1 transition-all flex items-center gap-2 text-lg">
                                Mulai Jelajahi
                                <span class="material-symbols-outlined">arrow_downward</span>
                            </a>
                            <a href="#about"
                                class="px-8 py-4 bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-200 font-bold rounded-xl border border-slate-200 dark:border-slate-700 hover:border-primary dark:hover:border-primary hover:text-primary dark:hover:text-primary transition-all flex items-center gap-2 text-lg group">
                                Tentang Kami
                            </a>
                        </div>
                    </div>

                    <div class="relative lg:h-[600px] flex justify-center items-center animate-fade-in-up"
                        style="animation-delay: 0.2s;">
                        <!-- Abstract decorative circle -->
                        <div
                            class="absolute inset-0 bg-gradient-to-tr from-primary/20 to-transparent rounded-full blur-2xl transform scale-75 animate-pulse">
                        </div>

                        <img src="{{ asset('images/customer_support.png') }}" alt="Customer Support Illustration"
                            class="relative z-10 w-full max-w-lg object-contain animate-float drop-shadow-2xl" />

                        <!-- Floating Badges -->
                        <div class="absolute top-1/4 -left-6 bg-white dark:bg-slate-800 p-4 rounded-2xl shadow-xl border border-slate-100 dark:border-slate-700 glass animate-float"
                            style="animation-delay: 1s;">
                            <div class="flex items-center gap-3">
                                <div
                                    class="size-10 rounded-full bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center text-emerald-500">
                                    <span class="material-symbols-outlined">verified</span>
                                </div>
                                <div>
                                    <p class="text-sm font-bold">100% Aman</p>
                                    <p class="text-xs text-slate-500">Garansi Resolusi</p>
                                </div>
                            </div>
                        </div>

                        <div class="absolute bottom-1/4 -right-6 bg-white dark:bg-slate-800 p-4 rounded-2xl shadow-xl border border-slate-100 dark:border-slate-700 glass animate-float"
                            style="animation-delay: 1.5s;">
                            <div class="flex items-center gap-3">
                                <div
                                    class="size-10 rounded-full bg-amber-100 dark:bg-amber-900/30 flex items-center justify-center text-amber-500">
                                    <span class="material-symbols-outlined">bolt</span>
                                </div>
                                <div>
                                    <p class="text-sm font-bold">Respon Cepat</p>
                                    <p class="text-xs text-slate-500">
                                        < 24 Jam Kerja</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features" class="py-24 bg-white/50 dark:bg-slate-900/50 relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-2xl mx-auto mb-16">
                    <h2 class="text-primary font-bold tracking-wider uppercase text-sm mb-3">Keunggulan Sistem</h2>
                    <h3 class="text-3xl md:text-4xl font-extrabold">Kenapa Memilih Platform Kami?</h3>
                    <p class="mt-4 text-slate-600 dark:text-slate-400">Dirancang khusus untuk memberikan pengalaman
                        terbaik dalam menangani keluhan dan retur barang Anda.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="glass p-8 rounded-3xl hover:-translate-y-2 transition-transform duration-300 group">
                        <div
                            class="size-14 bg-blue-100 dark:bg-blue-900/30 rounded-2xl flex items-center justify-center text-primary mb-6 group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined text-3xl">speed</span>
                        </div>
                        <h4 class="text-xl font-bold mb-3">Proses Instan</h4>
                        <p class="text-slate-600 dark:text-slate-400">Tidak perlu menunggu lama. Ajukan formulir,
                            lampirkan bukti, dan tim kami akan segera memprosesnya.</p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="glass p-8 rounded-3xl hover:-translate-y-2 transition-transform duration-300 group">
                        <div
                            class="size-14 bg-purple-100 dark:bg-purple-900/30 rounded-2xl flex items-center justify-center text-purple-600 dark:text-purple-400 mb-6 group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined text-3xl">track_changes</span>
                        </div>
                        <h4 class="text-xl font-bold mb-3">Tracking Real-Time</h4>
                        <p class="text-slate-600 dark:text-slate-400">Pantau setiap tahapan komplain Anda dari pending,
                            in-progress, hingga approved atau done secara transparan.</p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="glass p-8 rounded-3xl hover:-translate-y-2 transition-transform duration-300 group">
                        <div
                            class="size-14 bg-emerald-100 dark:bg-emerald-900/30 rounded-2xl flex items-center justify-center text-emerald-600 dark:text-emerald-400 mb-6 group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined text-3xl">support_agent</span>
                        </div>
                        <h4 class="text-xl font-bold mb-3">Dukungan 24/7</h4>
                        <p class="text-slate-600 dark:text-slate-400">Tim support kami selalu siap sedia membantu Anda
                            menyelesaikan masalah kapanpun Anda butuhkan.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- About Us Section -->
        <section id="about" class="py-24 relative overflow-hidden">
            <div class="absolute inset-0 bg-primary/5 dark:bg-primary/10 -skew-y-3 transform origin-top-left z-0"></div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

                    <div class="order-2 lg:order-1 relative">
                        <div class="absolute inset-0 bg-primary/20 rounded-3xl transform rotate-3 scale-105"></div>
                        <img src="{{ asset('images/about_us_team.png') }}" alt="Tim anjayRPL"
                            class="relative rounded-3xl shadow-2xl z-10 w-full object-cover transition-transform duration-500 hover:scale-[1.02]" />
                    </div>

                    <div class="order-1 lg:order-2 space-y-6">
                        <h2 class="text-primary font-bold tracking-wider uppercase text-sm mb-2">Tentang Kami</h2>
                        <h3 class="text-4xl font-extrabold">Mengenal Tim <span
                                class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-purple-500">anjayRPL</span>
                        </h3>

                        <p class="text-lg text-slate-600 dark:text-slate-400 leading-relaxed">
                            Kami adalah sekelompok pengembang perangkat lunak (Software Engineers) yang bersemangat
                            dalam menciptakan solusi digital yang berdampak nyata.
                            Project <strong>Komplain & Retur</strong> ini lahir dari visi kami untuk menyederhanakan
                            birokrasi purna jual yang seringkali rumit.
                        </p>

                        <div class="space-y-4 pt-4">
                            <div class="flex gap-4">
                                <div
                                    class="size-12 rounded-xl bg-white dark:bg-slate-800 shadow-md flex items-center justify-center shrink-0">
                                    <span class="material-symbols-outlined text-primary">emoji_objects</span>
                                </div>
                                <div>
                                    <h5 class="font-bold text-lg">Inovasi Berkelanjutan</h5>
                                    <p class="text-sm text-slate-600 dark:text-slate-400">Kami terus mengadopsi
                                        teknologi terbaru seperti Tailwind CSS dan arsitektur modern untuk UI/UX
                                        terbaik.</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <div
                                    class="size-12 rounded-xl bg-white dark:bg-slate-800 shadow-md flex items-center justify-center shrink-0">
                                    <span class="material-symbols-outlined text-primary">groups</span>
                                </div>
                                <div>
                                    <h5 class="font-bold text-lg">Kolaborasi Tim</h5>
                                    <p class="text-sm text-slate-600 dark:text-slate-400">Setiap baris kode ditulis
                                        dengan dedikasi tinggi oleh tim kami untuk memastikan keandalan sistem.</p>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-20 relative">
            <div
                class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center bg-gradient-to-br from-primary to-purple-600 rounded-3xl p-12 shadow-2xl relative overflow-hidden group">
                <!-- Decorative elements -->
                <div
                    class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full blur-3xl transform translate-x-1/2 -translate-y-1/2 group-hover:scale-150 transition-transform duration-700">
                </div>
                <div
                    class="absolute bottom-0 left-0 w-48 h-48 bg-black/10 rounded-full blur-2xl transform -translate-x-1/2 translate-y-1/2 group-hover:scale-150 transition-transform duration-700">
                </div>

                <h2 class="relative z-10 text-3xl md:text-5xl font-extrabold text-white mb-6">Siap Menyelesaikan Masalah
                    Anda?</h2>
                <p class="relative z-10 text-primary-100 text-lg mb-8 max-w-2xl mx-auto text-white/80">
                    Bergabunglah sekarang dan rasakan kemudahan mengelola komplain dan pengembalian barang dalam satu
                    dashboard pintar.
                </p>
                <div class="relative z-10">
                    <a href="{{ url('/form') }}"
                        class="inline-flex items-center gap-2 px-8 py-4 bg-white text-primary font-bold rounded-xl shadow-lg hover:bg-slate-50 hover:scale-105 transition-all text-lg">
                        <span class="material-symbols-outlined">rocket_launch</span>
                        Ajukan Komplain Sekarang
                    </a>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="border-t border-slate-200 dark:border-slate-800 bg-white dark:bg-background-dark pt-16 pb-8">
            <div
                class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="flex items-center gap-2">
                    <div class="size-8 bg-primary rounded-lg flex items-center justify-center text-white">
                        <span class="material-symbols-outlined text-sm">cycle</span>
                    </div>
                    <span class="font-bold text-lg">anjayRPL</span>
                </div>

                <p class="text-slate-500 text-sm">
                    &copy; 2026 Komplain & Retur System. Crafted with passion by anjayRPL team.
                </p>

                <div class="flex gap-4">
                    <a href="#" class="text-slate-400 hover:text-primary transition-colors"><span
                            class="material-symbols-outlined">public</span></a>
                    <a href="#" class="text-slate-400 hover:text-primary transition-colors"><span
                            class="material-symbols-outlined">mail</span></a>
                </div>
            </div>
        </footer>

    </div>

    <!-- Script for Theme Toggle & Scroll Effects -->
    <script>
        // Check local storage for theme
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }

        // Toggle theme
        document.getElementById('theme-toggle').addEventListener('click', function () {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.theme = 'light';
            } else {
                document.documentElement.classList.add('dark');
                localStorage.theme = 'dark';
            }
        });

        // Navbar blur effect on scroll
        window.addEventListener('scroll', function () {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 20) {
                navbar.classList.add('shadow-md');
                navbar.classList.add('dark:shadow-slate-900/50');
            } else {
                navbar.classList.remove('shadow-md');
                navbar.classList.remove('dark:shadow-slate-900/50');
            }
        });
    </script>
</body>

</html>