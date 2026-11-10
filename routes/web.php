<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\CulinaryController;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use Illuminate\Http\Request;

// 1. Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// 2. Authentication
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('logout');

// 3. Admin Authentication & Dashboard
Route::get('/admin/login', [AuthController::class, 'showAdminLogin'])->name('admin.login');
Route::get('/login-admin', [AuthController::class, 'showAdminLogin']);
Route::post('/admin/login', [AuthController::class, 'adminLogin'])->name('admin.login.post');
Route::post('/login-admin', [AuthController::class, 'adminLogin']);
Route::get('/admin', AdminDashboard::class)->middleware('auth')->name('admin.dashboard');

// 4. Recipes (Resep)
Route::get('/resep', [RecipeController::class, 'index'])->name('resep.index');
Route::get('/resep/tambah', [RecipeController::class, 'create'])->middleware('auth')->name('resep.create');
Route::post('/resep/tambah', [RecipeController::class, 'store'])->middleware('auth')->name('resep.store');
Route::get('/resep/{id}', [RecipeController::class, 'show'])->name('resep.show');

// 5. Culinary Spots (Tempat Kuliner)
Route::get('/tempat', [CulinaryController::class, 'index'])->name('tempat.index');
Route::get('/tempat/tambah', [CulinaryController::class, 'create'])->middleware('auth')->name('tempat.create');
Route::post('/tempat/tambah', [CulinaryController::class, 'store'])->middleware('auth')->name('tempat.store');
Route::get('/tempat/{id}', [CulinaryController::class, 'show'])->name('tempat.show');

// 6. Legacy Query Param Fallback (Compatibility for ?page=...)
Route::get('/index.php', function (Request $request) {
    $page = $request->query('page');
    $id = $request->query('id');

    return match ($page) {
        'resep/daftar' => redirect()->route('resep.index'),
        'resep/detail' => $id ? redirect()->route('resep.show', $id) : redirect()->route('resep.index'),
        'resep/tambah' => redirect()->route('resep.create'),
        'tempat/daftar' => redirect()->route('tempat.index'),
        'tempat/detail' => $id ? redirect()->route('tempat.show', $id) : redirect()->route('tempat.index'),
        'tempat/tambah' => redirect()->route('tempat.create'),
        'login' => redirect()->route('login'),
        'register' => redirect()->route('register'),
        'login-admin' => redirect()->route('admin.login'),
        'logout' => redirect()->route('logout'),
        default => redirect()->route('home'),
    };
});
