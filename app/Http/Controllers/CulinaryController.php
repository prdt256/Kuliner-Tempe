<?php

namespace App\Http\Controllers;

use App\Models\Restoran;
use App\Models\MenuRestoran;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;

class CulinaryController extends Controller
{
    public function index()
    {
        return view('tempat.index');
    }

    public function show($id)
    {
        $tempat = Restoran::with('menu')->findOrFail($id);
        return view('tempat.show', compact('tempat'));
    }

    public function create()
    {
        return view('tempat.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_restoran' => 'required|string|max:255',
            'alamat' => 'required|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'deskripsi' => 'required|string',
            'media' => 'nullable|array',
            'media.*' => 'file|mimes:jpeg,png,jpg,webp,jfif,gif,mp4|max:10240',
            'menu_nama' => 'nullable|array',
            'menu_nama.*' => 'nullable|string|max:255',
            'menu_harga' => 'nullable|array',
            'menu_harga.*' => 'nullable|numeric',
            'menu_deskripsi' => 'nullable|array',
            'menu_deskripsi.*' => 'nullable|string',
        ]);

        $mediaPaths = [];
        if ($request->hasFile('media')) {
            $mediaDir = public_path('media');
            if (!is_dir($mediaDir)) {
                mkdir($mediaDir, 0755, true);
            }

            foreach ($request->file('media') as $file) {
                $ext = strtolower($file->getClientOriginalExtension());
                if (in_array($ext, ['mp4', 'webm', 'ogg'])) {
                    $filename = time() . '_' . uniqid() . '.' . $ext;
                    $file->move($mediaDir, $filename);
                    $mediaPaths[] = 'media/' . $filename;
                } else {
                    try {
                        $filename = time() . '_' . uniqid() . '.webp';
                        $destination = $mediaDir . '/' . $filename;
                        $image = Image::decode($file->getPathname());
                        $image->save($destination);
                        $mediaPaths[] = 'media/' . $filename;
                    } catch (\Throwable $e) {
                        $filename = time() . '_' . uniqid() . '.' . $ext;
                        $file->move($mediaDir, $filename);
                        $mediaPaths[] = 'media/' . $filename;
                    }
                }
            }
        }

        $restoran = Restoran::create([
            'nama_restoran' => $validated['nama_restoran'],
            'alamat' => $validated['alamat'],
            'latitude' => $validated['latitude'] ?? null,
            'longitude' => $validated['longitude'] ?? null,
            'deskripsi' => $validated['deskripsi'],
            'gambar' => !empty($mediaPaths) ? json_encode($mediaPaths) : null,
        ]);

        // Save menu items if provided
        if (!empty($request->menu_nama)) {
            foreach ($request->menu_nama as $index => $namaMenu) {
                if (!empty(trim($namaMenu))) {
                    MenuRestoran::create([
                        'restoran_id' => $restoran->id,
                        'nama_menu' => $namaMenu,
                        'harga' => $request->menu_harga[$index] ?? 0,
                        'deskripsi' => $request->menu_deskripsi[$index] ?? '',
                    ]);
                }
            }
        }

        return redirect()->route('tempat.show', $restoran->id)->with('success', 'Tempat kuliner berhasil ditambahkan!');
    }
}
