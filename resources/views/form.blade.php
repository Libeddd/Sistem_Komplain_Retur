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
    <title>Form Retur</title>
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-slate-900 dark:text-slate-100 antialiased">
    <div class="relative flex min-h-screen w-full flex-col items-center justify-start pt-5 overflow-x-hidden p-4 sm:p-6">
        
        <button id="theme-toggle" class="absolute top-4 right-4 p-2 rounded-full bg-white dark:bg-slate-800 shadow-md hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors z-50">
            <span class="material-symbols-outlined dark:hidden">dark_mode</span>
            <span class="material-symbols-outlined hidden dark:block text-yellow-400">light_mode</span>
        </button>
        <div class="mb-6 flex items-center gap-3">
            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary text-white shadow-lg shadow-primary/20">
                <span class="material-symbols-outlined text-2xl">cycle</span>
            </div>
            <h1 class="text-2xl font-bold tracking-tight text-slate-900 dark:text-white">Komplain & Retur</h1>
        </div>  

        <div class="w-full max-w-md overflow-hidden rounded-xl bg-white dark:bg-slate-900 shadow-xl border border-slate-200 dark:border-slate-800">
            <div class="h-32 w-full bg-gradient-to-br from-primary to-indigo-700 relative overflow-hidden">
                <div class="absolute inset-0 opacity-20">
                    <svg class="h-full w-full" preserveaspectratio="none" viewbox="0 0 100 100"></svg>
                </div>
                <div class="absolute inset-0 flex flex-col items-center justify-center text-center">
                    <h1 class="text-4xl font-bold text-white">Form Retur</h1>
                    <p class="text-sm text-indigo-100">Layanan pengembalian barang bermasalah</p>
                </div>
            </div>

            <div class="p-6">
                <form class="space-y-6" id="retur-form" method="POST" action="{{ route('complaint.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="kategori_final" name="kategori">
                    <input type="hidden" id="detail_final" name="detail">
                    <input type="hidden" id="produk_final" name="produk_name">
                    <input type="hidden" id="serial_final" name="serial">
                    
                    <div id="step-1-container">
                        <div class="space-y-1 mb-6">
                            <label class="text-lg font-bold text-slate-700 dark:text-slate-300" for="kendala">Kendala</label>
                            <p class="text-sm font-thin text-slate-700 dark:text-slate-300">Pilih kendala yang sesuai dengan masalah Anda</p>
                            <select id="kendala" name="kendala" onchange="tampilkanForm()" class="w-full border border-gray-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white rounded-md px-4 py-2 mt-2 focus:border-indigo-500 focus:ring-indigo-500" required>
                                <option value="" disabled selected hidden>Pilih Kendala</option>
                                <option value="barang_rusak">Barang Rusak</option>
                                <option value="barang_tidak_sesuai">Barang Tidak Sesuai</option>
                            </select>
                        </div>

                        <div id="form-rusak" style="display:none;" class="space-y-4">
                            <div>
                                <label class="text-lg font-bold text-slate-700 dark:text-slate-300">Tipe Kerusakan</label>
                                <select id="kategori_rusak" class="w-full border border-gray-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white rounded-md px-4 py-2 mt-1 focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="" disabled selected hidden>Pilih Tipe</option>
                                    <option value="Pecah/Retak">Pecah / Retak / Penyok / Patah</option>
                                    <option value="Tidak Berfungsi">Tidak Berfungsi</option>
                                    <option value="Mati Total">Mati Total</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                            
                            <div>
                                <label class="text-lg font-bold text-slate-700 dark:text-slate-300">Upload Foto Produk</label>
                                <p class="text-sm font-thin text-slate-700 dark:text-slate-300 mb-2">Bukti foto kerusakan barang <span class="font-bold text-red-500">(Maks. 25MB)</span></p>
                                <input id="foto_rusak" class="w-full text-sm" type="file" name="foto_rusak" accept=".jpg,.jpeg,.png,.pdf" onchange="cekUkuranFile(this)">
                            </div>
                            <div>
                                <label class="text-lg font-bold text-slate-700 dark:text-slate-300">Upload Video Unboxing (Opsional)</label>
                                <p class="text-sm font-thin text-slate-700 dark:text-slate-300 mb-2">Bukti video unboxing <span class="font-bold text-red-500">(Maks. 25MB)</span></p>
                                <input id="video_rusak" class="w-full text-sm" type="file" name="video_rusak" accept=".mp4,.mov" onchange="cekUkuranFile(this)">
                            </div>
                            <div>
                                <label class="text-lg font-bold text-slate-700 dark:text-slate-300">Detail Kerusakan</label>
                                <p class="text-sm font-thin text-slate-700 dark:text-slate-300 mb-2">Deskripsikan detail kerusakannya</p>
                                <textarea id="detail_rusak" class="w-full border border-gray-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white rounded-md p-2 focus:border-indigo-500 focus:ring-indigo-500" rows="3" placeholder="Masukkan detail kerusakan..."></textarea>
                            </div>
                            <div>
                                <label class="text-lg font-bold text-slate-700 dark:text-slate-300">Nama Produk</label>
                                <input id="produk_rusak" class="w-full border border-gray-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white rounded-md p-2 focus:border-indigo-500 focus:ring-indigo-500 mt-1" type="text" placeholder="Contoh: Keyboard Mechanical X1">
                            </div>
                            <div>
                                <label class="text-lg font-bold text-slate-700 dark:text-slate-300">Nomor Serial Pesanan</label>
                                <input id="serial_rusak" class="w-full border border-gray-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white rounded-md p-2 focus:border-indigo-500 focus:ring-indigo-500 mt-1" type="text" placeholder="Contoh: ORD-2026-XYZ">
                            </div>
                            <button type="button" onclick="lanjutKeStep2()" class="w-full mt-4 rounded-lg bg-primary py-3.5 text-sm font-bold text-white shadow-lg shadow-primary/30 hover:bg-primary/90 focus:ring-4 focus:ring-primary/20 transition-all"> Selanjutnya </button>
                        </div>

                        <div id="form-salah" style="display:none;" class="space-y-4">
                            <div>
                                <label class="text-lg font-bold text-slate-700 dark:text-slate-300">Tipe Ketidaksesuaian</label>
                                <select id="kategori_salah" class="w-full border border-gray-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white rounded-md px-4 py-2 mt-1 focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="" disabled selected hidden>Pilih Tipe</option>
                                    <option value="Salah Warna">Salah Warna</option>
                                    <option value="Lainnya">Barang Berbeda / Model Lain / Salah Ukuran</option>
                                </select>
                            </div>

                            <div>
                                <label class="text-lg font-bold text-slate-700 dark:text-slate-300">Upload Foto Produk</label>
                                <p class="text-sm font-thin text-slate-700 dark:text-slate-300 mb-2">Bukti foto barang yang datang <span class="font-bold text-red-500">(Maks. 25MB)</span></p>
                                <input id="foto_salah" class="w-full text-sm" type="file" name="foto_salah" accept=".jpg,.jpeg,.png,.pdf" onchange="cekUkuranFile(this)">
                            </div>
                            <div>
                                <label class="text-lg font-bold text-slate-700 dark:text-slate-300">Upload Video Unboxing (Opsional)</label>
                                <p class="text-sm font-thin text-slate-700 dark:text-slate-300 mb-2">Bukti video unboxing <span class="font-bold text-red-500">(Maks. 25MB)</span></p>
                                <input id="video_salah" class="w-full text-sm" type="file" name="video_salah" accept=".mp4,.mov" onchange="cekUkuranFile(this)">
                            </div>
                            <div>
                                <label class="text-lg font-bold text-slate-700 dark:text-slate-300">Detail Keterangan</label>
                                <p class="text-sm font-thin text-slate-700 dark:text-slate-300 mb-2">Jelaskan letak ketidaksesuaiannya</p>
                                <textarea id="detail_salah" class="w-full border border-gray-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white rounded-md p-2 focus:border-indigo-500 focus:ring-indigo-500" rows="3" placeholder="Contoh: Pesan warna hitam, datang putih..."></textarea>
                            </div>
                            <div>
                                <label class="text-lg font-bold text-slate-700 dark:text-slate-300">Nama Produk</label>
                                <input id="produk_salah" class="w-full border border-gray-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white rounded-md p-2 focus:border-indigo-500 focus:ring-indigo-500 mt-1" type="text" placeholder="Contoh: Kemeja Flanel">
                            </div>
                            <div>
                                <label class="text-lg font-bold text-slate-700 dark:text-slate-300">Nomor Serial Pesanan</label>
                                <input id="serial_salah" class="w-full border border-gray-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white rounded-md p-2 focus:border-indigo-500 focus:ring-indigo-500 mt-1" type="text" placeholder="Contoh: ORD-2026-XYZ">
                            </div>
                            <button type="button" onclick="lanjutKeStep2()" class="w-full mt-4 rounded-lg bg-primary py-3.5 text-sm font-bold text-white shadow-lg shadow-primary/30 hover:bg-primary/90 focus:ring-4 focus:ring-primary/20 transition-all"> Selanjutnya </button>
                        </div>
                    </div>

                    <div id="step-2-container" style="display:none;" class="space-y-4">
                        <div class="flex items-center gap-2 mb-4">
                            <button type="button" onclick="kembaliKeStep1()" class="text-slate-500 hover:text-primary transition-colors">
                                <span class="material-symbols-outlined text-[20px]">arrow_back</span>
                            </button>
                            <h3 class="text-lg font-bold text-slate-700 dark:text-slate-300">Informasi Pengiriman & Refund</h3>
                        </div>

                        <div>
                            <label class="text-lg font-bold text-slate-700 dark:text-slate-300">Alamat Lengkap</label>
                            <p class="text-sm font-thin text-slate-700 dark:text-slate-300 mb-2">Alamat pengambilan barang retur</p>
                            <textarea id="alamat_lengkap" name="alamat_lengkap" class="w-full border border-gray-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white rounded-md p-2 focus:border-indigo-500 focus:ring-indigo-500" rows="3" placeholder="Masukkan alamat lengkap..." required></textarea>
                        </div>
                        
                        <div>
                            <label class="text-lg font-bold text-slate-700 dark:text-slate-300">Pilih Tipe Refund</label>
                            <p class="text-sm font-thin text-slate-700 dark:text-slate-300 mb-2">Metode pengembalian dana</p>
                            <select id="tipe_refund" name="tipe_refund" onchange="toggleMetodeRefund()" class="w-full border border-gray-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white rounded-md px-4 py-2 focus:border-indigo-500 focus:ring-indigo-500" required>
                                <option value="" disabled selected hidden>Pilih Tipe</option>
                                <option value="bank">Transfer Bank</option>
                                <option value="ewallet">E-Wallet</option>
                            </select>
                        </div>

                        <div id="opsi_bank" style="display:none;" class="space-y-4 p-4 border border-slate-200 rounded-lg bg-slate-50 dark:bg-slate-800">
                            <div>
                                <label class="text-sm font-bold text-slate-700 dark:text-slate-300">Pilih Bank</label>
                                <select id="pilihan_bank" name="pilihan_bank" class="w-full border border-gray-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white rounded-md px-3 py-2 mt-1 text-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="" disabled selected hidden>Pilih Bank</option>
                                    <option value="BCA">BCA (10 Digit)</option>
                                    <option value="BRI">BRI (15 Digit)</option>
                                    <option value="BNI">BNI (10 Digit)</option>
                                    <option value="MANDIRI">Mandiri (13 Digit)</option>
                                </select>
                            </div>
                            <div>
                                <label class="text-sm font-bold text-slate-700 dark:text-slate-300">Nomor Rekening</label>
                                <input id="nomor_rekening" name="nomor_rekening" class="w-full border border-gray-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white rounded-md p-2 mt-1 text-sm focus:border-indigo-500 focus:ring-indigo-500" type="text" inputmode="numeric" pattern="[0-9]*" oninput="this.value = this.value.replace(/[^0-9]/g, '')" placeholder="Masukkan nomor rekening valid">
                            </div>
                        </div>

                        <div id="opsi_ewallet" style="display:none;" class="space-y-4 p-4 border border-slate-200 rounded-lg bg-slate-50 dark:bg-slate-800">
                            <div>
                                <label class="text-sm font-bold text-slate-700 dark:text-slate-300">Pilih E-Wallet</label>
                                <select id="pilihan_ewallet" name="pilihan_ewallet" class="w-full border border-gray-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white rounded-md px-3 py-2 mt-1 text-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="" disabled selected hidden>Pilih Aplikasi</option>
                                    <option value="GOPAY">GoPay</option>
                                    <option value="OVO">OVO</option>
                                    <option value="DANA">DANA</option>
                                    <option value="SHOPEEPAY">ShopeePay</option>
                                </select>
                            </div>
                            <div>
                                <label class="text-sm font-bold text-slate-700 dark:text-slate-300">Nomor Handphone Terdaftar</label>
                                <input id="nomor_hp_ewallet" name="nomor_hp_ewallet" class="w-full border border-gray-300 dark:border-slate-700 dark:bg-slate-800 dark:text-white rounded-md p-2 mt-1 text-sm focus:border-indigo-500 focus:ring-indigo-500" type="text" inputmode="numeric" pattern="[0-9]*" oninput="this.value = this.value.replace(/[^0-9]/g, '')" placeholder="Contoh: 08123456789">
                            </div>
                        </div>

                        <button type="button" onclick="submitValidasiAkhir()" class="w-full mt-4 rounded-lg bg-emerald-600 py-3.5 text-sm font-bold text-white shadow-lg shadow-emerald-600/30 hover:bg-emerald-700 focus:ring-4 focus:ring-emerald-600/20 transition-all"> Kirim Form Retur </button>
                    </div>

                </form>
            </div>

            <script>
                function cekUkuranFile(input) {
                    if (input.files && input.files[0]) {
                        let fileSize = input.files[0].size;
                        let maxSize = 25 * 1024 * 1024;
                        if (fileSize > maxSize) {
                            alert("Oops! Ukuran file terlalu besar. Maksimal kapasitas adalah 25MB.");
                            input.value = "";
                        }
                    }
                }

                function tampilkanForm() {
                    let pilihan = document.getElementById("kendala").value;
                    document.getElementById("form-rusak").style.display = "none";
                    document.getElementById("form-salah").style.display = "none";

                    if (pilihan === "barang_rusak") {
                        document.getElementById("form-rusak").style.display = "block";
                    } else if (pilihan === "barang_tidak_sesuai") {
                        document.getElementById("form-salah").style.display = "block";
                    }
                }

                function lanjutKeStep2() {
                    let pilihan = document.getElementById("kendala").value;
                    let isValid = true;

                    if (pilihan === "barang_rusak") {
                        let kategori = document.getElementById("kategori_rusak").value; 
                        let foto = document.getElementById("foto_rusak").value;
                        let detail = document.getElementById("detail_rusak").value;
                        let produk = document.getElementById("produk_rusak").value;
                        let serial = document.getElementById("serial_rusak").value;

                        if (!kategori || !foto || !detail.trim() || !produk.trim() || !serial.trim()) isValid = false;
                    } 
                    else if (pilihan === "barang_tidak_sesuai") {
                        let kategori = document.getElementById("kategori_salah").value; 
                        let foto = document.getElementById("foto_salah").value;
                        let detail = document.getElementById("detail_salah").value;
                        let produk = document.getElementById("produk_salah").value;
                        let serial = document.getElementById("serial_salah").value;

                        if (!kategori || !foto || !detail.trim() || !produk.trim() || !serial.trim()) isValid = false;
                    } 
                    else {
                        alert("Silakan pilih kendala terlebih dahulu!");
                        return;
                    }

                    if (!isValid) {
                        alert("Harap lengkapi semua data wajib (Tipe Kendala, Foto, Detail, Nama Produk, dan Nomor Serial) sebelum melanjutkan!");
                        return; 
                    }

                    document.getElementById("step-1-container").style.display = "none";
                    document.getElementById("step-2-container").style.display = "block";
                }

                function kembaliKeStep1() {
                    document.getElementById("step-2-container").style.display = "none";
                    document.getElementById("step-1-container").style.display = "block";
                }

                function toggleMetodeRefund() {
                    let tipe = document.getElementById("tipe_refund").value;
                    let opsiBank = document.getElementById("opsi_bank");
                    let opsiEwallet = document.getElementById("opsi_ewallet");

                    if (tipe === "bank") {
                        opsiBank.style.display = "block";
                        opsiEwallet.style.display = "none";
                    } else if (tipe === "ewallet") {
                        opsiBank.style.display = "none";
                        opsiEwallet.style.display = "block";
                    }
                }

                function submitValidasiAkhir() {
                    let kendala = document.getElementById("kendala").value;
                    let alamat = document.getElementById("alamat_lengkap").value;
                    let tipeRefund = document.getElementById("tipe_refund").value;
                    let kategori = kendala === "barang_rusak" ? document.getElementById("kategori_rusak").value : document.getElementById("kategori_salah").value;
                    let detail = kendala === "barang_rusak" ? document.getElementById("detail_rusak").value : document.getElementById("detail_salah").value;
                    let produk = kendala === "barang_rusak" ? document.getElementById("produk_rusak").value : document.getElementById("produk_salah").value;
                    let serial = kendala === "barang_rusak" ? document.getElementById("serial_rusak").value : document.getElementById("serial_salah").value;
                    document.getElementById("kategori_final").value = kategori;
                    document.getElementById("detail_final").value = detail;
                    document.getElementById("produk_final").value = produk;
                    document.getElementById("serial_final").value = serial;
                    if (!alamat.trim()) { alert("Alamat lengkap wajib diisi!"); return; }
                    if (tipeRefund === "bank") {
                        let namaBank = document.getElementById("pilihan_bank").value;
                        let noRekening = document.getElementById("nomor_rekening").value;
                        if (!namaBank || !noRekening) { alert("Pilih Bank dan masukkan No. Rekening!"); return; }
                        let valid = (namaBank === "BCA" && noRekening.length === 10) || (namaBank === "MANDIRI" && noRekening.length === 13) || (namaBank === "BNI" && noRekening.length === 10) || (namaBank === "BRI" && noRekening.length === 15);
                        if (!valid) { alert("Nomor rekening tidak sesuai format Bank!"); return; }
                    } else if (tipeRefund === "ewallet") {
                        let namaEwallet = document.getElementById("pilihan_ewallet").value;
                        let noHp = document.getElementById("nomor_hp_ewallet").value;
                        if (!namaEwallet || !noHp) { alert("Pilih E-Wallet dan masukkan Nomor HP!"); return; }
                        if (!noHp.startsWith("08") || noHp.length < 10 || noHp.length > 13) { alert("Nomor Handphone tidak valid!"); return; }
                    } else { alert("Pilih Tipe Refund terlebih dahulu!"); return; }
                    if (kendala === "barang_rusak") {
                        document.getElementById("foto_rusak").name = "foto";
                        document.getElementById("video_rusak").name = "video";
                        document.getElementById("foto_salah").removeAttribute("name");
                        document.getElementById("video_salah").removeAttribute("name");
                    } else {
                        document.getElementById("foto_salah").name = "foto";
                        document.getElementById("video_salah").name = "video";
                        document.getElementById("foto_rusak").removeAttribute("name");
                        document.getElementById("video_rusak").removeAttribute("name");
                    }
                    document.getElementById("retur-form").submit();
                }
            </script>
        </div>
    </div>
    
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
