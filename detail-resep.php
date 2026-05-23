<?php
require_once 'includes/db.php';
require_once 'includes/functions.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    die("Resep tidak ditemukan.");
}

$stmt = $pdo->prepare("
    SELECT r.*, k.nama_kategori 
    FROM resep r 
    LEFT JOIN kategori k ON r.kategori_id = k.id 
    WHERE r.id = ?
");
$stmt->execute([$id]);
$resep = $stmt->fetch();

if (!$resep) {
    die("Resep tidak ditemukan.");
}

include_once 'includes/header.php';
?>
<style>
    /* Full Focus Immersive Mode */
    nav { display: none !important; }
</style>
<?php

// Prepare data
$judul = esc($resep['judul']);
$penulis = esc($resep['penulis']);
$kategori = esc($resep['nama_kategori'] ?? 'Umum');
$durasi = esc($resep['durasi']);
$biaya = esc($resep['biaya']);
$bahan = esc($resep['bahan']);
$langkah = esc($resep['langkah']);
$gambar = esc($resep['gambar'] ?: "https://images.unsplash.com/photo-1546069901-ba9599a7e63c?q=80&w=500&auto=format&fit=crop");
?>
<main class="pt-32 pb-24 px-margin-mobile md:px-margin-desktop max-w-4xl mx-auto">
    <div class="mb-8">
        <a href="index.php" class="inline-flex items-center gap-2 text-primary hover:underline font-label-bold">
            <span class="material-symbols-outlined">arrow_back</span> Kembali ke Beranda
        </a>
    </div>

    <div class="bg-surface-container-lowest rounded-3xl overflow-hidden shadow-lg border border-outline-variant/30">
        <div class="h-80 w-full relative">
            <img src="<?= $gambar ?>" class="w-full h-full object-cover" alt="<?= $judul ?>">
            <span class="absolute top-4 right-4 bg-primary-container text-on-primary-container px-4 py-2 rounded-full text-sm font-bold uppercase tracking-wider shadow-sm"><?= $kategori ?></span>
        </div>
        
        <div class="p-8 md:p-12">
            <h1 class="font-headline-xl text-headline-xl text-on-surface mb-4"><?= $judul ?></h1>
            <p class="text-body-lg text-on-surface-variant italic mb-8">Oleh: <?= $penulis ?></p>

            <div class="flex flex-wrap gap-6 mb-12 border-y border-outline-variant/20 py-6">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">schedule</span>
                    <span class="font-label-bold text-on-surface"><?= $durasi ?></span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">payments</span>
                    <span class="font-label-bold text-on-surface"><?= $biaya ?></span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <div>
                    <h3 class="font-headline-md text-headline-md text-primary mb-6 flex items-center gap-2">
                        <span class="material-symbols-outlined">shopping_basket</span> Bahan-bahan
                    </h3>
                    <ul class="list-disc list-inside space-y-3 text-body-md text-on-surface-variant">
                        <?php
                        foreach (preg_split("/\r\n|\n|\r/", $bahan) as $line) {
                            if (trim($line) !== "") echo "<li>" . esc($line) . "</li>";
                        }
                        ?>
                    </ul>
                </div>

                <div>
                    <h3 class="font-headline-md text-headline-md text-primary mb-6 flex items-center gap-2">
                        <span class="material-symbols-outlined">menu_book</span> Langkah Memasak
                    </h3>
                    <ol class="list-decimal list-inside space-y-3 text-body-md text-on-surface-variant">
                        <?php
                        foreach (preg_split("/\r\n|\n|\r/", $langkah) as $line) {
                            if (trim($line) !== "") echo "<li>" . esc($line) . "</li>";
                        }
                        ?>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include_once 'includes/footer.php'; ?>
