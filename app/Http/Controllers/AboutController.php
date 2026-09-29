<?php

namespace App\Http\Controllers;

use App\Models\CompanyProfile;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $company = CompanyProfile::first();
        $categories = ServiceCategory::with('services')->where('is_active', true)->get();

        return view('about', compact('company', 'categories'));
    }
}
