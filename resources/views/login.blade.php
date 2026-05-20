<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
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
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <title>Login</title>
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-slate-900 dark:text-slate-100 antialiased">
    <div class="relative flex min-h-screen w-full flex-col items-center justify-center overflow-x-hidden p-4">
        
        <button id="theme-toggle" class="absolute top-4 right-4 p-2 rounded-full bg-white dark:bg-slate-800 shadow-md hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors z-50">
            <span class="material-symbols-outlined dark:hidden">dark_mode</span>
            <span class="material-symbols-outlined hidden dark:block text-yellow-400">light_mode</span>
        </button>
        <div class="mb-8 flex items-center gap-3">
            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary text-white shadow-lg shadow-primary/20">
                <span class="material-symbols-outlined text-2xl">cycle</span>
            </div>
            <h1 class="text-2xl font-bold tracking-tight text-slate-900 dark:text-white">Komplain & Retur</h1>
        </div>

        <div class="w-full max-w-md overflow-hidden rounded-xl bg-white dark:bg-slate-900 shadow-xl border border-slate-200 dark:border-slate-800">
            <div class="h-32 w-full bg-gradient-to-br from-primary to-indigo-700 relative overflow-hidden">
                <div class="absolute inset-0 opacity-20" data-alt="Abstract geometric tech pattern background">
                    <svg class="h-full w-full" preserveaspectratio="none" viewbox="0 0 100 100"></svg>
                </div>
                <div class="absolute inset-0 flex flex-col items-center justify-center text-center">
                    <h1 class="text-4xl font-bold text-white">Selamat Datang</h1>
                    <p class="text-sm text-indigo-100">Website Komplain & Retur Produk</p>
                </div>
            </div>

            <div class="p-8">
                <form class="space-y-6" method="POST" action="{{ route('login.submit') }}">
                    @csrf
                    @if ($errors->any())
                        <div class="bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 p-3 rounded-lg text-sm border border-red-200 dark:border-red-800">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700 dark:text-slate-300" for="email">Email</label>
                        <div class="relative group">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors">mail</span>
                            <input class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 py-3 pl-11 pr-4 text-slate-900 dark:text-white focus:border-primary focus:ring-primary/20 transition-all outline-none" id="email" name="email" placeholder="nama@gmail.com" required="" type="email"/>
                        </div>
                    </div>
                    
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <label class="text-sm font-semibold text-slate-700 dark:text-slate-300" for="password">Kata Sandi</label>
                        </div>
                        <div class="relative group">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors">lock</span>
                            <input class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 py-3 pl-11 pr-12 text-slate-900 dark:text-white focus:border-primary focus:ring-primary/20 transition-all outline-none" id="password" name="password" placeholder="••••••••" required="" type="password"/>
                            <button class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 transition-colors" type="button" onclick="togglePassword()">
                                <span class="material-symbols-outlined" id="eye-icon">visibility</span>
                            </button>
                        </div>
                    </div>
                    
                    <button class="w-full rounded-lg bg-primary py-3.5 text-sm font-bold text-white shadow-lg shadow-primary/30 hover:bg-primary/90 focus:ring-4 focus:ring-primary/20 transition-all" type="submit"> Masuk </button>
                </form>

                <div class="mt-8 text-center">
                    <p class="text-sm text-slate-500 dark:text-slate-400">
                        Belum punya akun? 
                        <a class="font-semibold text-primary hover:underline transition-all" href="{{ url('/register') }}">Buat Sekarang</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>

        // Fitur untuk melihat/menyembunyikan password
        function togglePassword() {
            let pwdInput = document.getElementById("password");
            let eyeIcon = document.getElementById("eye-icon");

            if (pwdInput.type === "password") {
                pwdInput.type = "text";
                eyeIcon.innerText = "visibility_off";
            } else {
                pwdInput.type = "password";
                eyeIcon.innerText = "visibility";
            }
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const themeToggleBtn = document.getElementById('theme-toggle');
            if (themeToggleBtn) {
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
        });
    </script>
</body>
</html>
