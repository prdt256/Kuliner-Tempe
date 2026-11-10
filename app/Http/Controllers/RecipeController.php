<?php

namespace App\Http\Controllers;

use App\Models\Resep;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Laravel\Facades\Image;

class RecipeController extends Controller
{
    public function index()
    {
        return view('resep.index');
    }

    public function show($id)
    {
        $resep = Resep::with('kategori')->findOrFail($id);
        return view('resep.show', compact('resep'));
    }

    public function create()
    {
        $categories = Kategori::all();
        return view('resep.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_id' => 'nullable|integer|exists:kategori,id',
            'biaya' => 'nullable|string|max:50',
            'durasi_val' => 'nullable|string|max:20',
            'durasi_unit' => 'nullable|string|max:20',
            'bahan' => 'required|string',
            'langkah' => 'required|string',
            'media' => 'nullable|array',
            'media.*' => 'file|mimes:jpeg,png,jpg,webp,jfif,gif,mp4|max:10240',
        ]);

        $durasi = trim(($request->input('durasi_val') ?? '') . ' ' . ($request->input('durasi_unit') ?? ''));

        $mediaPaths = [];
        if ($request->hasFile('media')) {
            $mediaDir = public_path('media');
            if (!is_dir($mediaDir)) {
                mkdir($mediaDir, 0755, true);
            }

            foreach ($request->file('media') as $file) {
                $ext = strtolower($file->getClientOriginalExtension());
                if (in_array($ext, ['mp4', 'webm', 'ogg'])) {
                    // Video file
                    $filename = time() . '_' . uniqid() . '.' . $ext;
                    $file->move($mediaDir, $filename);
                    $mediaPaths[] = 'media/' . $filename;
                } else {
                    // Image: Convert automatically to WebP with Intervention Image
                    try {
                        $filename = time() . '_' . uniqid() . '.webp';
                        $destination = $mediaDir . '/' . $filename;
                        $image = Image::decode($file->getPathname());
                        $image->save($destination);
                        $mediaPaths[] = 'media/' . $filename;
                    } catch (\Throwable $e) {
                        // Fallback simple upload if driver fails
                        $filename = time() . '_' . uniqid() . '.' . $ext;
                        $file->move($mediaDir, $filename);
                        $mediaPaths[] = 'media/' . $filename;
                    }
                }
            }
        }

        $penulis = Auth::check() ? Auth::user()->name : ($request->input('penulis') ?? 'Anonim');

        $resep = Resep::create([
            'judul' => $validated['judul'],
            'kategori_id' => $validated['kategori_id'] ?: 1,
            'penulis' => $penulis,
            'biaya' => $validated['biaya'] ?? 'Rp 10.000',
            'durasi' => $durasi ?: '15 Menit',
            'bahan' => $validated['bahan'],
            'langkah' => $validated['langkah'],
            'gambar' => !empty($mediaPaths) ? json_encode($mediaPaths) : null,
        ]);

        return redirect()->route('resep.show', $resep->id)->with('success', 'Resep berhasil ditambahkan!');
    }
}
