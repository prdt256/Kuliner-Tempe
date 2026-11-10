<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Restoran;

class CulinaryList extends Component
{
    public $search = '';

    public function render()
    {
        $query = Restoran::latest('id');

        if (!empty(trim($this->search))) {
            $s = '%' . trim($this->search) . '%';
            $query->where(function ($q) use ($s) {
                $q->where('nama_restoran', 'like', $s)
                  ->orWhere('alamat', 'like', $s)
                  ->orWhere('deskripsi', 'like', $s);
            });
        }

        $restaurants = $query->paginate(9);

        return view('livewire.culinary-list', [
            'restaurants' => $restaurants,
        ]);
    }
}
