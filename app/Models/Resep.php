<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Resep extends Model
{
    use HasFactory;

    protected $table = 'resep';

    protected $fillable = [
        'kategori_id',
        'judul',
        'penulis',
        'durasi',
        'biaya',
        'bahan',
        'langkah',
        'gambar',
    ];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    /**
     * Parse the 'gambar' column into an array of image URLs/paths.
     */
    public function getMediaListAttribute(): array
    {
        if (empty($this->gambar)) {
            return [];
        }

        $decoded = json_decode($this->gambar, true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
            return $decoded;
        }

        return [$this->gambar];
    }

    /**
     * Get the primary display image.
     */
    public function getFirstImageAttribute(): string
    {
        $list = $this->media_list;
        $fallback = 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?q=80&w=500&auto=format&fit=crop';

        if (empty($list)) {
            return $fallback;
        }

        $first = $list[0];
        if (str_starts_with($first, 'http://') || str_starts_with($first, 'https://')) {
            return $first;
        }

        return asset($first);
    }
}
