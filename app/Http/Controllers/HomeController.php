<?php

namespace App\Http\Controllers;

use App\Models\Resep;
use App\Models\Restoran;
use App\Models\Kategori;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('page')) {
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
        }

        $recipes = Resep::with('kategori')->latest('id')->take(3)->get();
        $restaurants = Restoran::latest('id')->take(3)->get();
        $categories = Kategori::all();

        return view('home', compact('recipes', 'restaurants', 'categories'));
    }
}
