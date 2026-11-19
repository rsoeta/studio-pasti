<?php
$homeUrl = function_exists('base_url') ? base_url() : '/';
$iconUrl = function_exists('base_url') ? base_url('PASTI - Icon.png') : '/PASTI - Icon.png';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex">
    <meta name="theme-color" content="#0b1226">
    <title><?= lang('Errors.whoops') ?> — Studio PASTI</title>
    <link rel="icon" type="image/png" href="<?= htmlspecialchars($iconUrl, ENT_QUOTES, 'UTF-8') ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --night: #0b1226;
            --night-2: #16203d;
            --cobalt: #2f5fe8;
            --cobalt-deep: #1f45c4;
            --sky: #8fb2f7;
            --ice: #e9f0fc;
            --frost: #d9e4f8;
            --paper: #f4f7fd;
            --ink: #0f1a33;
            --mute: #4a5878;
            --accent: #f37a1f;
            --peach: #ffe3cf;
            --peach-ink: #7c3605;
        }

        *, *::before, *::after {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Ubuntu', system-ui, -apple-system, 'Segoe UI', sans-serif;
            background:
                radial-gradient(circle at 50% 18%, rgba(143, 178, 247, 0.24), transparent 56%),
                linear-gradient(160deg, var(--night-2) 0%, var(--night) 100%);
            color: #f7f9fe;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 28px 16px;
            position: relative;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        .gridlines {
            position: fixed;
            inset: 0;
            max-width: 1440px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            pointer-events: none;
            z-index: 0;
        }

        .gridlines span {
            border-left: 1px solid rgba(247, 249, 254, 0.045);
        }

        .gridlines span:last-child {
            border-right: 1px solid rgba(247, 249, 254, 0.045);
        }

        .orb {
            position: fixed;
            border-radius: 50%;
            background: radial-gradient(
                circle at 30% 28%,
                #ffffff 0%,
                #f4f7fd 18%,
                #8fb2f7 45%,
                #2f5fe8 74%,
                #0b1226 100%
            );
            box-shadow:
                inset -4px -6px 12px rgba(11, 18, 38, 0.55),
                inset 3px 3px 8px rgba(255, 255, 255, 0.9);
            filter: drop-shadow(0 16px 26px rgba(5, 12, 26, 0.45));
            pointer-events: none;
            z-index: 1;
        }

        .card {
            position: relative;
            z-index: 2;
            width: min(560px, 100%);
            background-color: var(--paper);
            color: var(--ink);
            border-radius: 24px;
            padding: clamp(28px, 4vw, 44px);
            text-align: center;
            box-shadow:
                0 1px 0 rgba(255, 255, 255, 0.9) inset,
                0 32px 72px rgba(5, 12, 26, 0.58);
        }

        .emblem-wrap {
            width: 78px;
            height: 78px;
            margin: 0 auto 18px;
            border-radius: 50%;
            padding: 12px;
            background: radial-gradient(
                circle at 30% 28%,
                #ffffff 0%,
                #e9f0fc 45%,
                #8fb2f7 82%,
                #2f5fe8 100%
            );
            border: 1.5px solid rgba(255, 255, 255, 0.88);
            box-shadow:
                0 16px 34px rgba(15, 26, 51, 0.2),
                0 0 36px rgba(143, 178, 247, 0.42);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .emblem-wrap img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 50%;
        }

        .emblem-fallback {
            display: none;
            width: 100%;
            height: 100%;
            align-items: center;
            justify-content: center;
            color: var(--cobalt-deep);
        }

        .pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 14px;
            border-radius: 999px;
            background-color: var(--peach);
            color: var(--peach-ink);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            margin-bottom: 14px;
        }

        .pill-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background-color: var(--accent);
        }

        .code-label {
            margin: 0;
            font-size: clamp(44px, 8vw, 68px);
            font-weight: 700;
            letter-spacing: -0.04em;
            line-height: 0.95;
            color: var(--cobalt);
        }

        .headline {
            margin: 10px 0 0;
            font-size: clamp(20px, 3vw, 25px);
            font-weight: 700;
            letter-spacing: -0.02em;
            color: var(--ink);
        }

        .quote {
            margin: 10px 0 0;
            font-size: 13.5px;
            font-weight: 500;
            color: var(--cobalt-deep);
            background-color: var(--ice);
            border: 1px solid rgba(31, 69, 196, 0.14);
            display: inline-block;
            padding: 6px 14px;
            border-radius: 999px;
        }

        .desc {
            margin: 16px auto 0;
            max-width: 440px;
            font-size: 14.5px;
            line-height: 1.6;
            color: var(--mute);
        }

        .actions {
            margin-top: 28px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 46px;
            padding: 0 20px;
            border-radius: 999px;
            font-family: inherit;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.03em;
            text-decoration: none;
            cursor: pointer;
            border: 1px solid transparent;
            transition: background-color 0.2s ease, transform 0.2s ease, border-color 0.2s ease;
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        .btn--primary {
            background-color: var(--cobalt);
            color: #f7f9fe;
            box-shadow: 0 10px 24px rgba(47, 95, 232, 0.28);
        }

        .btn--primary:hover {
            background-color: var(--cobalt-deep);
        }

        .btn--secondary {
            background-color: var(--ice);
            color: var(--ink);
            border-color: rgba(31, 69, 196, 0.22);
        }

        .btn--secondary:hover {
            background-color: var(--frost);
            border-color: var(--cobalt);
        }

        .foot {
            margin-top: 26px;
            padding-top: 16px;
            border-top: 1px solid rgba(31, 69, 196, 0.14);
            font-size: 12px;
            font-weight: 500;
            color: var(--mute);
        }
    </style>
</head>
<body>
    <div class="gridlines" aria-hidden="true">
        <span></span><span></span><span></span><span></span><span></span><span></span>
    </div>

    <span class="orb" style="width:52px;height:52px;top:12%;left:10%;" aria-hidden="true"></span>
    <span class="orb" style="width:32px;height:32px;top:22%;right:12%;" aria-hidden="true"></span>
    <span class="orb" style="width:44px;height:44px;bottom:14%;left:14%;" aria-hidden="true"></span>
    <span class="orb" style="width:26px;height:26px;bottom:18%;right:10%;" aria-hidden="true"></span>

    <main class="card" role="main">
        <div class="emblem-wrap">
            <img src="<?= htmlspecialchars($iconUrl, ENT_QUOTES, 'UTF-8') ?>" alt="Studio PASTI" onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
            <span class="emblem-fallback" aria-hidden="true">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                    <line x1="12" y1="8" x2="12" y2="12"></line>
                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                </svg>
            </span>
        </div>

        <span class="pill">
            <span class="pill-dot"></span>
            Proteksi &amp; Kendali Sistem
        </span>

        <h1 class="code-label"><?= htmlspecialchars(lang('Errors.whoops'), ENT_QUOTES, 'UTF-8') ?></h1>
        <h2 class="headline">Kendala Sistem Terdeteksi</h2>
        <div class="quote"><?= htmlspecialchars(lang('Errors.weHitASnag'), ENT_QUOTES, 'UTF-8') ?></div>

        <p class="desc">
            Permintaan Anda belum dapat diselesaikan karena gangguan teknis sementara atau proteksi keamanan sesi. Silakan muat ulang halaman atau kembali ke beranda.
        </p>

        <div class="actions">
            <button type="button" class="btn btn--primary" onclick="window.location.reload()">
                Muat Ulang Halaman
            </button>
            <button type="button" class="btn btn--secondary" onclick="window.history.back()">
                Halaman Sebelumnya
            </button>
            <a href="<?= htmlspecialchars($homeUrl, ENT_QUOTES, 'UTF-8') ?>" class="btn btn--secondary">
                Ke Beranda Studio PASTI
            </a>
        </div>

        <div class="foot">
            Studio PASTI &bull; Prima Automasi Sistem Teknologi Informasi
        </div>
    </main>
</body>
</html>
