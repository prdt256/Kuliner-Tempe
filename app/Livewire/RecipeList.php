<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Resep;
use App\Models\Kategori;

class RecipeList extends Component
{
    public $search = '';
    public $category = '';

    public function setCategory($catId)
    {
        if ($this->category == $catId) {
            $this->category = '';
        } else {
            $this->category = $catId;
        }
    }

    public function render()
    {
        $query = Resep::with('kategori')->latest('id');

        if (!empty(trim($this->search))) {
            $s = '%' . trim($this->search) . '%';
            $query->where(function ($q) use ($s) {
                $q->where('judul', 'like', $s)
                  ->orWhere('penulis', 'like', $s)
                  ->orWhere('bahan', 'like', $s);
            });
        }

        if (!empty($this->category)) {
            $query->where('kategori_id', $this->category);
        }

        $recipes = $query->paginate(9);
        $categories = Kategori::all();

        return view('livewire.recipe-list', [
            'recipes' => $recipes,
            'categories' => $categories,
        ]);
    }
}
