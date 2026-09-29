<?php

namespace App\Http\Controllers;

use App\Models\GalleryCategory;
use App\Models\GalleryImage;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $group = $request->query('group', 'all'); // 'all', 'landscape', 'housekeeping'
        $categorySlug = $request->query('category', null);

        $query = GalleryImage::with('category')->where('is_published', true)->orderBy('sort_order');

        if ($group !== 'all' && in_array($group, ['landscape', 'housekeeping'])) {
            $query->where('parent_group', $group);
        }

        if ($categorySlug) {
            $query->whereHas('category', function ($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        }

        $images = $query->get();

        $landscapeCategories = GalleryCategory::where('parent_group', 'landscape')->orderBy('sort_order')->get();
        $housekeepingCategories = GalleryCategory::where('parent_group', 'housekeeping')->orderBy('sort_order')->get();

        return view('gallery.index', compact(
            'images',
            'landscapeCategories',
            'housekeepingCategories',
            'group',
            'categorySlug'
        ));
    }
}
