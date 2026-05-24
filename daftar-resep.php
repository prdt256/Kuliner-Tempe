<?php
require_once 'includes/db.php';
require_once 'includes/functions.php';
include_once 'includes/header.php';
?>
<main class="pt-32 pb-24 px-margin-mobile md:px-margin-desktop bg-surface min-h-screen">
    <div class="max-w-max-width mx-auto">
        <div class="flex flex-col md:flex-row justify-between items-center mb-12 gap-6">
            <div>
                <h1 class="font-headline-xl text-headline-xl text-on-surface mb-2">Katalog Resep Tempe</h1>
                <p class="text-body-lg text-on-surface-variant">Kumpulan kreasi tempe lezat dan murah dari komunitas Sobat Kos.</p>
            </div>
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="tambah-resep.php" target="_blank" class="inline-flex items-center gap-2 bg-primary text-on-primary px-6 py-3 rounded-xl font-label-bold hover:shadow-lg hover:bg-primary/90 transition-all active:scale-95">
                    <span class="material-symbols-outlined">add</span> Bagi Resepmu
                </a>
            <?php else: ?>
                <div class="bg-primary-container/20 border border-primary/20 rounded-xl p-4 max-w-sm flex flex-col items-start gap-2 shadow-sm">
                    <div class="flex items-center gap-2 text-primary">
                        <span class="material-symbols-outlined text-2xl">campaign</span>
                        <p class="text-sm font-label-bold">Menarik kan? Mau ikut bagi resep?</p>
                    </div>
                    <a href="login.php" class="text-sm bg-primary text-on-primary px-4 py-2 rounded-lg font-label-bold hover:bg-primary/90 transition-colors w-full text-center">Masuk Dulu Yuk!</a>
                </div>
            <?php endif; ?>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-lg items-start">
            <?php 
            try {
                $stmt = $pdo->query("
                    SELECT r.*, k.nama_kategori as kategori 
                    FROM resep r 
                    LEFT JOIN kategori k ON r.kategori_id = k.id 
                    ORDER BY r.id DESC
                ");
                while ($row = $stmt->fetch()) {
                    echo recipe_card_html($row);
                }
            } catch (Exception $e) {
                echo "<p class='text-error col-span-full'>Gagal memuat resep: " . esc($e->getMessage()) . "</p>";
            }
            ?>
        </div>
    </div>
</main>
<?php include_once 'includes/footer.php'; ?>
