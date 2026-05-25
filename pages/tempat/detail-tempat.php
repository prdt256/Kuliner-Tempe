<?php
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

// Handle Multiple Media (JSON array)
$gambarRaw = $tempat['gambar'];
$mediaList = [];
$decoded = json_decode($gambarRaw, true);
if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
    $mediaList = $decoded;
} else {
    $mediaList[] = $gambarRaw ?: "https://images.unsplash.com/photo-1555939594-58d7cb561ad1?q=80&w=500&auto=format&fit=crop";
}
if (empty($mediaList)) {
    $mediaList[] = "https://images.unsplash.com/photo-1555939594-58d7cb561ad1?q=80&w=500&auto=format&fit=crop";
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
                            <img src="<?= esc($media) ?>" class="w-full h-full object-cover" alt="<?= $nama ?>">
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

