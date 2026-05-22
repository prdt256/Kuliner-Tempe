<!-- ==================================================
     FORM TEMPAT KULINER - OPTIMIZED
=================================================== -->
<section class="py-24 px-margin-mobile md:px-margin-desktop bg-surface-container-lowest" id="form-kuliner">
    <div class="max-w-3xl mx-auto bg-surface-container-low p-xl md:p-16 rounded-[2rem] shadow-xl border border-white">
        <div class="text-center mb-xl">
            <span class="material-symbols-outlined text-primary text-5xl mb-sm">storefront</span>
            <h2 class="font-headline-lg text-headline-lg text-on-surface">Rekomendasi Tempat Kuliner</h2>
            <p class="text-on-surface-variant mt-sm">Punya warung tempe mendoan atau orek favorit? Bagikan lokasinya di sini!</p>
        </div>

        <form class="space-y-lg kuliner-form" action="index.php#form-kuliner" method="post" id="kulinerForm">
            <input type="hidden" name="form_type" value="tempat_kuliner" />

            <!-- Row 1: Nama Restoran & Gambar -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-lg">
                <div class="space-y-sm">
                    <label class="block font-label-bold text-on-surface-variant">Nama Tempat <span class="text-error">*</span></label>
                    <input type="text" name="nama_restoran" required class="w-full h-14 px-lg rounded-xl border border-outline-variant bg-surface-bright focus:border-primary-container focus:ring-4 focus:ring-primary-container/20 transition-all outline-none" placeholder="Contoh: Warung Mendoan Kang Jono" />
                </div>
                <div class="space-y-sm">
                    <label class="block font-label-bold text-on-surface-variant">Link Gambar (opsional)</label>
                    <input type="url" name="gambar" class="w-full h-14 px-lg rounded-xl border border-outline-variant bg-surface-bright focus:border-primary-container focus:ring-4 focus:ring-primary-container/20 transition-all outline-none" placeholder="https://...jpg" />
                </div>
            </div>

            <!-- Alamat Lengkap -->
            <div class="space-y-sm">
                <label class="block font-label-bold text-on-surface-variant">Alamat Lengkap <span class="text-error">*</span></label>
                <textarea name="alamat" required class="w-full min-h-[80px] p-lg rounded-xl border border-outline-variant bg-surface-bright focus:border-primary-container focus:ring-4 focus:ring-primary-container/20 transition-all outline-none resize-none" placeholder="Contoh: Jl. Sudirman No. 10..."></textarea>
            </div>

            <!-- Row 2: Latitude & Longitude -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-lg">
                <div class="space-y-sm">
                    <label class="block font-label-bold text-on-surface-variant">Latitude (opsional)</label>
                    <input type="text" name="latitude" class="w-full h-14 px-lg rounded-xl border border-outline-variant bg-surface-bright focus:border-primary-container focus:ring-4 focus:ring-primary-container/20 transition-all outline-none" placeholder="Contoh: -6.200000" />
                </div>
                <div class="space-y-sm">
                    <label class="block font-label-bold text-on-surface-variant">Longitude (opsional)</label>
                    <input type="text" name="longitude" class="w-full h-14 px-lg rounded-xl border border-outline-variant bg-surface-bright focus:border-primary-container focus:ring-4 focus:ring-primary-container/20 transition-all outline-none" placeholder="Contoh: 106.816666" />
                </div>
            </div>

            <!-- Deskripsi -->
            <div class="space-y-sm">
                <label class="block font-label-bold text-on-surface-variant">Deskripsi <span class="text-error">*</span></label>
                <textarea name="deskripsi" required class="w-full min-h-[120px] p-lg rounded-xl border border-outline-variant bg-surface-bright focus:border-primary-container focus:ring-4 focus:ring-primary-container/20 transition-all outline-none resize-none" placeholder="Ceritakan kenapa tempat ini enak dan harus dicoba..."></textarea>
            </div>

            <div class="flex flex-col items-center gap-md pt-lg">
                <button class="w-full md:w-auto min-w-[200px] bg-primary-container text-on-primary-container px-xl py-4 rounded-xl font-headline-md text-headline-md hover:shadow-lg transition-all active:scale-95 shadow-md" type="submit">
                    Kirim Rekomendasi
                </button>
                <p class="text-xs text-on-surface-variant text-center max-w-sm">Informasi tempat kuliner akan ditinjau oleh admin sebelum ditampilkan.</p>
            </div>
        </form>
    </div>
</section>

<!-- Section Divider -->
<div class="w-full h-12 bg-gradient-to-b from-surface-container-lowest to-surface-container-low"></div>
