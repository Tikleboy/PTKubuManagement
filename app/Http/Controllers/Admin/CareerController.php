<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Career;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CareerController extends Controller
{
    public function index()
    {
        $careers = Career::orderBy('created_at', 'desc')->get();
        return view('admin.careers.index', compact('careers'));
    }

    public function create()
    {
        return view('admin.careers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'position' => 'required|string|max:255',
            'employment_type' => 'required|string|in:Full-time,Part-time,Contract',
            'location' => 'required|string|max:255',
            'description' => 'required|string|max:10000',
            'requirements' => 'required|string|max:10000',
            'application_info' => 'nullable|string|max:1000',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['slug'] = Str::slug($validated['position']) . '-' . rand(100, 999);
        $validated['is_published'] = $request->has('is_published');

        Career::create($validated);

        return redirect()->route('admin.careers.index')->with('success', 'Lowongan pekerjaan berhasil ditambahkan.');
    }

    public function edit(Career $career)
    {
        return view('admin.careers.edit', compact('career'));
    }

    public function update(Request $request, Career $career)
    {
        $validated = $request->validate([
            'position' => 'required|string|max:255',
            'employment_type' => 'required|string|in:Full-time,Part-time,Contract',
            'location' => 'required|string|max:255',
            'description' => 'required|string|max:10000',
            'requirements' => 'required|string|max:10000',
            'application_info' => 'nullable|string|max:1000',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['is_published'] = $request->has('is_published');

        $career->update($validated);

        return redirect()->route('admin.careers.index')->with('success', 'Lowongan pekerjaan berhasil diperbarui.');
    }

    public function togglePublish(Career $career)
    {
        $career->update(['is_published' => !$career->is_published]);
        return back()->with('success', 'Status publikasi lowongan berhasil diubah.');
    }

    public function destroy(Career $career)
    {
        $career->delete();
        return redirect()->route('admin.careers.index')->with('success', 'Lowongan pekerjaan berhasil dihapus.');
    }
}
