<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class KamarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kamars = Kamar::orderBy('lantai')
                      ->orderBy('nomor_kamar')
                      ->get();
        
        return view('admin.kamars.index', compact('kamars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kamars.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_kamar' => 'required|string|max:10|unique:kamars,nomor_kamar',
            'lantai' => 'required|integer|min:1|max:10',
            'harga' => 'required|numeric|min:0',
            'fasilitas' => 'nullable|array',
            'fasilitas.*' => 'string|max:255',
            'gambar' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif',
                'max:2048',
                'mimetypes:image/jpeg,image/png,image/gif',
            ],
            'tersedia' => 'boolean'
        ], [
            'gambar.image' => 'File harus berupa gambar yang valid',
            'gambar.mimes' => 'Format file harus jpeg, png, jpg, atau gif',
            'gambar.max' => 'Ukuran file tidak boleh melebihi 2MB',
            'gambar.uploaded' => 'Gagal mengunggah file. Pastikan file tidak rusak dan ukurannya tidak melebihi batas',
            'gambar.mimetypes' => 'Tipe file tidak didukung. Gunakan format jpeg, png, atau gif',
        ]);

        if ($request->hasFile('gambar')) {
            try {
                $file = $request->file('gambar');
                
                // Verify the file is actually an image
                if (!@getimagesize($file->getPathname())) {
                    return back()->withInput()->withErrors([
                        'gambar' => 'File yang diunggah bukan gambar yang valid.'
                    ]);
                }

                $path = $file->store('public/kamar');
                $validated['gambar'] = str_replace('public/', 'storage/', $path);
            } catch (\Exception $e) {
                Log::error('Gagal mengunggah gambar: ' . $e->getMessage());
                return back()->withInput()->withErrors([
                    'gambar' => 'Gagal mengunggah gambar. ' . $e->getMessage()
                ]);
            }
        }

        $validated['fasilitas'] = $validated['fasilitas'] ?? [];
        $validated['tersedia'] = $request->has('tersedia');

        Kamar::create($validated);

        return redirect()->route('admin.kamars.index')
                        ->with('success', 'Kamar berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kamar $kamar)
    {
        return view('admin.kamars.edit', compact('kamar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kamar $kamar)
    {
        $validated = $request->validate([
            'nomor_kamar' => [
                'required',
                'string',
                'max:10',
                Rule::unique('kamars')->ignore($kamar->id)
            ],
            'lantai' => 'required|integer|min:1|max:10',
            'harga' => 'required|numeric|min:0',
            'fasilitas' => 'nullable|array',
            'fasilitas.*' => 'string|max:255',
            'gambar' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif',
                'max:2048',
                'mimetypes:image/jpeg,image/png,image/gif',
            ],
            'tersedia' => 'boolean'
        ], [
            'gambar.image' => 'File harus berupa gambar yang valid',
            'gambar.mimes' => 'Format file harus jpeg, png, jpg, atau gif',
            'gambar.max' => 'Ukuran file tidak boleh melebihi 2MB',
            'gambar.uploaded' => 'Gagal mengunggah file. Pastikan file tidak rusak dan ukurannya tidak melebihi batas',
            'gambar.mimetypes' => 'Tipe file tidak didukung. Gunakan format jpeg, png, atau gif',
        ]);

        if ($request->hasFile('gambar')) {
            try {
                $file = $request->file('gambar');
                
                // Verify the file is actually an image
                if (!@getimagesize($file->getPathname())) {
                    return back()->withInput()->withErrors([
                        'gambar' => 'File yang diunggah bukan gambar yang valid.'
                    ]);
                }
                
                // Hapus gambar lama jika ada
                if ($kamar->gambar) {
                    Storage::delete(str_replace('storage/', 'public/', $kamar->gambar));
                }
                
                $path = $file->store('public/kamar');
                $validated['gambar'] = str_replace('public/', 'storage/', $path);
            } catch (\Exception $e) {
                Log::error('Gagal mengunggah gambar: ' . $e->getMessage());
                return back()->withInput()->withErrors([
                    'gambar' => 'Gagal mengunggah gambar. ' . $e->getMessage()
                ]);
            }
        }

        $validated['fasilitas'] = $validated['fasilitas'] ?? [];
        $validated['tersedia'] = $request->has('tersedia');

        $kamar->update($validated);

        return redirect()->route('admin.kamars.index')
                        ->with('success', 'Data kamar berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kamar $kamar)
    {
        // Hapus gambar jika ada
        if ($kamar->gambar) {
            Storage::delete(str_replace('storage/', 'public/', $kamar->gambar));
        }
        
        $kamar->delete();
        
        return redirect()->route('admin.kamars.index')
                        ->with('success', 'Kamar berhasil dihapus');
    }
}
