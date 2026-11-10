<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('kategori')) {
            Schema::create('kategori', function (Blueprint $table) {
                $table->id();
                $table->string('nama_kategori', 100);
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('resep')) {
            Schema::create('resep', function (Blueprint $table) {
                $table->id();
                $table->foreignId('kategori_id')->nullable()->constrained('kategori')->nullOnDelete();
                $table->string('judul');
                $table->string('penulis', 100)->nullable();
                $table->string('durasi', 50)->nullable();
                $table->string('biaya', 50)->nullable();
                $table->text('bahan')->nullable();
                $table->text('langkah')->nullable();
                $table->text('gambar')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('restoran')) {
            Schema::create('restoran', function (Blueprint $table) {
                $table->id();
                $table->string('nama_restoran');
                $table->text('alamat')->nullable();
                $table->decimal('latitude', 10, 8)->nullable();
                $table->decimal('longitude', 11, 8)->nullable();
                $table->text('deskripsi')->nullable();
                $table->text('gambar')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('menu_restoran')) {
            Schema::create('menu_restoran', function (Blueprint $table) {
                $table->id();
                $table->foreignId('restoran_id')->nullable()->constrained('restoran')->cascadeOnDelete();
                $table->string('nama_menu');
                $table->decimal('harga', 10, 2)->nullable();
                $table->text('deskripsi')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('menu_restoran');
        Schema::dropIfExists('restoran');
        Schema::dropIfExists('resep');
        Schema::dropIfExists('kategori');
    }
};
