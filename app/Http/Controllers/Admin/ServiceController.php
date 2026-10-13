<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::with('category')->orderBy('service_category_id')->orderBy('sort_order')->get();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        $categories = ServiceCategory::orderBy('sort_order')->get();
        return view('admin.services.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_category_id' => 'required|exists:service_categories,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'features' => 'nullable|string', // newline separated
            'image' => 'nullable|image|mimes:jpeg,png,webp,jpg|max:4096',
            'sort_order' => 'integer|min:0',
            'is_published' => 'nullable',
        ], [
            '*.uploaded' => 'File (:attribute) gagal diunggah. Pastikan ukuran file tidak melebihi batas upload server (maksimal 5MB).',
            '*.max' => 'Ukuran file (:attribute) melebihi batas maksimal 5 MB.',
            '*.image' => 'File (:attribute) harus berupa gambar yang valid (JPG, PNG, atau WEBP).',
            '*.mimes' => 'Format file (:attribute) harus bertipe JPG, JPEG, PNG, atau WEBP.',
        ], [
            'service_category_id' => 'Kategori Layanan',
            'title' => 'Nama Layanan',
            'image' => 'Foto Layanan',
        ]);

        $validated['slug'] = Str::slug($validated['title']) . '-' . rand(100, 999);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('uploads/services', 'public');
            $validated['image'] = 'storage/' . $path;
        }

        // Convert newline separated string to array
        if (!empty($validated['features'])) {
            $validated['features'] = array_values(array_filter(array_map('trim', explode("\n", $validated['features']))));
        } else {
            $validated['features'] = [];
        }

        $validated['is_published'] = $request->boolean('is_published');

        Service::create($validated);

        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function edit(Service $service)
    {
        $categories = ServiceCategory::orderBy('sort_order')->get();
        return view('admin.services.edit', compact('service', 'categories'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'service_category_id' => 'required|exists:service_categories,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'features' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,webp,jpg|max:4096',
            'sort_order' => 'integer|min:0',
            'is_published' => 'nullable',
        ], [
            '*.uploaded' => 'File (:attribute) gagal diunggah. Pastikan ukuran file tidak melebihi batas upload server (maksimal 5MB).',
            '*.max' => 'Ukuran file (:attribute) melebihi batas maksimal 5 MB.',
            '*.image' => 'File (:attribute) harus berupa gambar yang valid (JPG, PNG, atau WEBP).',
            '*.mimes' => 'Format file (:attribute) harus bertipe JPG, JPEG, PNG, atau WEBP.',
        ], [
            'service_category_id' => 'Kategori Layanan',
            'title' => 'Nama Layanan',
            'image' => 'Foto Layanan',
        ]);

        $oldImage = $service->image;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('uploads/services', 'public');
            $validated['image'] = 'storage/' . $path;
        }

        if (!empty($validated['features'])) {
            $validated['features'] = array_values(array_filter(array_map('trim', explode("\n", $validated['features']))));
        } else {
            $validated['features'] = [];
        }

        $validated['is_published'] = $request->boolean('is_published');

        \Illuminate\Support\Facades\DB::transaction(function () use ($service, $validated) {
            $service->update($validated);
        });

        if ($request->hasFile('image') && $oldImage && $oldImage !== $service->image) {
            \App\Services\ManagedUploadService::deleteIfUnreferenced($oldImage);
        }

        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy(Service $service)
    {
        $oldImage = $service->image;

        \Illuminate\Support\Facades\DB::transaction(function () use ($service) {
            $service->delete();
        });

        if ($oldImage) {
            \App\Services\ManagedUploadService::deleteIfUnreferenced($oldImage);
        }

        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil dihapus.');
    }
}
