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
 * Generate HTML untuk card resep
 */
function recipe_card_html(array $r): string {
    $judul    = esc($r["judul"] ?? "Resep Tempe");
    $kategori = esc($r["kategori"] ?? "Umum");
    $biaya    = esc($r["biaya"] ?? "-");
    $durasi   = esc($r["durasi"] ?? "-");
    $penulis  = esc($r["penulis"] ?? "Anonim");

    $gambarRaw = trim((string)($r["gambar"] ?? ""));
    // Gunakan placeholder berkualitas tinggi jika gambar kosong
    $gambar = $gambarRaw !== "" ? esc($gambarRaw) : "https://images.unsplash.com/photo-1546069901-ba9599a7e63c?q=80&w=500&auto=format&fit=crop";

    // ubah baris menjadi list
    $bahanItems = "";
    foreach (preg_split("/\r\n|\n|\r/", (string)($r["bahan"] ?? "")) as $line) {
        $line = trim($line);
        if ($line !== "") $bahanItems .= "<li>" . esc($line) . "</li>";
    }

    $langkahItems = "";
    foreach (preg_split("/\r\n|\n|\r/", (string)($r["langkah"] ?? "")) as $line) {
        $line = trim($line);
        if ($line !== "") $langkahItems .= "<li>" . esc($line) . "</li>";
    }

    $meta = "";
    if ($durasi) $meta .= '<span class="flex items-center gap-1"><span class="material-symbols-outlined text-[16px]">schedule</span> '.$durasi.'</span>';
    if ($biaya)  $meta .= '<span class="flex items-center gap-1"><span class="material-symbols-outlined text-[16px]">payments</span> '.$biaya.'</span>';

    return '
    <article class="bg-surface rounded-[2.5rem] overflow-hidden border border-outline-variant/30 flex flex-col shadow-sm hover:shadow-xl transition-all duration-300">
        <div class="h-64 overflow-hidden relative">
            <img src="'.$gambar.'" alt="'.$judul.'" class="w-full h-full object-cover">
            <span class="absolute top-4 right-4 bg-primary-container text-on-primary-container px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider shadow-sm">'.$kategori.'</span>
        </div>
        <div class="p-lg flex flex-col flex-1">
            <h3 class="font-headline-md text-headline-md text-on-surface mb-xs">'.$judul.'</h3>
            <p class="text-body-sm text-on-surface-variant mb-md italic">Oleh: '.$penulis.'</p>
            
            <div class="flex items-center gap-4 text-xs text-on-surface-variant font-label-bold mb-lg pb-md border-b border-outline-variant/10">'.$meta.'</div>

            <details class="group cursor-pointer">
                <summary class="list-none flex items-center justify-between text-primary font-label-bold py-2 px-4 bg-primary/5 rounded-xl hover:bg-primary/10 transition-colors">
                    <span class="flex items-center gap-2">
                        <span class="material-symbols-outlined transition-transform group-open:rotate-180">expand_more</span>
                        Detail Resep
                    </span>
                    <span class="text-[10px] opacity-60 uppercase group-open:hidden">Klik untuk melihat</span>
                </summary>
                <div class="mt-lg p-lg bg-surface-container-low rounded-2xl border border-outline-variant/10 space-y-lg">
                    <div>
                        <h4 class="font-label-bold text-on-surface mb-sm text-xs uppercase tracking-widest flex items-center gap-2">
                            <span class="material-symbols-outlined text-[18px]">shopping_basket</span> Bahan
                        </h4>
                        <ul class="list-disc list-inside text-body-sm text-on-surface-variant space-y-1 ml-2">'.$bahanItems.'</ul>
                    </div>
                    <div>
                        <h4 class="font-label-bold text-on-surface mb-sm text-xs uppercase tracking-widest flex items-center gap-2">
                            <span class="material-symbols-outlined text-[18px]">menu_book</span> Langkah
                        </h4>
                        <ol class="list-decimal list-inside text-body-sm text-on-surface-variant space-y-1 ml-2">'.$langkahItems.'</ol>
                    </div>
                </div>
            </details>
        </div>
    </article>';
}
