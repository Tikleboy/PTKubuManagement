<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Project;
use App\Models\GalleryImage;
use App\Models\Career;
use App\Models\Inquiry;
use App\Models\ContactSetting;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'services' => Service::count(),
            'projects' => Project::count(),
            'gallery' => GalleryImage::count(),
            'careers' => Career::count(),
            'inquiries_new' => Inquiry::where('status', 'new')->count(),
            'inquiries_total' => Inquiry::count(),
        ];

        $recentInquiries = Inquiry::latest()->take(5)->get();
        $contact = ContactSetting::first();

        return view('admin.dashboard', compact('stats', 'recentInquiries', 'contact'));
    }
}
