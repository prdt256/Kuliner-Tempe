<?php
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

// Handle Multiple Media (JSON array)
$gambarRaw = $resep['gambar'];
$mediaList = [];
$decoded = json_decode($gambarRaw, true);
if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
    $mediaList = $decoded;
} else {
    $mediaList[] = $gambarRaw ?: "https://images.unsplash.com/photo-1546069901-ba9599a7e63c?q=80&w=500&auto=format&fit=crop";
}
if (empty($mediaList)) {
    $mediaList[] = "https://images.unsplash.com/photo-1546069901-ba9599a7e63c?q=80&w=500&auto=format&fit=crop";
}
?>
<main class="pt-32 pb-24 px-margin-mobile md:px-margin-desktop max-w-4xl mx-auto">
    <div class="mb-8">
        <a href="index.php" class="inline-flex items-center gap-2 text-primary hover:underline font-label-bold">
            <span class="material-symbols-outlined">arrow_back</span> Kembali ke Beranda
        </a>
    </div>

    <div class="bg-surface-container-lowest rounded-3xl overflow-hidden shadow-lg border border-outline-variant/30">
        <!-- Media Carousel -->
        <div class="carousel-container relative w-full h-80 overflow-hidden group">
            <div class="carousel-track flex w-full h-full transition-transform duration-700 ease-in-out">
                <?php foreach($mediaList as $media): ?>
                    <div class="w-full h-full flex-shrink-0 relative">
                        <?php 
                        $ext = strtolower(pathinfo($media, PATHINFO_EXTENSION));
                        $isVideo = in_array($ext, ['mp4', 'webm', 'ogg']);
                        if ($isVideo): 
                        ?>
                            <video src="<?= esc($media) ?>" class="w-full h-full object-cover" autoplay muted loop playsinline></video>
                        <?php else: ?>
                            <img src="<?= esc($media) ?>" class="w-full h-full object-cover" alt="<?= $judul ?>">
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <?php if (count($mediaList) > 1): ?>
                <button class="prev-btn absolute left-4 top-1/2 -translate-y-1/2 bg-surface/80 text-on-surface p-2 rounded-full opacity-0 group-hover:opacity-100 transition-opacity hover:bg-primary hover:text-on-primary z-10 shadow">
                    <span class="material-symbols-outlined">chevron_left</span>
                </button>
                <button class="next-btn absolute right-4 top-1/2 -translate-y-1/2 bg-surface/80 text-on-surface p-2 rounded-full opacity-0 group-hover:opacity-100 transition-opacity hover:bg-primary hover:text-on-primary z-10 shadow">
                    <span class="material-symbols-outlined">chevron_right</span>
                </button>
                
                <div class="carousel-indicators absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2 z-10">
                    <?php foreach($mediaList as $index => $media): ?>
                        <div class="w-2.5 h-2.5 rounded-full transition-colors duration-300 <?= $index === 0 ? 'bg-primary' : 'bg-surface/50 hover:bg-surface/80' ?>"></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <span class="absolute top-4 right-4 bg-primary-container text-on-primary-container px-4 py-2 rounded-full text-sm font-bold uppercase tracking-wider shadow-sm z-10"><?= $kategori ?></span>
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

<script>
document.addEventListener('DOMContentLoaded', () => {
    const track = document.querySelector('.carousel-track');
    if(!track) return;
    const slides = Array.from(track.children);
    if(slides.length <= 1) return;
    
    const nextBtn = document.querySelector('.next-btn');
    const prevBtn = document.querySelector('.prev-btn');
    const indicators = document.querySelectorAll('.carousel-indicators div');
    
    let currentIndex = 0;
    let autoPlayInterval;

    const updateCarousel = () => {
        track.style.transform = `translateX(-${currentIndex * 100}%)`;
        indicators.forEach((ind, i) => {
            ind.classList.toggle('bg-primary', i === currentIndex);
            ind.classList.toggle('bg-surface/50', i !== currentIndex);
            ind.classList.toggle('hover:bg-surface/80', i !== currentIndex);
        });
    };

    const nextSlide = () => {
        currentIndex = (currentIndex + 1) % slides.length;
        updateCarousel();
    };

    const prevSlide = () => {
        currentIndex = (currentIndex - 1 + slides.length) % slides.length;
        updateCarousel();
    };

    nextBtn.addEventListener('click', () => {
        nextSlide();
        resetAutoPlay();
    });
    
    prevBtn.addEventListener('click', () => {
        prevSlide();
        resetAutoPlay();
    });

    indicators.forEach((ind, i) => {
        ind.addEventListener('click', () => {
            currentIndex = i;
            updateCarousel();
            resetAutoPlay();
        });
        ind.style.cursor = 'pointer';
    });

    const startAutoPlay = () => {
        autoPlayInterval = setInterval(nextSlide, 4000);
    };

    const resetAutoPlay = () => {
        clearInterval(autoPlayInterval);
        startAutoPlay();
    };

    startAutoPlay();
});
</script>

