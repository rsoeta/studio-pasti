<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= esc($settings['teks_hero_judul']) ?> - <?= esc($settings['nama_web']) ?></title>
    <meta name="title" content="<?= esc($settings['teks_hero_judul']) ?> - <?= esc($settings['nama_web']) ?>">
    <meta name="description" content="<?= esc($settings['teks_hero_deskripsi']) ?>">

    <link rel="icon" type="image/png" href="<?= base_url('PASTI - Icon.png') ?>">
    <link rel="apple-touch-icon" href="<?= base_url('PASTI - Icon.png') ?>">

    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= base_url() ?>">
    <meta property="og:title" content="<?= esc($settings['teks_hero_judul']) ?> - <?= esc($settings['nama_web']) ?>">
    <meta property="og:description" content="<?= esc($settings['teks_hero_deskripsi']) ?>">
    <meta property="og:image" content="<?= base_url('PASTI - Icon.png') ?>">

    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?= base_url() ?>">
    <meta property="twitter:title" content="<?= esc($settings['teks_hero_judul']) ?> - <?= esc($settings['nama_web']) ?>">
    <meta property="twitter:description" content="<?= esc($settings['teks_hero_deskripsi']) ?>">
    <meta property="twitter:image" content="<?= base_url('PASTI - Icon.png') ?>">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            font-family: 'Ubuntu', sans-serif !important;
        }

        /* Ukuran SweetAlert2 Minimalis Khusus Mobile */
        .swal2-popup {
            font-size: 0.85rem !important;
            width: 20rem !important;
            background-color: #1e293b !important;
            color: #f8fafc !important;
            border: 1px solid #3b82f6 !important;
            border-radius: 12px !important;
        }

        .swal2-title {
            color: #f8fafc !important;
            font-size: 1.1rem !important;
        }

        .swal2-html-container {
            color: #94a3b8 !important;
            font-size: 0.9rem !important;
        }

        .swal2-confirm {
            background-color: #3b82f6 !important;
            padding: 0.5em 2em !important;
            font-size: 0.85rem !important;
        }

        .glow-card:hover {
            box-shadow: 0 0 20px rgba(59, 130, 246, 0.4);
            border-color: #3b82f6;
            transform: translateY(-4px);
            transition: all 0.3s ease;
        }
    </style>
</head>

<body class="bg-slate-900 text-slate-100">

    <nav class="border-b border-slate-800 bg-slate-900/80 backdrop-blur sticky top-0 z-50 px-6 py-4 flex justify-between items-center">
        <div class="flex items-center gap-2">
            <img src="<?= base_url('PASTI - Icon.png') ?>" alt="Logo PASTI" class="w-8 h-8 rounded-lg shadow-[0_0_10px_rgba(37,99,235,0.5)] object-cover">
            <span class="font-bold text-lg tracking-wider text-white"><?= esc($settings['nama_web']) ?></span>
        </div>
        <a href="https://wa.me/<?= $settings['nomor_wa'] ?>" target="_blank" class="bg-blue-600 hover:bg-blue-500 text-xs text-white px-4 py-2 rounded-full font-semibold transition">
            <i class="fa-brands fa-whatsapp mr-1"></i> Kontak Konsultasi
        </a>
    </nav>

    <header class="max-w-5xl mx-auto px-6 py-16 text-center">
        <span class="text-xs font-bold uppercase tracking-widest text-blue-400 border border-blue-500/30 px-3 py-1 rounded-full bg-blue-500/10">Studio Pusat & Automasi</span>
        <h1 class="text-3xl md:text-5xl font-extrabold mt-6 text-white leading-tight">
            <?= esc($settings['teks_hero_judul']) ?>
        </h1>
        <p class="mt-4 text-slate-400 text-sm md:text-base max-w-2xl mx-auto">
            <?= esc($settings['teks_hero_deskripsi']) ?>
        </p>
    </header>

    <main class="max-w-5xl mx-auto px-6 pb-24">
        <div class="flex items-center gap-3 mb-8 border-b border-slate-800 pb-4">
            <h2 class="text-xl font-bold text-white">Katalog Sistem & Aplikasi Demo</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <?php if (!empty($apps)): ?>
                <?php foreach ($apps as $app): ?>
                    <div class="bg-slate-800/50 border border-slate-700/60 rounded-xl p-6 flex flex-col justify-between transition-all duration-300 glow-card">
                        <div>
                            <div class="w-10 h-10 rounded-lg bg-slate-700/50 text-blue-400 flex items-center justify-center mb-4 text-lg border border-slate-600/40">
                                <i class="fa <?= esc($app['ikon']) ?>"></i>
                            </div>
                            <h3 class="text-lg font-bold text-white m-0"><?= esc($app['judul']) ?></h3>
                            <p class="text-slate-400 text-xs mt-2 mb-6 text-left"><?= esc($app['deskripsi']) ?></p>
                        </div>
                        <div class="flex gap-3 pt-2">
                            <a href="<?= esc($app['link_github']) ?>" target="_blank" class="flex-1 bg-slate-700/60 hover:bg-slate-700 border border-slate-600/50 text-center text-xs text-slate-200 py-2.5 rounded-lg font-medium transition">
                                <i class="fa-brands fa-github mr-1"></i> GitHub
                            </a>
                            <button onclick="launchDemo('<?= esc($app['judul']) ?>', '<?= $app['status_demo'] ?>', '<?= esc($app['link_demo']) ?>')" class="flex-1 bg-blue-600 hover:bg-blue-500 text-white text-center text-xs py-2.5 rounded-lg font-medium transition cursor-pointer shadow-[0_2px_8px_rgba(37,99,235,0.3)]">
                                <i class="fa-solid fa-laptop-code mr-1"></i> Uji Demo
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-1 md:col-span-2 text-center py-12 text-slate-500 text-sm border border-dashed border-slate-800 rounded-xl">
                    <i class="fa-solid fa-folder-open text-2xl mb-2 block text-slate-600"></i>
                    Belum ada aplikasi demo yang dipublikasikan.
                </div>
            <?php endif; ?>
        </div>
    </main>

    <footer class="border-t border-slate-800 bg-slate-950 py-8 px-6 flex flex-col items-center justify-center gap-4 text-xs text-slate-500 relative">
        <p class="text-center m-0 z-10"><?= esc($settings['teks_footer']) ?></p>

        <a href="<?= base_url('auth/login') ?>" class="z-10 inline-flex items-center gap-1.5 text-slate-700 hover:text-blue-500 transition-colors duration-300" title="Akses Ruang Kendali">
            <i class="fa-solid fa-shield-halved text-[10px]"></i> <span class="font-medium tracking-wide">Otoritas</span>
        </a>

        <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-1/3 h-1 bg-blue-600/20 blur-md rounded-t-full"></div>
    </footer>

    <script>
        function launchDemo(appName, status, urlDemo) {
            if (status === 'ready') {
                Swal.fire({
                    title: 'Akses Demo Terbuka',
                    text: 'Membuka sistem aplikasi demo ' + appName + '. Pastikan pop-up browser Anda aktif.',
                    icon: 'success',
                    confirmButtonText: 'Lanjutkan'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Membuka URL demo unik yang ditarik dari database
                        window.open(urlDemo, '_blank');
                    }
                });
            } else {
                Swal.fire({
                    title: 'Sistem Pemeliharaan',
                    text: 'Aplikasi demo untuk ' + appName + ' saat ini sedang dalam proses deployment server. Hubungi kami untuk info lebih lanjut.',
                    icon: 'info',
                    confirmButtonText: 'Dimengerti'
                });
            }
        }
    </script>
</body>

</html>