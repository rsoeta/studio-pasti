<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<style>
    .form-grid {
        display: grid;
        grid-template-columns: 280px minmax(0, 1fr);
        gap: 28px;
        align-items: start;
    }

    .form-fields {
        display: grid;
        gap: 18px;
    }

    .form-row-2 {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 14px;
    }

    .upload-stage {
        position: relative;
        width: 100%;
        aspect-ratio: 1 / 1;
        border-radius: var(--r-xl);
        background-color: #ffffff;
        border: 2px dashed var(--line-2);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        cursor: pointer;
        transition: border-color 0.2s ease;
    }

    .upload-stage:hover {
        border-color: var(--accent);
    }

    .upload-stage img {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: contain;
        padding: 18px;
        background-color: #ffffff;
        z-index: 10;
    }

    .upload-stage input[type="file"] {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
        z-index: 20;
    }

    .ck.ck-editor__main > .ck-editor__editable {
        min-height: 160px;
        background-color: var(--panel) !important;
        color: var(--ink) !important;
        border-color: var(--line-2) !important;
        font-family: 'Ubuntu', sans-serif !important;
    }

    .ck.ck-toolbar {
        background-color: var(--card-2) !important;
        border-color: var(--line-2) !important;
    }

    .ck.ck-toolbar .ck-button {
        color: var(--ink) !important;
    }

    .ck.ck-editor__editable.ck-focused {
        border-color: var(--accent) !important;
        box-shadow: 0 0 0 3px rgba(243, 122, 31, 0.16) !important;
    }

    @media (max-width: 900px) {
        .form-grid,
        .form-row-2 {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="phead">
    <div>
        <a href="<?= base_url('admin/portfolio') ?>" class="orvex-btn" style="min-height:36px;padding:0 12px;font-size:12px;margin-bottom:10px;">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Tabel
        </a>
        <div>
            <h1 class="phead__title">
                <span class="phead__mark">Edit Data Proyek</span>
            </h1>
            <p class="phead__sub">Perbarui informasi, status demo, atau ikon aplikasi <strong><?= esc($portfolio['judul']) ?></strong>.</p>
        </div>
    </div>
</div>

<div class="orvex-card" style="max-width:1040px;">
    <form action="<?= base_url('admin/portfolio/update/' . $portfolio['id']) ?>" method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <div class="form-grid">
            <div>
                <span class="field-label">Logo Aplikasi (Preview)</span>
                <div class="upload-stage">
                    <img id="preview-logo" src="<?= base_url('uploads/portfolios/' . esc($portfolio['logo'])) ?>" alt="Logo <?= esc($portfolio['judul']) ?>">
                    <input type="file" name="logo" accept="image/*" onchange="previewImage(event)" title="Klik untuk mengganti logo">
                </div>
                <p style="font-size:11.5px;color:var(--muted);margin:10px 0 0;text-align:center;">
                    Biarkan kosong jika tidak ingin mengganti logo. Maks 2MB.
                </p>
            </div>

            <div class="form-fields">
                <div>
                    <label for="judul" class="field-label">Nama / Judul Aplikasi</label>
                    <input type="text" id="judul" name="judul" value="<?= esc($portfolio['judul']) ?>" required class="orvex-input">
                </div>

                <div>
                    <label for="editor" class="field-label">Deskripsi Lengkap &amp; Fitur</label>
                    <textarea id="editor" name="deskripsi"><?= $portfolio['deskripsi'] ?></textarea>
                </div>

                <div class="form-row-2">
                    <div>
                        <label for="link_github" class="field-label">Tautan GitHub</label>
                        <input type="text" id="link_github" name="link_github" value="<?= esc($portfolio['link_github']) ?>" class="orvex-input">
                    </div>
                    <div>
                        <label for="link_demo" class="field-label">URL Aplikasi Demo</label>
                        <input type="text" id="link_demo" name="link_demo" value="<?= esc($portfolio['link_demo']) ?>" class="orvex-input">
                    </div>
                </div>

                <div class="form-row-2">
                    <div>
                        <label for="status_demo" class="field-label">Status Demo</label>
                        <select id="status_demo" name="status_demo" class="orvex-select">
                            <option value="ready" <?= $portfolio['status_demo'] == 'ready' ? 'selected' : '' ?>>Ready (Siap Diuji)</option>
                            <option value="maintenance" <?= $portfolio['status_demo'] == 'maintenance' ? 'selected' : '' ?>>Maintenance (Pemeliharaan)</option>
                        </select>
                    </div>
                    <div>
                        <label for="urutan" class="field-label">Nomor Urutan Tampil</label>
                        <input type="number" id="urutan" name="urutan" value="<?= esc($portfolio['urutan']) ?>" class="orvex-input tabular-nums">
                    </div>
                </div>

                <div style="display:flex;justify-content:flex-end;gap:10px;padding-top:10px;border-top:1px solid var(--line);">
                    <a href="<?= base_url('admin/portfolio') ?>" class="orvex-btn">Batal</a>
                    <button type="submit" class="orvex-btn orvex-btn--accent">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'), {
            toolbar: ['bold', 'italic', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo']
        })
        .catch((error) => {
            console.error(error);
        });

    function previewImage(event) {
        if (!event.target.files || !event.target.files[0]) return;
        const reader = new FileReader();
        reader.onload = function () {
            const output = document.getElementById('preview-logo');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

<?= $this->endSection() ?>
