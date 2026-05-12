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

        <!-- Grid Container -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-lg items-start">
            
            <!-- 1. Tampilkan Resep dari Session (Hasil Submit User) -->
            <?php 
            if (isset($_SESSION["user_recipes"]) && !empty($_SESSION["user_recipes"])) {
                foreach (array_reverse($_SESSION["user_recipes"]) as $userResep) {
                    echo recipe_card_html($userResep);
                }
            }
            ?>

            <!-- 2. Resep Statis (Contoh Bawaan) -->
            <?php
            // Resep Bawaan 1
            echo recipe_card_html([
                "judul" => "Tempe Bacem Legit",
                "kategori" => "Harian",
                "biaya" => "Rp 10-15k",
                "durasi" => "20m",
                "penulis" => "Tim Tempeku",
                "gambar" => "media/resep 4.jpg",
                "bahan" => "1 papan tempe\nBawang putih, gula merah, kecap\nDaun salam & lengkuas",
                "langkah" => "Ungkep tempe dengan bumbu sampai meresap.\nGoreng atau panggang sebentar sebelum disajikan."
            ]);

            // Resep Bawaan 2
            echo recipe_card_html([
                "judul" => "Tempe Katsu BBQ",
                "kategori" => "Mingguan",
                "biaya" => "Rp 15-20k",
                "durasi" => "25m",
                "penulis" => "Chef Kos",
                "gambar" => "media/resep 5.jpg",
                "bahan" => "Tempe (iris tipis)\nTepung bumbu & tepung roti\nSaus barbeque instan",
                "langkah" => "Balur tempe dengan tepung, goreng hingga krispi.\nSajikan dengan siraman saus BBQ hangat."
            ]);

            // Resep Bawaan 3
            echo recipe_card_html([
                "judul" => "Sambal Tempe",
                "kategori" => "Favorit",
                "biaya" => "Rp 10-15k",
                "durasi" => "15m",
                "penulis" => "Mbak Tempe",
                "gambar" => "media/resep 7.jpg",
                "bahan" => "Tempe goreng\nCabai, bawang, kemangi",
                "langkah" => "Ulek sambal, penyet tempe, tambahkan kemangi."
            ]);
            ?>
        </div>
    </div>
</section>

<!-- Section Divider -->
<div class="w-full h-12 bg-gradient-to-b from-surface-container-lowest to-surface-container-low"></div>
