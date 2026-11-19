<?php
$homeUrl = function_exists('base_url') ? base_url() : '/';
$iconUrl = function_exists('base_url') ? base_url('PASTI - Icon.png') : '/PASTI - Icon.png';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex">
    <meta name="theme-color" content="#0b1226">
    <title><?= lang('Errors.pageNotFound') ?> — Studio PASTI</title>
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
            --ice: #e9f0fc;
            --frost: #d9e4f8;
            --paper: #f4f7fd;
            --ink: #0f1a33;
            --mute: #4a5878;
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
            background: radial-gradient(circle at 30% 28%, #ffffff 0%, #e9f0fc 45%, #8fb2f7 82%, #2f5fe8 100%);
            border: 1.5px solid rgba(255, 255, 255, 0.88);
            box-shadow: 0 16px 34px rgba(15, 26, 51, 0.2), 0 0 36px rgba(143, 178, 247, 0.42);
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

        .pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 14px;
            border-radius: 999px;
            background-color: var(--ice);
            color: var(--cobalt-deep);
            border: 1px solid rgba(31, 69, 196, 0.2);
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
            background-color: var(--cobalt);
        }

        .code-label {
            margin: 0;
            font-size: clamp(54px, 10vw, 82px);
            font-weight: 700;
            letter-spacing: -0.05em;
            line-height: 0.9;
            color: var(--cobalt);
        }

        .headline {
            margin: 12px 0 0;
            font-size: clamp(20px, 3vw, 25px);
            font-weight: 700;
            letter-spacing: -0.02em;
            color: var(--ink);
        }

        .desc {
            margin: 14px auto 0;
            max-width: 440px;
            font-size: 14.5px;
            line-height: 1.6;
            color: var(--mute);
        }

        .debug-box {
            margin: 16px auto 0;
            padding: 12px 16px;
            border-radius: 12px;
            background-color: var(--ice);
            border: 1px solid rgba(31, 69, 196, 0.16);
            color: var(--ink);
            font-size: 13px;
            line-height: 1.55;
            text-align: left;
            overflow-wrap: anywhere;
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
    <span class="orb" style="width:30px;height:30px;top:24%;right:12%;" aria-hidden="true"></span>
    <span class="orb" style="width:44px;height:44px;bottom:14%;left:14%;" aria-hidden="true"></span>

    <main class="card" role="main">
        <div class="emblem-wrap">
            <img src="<?= htmlspecialchars($iconUrl, ENT_QUOTES, 'UTF-8') ?>" alt="Studio PASTI" onerror="this.style.display='none'">
        </div>

        <span class="pill">
            <span class="pill-dot"></span>
            Navigasi Sistem &bull; HTTP 404
        </span>

        <h1 class="code-label">404</h1>
        <h2 class="headline">Halaman Tidak Ditemukan</h2>

        <?php if (defined('ENVIRONMENT') && ENVIRONMENT !== 'production') : ?>
            <div class="debug-box"><?= nl2br(esc($message)) ?></div>
        <?php else : ?>
            <p class="desc">
                Tautan atau halaman yang Anda tuju tidak tersedia, telah dipindahkan, atau sudah tidak dipublikasikan.
            </p>
        <?php endif; ?>

        <div class="actions">
            <a href="<?= htmlspecialchars($homeUrl, ENT_QUOTES, 'UTF-8') ?>" class="btn btn--primary">
                Ke Beranda Studio PASTI
            </a>
            <button type="button" class="btn btn--secondary" onclick="window.history.back()">
                Halaman Sebelumnya
            </button>
        </div>

        <div class="foot">
            Studio PASTI &bull; Prima Automasi Sistem Teknologi Informasi
        </div>
    </main>
</body>
</html>
