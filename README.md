# 📦 Sistem Komplain & Retur Produk Retail Lokal

<div align="center">
  <p><strong>Aplikasi berbasis web untuk mengelola retur & komplain secara sistematis.</strong></p>
  <p><i>Dibuat sebagai pemenuhan Tugas Mata Kuliah Rekayasa Perangkat Lunak (RPL) oleh Kelompok 2.</i></p>
</div>

---

## 📖 Deskripsi Proyek
**Sistem Komplain & Retur** adalah platform digital yang dirancang untuk menyederhanakan birokrasi purna jual antara pelanggan dan pihak pengelola retail. Sistem ini memfasilitasi pengajuan komplain barang rusak atau tidak sesuai, memberikan transparansi riwayat status kepada pelanggan, serta menyediakan antarmuka analitik dinamis bagi admin untuk pengambilan keputusan.

---

## ✨ Fitur Utama (Wajib & Kompleksitas)

### Untuk Customer (Pelanggan)
- 📝 **Pengajuan Komplain Dinamis:** Mendukung pemisahan form berdasarkan kendala ("Barang Rusak" atau "Barang Tidak Sesuai") dengan validasi spesifik.
- 📸 **Validasi Bukti Otomatis:** Sistem wajib unggah bukti Foto dan/atau Video unboxing dengan batasan ukuran *file* untuk validasi kondisi barang.
- 🔍 **Tracking Riwayat Real-Time:** Pelanggan dapat melacak status komplain mereka (Pending, Review, Approved, Rejected, Done).
- 🔐 **Isolasi Privasi Data:** Pelanggan hanya dapat melihat dan mengakses riwayat komplain miliknya sendiri.

### Untuk Admin (Pengelola)
- 📊 **Dashboard Analitik Dinamis:** Deteksi otomatis *Top Produk* yang dikomplain, *Kategori Dominan* kerusakan, dan *Grafik Trend* keluhan secara *real-time*.
- 🗂️ **Manajemen Workflow Retur:** Kemampuan untuk meninjau (Review) detail komplain melalui *Floating Modal*, lalu memperbarui status (Approve, Reject, Done).
- 🛡️ **Rule Category & Fraud Detection:** Pencegahan manipulasi data melalui isolasi *middleware* perlindungan *route* admin dan validasi data server-side.

### Antarmuka Pengguna (UI/UX)
- 🌓 **Global Dark Mode Persistent:** Fitur mode gelap/terang yang terintegrasi di seluruh halaman dengan kemampuan menyimpan preferensi memori *browser*.
- ⚡ **Anti-FOUC Architecture:** Skema arsitektur antarmuka yang mencegah kedipan halaman (*Flash of Unstyled Content*) saat navigasi di mode gelap.

---

## 🛠️ Teknologi yang Digunakan
- **Backend:** Laravel (PHP Framework)
- **Frontend:** HTML5, Blade Templating, Vanilla JavaScript
- **Styling:** Tailwind CSS (via CDN)
- **Database:** MySQL
- **Chart/Grafik:** Chart.js

---

## 📂 Dokumentasi Kode & Struktur Direktori

Berikut adalah direktori utama tempat logika spesifik proyek ini berada:

```text
Sistem_Komplain_Retur/
├── app/
│   ├── Http/Controllers/
│   │   ├── AdminController.php      # Menangani logika dashboard analitik & manajemen status admin
│   │   ├── AuthController.php       # Menangani proses Login & Register pengguna
│   │   └── ComplaintController.php  # Menangani submit form komplain dan upload bukti file (Storage)
│   ├── Models/
│   │   ├── Complaint.php            # Representasi tabel complaints dan relasi User
│   │   └── User.php                 # Representasi entitas pengguna (role: customer/admin)
├── database/
│   ├── migrations/
│   │   └── ...create_complaints_table.php # Skema arsitektur database komplain 
├── resources/
│   ├── views/
│   │   ├── dashboard.blade.php      # UI Dashboard Admin (Grafik, Analitik)
│   │   ├── form.blade.php           # UI Form Pengajuan Komplain Customer
│   │   ├── home.blade.php           # UI Riwayat Komplain Customer
│   │   ├── login.blade.php          # UI Autentikasi
│   │   ├── manajemen-komplain.blade.php # UI Tabel Admin & Floating Review Modal
│   │   ├── register.blade.php       # UI Pendaftaran
│   │   └── welcome.blade.php        # UI Landing Page Informasi Produk
└── routes/
    └── web.php                      # Definisi routing, proteksi Auth Middleware & Role Middleware
```

---

## ⚙️ Panduan Instalasi (Local Development)

Ikuti langkah-langkah di bawah ini untuk menjalankan proyek secara lokal:

1. **Clone Repositori**
   ```bash
   git clone https://github.com/Libeddd/Sistem_Komplain_Retur.git
   cd Sistem_Komplain_Retur
   ```

2. **Instalasi Dependencies PHP**
   ```bash
   composer install
   ```

3. **Konfigurasi Environment**
   Gandakan file `.env.example` menjadi `.env`, lalu sesuaikan konfigurasi database Anda.
   ```bash
   cp .env.example .env
   ```
   *Buka `.env` dan pastikan konfigurasi MySQL:*
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=nama_database_anda
   DB_USERNAME=root
   DB_PASSWORD=
   ```

4. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

5. **Migrasi Database & Symbolic Link Storage**
   Jalankan migrasi untuk membuat tabel, dan *link* folder `storage` agar foto/video komplain dapat diakses publik.
   ```bash
   php artisan migrate
   php artisan storage:link
   ```

6. **Jalankan Server Lokal**
   ```bash
   php artisan serve
   ```
   Akses aplikasi di `http://127.0.0.1:8000` pada web browser Anda.

---

<div align="center">
  <b>Tugas Rekayasa Perangkat Lunak - 2026</b><br>
  Didesain dengan ❤️ oleh Kelompok 2
</div>
