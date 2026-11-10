<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Restoran extends Model
{
    use HasFactory;

    protected $table = 'restoran';

    protected $fillable = [
        'nama_restoran',
        'alamat',
        'latitude',
        'longitude',
        'deskripsi',
        'gambar',
    ];

    public function menu(): HasMany
    {
        return $this->hasMany(MenuRestoran::class, 'restoran_id');
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
        $fallback = 'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?q=80&w=500&auto=format&fit=crop';

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
