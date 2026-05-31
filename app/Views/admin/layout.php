<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Panel Admin' ?></title>

    <link rel="icon" type="image/png" href="<?= base_url('PASTI - Icon.png') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        * {
            font-size: 12px;
        }

        body {
            font-family: 'Ubuntu', sans-serif !important;
        }

        /* Kustomisasi SweetAlert2 Mobile */
        .swal2-popup {
            font-size: 0.85rem !important;
            width: 20rem !important;
            border-radius: 12px !important;
            background-color: #1e293b !important;
            color: #f8fafc !important;
        }

        .swal2-title {
            color: #f8fafc !important;
        }

        .swal2-confirm {
            background-color: #3b82f6 !important;
        }

        .swal2-cancel {
            background-color: #ef4444 !important;
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-800 flex h-screen overflow-hidden relative">

    <div id="sidebar-overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-slate-900/50 z-20 hidden opacity-0 transition-opacity duration-300"></div>

    <aside id="sidebar" class="w-64 bg-slate-900 text-slate-300 flex flex-col fixed inset-y-0 left-0 transform -translate-x-full md:relative md:translate-x-0 transition-transform duration-300 ease-in-out z-30 shadow-xl h-full">
        <div class="h-16 flex items-center justify-between px-6 border-b border-slate-800 bg-slate-950/50">
            <div class="flex items-center">
                <div class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center font-bold text-white shadow-[0_0_10px_rgba(37,99,235,0.5)] mr-2">P</div>
                <span class="text-lg font-bold text-white tracking-wider">PASTI</span>
            </div>
            <button onclick="toggleSidebar()" class="md:hidden text-slate-400 hover:text-white">
                <i class="fa-solid fa-xmark text-xl"></i>
            </button>
        </div>

        <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
            <a href="<?= base_url('admin/dashboard') ?>" class="flex items-center px-3 py-2.5 <?= (url_is('admin/dashboard') ? 'bg-blue-600/10 text-blue-400' : 'hover:bg-slate-800 hover:text-white') ?> rounded-lg group transition">
                <i class="fa-solid fa-gauge-high w-6 text-center"></i>
                <span class="ml-2 font-medium">Dasbor</span>
            </a>
            <a href="<?= base_url('admin/portfolio') ?>" class="flex items-center px-3 py-2.5 <?= (url_is('admin/portfolio*') ? 'bg-blue-600/10 text-blue-400' : 'hover:bg-slate-800 hover:text-white') ?> rounded-lg group transition mt-1">
                <i class="fa-solid fa-layer-group w-6 text-center"></i>
                <span class="ml-2 font-medium">Portofolio</span>
            </a>
            <a href="<?= base_url('admin/settings') ?>" class="flex items-center px-3 py-2.5 <?= (url_is('admin/settings*') ? 'bg-blue-600/10 text-blue-400' : 'hover:bg-slate-800 hover:text-white') ?> rounded-lg group transition mt-1">
                <i class="fa-solid fa-gear w-6 text-center"></i>
                <span class="ml-2 font-medium">Pengaturan Web</span>
            </a>
        </nav>

        <div class="p-4 border-t border-slate-800 bg-slate-950/30">
            <div class="flex items-center">
                <div class="w-8 h-8 rounded-full bg-slate-700 flex items-center justify-center border border-slate-600">
                    <i class="fa-solid fa-user-tie text-xs"></i>
                </div>
                <div class="ml-3 overflow-hidden">
                    <p class="text-sm font-medium text-white truncate"><?= session()->get('admin_nama') ?></p>
                    <p class="text-xs text-slate-500 truncate">Administrator</p>
                </div>
            </div>
        </div>
    </aside>

    <div class="flex-1 flex flex-col h-screen overflow-hidden">

        <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-6 shadow-sm z-10">
            <div class="flex items-center">
                <button onclick="toggleSidebar()" class="md:hidden text-slate-600 hover:text-blue-600 transition p-1">
                    <i class="fa-solid fa-bars text-xl"></i>
                </button>
                <h2 class="text-md md:text-lg font-bold text-slate-700 ml-3 md:ml-0 border-l-4 border-blue-500 pl-3">Ruang Kendali</h2>
            </div>

            <button onclick="confirmLogout()" class="text-xs md:text-sm bg-red-50 text-red-600 hover:bg-red-500 hover:text-white px-3 py-2 md:px-4 md:py-2 rounded-lg font-medium transition flex items-center border border-red-100">
                <i class="fa-solid fa-power-off mr-1.5"></i> Keluar
            </button>
        </header>

        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-slate-50 p-4 md:p-6">
            <?= $this->renderSection('content') ?>
        </main>
    </div>

    <script>
        // Fungsi Toggle Hamburger Menu Mobile
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');

            if (sidebar.classList.contains('-translate-x-full')) {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
                setTimeout(() => overlay.classList.add('opacity-100'), 10);
            } else {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.remove('opacity-100');
                setTimeout(() => overlay.classList.add('hidden'), 300);
            }
        }

        function confirmLogout() {
            Swal.fire({
                title: 'Akhiri Sesi?',
                text: "Anda akan keluar dari Panel Admin.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Keluar',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "<?= base_url('auth/logout') ?>";
                }
            });
        }
    </script>
</body>

</html>