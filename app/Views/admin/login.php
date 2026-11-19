<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Panel Admin - Studio PASTI</title>

    <link rel="icon" type="image/png" href="<?= base_url('PASTI - Icon.png') ?>">
    <link rel="apple-touch-icon" href="<?= base_url('icons/icon-192x192.png') ?>">
    <link rel="manifest" href="<?= base_url('manifest.json') ?>">
    <meta name="theme-color" content="#24425f">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="Studio PASTI">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        (function () {
            try {
                const saved = localStorage.getItem('orvex_admin_theme');
                const systemDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
                const theme = saved === 'dark' || saved === 'light' ? saved : (systemDark ? 'dark' : 'light');
                document.documentElement.setAttribute('data-theme', theme);
            } catch (e) {
                document.documentElement.setAttribute('data-theme', 'light');
            }
        })();
    </script>

    <style>
        :root,
        [data-theme="light"] {
            --font: 'Ubuntu', sans-serif;
            --bg: #24425f;
            --ground-hi: #2c4e6e;
            --g-ink: #f2f6fa;
            --g-muted: #c3d2e1;
            --g-line: rgba(242, 246, 250, 0.28);
            --card: #eef3f7;
            --card-2: #e3eaf1;
            --panel: #f4f7fa;
            --paper: #ffffff;
            --top-light: rgba(255, 255, 255, 0.85);
            --shadow: 0 2px 6px rgba(5, 20, 35, 0.14), 0 28px 60px -20px rgba(5, 20, 35, 0.6);
            --ink: #0f1a24;
            --muted: #536375;
            --line: rgba(15, 30, 45, 0.1);
            --line-2: rgba(15, 30, 45, 0.18);
            --accent: #f37a1f;
            --accent-hi: #ff8a33;
            --accent-ink: #2a1206;
            --accent-text: #a84a08;
            --peach: #ffe3cf;
            --peach-ink: #2a1206;
            --hl-peach: oklch(88% 0.075 55);
            --r-md: 10px;
            --r-xl: 20px;
            --ease: cubic-bezier(.22, 1, .36, 1);
        }

        [data-theme="dark"] {
            --bg: #0d1721;
            --ground-hi: #13202d;
            --g-ink: #eef3f8;
            --g-muted: #9fb0c1;
            --g-line: rgba(238, 243, 248, 0.18);
            --card: #172331;
            --card-2: #1d2b3a;
            --panel: #1a2735;
            --paper: #131e2a;
            --top-light: rgba(255, 255, 255, 0.08);
            --shadow: 0 4px 10px rgba(0, 0, 0, 0.45), 0 32px 70px -20px rgba(0, 0, 0, 0.8);
            --ink: #eef3f8;
            --muted: #95a5b6;
            --line: rgba(255, 255, 255, 0.08);
            --line-2: rgba(255, 255, 255, 0.15);
            --accent: #f7862e;
            --accent-hi: #ff9845;
            --accent-ink: #241003;
            --accent-text: #ffaa6b;
            --peach: #3a2214;
            --peach-ink: #ffaa6b;
            --hl-peach: oklch(50% 0.1 55);
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            min-height: 100%;
            font-family: 'Ubuntu', sans-serif !important;
            background-color: var(--bg);
            color: var(--ink);
            font-size: 14px;
            line-height: 1.5;
            -webkit-font-smoothing: antialiased;
        }

        button,
        input {
            font-family: 'Ubuntu', sans-serif !important;
        }

        .login-shell {
            min-height: 100vh;
            padding: 24px 16px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .login-radar-bg {
            position: fixed;
            inset: 0;
            pointer-events: none;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0.18;
        }

        .login-radar-bg svg {
            width: min(920px, 120vw);
            height: auto;
        }

        .theme-corner {
            position: fixed;
            top: 18px;
            right: 18px;
            z-index: 20;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            min-height: 42px;
            padding: 0 14px;
            border-radius: var(--r-md);
            border: 1px solid var(--g-line);
            background-color: rgba(255, 255, 255, 0.08);
            color: var(--g-ink);
            font-size: 12.5px;
            font-weight: 600;
            cursor: pointer;
            backdrop-filter: blur(10px);
            transition: background-color 0.2s ease;
        }

        .theme-corner:hover {
            background-color: var(--ground-hi);
        }

        .login-card {
            position: relative;
            z-index: 10;
            width: min(440px, 100%);
            background-color: var(--card);
            border-radius: var(--r-xl);
            padding: 32px;
            box-shadow: inset 0 1px 0 var(--top-light), inset 0 0 0 1px var(--line), var(--shadow);
        }

        .login-brand {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            margin-bottom: 26px;
        }

        .login-badge-icon {
            width: 64px;
            height: 64px;
            border-radius: 16px;
            background: #0f1a24;
            border: 1px solid rgba(255, 255, 255, 0.16);
            padding: 10px;
            box-shadow: 0 14px 28px rgba(5, 20, 35, 0.28);
            margin-bottom: 14px;
        }

        .login-badge-icon img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 8px;
        }

        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 12px;
            border-radius: 999px;
            background-color: var(--peach);
            color: var(--peach-ink);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .login-title {
            position: relative;
            margin: 0;
            font-size: 26px;
            font-weight: 700;
            letter-spacing: -0.025em;
            color: var(--ink);
            display: inline-block;
            z-index: 1;
        }

        .login-title::after {
            content: '';
            position: absolute;
            left: 0;
            right: 0;
            bottom: 2px;
            height: 7px;
            background: var(--hl-peach);
            opacity: 0.55;
            border-radius: 4px;
            z-index: -1;
        }

        .login-sub {
            margin: 6px 0 0;
            font-size: 13.5px;
            color: var(--muted);
        }

        .form-stack {
            display: grid;
            gap: 16px;
        }

        .field-label {
            display: block;
            margin-bottom: 6px;
            font-size: 11.5px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--muted);
        }

        .input-wrap {
            position: relative;
        }

        .input-wrap i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--muted);
            font-size: 13.5px;
            pointer-events: none;
        }

        .orvex-input {
            width: 100%;
            min-height: 46px;
            padding: 10px 14px 10px 40px;
            border-radius: var(--r-md);
            border: 1px solid var(--line-2);
            background-color: var(--panel);
            color: var(--ink);
            font-size: 14px;
            outline: none;
            transition: border-color 0.2s ease, box-shadow 0.2s ease, background-color 0.2s ease;
        }

        .orvex-input:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(243, 122, 31, 0.2);
            background-color: var(--paper);
        }

        .btn-submit {
            width: 100%;
            min-height: 46px;
            margin-top: 4px;
            border: 0;
            border-radius: var(--r-md);
            background-color: var(--accent);
            color: var(--accent-ink);
            font-size: 13.5px;
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 10px 24px rgba(243, 122, 31, 0.32);
            transition: background-color 0.2s ease, transform 0.2s var(--ease);
        }

        .btn-submit:hover {
            background-color: var(--accent-hi);
            transform: translateY(-1px);
        }

        .login-foot {
            margin-top: 22px;
            padding-top: 16px;
            border-top: 1px solid var(--line);
            text-align: center;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            min-height: 40px;
            padding: 0 12px;
            font-size: 12.5px;
            font-weight: 600;
            color: var(--muted);
            text-decoration: none;
            border-radius: var(--r-md);
            transition: color 0.2s ease, background-color 0.2s ease;
        }

        .back-link:hover {
            color: var(--accent-text);
            background-color: var(--card-2);
        }

        /* SweetAlert2 Orvex Styling */
        .swal2-popup {
            font-family: 'Ubuntu', sans-serif !important;
            font-size: 0.9rem !important;
            width: min(22rem, 92vw) !important;
            border-radius: var(--r-xl) !important;
            background-color: var(--panel) !important;
            color: var(--ink) !important;
            border: 1px solid var(--line-2) !important;
            box-shadow: var(--shadow) !important;
        }

        .swal2-title {
            color: var(--ink) !important;
            font-size: 1.15rem !important;
            font-weight: 700 !important;
        }

        .swal2-html-container {
            color: var(--muted) !important;
            font-size: 0.9rem !important;
        }

        .swal2-confirm {
            background-color: var(--accent) !important;
            color: var(--accent-ink) !important;
            font-weight: 700 !important;
            border-radius: var(--r-md) !important;
            min-height: 42px !important;
            padding: 0 22px !important;
        }
    </style>
</head>

<body>
    <button type="button" class="theme-corner" id="login-theme-btn" aria-label="Ganti tema tampilan">
        <i class="fa-solid fa-moon" id="login-theme-icon"></i>
        <span id="login-theme-label">Dark</span>
    </button>

    <div class="login-shell">
        <div class="login-radar-bg" aria-hidden="true">
            <svg viewBox="0 0 800 440" fill="none">
                <circle cx="400" cy="400" r="350" stroke="#f2f6fa" stroke-width="1" stroke-dasharray="4 8" />
                <circle cx="400" cy="400" r="250" stroke="#f2f6fa" stroke-width="1" />
                <circle cx="400" cy="400" r="150" stroke="#f37a1f" stroke-width="2" />
            </svg>
        </div>

        <main class="login-card">
            <div class="login-brand">
                <div class="login-badge-icon">
                    <img src="<?= base_url('PASTI - Icon.png') ?>" alt="Logo PASTI">
                </div>
                <span class="status-pill">
                    <i class="fa-solid fa-shield-halved"></i> Area Otoritas
                </span>
                <h1 class="login-title">Area Otoritas</h1>
                <p class="login-sub">Masuk ke Dasbor Ruang Kendali Studio PASTI</p>
            </div>

            <form action="<?= base_url('auth/attempt') ?>" method="POST" class="form-stack">
                <?= csrf_field() ?>

                <div>
                    <label for="username" class="field-label">Username / Email</label>
                    <div class="input-wrap">
                        <i class="fa-solid fa-user"></i>
                        <input
                            type="text"
                            id="username"
                            name="username"
                            value="<?= old('username') ?>"
                            required
                            autocomplete="off"
                            class="orvex-input"
                            placeholder="Masukkan kredensial Anda">
                    </div>
                </div>

                <div>
                    <label for="password" class="field-label">Kata Sandi</label>
                    <div class="input-wrap">
                        <i class="fa-solid fa-lock"></i>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            required
                            class="orvex-input"
                            placeholder="••••••••">
                    </div>
                </div>

                <button type="submit" class="btn-submit">
                    <i class="fa-solid fa-right-to-bracket"></i> Masuk Sistem
                </button>
            </form>

            <div class="login-foot">
                <a href="<?= base_url() ?>" class="back-link">
                    <i class="fa-solid fa-arrow-left"></i> Kembali ke Halaman Utama
                </a>
            </div>
        </main>
    </div>

    <script>
        (function () {
            const btn = document.getElementById('login-theme-btn');
            const icon = document.getElementById('login-theme-icon');
            const label = document.getElementById('login-theme-label');

            function syncUI() {
                const cur = document.documentElement.getAttribute('data-theme') || 'light';
                if (icon) icon.className = cur === 'dark' ? 'fa-solid fa-sun' : 'fa-solid fa-moon';
                if (label) label.textContent = cur === 'dark' ? 'Light' : 'Dark';
            }

            syncUI();

            if (btn) {
                btn.addEventListener('click', () => {
                    const cur = document.documentElement.getAttribute('data-theme') || 'light';
                    const next = cur === 'dark' ? 'light' : 'dark';
                    document.documentElement.setAttribute('data-theme', next);
                    try {
                        localStorage.setItem('orvex_admin_theme', next);
                    } catch (e) {}
                    syncUI();
                });
            }
        })();

        <?php if (session()->getFlashdata('error')) : ?>
            Swal.fire({
                title: 'Akses Ditolak',
                text: '<?= esc(session()->getFlashdata('error'), 'js') ?>',
                icon: 'error',
                confirmButtonText: 'Coba Lagi'
            });
        <?php endif; ?>

        <?php if (session()->getFlashdata('success')) : ?>
            Swal.fire({
                title: 'Berhasil',
                text: '<?= esc(session()->getFlashdata('success'), 'js') ?>',
                icon: 'success',
                confirmButtonText: 'Tutup'
            });
        <?php endif; ?>

        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('<?= base_url('sw.js') ?>', { scope: '/' }).catch((err) => {
                    console.warn('Service Worker registration failed:', err);
                });
            });
        }
    </script>
</body>

</html>
