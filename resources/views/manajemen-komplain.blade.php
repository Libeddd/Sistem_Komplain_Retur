<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Manajemen Komplain</title>
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
        <a class="flex items-center gap-3 px-3 py-2 rounded-lg active-nav">
            <span class="material-symbols-outlined">inventory_2</span>
            <span class="text-sm font-medium">Manajemen Komplain</span>
        </a>
        <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors" href="{{ route('admin.index') }}">
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
                <span class="material-symbols-outlined text-primary">inventory_2</span>
                <h2 class="text-lg font-bold">Manajemen Komplain</h2>
            </div>
            <button id="theme-toggle" class="p-2 rounded-full hover:bg-slate-200 dark:hover:bg-slate-800 transition-colors">
                <span class="material-symbols-outlined dark:hidden">dark_mode</span>
                <span class="material-symbols-outlined hidden dark:block text-yellow-400">light_mode</span>
            </button>
        </header>

        <main class="flex-1 overflow-y-auto p-4 md:p-6 pb-20 md:pb-6 flex flex-col">
            @if(session('success'))
                <div class="mb-4 p-3 rounded-lg bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800 text-emerald-600 dark:text-emerald-400 font-medium text-sm">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mb-4 p-3 rounded-lg bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-600 dark:text-red-400 font-medium text-sm">
                    {{ session('error') }}
                </div>
            @endif
            <div class="mb-6 md:mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <h1 class="text-2xl font-black tracking-tight">Manajemen Komplain</h1>
                    <p class="text-sm text-slate-500 mt-1">Kelola dan verifikasi pengajuan retur customer</p>
                </div>
            </div>
            
            <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden flex flex-col h-full">

                <div class="overflow-x-auto flex-1">
                    <table class="w-full text-left text-sm whitespace-nowrap">
                        <thead class="bg-slate-50 dark:bg-slate-800/50 text-slate-500 dark:text-slate-400 sticky top-0 border-b border-slate-200 dark:border-slate-700">
                            <tr>
                                <th class="px-4 py-3 font-bold uppercase tracking-wider text-xs cursor-pointer hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors group select-none" onclick="sortTable('id')">
                                    <div class="flex items-center gap-1">
                                        ID Komplain
                                        <span class="material-symbols-outlined text-[14px] text-slate-400 transition-colors group-hover:text-primary" id="icon-sort-id">unfold_more</span>
                                    </div>
                                </th>
                                
                                <th class="px-4 py-3 font-bold uppercase tracking-wider text-xs">Customer</th>
                                <th class="px-4 py-3 font-bold uppercase tracking-wider text-xs">Produk</th>
                                <th class="px-4 py-3 font-bold uppercase tracking-wider text-xs">Status</th>
                                
                                <th class="px-4 py-3 font-bold uppercase tracking-wider text-xs cursor-pointer hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors group select-none" onclick="sortTable('date')">
                                    <div class="flex items-center gap-1">
                                        Tgl Pengajuan
                                        <span class="material-symbols-outlined text-[14px] text-slate-400 transition-colors group-hover:text-primary" id="icon-sort-date">unfold_more</span>
                                    </div>
                                </th>
                                
                                <th class="px-4 py-3 font-bold uppercase tracking-wider text-xs text-center">Aksi</th>
                            </tr>
                        </thead>
                        
                        <tbody id="table-body" class="divide-y divide-slate-200 dark:divide-slate-800">
                            @forelse($complaints as $complaint)
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                                <td class="px-4 py-2.5 font-bold text-primary">{{ $complaint->complaint_code }}</td>
                                <td class="px-4 py-2.5 font-medium">{{ $complaint->user->name }}</td>
                                <td class="px-4 py-2.5 text-slate-500">{{ $complaint->product_name }}</td>
                                <td class="px-4 py-2.5">
                                    <form method="POST" action="{{ route('complaint.update-status', $complaint->id) }}" class="flex flex-col gap-2" enctype="multipart/form-data">
                                        @csrf
                                        <select name="status" class="text-xs font-bold rounded-full py-1 pl-3 pr-8 border-none focus:ring-2 focus:ring-primary appearance-none cursor-pointer
                                            @if($complaint->status == 'pending') bg-amber-100 text-amber-600
                                            @elseif($complaint->status == 'in_review') bg-indigo-100 text-indigo-600
                                            @elseif($complaint->status == 'approved_menunggu_resi') bg-blue-100 text-blue-600
                                            @elseif($complaint->status == 'in_progress') bg-purple-100 text-purple-600
                                            @elseif($complaint->status == 'rejected') bg-red-100 text-red-600
                                            @else bg-emerald-100 text-emerald-600 @endif
                                        " onchange="handleStatusChange(this, '{{ $complaint->refund_method }}')">
                                            <option value="pending" {{ $complaint->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="in_review" {{ $complaint->status == 'in_review' ? 'selected' : '' }}>Dalam Tinjauan</option>
                                            <option value="approved_menunggu_resi" {{ $complaint->status == 'approved_menunggu_resi' ? 'selected' : '' }}>Menunggu Resi</option>
                                            <option value="in_progress" {{ $complaint->status == 'in_progress' ? 'selected' : '' }}>Sedang Dikirim</option>
                                            <option value="rejected" {{ $complaint->status == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                                            <option value="done" {{ $complaint->status == 'done' ? 'selected' : '' }}>Done</option>
                                        </select>
                                        <div class="bukti-transfer-container hidden mt-1 flex-col gap-1 w-32">
                                            <label class="text-[10px] font-bold text-slate-500">Bukti Transfer (Wajib)</label>
                                            <input type="file" name="bukti_transfer" class="text-[10px] w-full" accept=".jpg,.jpeg,.png,.pdf">
                                            <button type="button" onclick="this.closest('form').submit()" class="bg-primary text-white text-[10px] px-2 py-1 rounded">Simpan</button>
                                        </div>
                                    </form>
                                </td>
                                <td class="px-4 py-2.5 text-slate-500">{{ $complaint->created_at->format('d/m/Y') }}</td>
                                <td class="px-4 py-2.5 text-center">
                                    <button type="button" onclick="openReviewModal({{ json_encode([
                                        'complaint_code' => $complaint->complaint_code,
                                        'user_name' => $complaint->user->name,
                                        'product_name' => $complaint->product_name,
                                        'damage_category' => $complaint->damage_category,
                                        'description' => $complaint->description,
                                        'order_number' => $complaint->order_number,
                                        'refund_method' => $complaint->refund_method,
                                        'proof_image_url' => $complaint->proof_image_path ? Storage::url($complaint->proof_image_path) : null,
                                        'unboxing_video_url' => $complaint->unboxing_video_path ? Storage::url($complaint->unboxing_video_path) : null,
                                        'created_at' => $complaint->created_at->format('d M Y')
                                    ]) }})" class="inline-flex items-center gap-1 px-2 py-1 bg-primary/10 text-primary hover:bg-primary hover:text-white rounded font-bold text-xs transition-all focus:ring-2 focus:ring-primary/50">
                                        <span class="material-symbols-outlined text-[14px]">visibility</span> Review
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-4 py-8 text-center text-slate-500">Belum ada data komplain yang masuk.</td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Modal Overlay -->
            <div id="reviewModal" class="fixed inset-0 z-[999] flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm opacity-0 pointer-events-none transition-opacity duration-300">
                <!-- Modal Content -->
                <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-2xl w-full max-w-2xl overflow-hidden transform scale-95 transition-transform duration-300 flex flex-col max-h-[90vh]">
                    <!-- Header -->
                    <div class="px-6 py-4 border-b border-slate-200 dark:border-slate-800 flex justify-between items-center bg-slate-50 dark:bg-slate-800/50">
                        <div>
                            <h3 class="text-lg font-black text-slate-900 dark:text-white flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary">assignment</span> Detail Komplain
                            </h3>
                            <p class="text-xs text-slate-500 mt-0.5" id="modal-subtitle">Loading...</p>
                        </div>
                        <button type="button" onclick="closeReviewModal()" class="text-slate-400 hover:text-red-500 transition-colors p-1 rounded-full hover:bg-red-50 dark:hover:bg-red-900/20">
                            <span class="material-symbols-outlined">close</span>
                        </button>
                    </div>

                    <!-- Body -->
                    <div class="p-6 overflow-y-auto space-y-6">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-slate-50 dark:bg-slate-800/50 p-4 rounded-xl border border-slate-100 dark:border-slate-800">
                                <h4 class="text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-1">Nama Customer</h4>
                                <p class="text-sm font-bold text-slate-800 dark:text-slate-100" id="modal-customer-name">-</p>
                            </div>
                            <div class="bg-slate-50 dark:bg-slate-800/50 p-4 rounded-xl border border-slate-100 dark:border-slate-800">
                                <h4 class="text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-1">Tgl. Pengajuan</h4>
                                <p class="text-sm font-bold text-slate-800 dark:text-slate-100" id="modal-date">-</p>
                            </div>
                        </div>

                        <div>
                            <h4 class="text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-2">Informasi Produk</h4>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-xs text-slate-500">Nama Produk</p>
                                    <p class="text-sm font-medium" id="modal-product-name">-</p>
                                </div>
                                <div>
                                    <p class="text-xs text-slate-500">Kategori Kendala</p>
                                    <p class="text-sm font-medium text-amber-600 dark:text-amber-400" id="modal-category">-</p>
                                </div>
                                <div>
                                    <p class="text-xs text-slate-500">Nomor Seri Pesanan</p>
                                    <p class="text-sm font-medium" id="modal-order-number">-</p>
                                </div>
                                <div>
                                    <p class="text-xs text-slate-500">Metode Refund</p>
                                    <p class="text-sm font-medium" id="modal-refund-method">-</p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h4 class="text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-2">Deskripsi Detail</h4>
                            <p class="text-sm text-slate-600 dark:text-slate-400 italic bg-slate-50 dark:bg-slate-800 p-4 rounded-lg border border-slate-100 dark:border-slate-700" id="modal-description">-</p>
                        </div>

                        <div>
                            <h4 class="text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-2">Lampiran Bukti</h4>
                            <div class="flex gap-4">
                                <a id="modal-image-link" href="#" target="_blank" class="hidden flex-1 items-center justify-center gap-2 p-4 rounded-xl border-2 border-dashed border-primary/30 hover:bg-primary/5 transition-colors group">
                                    <span class="material-symbols-outlined text-primary group-hover:scale-110 transition-transform">image</span>
                                    <span class="text-sm font-bold text-primary">Lihat Foto Bukti</span>
                                </a>
                                <a id="modal-video-link" href="#" target="_blank" class="hidden flex-1 items-center justify-center gap-2 p-4 rounded-xl border-2 border-dashed border-emerald-500/30 hover:bg-emerald-50 transition-colors group">
                                    <span class="material-symbols-outlined text-emerald-600 group-hover:scale-110 transition-transform">videocam</span>
                                    <span class="text-sm font-bold text-emerald-600">Lihat Video Unboxing</span>
                                </a>
                                <p id="modal-no-attachment" class="text-sm text-slate-500 hidden w-full text-center py-4 bg-slate-50 rounded-xl">Tidak ada lampiran.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </main>
    </div>

    <script>
        function handleStatusChange(selectElement, refundMethod) {
            const form = selectElement.closest('form');
            const fileContainer = form.querySelector('.bukti-transfer-container');
            const selectedStatus = selectElement.value;
            
            if (selectedStatus === 'done' && refundMethod.includes('Transfer Bank')) {
                fileContainer.classList.remove('hidden');
                fileContainer.classList.add('flex');
            } else {
                fileContainer.classList.add('hidden');
                fileContainer.classList.remove('flex');
                form.submit();
            }
        }

        function openReviewModal(data) {
            document.getElementById('modal-subtitle').innerText = `ID: ${data.complaint_code}`;
            document.getElementById('modal-customer-name').innerText = data.user_name;
            document.getElementById('modal-date').innerText = data.created_at;
            document.getElementById('modal-product-name').innerText = data.product_name;
            document.getElementById('modal-category').innerText = data.damage_category;
            document.getElementById('modal-order-number').innerText = data.order_number;
            document.getElementById('modal-refund-method').innerText = data.refund_method.toUpperCase();
            document.getElementById('modal-description').innerText = `"${data.description}"`;

            const imgLink = document.getElementById('modal-image-link');
            const vidLink = document.getElementById('modal-video-link');
            const noAttach = document.getElementById('modal-no-attachment');

            imgLink.classList.add('hidden');
            vidLink.classList.add('hidden');
            noAttach.classList.add('hidden');

            let hasAttachment = false;
            if (data.proof_image_url) {
                imgLink.href = data.proof_image_url;
                imgLink.classList.remove('hidden');
                imgLink.classList.add('flex');
                hasAttachment = true;
            }
            if (data.unboxing_video_url) {
                vidLink.href = data.unboxing_video_url;
                vidLink.classList.remove('hidden');
                vidLink.classList.add('flex');
                hasAttachment = true;
            }
            if (!hasAttachment) {
                noAttach.classList.remove('hidden');
            }

            const modal = document.getElementById('reviewModal');
            modal.classList.remove('opacity-0', 'pointer-events-none');
            modal.children[0].classList.remove('scale-95');
            modal.children[0].classList.add('scale-100');
        }

        function closeReviewModal() {
            const modal = document.getElementById('reviewModal');
            modal.classList.add('opacity-0', 'pointer-events-none');
            modal.children[0].classList.remove('scale-100');
            modal.children[0].classList.add('scale-95');
        }

        // Tutup modal ketika klik area latar belakang
        document.getElementById('reviewModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeReviewModal();
            }
        });

        // Variabel untuk melacak status sorting saat ini
        let sortDirId = 'default'; 
        let sortDirDate = 'default';

        function sortTable(column) {
            const tableBody = document.getElementById("table-body");
            const rows = Array.from(tableBody.querySelectorAll("tr"));
            
            const iconId = document.getElementById("icon-sort-id");
            const iconDate = document.getElementById("icon-sort-date");

            if (column === 'id') {
                // Toggle arah sorting untuk ID (Asc -> Desc -> Asc)
                sortDirId = (sortDirId === 'asc') ? 'desc' : 'asc';
                sortDirDate = 'default'; // Reset indikator kolom tanggal
                
                // Ubah ikon panah dan warna
                iconId.innerText = sortDirId === 'asc' ? 'expand_less' : 'expand_more';
                iconId.classList.add('text-primary');
                
                iconDate.innerText = 'unfold_more';
                iconDate.classList.remove('text-primary');

                // Proses sorting baris
                rows.sort((a, b) => {
                    let idA = a.querySelector("td:nth-child(1)").innerText.trim();
                    let idB = b.querySelector("td:nth-child(1)").innerText.trim();
                    return sortDirId === 'asc' ? idA.localeCompare(idB) : idB.localeCompare(idA);
                });
            } 
            else if (column === 'date') {
                // Toggle arah sorting untuk Tanggal (Desc -> Asc -> Desc)
                sortDirDate = (sortDirDate === 'desc') ? 'asc' : 'desc';
                sortDirId = 'default'; // Reset indikator kolom ID

                // Ubah ikon panah dan warna
                iconDate.innerText = sortDirDate === 'asc' ? 'expand_less' : 'expand_more';
                iconDate.classList.add('text-primary');
                
                iconId.innerText = 'unfold_more';
                iconId.classList.remove('text-primary');

                // Proses sorting baris
                rows.sort((a, b) => {
                    let dateAStr = a.querySelector("td:nth-child(5)").innerText.trim();
                    let dateBStr = b.querySelector("td:nth-child(5)").innerText.trim();
                    
                    // Membalik format DD/MM/YYYY menjadi YYYYMMDD
                    let dateA = dateAStr.split('/').reverse().join('');
                    let dateB = dateBStr.split('/').reverse().join('');

                    return sortDirDate === 'asc' ? dateA.localeCompare(dateB) : dateB.localeCompare(dateA);
                });
            }

            // Memasukkan baris yang sudah diurutkan ke dalam tabel
            tableBody.innerHTML = "";
            rows.forEach(row => tableBody.appendChild(row));
        }
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
        <a href="{{ url('/dashboard') }}" class="flex flex-col items-center justify-center gap-1 text-slate-400 hover:text-primary dark:hover:text-primary transition-colors w-full h-full">
            <span class="material-symbols-outlined text-[24px]">home</span>
            <span class="text-[10px] font-bold">Dashboard</span>
        </a>
        <a href="{{ url('/manajemen-komplain') }}" class="flex flex-col items-center justify-center gap-1 text-primary w-full h-full">
            <span class="material-symbols-outlined text-[24px]">inventory_2</span>
            <span class="text-[10px] font-medium">Manajemen</span>
        </a>
        <a href="{{ route('admin.index') }}" class="flex flex-col items-center justify-center gap-1 text-slate-400 hover:text-primary transition-colors w-full h-full">
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


