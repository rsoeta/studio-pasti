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
        .settings-row-2 {
            grid-template-columns: 1fr;
        }
    }
</style>

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
            <h2 style="margin:6px 0 0;font-size:18px;font-weight:700;" id="live-preview-brand">
                <?= esc($settings['nama_web']) ?>
            </h2>
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
        <form action="<?= base_url('admin/settings/update') ?>" method="POST" class="settings-form-stack">
            <?= csrf_field() ?>

            <input type="hidden" name="id" value="<?= $settings['id'] ?>">

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
    </div>
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
    })();

    <?php if (session()->getFlashdata('success')) : ?>
        Swal.fire({
            title: 'Berhasil',
            text: '<?= esc(session()->getFlashdata('success'), 'js') ?>',
            icon: 'success',
            confirmButtonText: 'Tutup'
        });
    <?php endif; ?>
</script>

<?= $this->endSection() ?>
