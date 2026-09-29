<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::with('images')->where('is_published', true)->orderBy('sort_order');

        $activeCategory = $request->query('category', 'all');
        if ($activeCategory !== 'all') {
            $query->where('category', $activeCategory);
        }

        $projects = $query->paginate(9)->withQueryString();

        $categories = Project::where('is_published', true)
            ->select('category')
            ->distinct()
            ->pluck('category');

        return view('projects.index', compact('projects', 'categories', 'activeCategory'));
    }

    public function show($slug)
    {
        $project = Project::with('images')->where('slug', $slug)->where('is_published', true)->firstOrFail();
        $relatedProjects = Project::where('id', '!=', $project->id)
            ->where('is_published', true)
            ->take(3)
            ->get();

        return view('projects.show', compact('project', 'relatedProjects'));
    }
}
