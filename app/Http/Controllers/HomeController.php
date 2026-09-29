<?php

namespace App\Http\Controllers;

use App\Models\CompanyProfile;
use App\Models\ServiceCategory;
use App\Models\Project;
use App\Models\GalleryImage;
use App\Models\ContactSetting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $company = CompanyProfile::first();
        $categories = ServiceCategory::with(['services' => function ($q) {
            $q->where('is_published', true)->orderBy('sort_order');
        }])->where('is_active', true)->orderBy('sort_order')->get();

        $featuredProjects = Project::with('images')
            ->where('is_published', true)
            ->orderBy('sort_order')
            ->take(4)
            ->get();

        $galleryPreviews = GalleryImage::where('is_published', true)
            ->orderBy('sort_order')
            ->take(6)
            ->get();

        $contact = ContactSetting::first();

        return view('home', compact('company', 'categories', 'featuredProjects', 'galleryPreviews', 'contact'));
    }
}
