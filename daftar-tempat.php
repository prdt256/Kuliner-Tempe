<?php
require_once 'includes/db.php';
require_once 'includes/functions.php';
include_once 'includes/header.php';
?>
<main class="pt-32 pb-24 px-margin-mobile md:px-margin-desktop bg-surface min-h-screen">
    <div class="max-w-max-width mx-auto">
        <div class="flex flex-col md:flex-row justify-between items-center mb-12 gap-6">
            <div>
                <h1 class="font-headline-xl text-headline-xl text-on-surface mb-2">Tempat Kuliner Tempe</h1>
                <p class="text-body-lg text-on-surface-variant">Rekomendasi warung, burjo, dan penyetan enak & hemat.</p>
            </div>
            <a href="tambah-tempat.php" target="_blank" class="inline-flex items-center gap-2 bg-primary text-on-primary px-6 py-3 rounded-xl font-label-bold hover:shadow-lg hover:bg-primary/90 transition-all active:scale-95">
                <span class="material-symbols-outlined">add</span> Bagi Tempat Kuliner
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-lg items-start">
            <?php
            try {
                $stmt = $pdo->query("SELECT * FROM restoran ORDER BY id DESC");
                while ($tempat = $stmt->fetch()):
                    $id = esc((string)$tempat['id']);
                    $nama = esc($tempat['nama_restoran']);
                    $alamat_lengkap = $tempat['alamat'];
                    $alamat_singkat = esc(mb_strlen($alamat_lengkap) > 50 ? mb_substr($alamat_lengkap, 0, 50) . "..." : $alamat_lengkap);
                    $gambar = esc($tempat['gambar'] ?: "https://images.unsplash.com/photo-1555939594-58d7cb561ad1?q=80&w=500&auto=format&fit=crop");
            ?>
            <article class="bg-surface-container-lowest rounded-[2.5rem] overflow-hidden border border-outline-variant/30 flex flex-col shadow-sm hover:shadow-xl transition-all duration-300">
                <div class="h-64 overflow-hidden relative">
                    <img src="<?= $gambar ?>" alt="<?= $nama ?>" class="w-full h-full object-cover">
                </div>
                <div class="p-lg flex flex-col flex-1">
                    <h3 class="font-headline-md text-headline-md text-on-surface mb-2"><?= $nama ?></h3>
                    <p class="text-body-sm text-on-surface-variant mb-6"><?= $alamat_singkat ?></p>
                    <a href="detail-tempat.php?id=<?= $id ?>" target="_blank" class="mt-auto inline-flex items-center justify-center gap-2 text-primary font-label-bold py-3 px-4 bg-primary/5 rounded-xl hover:bg-primary/10 transition-colors w-full">
                        Baca Selengkapnya
                        <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                    </a>
                </div>
            </article>
            <?php 
                endwhile; 
            } catch (Exception $e) {
                echo "<p class='text-error col-span-full'>Gagal memuat rekomendasi: " . esc($e->getMessage()) . "</p>";
            }
            ?>
        </div>
    </div>
</main>
<?php include_once 'includes/footer.php'; ?>
