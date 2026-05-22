<!-- ==================================================
     DAFTAR RESEP - PREMIUM DESIGN
=================================================== -->
<section class="py-24 px-margin-mobile md:px-margin-desktop bg-surface-container-lowest" id="resep">
    <div class="max-w-max-width mx-auto">
        <div class="text-center mb-xl">
            <h2 class="font-headline-lg text-headline-lg text-on-surface">Eksplorasi Resep Lengkap</h2>
            <p class="font-body-md text-on-surface-variant max-w-2xl mx-auto mt-sm">
                Temukan kreasi tempe dari komunitas Sobat Kos. Semua resep sudah dikurasi agar hemat dan mudah dipraktekkan.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-lg items-start">
            <?php 
            require_once 'includes/db.php';
            try {
                $stmt = $pdo->query("
                    SELECT r.*, k.nama_kategori as kategori 
                    FROM resep r 
                    LEFT JOIN kategori k ON r.kategori_id = k.id 
                    ORDER BY r.id DESC LIMIT 3
                ");
                while ($row = $stmt->fetch()) {
                    echo recipe_card_html($row);
                }
            } catch (Exception $e) {
                echo "<p class='text-error col-span-full'>Gagal memuat resep: " . esc($e->getMessage()) . "</p>";
            }
            ?>
        </div>
        
        <div class="text-center mt-12">
            <a href="daftar-resep.php" class="inline-block border border-primary text-primary px-8 py-3 rounded-full font-label-bold hover:bg-primary/5 transition-colors">
                Lihat Semua Resep
            </a>
        </div>
    </div>
</section>

<!-- Section Divider -->
<div class="w-full h-12 bg-gradient-to-b from-surface-container-lowest to-surface-container-low"></div>
