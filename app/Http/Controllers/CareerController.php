<?php

namespace App\Http\Controllers;

use App\Models\Career;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    public function index()
    {
        $careers = Career::where('is_published', true)->orderBy('sort_order')->get();

        return view('career.index', compact('careers'));
    }

    public function show($slug)
    {
        $career = Career::where('slug', $slug)->where('is_published', true)->firstOrFail();

        return view('career.show', compact('career'));
    }
}
