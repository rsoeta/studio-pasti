<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
    <div>
        <h3 class="text-xl font-bold text-slate-800">Katalog Portofolio</h3>
        <p class="text-slate-500 text-xs mt-0.5">Kelola data aplikasi yang tampil di landing page publik.</p>
    </div>

    <a href="<?= base_url('admin/portfolio/create') ?>" class="self-end md:self-auto bg-blue-600 hover:bg-blue-500 text-white text-xs font-bold px-4 py-2.5 rounded-lg transition flex items-center shadow-md w-fit">
        <i class="fa-solid fa-plus mr-1.5"></i> Tambah Proyek
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="hidden md:table-header-group bg-slate-50 border-b border-slate-200">
                <tr class="text-slate-600 text-xs uppercase font-bold tracking-wider">
                    <th class="p-4 w-12 text-center">Ikon</th>
                    <th class="p-4">Nama Aplikasi</th>
                    <th class="p-4">Demo Status</th>
                    <th class="p-4 text-center">Urutan</th>
                    <th class="p-4 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody class="block md:table-row-group divide-y divide-slate-100 text-sm">
                <?php if (!empty($portfolios)): ?>
                    <?php foreach ($portfolios as $p): ?>
                        <tr class="block md:table-row bg-white hover:bg-slate-50/80 transition p-4 md:p-0">

                            <td class="block md:table-cell md:p-4 md:text-center border-b border-slate-100 md:border-none pb-3 md:pb-0 mb-3 md:mb-0">
                                <div class="flex items-center gap-3 md:justify-center">

                                    <div class="w-12 h-12 md:w-10 md:h-10 shrink-0 rounded-lg bg-white flex items-center justify-center border border-slate-200 p-1 shadow-sm overflow-hidden">
                                        <img src="<?= base_url('uploads/portfolios/' . esc($p['logo'])) ?>" alt="Logo" class="w-full h-full object-contain">
                                    </div>

                                    <div class="md:hidden text-left">
                                        <p class="font-bold text-slate-800 text-base"><?= esc($p['judul']) ?></p>
                                        <p class="text-xs text-slate-400 mt-0.5 truncate max-w-[220px]"><?= strip_tags($p['deskripsi']) ?></p>
                                    </div>
                                </div>
                            </td>

                            <td class="hidden md:table-cell p-4">
                                <p class="font-bold text-slate-800"><?= esc($p['judul']) ?></p>
                                <p class="text-xs text-slate-400 mt-0.5 max-w-md truncate"><?= strip_tags($p['deskripsi']) ?></p>
                            </td>

                            <td class="hidden md:table-cell p-4">
                                <p class="font-bold text-slate-800"><?= $p['judul'] ?></p>
                                <p class="text-xs text-slate-400 mt-0.5 max-w-md truncate"><?= $p['deskripsi'] ?></p>
                            </td>

                            <td class="flex justify-between items-center md:table-cell md:p-4 py-2 md:py-0">
                                <span class="md:hidden text-xs font-bold text-slate-500 uppercase">Status:</span>
                                <span class="px-2.5 py-1 text-xs font-semibold rounded-full <?= $p['status_demo'] === 'ready' ? 'bg-emerald-50 text-emerald-600 border border-emerald-100' : 'bg-amber-50 text-amber-600 border border-amber-100' ?>">
                                    <?= $p['status_demo'] === 'ready' ? 'Ready' : 'Maintenance' ?>
                                </span>
                            </td>

                            <td class="flex justify-between items-center md:table-cell md:p-4 py-2 md:py-0 md:text-center font-medium text-slate-600 border-b border-slate-100 md:border-none mb-3 md:mb-0">
                                <span class="md:hidden text-xs font-bold text-slate-500 uppercase">Urutan Tampil:</span>
                                <span><?= $p['urutan'] ?></span>
                            </td>

                            <td class="block md:table-cell md:p-4 pt-1 md:pt-4">
                                <div class="flex items-center justify-between md:justify-center gap-2">
                                    <a href="<?= base_url('admin/portfolio/toggle/' . $p['id']) ?>" class="flex-1 md:flex-none text-center p-2.5 md:p-2 rounded-lg border text-xs font-medium transition <?= $p['is_active'] == 1 ? 'bg-slate-50 text-slate-600 border-slate-200 hover:bg-slate-100' : 'bg-yellow-50 text-yellow-600 border-yellow-100 hover:bg-yellow-100' ?>" title="<?= $p['is_active'] == 1 ? 'Sembunyikan dari Publik' : 'Tampilkan ke Publik' ?>">
                                        <i class="fa-solid <?= $p['is_active'] == 1 ? 'fa-eye' : 'fa-eye-slash' ?>"></i>
                                    </a>
                                    <a href="<?= base_url('admin/portfolio/edit/' . $p['id']) ?>" class="flex-1 md:flex-none text-center p-2.5 md:p-2 bg-blue-50 text-blue-600 border border-blue-100 rounded-lg text-xs hover:bg-blue-100 transition">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <button onclick="deleteConfirm('<?= $p['id'] ?>', '<?= $p['judul'] ?>')" class="flex-1 md:flex-none text-center p-2.5 md:p-2 bg-red-50 text-red-600 border border-red-100 rounded-lg text-xs hover:bg-red-100 transition cursor-pointer">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </div>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr class="block md:table-row">
                        <td colspan="5" class="block md:table-cell p-8 text-center text-slate-400 text-xs">Belum ada data proyek aplikasi. Klik tombol Tambah Proyek untuk mengisi katalog.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
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
    <?php if (session()->getFlashdata('error')) : ?>
        Swal.fire({
            title: 'Gagal',
            text: '<?= session()->getFlashdata('error') ?>',
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