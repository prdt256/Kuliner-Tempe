<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Kategori;
use App\Models\Resep;
use App\Models\Restoran;
use App\Models\User;

class TempekuTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_loads_successfully(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('TEMPEKU');
        $response->assertSee('Inspirasi Tempe untuk Sobat Kos');
    }

    public function test_recipe_catalog_loads_successfully(): void
    {
        $cat = Kategori::create(['nama_kategori' => 'Gorengan']);
        $resep = Resep::create([
            'kategori_id' => $cat->id,
            'judul' => 'Tempe Mendoan Hangat',
            'penulis' => 'Tester',
            'durasi' => '15 Menit',
            'biaya' => 'Rp 10.000',
            'bahan' => 'Tempe, Tepung',
            'langkah' => 'Goreng',
        ]);

        $response = $this->get('/resep');
        $response->assertStatus(200);
        $response->assertSee('Katalog Resep Tempe');

        $responseDetail = $this->get('/resep/' . $resep->id);
        $responseDetail->assertStatus(200);
        $responseDetail->assertSee('Tempe Mendoan Hangat');
    }

    public function test_culinary_places_catalog_loads_successfully(): void
    {
        $place = Restoran::create([
            'nama_restoran' => 'Warung Tempe Kang Jono',
            'alamat' => 'Jl. Test No. 1',
            'deskripsi' => 'Warung mendoan enak',
        ]);

        $response = $this->get('/tempat');
        $response->assertStatus(200);
        $response->assertSee('Tempat Kuliner Tempe');

        $responseDetail = $this->get('/tempat/' . $place->id);
        $responseDetail->assertStatus(200);
        $responseDetail->assertSee('Warung Tempe Kang Jono');
    }

    public function test_auth_pages_accessible(): void
    {
        $this->get('/login')->assertStatus(200)->assertSee('Masuk ke TEMPEKU');
        $this->get('/register')->assertStatus(200)->assertSee('Daftar Akun TEMPEKU');
        $this->get('/admin/login')->assertStatus(200)->assertSee('Login Admin');
    }

    public function test_admin_dashboard_protected_by_auth(): void
    {
        // Unauthenticated access redirects to login
        $response = $this->get('/admin');
        $response->assertRedirect('/login');

        // Regular user access forbidden
        $user = User::create([
            'name' => 'Regular User',
            'username' => 'user1',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);
        $this->actingAs($user)->get('/admin')->assertStatus(403);

        // Admin user can access
        $admin = User::create([
            'name' => 'Admin User',
            'username' => 'admin_test',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);
        $this->actingAs($admin)->get('/admin')->assertStatus(200)->assertSee('Dashboard Manajemen Tempeku');
    }
}
