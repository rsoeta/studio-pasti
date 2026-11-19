<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Panel Admin - Studio PASTI') ?></title>

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

            /* Nautical Maritime Ground */
            --bg: #24425f;
            --side: #24425f;
            --ground-hi: #2c4e6e;
            --g-ink: #f2f6fa;
            --g-muted: #c3d2e1;
            --g-line: rgba(242, 246, 250, 0.28);
            --g-fill: rgba(242, 246, 250, 0.1);
            --topbar-bg: rgba(36, 66, 95, 0.88);

            /* Bento Cards & Panels */
            --card: #eef3f7;
            --card-2: #e3eaf1;
            --card-3: #d3dde7;
            --panel: #f4f7fa;
            --paper: #ffffff;
            --top-light: rgba(255, 255, 255, 0.85);
            --shadow: 0 1px 2px rgba(5, 20, 35, 0.08), 0 18px 36px -22px rgba(5, 20, 35, 0.5);

            /* Card Typography & Borders */
            --ink: #0f1a24;
            --ink-2: #2a3a4a;
            --muted: #536375;
            --line: rgba(15, 30, 45, 0.09);
            --line-2: rgba(15, 30, 45, 0.16);

            /* Safety Orange Brand Accent */
            --accent: #f37a1f;
            --accent-hi: #ff8a33;
            --accent-ink: #2a1206;
            --accent-text: #a84a08;

            /* Warm Peach Attention Highlights */
            --peach: #ffe3cf;
            --peach-2: #ffd3b6;
            --peach-ink: #0f1a24;
            --peach-muted: #5a4b40;
            --hl-peach: oklch(88% 0.075 55);

            /* Semantic States */
            --good: #2a7a2e;
            --good-bg: rgba(42, 122, 46, 0.12);
            --warn: #8f5304;
            --warn-bg: rgba(143, 83, 4, 0.12);
            --bad: #b8181d;
            --bad-bg: rgba(184, 24, 29, 0.11);
            --info: #1b5fa8;
            --info-bg: rgba(27, 95, 168, 0.12);
            --live: #2fae55;

            /* Radar Disc */
            --disc: #0f1a24;
            --disc-ring: rgba(255, 255, 255, 0.14);

            /* Scale & Geometry */
            --max: 1560px;
            --pad: clamp(16px, 2.2vw, 26px);
            --gap: 14px;
            --r-sm: 8px;
            --r-md: 10px;
            --r-lg: 14px;
            --r-xl: 20px;
            --ease: cubic-bezier(.22, 1, .36, 1);
        }

        [data-theme="dark"] {
            --bg: #0d1721;
            --side: #0d1721;
            --ground-hi: #13202d;
            --g-ink: #eef3f8;
            --g-muted: #9fb0c1;
            --g-line: rgba(238, 243, 248, 0.16);
            --g-fill: rgba(238, 243, 248, 0.06);
            --topbar-bg: rgba(13, 23, 33, 0.9);

            --card: #172331;
            --card-2: #1d2b3a;
            --card-3: #273748;
            --panel: #1a2735;
            --paper: #131e2a;
            --top-light: rgba(255, 255, 255, 0.08);
            --shadow: 0 2px 4px rgba(0, 0, 0, 0.35), 0 22px 44px -20px rgba(0, 0, 0, 0.72);

            --ink: #eef3f8;
            --ink-2: #cfd9e3;
            --muted: #95a5b6;
            --line: rgba(255, 255, 255, 0.08);
            --line-2: rgba(255, 255, 255, 0.14);

            --accent: #f7862e;
            --accent-hi: #ff9845;
            --accent-ink: #241003;
            --accent-text: #ffaa6b;

            --peach: #3a2214;
            --peach-2: #4a2a16;
            --peach-ink: #f4f1ee;
            --peach-muted: #d2b6a4;
            --hl-peach: oklch(50% 0.1 55);

            --good: #9be27f;
            --good-bg: rgba(155, 226, 127, 0.14);
            --warn: #ffbd73;
            --warn-bg: rgba(255, 189, 115, 0.14);
            --bad: #ff8a85;
            --bad-bg: rgba(255, 138, 133, 0.14);
            --info: #8cc4fa;
            --info-bg: rgba(140, 196, 250, 0.14);
            --live: #47d16c;

            --disc: #0b131b;
            --disc-ring: rgba(255, 255, 255, 0.1);
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
            color: var(--g-ink);
            font-size: 14px;
            line-height: 1.5;
            -webkit-font-smoothing: antialiased;
            transition: background-color 0.25s var(--ease), color 0.25s var(--ease);
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button,
        input,
        select,
        textarea {
            font-family: 'Ubuntu', sans-serif !important;
        }

        .tabular-nums {
            font-variant-numeric: tabular-nums;
        }

        .skip {
            position: fixed;
            top: -80px;
            left: 16px;
            z-index: 9999;
            background: var(--accent);
            color: var(--accent-ink);
            font-weight: 700;
            font-size: 12.5px;
            padding: 10px 16px;
            border-radius: var(--r-md);
            transition: top 0.2s ease;
        }

        .skip:focus {
            top: 14px;
        }

        :focus-visible {
            outline: 2px solid var(--accent);
            outline-offset: 2px;
        }

        /* Shell */
        .orvex-shell {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: clip;
        }

        /* Sticky Frosted Topbar */
        .top {
            position: sticky;
            top: 0;
            z-index: 40;
            background-color: var(--topbar-bg);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--g-line);
        }

        .top__inner {
            max-width: var(--max);
            margin: 0 auto;
            padding: 10px var(--pad);
            display: grid;
            grid-template-columns: auto 1fr auto;
            align-items: center;
            gap: 16px;
        }

        /* Brand Mark */
        .brand {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            min-height: 44px;
            padding-right: 4px;
        }

        .brand__badge {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: #0f1a24;
            border: 1px solid rgba(255, 255, 255, 0.16);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 5px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.28);
            overflow: hidden;
        }

        .brand__badge img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 6px;
        }

        .brand__text {
            display: flex;
            flex-direction: column;
            line-height: 1.05;
        }

        .brand__name {
            font-size: 15px;
            font-weight: 700;
            letter-spacing: 0.08em;
            color: var(--g-ink);
        }

        .brand__sub {
            font-size: 10.5px;
            font-weight: 500;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: var(--g-muted);
        }

        /* Center Pill Nav */
        .tnav-wrap {
            display: flex;
            justify-content: center;
            position: relative;
        }

        .tnav {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px;
            border-radius: var(--r-lg);
            background-color: var(--g-fill);
            border: 1px solid var(--g-line);
        }

        .tnav__item {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            min-height: 40px;
            padding: 0 14px;
            border-radius: var(--r-md);
            font-size: 12.5px;
            font-weight: 500;
            color: var(--g-muted);
            white-space: nowrap;
            transition: background-color 0.2s var(--ease), color 0.2s var(--ease), transform 0.2s var(--ease);
        }

        .tnav__item:hover {
            color: var(--g-ink);
            background-color: var(--g-fill);
        }

        .tnav__item.is-active {
            background-color: var(--accent);
            color: var(--accent-ink);
            font-weight: 700;
            box-shadow: 0 4px 14px rgba(243, 122, 31, 0.35);
        }

        .tnav__dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background-color: var(--accent);
        }

        .tnav__item.is-active .tnav__dot {
            background-color: var(--accent-ink);
        }

        .tnav__new {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: var(--r-md);
            border: 1px solid var(--g-line);
            background-color: var(--ground-hi);
            color: var(--g-ink);
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.2s ease, border-color 0.2s ease;
        }

        .tnav__new:hover {
            background-color: var(--accent);
            color: var(--accent-ink);
            border-color: var(--accent);
        }

        /* Quick-Create Popover */
        .quick-pop {
            position: absolute;
            top: calc(100% + 10px);
            right: 0;
            width: 240px;
            padding: 8px;
            border-radius: var(--r-lg);
            background-color: var(--panel);
            color: var(--ink);
            box-shadow: inset 0 1px 0 var(--top-light), inset 0 0 0 1px var(--line-2), var(--shadow);
            display: none;
            z-index: 60;
        }

        .quick-pop.is-open {
            display: grid;
            gap: 4px;
        }

        .quick-pop__label {
            padding: 6px 10px 4px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--muted);
        }

        .quick-pop a,
        .quick-pop button {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            min-height: 40px;
            padding: 0 10px;
            border: 0;
            border-radius: var(--r-sm);
            background: transparent;
            color: var(--ink);
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            text-align: left;
        }

        .quick-pop a:hover,
        .quick-pop button:hover {
            background-color: var(--card-2);
        }

        /* Topbar Right Utility Cluster */
        .top__utils {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .util-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-width: 42px;
            height: 42px;
            padding: 0 12px;
            border-radius: var(--r-md);
            border: 1px solid var(--g-line);
            background-color: var(--g-fill);
            color: var(--g-ink);
            font-size: 12.5px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s ease, border-color 0.2s ease;
        }

        .util-btn:hover {
            background-color: var(--ground-hi);
            border-color: var(--g-ink);
        }

        .kbd {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 2px 6px;
            border-radius: 5px;
            font-size: 10.5px;
            font-weight: 700;
            background: rgba(255, 255, 255, 0.14);
            color: var(--g-ink);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .avatar-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            min-height: 42px;
            padding: 0 12px 0 6px;
            border-radius: var(--r-md);
            background-color: var(--g-fill);
            border: 1px solid var(--g-line);
            color: var(--g-ink);
            font-size: 12.5px;
            font-weight: 500;
        }

        .avatar-circle {
            position: relative;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: var(--peach);
            color: var(--peach-ink);
            font-size: 11px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .avatar-circle::after {
            content: '';
            position: absolute;
            right: -1px;
            bottom: -1px;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--live);
            border: 2px solid var(--bg);
        }

        .util-btn--logout {
            background-color: rgba(184, 24, 29, 0.22);
            border-color: rgba(255, 138, 133, 0.38);
            color: #ffd7d5;
            font-weight: 700;
        }

        .util-btn--logout:hover {
            background-color: #b8181d;
            border-color: #ff8a85;
            color: #ffffff;
        }

        .mobile-toggle {
            display: none;
        }

        /* Main Framed Canvas */
        .orvex-main {
            flex: 1;
            width: 100%;
            max-width: var(--max);
            margin: 0 auto;
            padding: 20px var(--pad) 40px;
        }

        /* Mobile Drawer Sidebar (Preserving toggleSidebar()) */
        .sidebar-overlay {
            position: fixed;
            inset: 0;
            background: rgba(5, 12, 20, 0.6);
            backdrop-filter: blur(4px);
            z-index: 80;
            transition: opacity 0.28s ease;
        }

        .sidebar-overlay.hidden {
            display: none;
        }

        .sidebar-overlay.opacity-0 {
            opacity: 0;
        }

        .sidebar-overlay.opacity-100 {
            opacity: 1;
        }

        .mobile-sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            width: min(300px, 85vw);
            background-color: var(--bg);
            color: var(--g-ink);
            border-right: 1px solid var(--g-line);
            z-index: 90;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 18px;
            transition: transform 0.3s var(--ease);
            box-shadow: 20px 0 50px rgba(0, 0, 0, 0.45);
        }

        .mobile-sidebar.-translate-x-full {
            transform: translateX(-100%);
        }

        .mobile-sidebar__nav {
            display: grid;
            gap: 6px;
            margin-top: 20px;
        }

        .mobile-sidebar__link {
            display: flex;
            align-items: center;
            gap: 12px;
            min-height: 44px;
            padding: 0 14px;
            border-radius: var(--r-md);
            font-size: 13.5px;
            font-weight: 500;
            color: var(--g-muted);
        }

        .mobile-sidebar__link.is-active {
            background-color: var(--accent);
            color: var(--accent-ink);
            font-weight: 700;
        }

        /* Shared Orvex Page Heading & Bento Cards */
        .phead {
            display: flex;
            flex-wrap: wrap;
            align-items: flex-end;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 20px;
        }

        .phead__title {
            position: relative;
            display: inline-block;
            margin: 0;
            font-size: clamp(24px, 2.8vw, 34px);
            font-weight: 700;
            letter-spacing: -0.025em;
            line-height: 1.1;
            color: var(--g-ink);
            z-index: 1;
        }

        .phead__mark {
            position: relative;
            display: inline-block;
        }

        .phead__mark::after {
            content: '';
            position: absolute;
            left: 0;
            right: 0;
            bottom: 2px;
            height: 9px;
            background: var(--hl-peach);
            opacity: 0.48;
            border-radius: 4px;
            z-index: -1;
        }

        .phead__sub {
            margin: 6px 0 0;
            font-size: 13.5px;
            color: var(--g-muted);
        }

        .orvex-card {
            background-color: var(--card);
            color: var(--ink);
            border-radius: var(--r-xl);
            padding: 20px;
            box-shadow: inset 0 1px 0 var(--top-light), inset 0 0 0 1px var(--line), var(--shadow);
        }

        .orvex-card--sm {
            border-radius: var(--r-lg);
            padding: 16px;
        }

        .orvex-card--peach {
            background-color: var(--peach);
            color: var(--peach-ink);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.55), inset 0 0 0 1px rgba(168, 74, 8, 0.16), var(--shadow);
        }

        .ctitle {
            margin: 0;
            font-size: 13.5px;
            font-weight: 700;
            letter-spacing: -0.01em;
            color: var(--ink);
        }

        .muted {
            color: var(--muted);
        }

        .orvex-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 42px;
            padding: 0 16px;
            border-radius: var(--r-md);
            border: 1px solid var(--line-2);
            background-color: var(--card-2);
            color: var(--ink);
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            transition: background-color 0.2s ease, transform 0.2s var(--ease), border-color 0.2s ease;
        }

        .orvex-btn:hover {
            background-color: var(--card-3);
            transform: translateY(-1px);
        }

        .orvex-btn--accent {
            background-color: var(--accent);
            border-color: var(--accent);
            color: var(--accent-ink);
            box-shadow: 0 6px 18px rgba(243, 122, 31, 0.28);
        }

        .orvex-btn--accent:hover {
            background-color: var(--accent-hi);
            border-color: var(--accent-hi);
        }

        .orvex-btn--danger {
            background-color: var(--bad-bg);
            border-color: rgba(184, 24, 29, 0.25);
            color: var(--bad);
        }

        .orvex-btn--danger:hover {
            background-color: #b8181d;
            border-color: #b8181d;
            color: #ffffff;
        }

        .orvex-btn--icon {
            width: 42px;
            min-width: 42px;
            padding: 0;
        }

        .orvex-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            min-height: 36px;
            padding: 0 13px;
            border-radius: 999px;
            border: 1px solid var(--line-2);
            background-color: var(--card);
            color: var(--ink-2);
            font-size: 12.5px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .orvex-pill:hover {
            background-color: var(--card-2);
        }

        .orvex-pill.is-active {
            background-color: var(--accent);
            border-color: var(--accent);
            color: var(--accent-ink);
            font-weight: 700;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 11.5px;
            font-weight: 700;
            line-height: 1.2;
        }

        .badge--good {
            background-color: var(--good-bg);
            color: var(--good);
        }

        .badge--warn {
            background-color: var(--warn-bg);
            color: var(--warn);
        }

        .badge--bad {
            background-color: var(--bad-bg);
            color: var(--bad);
        }

        .badge--info {
            background-color: var(--info-bg);
            color: var(--info);
        }

        /* Orvex Form Controls */
        .field-label {
            display: block;
            margin-bottom: 6px;
            font-size: 11.5px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--muted);
        }

        .orvex-input,
        .orvex-select,
        .orvex-textarea {
            width: 100%;
            min-height: 44px;
            padding: 10px 14px;
            border-radius: var(--r-md);
            border: 1px solid var(--line-2);
            background-color: var(--panel);
            color: var(--ink);
            font-size: 13.5px;
            outline: none;
            transition: border-color 0.2s ease, box-shadow 0.2s ease, background-color 0.2s ease;
        }

        .orvex-input:focus,
        .orvex-select:focus,
        .orvex-textarea:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(243, 122, 31, 0.18);
            background-color: var(--paper);
        }

        .orvex-textarea {
            min-height: 108px;
            resize: vertical;
        }

        /* Command Palette & Shortcuts Modal */
        .orvex-modal-backdrop {
            position: fixed;
            inset: 0;
            z-index: 120;
            background: rgba(5, 14, 24, 0.62);
            backdrop-filter: blur(8px);
            display: none;
            align-items: flex-start;
            justify-content: center;
            padding: min(12vh, 96px) 16px 24px;
        }

        .orvex-modal-backdrop.is-open {
            display: flex;
        }

        .finder {
            width: min(600px, 100%);
            border-radius: var(--r-xl);
            background-color: var(--panel);
            color: var(--ink);
            box-shadow: inset 0 1px 0 var(--top-light), inset 0 0 0 1px var(--line-2), 0 30px 70px rgba(0, 0, 0, 0.45);
            overflow: hidden;
        }

        .finder__head {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 18px;
            border-bottom: 1px solid var(--line);
        }

        .finder__head input {
            flex: 1;
            min-height: 36px;
            border: 0;
            background: transparent;
            color: var(--ink);
            font-size: 15px;
            outline: none;
        }

        .finder__list {
            max-height: 340px;
            overflow-y: auto;
            padding: 10px;
            display: grid;
            gap: 4px;
        }

        .finder__item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            min-height: 44px;
            padding: 0 12px;
            border-radius: var(--r-md);
            color: var(--ink);
            font-size: 13.5px;
            font-weight: 500;
            cursor: pointer;
        }

        .finder__item:hover,
        .finder__item.is-selected {
            background-color: var(--peach);
            color: var(--peach-ink);
        }

        .finder__foot {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 10px 18px;
            background-color: var(--card-2);
            border-top: 1px solid var(--line);
            font-size: 11.5px;
            color: var(--muted);
        }

        /* SweetAlert2 Orvex Styling */
        .swal2-popup {
            font-family: 'Ubuntu', sans-serif !important;
            font-size: 0.9rem !important;
            width: min(24rem, 92vw) !important;
            border-radius: var(--r-xl) !important;
            background-color: var(--panel) !important;
            color: var(--ink) !important;
            border: 1px solid var(--line-2) !important;
            box-shadow: var(--shadow) !important;
        }

        .swal2-title {
            color: var(--ink) !important;
            font-size: 1.2rem !important;
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
            padding: 0 20px !important;
        }

        .swal2-cancel {
            background-color: var(--card-3) !important;
            color: var(--ink) !important;
            font-weight: 600 !important;
            border-radius: var(--r-md) !important;
            min-height: 42px !important;
            padding: 0 18px !important;
        }

        /* Telegram-Style Floating Bottom Chin Dock */
        .tg-bottom-nav {
            display: none;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .tnav-wrap,
            .avatar-pill__name,
            .util-btn__label,
            .kbd {
                display: none;
            }

            .mobile-toggle {
                display: inline-flex;
            }

            .top__inner {
                grid-template-columns: minmax(0, 1fr) auto;
            }

            .orvex-main {
                padding-bottom: calc(98px + env(safe-area-inset-bottom, 0px));
            }

            .tg-bottom-nav {
                position: fixed;
                left: 50%;
                bottom: calc(14px + env(safe-area-inset-bottom, 0px));
                transform: translateX(-50%);
                z-index: 75;
                width: min(440px, calc(100vw - 24px));
                padding: 6px;
                border-radius: 999px;
                background-color: var(--topbar-bg);
                backdrop-filter: blur(20px) saturate(180%);
                -webkit-backdrop-filter: blur(20px) saturate(180%);
                box-shadow:
                    inset 0 1px 0 rgba(255, 255, 255, 0.22),
                    inset 0 0 0 1px var(--g-line),
                    0 16px 38px rgba(5, 14, 24, 0.52);
                display: grid;
                grid-template-columns: repeat(5, minmax(0, 1fr));
                gap: 4px;
            }

            .tg-bottom-nav__item {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                gap: 3px;
                min-height: 50px;
                padding: 6px 4px;
                border-radius: 999px;
                color: var(--g-muted);
                font-size: 10.5px;
                font-weight: 600;
                letter-spacing: 0.01em;
                transition: background-color 0.2s var(--ease), color 0.2s var(--ease), transform 0.2s var(--ease);
            }

            .tg-bottom-nav__item i {
                font-size: 15px;
            }

            .tg-bottom-nav__item span {
                max-width: 100%;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .tg-bottom-nav__item:active {
                transform: scale(0.95);
            }

            .tg-bottom-nav__item.is-active {
                background-color: var(--accent);
                color: var(--accent-ink);
                font-weight: 700;
                box-shadow: 0 4px 14px rgba(243, 122, 31, 0.35);
            }
        }

        @media (max-width: 640px) {
            #open-shortcuts-btn,
            .avatar-pill {
                display: none;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                animation-duration: 0.01ms !important;
                transition-duration: 0.01ms !important;
            }
        }
    </style>
</head>

<body>
    <a href="#main-content" class="skip">Lewati ke Konten Utama</a>

    <!-- Mobile Navigation Sidebar (Preserving toggleSidebar() and IDs) -->
    <div id="sidebar-overlay" onclick="toggleSidebar()" class="sidebar-overlay hidden opacity-0"></div>

    <aside id="sidebar" class="mobile-sidebar -translate-x-full" aria-label="Menu navigasi seluler">
        <div>
            <div style="display:flex;align-items:center;justify-content:space-between;padding-bottom:14px;border-bottom:1px solid var(--g-line);">
                <div class="brand">
                    <div class="brand__badge">
                        <img src="<?= base_url('PASTI - Icon.png') ?>" alt="Logo PASTI">
                    </div>
                    <div class="brand__text">
                        <span class="brand__name">PASTI</span>
                        <span class="brand__sub">Ruang Kendali</span>
                    </div>
                </div>
                <button type="button" onclick="toggleSidebar()" class="util-btn" aria-label="Tutup menu">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <nav class="mobile-sidebar__nav">
                <a href="<?= base_url('admin/dashboard') ?>" class="mobile-sidebar__link <?= (url_is('admin/dashboard') ? 'is-active' : '') ?>">
                    <i class="fa-solid fa-gauge-high"></i>
                    <span>Dasbor</span>
                </a>
                <a href="<?= base_url('admin/portfolio') ?>" class="mobile-sidebar__link <?= (url_is('admin/portfolio*') ? 'is-active' : '') ?>">
                    <i class="fa-solid fa-layer-group"></i>
                    <span>Portofolio</span>
                </a>
                <a href="<?= base_url('admin/settings') ?>" class="mobile-sidebar__link <?= (url_is('admin/settings*') ? 'is-active' : '') ?>">
                    <i class="fa-solid fa-sliders"></i>
                    <span>Pengaturan Web</span>
                </a>
                <a href="<?= base_url() ?>" target="_blank" rel="noopener noreferrer" class="mobile-sidebar__link">
                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                    <span>Lihat Etalase Publik</span>
                </a>
            </nav>
        </div>

        <div style="padding-top:14px;border-top:1px solid var(--g-line);display:flex;align-items:center;justify-content:space-between;gap:10px;">
            <div style="display:flex;align-items:center;gap:10px;min-width:0;">
                <div class="avatar-circle">
                    <?= strtoupper(substr((string) session()->get('admin_nama'), 0, 2) ?: 'AD') ?>
                </div>
                <div style="min-width:0;">
                    <div style="font-size:13px;font-weight:700;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                        <?= esc(session()->get('admin_nama') ?: 'Administrator') ?>
                    </div>
                    <div style="font-size:11px;color:var(--g-muted);">Administrator</div>
                </div>
            </div>
            <button type="button" onclick="confirmLogout()" class="util-btn util-btn--logout" aria-label="Keluar">
                <i class="fa-solid fa-power-off"></i>
            </button>
        </div>
    </aside>

    <!-- Main Orvex Shell -->
    <div class="orvex-shell" id="orvex-shell">
        <header class="top">
            <div class="top__inner">
                <div style="display:flex;align-items:center;gap:10px;">
                    <button type="button" onclick="toggleSidebar()" class="util-btn mobile-toggle" aria-label="Buka menu navigasi">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                    <a href="<?= base_url('admin/dashboard') ?>" class="brand">
                        <div class="brand__badge">
                            <img src="<?= base_url('PASTI - Icon.png') ?>" alt="Logo PASTI">
                        </div>
                        <div class="brand__text">
                            <span class="brand__name">PASTI</span>
                            <span class="brand__sub">Ruang Kendali</span>
                        </div>
                    </a>
                </div>

                <!-- Center Pill Navigation -->
                <div class="tnav-wrap">
                    <nav class="tnav" aria-label="Navigasi panel admin">
                        <a href="<?= base_url('admin/dashboard') ?>" class="tnav__item <?= (url_is('admin/dashboard') ? 'is-active' : '') ?>">
                            <i class="fa-solid fa-gauge-high"></i>
                            <span>Dasbor</span>
                        </a>
                        <a href="<?= base_url('admin/portfolio') ?>" class="tnav__item <?= (url_is('admin/portfolio*') ? 'is-active' : '') ?>">
                            <span class="tnav__dot" aria-hidden="true"></span>
                            <span>Portofolio</span>
                        </a>
                        <a href="<?= base_url('admin/settings') ?>" class="tnav__item <?= (url_is('admin/settings*') ? 'is-active' : '') ?>">
                            <i class="fa-solid fa-gear"></i>
                            <span>Pengaturan Web</span>
                        </a>
                        <a href="<?= base_url() ?>" target="_blank" rel="noopener noreferrer" class="tnav__item">
                            <i class="fa-solid fa-globe"></i>
                            <span>Etalase Publik</span>
                        </a>
                        <button type="button" class="tnav__new" id="quick-create-btn" aria-expanded="false" aria-controls="quick-create-pop" title="Buat baru (N)">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                    </nav>

                    <div class="quick-pop" id="quick-create-pop" role="menu">
                        <span class="quick-pop__label">Aksi Cepat</span>
                        <a href="<?= base_url('admin/portfolio/create') ?>" role="menuitem">
                            <span><i class="fa-solid fa-folder-plus" style="margin-right:8px;color:var(--accent-text);"></i> Tambah Proyek Baru</span>
                            <i class="fa-solid fa-arrow-right" style="font-size:11px;color:var(--muted);"></i>
                        </a>
                        <a href="<?= base_url('admin/settings') ?>" role="menuitem">
                            <span><i class="fa-solid fa-sliders" style="margin-right:8px;color:var(--accent-text);"></i> Konfigurasi Website</span>
                            <i class="fa-solid fa-arrow-right" style="font-size:11px;color:var(--muted);"></i>
                        </a>
                        <a href="<?= base_url() ?>" target="_blank" rel="noopener noreferrer" role="menuitem">
                            <span><i class="fa-solid fa-arrow-up-right-from-square" style="margin-right:8px;color:var(--accent-text);"></i> Pratinjau Landing Page</span>
                        </a>
                    </div>
                </div>

                <!-- Right Utility Cluster -->
                <div class="top__utils">
                    <button type="button" class="util-btn" id="open-cmd-btn" title="Pencarian cepat (Ctrl+K)">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <span class="util-btn__label">Cari</span>
                        <span class="kbd">Ctrl+K</span>
                    </button>

                    <button type="button" class="util-btn" id="theme-toggle-btn" title="Ganti tema Light / Dark (T)" aria-label="Ganti tema tampilan">
                        <i class="fa-solid fa-moon" id="theme-toggle-icon"></i>
                    </button>

                    <button type="button" class="util-btn" id="open-shortcuts-btn" title="Pintasan keyboard (?)" aria-label="Pintasan keyboard">
                        <i class="fa-solid fa-keyboard"></i>
                    </button>

                    <div class="avatar-pill" title="<?= esc(session()->get('admin_nama') ?: 'Administrator') ?>">
                        <span class="avatar-circle">
                            <?= strtoupper(substr((string) session()->get('admin_nama'), 0, 2) ?: 'AD') ?>
                        </span>
                        <span class="avatar-pill__name"><?= esc(session()->get('admin_nama') ?: 'Administrator') ?></span>
                    </div>

                    <button type="button" onclick="confirmLogout()" class="util-btn util-btn--logout" title="Akhiri sesi admin">
                        <i class="fa-solid fa-power-off"></i>
                        <span class="util-btn__label">Keluar</span>
                    </button>
                </div>
            </div>
        </header>

        <main id="main-content" class="orvex-main">
            <?= $this->renderSection('content') ?>
        </main>

        <!-- Telegram-Style Floating Rounded Bottom Navigation Bar (Mobile / Tablet) -->
        <nav class="tg-bottom-nav" aria-label="Menu mengambang bawah">
            <a href="<?= base_url('admin/dashboard') ?>" class="tg-bottom-nav__item <?= (url_is('admin/dashboard') ? 'is-active' : '') ?>">
                <i class="fa-solid fa-gauge-high"></i>
                <span>Dasbor</span>
            </a>
            <a href="<?= base_url('admin/portfolio') ?>" class="tg-bottom-nav__item <?= (url_is('admin/portfolio') || url_is('admin/portfolio/edit*') ? 'is-active' : '') ?>">
                <i class="fa-solid fa-layer-group"></i>
                <span>Portofolio</span>
            </a>
            <a href="<?= base_url('admin/portfolio/create') ?>" class="tg-bottom-nav__item <?= (url_is('admin/portfolio/create') ? 'is-active' : '') ?>">
                <i class="fa-solid fa-circle-plus"></i>
                <span>Tambah</span>
            </a>
            <a href="<?= base_url('admin/settings') ?>" class="tg-bottom-nav__item <?= (url_is('admin/settings*') ? 'is-active' : '') ?>">
                <i class="fa-solid fa-sliders"></i>
                <span>Setelan</span>
            </a>
            <a href="<?= base_url() ?>" target="_blank" rel="noopener noreferrer" class="tg-bottom-nav__item">
                <i class="fa-solid fa-globe"></i>
                <span>Etalase</span>
            </a>
        </nav>
    </div>

    <!-- Command Palette Modal (Ctrl+K / /) -->
    <div class="orvex-modal-backdrop" id="cmd-backdrop" role="dialog" aria-modal="true" aria-labelledby="cmd-input-label">
        <div class="finder">
            <div class="finder__head">
                <i class="fa-solid fa-magnifying-glass" style="color:var(--accent-text);"></i>
                <label id="cmd-input-label" for="cmd-input" style="position:absolute;left:-9999px;">Cari perintah atau halaman</label>
                <input type="text" id="cmd-input" placeholder="Lompat ke menu atau aksi cepat..." autocomplete="off">
                <button type="button" class="orvex-btn" id="cmd-close-btn" style="min-height:34px;padding:0 10px;font-size:11.5px;">Esc</button>
            </div>
            <div class="finder__list" id="cmd-list"></div>
            <div class="finder__foot">
                <span><i class="fa-solid fa-circle-info"></i> Navigasi cepat Panel Admin Studio PASTI</span>
                <span>Enter buka &bull; Esc tutup</span>
            </div>
        </div>
    </div>

    <!-- Keyboard Shortcuts Modal (?) -->
    <div class="orvex-modal-backdrop" id="shortcuts-backdrop" role="dialog" aria-modal="true" aria-labelledby="shortcuts-title">
        <div class="finder" style="max-width:460px;">
            <div class="finder__head" style="justify-content:space-between;">
                <strong id="shortcuts-title" style="font-size:15px;">Pintasan Keyboard</strong>
                <button type="button" class="orvex-btn" id="shortcuts-close-btn" style="min-height:34px;padding:0 10px;font-size:11.5px;">Tutup</button>
            </div>
            <div class="finder__list" style="padding:14px 18px;gap:10px;">
                <div style="display:flex;justify-content:space-between;align-items:center;">
                    <span>Buka Command Palette</span>
                    <span class="badge badge--info">Ctrl+K / /</span>
                </div>
                <div style="display:flex;justify-content:space-between;align-items:center;">
                    <span>Ganti Tema Light / Dark</span>
                    <span class="badge badge--info">T</span>
                </div>
                <div style="display:flex;justify-content:space-between;align-items:center;">
                    <span>Buka Menu Aksi Cepat</span>
                    <span class="badge badge--info">N</span>
                </div>
                <div style="display:flex;justify-content:space-between;align-items:center;">
                    <span>Daftar Pintasan Ini</span>
                    <span class="badge badge--info">?</span>
                </div>
                <div style="display:flex;justify-content:space-between;align-items:center;">
                    <span>Tutup Dialog / Popover</span>
                    <span class="badge badge--info">Esc</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        (function () {
            const shell = document.getElementById('orvex-shell');
            const themeBtn = document.getElementById('theme-toggle-btn');
            const themeIcon = document.getElementById('theme-toggle-icon');

            function syncThemeIcon() {
                const current = document.documentElement.getAttribute('data-theme') || 'light';
                if (themeIcon) {
                    themeIcon.className = current === 'dark' ? 'fa-solid fa-sun' : 'fa-solid fa-moon';
                }
                window.dispatchEvent(new CustomEvent('orvex-theme-change', { detail: { theme: current } }));
            }

            window.setOrvexTheme = function (nextTheme) {
                document.documentElement.setAttribute('data-theme', nextTheme);
                try {
                    localStorage.setItem('orvex_admin_theme', nextTheme);
                } catch (e) {}
                syncThemeIcon();
            };

            syncThemeIcon();

            if (themeBtn) {
                themeBtn.addEventListener('click', () => {
                    const current = document.documentElement.getAttribute('data-theme') || 'light';
                    window.setOrvexTheme(current === 'dark' ? 'light' : 'dark');
                });
            }

            /* Quick Create Popover */
            const quickBtn = document.getElementById('quick-create-btn');
            const quickPop = document.getElementById('quick-create-pop');
            function toggleQuickPop(force) {
                if (!quickBtn || !quickPop) return;
                const next = typeof force === 'boolean' ? force : !quickPop.classList.contains('is-open');
                quickPop.classList.toggle('is-open', next);
                quickBtn.setAttribute('aria-expanded', String(next));
            }
            if (quickBtn && quickPop) {
                quickBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    toggleQuickPop();
                });
                document.addEventListener('click', (e) => {
                    if (!quickPop.contains(e.target) && e.target !== quickBtn) {
                        toggleQuickPop(false);
                    }
                });
            }

            /* Command Palette */
            const cmdBackdrop = document.getElementById('cmd-backdrop');
            const cmdInput = document.getElementById('cmd-input');
            const cmdList = document.getElementById('cmd-list');
            const openCmdBtn = document.getElementById('open-cmd-btn');
            const closeCmdBtn = document.getElementById('cmd-close-btn');

            const shortcutsBackdrop = document.getElementById('shortcuts-backdrop');
            const openShortcutsBtn = document.getElementById('open-shortcuts-btn');
            const closeShortcutsBtn = document.getElementById('shortcuts-close-btn');

            const commands = [
                { label: 'Dasbor Utama', hint: 'Overview', icon: 'fa-gauge-high', url: '<?= base_url('admin/dashboard') ?>' },
                { label: 'Katalog Portofolio', hint: 'Tabel & Kelola', icon: 'fa-layer-group', url: '<?= base_url('admin/portfolio') ?>' },
                { label: 'Tambah Proyek Baru', hint: 'Form Buat', icon: 'fa-plus', url: '<?= base_url('admin/portfolio/create') ?>' },
                { label: 'Pengaturan Website', hint: 'Konfigurasi', icon: 'fa-gear', url: '<?= base_url('admin/settings') ?>' },
                { label: 'Lihat Etalase Publik', hint: 'Tab Baru', icon: 'fa-globe', url: '<?= base_url() ?>', blank: true },
                { label: 'Ganti Tema Light / Dark', hint: 'T', icon: 'fa-circle-half-stroke', action: () => themeBtn && themeBtn.click() },
                { label: 'Akhiri Sesi (Logout)', hint: 'Auth', icon: 'fa-power-off', action: () => confirmLogout() }
            ];

            function setShellInert(state) {
                if (!shell) return;
                if (state) {
                    shell.setAttribute('inert', '');
                } else {
                    shell.removeAttribute('inert');
                }
            }

            function renderCommands(q) {
                if (!cmdList) return;
                const query = (q || '').trim().toLowerCase();
                const filtered = commands.filter((c) => c.label.toLowerCase().includes(query) || c.hint.toLowerCase().includes(query));
                cmdList.innerHTML = '';

                if (filtered.length === 0) {
                    const empty = document.createElement('div');
                    empty.style.cssText = 'padding:18px;text-align:center;color:var(--muted);font-size:13px;';
                    empty.textContent = 'Tidak ada perintah yang cocok.';
                    cmdList.appendChild(empty);
                    return;
                }

                filtered.forEach((cmd, idx) => {
                    const item = document.createElement('button');
                    item.type = 'button';
                    item.className = 'finder__item' + (idx === 0 ? ' is-selected' : '');
                    item.style.border = '0';
                    item.style.width = '100%';
                    item.innerHTML = `
                        <span style="display:flex;align-items:center;gap:10px;">
                            <i class="fa-solid ${cmd.icon}" style="width:18px;text-align:center;color:var(--accent-text);"></i>
                            <span>${cmd.label}</span>
                        </span>
                        <span class="badge badge--info">${cmd.hint}</span>
                    `;
                    item.addEventListener('click', () => {
                        closeCmd();
                        if (cmd.action) {
                            cmd.action();
                        } else if (cmd.blank) {
                            window.open(cmd.url, '_blank', 'noopener,noreferrer');
                        } else {
                            window.location.href = cmd.url;
                        }
                    });
                    cmdList.appendChild(item);
                });
            }

            function openCmd() {
                if (!cmdBackdrop) return;
                toggleQuickPop(false);
                cmdBackdrop.classList.add('is-open');
                setShellInert(true);
                renderCommands('');
                if (cmdInput) {
                    cmdInput.value = '';
                    setTimeout(() => cmdInput.focus(), 20);
                }
            }

            function closeCmd() {
                if (!cmdBackdrop) return;
                cmdBackdrop.classList.remove('is-open');
                setShellInert(false);
            }

            function openShortcuts() {
                if (!shortcutsBackdrop) return;
                toggleQuickPop(false);
                shortcutsBackdrop.classList.add('is-open');
                setShellInert(true);
            }

            function closeShortcuts() {
                if (!shortcutsBackdrop) return;
                shortcutsBackdrop.classList.remove('is-open');
                setShellInert(false);
            }

            if (openCmdBtn) openCmdBtn.addEventListener('click', openCmd);
            if (closeCmdBtn) closeCmdBtn.addEventListener('click', closeCmd);
            if (cmdBackdrop) {
                cmdBackdrop.addEventListener('click', (e) => {
                    if (e.target === cmdBackdrop) closeCmd();
                });
            }
            if (cmdInput) {
                cmdInput.addEventListener('input', () => renderCommands(cmdInput.value));
                cmdInput.addEventListener('keydown', (e) => {
                    if (e.key === 'Enter') {
                        const first = cmdList && cmdList.querySelector('.finder__item');
                        if (first) {
                            e.preventDefault();
                            first.click();
                        }
                    }
                });
            }

            if (openShortcutsBtn) openShortcutsBtn.addEventListener('click', openShortcuts);
            if (closeShortcutsBtn) closeShortcutsBtn.addEventListener('click', closeShortcuts);
            if (shortcutsBackdrop) {
                shortcutsBackdrop.addEventListener('click', (e) => {
                    if (e.target === shortcutsBackdrop) closeShortcuts();
                });
            }

            document.addEventListener('keydown', (e) => {
                const tag = (e.target && e.target.tagName) || '';
                const inInput = tag === 'INPUT' || tag === 'TEXTAREA' || tag === 'SELECT' || (e.target && e.target.isContentEditable);

                if ((e.metaKey || e.ctrlKey) && e.key.toLowerCase() === 'k') {
                    e.preventDefault();
                    if (cmdBackdrop && cmdBackdrop.classList.contains('is-open')) {
                        closeCmd();
                    } else {
                        openCmd();
                    }
                    return;
                }

                if (e.key === 'Escape') {
                    closeCmd();
                    closeShortcuts();
                    toggleQuickPop(false);
                    return;
                }

                if (inInput) return;

                if (e.key === '/') {
                    e.preventDefault();
                    openCmd();
                } else if (e.key.toLowerCase() === 't') {
                    themeBtn && themeBtn.click();
                } else if (e.key.toLowerCase() === 'n') {
                    toggleQuickPop();
                } else if (e.key === '?') {
                    openShortcuts();
                }
            });
        })();

        // Preserved Function: Toggle Mobile Sidebar
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            if (!sidebar || !overlay) return;

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

        // Preserved Function: Confirm Logout
        function confirmLogout() {
            Swal.fire({
                title: 'Akhiri Sesi?',
                text: 'Anda akan keluar dari Panel Admin.',
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
