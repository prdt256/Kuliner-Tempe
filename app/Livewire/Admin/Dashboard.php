<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Resep;
use App\Models\Restoran;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    public $tab = 'recipes';
    public $newCategory = '';

    public function mount()
    {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            abort(403, 'Akses terbatas untuk administrator.');
        }
    }

    public function setTab($tab)
    {
        $this->tab = $tab;
    }

    public function deleteRecipe($id)
    {
        $resep = Resep::find($id);
        if ($resep) {
            $resep->delete();
            session()->flash('message', 'Resep berhasil dihapus.');
        }
    }

    public function deletePlace($id)
    {
        $place = Restoran::find($id);
        if ($place) {
            $place->delete();
            session()->flash('message', 'Tempat kuliner berhasil dihapus.');
        }
    }

    public function addCategory()
    {
        $this->validate([
            'newCategory' => 'required|string|max:100|unique:kategori,nama_kategori',
        ]);

        Kategori::create([
            'nama_kategori' => trim($this->newCategory),
        ]);

        $this->newCategory = '';
        session()->flash('message', 'Kategori baru berhasil ditambahkan.');
    }

    public function deleteCategory($id)
    {
        $cat = Kategori::find($id);
        if ($cat) {
            $cat->delete();
            session()->flash('message', 'Kategori berhasil dihapus.');
        }
    }

    public function render()
    {
        return view('livewire.admin.dashboard', [
            'totalRecipes' => Resep::count(),
            'totalPlaces' => Restoran::count(),
            'totalCategories' => Kategori::count(),
            'totalUsers' => User::count(),
            'recipes' => Resep::with('kategori')->latest('id')->get(),
            'places' => Restoran::latest('id')->get(),
            'categories' => Kategori::withCount('resep')->get(),
        ])->layout('layouts.app');
    }
}
