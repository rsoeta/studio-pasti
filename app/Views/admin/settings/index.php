<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<style>
    .settings-grid {
        display: grid;
        grid-template-columns: 320px minmax(0, 1fr);
        gap: 18px;
        align-items: start;
    }

    .settings-side {
        display: grid;
        gap: 14px;
    }

    .theme-cards {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
        margin-top: 10px;
    }

    .theme-opt {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
        padding: 12px;
        border-radius: var(--r-md);
        border: 1.5px solid var(--line-2);
        background-color: var(--panel);
        color: var(--ink);
        cursor: pointer;
        text-align: left;
        transition: border-color 0.2s ease, transform 0.2s var(--ease);
    }

    .theme-opt:hover {
        transform: translateY(-1px);
        border-color: var(--accent);
    }

    .theme-opt.is-selected {
        border-color: var(--accent);
        background-color: var(--peach);
        color: var(--peach-ink);
    }

    .theme-swatch {
        width: 100%;
        height: 28px;
        border-radius: 6px;
        border: 1px solid var(--line);
        display: flex;
        overflow: hidden;
    }

    .settings-form-stack {
        display: grid;
        gap: 18px;
    }

    .settings-row-2 {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 14px;
    }

    .input-icon-wrap {
        position: relative;
    }

    .input-icon-wrap i {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--muted);
        pointer-events: none;
    }

    .input-icon-wrap .orvex-input {
        padding-left: 40px;
    }

    @media (max-width: 960px) {
        .settings-grid,
        .settings-row-2,
        .security-grid {
            grid-template-columns: 1fr;
        }
    }

    .security-grid {
        margin-top: 18px;
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px;
        align-items: start;
    }

    .security-grid > .orvex-card {
        min-width: 0;
    }

    .whitelist-list {
        display: grid;
        gap: 10px;
        margin-top: 14px;
        margin-bottom: 18px;
    }

    .whitelist-item {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        padding: 12px 14px;
        border-radius: var(--r-md);
        background-color: var(--panel);
        border: 1px solid var(--line);
    }

    .copy-box {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-top: 6px;
    }

    .copy-box .orvex-input {
        font-size: 12px;
        min-height: 40px;
        background-color: var(--card-2);
    }

    .web-logo-panel {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 18px;
        padding-bottom: 18px;
        border-bottom: 1px solid var(--line);
    }

    .web-logo-stage {
        position: relative;
        width: 112px;
        height: 112px;
        flex-shrink: 0;
        border-radius: var(--r-lg);
        border: 2px dashed var(--line-2);
        background-color: var(--panel);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 10px;
        cursor: pointer;
        overflow: hidden;
        transition: border-color 0.2s ease, transform 0.2s var(--ease);
    }

    .web-logo-stage:hover {
        border-color: var(--accent);
        transform: translateY(-1px);
    }

    .web-logo-stage img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        border-radius: 10px;
    }

    .web-logo-meta {
        flex: 1 1 240px;
        min-width: 0;
    }

    .web-logo-actions {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 8px;
        margin-top: 10px;
    }

    .summary-brand-row {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-top: 8px;
    }

    .summary-logo-box {
        width: 48px;
        height: 48px;
        flex-shrink: 0;
        border-radius: 12px;
        background-color: rgba(255, 255, 255, 0.72);
        border: 1px solid rgba(168, 74, 8, 0.16);
        padding: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .summary-logo-box img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        border-radius: 8px;
    }
</style>

<?php
$logoUrl       = $logoUrl ?? \App\Models\WebSettingModel::getLogoUrl($settings ?? null);
$hasCustomLogo = $hasCustomLogo ?? \App\Models\WebSettingModel::hasCustomLogo($settings ?? null);
?>

<div class="phead">
    <div>
        <h1 class="phead__title">
            <span class="phead__mark">Pengaturan Website</span>
        </h1>
        <p class="phead__sub">Ubah profil agensi, nomor kontak WhatsApp, dan teks utama untuk Landing Page publik Anda.</p>
    </div>

    <a href="<?= base_url() ?>" target="_blank" rel="noopener noreferrer" class="orvex-btn">
        <i class="fa-solid fa-arrow-up-right-from-square"></i> Pratinjau Landing Page
    </a>
</div>

<div class="settings-grid">
    <!-- Left Column: Live Summary + Appearance Switcher -->
    <div class="settings-side">
        <div class="orvex-card orvex-card--peach orvex-card--sm">
            <div style="font-size:11px;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:var(--peach-muted);">
                Ringkasan Etalase Aktif
            </div>
            <div class="summary-brand-row">
                <div class="summary-logo-box">
                    <img id="live-preview-logo-summary" src="<?= esc($logoUrl) ?>" alt="Logo <?= esc($settings['nama_web']) ?>">
                </div>
                <h2 style="margin:0;font-size:18px;font-weight:700;min-width:0;overflow-wrap:anywhere;" id="live-preview-brand">
                    <?= esc($settings['nama_web']) ?>
                </h2>
            </div>
            <p style="margin:8px 0 0;font-size:12.5px;color:var(--peach-muted);line-height:1.5;" id="live-preview-hero">
                <?= esc($settings['teks_hero_judul']) ?>
            </p>
            <div style="margin-top:12px;padding-top:12px;border-top:1px solid rgba(168,74,8,0.16);display:flex;align-items:center;justify-content:space-between;font-size:12px;">
                <span>WhatsApp Target</span>
                <strong class="tabular-nums"><?= esc($settings['nomor_wa']) ?></strong>
            </div>
        </div>

        <div class="orvex-card orvex-card--sm">
            <h2 class="ctitle">Tampilan Ruang Kendali</h2>
            <p style="margin:4px 0 0;font-size:12px;color:var(--muted);">
                Pilih mode tema Panel Admin (tersimpan di browser).
            </p>

            <div class="theme-cards">
                <button type="button" class="theme-opt" data-theme-pick="light">
                    <div class="theme-swatch">
                        <span style="width:35%;background:#24425f;"></span>
                        <span style="width:45%;background:#eef3f7;"></span>
                        <span style="width:20%;background:#f37a1f;"></span>
                    </div>
                    <strong style="font-size:12.5px;"><i class="fa-solid fa-sun"></i> Light</strong>
                </button>
                <button type="button" class="theme-opt" data-theme-pick="dark">
                    <div class="theme-swatch">
                        <span style="width:35%;background:#0d1721;"></span>
                        <span style="width:45%;background:#172331;"></span>
                        <span style="width:20%;background:#f7862e;"></span>
                    </div>
                    <strong style="font-size:12.5px;"><i class="fa-solid fa-moon"></i> Dark</strong>
                </button>
            </div>
        </div>
    </div>

    <!-- Right Column: Configuration Form -->
    <div class="orvex-card">
        <form action="<?= base_url('admin/settings/update') ?>" method="POST" enctype="multipart/form-data" class="settings-form-stack">
            <?= csrf_field() ?>

            <input type="hidden" name="id" value="<?= $settings['id'] ?>">

            <div class="web-logo-panel">
                <div class="web-logo-stage" id="web-logo-stage" title="Klik untuk memilih file logo baru">
                    <img id="preview-web-logo" src="<?= esc($logoUrl) ?>" alt="Logo <?= esc($settings['nama_web']) ?>">
                </div>

                <div class="web-logo-meta">
                    <div style="display:flex;flex-wrap:wrap;align-items:center;gap:8px;">
                        <label for="logo-file-input" class="field-label" style="margin:0;">Logo Website</label>
                        <span class="badge <?= $hasCustomLogo ? 'badge--good' : 'badge--info' ?>">
                            <?= $hasCustomLogo ? 'Logo Kustom' : 'Logo Default' ?>
                        </span>
                    </div>
                    <p style="margin:6px 0 0;font-size:12px;color:var(--muted);line-height:1.5;">
                        Ditampilkan di Navbar, Hero Emblem, Footer, Favicon, dan Panel Admin. Format PNG, JPG, atau WebP (rasio 1:1 direkomendasikan, maks. 2MB).
                    </p>

                    <input type="file" id="logo-file-input" name="logo" accept="image/png,image/jpeg,image/webp" hidden>

                    <div class="web-logo-actions">
                        <label for="logo-file-input" class="orvex-btn" style="cursor:pointer;">
                            <i class="fa-solid fa-image"></i> Pilih Logo Baru
                        </label>
                        <button type="button" id="cancel-logo-pick" class="orvex-btn" hidden>
                            <i class="fa-solid fa-rotate-left"></i> Batal Pilih
                        </button>
                        <?php if ($hasCustomLogo): ?>
                            <button type="button" onclick="confirmResetLogo()" class="orvex-btn orvex-btn--danger">
                                <i class="fa-solid fa-trash-can"></i> Reset Default
                            </button>
                        <?php endif; ?>
                    </div>

                    <div id="logo-file-name" style="margin-top:8px;font-size:11.5px;color:var(--muted);">
                        Belum ada file baru dipilih. Klik Simpan Konfigurasi setelah memilih logo.
                    </div>
                </div>
            </div>

            <div class="settings-row-2">
                <div>
                    <label for="nama_web" class="field-label">Nama Brand / Agensi</label>
                    <div class="input-icon-wrap">
                        <i class="fa-solid fa-building"></i>
                        <input type="text" id="nama_web" name="nama_web" value="<?= esc($settings['nama_web']) ?>" required class="orvex-input">
                    </div>
                </div>

                <div>
                    <label for="nomor_wa" class="field-label">Nomor WhatsApp Target</label>
                    <div class="input-icon-wrap">
                        <i class="fa-brands fa-whatsapp"></i>
                        <input type="number" id="nomor_wa" name="nomor_wa" value="<?= esc($settings['nomor_wa']) ?>" required placeholder="Contoh: 6281234567890" class="orvex-input tabular-nums">
                    </div>
                    <p style="font-size:11px;color:var(--muted);margin:6px 0 0;">*Gunakan awalan 62 (tanpa + atau 0) untuk integrasi link wa.me</p>
                </div>
            </div>

            <div style="border-top:1px solid var(--line);padding-top:18px;">
                <label for="teks_hero_judul" class="field-label">Teks Judul Utama (Hero Section)</label>
                <input type="text" id="teks_hero_judul" name="teks_hero_judul" value="<?= esc($settings['teks_hero_judul']) ?>" required class="orvex-input">
            </div>

            <div>
                <label for="teks_hero_deskripsi" class="field-label">Teks Deskripsi / Slogan (Hero Section)</label>
                <textarea id="teks_hero_deskripsi" name="teks_hero_deskripsi" rows="3" required class="orvex-textarea"><?= esc($settings['teks_hero_deskripsi']) ?></textarea>
            </div>

            <div style="border-top:1px solid var(--line);padding-top:18px;">
                <label for="teks_footer" class="field-label">Teks Hak Cipta (Footer)</label>
                <input type="text" id="teks_footer" name="teks_footer" value="<?= esc($settings['teks_footer']) ?>" required class="orvex-input">
            </div>

            <div style="display:flex;justify-content:flex-end;padding-top:6px;">
                <button type="submit" class="orvex-btn orvex-btn--accent">
                    <i class="fa-solid fa-cloud-arrow-up"></i> Simpan Konfigurasi
                </button>
            </div>
        </form>

        <form id="reset-logo-form" action="<?= base_url('admin/settings/logo/reset') ?>" method="POST" hidden>
            <?= csrf_field() ?>
        </form>
    </div>
</div>

<?php
$security = $security ?? [
    'turnstile_site_key'   => '',
    'turnstile_secret_key' => '',
    'google_client_id'     => '',
    'google_client_secret' => '',
];
$admins         = $admins ?? [];
$turnstileReady = !empty($security['turnstile_site_key']) && !empty($security['turnstile_secret_key']);
$googleReady    = !empty($security['google_client_id']) && !empty($security['google_client_secret']);
?>

<!-- Security & Google OAuth Whitelist Grid -->
<div class="security-grid">
    <!-- Whitelist Google OAuth Admin -->
    <section class="orvex-card" aria-label="Whitelist Google OAuth Admin">
        <div style="display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:10px;">
            <div>
                <h2 class="ctitle" style="font-size:16px;">Whitelist Google OAuth Admin</h2>
                <p style="margin:4px 0 0;font-size:12px;color:var(--muted);">
                    Hanya akun Google dengan email di daftar ini yang dapat masuk ke Panel Admin.
                </p>
            </div>
            <span class="badge badge--info tabular-nums"><?= count($admins) ?> Akun</span>
        </div>

        <div class="whitelist-list">
            <?php foreach ($admins as $adm): ?>
                <?php $isSelf = (int) $adm['id'] === (int) session()->get('admin_id'); ?>
                <div class="whitelist-item">
                    <div style="min-width:0;flex:1 1 200px;">
                        <div style="font-weight:700;font-size:13.5px;display:flex;align-items:center;gap:8px;flex-wrap:wrap;">
                            <span><?= esc($adm['nama_lengkap']) ?></span>
                            <?php if ($isSelf): ?>
                                <span class="badge badge--good">Sesi Aktif</span>
                            <?php endif; ?>
                        </div>
                        <div style="font-size:12px;color:var(--muted);margin-top:2px;overflow-wrap:anywhere;">
                            <i class="fa-solid fa-envelope" style="margin-right:4px;"></i><?= esc($adm['email']) ?>
                            &bull; @<?= esc($adm['username']) ?>
                        </div>
                    </div>

                    <?php if (!$isSelf && count($admins) > 1): ?>
                        <button
                            type="button"
                            onclick="confirmDeleteAdmin('<?= (int) $adm['id'] ?>', '<?= esc($adm['email'], 'js') ?>')"
                            class="orvex-btn orvex-btn--icon orvex-btn--danger"
                            title="Hapus dari Whitelist"
                            aria-label="Hapus <?= esc($adm['email']) ?>">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>

        <form action="<?= base_url('admin/settings/whitelist/store') ?>" method="POST" class="settings-form-stack" style="border-top:1px solid var(--line);padding-top:16px;">
            <?= csrf_field() ?>
            <h3 class="ctitle" style="font-size:13.5px;">Tambah Email Google ke Whitelist</h3>

            <div class="settings-row-2">
                <div>
                    <label for="wl-nama" class="field-label">Nama Lengkap</label>
                    <input type="text" id="wl-nama" name="nama_lengkap" required class="orvex-input" placeholder="Contoh: Rian Sutarsa">
                </div>
                <div>
                    <label for="wl-email" class="field-label">Email Google</label>
                    <input type="email" id="wl-email" name="email" required class="orvex-input" placeholder="nama@gmail.com">
                </div>
            </div>

            <div class="settings-row-2">
                <div>
                    <label for="wl-user" class="field-label">Username (Opsional)</label>
                    <input type="text" id="wl-user" name="username" class="orvex-input" placeholder="Otomatis dari email">
                </div>
                <div>
                    <label for="wl-pass" class="field-label">Kata Sandi (Opsional)</label>
                    <input type="password" id="wl-pass" name="password" class="orvex-input" placeholder="Kosongkan jika khusus Google">
                </div>
            </div>

            <div style="display:flex;justify-content:flex-end;">
                <button type="submit" class="orvex-btn orvex-btn--accent">
                    <i class="fa-solid fa-user-plus"></i> Tambah ke Whitelist
                </button>
            </div>
        </form>
    </section>

    <!-- Cloudflare Turnstile & Google OAuth Keys -->
    <section class="orvex-card" aria-label="Konfigurasi Keamanan Login">
        <div style="display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:10px;margin-bottom:14px;">
            <div>
                <h2 class="ctitle" style="font-size:16px;">Keamanan Login &amp; Anti-Bot</h2>
                <p style="margin:4px 0 0;font-size:12px;color:var(--muted);">
                    Integrasi Cloudflare Turnstile dan kredensial Google OAuth 2.0.
                </p>
            </div>
            <div style="display:flex;gap:6px;flex-wrap:wrap;">
                <span class="badge <?= $turnstileReady ? 'badge--good' : 'badge--warn' ?>">
                    Turnstile: <?= $turnstileReady ? 'Aktif' : 'Belum Diisi' ?>
                </span>
                <span class="badge <?= $googleReady ? 'badge--good' : 'badge--warn' ?>">
                    Google: <?= $googleReady ? 'Aktif' : 'Belum Diisi' ?>
                </span>
            </div>
        </div>

        <form action="<?= base_url('admin/settings/security') ?>" method="POST" class="settings-form-stack">
            <?= csrf_field() ?>

            <div>
                <label for="turnstile_site_key" class="field-label">Cloudflare Turnstile Site Key</label>
                <input type="text" id="turnstile_site_key" name="turnstile_site_key" value="<?= esc($security['turnstile_site_key']) ?>" class="orvex-input" placeholder="0x4AAAAAAA...">
            </div>

            <div>
                <label for="turnstile_secret_key" class="field-label">Cloudflare Turnstile Secret Key</label>
                <input type="password" id="turnstile_secret_key" name="turnstile_secret_key" value="<?= esc($security['turnstile_secret_key']) ?>" class="orvex-input" placeholder="0x4AAAAAAA...">
            </div>

            <div style="border-top:1px solid var(--line);padding-top:14px;">
                <label for="google_client_id" class="field-label">Google OAuth Client ID</label>
                <input type="text" id="google_client_id" name="google_client_id" value="<?= esc($security['google_client_id']) ?>" class="orvex-input" placeholder="xxxx.apps.googleusercontent.com">
            </div>

            <div>
                <label for="google_client_secret" class="field-label">Google OAuth Client Secret</label>
                <input type="password" id="google_client_secret" name="google_client_secret" value="<?= esc($security['google_client_secret']) ?>" class="orvex-input" placeholder="GOCSPX-...">
            </div>

            <div>
                <span class="field-label">Authorized Redirect URI (Salin ke Google Cloud Console)</span>
                <div class="copy-box">
                    <input type="text" id="oauth-redirect-uri" readonly value="<?= esc(base_url('auth/google/callback')) ?>" class="orvex-input">
                    <button type="button" onclick="copyRedirectUri()" class="orvex-btn" style="min-height:40px;flex-shrink:0;">
                        <i class="fa-solid fa-copy"></i> Salin
                    </button>
                </div>
            </div>

            <div style="display:flex;justify-content:flex-end;padding-top:4px;">
                <button type="submit" class="orvex-btn orvex-btn--accent">
                    <i class="fa-solid fa-shield-halved"></i> Simpan Keamanan Login
                </button>
            </div>
        </form>
    </section>
</div>

<script>
    (function () {
        const themeBtns = Array.from(document.querySelectorAll('.theme-opt'));
        function syncThemeCards() {
            const cur = document.documentElement.getAttribute('data-theme') || 'light';
            themeBtns.forEach((btn) => {
                btn.classList.toggle('is-selected', btn.dataset.themePick === cur);
            });
        }
        syncThemeCards();
        window.addEventListener('orvex-theme-change', syncThemeCards);

        themeBtns.forEach((btn) => {
            btn.addEventListener('click', () => {
                if (typeof window.setOrvexTheme === 'function') {
                    window.setOrvexTheme(btn.dataset.themePick);
                }
            });
        });

        /* Live Preview Updates */
        const brandInput = document.getElementById('nama_web');
        const heroInput = document.getElementById('teks_hero_judul');
        const brandPreview = document.getElementById('live-preview-brand');
        const heroPreview = document.getElementById('live-preview-hero');

        if (brandInput && brandPreview) {
            brandInput.addEventListener('input', () => {
                brandPreview.textContent = brandInput.value || 'Studio PASTI';
            });
        }
        if (heroInput && heroPreview) {
            heroInput.addEventListener('input', () => {
                heroPreview.textContent = heroInput.value || '';
            });
        }

        /* Logo Upload Preview & Validation */
        const logoStage = document.getElementById('web-logo-stage');
        const logoInput = document.getElementById('logo-file-input');
        const logoPreview = document.getElementById('preview-web-logo');
        const logoSummaryPreview = document.getElementById('live-preview-logo-summary');
        const logoCancelBtn = document.getElementById('cancel-logo-pick');
        const logoFileName = document.getElementById('logo-file-name');
        const originalLogoSrc = '<?= esc($logoUrl, 'js') ?>';
        const defaultLogoHint = 'Belum ada file baru dipilih. Klik Simpan Konfigurasi setelah memilih logo.';
        const allowedLogoTypes = ['image/png', 'image/jpeg', 'image/webp'];
        const maxLogoBytes = 2 * 1024 * 1024;

        function resetLogoSelection() {
            if (logoInput) {
                logoInput.value = '';
            }
            if (logoPreview) {
                logoPreview.src = originalLogoSrc;
            }
            if (logoSummaryPreview) {
                logoSummaryPreview.src = originalLogoSrc;
            }
            if (logoCancelBtn) {
                logoCancelBtn.hidden = true;
            }
            if (logoFileName) {
                logoFileName.textContent = defaultLogoHint;
            }
        }

        if (logoStage && logoInput) {
            logoStage.addEventListener('click', () => {
                logoInput.click();
            });
        }

        if (logoCancelBtn) {
            logoCancelBtn.addEventListener('click', resetLogoSelection);
        }

        if (logoInput) {
            logoInput.addEventListener('change', (event) => {
                const file = event.target.files && event.target.files[0];
                if (!file) {
                    resetLogoSelection();
                    return;
                }

                if (!allowedLogoTypes.includes(file.type)) {
                    resetLogoSelection();
                    Swal.fire({
                        title: 'Format Tidak Didukung',
                        text: 'Pilih file gambar berformat PNG, JPG, atau WebP.',
                        icon: 'warning',
                        confirmButtonText: 'Tutup'
                    });
                    return;
                }

                if (file.size > maxLogoBytes) {
                    resetLogoSelection();
                    Swal.fire({
                        title: 'Ukuran File Terlalu Besar',
                        text: 'Ukuran file logo maksimal 2MB.',
                        icon: 'warning',
                        confirmButtonText: 'Tutup'
                    });
                    return;
                }

                const reader = new FileReader();
                reader.onload = function () {
                    if (logoPreview) {
                        logoPreview.src = reader.result;
                    }
                    if (logoSummaryPreview) {
                        logoSummaryPreview.src = reader.result;
                    }
                    if (logoCancelBtn) {
                        logoCancelBtn.hidden = false;
                    }
                    if (logoFileName) {
                        const kb = Math.max(1, Math.round(file.size / 1024));
                        logoFileName.textContent = 'File dipilih: ' + file.name + ' (' + kb + ' KB) — klik Simpan Konfigurasi untuk menerapkan.';
                    }
                };
                reader.readAsDataURL(file);
            });
        }
    })();

    function confirmResetLogo() {
        Swal.fire({
            title: 'Kembalikan ke Logo Default?',
            text: 'Logo kustom saat ini akan dihapus dan diganti kembali dengan logo bawaan sistem.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Reset Default',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.getElementById('reset-logo-form');
                if (form) {
                    form.submit();
                }
            }
        });
    }

    <?php if (session()->getFlashdata('success')) : ?>
        Swal.fire({
            title: 'Berhasil',
            text: '<?= esc(session()->getFlashdata('success'), 'js') ?>',
            icon: 'success',
            confirmButtonText: 'Tutup'
        });
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')) : ?>
        Swal.fire({
            title: 'Gagal',
            text: '<?= esc(session()->getFlashdata('error'), 'js') ?>',
            icon: 'error',
            confirmButtonText: 'Tutup'
        });
    <?php endif; ?>

    function confirmDeleteAdmin(id, email) {
        Swal.fire({
            title: 'Hapus Akses Whitelist?',
            text: "Email '" + email + "' tidak akan bisa login lagi ke Panel Admin.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?= base_url('admin/settings/whitelist/delete/') ?>/" + id;
            }
        });
    }

    function copyRedirectUri() {
        const input = document.getElementById('oauth-redirect-uri');
        if (!input) return;
        input.select();
        if (navigator.clipboard && navigator.clipboard.writeText) {
            navigator.clipboard.writeText(input.value);
        } else {
            document.execCommand('copy');
        }
        Swal.fire({
            title: 'Disalin',
            text: 'Authorized Redirect URI berhasil disalin ke clipboard.',
            icon: 'success',
            confirmButtonText: 'Tutup'
        });
    }
</script>

<?= $this->endSection() ?>
