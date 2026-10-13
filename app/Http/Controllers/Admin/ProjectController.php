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
            'main_image' => 'nullable|image|mimes:jpeg,png,webp,jpg|max:5120',
            'before_image' => 'nullable|image|mimes:jpeg,png,webp,jpg|max:5120',
            'process_image' => 'nullable|image|mimes:jpeg,png,webp,jpg|max:5120',
            'after_image' => 'nullable|image|mimes:jpeg,png,webp,jpg|max:5120',
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
            'main_image' => 'nullable|image|mimes:jpeg,png,webp,jpg|max:5120',
            'before_image' => 'nullable|image|mimes:jpeg,png,webp,jpg|max:5120',
            'process_image' => 'nullable|image|mimes:jpeg,png,webp,jpg|max:5120',
            'after_image' => 'nullable|image|mimes:jpeg,png,webp,jpg|max:5120',
            'sort_order' => 'integer|min:0',
        ]);

        $validated['is_published'] = $request->has('is_published');

        $oldMainImage = $project->main_image;
        $oldBeforeImage = $project->beforeImage()?->image_path;
        $oldProcessImage = $project->processImage()?->image_path;
        $oldAfterImage = $project->afterImage()?->image_path;

        if ($request->hasFile('main_image')) {
            $path = $request->file('main_image')->store('uploads/projects', 'public');
            $validated['main_image'] = 'storage/' . $path;
        }

        $newBeforePath = null;
        if ($request->hasFile('before_image')) {
            $path = $request->file('before_image')->store('uploads/projects', 'public');
            $newBeforePath = 'storage/' . $path;
        }

        $newProcessPath = null;
        if ($request->hasFile('process_image')) {
            $path = $request->file('process_image')->store('uploads/projects', 'public');
            $newProcessPath = 'storage/' . $path;
        }

        $newAfterPath = null;
        if ($request->hasFile('after_image')) {
            $path = $request->file('after_image')->store('uploads/projects', 'public');
            $newAfterPath = 'storage/' . $path;
        }

        \Illuminate\Support\Facades\DB::transaction(function () use ($project, $validated, $newBeforePath, $newProcessPath, $newAfterPath) {
            $project->update($validated);

            if ($newBeforePath) {
                ProjectImage::updateOrCreate(
                    ['project_id' => $project->id, 'image_type' => 'before'],
                    ['image_path' => $newBeforePath, 'caption' => 'Kondisi awal sebelum pengerjaan']
                );
            }

            if ($newProcessPath) {
                ProjectImage::updateOrCreate(
                    ['project_id' => $project->id, 'image_type' => 'process'],
                    ['image_path' => $newProcessPath, 'caption' => 'Proses pengerjaan tenaga ahli']
                );
            }

            if ($newAfterPath) {
                ProjectImage::updateOrCreate(
                    ['project_id' => $project->id, 'image_type' => 'after'],
                    ['image_path' => $newAfterPath, 'caption' => 'Hasil akhir pengerjaan']
                );
            }
        });

        // After transaction commits successfully, clean up replaced unreferenced uploads
        if ($request->hasFile('main_image') && $oldMainImage && $oldMainImage !== $project->main_image) {
            \App\Services\ManagedUploadService::deleteIfUnreferenced($oldMainImage);
        }
        if ($newBeforePath && $oldBeforeImage && $oldBeforeImage !== $newBeforePath) {
            \App\Services\ManagedUploadService::deleteIfUnreferenced($oldBeforeImage);
        }
        if ($newProcessPath && $oldProcessImage && $oldProcessImage !== $newProcessPath) {
            \App\Services\ManagedUploadService::deleteIfUnreferenced($oldProcessImage);
        }
        if ($newAfterPath && $oldAfterImage && $oldAfterImage !== $newAfterPath) {
            \App\Services\ManagedUploadService::deleteIfUnreferenced($oldAfterImage);
        }

        return redirect()->route('admin.projects.index')->with('success', 'Project berhasil diperbarui.');
    }

    public function destroy(Project $project)
    {
        $mainImage = $project->main_image;
        $childImages = $project->images()->pluck('image_path')->all();

        \Illuminate\Support\Facades\DB::transaction(function () use ($project) {
            $project->images()->delete();
            $project->delete();
        });

        if ($mainImage) {
            \App\Services\ManagedUploadService::deleteIfUnreferenced($mainImage);
        }
        foreach ($childImages as $path) {
            \App\Services\ManagedUploadService::deleteIfUnreferenced($path);
        }

        return redirect()->route('admin.projects.index')->with('success', 'Project berhasil dihapus.');
    }
}
