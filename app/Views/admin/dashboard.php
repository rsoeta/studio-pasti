<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<?php
$portfolios   = $portfolios ?? [];
$settings     = $settings ?? [];
$total        = count($portfolios);
$readyCount   = 0;
$maintCount   = 0;
$activeCount  = 0;
$hiddenCount  = 0;

foreach ($portfolios as $item) {
    if (($item['status_demo'] ?? '') === 'ready') {
        $readyCount++;
    } else {
        $maintCount++;
    }
    if ((int) ($item['is_active'] ?? 0) === 1) {
        $activeCount++;
    } else {
        $hiddenCount++;
    }
}

$readyPct  = $total > 0 ? (int) round(($readyCount / $total) * 100) : 0;
$activePct = $total > 0 ? (int) round(($activeCount / $total) * 100) : 0;
$radarNodes = array_slice($portfolios, 0, 12);
?>

<style>
    /* Orvex 3-Column Overview Hero Bento */
    .orvex-hero {
        background-color: var(--card);
        color: var(--ink);
        border-radius: var(--r-xl);
        padding: 20px;
        box-shadow: inset 0 1px 0 var(--top-light), inset 0 0 0 1px var(--line), var(--shadow);
        display: grid;
        grid-template-columns: 230px minmax(0, 1fr) 300px;
        gap: 20px;
        align-items: stretch;
        margin-bottom: 14px;
    }

    .hero-left {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        gap: 14px;
    }

    .hero-greeting-title {
        margin: 0;
        font-size: 18px;
        font-weight: 700;
        letter-spacing: -0.015em;
        color: var(--ink);
        line-height: 1.2;
    }

    .hero-greeting-sub {
        margin: 6px 0 0;
        font-size: 12.5px;
        color: var(--muted);
    }

    .kpi-tile {
        display: block;
        background-color: var(--peach-2);
        color: var(--peach-ink);
        border-radius: var(--r-lg);
        padding: 14px;
        border: 1px solid rgba(168, 74, 8, 0.14);
        transition: transform 0.2s var(--ease), box-shadow 0.2s ease;
    }

    .kpi-tile:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 22px rgba(15, 26, 36, 0.1);
    }

    .kpi-tile__label {
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: var(--peach-muted);
    }

    .kpi-tile__row {
        display: flex;
        align-items: baseline;
        justify-content: space-between;
        gap: 8px;
        margin-top: 6px;
    }

    .kpi-tile__val {
        font-size: 28px;
        font-weight: 700;
        letter-spacing: -0.03em;
        line-height: 1;
    }

    .kpi-tile__unit {
        font-size: 12px;
        font-weight: 600;
        color: var(--peach-muted);
    }

    .kpi-pills {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        margin-top: 10px;
    }

    .kpi-chip {
        padding: 3px 8px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 700;
        background: rgba(255, 255, 255, 0.55);
        color: var(--ink);
    }

    [data-theme="dark"] .kpi-chip {
        background: rgba(15, 26, 36, 0.45);
        color: var(--peach-ink);
    }

    .seg-control {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 4px;
        padding: 4px;
        border-radius: var(--r-md);
        background-color: var(--card-2);
        border: 1px solid var(--line);
    }

    .seg-btn {
        min-height: 36px;
        border: 0;
        border-radius: 7px;
        background: transparent;
        color: var(--muted);
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .seg-btn.is-active {
        background-color: var(--ink);
        color: var(--card);
    }

    /* Center Exposure / System Radar */
    .radar-panel {
        position: relative;
        background-color: var(--card-2);
        border: 1px solid var(--line);
        border-radius: var(--r-lg);
        padding: 14px 16px 8px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        overflow: hidden;
    }

    .radar-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        font-size: 12px;
        color: var(--muted);
        font-weight: 600;
    }

    .radar__svg {
        width: 100%;
        height: auto;
        max-height: 330px;
        display: block;
    }

    .radar-node {
        cursor: pointer;
        transition: opacity 0.25s ease;
    }

    .radar-node:hover circle.node-ring {
        stroke: var(--accent);
        stroke-width: 2.5;
    }

    .radar-node.is-dimmed {
        opacity: 0.25;
    }

    /* Right Live Feed */
    .feed-panel {
        background-color: var(--panel);
        border: 1px solid var(--line);
        border-radius: var(--r-lg);
        padding: 14px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        gap: 12px;
    }

    .feed-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
    }

    .live-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background-color: var(--live);
        box-shadow: 0 0 0 4px rgba(47, 174, 85, 0.2);
        animation: pulseLive 2s infinite;
    }

    @keyframes pulseLive {
        0%, 100% { box-shadow: 0 0 0 0 rgba(47, 174, 85, 0.35); }
        50% { box-shadow: 0 0 0 6px rgba(47, 174, 85, 0); }
    }

    .feed-list {
        display: grid;
        gap: 8px;
        max-height: 258px;
        overflow-y: auto;
        padding-right: 2px;
    }

    .feed-item {
        display: grid;
        grid-template-columns: 28px 1fr auto;
        align-items: center;
        gap: 10px;
        padding: 9px 10px;
        border-radius: var(--r-md);
        background-color: var(--card);
        border: 1px solid var(--line);
        color: var(--ink);
        transition: border-color 0.2s ease, transform 0.2s ease;
    }

    .feed-item:hover {
        border-color: var(--accent);
        transform: translateX(2px);
    }

    .feed-code {
        width: 28px;
        height: 28px;
        border-radius: 7px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        font-weight: 700;
    }

    .feed-code--ready {
        background-color: var(--good-bg);
        color: var(--good);
    }

    .feed-code--maint {
        background-color: var(--peach);
        color: var(--accent-text);
    }

    /* 4-Column Lower Summary Grid */
    .summary-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: var(--gap);
        margin-bottom: 14px;
    }

    .card-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        margin-bottom: 14px;
    }

    .iconlink {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        border-radius: var(--r-sm);
        background-color: rgba(15, 26, 36, 0.08);
        color: var(--ink);
        transition: background-color 0.2s ease, color 0.2s ease;
    }

    .iconlink:hover {
        background-color: var(--accent);
        color: var(--accent-ink);
    }

    .mini-list {
        display: grid;
        gap: 8px;
    }

    .mini-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        padding: 9px 11px;
        border-radius: var(--r-md);
        background-color: rgba(255, 255, 255, 0.52);
        border: 1px solid rgba(15, 30, 45, 0.08);
        font-size: 12.5px;
    }

    [data-theme="dark"] .mini-row {
        background-color: rgba(13, 23, 33, 0.42);
        border-color: rgba(255, 255, 255, 0.08);
    }

    .orvex-card:not(.orvex-card--peach) .mini-row {
        background-color: var(--card-2);
    }

    .sev-bars {
        display: grid;
        gap: 10px;
    }

    .sev-row__head {
        display: flex;
        justify-content: space-between;
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 4px;
    }

    .sev-track {
        height: 8px;
        border-radius: 999px;
        background-color: var(--card-3);
        overflow: hidden;
    }

    .sev-fill {
        height: 100%;
        border-radius: 999px;
    }

    /* Bottom Shift Handover Strip */
    .handover {
        background-color: var(--card);
        color: var(--ink);
        border-radius: var(--r-lg);
        padding: 14px 20px;
        box-shadow: inset 0 1px 0 var(--top-light), inset 0 0 0 1px var(--line), var(--shadow);
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
    }

    .handover__meta {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 10px 22px;
        font-size: 12.5px;
        color: var(--muted);
    }

    .handover__meta strong {
        color: var(--ink);
    }

    @media (max-width: 1200px) {
        .orvex-hero {
            grid-template-columns: 1fr;
        }

        .summary-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 640px) {
        .summary-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<!-- 3-Column Hero Bento (Orvex Overview) -->
<section class="orvex-hero" aria-label="Ikhtisar Ekosistem">
    <!-- Left Column: Greeting + Peach KPI Tiles + Segmented Control -->
    <div class="hero-left">
        <div>
            <h1 class="hero-greeting-title">
                <span class="phead__mark">Dasbor Ekosistem</span>
            </h1>
            <p class="hero-greeting-sub">
                Selamat datang, <strong><?= esc(session()->get('admin_nama')) ?></strong>!
            </p>
        </div>

        <a href="<?= base_url('admin/portfolio') ?>" class="kpi-tile">
            <span class="kpi-tile__label">Total Portofolio</span>
            <div class="kpi-tile__row">
                <div>
                    <span class="kpi-tile__val tabular-nums"><?= esc($total_portfolio) ?></span>
                    <span class="kpi-tile__unit">Aplikasi</span>
                </div>
                <svg width="68" height="26" viewBox="0 0 68 26" fill="none" aria-hidden="true">
                    <path d="M2 20C10 18 14 8 22 11C30 14 34 5 43 8C51 10 56 4 66 3" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                </svg>
            </div>
        </a>

        <a href="<?= base_url('admin/portfolio') ?>" class="kpi-tile">
            <span class="kpi-tile__label">Status Katalog</span>
            <div class="kpi-tile__row">
                <div>
                    <span class="kpi-tile__val tabular-nums"><?= $readyCount ?></span>
                    <span class="kpi-tile__unit">Demo Ready</span>
                </div>
            </div>
            <div class="kpi-pills tabular-nums">
                <span class="kpi-chip"><?= $readyCount ?> Ready</span>
                <span class="kpi-chip"><?= $maintCount ?> Maint</span>
                <span class="kpi-chip"><?= $activeCount ?> Publik</span>
                <span class="kpi-chip"><?= $hiddenCount ?> Arsip</span>
            </div>
        </a>

        <div>
            <div style="font-size:11px;font-weight:700;letter-spacing:0.06em;text-transform:uppercase;color:var(--muted);margin-bottom:6px;">
                Fokus Radar Sistem
            </div>
            <div class="seg-control" role="group" aria-label="Filter radar sistem">
                <button type="button" class="seg-btn is-active" data-radar-mode="all">Semua</button>
                <button type="button" class="seg-btn" data-radar-mode="ready">Ready</button>
                <button type="button" class="seg-btn" data-radar-mode="active">Publik</button>
            </div>
        </div>
    </div>

    <!-- Center Column: Interactive Semicircular System Radar -->
    <div class="radar-panel">
        <div class="radar-head">
            <span><i class="fa-solid fa-satellite-dish" style="color:var(--accent-text);margin-right:6px;"></i> Radar Katalog Aplikasi</span>
            <span class="tabular-nums" id="radar-top-readout"><?= esc($total_portfolio) ?> sistem terdata &bull; <?= $activeCount ?> tampil publik</span>
        </div>

        <svg
            class="radar__svg"
            viewBox="0 0 1000 540"
            role="img"
            aria-label="Radar portofolio menampilkan <?= esc($total_portfolio) ?> aplikasi dengan <?= $readyCount ?> siap demo dan <?= $maintCount ?> pemeliharaan">
            <!-- Outer 96 Volume/Slot Ticks -->
            <g stroke="var(--line-2)" stroke-linecap="round">
                <?php
                $cx = 500;
                $cy = 485;
                for ($i = 0; $i < 96; $i++) {
                    $angleDeg = 180 - ($i * (180 / 95));
                    $rad = deg2rad($angleDeg);
                    $r1 = 425;
                    $r2 = ($i % 8 === 0) ? 452 : (($i % 4 === 0) ? 444 : 436);
                    $x1 = $cx + $r1 * cos($rad);
                    $y1 = $cy - $r1 * sin($rad);
                    $x2 = $cx + $r2 * cos($rad);
                    $y2 = $cy - $r2 * sin($rad);
                    $stroke = ($i % 8 === 0) ? 'var(--accent)' : 'var(--line-2)';
                    $sw = ($i % 8 === 0) ? '2.2' : '1.3';
                    echo sprintf(
                        '<line x1="%.1f" y1="%.1f" x2="%.1f" y2="%.1f" stroke="%s" stroke-width="%s" />',
                        $x1,
                        $y1,
                        $x2,
                        $y2,
                        $stroke,
                        $sw
                    );
                }
                ?>
            </g>

            <!-- 3 Concentric Orbital Tracks -->
            <path d="M 110 485 A 390 390 0 0 1 890 485" fill="none" stroke="var(--line)" stroke-width="1.5" stroke-dasharray="5 7" />
            <path d="M 190 485 A 310 310 0 0 1 810 485" fill="none" stroke="var(--line)" stroke-width="1.5" />
            <path d="M 270 485 A 230 230 0 0 1 730 485" fill="none" stroke="var(--line)" stroke-width="1.5" stroke-dasharray="4 6" />

            <!-- Inner Dark Semicircle Gauge Disc -->
            <path d="M 335 485 A 165 165 0 0 1 665 485 Z" fill="var(--disc)" stroke="var(--disc-ring)" stroke-width="1.5" />
            <?php
            $arcLen = round(M_PI * 150, 2);
            $readyOffset = round($arcLen * (1 - ($readyPct / 100)), 2);
            ?>
            <path
                id="radar-arc"
                d="M 350 485 A 150 150 0 0 1 650 485"
                fill="none"
                stroke="var(--accent)"
                stroke-width="8"
                stroke-linecap="round"
                stroke-dasharray="<?= $arcLen ?>"
                stroke-dashoffset="<?= $readyOffset ?>"
                data-arclen="<?= $arcLen ?>"
                data-ready-pct="<?= $readyPct ?>"
                data-active-pct="<?= $activePct ?>" />

            <text x="500" y="420" text-anchor="middle" fill="#eef3f8" font-size="44" font-weight="700" id="radar-disc-pct" class="tabular-nums"><?= $readyPct ?>%</text>
            <text x="500" y="452" text-anchor="middle" fill="#9fb0c1" font-size="14" font-weight="600" id="radar-disc-label">Demo Ready</text>

            <!-- Orbital Portfolio Nodes -->
            <?php if (!empty($radarNodes)): ?>
                <?php
                $nodeCount = count($radarNodes);
                $radii = [390, 310, 230];
                foreach ($radarNodes as $idx => $node):
                    $angle = $nodeCount === 1 ? 90 : (164 - ($idx * (148 / ($nodeCount - 1))));
                    $r = $radii[$idx % 3];
                    $nx = 500 + $r * cos(deg2rad($angle));
                    $ny = 485 - $r * sin(deg2rad($angle));
                    $isReady = ($node['status_demo'] ?? '') === 'ready';
                    $isActive = (int) ($node['is_active'] ?? 0) === 1;
                    $shortTitle = mb_strimwidth($node['judul'], 0, 18, '…');
                ?>
                    <g
                        class="radar-node"
                        data-status="<?= esc($node['status_demo']) ?>"
                        data-active="<?= $isActive ? '1' : '0' ?>"
                        onclick="window.location.href='<?= base_url('admin/portfolio/edit/' . $node['id']) ?>'"
                        transform="translate(<?= round($nx, 1) ?>, <?= round($ny, 1) ?>)">
                        <title><?= esc($node['judul']) ?> — <?= $isReady ? 'Ready' : 'Maintenance' ?> (Klik untuk edit)</title>
                        <circle class="node-ring" r="24" fill="var(--paper)" stroke="<?= $isReady ? 'var(--good)' : 'var(--accent)' ?>" stroke-width="2" />
                        <circle r="7" cx="18" cy="-18" fill="<?= $isReady ? 'var(--good)' : 'var(--accent)' ?>" />
                        <text y="4" text-anchor="middle" fill="var(--ink)" font-size="11" font-weight="700"><?= sprintf('%02d', $idx + 1) ?></text>
                        <rect x="-56" y="28" width="112" height="22" rx="6" fill="var(--panel)" stroke="var(--line-2)" />
                        <text y="43" text-anchor="middle" fill="var(--ink)" font-size="11" font-weight="600"><?= esc($shortTitle) ?></text>
                    </g>
                <?php endforeach; ?>
            <?php else: ?>
                <text x="500" y="265" text-anchor="middle" fill="var(--muted)" font-size="14" font-weight="600">
                    Belum ada node portofolio — klik "+ Tambah Proyek" untuk mengisi radar.
                </text>
            <?php endif; ?>
        </svg>
    </div>

    <!-- Right Column: Live System Feed -->
    <div class="feed-panel">
        <div class="feed-head">
            <div style="display:flex;align-items:center;gap:8px;">
                <span class="live-dot" aria-hidden="true"></span>
                <h2 class="ctitle">Aliran Sistem</h2>
                <span class="badge badge--good">Aktif</span>
            </div>
            <button type="button" class="orvex-btn" id="feed-pause-btn" style="min-height:34px;padding:0 10px;font-size:11.5px;" title="Jeda atau lanjutkan aliran">
                <i class="fa-solid fa-pause"></i>
            </button>
        </div>

        <div class="feed-list" id="live-feed-list" aria-live="polite">
            <?php if (!empty($portfolios)): ?>
                <?php foreach (array_slice($portfolios, 0, 5) as $app): ?>
                    <?php $isReady = ($app['status_demo'] ?? '') === 'ready'; ?>
                    <a href="<?= base_url('admin/portfolio/edit/' . $app['id']) ?>" class="feed-item">
                        <span class="feed-code <?= $isReady ? 'feed-code--ready' : 'feed-code--maint' ?>">
                            <?= $isReady ? 'R' : 'M' ?>
                        </span>
                        <div style="min-width:0;">
                            <div style="font-size:12.5px;font-weight:700;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                                <?= esc($app['judul']) ?>
                            </div>
                            <div style="font-size:11px;color:var(--muted);">
                                <?= $isReady ? 'Demo siap diuji' : 'Proses pemeliharaan' ?> &bull; Urutan #<?= (int) $app['urutan'] ?>
                            </div>
                        </div>
                        <i class="fa-solid fa-chevron-right" style="font-size:10px;color:var(--muted);"></i>
                    </a>
                <?php endforeach; ?>
            <?php else: ?>
                <div style="padding:18px;text-align:center;color:var(--muted);font-size:12.5px;">
                    Belum ada aktivitas katalog tercatat.
                </div>
            <?php endif; ?>
        </div>

        <a href="<?= base_url('admin/portfolio') ?>" class="orvex-btn" style="width:100%;justify-content:space-between;">
            <span>Kelola Portofolio</span>
            <i class="fa-solid fa-arrow-up-right-from-square"></i>
        </a>
    </div>
</section>

<!-- 4-Column Lower Summary Grid -->
<section class="summary-grid" aria-label="Ringkasan Operasional">
    <!-- Card 1: Portofolio Utama (Warm Peach Card) -->
    <div class="orvex-card orvex-card--peach orvex-card--sm">
        <div class="card-top">
            <div>
                <h2 class="ctitle">Portofolio Utama</h2>
                <span style="font-size:11.5px;color:var(--peach-muted);">Urutan tampil teratas</span>
            </div>
            <a href="<?= base_url('admin/portfolio') ?>" class="iconlink" aria-label="Buka semua portofolio">
                <i class="fa-solid fa-arrow-up-right-from-square" style="font-size:12px;"></i>
            </a>
        </div>

        <div class="mini-list">
            <?php if (!empty($portfolios)): ?>
                <?php foreach (array_slice($portfolios, 0, 3) as $p): ?>
                    <a href="<?= base_url('admin/portfolio/edit/' . $p['id']) ?>" class="mini-row">
                        <span style="font-weight:600;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;"><?= esc($p['judul']) ?></span>
                        <span class="badge <?= $p['status_demo'] === 'ready' ? 'badge--good' : 'badge--warn' ?>">
                            <?= $p['status_demo'] === 'ready' ? 'Ready' : 'Maint' ?>
                        </span>
                    </a>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="mini-row"><span>Belum ada proyek</span></div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Card 2: Distribusi Status Demo -->
    <div class="orvex-card orvex-card--sm">
        <div class="card-top">
            <div>
                <h2 class="ctitle">Distribusi Status</h2>
                <span style="font-size:11.5px;color:var(--muted);">Rasio kesiapan &amp; visibilitas</span>
            </div>
            <a href="<?= base_url('admin/portfolio') ?>" class="iconlink" aria-label="Filter katalog">
                <i class="fa-solid fa-layer-group" style="font-size:12px;"></i>
            </a>
        </div>

        <div class="sev-bars tabular-nums">
            <div>
                <div class="sev-row__head">
                    <span>Demo Ready</span>
                    <span><?= $readyCount ?> / <?= $total ?></span>
                </div>
                <div class="sev-track">
                    <div class="sev-fill" style="width:<?= $readyPct ?>%;background:var(--good);"></div>
                </div>
            </div>
            <div>
                <div class="sev-row__head">
                    <span>Maintenance</span>
                    <span><?= $maintCount ?> / <?= $total ?></span>
                </div>
                <div class="sev-track">
                    <div class="sev-fill" style="width:<?= $total > 0 ? round(($maintCount / $total) * 100) : 0 ?>%;background:var(--accent);"></div>
                </div>
            </div>
            <div>
                <div class="sev-row__head">
                    <span>Tampil Publik</span>
                    <span><?= $activeCount ?> / <?= $total ?></span>
                </div>
                <div class="sev-track">
                    <div class="sev-fill" style="width:<?= $activePct ?>%;background:var(--info);"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card 3: Konfigurasi Website -->
    <div class="orvex-card orvex-card--sm">
        <div class="card-top">
            <div>
                <h2 class="ctitle">Konfigurasi Website</h2>
                <span style="font-size:11.5px;color:var(--muted);">Identitas etalase aktif</span>
            </div>
            <a href="<?= base_url('admin/settings') ?>" class="iconlink" aria-label="Ubah pengaturan website">
                <i class="fa-solid fa-sliders" style="font-size:12px;"></i>
            </a>
        </div>

        <div class="mini-list">
            <div class="mini-row">
                <span class="muted">Brand</span>
                <strong><?= esc($settings['nama_web'] ?? 'Studio PASTI') ?></strong>
            </div>
            <div class="mini-row">
                <span class="muted">WhatsApp</span>
                <strong class="tabular-nums"><?= esc($settings['nomor_wa'] ?? '-') ?></strong>
            </div>
            <div class="mini-row">
                <span class="muted">Status Web</span>
                <span class="badge badge--good">Aktif &bull; Online</span>
            </div>
        </div>
    </div>

    <!-- Card 4: Playbook & Pintasan Admin -->
    <div class="orvex-card orvex-card--sm">
        <div class="card-top">
            <div>
                <h2 class="ctitle">Playbook Admin</h2>
                <span style="font-size:11.5px;color:var(--muted);">Langkah cepat pengelolaan</span>
            </div>
            <span class="badge badge--info">3 Aksi</span>
        </div>

        <div class="mini-list">
            <a href="<?= base_url('admin/portfolio/create') ?>" class="mini-row">
                <span><strong style="color:var(--accent-text);">&rsaquo;01</strong> Tambah Proyek Baru</span>
                <i class="fa-solid fa-plus" style="color:var(--accent-text);"></i>
            </a>
            <a href="<?= base_url('admin/portfolio') ?>" class="mini-row">
                <span><strong style="color:var(--accent-text);">&rsaquo;02</strong> Kelola Katalog</span>
                <i class="fa-solid fa-arrow-right" style="color:var(--muted);"></i>
            </a>
            <a href="<?= base_url('admin/settings') ?>" class="mini-row">
                <span><strong style="color:var(--accent-text);">&rsaquo;03</strong> Pengaturan Web</span>
                <i class="fa-solid fa-arrow-right" style="color:var(--muted);"></i>
            </a>
        </div>
    </div>
</section>

<!-- Bottom Shift / Session Handover Strip -->
<section class="handover" aria-label="Status sesi ruang kendali">
    <div class="handover__meta">
        <span><i class="fa-solid fa-user-shield" style="color:var(--accent-text);margin-right:6px;"></i> Operator: <strong><?= esc(session()->get('admin_nama')) ?></strong></span>
        <span>Status Sistem: <strong style="color:var(--good);">Etalase Online</strong></span>
        <span>Pintasan: <strong>Ctrl+K</strong> Cari &bull; <strong>T</strong> Tema &bull; <strong>?</strong> Bantuan</span>
    </div>

    <div style="display:flex;flex-wrap:wrap;gap:8px;">
        <a href="<?= base_url() ?>" target="_blank" rel="noopener noreferrer" class="orvex-btn">
            <i class="fa-solid fa-arrow-up-right-from-square"></i> Lihat Etalase Publik
        </a>
        <a href="<?= base_url('admin/portfolio/create') ?>" class="orvex-btn orvex-btn--accent">
            <i class="fa-solid fa-plus"></i> Tambah Proyek
        </a>
    </div>
</section>

<script>
    (function () {
        const segBtns = Array.from(document.querySelectorAll('.seg-btn'));
        const radarNodes = Array.from(document.querySelectorAll('.radar-node'));
        const radarArc = document.getElementById('radar-arc');
        const radarPct = document.getElementById('radar-disc-pct');
        const radarLabel = document.getElementById('radar-disc-label');

        const totalCount = <?= (int) $total ?>;
        const readyPct = <?= (int) $readyPct ?>;
        const activePct = <?= (int) $activePct ?>;

        function setArcPercentage(pct, label) {
            if (!radarArc || !radarPct || !radarLabel) return;
            const arcLen = parseFloat(radarArc.dataset.arclen || '471.24');
            const offset = arcLen * (1 - pct / 100);
            radarArc.style.transition = 'stroke-dashoffset 0.55s cubic-bezier(.22, 1, .36, 1)';
            radarArc.setAttribute('stroke-dashoffset', offset.toFixed(2));
            radarPct.textContent = pct + '%';
            radarLabel.textContent = label;
        }

        segBtns.forEach((btn) => {
            btn.addEventListener('click', () => {
                segBtns.forEach((b) => b.classList.remove('is-active'));
                btn.classList.add('is-active');
                const mode = btn.dataset.radarMode;

                radarNodes.forEach((node) => {
                    if (mode === 'all') {
                        node.classList.remove('is-dimmed');
                    } else if (mode === 'ready') {
                        node.classList.toggle('is-dimmed', node.dataset.status !== 'ready');
                    } else if (mode === 'active') {
                        node.classList.toggle('is-dimmed', node.dataset.active !== '1');
                    }
                });

                if (mode === 'all') {
                    setArcPercentage(readyPct, 'Demo Ready');
                } else if (mode === 'ready') {
                    setArcPercentage(readyPct, 'Siap Diuji (' + <?= (int) $readyCount ?> + '/' + totalCount + ')');
                } else if (mode === 'active') {
                    setArcPercentage(activePct, 'Tampil Publik (' + <?= (int) $activeCount ?> + '/' + totalCount + ')');
                }
            });
        });

        /* Live Feed Pause Toggle */
        const pauseBtn = document.getElementById('feed-pause-btn');
        const liveDot = document.querySelector('.live-dot');
        let feedPaused = false;
        if (pauseBtn) {
            pauseBtn.addEventListener('click', () => {
                feedPaused = !feedPaused;
                pauseBtn.innerHTML = feedPaused ? '<i class="fa-solid fa-play"></i>' : '<i class="fa-solid fa-pause"></i>';
                if (liveDot) {
                    liveDot.style.animationPlayState = feedPaused ? 'paused' : 'running';
                    liveDot.style.opacity = feedPaused ? '0.45' : '1';
                }
            });
        }
    })();
</script>

<?= $this->endSection() ?>
