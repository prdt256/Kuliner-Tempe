<?php
require_once 'includes/db.php';
require_once 'includes/functions.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    die("Tempat tidak ditemukan.");
}

$stmt = $pdo->prepare("SELECT * FROM restoran WHERE id = ?");
$stmt->execute([$id]);
$tempat = $stmt->fetch();

if (!$tempat) {
    die("Tempat tidak ditemukan.");
}

include_once 'includes/header.php';
?>
<style>
    /* Full Focus Immersive Mode */
    nav { display: none !important; }
</style>
<?php

$nama = esc($tempat['nama_restoran']);
$alamat = esc($tempat['alamat']);
$deskripsi = esc($tempat['deskripsi']);
$lat = esc($tempat['latitude'] ?? "");
$lng = esc($tempat['longitude'] ?? "");
$gambar = esc($tempat['gambar'] ?: "https://images.unsplash.com/photo-1555939594-58d7cb561ad1?q=80&w=500&auto=format&fit=crop");
?>
<main class="pt-32 pb-24 px-margin-mobile md:px-margin-desktop max-w-4xl mx-auto">
    <div class="mb-8">
        <a href="index.php" class="inline-flex items-center gap-2 text-primary hover:underline font-label-bold">
            <span class="material-symbols-outlined">arrow_back</span> Kembali ke Beranda
        </a>
    </div>

    <div class="bg-surface-container-lowest rounded-3xl overflow-hidden shadow-lg border border-outline-variant/30">
        <div class="h-80 w-full">
            <img src="<?= $gambar ?>" class="w-full h-full object-cover" alt="<?= $nama ?>">
        </div>
        
        <div class="p-8 md:p-12">
            <h1 class="font-headline-xl text-headline-xl text-on-surface mb-4"><?= $nama ?></h1>
            
            <div class="flex items-start gap-3 mb-8 text-on-surface-variant">
                <span class="material-symbols-outlined text-primary mt-1">location_on</span>
                <p class="text-body-lg"><?= $alamat ?></p>
            </div>

            <?php if ($lat && $lng): ?>
                <a href="https://www.google.com/maps/search/?api=1&query=<?= $lat ?>,<?= $lng ?>" target="_blank" class="inline-flex items-center gap-2 bg-primary-container text-on-primary-container px-6 py-3 rounded-xl font-label-bold hover:shadow-md transition-all mb-8">
                    Buka di Google Maps <span class="material-symbols-outlined">open_in_new</span>
                </a>
            <?php endif; ?>

            <h3 class="font-headline-md text-headline-md text-primary mb-4">Tentang Tempat Ini</h3>
            <p class="text-body-md text-on-surface-variant whitespace-pre-line leading-relaxed">
                <?= $deskripsi ?>
            </p>
        </div>
    </div>
</main>
<?php include_once 'includes/footer.php'; ?>
