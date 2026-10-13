<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryCategory;
use App\Models\GalleryImage;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $images = GalleryImage::with('category')->orderBy('parent_group')->orderBy('sort_order')->get();
        $categories = GalleryCategory::orderBy('parent_group')->orderBy('sort_order')->get();

        return view('admin.gallery.index', compact('images', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'caption' => 'nullable|string|max:500',
            'parent_group' => 'required|in:landscape,housekeeping',
            'gallery_category_id' => 'nullable|exists:gallery_categories,id',
            'image' => 'required|image|mimes:jpeg,png,webp,jpg|max:5120',
            'sort_order' => 'integer|min:0',
        ], [
            'image.uploaded' => 'File Foto Galeri gagal diunggah. Pastikan ukuran file tidak melebihi batas upload server (maksimal 5MB).',
            'image.max' => 'Ukuran Foto Galeri melebihi batas maksimal 5 MB.',
            'image.image' => 'Foto Galeri harus berupa berkas gambar yang valid (JPG, PNG, atau WEBP).',
            'image.mimes' => 'Format file Foto Galeri harus bertipe JPG, JPEG, PNG, atau WEBP.',
        ], [
            'title' => 'Judul Foto',
            'image' => 'Foto Galeri',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('uploads/gallery', 'public');
            $validated['image_path'] = 'storage/' . $path;
        }

        $validated['is_published'] = true;

        GalleryImage::create($validated);

        return redirect()->route('admin.gallery.index')->with('success', 'Foto Galeri berhasil ditambahkan.');
    }

    public function destroy(GalleryImage $image)
    {
        $oldPath = $image->image_path;

        \Illuminate\Support\Facades\DB::transaction(function () use ($image) {
            $image->delete();
        });

        if ($oldPath) {
            \App\Services\ManagedUploadService::deleteIfUnreferenced($oldPath);
        }

        return redirect()->route('admin.gallery.index')->with('success', 'Foto Galeri berhasil dihapus.');
    }
}
