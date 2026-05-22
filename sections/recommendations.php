<!-- ==================================================
     REKOMENDASI MENU & KULINER - PREMIUM DESIGN
=================================================== -->
<section class="py-24 px-margin-mobile md:px-margin-desktop bg-surface" id="rekomendasi">
    <div class="max-w-max-width mx-auto">
        <div class="flex justify-between items-end mb-xl">
            <div>
                <h2 class="font-headline-lg text-headline-lg text-on-surface">Rekomendasi Menu</h2>
                <p class="font-body-md text-on-surface-variant mt-sm">Pilih menu favoritmu sesuai budget dan waktu.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-lg mb-xl">
            <!-- Menu 1 -->
            <article class="group bg-surface-container-lowest rounded-3xl overflow-hidden transition-all hover:shadow-xl border border-outline-variant/30">
                <div class="h-56 relative overflow-hidden">
                    <img src="media/resep 4.jpg" alt="Tempe Bacem" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                    <span class="absolute top-4 left-4 bg-primary-container text-on-primary-container px-3 py-1 rounded-full text-xs font-bold">Harian</span>
                </div>
                <div class="p-lg">
                    <h3 class="font-headline-md text-headline-md mb-xs">Tempe Bacem Legit</h3>
                    <p class="text-body-sm text-on-surface-variant mb-md">Menu cepat, bumbu meresap, cocok buat lauk harian hemat.</p>
                    <div class="flex items-center justify-between text-body-sm text-on-surface-variant pt-md border-t border-outline-variant/20">
                        <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[18px]">schedule</span> 10m</span>
                        <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[18px]">payments</span> Rp 10-15k</span>
                    </div>
                </div>
            </article>

            <!-- Menu 2 -->
            <article class="group bg-surface-container-lowest rounded-3xl overflow-hidden transition-all hover:shadow-xl border border-outline-variant/30">
                <div class="h-56 relative overflow-hidden">
                    <img src="media/resep 5.jpg" alt="Tempe Katsu" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                    <span class="absolute top-4 left-4 bg-tertiary-container text-on-tertiary-container px-3 py-1 rounded-full text-xs font-bold">Mingguan</span>
                </div>
                <div class="p-lg">
                    <h3 class="font-headline-md text-headline-md mb-xs">Tempe Katsu Renyah</h3>
                    <p class="text-body-sm text-on-surface-variant mb-md">Varian modern ala Jepang yang super renyah dan ekonomis.</p>
                    <div class="flex items-center justify-between text-body-sm text-on-surface-variant pt-md border-t border-outline-variant/20">
                        <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[18px]">schedule</span> 20m</span>
                        <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[18px]">payments</span> Rp 15-20k</span>
                    </div>
                </div>
            </article>

            <!-- Menu 3 -->
            <article class="group bg-surface-container-lowest rounded-3xl overflow-hidden transition-all hover:shadow-xl border border-outline-variant/30">
                <div class="h-56 relative overflow-hidden">
                    <img src="media/resep 1.jpg" alt="Tumis Sayur Tempe" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                    <span class="absolute top-4 left-4 bg-secondary-container text-on-secondary-container px-3 py-1 rounded-full text-xs font-bold">Lengkap</span>
                </div>
                <div class="p-lg">
                    <h3 class="font-headline-md text-headline-md mb-xs">Tumis Sayur Tempe</h3>
                    <p class="text-body-sm text-on-surface-variant mb-md">Komposisi gizi lengkap dengan sayuran segar pilihan.</p>
                    <div class="flex items-center justify-between text-body-sm text-on-surface-variant pt-md border-t border-outline-variant/20">
                        <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[18px]">schedule</span> 35m</span>
                        <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[18px]">payments</span> Rp 20-25k</span>
                    </div>
                </div>
            </article>
        </div>

        <!-- Kuliner Section -->
        <div class="mt-xl">
            <h3 class="font-headline-md text-headline-md text-on-surface mb-lg flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">storefront</span> Kuliner Hemat Terdekat
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-lg">
                <?php
                require_once 'includes/db.php';
                try {
                    $stmt = $pdo->query("SELECT * FROM restoran ORDER BY id DESC LIMIT 3");
                    while ($tempat = $stmt->fetch()):
                        $id = esc((string)$tempat['id']);
                        $nama = esc($tempat['nama_restoran']);
                        // memotong teks alamat agar tidak kepanjangan
                        $alamat_lengkap = $tempat['alamat'];
                        $alamat_singkat = esc(mb_strlen($alamat_lengkap) > 35 ? mb_substr($alamat_lengkap, 0, 35) . "..." : $alamat_lengkap);
                        $gambar = esc($tempat['gambar'] ?: "https://images.unsplash.com/photo-1555939594-58d7cb561ad1?q=80&w=500&auto=format&fit=crop");
                ?>
                <div class="flex gap-md p-md bg-surface-container-low rounded-2xl border border-outline-variant/20 hover:bg-surface-bright transition-colors group">
                    <div class="w-24 h-24 rounded-xl overflow-hidden shrink-0">
                        <img src="<?= $gambar ?>" alt="<?= $nama ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform" />
                    </div>
                    <div class="flex flex-col justify-center flex-1">
                        <h4 class="font-label-bold text-on-surface"><?= $nama ?></h4>
                        <p class="text-xs text-on-surface-variant mb-sm"><?= $alamat_singkat ?></p>
                        <a href="detail-tempat.php?id=<?= $id ?>" target="_blank" class="text-primary text-xs font-bold flex items-center gap-1 hover:underline mt-auto">
                            Baca Selengkapnya <span class="material-symbols-outlined text-xs">arrow_forward</span>
                        </a>
                    </div>
                </div>
                <?php 
                    endwhile; 
                } catch (Exception $e) {
                    echo "<p class='text-error col-span-full'>Gagal memuat rekomendasi: " . esc($e->getMessage()) . "</p>";
                }
                ?>
            </div>
            
            <div class="text-center mt-8">
                <a href="daftar-tempat.php" class="inline-block border border-primary text-primary px-8 py-3 rounded-full font-label-bold hover:bg-primary/5 transition-colors">
                    Lihat Semua Tempat Kuliner
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Section Divider -->
<div class="w-full h-12 bg-gradient-to-b from-surface to-surface-container-lowest"></div>
