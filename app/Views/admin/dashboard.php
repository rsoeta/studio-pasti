<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 mb-6">
    <h3 class="text-xl font-bold text-slate-800">Selamat datang, <?= session()->get('admin_nama') ?>!</h3>
    <p class="text-slate-500 mt-1 text-sm">Ini adalah pusat kendali untuk mengelola etalase digital Studio PASTI. Semua perubahan yang Anda lakukan di sini akan langsung tampil di halaman depan.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 flex items-center">
        <div class="w-12 h-12 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center text-xl">
            <i class="fa-solid fa-layer-group"></i>
        </div>
        <div class="ml-4">
            <p class="text-sm font-medium text-slate-500">Total Portofolio</p>
            <p class="text-2xl font-bold text-slate-800">0 <span class="text-xs font-normal text-slate-400">Aplikasi</span></p>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 flex items-center">
        <div class="w-12 h-12 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl">
            <i class="fa-solid fa-globe"></i>
        </div>
        <div class="ml-4">
            <p class="text-sm font-medium text-slate-500">Status Web</p>
            <p class="text-2xl font-bold text-slate-800">Aktif <span class="text-xs font-normal text-slate-400">Online</span></p>
        </div>
    </div>

</div>

<?= $this->endSection() ?>