<!-- ==================================================
     FORM RESEP - UPDATED WITH PREMIUM DESIGN
=================================================== -->
<section class="py-24 px-margin-mobile md:px-margin-desktop bg-surface-container-low" id="form-resep">
    <div class="max-w-3xl mx-auto bg-surface-container-lowest p-xl md:p-16 rounded-[2rem] shadow-xl border border-white">
        <div class="text-center mb-xl">
            <span class="material-symbols-outlined text-primary text-5xl mb-sm">restaurant_menu</span>
            <h2 class="font-headline-lg text-headline-lg text-on-surface">Bagikan Resep Andalannu</h2>
            <p class="text-on-surface-variant mt-sm">Punya kreasi tempe yang unik dan murah? Bagikan ke sesama Sobat Kos!</p>
        </div>

        <form class="space-y-lg" action="index.php#resep" method="post" id="recipeForm">
            <input type="hidden" name="form_type" value="resep" />

            <!-- Row 1: Nama Resep & Kategori -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-lg">
                <div class="space-y-sm">
                    <label class="block font-label-bold text-on-surface-variant">Nama Resep <span class="text-error">*</span></label>
                    <input type="text" name="judul" required class="w-full h-14 px-lg rounded-xl border border-outline-variant bg-surface-bright focus:border-primary-container focus:ring-4 focus:ring-primary-container/20 transition-all outline-none" placeholder="Contoh: Tempe Orek Pedas Manis" />
                </div>
                <div class="space-y-sm">
                    <label class="block font-label-bold text-on-surface-variant">Kategori <span class="text-error">*</span></label>
                    <select name="kategori" required class="w-full h-14 px-lg rounded-xl border border-outline-variant bg-surface-bright focus:border-primary-container focus:ring-4 focus:ring-primary-container/20 transition-all outline-none">
                        <option value="">Pilih Kategori</option>
                        <option>Harian</option>
                        <option>Mingguan</option>
                        <option>Akhir Bulan</option>
                        <option>Camilan</option>
                    </select>
                </div>
            </div>

            <!-- Row 2: Biaya & Durasi -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-lg">
                <div class="space-y-sm">
                    <label class="block font-label-bold text-on-surface-variant">Estimasi Biaya</label>
                    <input type="text" name="biaya" class="w-full h-14 px-lg rounded-xl border border-outline-variant bg-surface-bright focus:border-primary-container focus:ring-4 focus:ring-primary-container/20 transition-all outline-none" placeholder="Contoh: Rp 12.000 / porsi" />
                </div>
                <div class="space-y-sm">
                    <label class="block font-label-bold text-on-surface-variant">Durasi Masak</label>
                    <input type="text" name="durasi" class="w-full h-14 px-lg rounded-xl border border-outline-variant bg-surface-bright focus:border-primary-container focus:ring-4 focus:ring-primary-container/20 transition-all outline-none" placeholder="Contoh: 15 menit" />
                </div>
            </div>

            <!-- Bahan-bahan -->
            <div class="space-y-sm">
                <label class="block font-label-bold text-on-surface-variant">Bahan-bahan <span class="text-error">*</span></label>
                <textarea name="bahan" required class="w-full min-h-[120px] p-lg rounded-xl border border-outline-variant bg-surface-bright focus:border-primary-container focus:ring-4 focus:ring-primary-container/20 transition-all outline-none resize-none" placeholder="Contoh: 1 papan tempe, cabe, kecap..."></textarea>
            </div>

            <!-- Cara Membuat -->
            <div class="space-y-sm">
                <label class="block font-label-bold text-on-surface-variant">Langkah Memasak <span class="text-error">*</span></label>
                <textarea name="langkah" required class="w-full min-h-[180px] p-lg rounded-xl border border-outline-variant bg-surface-bright focus:border-primary-container focus:ring-4 focus:ring-primary-container/20 transition-all outline-none resize-none" placeholder="Jelaskan langkah demi langkah..."></textarea>
            </div>

            <!-- Link Gambar & Penulis -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-lg">
                <div class="space-y-sm">
                    <label class="block font-label-bold text-on-surface-variant">Link Gambar (opsional)</label>
                    <input type="url" name="gambar" class="w-full h-14 px-lg rounded-xl border border-outline-variant bg-surface-bright focus:border-primary-container focus:ring-4 focus:ring-primary-container/20 transition-all outline-none" placeholder="https://...jpg" />
                </div>
                <div class="space-y-sm">
                    <label class="block font-label-bold text-on-surface-variant">Nama Pengirim <span class="text-error">*</span></label>
                    <input type="text" name="penulis" required class="w-full h-14 px-lg rounded-xl border border-outline-variant bg-surface-bright focus:border-primary-container focus:ring-4 focus:ring-primary-container/20 transition-all outline-none" placeholder="Nama kamu" />
                </div>
            </div>

            <div class="flex flex-col items-center gap-md pt-lg">
                <button class="w-full md:w-auto min-w-[200px] bg-primary-container text-on-primary-container px-xl py-4 rounded-xl font-headline-md text-headline-md hover:shadow-lg transition-all active:scale-95 shadow-md" type="submit">
                    Kirim Resep
                </button>
                <p class="text-xs text-on-surface-variant text-center max-w-sm">Dengan menekan tombol kirim, resepmu akan melalui proses kurasi sebelum dipublikasikan.</p>
            </div>
        </form>
    </div>
</section>

<!-- Section Divider -->
<div class="w-full h-12 bg-gradient-to-b from-surface-container-low to-surface-container-lowest"></div>
