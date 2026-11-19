<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<?php
$portfolios  = $portfolios ?? [];
$total       = count($portfolios);
$readyCount  = 0;
$maintCount  = 0;
$publicCount = 0;
$hiddenCount = 0;

foreach ($portfolios as $item) {
    if (($item['status_demo'] ?? '') === 'ready') {
        $readyCount++;
    } else {
        $maintCount++;
    }
    if ((int) ($item['is_active'] ?? 0) === 1) {
        $publicCount++;
    } else {
        $hiddenCount++;
    }
}
?>

<style>
    .filter-toolbar {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 14px;
    }

    .filter-pills {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 6px;
    }

    .search-wrap {
        position: relative;
        flex: 1 1 260px;
        max-width: 340px;
    }

    .search-wrap i {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--muted);
        pointer-events: none;
    }

    .search-wrap .orvex-input {
        padding-left: 38px;
        min-height: 40px;
    }

    .table-card {
        background-color: var(--card);
        color: var(--ink);
        border-radius: var(--r-xl);
        box-shadow: inset 0 1px 0 var(--top-light), inset 0 0 0 1px var(--line), var(--shadow);
        overflow: hidden;
    }

    .table-scroll {
        width: 100%;
        overflow-x: auto;
    }

    .orvex-table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
    }

    .orvex-table thead th {
        padding: 13px 16px;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: var(--muted);
        background-color: var(--card-2);
        border-bottom: 1px solid var(--line-2);
        white-space: nowrap;
    }

    .orvex-table tbody tr {
        border-bottom: 1px solid var(--line);
        transition: background-color 0.2s ease;
    }

    .orvex-table tbody tr:last-child {
        border-bottom: 0;
    }

    .orvex-table tbody tr:hover {
        background-color: var(--card-2);
    }

    .orvex-table tbody tr.is-attention {
        background-color: var(--peach);
        color: var(--peach-ink);
    }

    .orvex-table tbody tr.is-attention:hover {
        background-color: var(--peach-2);
    }

    .orvex-table td {
        padding: 14px 16px;
        vertical-align: middle;
        font-size: 13.5px;
    }

    .logo-box {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        background-color: #ffffff;
        border: 1px solid var(--line-2);
        padding: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(5, 20, 35, 0.08);
    }

    .logo-box img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .app-title-btn {
        background: transparent;
        border: 0;
        padding: 0;
        margin: 0;
        color: inherit;
        font-size: 14.5px;
        font-weight: 700;
        text-align: left;
        cursor: pointer;
        white-space: normal;
        overflow-wrap: anywhere;
        word-break: break-word;
    }

    .app-title-btn:hover {
        color: var(--accent-text);
        text-decoration: underline;
    }

    .app-excerpt {
        margin: 6px 0 0;
        font-size: 12.5px;
        line-height: 1.55;
        color: var(--muted);
        max-width: 480px;
        white-space: normal;
        overflow-wrap: anywhere;
        word-break: break-word;
    }

    .is-attention .app-excerpt {
        color: var(--peach-muted);
    }

    .action-row {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }

    .link-chip {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        min-height: 32px;
        padding: 0 10px;
        border-radius: 8px;
        background-color: var(--panel);
        border: 1px solid var(--line-2);
        font-size: 12px;
        font-weight: 600;
        color: var(--ink-2);
    }

    .link-chip:hover {
        border-color: var(--accent);
        color: var(--accent-text);
    }

    /* Slide-Over Detail Drawer */
    .drawer-backdrop {
        position: fixed;
        inset: 0;
        z-index: 100;
        background: rgba(5, 14, 24, 0.55);
        backdrop-filter: blur(6px);
        display: none;
        justify-content: flex-end;
    }

    .drawer-backdrop.is-open {
        display: flex;
    }

    .orvex-drawer {
        width: min(500px, 100vw);
        height: 100%;
        background-color: var(--panel);
        color: var(--ink);
        border-left: 1px solid var(--line-2);
        box-shadow: -20px 0 55px rgba(0, 0, 0, 0.35);
        display: flex;
        flex-direction: column;
    }

    .drawer__head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 18px 22px;
        border-bottom: 1px solid var(--line);
        background-color: var(--card);
    }

    .drawer__body {
        flex: 1;
        overflow-y: auto;
        padding: 22px;
        display: grid;
        gap: 18px;
        align-content: start;
    }

    .drawer__meta-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
    }

    .drawer__meta-box {
        background-color: var(--card);
        border: 1px solid var(--line);
        border-radius: var(--r-md);
        padding: 12px;
    }

    .drawer__desc {
        background-color: var(--card);
        border: 1px solid var(--line);
        border-radius: var(--r-lg);
        padding: 16px;
        font-size: 13.5px;
        line-height: 1.6;
        color: var(--ink-2);
    }

    .drawer__desc ul {
        padding-left: 1.25rem;
        margin: 0.4rem 0;
    }

    .drawer__desc ol {
        padding-left: 1.25rem;
        margin: 0.4rem 0;
    }

    .drawer__foot {
        padding: 16px 22px;
        border-top: 1px solid var(--line);
        background-color: var(--card);
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        justify-content: space-between;
    }

    @media (max-width: 820px) {
        .table-scroll {
            overflow-x: hidden;
        }

        .orvex-table,
        .orvex-table tbody {
            display: block;
            width: 100%;
            max-width: 100%;
        }

        .orvex-table thead {
            display: none;
        }

        .orvex-table tbody tr {
            display: flex;
            flex-direction: column;
            gap: 10px;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
            padding: 16px;
        }

        .orvex-table td {
            display: block;
            width: 100%;
            min-width: 0;
            padding: 0;
            text-align: left !important;
        }

        .orvex-table td .logo-box {
            margin: 0 !important;
        }

        .action-row {
            justify-content: flex-start;
            flex-wrap: wrap;
            margin-top: 4px;
        }

        .app-excerpt {
            max-width: 100%;
        }
    }
</style>

<div class="phead">
    <div>
        <h1 class="phead__title">
            <span class="phead__mark">Katalog Portofolio</span>
        </h1>
        <p class="phead__sub tabular-nums">
            <?= $total ?> aplikasi terdaftar &bull; <?= $readyCount ?> ready &bull; <?= $maintCount ?> maintenance &bull; <?= $publicCount ?> publik
        </p>
    </div>

    <a href="<?= base_url('admin/portfolio/create') ?>" class="orvex-btn orvex-btn--accent">
        <i class="fa-solid fa-plus"></i> Tambah Proyek
    </a>
</div>

<div class="filter-toolbar">
    <div class="filter-pills tabular-nums" role="group" aria-label="Filter katalog portofolio">
        <button type="button" class="orvex-pill is-active" data-filter="all">Semua (<?= $total ?>)</button>
        <button type="button" class="orvex-pill" data-filter="ready">Ready (<?= $readyCount ?>)</button>
        <button type="button" class="orvex-pill" data-filter="maintenance">Maintenance (<?= $maintCount ?>)</button>
        <button type="button" class="orvex-pill" data-filter="public">Publik (<?= $publicCount ?>)</button>
        <button type="button" class="orvex-pill" data-filter="hidden">Tersembunyi (<?= $hiddenCount ?>)</button>
    </div>

    <div class="search-wrap">
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="search" id="portfolio-search" class="orvex-input" placeholder="Cari judul atau deskripsi..." aria-label="Cari proyek portofolio">
    </div>
</div>

<div class="table-card">
    <div class="table-scroll">
        <table class="orvex-table">
            <thead>
                <tr>
                    <th style="width:76px;text-align:center;">Ikon</th>
                    <th>Nama Aplikasi &amp; Deskripsi</th>
                    <th>Tautan</th>
                    <th>Demo Status</th>
                    <th style="text-align:center;">Urutan &amp; Visibilitas</th>
                    <th style="text-align:center;">Aksi</th>
                </tr>
            </thead>
            <tbody id="portfolio-tbody">
                <?php if (!empty($portfolios)): ?>
                    <?php foreach ($portfolios as $p): ?>
                        <?php
                        $isReady  = ($p['status_demo'] ?? '') === 'ready';
                        $isActive = (int) ($p['is_active'] ?? 0) === 1;
                        $needsAttention = !$isReady || !$isActive;
                        ?>
                        <tr
                            class="portfolio-row <?= $needsAttention ? 'is-attention' : '' ?>"
                            data-status="<?= esc($p['status_demo']) ?>"
                            data-active="<?= $isActive ? '1' : '0' ?>"
                            data-search="<?= esc(strtolower($p['judul'] . ' ' . strip_tags($p['deskripsi']))) ?>">
                            <td style="text-align:center;">
                                <div class="logo-box" style="margin:0 auto;">
                                    <img src="<?= base_url('uploads/portfolios/' . esc($p['logo'])) ?>" alt="Logo <?= esc($p['judul']) ?>">
                                </div>
                            </td>

                            <td>
                                <button
                                    type="button"
                                    class="app-title-btn js-inspect-row"
                                    data-id="<?= (int) $p['id'] ?>"
                                    data-judul="<?= esc($p['judul']) ?>"
                                    data-logo="<?= base_url('uploads/portfolios/' . esc($p['logo'])) ?>"
                                    data-status="<?= esc($p['status_demo']) ?>"
                                    data-active="<?= $isActive ? '1' : '0' ?>"
                                    data-urutan="<?= (int) $p['urutan'] ?>"
                                    data-github="<?= esc($p['link_github']) ?>"
                                    data-demo="<?= esc($p['link_demo']) ?>"
                                    data-edit-url="<?= base_url('admin/portfolio/edit/' . $p['id']) ?>"
                                    data-toggle-url="<?= base_url('admin/portfolio/toggle/' . $p['id']) ?>">
                                    <?= esc($p['judul']) ?>
                                </button>
                                <p class="app-excerpt"><?= esc(strip_tags($p['deskripsi'])) ?></p>
                                <template id="tpl-desc-<?= (int) $p['id'] ?>"><?= $p['deskripsi'] ?></template>
                            </td>

                            <td>
                                <div style="display:flex;flex-wrap:wrap;gap:6px;">
                                    <a href="<?= esc($p['link_github']) ?>" target="_blank" rel="noopener noreferrer" class="link-chip">
                                        <i class="fa-brands fa-github"></i> GitHub
                                    </a>
                                    <?php if (!empty($p['link_demo']) && $p['link_demo'] !== '#'): ?>
                                        <a href="<?= esc($p['link_demo']) ?>" target="_blank" rel="noopener noreferrer" class="link-chip">
                                            <i class="fa-solid fa-arrow-up-right-from-square"></i> Demo
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </td>

                            <td>
                                <span class="badge <?= $isReady ? 'badge--good' : 'badge--warn' ?>">
                                    <i class="fa-solid fa-circle" style="font-size:7px;"></i>
                                    <?= $isReady ? 'Ready' : 'Maintenance' ?>
                                </span>
                            </td>

                            <td style="text-align:center;" class="tabular-nums">
                                <div style="display:inline-flex;align-items:center;gap:8px;">
                                    <span class="badge badge--info">#<?= (int) $p['urutan'] ?></span>
                                    <span class="badge <?= $isActive ? 'badge--good' : 'badge--bad' ?>">
                                        <?= $isActive ? 'Publik' : 'Tersembunyi' ?>
                                    </span>
                                </div>
                            </td>

                            <td>
                                <div class="action-row">
                                    <button
                                        type="button"
                                        class="orvex-btn orvex-btn--icon js-inspect-trigger"
                                        data-id="<?= (int) $p['id'] ?>"
                                        title="Inspeksi detail proyek"
                                        aria-label="Inspeksi <?= esc($p['judul']) ?>">
                                        <i class="fa-solid fa-magnifying-glass-plus"></i>
                                    </button>
                                    <a
                                        href="<?= base_url('admin/portfolio/toggle/' . $p['id']) ?>"
                                        class="orvex-btn orvex-btn--icon"
                                        title="<?= $isActive ? 'Sembunyikan dari Publik' : 'Tampilkan ke Publik' ?>"
                                        aria-label="<?= $isActive ? 'Sembunyikan' : 'Tampilkan' ?> <?= esc($p['judul']) ?>">
                                        <i class="fa-solid <?= $isActive ? 'fa-eye' : 'fa-eye-slash' ?>"></i>
                                    </a>
                                    <a
                                        href="<?= base_url('admin/portfolio/edit/' . $p['id']) ?>"
                                        class="orvex-btn orvex-btn--icon"
                                        title="Edit proyek"
                                        aria-label="Edit <?= esc($p['judul']) ?>">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <button
                                        type="button"
                                        onclick="deleteConfirm('<?= (int) $p['id'] ?>', '<?= esc($p['judul'], 'js') ?>')"
                                        class="orvex-btn orvex-btn--icon orvex-btn--danger"
                                        title="Hapus proyek"
                                        aria-label="Hapus <?= esc($p['judul']) ?>">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <tr id="portfolio-no-match" hidden>
                        <td colspan="6" style="padding:36px;text-align:center;color:var(--muted);">
                            Tidak ada proyek yang sesuai dengan filter atau pencarian Anda.
                        </td>
                    </tr>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="padding:42px;text-align:center;color:var(--muted);">
                            Belum ada data proyek aplikasi. Klik tombol <strong>Tambah Proyek</strong> untuk mengisi katalog.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Slide-Over Detail Drawer -->
<div class="drawer-backdrop" id="portfolio-drawer-backdrop" role="dialog" aria-modal="true" aria-labelledby="drawer-title">
    <aside class="orvex-drawer">
        <div class="drawer__head">
            <div style="display:flex;align-items:center;gap:12px;min-width:0;">
                <div class="logo-box" style="width:44px;height:44px;flex-shrink:0;">
                    <img id="drawer-logo" src="" alt="Logo Aplikasi">
                </div>
                <div style="min-width:0;">
                    <div style="font-size:11px;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:var(--muted);">
                        Inspeksi Portofolio
                    </div>
                    <h2 id="drawer-title" style="margin:2px 0 0;font-size:17px;font-weight:700;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;"></h2>
                </div>
            </div>
            <button type="button" class="orvex-btn orvex-btn--icon" id="drawer-close-btn" aria-label="Tutup panel detail">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <div class="drawer__body">
            <div class="drawer__meta-grid tabular-nums">
                <div class="drawer__meta-box">
                    <span class="field-label">Status Demo</span>
                    <div id="drawer-status"></div>
                </div>
                <div class="drawer__meta-box">
                    <span class="field-label">Visibilitas &amp; Urutan</span>
                    <div id="drawer-vis"></div>
                </div>
            </div>

            <div>
                <span class="field-label">Tautan Eksternal</span>
                <div style="display:flex;flex-wrap:wrap;gap:8px;">
                    <a id="drawer-github" href="#" target="_blank" rel="noopener noreferrer" class="orvex-btn">
                        <i class="fa-brands fa-github"></i> Repositori GitHub
                    </a>
                    <a id="drawer-demo" href="#" target="_blank" rel="noopener noreferrer" class="orvex-btn">
                        <i class="fa-solid fa-laptop-code"></i> URL Aplikasi Demo
                    </a>
                </div>
            </div>

            <div>
                <span class="field-label">Deskripsi Lengkap</span>
                <div class="drawer__desc" id="drawer-desc"></div>
            </div>
        </div>

        <div class="drawer__foot">
            <a id="drawer-toggle-link" href="#" class="orvex-btn">
                <i class="fa-solid fa-eye"></i> Ubah Visibilitas
            </a>
            <a id="drawer-edit-link" href="#" class="orvex-btn orvex-btn--accent">
                <i class="fa-solid fa-pen-to-square"></i> Edit Proyek
            </a>
        </div>
    </aside>
</div>

<script>
    (function () {
        const pills = Array.from(document.querySelectorAll('.filter-pills .orvex-pill'));
        const searchInput = document.getElementById('portfolio-search');
        const rows = Array.from(document.querySelectorAll('.portfolio-row'));
        const noMatchRow = document.getElementById('portfolio-no-match');
        let activeFilter = 'all';

        function applyFilters() {
            if (rows.length === 0) return;
            const query = (searchInput ? searchInput.value : '').trim().toLowerCase();
            let shown = 0;

            rows.forEach((row) => {
                const status = row.dataset.status;
                const isActive = row.dataset.active === '1';
                let filterMatch = true;

                if (activeFilter === 'ready') filterMatch = status === 'ready';
                else if (activeFilter === 'maintenance') filterMatch = status !== 'ready';
                else if (activeFilter === 'public') filterMatch = isActive;
                else if (activeFilter === 'hidden') filterMatch = !isActive;

                const textMatch = !query || (row.dataset.search || '').includes(query);
                const visible = filterMatch && textMatch;
                row.style.display = visible ? '' : 'none';
                if (visible) shown++;
            });

            if (noMatchRow) {
                noMatchRow.hidden = shown > 0;
            }
        }

        pills.forEach((pill) => {
            pill.addEventListener('click', () => {
                pills.forEach((p) => p.classList.remove('is-active'));
                pill.classList.add('is-active');
                activeFilter = pill.dataset.filter || 'all';
                applyFilters();
            });
        });

        if (searchInput) {
            searchInput.addEventListener('input', applyFilters);
        }

        /* Slide-Over Detail Drawer */
        const backdrop = document.getElementById('portfolio-drawer-backdrop');
        const closeBtn = document.getElementById('drawer-close-btn');
        const shell = document.getElementById('orvex-shell');

        function openDrawerForRow(btn) {
            if (!backdrop || !btn) return;
            const id = btn.dataset.id;
            const tpl = document.getElementById('tpl-desc-' + id);

            document.getElementById('drawer-title').textContent = btn.dataset.judul || '';
            document.getElementById('drawer-logo').src = btn.dataset.logo || '';
            document.getElementById('drawer-edit-link').href = btn.dataset.editUrl || '#';
            document.getElementById('drawer-toggle-link').href = btn.dataset.toggleUrl || '#';
            document.getElementById('drawer-github').href = btn.dataset.github || '#';
            document.getElementById('drawer-demo').href = btn.dataset.demo || '#';

            const isReady = btn.dataset.status === 'ready';
            document.getElementById('drawer-status').innerHTML = isReady
                ? '<span class="badge badge--good">Ready</span>'
                : '<span class="badge badge--warn">Maintenance</span>';

            const isActive = btn.dataset.active === '1';
            document.getElementById('drawer-vis').innerHTML =
                '<span class="badge badge--info" style="margin-right:6px;">#' + (btn.dataset.urutan || '0') + '</span>' +
                (isActive ? '<span class="badge badge--good">Publik</span>' : '<span class="badge badge--bad">Tersembunyi</span>');

            const descBox = document.getElementById('drawer-desc');
            descBox.innerHTML = '';
            if (tpl) {
                descBox.appendChild(tpl.content.cloneNode(true));
            }

            backdrop.classList.add('is-open');
            if (shell) shell.setAttribute('inert', '');
            if (closeBtn) closeBtn.focus();
        }

        function closeDrawer() {
            if (!backdrop) return;
            backdrop.classList.remove('is-open');
            if (shell) shell.removeAttribute('inert');
        }

        document.querySelectorAll('.js-inspect-row').forEach((btn) => {
            btn.addEventListener('click', () => openDrawerForRow(btn));
        });

        document.querySelectorAll('.js-inspect-trigger').forEach((btn) => {
            btn.addEventListener('click', () => {
                const row = btn.closest('tr');
                const titleBtn = row ? row.querySelector('.js-inspect-row') : null;
                openDrawerForRow(titleBtn);
            });
        });

        if (closeBtn) closeBtn.addEventListener('click', closeDrawer);
        if (backdrop) {
            backdrop.addEventListener('click', (e) => {
                if (e.target === backdrop) closeDrawer();
            });
        }
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeDrawer();
        });
    })();

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

    function deleteConfirm(id, title) {
        Swal.fire({
            title: 'Hapus Proyek?',
            text: "Aplikasi '" + title + "' akan dihapus permanen.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?= base_url('admin/portfolio/delete/') ?>/" + id;
            }
        });
    }
</script>

<?= $this->endSection() ?>
