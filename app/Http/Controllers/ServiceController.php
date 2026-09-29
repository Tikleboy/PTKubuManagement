<?php

namespace App\Http\Controllers;

use App\Models\ServiceCategory;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $categories = ServiceCategory::with(['services' => function ($q) {
            $q->where('is_published', true)->orderBy('sort_order');
        }])->where('is_active', true)->orderBy('sort_order')->get();

        return view('services.index', compact('categories'));
    }

    public function landscape()
    {
        $category = ServiceCategory::with(['services' => function ($q) {
            $q->where('is_published', true)->orderBy('sort_order');
        }])->where('slug', 'kubu-landscape')->firstOrFail();

        return view('services.landscape', compact('category'));
    }

    public function housekeeping()
    {
        $category = ServiceCategory::with(['services' => function ($q) {
            $q->where('is_published', true)->orderBy('sort_order');
        }])->where('slug', 'kubu-clean')->firstOrFail();

        return view('services.housekeeping', compact('category'));
    }

    public function show($slug)
    {
        $service = Service::with('category')->where('slug', $slug)->where('is_published', true)->firstOrFail();
        $relatedServices = Service::where('service_category_id', $service->service_category_id)
            ->where('id', '!=', $service->id)
            ->where('is_published', true)
            ->take(3)
            ->get();

        return view('services.show', compact('service', 'relatedServices'));
    }
}
