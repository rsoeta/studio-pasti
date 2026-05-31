<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Panel Admin - Studio PASTI</title>

    <link rel="icon" type="image/png" href="<?= base_url('PASTI - Icon.png') ?>">
    <link rel="apple-touch-icon" href="<?= base_url('PASTI - Icon.png') ?>">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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

        /* Efek Kaca (Glassmorphism) untuk Kartu Login */
        .glass-card {
            background: rgba(30, 41, 59, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(59, 130, 246, 0.3);
            box-shadow: 0 0 25px rgba(59, 130, 246, 0.15);
        }
    </style>
</head>

<body class="bg-slate-900 text-slate-100 min-h-screen flex items-center justify-center p-4 relative overflow-hidden">

    <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-blue-600/20 rounded-full blur-[100px] z-0"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-96 h-96 bg-cyan-500/10 rounded-full blur-[100px] z-0"></div>

    <div class="w-full max-w-md glass-card rounded-2xl p-8 z-10 relative">

        <div class="text-center mb-8">
            <img src="<?= base_url('PASTI - Icon.png') ?>" alt="Logo PASTI" class="w-16 h-16 mx-auto rounded-xl shadow-[0_0_15px_rgba(37,99,235,0.6)] object-cover mb-4">
            <h1 class="text-2xl font-bold text-white tracking-wide">Area Otoritas</h1>
            <p class="text-slate-400 text-sm mt-1">Masuk ke Dasbor Studio PASTI</p>
        </div>

        <form action="<?= base_url('auth/attempt') ?>" method="POST" class="space-y-5">
            <?= csrf_field() ?> <div>
                <label for="username" class="block text-sm font-medium text-slate-300 mb-1">Username / Email</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-500">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <input type="text" id="username" name="username" value="<?= old('username') ?>" required autocomplete="off"
                        class="bg-slate-800/80 border border-slate-600 text-slate-200 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 outline-none transition"
                        placeholder="Masukkan kredensial Anda">
                </div>
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-slate-300 mb-1">Kata Sandi</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-500">
                        <i class="fa-solid fa-lock"></i>
                    </div>
                    <input type="password" id="password" name="password" required
                        class="bg-slate-800/80 border border-slate-600 text-slate-200 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 outline-none transition"
                        placeholder="••••••••">
                </div>
            </div>

            <button type="submit" class="w-full text-white bg-blue-600 hover:bg-blue-500 focus:ring-4 focus:outline-none focus:ring-blue-500/50 font-bold rounded-lg text-sm px-5 py-3 text-center transition shadow-[0_4px_10px_rgba(37,99,235,0.4)] mt-2">
                <i class="fa-solid fa-right-to-bracket mr-1"></i> Masuk Sistem
            </button>
        </form>

        <div class="mt-6 text-center">
            <a href="<?= base_url() ?>" class="text-xs text-slate-400 hover:text-blue-400 transition">
                <i class="fa-solid fa-arrow-left mr-1"></i> Kembali ke Halaman Utama
            </a>
        </div>
    </div>

    <script>
        <?php if (session()->getFlashdata('error')) : ?>
            Swal.fire({
                title: 'Akses Ditolak',
                text: '<?= session()->getFlashdata('error') ?>',
                icon: 'error',
                confirmButtonText: 'Coba Lagi'
            });
        <?php endif; ?>

        <?php if (session()->getFlashdata('success')) : ?>
            Swal.fire({
                title: 'Berhasil',
                text: '<?= session()->getFlashdata('success') ?>',
                icon: 'success',
                confirmButtonText: 'Tutup'
            });
        <?php endif; ?>
    </script>
</body>

</html>