<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="mb-6">
    <a href="<?= base_url('admin/portfolio') ?>" class="text-xs text-slate-500 hover:text-blue-600 transition flex items-center gap-1">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Tabel
    </a>
    <h3 class="text-xl font-bold text-slate-800 mt-2">Edit Data Proyek</h3>
</div>

<div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 max-w-2xl">
    <form action="<?= base_url('admin/portfolio/update/' . $portfolio['id']) ?>" method="POST" class="space-y-5">
        <?= csrf_field() ?>

        <div>
            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1">Nama / Judul Aplikasi</label>
            <input type="text" name="judul" value="<?= esc($portfolio['judul']) ?>" required class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-lg p-2.5 outline-none focus:border-blue-500 transition">
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1">Deskripsi Sistem</label>
            <textarea name="deskripsi" rows="3" required class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-lg p-2.5 outline-none focus:border-blue-500 transition"><?= esc($portfolio['deskripsi']) ?></textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1">Tautan GitHub</label>
                <input type="text" name="link_github" value="<?= esc($portfolio['link_github']) ?>" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-lg p-2.5 outline-none focus:border-blue-500 transition">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1">URL Aplikasi Demo</label>
                <input type="text" name="link_demo" value="<?= esc($portfolio['link_demo']) ?>" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-lg p-2.5 outline-none focus:border-blue-500 transition">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1">Status Demo</label>
                <select name="status_demo" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-lg p-2.5 outline-none focus:border-blue-500 transition">
                    <option value="ready" <?= $portfolio['status_demo'] == 'ready' ? 'selected' : '' ?>>Ready (Siap Diuji)</option>
                    <option value="maintenance" <?= $portfolio['status_demo'] == 'maintenance' ? 'selected' : '' ?>>Maintenance (Pemeliharaan)</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1">Class Ikon FontAwesome</label>
                <input type="text" name="ikon" value="<?= esc($portfolio['ikon']) ?>" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-lg p-2.5 outline-none focus:border-blue-500 transition">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1">Nomor Urutan Tampil</label>
                <input type="number" name="urutan" value="<?= esc($portfolio['urutan']) ?>" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-lg p-2.5 outline-none focus:border-blue-500 transition">
            </div>
        </div>

        <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white text-xs font-bold px-5 py-3 rounded-lg transition shadow-md flex items-center mt-2">
            <i class="fa-solid fa-floppy-disk mr-1.5"></i> Simpan Perubahan
        </button>
    </form>
</div>

<?= $this->endSection() ?>