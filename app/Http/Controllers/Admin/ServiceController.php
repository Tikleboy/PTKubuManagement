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
            'image' => 'nullable|image|max:4096',
            'sort_order' => 'integer|min:0',
            'is_published' => 'nullable',
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
            'image' => 'nullable|image|max:4096',
            'sort_order' => 'integer|min:0',
            'is_published' => 'nullable',
        ]);

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

        $service->update($validated);

        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil dihapus.');
    }
}
