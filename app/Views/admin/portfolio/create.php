<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<div class="mb-6">
    <a href="<?= base_url('admin/portfolio') ?>" class="text-xs text-slate-500 hover:text-blue-600 transition flex items-center gap-1">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Tabel
    </a>
    <h3 class="text-xl font-bold text-slate-800 mt-2">Tambah Proyek Baru</h3>
</div>

<div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 max-w-4xl">
    <form action="<?= base_url('admin/portfolio/store') ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
        <?= csrf_field() ?>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-1">
                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2">Logo Aplikasi (Preview)</label>
                <div class="w-full aspect-square bg-slate-50 border-2 border-dashed border-slate-300 rounded-2xl flex flex-col items-center justify-center relative overflow-hidden group hover:border-blue-500 transition">

                    <img id="preview-logo" src="" class="absolute inset-0 w-full h-full object-contain p-4 hidden bg-white z-10">

                    <div id="placeholder-icon" class="text-center text-slate-400 group-hover:text-blue-500 transition">
                        <i class="fa-solid fa-cloud-arrow-up text-4xl mb-2"></i>
                        <p class="text-xs font-medium">Klik & Unggah Logo</p>
                    </div>

                    <input type="file" name="logo" accept="image/*" onchange="previewImage(event)" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20">
                </div>
                <p class="text-[10px] text-slate-400 mt-2 text-center">Format: PNG, JPG, WebP. Maks 2MB.</p>
            </div>

            <div class="lg:col-span-2 space-y-5">
                <div>
                    <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1">Nama / Judul Aplikasi</label>
                    <input type="text" name="judul" required class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-lg p-2.5 outline-none focus:border-blue-500 transition">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1">Deskripsi Lengkap & Fitur</label>
                    <textarea id="editor" name="deskripsi"></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1">Tautan GitHub</label>
                        <input type="text" name="link_github" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-lg p-2.5 outline-none focus:border-blue-500 transition">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1">URL Aplikasi Demo</label>
                        <input type="text" name="link_demo" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-lg p-2.5 outline-none focus:border-blue-500 transition">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1">Status Demo</label>
                        <select name="status_demo" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-lg p-2.5 outline-none focus:border-blue-500 transition">
                            <option value="ready">Ready (Siap Diuji)</option>
                            <option value="maintenance">Maintenance (Pemeliharaan)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1">Nomor Urutan Tampil</label>
                        <input type="number" name="urutan" value="0" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-lg p-2.5 outline-none focus:border-blue-500 transition">
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white text-sm font-bold px-6 py-3 rounded-lg transition shadow-md flex items-center justify-center w-full lg:w-auto ml-auto mt-4">
            <i class="fa-solid fa-floppy-disk mr-2"></i> Simpan Proyek
        </button>
    </form>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    // Inisialisasi CKEditor
    ClassicEditor
        .create(document.querySelector('#editor'), {
            toolbar: ['bold', 'italic', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo']
        })
        .catch(error => {
            console.error(error);
        });

    // Fungsi Preview Gambar
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const output = document.getElementById('preview-logo');
            output.src = reader.result;
            output.classList.remove('hidden');
            document.getElementById('placeholder-icon').classList.add('hidden');
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

<style>
    .ck-editor__editable_inline {
        min-height: 150px;
        background-color: #f8fafc !important;
        border-color: #e2e8f0 !important;
        font-family: inherit !important;
    }

    .ck-editor__editable.ck-focused {
        border-color: #3b82f6 !important;
        box-shadow: none !important;
    }
</style>
<?= $this->endSection() ?>