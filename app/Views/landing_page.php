<?php
$logoUrl      = \App\Models\WebSettingModel::getLogoUrl($settings ?? null);
$logoMime     = \App\Models\WebSettingModel::getLogoMime($settings ?? null);
$touchIconUrl = \App\Models\WebSettingModel::getAppleTouchIconUrl($settings ?? null);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= esc($settings['teks_hero_judul']) ?> - <?= esc($settings['nama_web']) ?></title>
    <meta name="title" content="<?= esc($settings['teks_hero_judul']) ?> - <?= esc($settings['nama_web']) ?>">
    <meta name="description" content="<?= esc($settings['teks_hero_deskripsi']) ?>">

    <link rel="icon" type="<?= esc($logoMime) ?>" href="<?= esc($logoUrl) ?>">
    <link rel="apple-touch-icon" href="<?= esc($touchIconUrl) ?>">
    <link rel="manifest" href="<?= base_url('manifest.json') ?>">
    <meta name="theme-color" content="#2f5fe8">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="<?= esc($settings['nama_web']) ?>">

    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= base_url() ?>">
    <meta property="og:title" content="<?= esc($settings['teks_hero_judul']) ?> - <?= esc($settings['nama_web']) ?>">
    <meta property="og:description" content="<?= esc($settings['teks_hero_deskripsi']) ?>">
    <meta property="og:image" content="<?= esc($logoUrl) ?>">

    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?= base_url() ?>">
    <meta property="twitter:title" content="<?= esc($settings['teks_hero_judul']) ?> - <?= esc($settings['nama_web']) ?>">
    <meta property="twitter:description" content="<?= esc($settings['teks_hero_deskripsi']) ?>">
    <meta property="twitter:image" content="<?= esc($logoUrl) ?>">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha384-iw3OoTErCYJJB9mCa8LNS2hbsQ7M3C0EpIsO/H5+EGAkPGc6rk+V8i04oW/K5xq0" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js" integrity="sha384-YB/DdIkloKoRpclWB8bNcYXWakt57USgtQPDzvnIDHYU0lasD5eWlXVo1S4ODukY" crossorigin="anonymous"></script>

    <style>
        :root {
            /* Typography — Strictly preserving Ubuntu from project */
            --font-display: 'Ubuntu', sans-serif;
            --font-body: 'Ubuntu', sans-serif;

            /* Glint Color Tokens */
            --c-cobalt: #2f5fe8;
            --c-cobalt-deep: #1f45c4;
            --c-sky: #8fb2f7;
            --c-ice: #e9f0fc;
            --c-frost: #d9e4f8;
            --c-paper: #f4f7fd;
            --c-cream: #f7f9fe;
            --c-ink: #0f1a33;
            --c-mute: #4a5878;
            --c-night: #0b1226;
            --c-night-2: #16203d;
            --c-line: rgba(31, 69, 196, 0.14);
            --c-ok: #1d7a55;
            --c-warn: #b45309;

            /* Layout Tokens */
            --max: 1440px;
            --gut: clamp(16px, 3vw, 40px);
            --r: 10px;
            --r-lg: 22px;
            --ease-out: cubic-bezier(.16, 1, .3, 1);
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        html {
            background-color: var(--c-night);
        }

        html.lenis,
        html.lenis body {
            height: auto;
        }

        .lenis.lenis-smooth {
            scroll-behavior: auto !important;
        }

        .lenis.lenis-smooth [data-lenis-prevent] {
            overscroll-behavior: contain;
        }

        .lenis.lenis-stopped {
            overflow: hidden;
        }

        .reveal-word-mask {
            display: inline-block;
            overflow: hidden;
            vertical-align: bottom;
            padding: 0.08em 0.04em 0.16em 0;
            margin: -0.08em -0.04em -0.16em 0;
        }

        .reveal-word {
            display: inline-block;
            will-change: transform, opacity;
        }

        @keyframes landingEnter {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Ubuntu', sans-serif !important;
            background-color: var(--c-ice);
            color: var(--c-ink);
            line-height: 1.55;
            -webkit-font-smoothing: antialiased;
            overflow-x: hidden;
            animation: landingEnter 0.35s var(--ease-out) both;
            transition: opacity 0.22s var(--ease-out);
        }

        body.is-page-leaving {
            opacity: 0;
        }

        #katalog,
        #arsitektur,
        #footer {
            scroll-margin-top: 84px;
        }

        img {
            display: block;
            max-width: 100%;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button,
        input {
            font-family: 'Ubuntu', sans-serif !important;
        }

        /* Skip to Content Accessibility Pill */
        .skip-link {
            position: fixed;
            top: -100px;
            left: var(--gut);
            z-index: 9999;
            background: var(--c-cobalt);
            color: var(--c-cream);
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            padding: 12px 20px;
            border-radius: 999px;
            transition: top 0.2s ease;
        }

        .skip-link:focus {
            top: 18px;
            outline: 2px solid var(--c-cream);
            outline-offset: 2px;
        }

        :focus-visible {
            outline: 2px solid var(--c-cobalt);
            outline-offset: 2px;
        }

        /* 3D Liquid Chrome Aesthetic */
        .chrome-sphere,
        .orb,
        .nav__dot,
        .marquee__orb,
        .bead {
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
            filter: drop-shadow(0 12px 18px rgba(15, 26, 51, 0.25));
            pointer-events: none;
        }

        .orb {
            position: absolute;
            z-index: 3;
            will-change: transform;
        }

        .bead {
            position: fixed;
            width: 18px;
            height: 18px;
            z-index: 9998;
            transform: translate(-50%, -50%);
            will-change: transform, opacity;
        }

        /* Adaptive Chameleon Floating Pill Navbar */
        .nav {
            position: fixed;
            inset: 14px var(--gut) auto;
            z-index: 500;
            pointer-events: none;
        }

        .nav__bar {
            position: relative;
            max-width: var(--max);
            margin: 0 auto;
            height: 64px;
            padding: 0 12px 0 18px;
            border-radius: 999px;
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            align-items: center;
            gap: 12px;
            pointer-events: auto;
            overflow: hidden;
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            transition:
                background-color 0.45s var(--ease-out),
                color 0.45s var(--ease-out),
                box-shadow 0.45s var(--ease-out);
        }

        .nav--clear .nav__bar {
            background-color: rgba(11, 18, 38, 0.34);
            color: var(--c-cream);
            box-shadow:
                0 0 0 1px rgba(247, 249, 254, 0.2) inset,
                0 12px 30px rgba(11, 18, 38, 0.28);
        }

        .nav.is-raised .nav__bar {
            background-color: rgba(244, 247, 253, 0.84);
            color: var(--c-ink);
            box-shadow:
                0 0 0 1px rgba(31, 69, 196, 0.16) inset,
                0 14px 36px rgba(11, 18, 38, 0.1);
        }

        .nav__progress {
            position: absolute;
            left: 24px;
            right: 24px;
            bottom: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--c-sky), var(--c-cobalt));
            transform-origin: left center;
            transform: scaleX(0);
            opacity: 0;
            transition: opacity 0.35s ease;
            border-radius: 999px;
        }

        .nav.is-raised .nav__progress {
            opacity: 1;
        }

        .nav__links {
            position: relative;
            display: flex;
            align-items: center;
            gap: 2px;
        }

        .nav__link {
            position: relative;
            display: inline-flex;
            align-items: center;
            min-height: 44px;
            padding: 0 14px;
            font-size: 13.5px;
            font-weight: 500;
            letter-spacing: 0.01em;
            opacity: 0.78;
            transition: opacity 0.25s ease;
            white-space: nowrap;
        }

        .nav__link:hover,
        .nav__link.is-active {
            opacity: 1;
        }

        .nav__dot {
            position: absolute;
            bottom: 7px;
            left: 0;
            width: 6px;
            height: 6px;
            opacity: 0;
            transform: translateX(0);
            transition:
                transform 0.45s var(--ease-out),
                opacity 0.25s ease;
        }

        .nav__dot.is-visible {
            opacity: 1;
        }

        .logo {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            justify-self: center;
            gap: 8px;
            height: 42px;
            padding: 0 16px 0 10px;
            border-radius: 999px;
            border: 1.5px solid currentColor;
            font-family: var(--font-display);
            font-weight: 700;
            font-size: 16px;
            letter-spacing: 0.08em;
            white-space: nowrap;
            transition: transform 0.3s var(--ease-out), border-color 0.45s ease;
        }

        .logo:hover {
            transform: scale(1.03);
        }

        .logo img {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            object-fit: cover;
            background: var(--c-paper);
        }

        .nav__tools {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 10px;
        }

        .nav__count {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            min-height: 36px;
            padding: 0 12px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.04em;
            transition: background-color 0.45s ease, color 0.45s ease;
        }

        .nav--clear .nav__count {
            background: rgba(247, 249, 254, 0.14);
            color: var(--c-cream);
        }

        .nav.is-raised .nav__count {
            background: var(--c-frost);
            color: var(--c-cobalt-deep);
        }

        .nav__cta {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 44px;
            padding: 0 18px;
            border-radius: 999px;
            font-size: 12.5px;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            white-space: nowrap;
            transition:
                background-color 0.35s var(--ease-out),
                color 0.35s var(--ease-out),
                transform 0.25s var(--ease-out);
        }

        .nav--clear .nav__cta {
            background-color: var(--c-cream);
            color: var(--c-ink);
        }

        .nav--clear .nav__cta:hover {
            background-color: #ffffff;
            transform: translateY(-1px);
        }

        .nav.is-raised .nav__cta {
            background-color: var(--c-cobalt);
            color: var(--c-cream);
        }

        .nav.is-raised .nav__cta:hover {
            background-color: var(--c-cobalt-deep);
            transform: translateY(-1px);
        }

        .nav__mobile-btn {
            display: none;
            align-items: center;
            justify-content: center;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            border: 1px solid currentColor;
            background: transparent;
            color: inherit;
            cursor: pointer;
        }

        .mobile-menu {
            display: none;
            max-width: var(--max);
            margin: 8px auto 0;
            padding: 12px;
            border-radius: 20px;
            background: rgba(11, 18, 38, 0.94);
            color: var(--c-cream);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            box-shadow: 0 18px 40px rgba(11, 18, 38, 0.35);
            pointer-events: auto;
        }

        .mobile-menu.is-open {
            display: grid;
            gap: 4px;
        }

        .mobile-menu a {
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-height: 44px;
            padding: 0 14px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 500;
        }

        .mobile-menu a:hover {
            background: rgba(247, 249, 254, 0.1);
        }

        /* Section 1: Pinned 3-Layer Depth-Sandwich Hero */
        .hero {
            position: relative;
            min-height: 100svh;
            width: 100%;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 96px var(--gut) 28px;
            background:
                radial-gradient(circle at 50% 34%, rgba(143, 178, 247, 0.32) 0%, rgba(47, 95, 232, 0.25) 35%, rgba(11, 18, 38, 0.96) 76%),
                linear-gradient(165deg, #16203d 0%, #2f5fe8 48%, #0b1226 100%);
            color: var(--c-cream);
        }

        .hero__grid {
            position: absolute;
            inset: 0;
            max-width: var(--max);
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            pointer-events: none;
            z-index: 1;
        }

        .hero__grid span {
            border-left: 1px solid rgba(247, 249, 254, 0.06);
        }

        .hero__grid span:last-child {
            border-right: 1px solid rgba(247, 249, 254, 0.06);
        }

        .hero__stage {
            position: relative;
            flex: 1;
            max-width: var(--max);
            width: 100%;
            margin: 0 auto;
            display: grid;
            grid-template-rows: auto 1fr;
            align-items: center;
            justify-items: center;
            gap: clamp(16px, 2.5vh, 28px);
            z-index: 2;
        }

        /* Depth Sandwich Container positioned cleanly below navbar */
        .hero__sandwich {
            position: relative;
            width: 100%;
            min-height: clamp(180px, 34vh, 360px);
            display: grid;
            place-items: center;
            user-select: none;
        }

        .hero__word {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: var(--font-display);
            font-size: clamp(78px, min(22vw, 38vh), 340px);
            font-weight: 700;
            line-height: 0.82;
            letter-spacing: -0.04em;
            pointer-events: none;
        }

        .hero__word--back {
            z-index: 2;
            color: var(--c-cream);
            text-shadow: 0 18px 50px rgba(11, 18, 38, 0.45);
        }

        .hero__word--front {
            z-index: 4;
        }

        .hero__char {
            display: inline-block;
            will-change: transform, opacity;
        }

        .hero__char.is-ghost {
            visibility: hidden;
        }

        .hero__char.is-line {
            color: transparent;
            -webkit-text-stroke: max(2px, 0.18vw) var(--c-cream);
            filter: drop-shadow(0 8px 20px rgba(11, 18, 38, 0.35));
        }

        /* Foreground Cutout Centerpiece (z-index: 3) */
        .hero__layer--cut {
            position: relative;
            z-index: 3;
            display: flex;
            align-items: center;
            justify-content: center;
            will-change: transform;
        }

        .hero__emblem {
            position: relative;
            width: clamp(140px, 19vw, 220px);
            height: clamp(140px, 19vw, 220px);
            border-radius: 50%;
            padding: 18px;
            background: radial-gradient(
                circle at 32% 28%,
                rgba(255, 255, 255, 0.96) 0%,
                rgba(233, 240, 252, 0.88) 42%,
                rgba(143, 178, 247, 0.52) 78%,
                rgba(47, 95, 232, 0.42) 100%
            );
            border: 1.5px solid rgba(255, 255, 255, 0.72);
            box-shadow:
                0 28px 65px rgba(11, 18, 38, 0.55),
                0 0 55px rgba(143, 178, 247, 0.45),
                inset 0 2px 12px rgba(255, 255, 255, 0.9);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero__emblem::before {
            content: '';
            position: absolute;
            inset: -14px;
            border-radius: 50%;
            border: 1px solid rgba(247, 249, 254, 0.3);
            pointer-events: none;
        }

        .hero__emblem::after {
            content: '';
            position: absolute;
            inset: -28px;
            border-radius: 50%;
            border: 1px dashed rgba(143, 178, 247, 0.35);
            pointer-events: none;
        }

        .hero__emblem img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 50%;
            filter: drop-shadow(0 8px 16px rgba(15, 26, 51, 0.22));
        }

        /* Hero Copy & Above-the-Fold CTAs */
        .hero__copy {
            position: relative;
            z-index: 5;
            max-width: 820px;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-bottom: 10px;
        }

        .hero__eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 7px 16px;
            border-radius: 999px;
            background: rgba(247, 249, 254, 0.12);
            border: 1px solid rgba(247, 249, 254, 0.24);
            font-size: 11.5px;
            font-weight: 700;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            color: var(--c-sky);
            backdrop-filter: blur(8px);
        }

        .hero__title {
            margin: 16px 0 0;
            font-family: var(--font-display);
            font-size: clamp(28px, 4.1vw, 56px);
            font-weight: 700;
            line-height: 1.04;
            letter-spacing: -0.03em;
            color: var(--c-cream);
            outline: none;
        }

        .hero__desc {
            margin: 14px 0 0;
            max-width: 640px;
            font-size: clamp(14.5px, 1.25vw, 17px);
            line-height: 1.6;
            color: rgba(233, 240, 252, 0.84);
        }

        .hero__actions {
            margin-top: 24px;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            min-height: 46px;
            padding: 0 24px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            cursor: pointer;
            border: 1.5px solid transparent;
            transition:
                transform 0.25s var(--ease-out),
                background-color 0.25s ease,
                border-color 0.25s ease,
                box-shadow 0.25s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        .btn--cream {
            background-color: var(--c-cream);
            color: var(--c-ink);
            box-shadow: 0 12px 28px rgba(11, 18, 38, 0.35);
        }

        .btn--cream:hover {
            background-color: #ffffff;
        }

        .btn--glass {
            background-color: rgba(247, 249, 254, 0.1);
            color: var(--c-cream);
            border-color: rgba(247, 249, 254, 0.32);
            backdrop-filter: blur(8px);
        }

        .btn--glass:hover {
            background-color: rgba(247, 249, 254, 0.2);
            border-color: var(--c-cream);
        }

        /* Hero Bottom Framing Bar */
        .hero__foot {
            position: relative;
            z-index: 5;
            max-width: var(--max);
            width: 100%;
            margin: 18px auto 0;
            padding-top: 16px;
            border-top: 1px solid rgba(247, 249, 254, 0.14);
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            align-items: end;
            gap: 16px;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            line-height: 1.3;
        }

        .hero__foot-left {
            color: rgba(247, 249, 254, 0.85);
        }

        .hero__cue {
            display: inline-flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            min-width: 48px;
            min-height: 44px;
            padding: 4px 12px 0;
            background: transparent;
            border: 0;
            color: var(--c-cream);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            cursor: pointer;
        }

        .hero__cue-line {
            width: 1.5px;
            height: 28px;
            background: linear-gradient(180deg, var(--c-cream), transparent);
        }

        .hero__foot-right {
            text-align: right;
            color: rgba(247, 249, 254, 0.85);
        }

        /* Section 2: Velocity-Reactive Marquee */
        .marquee {
            position: relative;
            z-index: 10;
            background-color: var(--c-cobalt);
            color: var(--c-cream);
            overflow: hidden;
            padding: 20px 0;
            border-top: 1px solid rgba(247, 249, 254, 0.18);
            border-bottom: 1px solid rgba(11, 18, 38, 0.14);
        }

        .marquee__track {
            display: flex;
            width: max-content;
            will-change: transform;
        }

        .marquee__group {
            display: flex;
            align-items: center;
            gap: 28px;
            padding-right: 28px;
            font-family: var(--font-display);
            font-size: clamp(22px, 2.8vw, 40px);
            font-weight: 700;
            letter-spacing: -0.02em;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .marquee__orb {
            width: 14px;
            height: 14px;
            flex-shrink: 0;
        }

        /* Section 3: Exposed-Grid Portfolio & Demo Catalog */
        .colls {
            position: relative;
            background-color: var(--c-ice);
            color: var(--c-ink);
            padding: clamp(64px, 8vw, 112px) var(--gut);
            overflow: hidden;
        }

        .gridlines {
            position: absolute;
            inset: 0 var(--gut);
            max-width: var(--max);
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            pointer-events: none;
            z-index: 0;
        }

        .gridlines span {
            border-left: 1px solid var(--c-line);
        }

        .gridlines span:last-child {
            border-right: 1px solid var(--c-line);
        }

        .container {
            position: relative;
            z-index: 2;
            max-width: var(--max);
            margin: 0 auto;
        }

        .section-head {
            display: flex;
            flex-wrap: wrap;
            align-items: flex-end;
            justify-content: space-between;
            gap: 24px;
            padding-bottom: 32px;
            border-bottom: 1px solid var(--c-line);
        }

        .eyebrow {
            display: inline-block;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            color: var(--c-mute);
        }

        .section-title {
            margin: 10px 0 0;
            font-family: var(--font-display);
            font-size: clamp(38px, 6.2vw, 86px);
            font-weight: 700;
            line-height: 0.92;
            letter-spacing: -0.035em;
            color: var(--c-cobalt);
        }

        .section-sub {
            max-width: 420px;
            margin: 0;
            font-size: 15px;
            line-height: 1.6;
            color: var(--c-mute);
        }

        /* Toolbar: Filter Pills + Real-Time Search */
        .toolbar {
            margin-top: 28px;
            margin-bottom: 36px;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }

        .filter-group {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 8px;
        }

        .filter-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            min-height: 44px;
            padding: 0 18px;
            border-radius: 999px;
            border: 1px solid rgba(31, 69, 196, 0.22);
            background-color: var(--c-paper);
            color: var(--c-ink);
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.02em;
            cursor: pointer;
            transition: all 0.25s var(--ease-out);
        }

        .filter-pill:hover {
            border-color: var(--c-cobalt);
            background-color: var(--c-frost);
        }

        .filter-pill.is-active {
            background-color: var(--c-cobalt);
            color: var(--c-cream);
            border-color: var(--c-cobalt);
            box-shadow: 0 8px 20px rgba(47, 95, 232, 0.25);
        }

        .search-box {
            position: relative;
            flex: 1 1 260px;
            max-width: 360px;
        }

        .search-box i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--c-mute);
            font-size: 14px;
            pointer-events: none;
        }

        .search-box input {
            width: 100%;
            min-height: 44px;
            padding: 10px 16px 10px 42px;
            border-radius: 999px;
            border: 1px solid rgba(31, 69, 196, 0.22);
            background-color: var(--c-paper);
            color: var(--c-ink);
            font-size: 14px;
            outline: none;
            transition: border-color 0.25s ease, box-shadow 0.25s ease;
        }

        .search-box input::placeholder {
            color: var(--c-mute);
        }

        .search-box input:focus {
            border-color: var(--c-cobalt);
            box-shadow: 0 0 0 3px rgba(47, 95, 232, 0.14);
        }

        /* Editorial Portfolio Cards Grid */
        .catalog-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 24px;
        }

        .app-card {
            position: relative;
            background-color: var(--c-paper);
            border: 1px solid rgba(31, 69, 196, 0.16);
            border-radius: var(--r-lg);
            padding: clamp(20px, 2.5vw, 30px);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            gap: 20px;
            transition:
                transform 0.45s var(--ease-out),
                border-color 0.35s ease,
                box-shadow 0.45s var(--ease-out);
        }

        .app-card:hover {
            transform: translateY(-5px);
            border-color: var(--c-cobalt);
            box-shadow: 0 24px 48px rgba(15, 26, 51, 0.08);
        }

        .app-card__top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .app-card__index {
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.14em;
            color: var(--c-mute);
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 12px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .status-badge i {
            font-size: 7px;
        }

        .status-badge--ready {
            background-color: rgba(29, 122, 85, 0.12);
            color: var(--c-ok);
            border: 1px solid rgba(29, 122, 85, 0.28);
        }

        .status-badge--maint {
            background-color: rgba(180, 83, 9, 0.11);
            color: var(--c-warn);
            border: 1px solid rgba(180, 83, 9, 0.25);
        }

        .app-card__head {
            display: flex;
            align-items: center;
            gap: 18px;
            margin-top: 14px;
        }

        .app-card__logo-stage {
            position: relative;
            width: 84px;
            height: 84px;
            flex-shrink: 0;
            border-radius: 16px;
            background-color: #ffffff;
            border: 1px solid rgba(31, 69, 196, 0.15);
            padding: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(15, 26, 51, 0.06);
        }

        .app-card__logo-stage img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 8px;
            transition: transform 1.1s var(--ease-out);
        }

        .app-card:hover .app-card__logo-stage img {
            transform: scale(1.08);
        }

        .app-card__title {
            margin: 0;
            font-family: var(--font-display);
            font-size: clamp(20px, 1.8vw, 24px);
            font-weight: 700;
            line-height: 1.18;
            letter-spacing: -0.02em;
            color: var(--c-ink);
        }

        /* Rich Text Description Styling */
        .deskripsi-html {
            margin-top: 16px;
            font-size: 14.5px;
            line-height: 1.6;
            color: var(--c-mute);
            text-align: left;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .deskripsi-html ul {
            list-style-type: disc;
            padding-left: 1.25rem;
            margin: 0.5rem 0;
        }

        .deskripsi-html ol {
            list-style-type: decimal;
            padding-left: 1.25rem;
            margin: 0.5rem 0;
        }

        .deskripsi-html strong,
        .deskripsi-html b {
            font-weight: 700;
            color: var(--c-ink);
        }

        .deskripsi-html p {
            margin: 0 0 0.5rem;
        }

        .btn-expand {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            min-height: 44px;
            padding: 0 4px;
            margin-top: 4px;
            background: transparent;
            border: 0;
            color: var(--c-cobalt-deep);
            font-size: 12.5px;
            font-weight: 700;
            letter-spacing: 0.04em;
            cursor: pointer;
            transition: color 0.2s ease;
        }

        .btn-expand:hover {
            color: var(--c-cobalt);
        }

        .app-card__actions {
            display: grid;
            grid-template-columns: 1fr 1.35fr;
            gap: 10px;
            padding-top: 14px;
            border-top: 1px solid var(--c-line);
        }

        .card-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 44px;
            padding: 0 16px;
            border-radius: 999px;
            font-size: 12.5px;
            font-weight: 700;
            letter-spacing: 0.04em;
            cursor: pointer;
            transition:
                background-color 0.25s ease,
                border-color 0.25s ease,
                transform 0.25s var(--ease-out),
                box-shadow 0.25s ease;
        }

        .card-btn--github {
            background-color: var(--c-ice);
            color: var(--c-ink);
            border: 1px solid rgba(31, 69, 196, 0.2);
        }

        .card-btn--github:hover {
            background-color: var(--c-frost);
            border-color: var(--c-cobalt);
            transform: translateY(-1px);
        }

        .card-btn--demo {
            background-color: var(--c-cobalt);
            color: var(--c-cream);
            border: 1px solid var(--c-cobalt);
            box-shadow: 0 8px 20px rgba(47, 95, 232, 0.24);
        }

        .card-btn--demo:hover {
            background-color: var(--c-cobalt-deep);
            border-color: var(--c-cobalt-deep);
            transform: translateY(-1px);
        }

        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 56px 24px;
            border: 1px dashed rgba(31, 69, 196, 0.3);
            border-radius: var(--r-lg);
            background-color: var(--c-paper);
            color: var(--c-mute);
            font-size: 14.5px;
        }

        .empty-state i {
            display: block;
            font-size: 28px;
            margin-bottom: 10px;
            color: var(--c-cobalt);
        }

        /* Section 4: Cobalt Lookbook-Style Architecture Stage */
        .lb {
            position: relative;
            background: linear-gradient(180deg, #1f45c4 0%, #2f5fe8 72%, #1f45c4 100%);
            color: var(--c-cream);
            padding: clamp(72px, 9vw, 128px) var(--gut);
            overflow: hidden;
        }

        .lb__top {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding-bottom: 24px;
            border-bottom: 1px solid rgba(247, 249, 254, 0.2);
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            color: rgba(247, 249, 254, 0.85);
        }

        .lb__head {
            margin: 36px 0 42px;
            display: flex;
            flex-wrap: wrap;
            align-items: flex-end;
            justify-content: space-between;
            gap: 24px;
        }

        .lb__title {
            margin: 0;
            font-family: var(--font-display);
            font-size: clamp(42px, 7vw, 102px);
            font-weight: 700;
            line-height: 0.88;
            letter-spacing: -0.04em;
            color: var(--c-cream);
        }

        .lb__cards {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 20px;
        }

        .lb__card {
            background: rgba(11, 18, 38, 0.22);
            border: 1px solid rgba(247, 249, 254, 0.2);
            border-radius: var(--r-lg);
            padding: 28px;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            display: flex;
            flex-direction: column;
            gap: 14px;
            transition: transform 0.35s var(--ease-out), background-color 0.35s ease;
        }

        .lb__card:hover {
            transform: translateY(-4px);
            background: rgba(11, 18, 38, 0.34);
        }

        .lb__card-num {
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.16em;
            color: var(--c-sky);
        }

        .lb__card h3 {
            margin: 0;
            font-size: 21px;
            font-weight: 700;
            line-height: 1.25;
            letter-spacing: -0.02em;
        }

        .lb__card p {
            margin: 0;
            font-size: 14.5px;
            line-height: 1.6;
            color: rgba(233, 240, 252, 0.82);
        }

        .lb__metrics {
            margin-top: 32px;
            padding: 24px 28px;
            border-radius: var(--r-lg);
            background: rgba(11, 18, 38, 0.28);
            border: 1px solid rgba(247, 249, 254, 0.18);
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .metric__val {
            font-size: clamp(24px, 3vw, 38px);
            font-weight: 700;
            letter-spacing: -0.03em;
            line-height: 1.05;
        }

        .metric__label {
            margin-top: 6px;
            font-size: 12px;
            font-weight: 500;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: rgba(233, 240, 252, 0.75);
        }

        /* Section 5: Deep-Night Editorial Footer */
        .foot {
            position: relative;
            background-color: var(--c-night);
            color: #c9d3ea;
            padding: clamp(64px, 8vw, 100px) var(--gut) 36px;
            overflow: hidden;
        }

        .foot__top {
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            align-items: end;
            gap: 40px;
            padding-bottom: 52px;
            border-bottom: 1px solid rgba(247, 249, 254, 0.12);
        }

        .foot__big {
            margin: 0;
            font-family: var(--font-display);
            font-size: clamp(42px, 6.2vw, 92px);
            font-weight: 700;
            line-height: 0.9;
            letter-spacing: -0.04em;
            color: var(--c-cream);
        }

        .foot__form {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .foot__form label {
            font-size: 13px;
            font-weight: 500;
            color: #9eb0d6;
        }

        .foot__input-row {
            display: flex;
            align-items: center;
            gap: 10px;
            border-bottom: 1.5px solid rgba(247, 249, 254, 0.26);
            padding-bottom: 6px;
            transition: border-color 0.25s ease;
        }

        .foot__input-row:focus-within {
            border-color: var(--c-sky);
        }

        .foot__input-row input {
            flex: 1;
            min-height: 44px;
            background: transparent;
            border: 0;
            color: var(--c-cream);
            font-size: 15px;
            outline: none;
        }

        .foot__input-row input::placeholder {
            color: rgba(201, 211, 234, 0.48);
        }

        .foot__submit {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            border: 1px solid rgba(247, 249, 254, 0.28);
            background: var(--c-cobalt);
            color: var(--c-cream);
            cursor: pointer;
            transition: background-color 0.25s ease, transform 0.25s var(--ease-out);
        }

        .foot__submit:hover {
            background: var(--c-sky);
            color: var(--c-night);
            transform: translateX(2px);
        }

        .foot__rule {
            margin-top: 32px;
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            align-items: center;
            gap: 20px;
            font-size: 13px;
        }

        .foot__links {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 8px 18px;
        }

        .foot__links a {
            display: inline-flex;
            align-items: center;
            min-height: 44px;
            color: #c9d3ea;
            transition: color 0.2s ease;
        }

        .foot__links a:hover {
            color: var(--c-sky);
        }

        .foot__right {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: flex-end;
            gap: 16px;
            color: #7f8db1;
        }

        .foot__admin {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            min-height: 44px;
            padding: 0 14px;
            border-radius: 999px;
            border: 1px solid rgba(201, 211, 234, 0.16);
            color: #9eb0d6;
            font-weight: 500;
            transition: border-color 0.25s ease, color 0.25s ease;
        }

        .foot__admin:hover {
            border-color: var(--c-cobalt);
            color: var(--c-cream);
        }

        /* Toast Feedback Pill */
        .toast {
            position: fixed;
            left: 50%;
            bottom: 24px;
            transform: translate(-50%, 120px);
            z-index: 9000;
            background-color: var(--c-ink);
            color: var(--c-cream);
            border: 1px solid rgba(143, 178, 247, 0.35);
            border-radius: 999px;
            padding: 10px 20px;
            font-size: 13px;
            font-weight: 500;
            box-shadow: 0 18px 36px rgba(11, 18, 38, 0.38);
            opacity: 0;
            pointer-events: none;
            transition: transform 0.45s var(--ease-out), opacity 0.35s ease;
        }

        .toast.is-shown {
            transform: translate(-50%, 0);
            opacity: 1;
        }

        /* Glint-Styled SweetAlert2 Override */
        .swal2-popup {
            font-family: 'Ubuntu', sans-serif !important;
            font-size: 0.9rem !important;
            width: min(24rem, 92vw) !important;
            background-color: var(--c-paper) !important;
            color: var(--c-ink) !important;
            border: 1px solid rgba(31, 69, 196, 0.22) !important;
            border-radius: 22px !important;
            padding: 1.5rem !important;
            box-shadow: 0 24px 60px rgba(11, 18, 38, 0.25) !important;
        }

        .swal2-title {
            color: var(--c-ink) !important;
            font-size: 1.25rem !important;
            font-weight: 700 !important;
            letter-spacing: -0.02em !important;
        }

        .swal2-html-container {
            color: var(--c-mute) !important;
            font-size: 0.92rem !important;
            line-height: 1.55 !important;
        }

        .swal2-confirm {
            background-color: var(--c-cobalt) !important;
            color: var(--c-cream) !important;
            border-radius: 999px !important;
            min-height: 44px !important;
            padding: 0 24px !important;
            font-size: 0.85rem !important;
            font-weight: 700 !important;
            letter-spacing: 0.05em !important;
            text-transform: uppercase !important;
        }

        .swal2-confirm:hover {
            background-color: var(--c-cobalt-deep) !important;
        }

        /* Responsive Breakpoints */
        @media (max-width: 980px) {
            .catalog-grid,
            .lb__cards {
                grid-template-columns: 1fr;
            }

            .lb__metrics {
                grid-template-columns: repeat(2, 1fr);
            }

            .foot__top {
                grid-template-columns: 1fr;
                gap: 28px;
            }

            .foot__rule {
                grid-template-columns: 1fr;
                justify-items: center;
                text-align: center;
            }

            .foot__right {
                justify-content: center;
            }
        }

        @media (max-width: 860px) {
            .nav__bar {
                grid-template-columns: auto 1fr auto;
                padding: 0 10px 0 12px;
            }

            .nav__links,
            .nav__count {
                display: none;
            }

            .nav__mobile-btn {
                display: inline-flex;
            }

            .nav__tools {
                justify-content: flex-end;
            }

            .hero__foot {
                grid-template-columns: 1fr auto;
            }

            .hero__foot-right {
                display: none;
            }
        }

        @media (max-width: 540px) {
            .app-card__actions {
                grid-template-columns: 1fr;
            }

            .lb__metrics {
                grid-template-columns: 1fr;
            }

            .nav__cta {
                padding: 0 14px;
            }

            .nav__cta span {
                display: none;
            }
        }

        /* Reduced Motion Support */
        @media (prefers-reduced-motion: reduce) {
            html {
                scroll-behavior: auto;
            }

            *,
            *::before,
            *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }
    </style>
</head>

<body>
    <a href="#katalog" class="skip-link">Lewati ke Katalog</a>

    <!-- Adaptive Chameleon Floating Pill Navbar -->
    <header class="nav nav--clear" id="site-nav">
        <div class="nav__bar">
            <div class="nav__left">
                <button type="button" class="nav__mobile-btn" id="mobile-menu-toggle" aria-expanded="false" aria-controls="mobile-menu" aria-label="Buka menu navigasi">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <nav class="nav__links" aria-label="Navigasi utama">
                    <a href="#hero" class="nav__link is-active" data-section="hero">Beranda</a>
                    <a href="#katalog" class="nav__link" data-section="katalog">Katalog</a>
                    <a href="#arsitektur" class="nav__link" data-section="arsitektur">Arsitektur</a>
                    <a href="#footer" class="nav__link" data-section="footer">Kontak</a>
                    <span class="nav__dot" id="nav-dot" aria-hidden="true"></span>
                </nav>
            </div>

            <a href="#hero" class="logo" aria-label="<?= esc($settings['nama_web']) ?>">
                <img src="<?= esc($logoUrl) ?>" alt="Logo <?= esc($settings['nama_web']) ?>">
                <span><?= esc($settings['nama_web']) ?></span>
            </a>

            <div class="nav__tools">
                <span class="nav__count">
                    <i class="fa-solid fa-layer-group"></i>
                    <?= count($apps) ?> Sistem
                </span>
                <a href="https://wa.me/<?= esc($settings['nomor_wa']) ?>" target="_blank" rel="noopener noreferrer" class="nav__cta">
                    <i class="fa-brands fa-whatsapp"></i>
                    <span>Konsultasi</span> &rarr;
                </a>
            </div>

            <div class="nav__progress" id="nav-progress" aria-hidden="true"></div>
        </div>

        <nav class="mobile-menu" id="mobile-menu" aria-label="Navigasi seluler">
            <a href="#hero">Beranda <i class="fa-solid fa-arrow-right"></i></a>
            <a href="#katalog">Katalog Sistem (<?= count($apps) ?>) <i class="fa-solid fa-arrow-right"></i></a>
            <a href="#arsitektur">Arsitektur &amp; Standar <i class="fa-solid fa-arrow-right"></i></a>
            <a href="#footer">Kontak Konsultasi <i class="fa-solid fa-arrow-right"></i></a>
        </nav>
    </header>

    <!-- Section 1: Pinned 3-Layer Depth-Sandwich Hero -->
    <section id="hero" class="hero">
        <div class="hero__grid" aria-hidden="true">
            <span></span><span></span><span></span><span></span><span></span><span></span>
        </div>

        <!-- Floating 3D Liquid Chrome Orbs -->
        <span class="orb" data-depth="18" style="width: 46px; height: 46px; top: 18%; left: 10%;" aria-hidden="true"></span>
        <span class="orb" data-depth="24" style="width: 28px; height: 28px; top: 24%; right: 14%;" aria-hidden="true"></span>
        <span class="orb" data-depth="14" style="width: 62px; height: 62px; bottom: 26%; left: 13%;" aria-hidden="true"></span>
        <span class="orb" data-depth="20" style="width: 34px; height: 34px; bottom: 24%; right: 11%;" aria-hidden="true"></span>
        <span class="orb" data-depth="12" style="width: 20px; height: 20px; top: 44%; left: 26%;" aria-hidden="true"></span>

        <div class="hero__stage">
            <!-- 3-Layer Depth Sandwich ("PASTI" Cutout Composition) -->
            <div class="hero__sandwich" id="hero-sandwich">
                <div class="hero__word hero__word--back" aria-hidden="true">
                    <span class="hero__char" data-spread="-2">P</span>
                    <span class="hero__char" data-spread="-1">A</span>
                    <span class="hero__char is-ghost" data-spread="0">S</span>
                    <span class="hero__char" data-spread="1">T</span>
                    <span class="hero__char" data-spread="2">I</span>
                </div>

                <div class="hero__layer--cut" id="hero-cut">
                    <div class="hero__emblem">
                        <img src="<?= esc($logoUrl) ?>" alt="Emblem <?= esc($settings['nama_web']) ?>">
                    </div>
                </div>

                <div class="hero__word hero__word--front" aria-hidden="true">
                    <span class="hero__char is-line" id="hero-front-char">S</span>
                </div>
            </div>

            <!-- Editorial Hero Copy & Above-the-Fold CTAs -->
            <div class="hero__copy">
                <span class="hero__eyebrow">Studio Pusat &amp; Automasi &bull; Drop 2026</span>
                <h1 id="hero-title" class="hero__title" tabindex="-1">
                    <?= esc($settings['teks_hero_judul']) ?>
                </h1>
                <p class="hero__desc">
                    <?= esc($settings['teks_hero_deskripsi']) ?>
                </p>
                <div class="hero__actions">
                    <a href="#katalog" class="btn btn--cream js-scroll-to">
                        Jelajahi Katalog &rarr;
                    </a>
                    <a href="https://wa.me/<?= esc($settings['nomor_wa']) ?>" target="_blank" rel="noopener noreferrer" class="btn btn--glass">
                        <i class="fa-brands fa-whatsapp"></i> Kontak Konsultasi
                    </a>
                </div>
            </div>
        </div>

        <div class="hero__foot">
            <div class="hero__foot-left">
                Built to Automate.<br>Engineered for Precision.
            </div>
            <button type="button" class="hero__cue js-scroll-to" data-target="#katalog" aria-label="Gulir ke Katalog Sistem">
                <span>Scroll</span>
                <span class="hero__cue-line" aria-hidden="true"></span>
            </button>
            <div class="hero__foot-right">
                <?= esc($settings['nama_web']) ?><br>Drop 2026
            </div>
        </div>
    </section>

    <!-- Section 2: Velocity-Reactive Marquee -->
    <div class="marquee" id="marquee" aria-hidden="true">
        <div class="marquee__track" id="marquee-track">
            <div class="marquee__group">
                <span><?= esc($settings['nama_web']) ?></span>
                <span class="marquee__orb"></span>
                <span>Prima Automasi Sistem</span>
                <span class="marquee__orb"></span>
                <span>Teknologi Informasi</span>
                <span class="marquee__orb"></span>
                <span>Katalog Aplikasi Demo</span>
                <span class="marquee__orb"></span>
                <span>Enterprise Architecture</span>
                <span class="marquee__orb"></span>
                <span>Built for Speed</span>
                <span class="marquee__orb"></span>
            </div>
            <div class="marquee__group">
                <span><?= esc($settings['nama_web']) ?></span>
                <span class="marquee__orb"></span>
                <span>Prima Automasi Sistem</span>
                <span class="marquee__orb"></span>
                <span>Teknologi Informasi</span>
                <span class="marquee__orb"></span>
                <span>Katalog Aplikasi Demo</span>
                <span class="marquee__orb"></span>
                <span>Enterprise Architecture</span>
                <span class="marquee__orb"></span>
                <span>Built for Speed</span>
                <span class="marquee__orb"></span>
            </div>
        </div>
    </div>

    <!-- Section 3: Exposed-Grid Portfolio & Demo Catalog -->
    <main id="katalog" class="colls">
        <div class="gridlines" aria-hidden="true">
            <span></span><span></span><span></span><span></span><span></span><span></span>
        </div>

        <span class="orb" data-depth="16" style="width: 52px; height: 52px; top: 80px; right: 5%;" aria-hidden="true"></span>
        <span class="orb" data-depth="12" style="width: 34px; height: 34px; bottom: 90px; left: 3%;" aria-hidden="true"></span>

        <div class="container">
            <div class="section-head">
                <div>
                    <span class="eyebrow">01 / Ekosistem &amp; Katalog Aplikasi</span>
                    <h2 class="section-title" data-reveal>Katalog Sistem &amp; Demo</h2>
                </div>
                <p class="section-sub">
                    Eksplorasi modul perangkat lunak dan prototipe sistem yang telah dirancang siap uji coba dan siap diintegrasikan ke alur kerja instansi Anda.
                </p>
            </div>

            <?php if (!empty($apps)): ?>
                <?php
                $readyCount = 0;
                $maintCount = 0;
                foreach ($apps as $a) {
                    if ($a['status_demo'] === 'ready') {
                        $readyCount++;
                    } else {
                        $maintCount++;
                    }
                }
                ?>
                <div class="toolbar">
                    <div class="filter-group" role="group" aria-label="Filter status demo">
                        <button type="button" class="filter-pill is-active" data-filter="all">
                            Semua Sistem (<?= count($apps) ?>)
                        </button>
                        <button type="button" class="filter-pill" data-filter="ready">
                            Demo Ready (<?= $readyCount ?>)
                        </button>
                        <button type="button" class="filter-pill" data-filter="maintenance">
                            Maintenance (<?= $maintCount ?>)
                        </button>
                    </div>

                    <div class="search-box">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="search" id="catalog-search" placeholder="Cari sistem atau fitur..." aria-label="Cari aplikasi demo">
                    </div>
                </div>
            <?php endif; ?>

            <div class="catalog-grid" id="catalog-grid">
                <?php if (!empty($apps)): ?>
                    <?php foreach ($apps as $index => $app): ?>
                        <article
                            class="app-card"
                            data-status="<?= esc($app['status_demo']) ?>"
                            data-search="<?= esc(strtolower($app['judul'] . ' ' . strip_tags($app['deskripsi']))) ?>">
                            <div>
                                <div class="app-card__top">
                                    <span class="app-card__index">SYS // <?= sprintf('%02d', $index + 1) ?></span>
                                    <?php if ($app['status_demo'] === 'ready'): ?>
                                        <span class="status-badge status-badge--ready">
                                            <i class="fa-solid fa-circle"></i> Ready Demo
                                        </span>
                                    <?php else: ?>
                                        <span class="status-badge status-badge--maint">
                                            <i class="fa-solid fa-circle"></i> Maintenance
                                        </span>
                                    <?php endif; ?>
                                </div>

                                <div class="app-card__head">
                                    <div class="app-card__logo-stage">
                                        <img src="<?= base_url('uploads/portfolios/' . esc($app['logo'])) ?>" alt="Logo <?= esc($app['judul']) ?>">
                                    </div>
                                    <h3 class="app-card__title"><?= esc($app['judul']) ?></h3>
                                </div>

                                <div id="desc-<?= $app['id'] ?>" class="deskripsi-html line-clamp-3">
                                    <?= $app['deskripsi'] ?>
                                </div>

                                <button type="button" data-toggle-desc="<?= (int) $app['id'] ?>" id="btn-desc-<?= (int) $app['id'] ?>" class="btn-expand">
                                    Selengkapnya <i class="fa-solid fa-chevron-down" style="font-size: 10px;"></i>
                                </button>
                            </div>

                            <div class="app-card__actions">
                                <a href="<?= esc($app['link_github']) ?>" target="_blank" rel="noopener noreferrer" class="card-btn card-btn--github">
                                    <i class="fa-brands fa-github"></i> GitHub
                                </a>
                                <button
                                    type="button"
                                    data-launch-demo="1"
                                    data-app-judul="<?= esc($app['judul']) ?>"
                                    data-app-status="<?= esc($app['status_demo']) ?>"
                                    data-app-url="<?= esc($app['link_demo']) ?>"
                                    class="card-btn card-btn--demo">
                                    <i class="fa-solid fa-laptop-code"></i> Uji Demo &rarr;
                                </button>
                            </div>
                        </article>
                    <?php endforeach; ?>
                    <div class="empty-state" id="catalog-no-match" hidden>
                        <i class="fa-solid fa-filter-circle-xmark"></i>
                        Tidak ada sistem yang cocok dengan filter atau kata kunci pencarian Anda.
                    </div>
                <?php else: ?>
                    <div class="empty-state">
                        <i class="fa-solid fa-folder-open"></i>
                        Belum ada aplikasi demo yang dipublikasikan.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <!-- Section 4: Cobalt Lookbook-Style Architecture Stage -->
    <section id="arsitektur" class="lb">
        <span class="orb" data-depth="20" style="width: 58px; height: 58px; top: 12%; right: 6%;" aria-hidden="true"></span>
        <span class="orb" data-depth="14" style="width: 30px; height: 30px; bottom: 14%; left: 5%;" aria-hidden="true"></span>

        <div class="container">
            <div class="lb__top">
                <span>Standar Rekayasa Perangkat Lunak</span>
                <span>Teruji, Terukur &amp; Siap Deployment</span>
            </div>

            <div class="lb__head">
                <div>
                    <span class="eyebrow" style="color: var(--c-sky);">02 / Pilar Teknologi <?= esc($settings['nama_web']) ?></span>
                    <h2 class="lb__title" data-reveal>Arsitektur Presisi</h2>
                </div>
                <a href="https://wa.me/<?= esc($settings['nomor_wa']) ?>" target="_blank" rel="noopener noreferrer" class="btn btn--cream">
                    Konsultasi Arsitektur &rarr;
                </a>
            </div>

            <div class="lb__cards">
                <article class="lb__card">
                    <span class="lb__card-num">01 / WORKFLOW</span>
                    <h3>Automasi Proses Bisnis</h3>
                    <p>Mengubah alur administrasi manual menjadi sistem digital terstruktur yang memangkas waktu pemrosesan dan kesalahan input secara signifikan.</p>
                </article>
                <article class="lb__card">
                    <span class="lb__card-num">02 / RELIABILITY</span>
                    <h3>Keamanan &amp; Performa Tinggi</h3>
                    <p>Dibangun dengan standar keamanan modern, enkripsi kredensial, validasi ketat, dan arsitektur database yang responsif pada skala instansi.</p>
                </article>
                <article class="lb__card">
                    <span class="lb__card-num">03 / SCALABILITY</span>
                    <h3>Integrasi &amp; Skalabilitas</h3>
                    <p>Modular dan siap dikembangkan mengikuti pertumbuhan kebutuhan organisasi, lengkap dengan dokumentasi kode dan dukungan repositori terbuka.</p>
                </article>
            </div>

            <div class="lb__metrics">
                <div>
                    <div class="metric__val"><?= count($apps) ?>+</div>
                    <div class="metric__label">Sistem Terpublikasi</div>
                </div>
                <div>
                    <div class="metric__val">99.9%</div>
                    <div class="metric__label">Target Ketersediaan</div>
                </div>
                <div>
                    <div class="metric__val">MVC</div>
                    <div class="metric__label">Arsitektur Terstandar</div>
                </div>
                <div>
                    <div class="metric__val">24/7</div>
                    <div class="metric__label">Akses Konsultasi Teknis</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 5: Deep-Night Editorial Footer -->
    <footer id="footer" class="foot">
        <div class="container">
            <div class="foot__top">
                <div>
                    <span class="eyebrow" style="color: var(--c-sky);">03 / Mulai Kolaborasi</span>
                    <h2 class="foot__big" data-reveal>Siap Automasi Sistem Anda?</h2>
                </div>

                <form class="foot__form" id="wa-quick-form">
                    <label for="wa-quick-input">Kirim pesan konsultasi instan via WhatsApp &mdash; langsung terhubung.</label>
                    <div class="foot__input-row">
                        <input
                            type="text"
                            id="wa-quick-input"
                            placeholder="Tulis kebutuhan sistem atau jadwal demo Anda..."
                            required>
                        <button type="submit" class="foot__submit" aria-label="Kirim pesan ke WhatsApp">
                            <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </div>
                </form>
            </div>

            <div class="foot__rule">
                <div class="foot__links">
                    <a href="#hero">Beranda</a>
                    <a href="#katalog">Katalog</a>
                    <a href="#arsitektur">Arsitektur</a>
                </div>

                <a href="#hero" class="logo" aria-label="Kembali ke atas">
                    <img src="<?= esc($logoUrl) ?>" alt="Logo <?= esc($settings['nama_web']) ?>">
                    <span><?= esc($settings['nama_web']) ?></span>
                </a>

                <div class="foot__right">
                    <span><?= esc($settings['teks_footer']) ?></span>
                    <a href="<?= base_url('auth/login') ?>" class="foot__admin" title="Akses Ruang Kendali">
                        <i class="fa-solid fa-shield-halved"></i>
                        <span>Otoritas</span>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <div class="toast" id="toast" role="status" aria-live="polite"></div>

    <!-- GSAP + ScrollTrigger & Lenis Smooth Scroll -->
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.7/dist/gsap.min.js" integrity="sha384-pEQB1h4Zmn9xhS6jotzltHSIQq6N0Oh3BXkCNOH5LKI81R2NRbb9efarAJYw9gTY" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.7/dist/ScrollTrigger.min.js" integrity="sha384-TgZ1GoXcDnrw/czNfaiSZSFV1zgIRv8aQOevBA8ppS4SkNONmzYfjARpXsDfdnUE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/lenis@1.1.18/dist/lenis.min.js" integrity="sha384-tKsJDT6PlUI0pSBt9/sBKJluKgA19/a6mBrDsZaXotLB4ZYfMGM6xt6/WgGpYhTm" crossorigin="anonymous"></script>

    <script nonce="<?= esc(\App\Filters\SecurityHeaders::getNonce()) ?>">
        (function () {
            const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
            const nav = document.getElementById('site-nav');
            const marquee = document.getElementById('marquee');
            const progressBar = document.getElementById('nav-progress');
            const navLinksWrap = document.querySelector('.nav__links');
            const navLinks = Array.from(document.querySelectorAll('.nav__link'));
            const navDot = document.getElementById('nav-dot');
            const mobileToggle = document.getElementById('mobile-menu-toggle');
            const mobileMenu = document.getElementById('mobile-menu');
            let lenis = null;

            /* 1. Sliding 3D Chrome Dot in Navbar */
            function moveNavDot(target) {
                if (!target || !navDot || !navLinksWrap) return;
                const linkRect = target.getBoundingClientRect();
                const wrapRect = navLinksWrap.getBoundingClientRect();
                const centerX = linkRect.left - wrapRect.left + linkRect.width / 2 - 3;
                navDot.style.transform = `translateX(${centerX}px)`;
                navDot.classList.add('is-visible');
            }

            if (navLinks.length > 0) {
                const initialActive = navLinks.find((el) => el.classList.contains('is-active')) || navLinks[0];
                requestAnimationFrame(() => moveNavDot(initialActive));

                navLinks.forEach((link) => {
                    link.addEventListener('mouseenter', () => moveNavDot(link));
                    link.addEventListener('focus', () => moveNavDot(link));
                });

                navLinksWrap.addEventListener('mouseleave', () => {
                    const current = navLinks.find((el) => el.classList.contains('is-active')) || navLinks[0];
                    moveNavDot(current);
                });

                window.addEventListener('resize', () => {
                    const current = navLinks.find((el) => el.classList.contains('is-active')) || navLinks[0];
                    moveNavDot(current);
                });
            }

            /* Mobile Drawer Toggle */
            if (mobileToggle && mobileMenu) {
                mobileToggle.addEventListener('click', () => {
                    const isOpen = mobileMenu.classList.toggle('is-open');
                    mobileToggle.setAttribute('aria-expanded', String(isOpen));
                });

                mobileMenu.querySelectorAll('a').forEach((item) => {
                    item.addEventListener('click', () => {
                        mobileMenu.classList.remove('is-open');
                        mobileToggle.setAttribute('aria-expanded', 'false');
                    });
                });
            }

            /* 2. Chameleon Navbar State + Scroll Progress + Active Section */
            function updateNavbarOnScroll() {
                const scrollTop = window.scrollY || document.documentElement.scrollTop;
                const docHeight = document.documentElement.scrollHeight - window.innerHeight;
                const progress = docHeight > 0 ? Math.min(Math.max(scrollTop / docHeight, 0), 1) : 0;

                if (progressBar) {
                    progressBar.style.transform = `scaleX(${progress})`;
                }

                if (marquee) {
                    const marqueeTop = marquee.getBoundingClientRect().top;
                    if (marqueeTop <= 70) {
                        nav.classList.remove('nav--clear');
                        nav.classList.add('is-raised');
                    } else {
                        nav.classList.add('nav--clear');
                        nav.classList.remove('is-raised');
                    }
                }

                const sections = ['hero', 'katalog', 'arsitektur', 'footer'];
                let activeId = 'hero';
                const probeY = window.innerHeight * 0.35;
                sections.forEach((id) => {
                    const el = document.getElementById(id);
                    if (el && el.getBoundingClientRect().top <= probeY) {
                        activeId = id;
                    }
                });

                navLinks.forEach((link) => {
                    const match = link.dataset.section === activeId;
                    link.classList.toggle('is-active', match);
                    if (match && !navLinksWrap.matches(':hover')) {
                        moveNavDot(link);
                    }
                });
            }

            window.addEventListener('scroll', updateNavbarOnScroll, { passive: true });
            updateNavbarOnScroll();

            /* 3. Smooth Scroll (Lenis + Anchor Links) */
            if (!prefersReducedMotion && typeof Lenis !== 'undefined') {
                lenis = new Lenis({
                    duration: 1.15,
                    easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
                    smoothWheel: true,
                    touchMultiplier: 1.5
                });
                window.siteLenis = lenis;

                if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
                    gsap.registerPlugin(ScrollTrigger);
                    lenis.on('scroll', ScrollTrigger.update);
                    gsap.ticker.add((time) => {
                        lenis.raf(time * 1000);
                    });
                    gsap.ticker.lagSmoothing(0);
                } else {
                    function raf(time) {
                        lenis.raf(time);
                        requestAnimationFrame(raf);
                    }
                    requestAnimationFrame(raf);
                }
            }

            document.querySelectorAll('a[href^="#"], .js-scroll-to').forEach((trigger) => {
                trigger.addEventListener('click', (e) => {
                    const targetSel = trigger.getAttribute('href') || trigger.dataset.target;
                    if (!targetSel || !targetSel.startsWith('#')) return;
                    const targetEl = document.querySelector(targetSel);
                    if (!targetEl) return;
                    e.preventDefault();
                    if (lenis) {
                        lenis.scrollTo(targetEl, { offset: targetSel === '#hero' ? 0 : -72 });
                    } else {
                        targetEl.scrollIntoView({ behavior: prefersReducedMotion ? 'auto' : 'smooth' });
                    }
                });
            });

            /* 4. GSAP Motions: Hero Depth Parallax, Scroll Spread & Velocity Marquee */
            if (!prefersReducedMotion && typeof gsap !== 'undefined') {
                if (typeof ScrollTrigger !== 'undefined') {
                    gsap.registerPlugin(ScrollTrigger);

                    // Hero 3-Layer Depth Explosion on Scroll
                    const heroChars = document.querySelectorAll('.hero__word--back .hero__char');
                    const heroFrontChar = document.getElementById('hero-front-char');
                    const heroCut = document.getElementById('hero-cut');

                    const heroTl = gsap.timeline({
                        scrollTrigger: {
                            trigger: '#hero',
                            start: 'top top',
                            end: '+=65%',
                            pin: true,
                            scrub: 0.75
                        }
                    });

                    heroChars.forEach((ch) => {
                        const spread = parseFloat(ch.dataset.spread || '0');
                        if (spread !== 0) {
                            heroTl.to(ch, {
                                x: `${spread * 11}vw`,
                                opacity: 0.25,
                                ease: 'none'
                            }, 0);
                        }
                    });

                    if (heroFrontChar) {
                        heroTl.to(heroFrontChar, {
                            scale: 2.1,
                            opacity: 0,
                            ease: 'none'
                        }, 0);
                    }

                    if (heroCut) {
                        heroTl.to(heroCut, {
                            scale: 1.08,
                            y: -18,
                            ease: 'none'
                        }, 0);
                    }

                    // Velocity-Reactive Marquee
                    const track = document.getElementById('marquee-track');
                    if (track) {
                        const marqueeTween = gsap.to(track, {
                            xPercent: -50,
                            repeat: -1,
                            duration: 28,
                            ease: 'none'
                        });

                        let velocityBoost = { val: 1 };
                        ScrollTrigger.create({
                            trigger: document.body,
                            start: 'top top',
                            end: 'bottom bottom',
                            onUpdate: (self) => {
                                const velocity = self.getVelocity();
                                const dir = velocity < 0 ? -1 : 1;
                                const speed = Math.min(Math.abs(velocity) / 300, 5);
                                velocityBoost.val = dir * (1 + speed);
                                marqueeTween.timeScale(velocityBoost.val);
                                gsap.to(velocityBoost, {
                                    val: dir,
                                    duration: 0.6,
                                    overwrite: true,
                                    onUpdate: () => marqueeTween.timeScale(velocityBoost.val)
                                });
                            }
                        });
                    }

                    // Word-by-Word Reveal for Titles (GSAP + ScrollTrigger)
                    function splitWordsForReveal(el) {
                        if (!el) return [];
                        if (el.dataset.wordsSplit === 'true') {
                            return Array.from(el.querySelectorAll('.reveal-word'));
                        }

                        const plainText = (el.textContent || '').replace(/\s+/g, ' ').trim();
                        if (plainText && !el.getAttribute('aria-label')) {
                            el.setAttribute('aria-label', plainText);
                        }

                        const skipTags = new Set(['SCRIPT', 'STYLE', 'SVG', 'I', 'BUTTON']);
                        function wrapTextNodes(node) {
                            const children = Array.from(node.childNodes);
                            children.forEach((child) => {
                                if (child.nodeType === Node.TEXT_NODE) {
                                    const raw = child.nodeValue || '';
                                    if (!raw.trim()) return;
                                    const frag = document.createDocumentFragment();
                                    raw.split(/(\s+)/).forEach((part) => {
                                        if (!part) return;
                                        if (/^\s+$/.test(part)) {
                                            frag.appendChild(document.createTextNode(part));
                                        } else {
                                            const mask = document.createElement('span');
                                            mask.className = 'reveal-word-mask';
                                            mask.setAttribute('aria-hidden', 'true');
                                            const word = document.createElement('span');
                                            word.className = 'reveal-word';
                                            word.textContent = part;
                                            mask.appendChild(word);
                                            frag.appendChild(mask);
                                        }
                                    });
                                    child.replaceWith(frag);
                                } else if (child.nodeType === Node.ELEMENT_NODE && !skipTags.has(child.tagName)) {
                                    wrapTextNodes(child);
                                }
                            });
                        }

                        wrapTextNodes(el);
                        el.dataset.wordsSplit = 'true';
                        return Array.from(el.querySelectorAll('.reveal-word'));
                    }

                    const heroTitle = document.getElementById('hero-title');
                    if (heroTitle) {
                        const heroTitleWords = splitWordsForReveal(heroTitle);
                        if (heroTitleWords.length > 0) {
                            gsap.from(heroTitleWords, {
                                yPercent: 115,
                                opacity: 0,
                                rotateZ: 1.5,
                                duration: 0.85,
                                stagger: 0.06,
                                delay: 0.12,
                                ease: 'power3.out',
                                clearProps: 'transform,opacity'
                            });
                        }
                    }

                    document.querySelectorAll('[data-reveal], .lb__card h3').forEach((el) => {
                        const words = splitWordsForReveal(el);
                        if (words.length === 0) return;
                        gsap.from(words, {
                            yPercent: 115,
                            opacity: 0,
                            rotateZ: 1.5,
                            duration: 0.85,
                            stagger: 0.075,
                            ease: 'power3.out',
                            clearProps: 'transform,opacity',
                            scrollTrigger: {
                                trigger: el,
                                start: 'top 86%',
                                once: true
                            }
                        });
                    });

                    if (document.fonts && document.fonts.ready) {
                        document.fonts.ready.then(() => ScrollTrigger.refresh());
                    }

                    const cards = document.querySelectorAll('.app-card');
                    if (cards.length > 0) {
                        gsap.from(cards, {
                            y: 28,
                            opacity: 0,
                            duration: 0.75,
                            stagger: 0.08,
                            ease: 'power3.out',
                            clearProps: 'transform,opacity',
                            scrollTrigger: {
                                trigger: '#catalog-grid',
                                start: 'top 92%',
                                once: true
                            }
                        });
                    }
                }

                // Desktop Pointer 3D Parallax for Hero & Chrome Orbs
                if (window.matchMedia('(pointer: fine)').matches) {
                    const heroEl = document.getElementById('hero');
                    const heroCut = document.getElementById('hero-cut');
                    const heroWords = document.querySelectorAll('.hero__word');
                    const orbs = document.querySelectorAll('.orb');

                    window.addEventListener('mousemove', (e) => {
                        const nx = (e.clientX / window.innerWidth - 0.5) * 2;
                        const ny = (e.clientY / window.innerHeight - 0.5) * 2;

                        if (heroEl && heroEl.getBoundingClientRect().bottom > 0) {
                            if (heroCut) {
                                gsap.to(heroCut, { x: nx * 16, y: ny * 10, duration: 0.8, ease: 'power2.out', overwrite: 'auto' });
                            }
                            gsap.to(heroWords, { x: -nx * 24, y: -ny * 12, duration: 0.9, ease: 'power2.out', overwrite: 'auto' });
                        }

                        orbs.forEach((orb) => {
                            const depth = parseFloat(orb.dataset.depth || '14');
                            gsap.to(orb, {
                                x: nx * depth,
                                y: ny * depth * 0.7,
                                duration: 1.1,
                                ease: 'power2.out',
                                overwrite: 'auto'
                            });
                        });
                    }, { passive: true });
                }
            } else {
                // CSS Fallback Marquee Animation if GSAP fails to load (unless reduced motion)
                const track = document.getElementById('marquee-track');
                if (track && !prefersReducedMotion) {
                    track.animate(
                        [{ transform: 'translateX(0)' }, { transform: 'translateX(-50%)' }],
                        { duration: 28000, iterations: Infinity, easing: 'linear' }
                    );
                }
            }

            /* 5. Catalog Filter Pills & Real-Time Search */
            const filterPills = Array.from(document.querySelectorAll('.filter-pill'));
            const searchInput = document.getElementById('catalog-search');
            const appCards = Array.from(document.querySelectorAll('.app-card'));
            const noMatchEl = document.getElementById('catalog-no-match');
            let currentFilter = 'all';

            function applyCatalogFilters() {
                if (appCards.length === 0) return;
                const query = searchInput ? searchInput.value.trim().toLowerCase() : '';
                let visibleCount = 0;

                appCards.forEach((card) => {
                    const statusMatch = currentFilter === 'all' || card.dataset.status === currentFilter;
                    const textMatch = !query || (card.dataset.search || '').includes(query);
                    const isVisible = statusMatch && textMatch;
                    card.style.display = isVisible ? '' : 'none';
                    if (isVisible) {
                        if (typeof gsap !== 'undefined') {
                            gsap.set(card, { opacity: 1, clearProps: 'transform' });
                        }
                        visibleCount++;
                    }
                });

                if (noMatchEl) {
                    noMatchEl.hidden = visibleCount > 0;
                }
            }

            filterPills.forEach((pill) => {
                pill.addEventListener('click', () => {
                    filterPills.forEach((p) => p.classList.remove('is-active'));
                    pill.classList.add('is-active');
                    currentFilter = pill.dataset.filter || 'all';
                    applyCatalogFilters();
                });
            });

            if (searchInput) {
                searchInput.addEventListener('input', applyCatalogFilters);
            }

            /* 6. Footer WhatsApp Quick-Message Form */
            const waForm = document.getElementById('wa-quick-form');
            const waInput = document.getElementById('wa-quick-input');
            if (waForm && waInput) {
                waForm.addEventListener('submit', (e) => {
                    e.preventDefault();
                    const msg = waInput.value.trim();
                    if (!msg) return;
                    const waTarget = 'https://wa.me/<?= esc($settings['nomor_wa'], 'js') ?>?text=' + encodeURIComponent(msg);
                    window.open(waTarget, '_blank', 'noopener,noreferrer');
                });
            }
        })();

        /* Toast Notification Helper */
        let toastTimer = null;
        function showToast(message) {
            const toast = document.getElementById('toast');
            if (!toast) return;
            toast.textContent = message;
            toast.classList.add('is-shown');
            clearTimeout(toastTimer);
            toastTimer = setTimeout(() => toast.classList.remove('is-shown'), 2800);
        }

        /* Liquid Chrome Bead Fly Animation */
        function flyChromeBead(triggerEl) {
            if (!triggerEl || window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
            const rect = triggerEl.getBoundingClientRect();
            const targetEl = document.querySelector('.nav__cta') || document.querySelector('.nav__bar');
            if (!targetEl) return;
            const targetRect = targetEl.getBoundingClientRect();

            const bead = document.createElement('span');
            bead.className = 'bead';
            bead.setAttribute('aria-hidden', 'true');
            const startX = rect.left + rect.width / 2;
            const startY = rect.top + rect.height / 2;
            const endX = targetRect.left + targetRect.width / 2;
            const endY = targetRect.top + targetRect.height / 2;

            bead.style.left = startX + 'px';
            bead.style.top = startY + 'px';
            document.body.appendChild(bead);

            if (typeof gsap !== 'undefined') {
                gsap.to(bead, {
                    x: endX - startX,
                    y: endY - startY,
                    scale: 0.45,
                    opacity: 0,
                    duration: 0.72,
                    ease: 'back.in(1.4)',
                    onComplete: () => bead.remove()
                });
            } else {
                const anim = bead.animate(
                    [
                        { transform: 'translate(-50%, -50%) scale(1)', opacity: 1 },
                        { transform: `translate(${endX - startX}px, ${endY - startY}px) scale(0.45)`, opacity: 0 }
                    ],
                    { duration: 680, easing: 'cubic-bezier(.16, 1, .3, 1)' }
                );
                anim.onfinish = () => bead.remove();
            }
        }

        /* Preserved Business Logic: Launch Demo Modal */
        function launchDemo(appName, status, urlDemo, triggerEl) {
            flyChromeBead(triggerEl);

            if (status === 'ready') {
                showToast('Mempersiapkan akses demo ' + appName + '...');
                Swal.fire({
                    title: 'Akses Demo Terbuka',
                    text: 'Membuka sistem aplikasi demo ' + appName + '. Pastikan pop-up browser Anda aktif.',
                    icon: 'success',
                    confirmButtonText: 'Lanjutkan'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.open(urlDemo, '_blank', 'noopener,noreferrer');
                    }
                });
            } else {
                showToast(appName + ' sedang dalam pemeliharaan server.');
                Swal.fire({
                    title: 'Sistem Pemeliharaan',
                    text: 'Aplikasi demo untuk ' + appName + ' saat ini sedang dalam proses deployment server. Hubungi kami untuk info lebih lanjut.',
                    icon: 'info',
                    confirmButtonText: 'Dimengerti'
                });
            }
        }

        /* Preserved Business Logic: Toggle Expand/Collapse Deskripsi */
        function toggleDeskripsi(id) {
            const descElement = document.getElementById('desc-' + id);
            const btnElement = document.getElementById('btn-desc-' + id);

            if (!descElement || !btnElement) return;

            if (descElement.classList.contains('line-clamp-3')) {
                descElement.classList.remove('line-clamp-3');
                btnElement.innerHTML = 'Tutup Deskripsi <i class="fa-solid fa-chevron-up" style="font-size: 10px;"></i>';
            } else {
                descElement.classList.add('line-clamp-3');
                btnElement.innerHTML = 'Selengkapnya <i class="fa-solid fa-chevron-down" style="font-size: 10px;"></i>';
            }
        }

        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('<?= base_url('sw.js') ?>', { scope: '/' }).catch((err) => {
                    console.warn('Service Worker registration failed:', err);
                });
            });
        }

        document.querySelectorAll('[data-toggle-desc]').forEach((btn) => {
            btn.addEventListener('click', () => {
                toggleDeskripsi(btn.dataset.toggleDesc);
            });
        });

        document.querySelectorAll('[data-launch-demo]').forEach((btn) => {
            btn.addEventListener('click', () => {
                launchDemo(
                    btn.dataset.appJudul || '',
                    btn.dataset.appStatus || '',
                    btn.dataset.appUrl || '#',
                    btn
                );
            });
        });

        (function () {
            const prefersReducedMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
            const adminLink = document.querySelector('a.foot__admin');
            if (adminLink && !prefersReducedMotion) {
                adminLink.addEventListener('click', (e) => {
                    if (e.metaKey || e.ctrlKey || e.shiftKey || e.altKey || e.button !== 0) return;
                    e.preventDefault();
                    document.body.classList.add('is-page-leaving');
                    setTimeout(() => {
                        window.location.href = adminLink.href;
                    }, 180);
                });
            }
            window.addEventListener('pageshow', () => {
                document.body.classList.remove('is-page-leaving');
            });
        })();
    </script>
</body>

</html>
