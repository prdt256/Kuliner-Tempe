<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MenuRestoran extends Model
{
    use HasFactory;

    protected $table = 'menu_restoran';

    protected $fillable = [
        'restoran_id',
        'nama_menu',
        'harga',
        'deskripsi',
    ];

    public function restoran(): BelongsTo
    {
        return $this->belongsTo(Restoran::class, 'restoran_id');
    }
}
