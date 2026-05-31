<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="mb-6">
    <h3 class="text-xl font-bold text-slate-800">Pengaturan Website</h3>
    <p class="text-slate-500 text-xs mt-0.5">Ubah profil agensi, nomor kontak, dan teks utama untuk Landing Page publik Anda.</p>
</div>

<div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 md:p-6 max-w-4xl">
    <form action="<?= base_url('admin/settings/update') ?>" method="POST" class="space-y-5">
        <?= csrf_field() ?>

        <input type="hidden" name="id" value="<?= $settings['id'] ?>">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">Nama Brand / Agensi</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                        <i class="fa-solid fa-building"></i>
                    </div>
                    <input type="text" name="nama_web" value="<?= esc($settings['nama_web']) ?>" required class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-lg pl-10 p-2.5 outline-none focus:border-blue-500 focus:bg-white transition">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">Nomor WhatsApp Target</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                        <i class="fa-brands fa-whatsapp text-lg"></i>
                    </div>
                    <input type="number" name="nomor_wa" value="<?= esc($settings['nomor_wa']) ?>" required placeholder="Contoh: 6281234567890" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-lg pl-10 p-2.5 outline-none focus:border-blue-500 focus:bg-white transition">
                </div>
                <p class="text-[10px] text-slate-400 mt-1">*Gunakan awalan 62 (tanpa + atau 0) untuk integrasi link wa.me</p>
            </div>
        </div>

        <div class="border-t border-slate-100 pt-5 mt-5">
            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">Teks Judul Utama (Hero Section)</label>
            <input type="text" name="teks_hero_judul" value="<?= esc($settings['teks_hero_judul']) ?>" required class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-lg p-2.5 outline-none focus:border-blue-500 focus:bg-white transition">
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">Teks Deskripsi / Slogan (Hero Section)</label>
            <textarea name="teks_hero_deskripsi" rows="3" required class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-lg p-2.5 outline-none focus:border-blue-500 focus:bg-white transition"><?= esc($settings['teks_hero_deskripsi']) ?></textarea>
        </div>

        <div class="border-t border-slate-100 pt-5 mt-5">
            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5">Teks Hak Cipta (Footer)</label>
            <input type="text" name="teks_footer" value="<?= esc($settings['teks_footer']) ?>" required class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-lg p-2.5 outline-none focus:border-blue-500 focus:bg-white transition">
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full md:w-auto bg-blue-600 hover:bg-blue-500 text-white text-sm font-bold px-6 py-3 rounded-lg transition shadow-[0_4px_10px_rgba(37,99,235,0.3)] flex items-center justify-center">
                <i class="fa-solid fa-cloud-arrow-up mr-2"></i> Simpan Konfigurasi
            </button>
        </div>
    </form>
</div>

<script>
    <?php if (session()->getFlashdata('success')) : ?>
        Swal.fire({
            title: 'Berhasil',
            text: '<?= session()->getFlashdata('success') ?>',
            icon: 'success',
            confirmButtonText: 'Tutup'
        });
    <?php endif; ?>
</script>

<?= $this->endSection() ?>