# 📋 Test Case — Sistem Komplain & Return (Kelompok 2)

> **Tujuan Dokumen:**
> Dokumen ini berisi seluruh test case proyek Sistem Komplain & Return. Setiap test case yang berstatus **`Fail`** atau **`Proses`** harus diperbaiki oleh developer/tim yang bertanggung jawab (PIC). Gunakan kolom **Action Required** pada tiap test case sebagai panduan teknis untuk melakukan perbaikan.

---

## 🗂️ Ringkasan Status

| Status | Jumlah |
|--------|--------|
| ✅ Done | 3 (TC-001, TC-002, TC-005) |
| 🔄 Proses | 3 (TC-003, TC-004, TC-006) |
| ❌ Fail | 7 (TC-007, TC-008, TC-009, TC-010, TC-011, TC-012, TC-013) |

---

## 🚨 Prioritas Perbaikan (Berdasarkan Severity & Status)

| Urutan | TC ID | Severity | Masalah Utama |
|--------|-------|----------|---------------|
| 1 | TC-007 | 🔴 High | Validasi email domain bocor — potensi data spam masuk database |
| 2 | TC-008 | 🔴 High | Input nama tidak disanitasi — potensi celah **Stored XSS** |
| 3 | TC-012 | 🔴 High | Status workflow komplain tidak sesuai SRS (hanya 2 dari 6 status) |
| 4 | TC-013 | 🔴 High | Fitur input nomor resi tidak tersedia — **blocker alur kerja** |
| 5 | TC-006 | 🔴 High (Proses) | Fitur upload bukti transfer hilang + tidak ada validasi wajib upload |
| 6 | TC-004 | 🔵 Low (Proses) | Error 403 Forbidden saat admin akses foto bukti retur |
| 7 | TC-010 | 🟡 Medium | Logic form retur salah — alamat customer tidak relevan |
| 8 | TC-003 | 🔵 Low (Proses) | Overlapping UI di Hero Section — gambar menutupi card |
| 9 | TC-009 | 🔵 Low | Konsistensi bahasa campuran (Indoglish) di seluruh UI |
| 10 | TC-011 | 🔵 Low | Tidak ada tombol "Kembali" di halaman Form Retur |

---

## 📄 Detail Setiap Test Case

---

### ✅ TC-001 — Documentation: Revisi SRS

| Field | Detail |
|-------|--------|
| **TC ID** | TC-001 |
| **Feature** | Documentation |
| **Sub Feature** | SRS Review |
| **Scenario** | Revisi SRS |
| **Status** | ✅ Done |
| **Severity** | Low |
| **Priority** | High |
| **PIC** | QA Team |

**Preconditions:**
- Dokumen SRS tersedia dan dapat diakses.

**Test Steps:**
1. Membaca alur/fitur yang terdokumentasi di dalam SRS.
2. Mencari alur atau fitur yang mencurigakan, ambigu, atau tidak konsisten.
3. Merevisi atau memberi tahu System Analyst untuk diperbaiki.

**Test Data:**
- Dokumen SRS (file dokumen)

**Expected Result:**
> Dokumen SRS sesuai dengan alur dan fitur yang telah direncanakan di awal proyek.

**Actual Result:**
> ✅ Sesuai permintaan client. Tidak ada perubahan diperlukan.

**Notes:** —

---

### ✅ TC-002 — Documentation: Revisi Business Rules & Use Case

| Field | Detail |
|-------|--------|
| **TC ID** | TC-002 |
| **Feature** | Documentation |
| **Sub Feature** | Business Rules |
| **Scenario** | Revisi Business Rules & Use Case |
| **Status** | ✅ Done |
| **Severity** | Low |
| **Priority** | High |
| **PIC** | QA Team |

**Preconditions:**
- Dokumen Business Rules & Use Case tersedia dan dapat diakses.

**Test Steps:**
1. Membaca seluruh aturan bisnis yang terdokumentasi di SRS.
2. Mencari aturan yang tidak konsisten atau berpotensi salah.
3. Merevisi atau menginformasikan ke System Analyst untuk diperbaiki.

**Test Data:**
- Dokumen Business Rules (file dokumen)

**Expected Result:**
> Seluruh aturan bisnis pada dokumen sesuai dengan yang telah disepakati di awal bersama client.

**Actual Result:**
> ✅ Sesuai permintaan client. Tidak ada perubahan diperlukan.

**Notes:** —

---

### 🔄 TC-003 — Landing Page: Overlapping UI di Hero Section

| Field | Detail |
|-------|--------|
| **TC ID** | TC-003 |
| **Feature** | Landing Page |
| **Sub Feature** | Hero Section (UI Layout) |
| **Scenario** | Memastikan elemen card dan gambar ilustrasi di sisi kanan tidak saling bertumpuk |
| **Status** | 🔄 Proses |
| **Severity** | Low |
| **Priority** | High |
| **PIC** | Backend Dev / DevOps |

**Preconditions:**
- Mengakses URL aplikasi pada browser desktop (resolusi standar, min 1280px).

**Test Steps:**
1. Buka halaman Landing Page di browser desktop.
2. Perhatikan area Hero Section (bagian utama halaman pertama yang terlihat).
3. Amati posisi gambar ilustrasi dan card informasi di sisi kanan.
4. Periksa apakah keduanya tampil berdampingan dengan rapi tanpa tumpang tindih.
5. Baca teks di dalam card — pastikan seluruh teks terlihat utuh dan tidak terpotong.

**Test Data:**
- Build web (environment staging/production)

**Expected Result:**
> - Elemen gambar ilustrasi dan card informasi harus tampil **berdampingan** tanpa saling menutupi.
> - Teks di dalam card harus terlihat **utuh dan dapat dibaca seluruhnya**.

**Actual Result:**
> ❌ Gambar ilustrasi **menutupi (overlap)** card informasi di sebelah kanannya. Teks pada card terpotong dan hanya sebagian yang terbaca (terlihat potongan teks seperti "...Cepat" dan "...Kerja").

**Action Required untuk Developer:**
> **[UI Bug — Overlapping Element]**
> Terjadi overlapping antara elemen ilustrasi dan card informasi di Hero Section.
> - Periksa **CSS property** pada container gambar ilustrasi: `position`, `z-index`, `margin`, `padding`.
> - Pastikan card tidak memiliki `position: absolute` yang tidak terkontrol.
> - Gunakan **Flexbox** atau **CSS Grid** untuk mengatur tata letak berdampingan.
> - Sertakan screenshot sebelum dan sesudah perbaikan.

---

### 🔄 TC-004 — Admin Dashboard: Error 403 Saat Akses Foto Bukti Retur

| Field | Detail |
|-------|--------|
| **TC ID** | TC-004 |
| **Feature** | Admin Dashboard |
| **Sub Feature** | Detail Komplain & Retur |
| **Scenario** | Admin melihat foto bukti kerusakan pengembalian barang dari Customer |
| **Status** | 🔄 Proses |
| **Severity** | Low |
| **Priority** | High |
| **PIC** | Backend Dev / DevOps |

**Preconditions:**
1. Customer telah berhasil submit form retur dengan melampirkan foto bukti kerusakan.
2. Admin telah berhasil login ke Dashboard Admin.

**Test Steps:**
1. Admin membuka halaman Detail Komplain / Detail Retur.
2. Admin mencari dan mengklik tiket yang sudah di-submit oleh customer dengan foto.
3. Admin mencoba melihat/membuka foto bukti kerusakan yang dilampirkan customer.

**Test Data:**
- Akun Admin aktif
- Tiket retur yang sudah memiliki lampiran foto dari customer

**Expected Result:**
> - Foto bukti kerusakan yang diupload oleh customer berhasil **dimuat dan ditampilkan dengan jelas** kepada Admin.
> - HTTP Response harus **200 OK** saat mengakses URL foto tersebut.

**Actual Result:**
> ❌ Muncul halaman error **"403 Forbidden"**. Admin tidak bisa melihat foto bukti sama sekali.
> - URL yang bermasalah: `/storage/complaints/fotos/...jpg`

**Action Required untuk Backend Dev / DevOps:**
> **[403 Forbidden — Storage Permission Error]**
> Proses verifikasi admin terblokir karena masalah hak akses file storage.
>
> Langkah debug yang disarankan:
> 1. **Periksa permission folder** `storage/complaints/` di server:
>    ```bash
>    ls -la storage/app/public/complaints/
>    chmod -R 775 storage/
>    chown -R www-data:www-data storage/
>    ```
> 2. **Pastikan symlink sudah dibuat** dan berjalan dengan benar:
>    ```bash
>    php artisan storage:link
>    ```
> 3. **Verifikasi konfigurasi `filesystem` di `.env`**:
>    ```
>    FILESYSTEM_DISK=public
>    ```
> 4. **Jika menggunakan middleware auth** pada route storage, pastikan role Admin sudah memiliki akses ke resource tersebut.

---

### ✅ TC-005 — Form Retur: Kontras Warna Dropdown di Dark Mode

| Field | Detail |
|-------|--------|
| **TC ID** | TC-005 |
| **Feature** | Form Retur |
| **Sub Feature** | Dark Mode |
| **Scenario** | Memastikan teks opsi pada dropdown "Kendala" dan "Tipe Kerusakan" terlihat jelas saat mode gelap aktif |
| **Status** | ✅ Done |
| **Severity** | Low |
| **Priority** | High |
| **PIC** | Frontend Dev |

**Preconditions:**
- Sistem mendukung Dark Mode dan fitur Dark Mode sedang **diaktifkan** oleh pengguna.

**Test Steps:**
1. Aktifkan Dark Mode di aplikasi atau perangkat.
2. Navigasi ke halaman Form Retur.
3. Klik pada dropdown "Kendala" — amati warna teks opsi di dalamnya.
4. Klik pada dropdown "Tipe Kerusakan" — amati warna teks opsi di dalamnya.
5. Pilih salah satu opsi (contoh: "Barang Rusak") — amati teks yang terlihat di field setelah dipilih.

**Expected Result:**
> - Teks opsi di dalam dropdown harus **terlihat jelas dan kontras** dengan warna background.
> - Contoh yang baik: teks gelap pada background putih, atau teks putih pada background gelap.
> - Tidak boleh ada teks yang "menghilang" atau tidak terbaca karena warna sama dengan background.

**Actual Result:**
> ✅ Sudah diperbaiki. Teks opsi kini terlihat jelas saat Dark Mode aktif.

**Notes:**
> Sebelumnya terjadi masalah kontras warna pada elemen `<select>` di Dark Mode — teks putih menyatu dengan background dropdown yang juga putih.

---

### 🔄 TC-006 — Admin Dashboard: Fitur Upload Bukti Transfer Tidak Tersedia

| Field | Detail |
|-------|--------|
| **TC ID** | TC-006 |
| **Feature** | Admin Dashboard |
| **Sub Feature** | Detail Komplain & Retur |
| **Scenario** | Validasi ketersediaan fitur upload bukti transfer dan blocker perubahan status ke "Done" |
| **Status** | 🔄 Proses |
| **Severity** | Low |
| **Priority** | High |
| **PIC** | Fullstack Dev / PM |

**Preconditions:**
1. Admin telah login ke Dashboard Admin.
2. Terdapat tiket komplain dengan metode refund **Transfer Bank**.
3. Status komplain saat ini masih **"Proses"** (belum "Done").

**Test Steps:**
1. Admin membuka halaman Detail Komplain yang menggunakan metode refund Transfer Bank.
2. Periksa apakah tersedia form/tombol untuk **upload bukti transfer** di pop-up Detail Komplain.
3. Coba ubah status komplain menjadi **"Done"** tanpa mengunggah foto bukti transfer terlebih dahulu.
4. Amati apakah sistem **memblokir** aksi tersebut atau tetap mengizinkan.

**Test Data:**
- Komplain ID: **#CMP-6688**
- Metode refund: Transfer Bank

**Expected Result:**
> Sesuai SRS, ERD, & UI/UX:
> 1. Harus tersedia **form upload bukti transfer** di dalam pop-up Detail Komplain.
> 2. Sistem harus **memblokir/menolak** perubahan status ke "Done" dan menampilkan error/alert jika Admin **belum mengunggah foto bukti transfer**.

**Actual Result:**
> ❌ **Dua masalah ditemukan:**
> 1. **Tidak ada fitur/tombol upload bukti transfer** pada halaman Detail Komplain sama sekali.
> 2. Admin **tetap bisa mengubah status menjadi "Done"** meskipun tanpa melampirkan bukti transfer.

**Action Required untuk Fullstack Dev / PM:**
> **[Bug + Missing Feature — Business Rules Violation]**
> Implementasi saat ini **melanggar Business Rules** yang tertuang dalam SRS dan ERD.
>
> Yang harus dikerjakan:
> 1. **Tambahkan fitur upload** pada pop-up/modal Detail Komplain:
>    - Field input file (`type="file"`) untuk bukti transfer.
>    - Tombol simpan/upload.
>    - Tampilkan preview atau nama file setelah berhasil diupload.
> 2. **Tambahkan validasi server-side** sebelum status bisa diubah menjadi "Done":
>    - Cek apakah `bukti_transfer` sudah ada di database untuk tiket tersebut.
>    - Jika belum ada, **tolak request** dan kembalikan pesan error: *"Harap unggah bukti transfer terlebih dahulu sebelum menyelesaikan komplain."*
> 3. **Tambahkan validasi client-side (UI)** agar tombol "Done" di-disable atau memunculkan alert jika bukti belum diupload.

---

### ❌ TC-007 — Register: Validasi Domain Email Bocor

| Field | Detail |
|-------|--------|
| **TC ID** | TC-007 |
| **Feature** | Register |
| **Sub Feature** | Email Validation |
| **Scenario** | Registrasi menggunakan domain email selain @gmail.com (termasuk salah ketik/typo) |
| **Status** | ❌ Fail |
| **Severity** | 🔴 High |
| **Priority** | High |
| **PIC** | Backend Dev / DevOps |

**Preconditions:**
- Pengguna berada di halaman pendaftaran (`/register`).

**Test Steps:**
1. Masukkan Nama yang valid (contoh: `aaa`).
2. Masukkan Email dengan domain yang **salah/typo** (bukan `@gmail.com`).
3. Masukkan Password yang valid (contoh: `12345678`).
4. Pilih role **"Customer"**.
5. Klik tombol **"Register"**.

**Test Data:**
- Nama: `aaa`
- Email: `candragocan9@gmil.com` *(typo — bukan @gmail.com)*
- Password: `12345678`

**Expected Result:**
> - Sistem **menolak pendaftaran** dan memunculkan pesan error validasi, contoh: *"Email harus menggunakan domain @gmail.com"*.
> - Data pengguna **tidak masuk ke database**.

**Actual Result:**
> ❌ Sistem **menerima** input email `@gmil.com` (typo) tanpa error. Pendaftaran **berhasil diproses** dan user baru **berhasil dibuat** di database.

**Action Required untuk Backend Dev:**
> **[Validation Bug — Domain Email Lolos]**
> Validasi domain email tidak berjalan dengan benar. Email dengan typo domain seperti `@gmil.com` berhasil masuk ke sistem.
>
> Perbaikan yang harus dilakukan:
> 1. **Tambahkan validasi khusus** di backend (Controller atau Form Request) untuk memastikan domain email **harus** diakhiri dengan `@gmail.com`:
>    ```php
>    // Contoh di Laravel — FormRequest atau Controller
>    'email' => ['required', 'email', 'regex:/@gmail\.com$/'],
>    ```
>    Atau menggunakan Rule kustom:
>    ```php
>    Rule::in(['gmail.com']), // setelah parsing domain
>    ```
> 2. **Tambahkan validasi client-side** di form frontend sebagai umpan balik cepat bagi pengguna:
>    ```javascript
>    if (!email.endsWith('@gmail.com')) {
>      showError('Email harus menggunakan domain @gmail.com');
>    }
>    ```
> 3. Pastikan pesan error **tampil jelas** di bawah field email.

---

### ❌ TC-008 — Register: Nama Mengandung Karakter Spesial (Celah XSS)

| Field | Detail |
|-------|--------|
| **TC ID** | TC-008 |
| **Feature** | Register |
| **Sub Feature** | Name Validation |
| **Scenario** | Registrasi dengan Nama mengandung karakter spesial/simbol terlarang (`< > / %`) |
| **Status** | ❌ Fail |
| **Severity** | 🔴 High |
| **Priority** | High |
| **PIC** | Backend Dev / DevOps |

**Preconditions:**
- Pengguna berada di halaman pendaftaran (`/register`).

**Test Steps:**
1. Masukkan Nama yang mengandung karakter spesial seperti `< > / %`.
2. Masukkan Email yang valid.
3. Masukkan Password yang valid.
4. Klik tombol **"Register"**.

**Test Data:**
- Nama: `aaa<>/%`
- Email: `test@gmail.com`
- Password: `12345678`

**Expected Result:**
> - Sistem **menolak pendaftaran** dan menampilkan pesan error, contoh: *"Nama hanya boleh mengandung huruf dan spasi"*.
> - Karakter spesial (`< > / %`) harus **di-filter atau di-reject** sebelum data disimpan.

**Actual Result:**
> ❌ Sistem **menerima** nama `aaa<>/%` dan pendaftaran **berhasil diproses** tanpa ada proses pembersihan (sanitization) data sama sekali.

**Action Required untuk Backend Dev:**
> **🚨 [CRITICAL — Potensi Celah Keamanan: Stored XSS]**
> Input karakter `<>` yang tidak di-filter berpotensi menjadi celah **Stored Cross-Site Scripting (XSS)**. Attacker bisa menyisipkan tag HTML/Script berbahaya ke dalam database yang kemudian dieksekusi di browser pengguna lain.
>
> Perbaikan yang **wajib** dilakukan segera:
> 1. **Tambahkan validasi regex** di backend untuk field Nama:
>    ```php
>    // Laravel — hanya izinkan huruf, spasi, dan tanda titik/koma yang umum
>    'name' => ['required', 'string', 'regex:/^[a-zA-Z\s\.\,\-]+$/'],
>    ```
> 2. **Lakukan sanitization/escaping** pada semua output teks yang berasal dari input pengguna:
>    ```php
>    // Pastikan blade template menggunakan {{ }} bukan {!! !!}
>    {{ $user->name }} // aman — di-escape otomatis oleh Blade
>    ```
> 3. **Tambahkan validasi client-side** di form frontend sebagai langkah pertama (bukan pengganti backend):
>    ```javascript
>    const nameRegex = /^[a-zA-Z\s]+$/;
>    if (!nameRegex.test(name)) {
>      showError('Nama hanya boleh mengandung huruf dan spasi');
>    }
>    ```
> 4. **Audit semua field input lain** (alamat, deskripsi komplain, catatan, dll.) apakah juga rentan terhadap masalah yang sama.

---

### ❌ TC-009 — Global UI: Bahasa Campuran (Indoglish)

| Field | Detail |
|-------|--------|
| **TC ID** | TC-009 |
| **Feature** | Global UI |
| **Sub Feature** | Localization / Language |
| **Scenario** | Memastikan konsistensi penggunaan Bahasa Indonesia di seluruh elemen website |
| **Status** | ❌ Fail |
| **Severity** | Low |
| **Priority** | Medium |
| **PIC** | UI/UX Designer / FE Dev |

**Preconditions:**
- Aplikasi diakses pada lingkungan production/staging.

**Test Steps:**
1. Buka halaman **Landing Page**.
2. Buka halaman **Register**.
3. Buka halaman **Dashboard** (Customer maupun Admin).
4. Periksa semua **label, tombol (button), placeholder teks, dan menu navigasi**.
5. Identifikasi kata-kata atau frasa yang masih menggunakan Bahasa Inggris.

**Expected Result:**
> Seluruh teks di dalam website menggunakan **Bahasa Indonesia yang baku dan konsisten**. Tidak ada percampuran antara Bahasa Indonesia dan Bahasa Inggris.

**Actual Result:**
> ❌ Masih ditemukan penggunaan bahasa campuran (Indoglish) di berbagai halaman:
> - `"Dashboard"` — seharusnya: **Beranda** atau **Dasbor**
> - `"Name"` — seharusnya: **Nama**
> - `"Register"` — seharusnya: **Daftar**
> - `"Done"` — seharusnya: **Selesai**
> - `"Choose File"` — seharusnya: **Pilih Berkas**

**Action Required untuk UI/UX Designer / FE Dev:**
> **[Localization Issue — Bahasa Campuran]**
> Daftar perubahan teks yang harus dilakukan:
>
> | Teks Saat Ini | Ganti Dengan |
> |---------------|--------------|
> | Dashboard | Beranda / Dasbor |
> | Name | Nama |
> | Register | Daftar |
> | Done | Selesai |
> | Choose File | Pilih Berkas |
> | Submit | Kirim |
> | Cancel | Batal |
> | Login | Masuk |
> | Logout | Keluar |
>
> Lakukan pencarian menyeluruh (`Ctrl+Shift+F` di editor) untuk menemukan semua string berbahasa Inggris di file-file view/template.

---

### ❌ TC-010 — Form Retur: Logic Alamat Tidak Relevan

| Field | Detail |
|-------|--------|
| **TC ID** | TC-010 |
| **Feature** | Form Retur |
| **Sub Feature** | Refund Logic |
| **Scenario** | Validasi relevansi input alamat dan ketersediaan informasi alamat pengiriman barang (Gudang) |
| **Status** | ❌ Fail |
| **Severity** | 🟡 Medium |
| **Priority** | High |
| **PIC** | UI/UX Designer / Dev |

**Preconditions:**
- Customer berada di halaman **"Form Retur"** bagian **"Informasi Pengiriman & Refund"**.

**Test Steps:**
1. Navigasi ke halaman Form Retur.
2. Isi semua field yang wajib diisi.
3. Lanjut ke halaman/step berikutnya.
4. Amati apakah terdapat field input **"Alamat Lengkap Customer"**.
5. Amati apakah sistem memberikan informasi **"Alamat Gudang/Kantor"** sebagai tujuan pengiriman barang retur.

**Expected Result:**
> 1. Kolom **"Alamat Lengkap Customer"** seharusnya **tidak ada / dihilangkan** karena tidak relevan — metode refund dilakukan via transfer bank, bukan pengiriman ke alamat customer.
> 2. Sistem harus **menampilkan Alamat Gudang/Kantor** sebagai panduan tujuan pengiriman barang retur oleh customer.

**Actual Result:**
> ❌ Sistem masih **meminta "Alamat Lengkap" dari customer** (padahal tidak diperlukan untuk refund transfer).
> ❌ Sistem **tidak menampilkan informasi alamat gudang/kantor** yang seharusnya menjadi tujuan pengiriman barang.

**Action Required untuk Dev / UI/UX:**
> **[Logic Error — Alur Form Retur Membingungkan]**
> Alur saat ini kontraproduktif: customer diminta alamat rumahnya sendiri padahal refund dikirim via transfer bank, dan customer tidak diberi tahu harus mengirim barang ke alamat mana.
>
> Perbaikan yang harus dilakukan:
> 1. **Hapus field "Alamat Lengkap Customer"** dari step "Informasi Pengiriman & Refund" pada Form Retur.
> 2. **Tambahkan informasi statis Alamat Gudang/Kantor** yang jelas di halaman tersebut, contoh:
>    ```
>    📦 Kirimkan barang retur Anda ke:
>    PT. Nama Perusahaan
>    Jl. [Alamat Gudang Lengkap]
>    Kota, Provinsi, Kode Pos
>    Telp: [Nomor Kontak]
>    ```
> 3. Jika terdapat **kondisi berbeda berdasarkan metode refund** (transfer bank vs lainnya), pertimbangkan untuk menampilkan field secara dinamis sesuai pilihan customer.

---

### ❌ TC-011 — Form Retur: Tidak Ada Tombol "Kembali"

| Field | Detail |
|-------|--------|
| **TC ID** | TC-011 |
| **Feature** | Form Retur |
| **Sub Feature** | Form Retur (Navigasi) |
| **Scenario** | Memastikan adanya tombol "Kembali" ke Dashboard bagi pengguna yang tidak jadi mengisi form |
| **Status** | ❌ Fail |
| **Severity** | Low |
| **Priority** | Medium |
| **PIC** | UI/UX Designer / FE Dev |

**Preconditions:**
- Pengguna berada di halaman **"Form Retur"** (`/form`).

**Test Steps:**
1. Buka halaman Form Retur.
2. Periksa area **header** halaman — apakah ada tombol/link "Kembali", "Batal", atau ikon panah kiri.
3. Periksa area **bawah form** — apakah ada tombol navigasi selain tombol Submit.
4. Jika tombol tersebut ada, klik dan amati ke mana pengguna diarahkan.

**Expected Result:**
> - Terdapat tombol navigasi yang jelas (contoh: tombol **"Kembali ke Dashboard"** atau **"Batal"**).
> - Saat di-klik, pengguna diarahkan kembali ke halaman **Dashboard tanpa mengirimkan data apapun**.

**Actual Result:**
> ❌ Tidak ditemukan tombol atau link navigasi untuk kembali ke Dashboard.
> Pengguna terjebak di halaman form dan **harus menggunakan tombol "Back" browser** atau **mengetik URL secara manual** untuk keluar.

**Action Required untuk UI/UX / FE Dev:**
> **[Usability Issue — Dead End Navigation]**
> Pengguna yang tidak jadi mengisi form tidak memiliki cara yang jelas untuk keluar.
>
> Perbaikan yang harus dilakukan:
> 1. **Tambahkan tombol "Kembali" atau "Batal"** di salah satu atau kedua lokasi berikut:
>    - Di bagian **header halaman** (kiri atas), berupa ikon panah kiri + teks "Kembali".
>    - Di bagian **bawah form**, sejajar dengan tombol Submit.
> 2. Contoh implementasi di Laravel/Blade:
>    ```html
>    <a href="{{ route('customer.dashboard') }}" class="btn btn-secondary">
>      ← Kembali ke Dashboard
>    </a>
>    ```
> 3. Pastikan tombol ini **tidak men-submit form** (gunakan tag `<a>` atau tombol dengan `type="button"`).

---

### ❌ TC-012 — Admin Dashboard: Status Workflow Komplain Tidak Lengkap

| Field | Detail |
|-------|--------|
| **TC ID** | TC-012 |
| **Feature** | Admin Dashboard |
| **Sub Feature** | Manajemen Komplain |
| **Scenario** | Validasi kelengkapan tahapan status workflow komplain sesuai SRS Bagian IV.7 |
| **Status** | ❌ Fail |
| **Severity** | 🔴 High |
| **Priority** | High |
| **PIC** | Backend / Fullstack Dev |

**Preconditions:**
- Admin telah login dan membuka halaman **Manajemen Komplain** atau **Detail Komplain**.

**Test Steps:**
1. Buka salah satu tiket komplain aktif.
2. Klik pada **dropdown pilihan status** komplain.
3. Catat semua pilihan status yang tersedia.
4. Bandingkan daftar status tersebut dengan spesifikasi di **dokumen SRS Bagian IV.7**.

**Test Data:**
- Tiket Komplain aktif (sembarang tiket)
- Dokumen SRS Bagian IV.7 (referensi)

**Expected Result:**
> Sesuai **SRS Bagian IV.7**, sistem harus memiliki **6 tahapan status** berikut:
>
> | No | Status |
> |----|--------|
> | 1 | Pending |
> | 2 | In Review |
> | 3 | Approved — Menunggu Resi Pembeli |
> | 4 | In Progress |
> | 5 | Done |
> | 6 | Rejected |

**Actual Result:**
> ❌ Daftar status yang diimplementasikan **tidak lengkap dan tidak sesuai** dengan SRS.
> Status yang ditemukan saat ini hanya: **"Proses"** dan **"Done"**.
> Tahapan krusial seperti `"In Review"`, `"Approved — Menunggu Resi Pembeli"`, `"Pending"`, dan `"Rejected"` **tidak tersedia**.

**Action Required untuk Backend / Fullstack Dev:**
> **🚨 [Major Non-Compliance — Status Workflow Tidak Sesuai SRS]**
> Status adalah **inti dari alur kerja (workflow)** aplikasi ini. Tanpa status yang benar, seluruh proses handling komplain tidak dapat berjalan sesuai desain.
>
> Yang harus dikerjakan:
> 1. **Update database** — tambahkan semua nilai status yang benar di tabel `complaints` (kolom `status`):
>    ```sql
>    -- Contoh: enum atau lookup table
>    ALTER TABLE complaints MODIFY status ENUM(
>      'pending',
>      'in_review',
>      'approved_menunggu_resi',
>      'in_progress',
>      'done',
>      'rejected'
>    );
>    ```
> 2. **Update backend logic** — sesuaikan semua kondisi `if/switch` yang menggunakan nilai status lama (`"Proses"`, dll.).
> 3. **Update frontend/UI** — sesuaikan dropdown pilihan status di halaman Admin dengan 6 status yang benar.
> 4. **Update query dan filter** — pastikan semua query yang memfilter berdasarkan status juga diperbarui.
> 5. **Migrasi data lama** — konversi nilai status lama ke format baru jika ada data existing di database.

---

### ❌ TC-013 — Customer Dashboard: Fitur Input Nomor Resi Tidak Tersedia

| Field | Detail |
|-------|--------|
| **TC ID** | TC-013 |
| **Feature** | Customer Dashboard |
| **Sub Feature** | Riwayat Komplain |
| **Scenario** | Validasi ketersediaan fitur input nomor resi saat status "APPROVED — Menunggu Resi Pembeli" |
| **Status** | ❌ Fail |
| **Severity** | 🔴 High |
| **Priority** | High |
| **PIC** | FE / BE Developer |

**Preconditions:**
1. Customer telah **login** ke akun mereka.
2. Admin telah mengubah status komplain customer tersebut menjadi **"APPROVED — Menunggu Resi Pembeli"**.

**Test Steps:**
1. Customer masuk ke halaman **"Riwayat Komplain"** atau Dashboard Customer.
2. Cari tiket komplain yang statusnya sudah **"Approved — Menunggu Resi Pembeli"**.
3. Periksa apakah tersedia kolom input, tombol, atau form untuk **memasukkan nomor resi** pengiriman.

**Test Data:**
- Akun Customer aktif
- Tiket komplain dengan status "Approved — Menunggu Resi Pembeli"

**Expected Result:**
> Sesuai SRS: Harus tersedia **field input atau tombol "Input Resi"** bagi customer di halaman Riwayat Komplain, sehingga customer dapat memasukkan **nomor bukti pengiriman barang** kembali ke gudang.

**Actual Result:**
> ❌ **Fitur input nomor resi tidak ditemukan** di halaman customer sama sekali.
> Customer tidak memiliki cara apapun untuk menginformasikan bahwa barang sudah dikirim.

**Action Required untuk FE / BE Developer:**
> **🚨 [Missing Feature — Workflow Blocker]**
> Ini adalah **blocker kritis alur kerja**. Tanpa fitur input resi:
> - Admin tidak bisa mengetahui bahwa barang sudah dikirim oleh customer.
> - Admin tidak bisa melakukan verifikasi fisik barang.
> - Status tidak bisa berpindah dari "Approved" ke "In Progress".
> - Seluruh proses retur **mandek** di tahap ini.
>
> Yang harus dikerjakan:
> 1. **Frontend (FE):** Tambahkan komponen input resi di halaman Riwayat Komplain customer, yang hanya muncul jika status tiket adalah `"approved_menunggu_resi"`:
>    ```html
>    <!-- Tampilkan hanya jika status == 'approved_menunggu_resi' -->
>    <div class="input-resi-section">
>      <label>Nomor Resi Pengiriman:</label>
>      <input type="text" name="nomor_resi" placeholder="Masukkan nomor resi (contoh: JNE1234567890)" />
>      <button type="submit">Kirim Resi</button>
>    </div>
>    ```
> 2. **Backend (BE):** Buat endpoint/route baru untuk menerima input nomor resi dari customer:
>    ```
>    POST /api/complaints/{id}/resi
>    Body: { "nomor_resi": "JNE1234567890" }
>    ```
>    - Simpan nomor resi ke tabel `complaints` atau tabel terpisah `complaint_resi`.
>    - Kirim notifikasi ke Admin bahwa customer sudah menginputkan resi.
>    - Otomatis ubah status menjadi `"in_progress"` setelah resi berhasil disimpan.
> 3. **Validasi:** Pastikan field nomor resi tidak boleh kosong sebelum form bisa di-submit.

---

## 📌 Checklist Perbaikan untuk Developer

Gunakan checklist ini untuk melacak progres perbaikan:

### 🔴 Critical / High Priority
- [ ] **TC-008** — Tambahkan sanitasi input Nama (cegah XSS)
- [ ] **TC-007** — Tambahkan validasi domain email `@gmail.com`
- [ ] **TC-012** — Lengkapi 6 status workflow komplain sesuai SRS IV.7
- [ ] **TC-013** — Buat fitur input nomor resi di Customer Dashboard
- [ ] **TC-006** — Tambahkan fitur upload bukti transfer + validasi wajib sebelum "Done"
- [ ] **TC-004** — Perbaiki error 403 Forbidden pada foto bukti retur (cek storage permission & symlink)

### 🟡 Medium Priority
- [ ] **TC-010** — Perbaiki logic Form Retur: hapus field alamat customer, tampilkan alamat gudang
- [ ] **TC-003** — Perbaiki overlapping UI di Hero Section Landing Page

### 🔵 Low Priority
- [ ] **TC-009** — Ganti semua teks Bahasa Inggris ke Bahasa Indonesia
- [ ] **TC-011** — Tambahkan tombol "Kembali" di halaman Form Retur

---

*Dokumen ini di-generate dari file `TestCase.xlsx` — Sistem Komplain & Return, Kelompok 2.*
