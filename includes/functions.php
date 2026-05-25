<?php
/**
 * Fungsi-fungsi pembantu untuk TEMPEKU
 */

/**
 * Escaping output untuk keamanan XSS
 */
function esc(?string $s): string {
    return htmlspecialchars($s ?? "", ENT_QUOTES, "UTF-8");
}

/**
 * Helper untuk mendapatkan media pertama dari JSON atau string
 */
function get_first_media(string $gambarRaw, string $fallback = "https://images.unsplash.com/photo-1546069901-ba9599a7e63c?q=80&w=500&auto=format&fit=crop"): string {
    if (empty(trim($gambarRaw))) {
        return $fallback;
    }
    
    $decoded = json_decode($gambarRaw, true);
    if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
        if (!empty($decoded)) {
            return $decoded[0];
        }
        return $fallback;
    }
    
    // Kalau bukan JSON (data lama), kembalikan raw
    return $gambarRaw;
}

/**
 * Helper untuk merender media tag (img atau video)
 */
function render_media_tag(string $src, string $alt = "", string $classes = "w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"): string {
    $src = esc($src);
    $ext = strtolower(pathinfo($src, PATHINFO_EXTENSION));
    $isVideo = in_array($ext, ['mp4', 'webm', 'ogg']);
    
    if ($isVideo) {
        return '<video src="'.$src.'" class="'.$classes.'" autoplay muted loop playsinline></video>';
    } else {
        return '<img src="'.$src.'" alt="'.esc($alt).'" class="'.$classes.'">';
    }
}

/**
 * Generate HTML untuk card resep
 */
function recipe_card_html(array $r): string {
    $id       = esc((string)($r["id"] ?? "#"));
    $judul    = esc($r["judul"] ?? "Resep Tempe");
    $kategori = esc($r["kategori"] ?? "Umum");
    $biaya    = esc($r["biaya"] ?? "-");
    $durasi   = esc($r["durasi"] ?? "-");
    $penulis  = esc($r["penulis"] ?? "Anonim");

    $gambarRaw = trim((string)($r["gambar"] ?? ""));
    $firstMedia = get_first_media($gambarRaw);
    $mediaTag = render_media_tag($firstMedia, $judul, "w-full h-full object-cover");

    $meta = "";
    if ($durasi) $meta .= '<span class="flex items-center gap-1"><span class="material-symbols-outlined text-[16px]">schedule</span> '.$durasi.'</span>';
    if ($biaya)  $meta .= '<span class="flex items-center gap-1"><span class="material-symbols-outlined text-[16px]">payments</span> '.$biaya.'</span>';

    global $base_url;
    $linkHref = $id !== "#" ? $base_url . "index.php?page=resep/detail&id=$id" : "#";

    return '
    <article class="bg-surface rounded-[2.5rem] overflow-hidden border border-outline-variant/30 flex flex-col shadow-sm hover:shadow-xl transition-all duration-300">
        <div class="h-64 overflow-hidden relative">
            '.$mediaTag.'
            <span class="absolute top-4 right-4 bg-primary-container text-on-primary-container px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider shadow-sm">'.$kategori.'</span>
        </div>
        <div class="p-lg flex flex-col flex-1">
            <h3 class="font-headline-md text-headline-md text-on-surface mb-xs">'.$judul.'</h3>
            <p class="text-body-sm text-on-surface-variant mb-md italic">Oleh: '.$penulis.'</p>
            
            <div class="flex items-center gap-4 text-xs text-on-surface-variant font-label-bold mb-lg pb-md border-b border-outline-variant/10">'.$meta.'</div>

            <a href="'.$linkHref.'" target="_blank" class="mt-auto inline-flex items-center justify-center gap-2 text-primary font-label-bold py-3 px-4 bg-primary/5 rounded-xl hover:bg-primary/10 transition-colors w-full">
                Baca Selengkapnya
                <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
            </a>
        </div>
    </article>';
}
