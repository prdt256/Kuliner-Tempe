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
    $judul    = esc($r["judul"] ?? "");
    $kategori = esc($r["kategori"] ?? "");
    $biaya    = esc($r["biaya"] ?? "");
    $durasi   = esc($r["durasi"] ?? "");
    $penulis  = esc($r["penulis"] ?? "");

    $gambarRaw = trim((string)($r["gambar"] ?? ""));
    $gambar = $gambarRaw !== "" ? esc($gambarRaw) : "media/resep 4.jpg";

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
    if ($durasi) $meta .= "<span>⏱ {$durasi}</span>";
    if ($biaya)  $meta .= "<span>💸 {$biaya}</span>";
    if ($kategori) $meta .= "<span>🏷 {$kategori}</span>";

    return '
    <div class="resep-blok">
        <div class="resep-gambar">
            <img src="'.$gambar.'" alt="'.$judul.'">
        </div>

        <div class="resep-info">
            <h3>'.$judul.'</h3>
            <p>Resep kiriman <strong>'.$penulis.'</strong> — siap dicoba anak kos.</p>

            <div class="resep-meta">'.$meta.'</div>

            <details class="accordion">
                <summary>Lihat detail resep</summary>
                <div class="acc-body">
                    <div class="acc-grid">
                        <div>
                            <h4>Bahan</h4>
                            <ul>'.$bahanItems.'</ul>
                        </div>
                        <div>
                            <h4>Langkah</h4>
                            <ol>'.$langkahItems.'</ol>
                        </div>
                    </div>
                </div>
            </details>
        </div>
    </div>';
}
