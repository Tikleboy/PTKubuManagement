<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('images')->orderBy('sort_order')->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'main_image' => 'nullable|image|max:5120',
            'before_image' => 'nullable|image|max:5120',
            'process_image' => 'nullable|image|max:5120',
            'after_image' => 'nullable|image|max:5120',
            'sort_order' => 'integer|min:0',
        ]);

        $validated['slug'] = Str::slug($validated['title']) . '-' . rand(100, 999);
        $validated['is_published'] = $request->has('is_published');

        if ($request->hasFile('main_image')) {
            $path = $request->file('main_image')->store('uploads/projects', 'public');
            $validated['main_image'] = 'storage/' . $path;
        }

        $project = Project::create($validated);

        // Save Before / Process / After images
        if ($request->hasFile('before_image')) {
            $path = $request->file('before_image')->store('uploads/projects', 'public');
            ProjectImage::create([
                'project_id' => $project->id,
                'image_type' => 'before',
                'image_path' => 'storage/' . $path,
                'caption' => 'Kondisi awal sebelum pengerjaan',
                'sort_order' => 1,
            ]);
        }

        if ($request->hasFile('process_image')) {
            $path = $request->file('process_image')->store('uploads/projects', 'public');
            ProjectImage::create([
                'project_id' => $project->id,
                'image_type' => 'process',
                'image_path' => 'storage/' . $path,
                'caption' => 'Proses pengerjaan tenaga ahli',
                'sort_order' => 2,
            ]);
        }

        if ($request->hasFile('after_image')) {
            $path = $request->file('after_image')->store('uploads/projects', 'public');
            ProjectImage::create([
                'project_id' => $project->id,
                'image_type' => 'after',
                'image_path' => 'storage/' . $path,
                'caption' => 'Hasil akhir pengerjaan',
                'sort_order' => 3,
            ]);
        }

        return redirect()->route('admin.projects.index')->with('success', 'Project berhasil ditambahkan.');
    }

    public function edit(Project $project)
    {
        $project->load('images');
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'main_image' => 'nullable|image|max:5120',
            'before_image' => 'nullable|image|max:5120',
            'process_image' => 'nullable|image|max:5120',
            'after_image' => 'nullable|image|max:5120',
            'sort_order' => 'integer|min:0',
        ]);

        $validated['is_published'] = $request->has('is_published');

        if ($request->hasFile('main_image')) {
            $path = $request->file('main_image')->store('uploads/projects', 'public');
            $validated['main_image'] = 'storage/' . $path;
        }

        $project->update($validated);

        if ($request->hasFile('before_image')) {
            $path = $request->file('before_image')->store('uploads/projects', 'public');
            ProjectImage::updateOrCreate(
                ['project_id' => $project->id, 'image_type' => 'before'],
                ['image_path' => 'storage/' . $path, 'caption' => 'Kondisi awal sebelum pengerjaan']
            );
        }

        if ($request->hasFile('process_image')) {
            $path = $request->file('process_image')->store('uploads/projects', 'public');
            ProjectImage::updateOrCreate(
                ['project_id' => $project->id, 'image_type' => 'process'],
                ['image_path' => 'storage/' . $path, 'caption' => 'Proses pengerjaan tenaga ahli']
            );
        }

        if ($request->hasFile('after_image')) {
            $path = $request->file('after_image')->store('uploads/projects', 'public');
            ProjectImage::updateOrCreate(
                ['project_id' => $project->id, 'image_type' => 'after'],
                ['image_path' => 'storage/' . $path, 'caption' => 'Hasil akhir pengerjaan']
            );
        }

        return redirect()->route('admin.projects.index')->with('success', 'Project berhasil diperbarui.');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Project berhasil dihapus.');
    }
}
