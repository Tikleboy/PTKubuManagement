<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use App\Models\WebsiteSetting;
use Illuminate\Http\Request;

class CompanyProfileController extends Controller
{
    public function edit()
    {
        $company = CompanyProfile::firstOrCreate(['id' => 1], [
            'name' => 'PT. KUBU MANAGEMENT BALI',
            'tagline' => 'Professional Property Care Services in Bali',
            'subtagline' => 'LANDSCAPE • HOUSEKEEPING • PROPERTY CARE',
            'description' => 'KUBU MANAGEMENT BALI adalah perusahaan jasa yang bergerak dalam bidang pengelolaan landscape, perawatan taman, dan housekeeping untuk hotel, villa, residential property, serta properti komersial di Bali.',
            'vision' => 'To become a trusted professional property service partner in Bali.',
            'mission' => [
                'Memberikan pelayanan profesional.',
                'Menjaga kualitas dan kebersihan properti.',
                'Mengembangkan tenaga kerja yang kompeten.',
                'Memberikan solusi sesuai kebutuhan setiap klien.',
            ],
        ]);

        $settings = WebsiteSetting::firstOrCreate(['id' => 1]);

        return view('admin.company.edit', compact('company', 'settings'));
    }

    public function update(Request $request)
    {
        $company = CompanyProfile::firstOrFail();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'tagline' => 'required|string|max:255',
            'subtagline' => 'nullable|string|max:255',
            'description' => 'required|string',
            'vision' => 'required|string',
            'mission' => 'nullable|array',
            'about_image' => 'nullable|image|max:4096',
            'hero_image' => 'nullable|image|max:4096',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);

        if ($request->hasFile('about_image')) {
            $path = $request->file('about_image')->store('uploads/company', 'public');
            $validated['about_image'] = 'storage/' . $path;
        }

        if ($request->hasFile('hero_image')) {
            $path = $request->file('hero_image')->store('uploads/company', 'public');
            $validated['hero_image'] = 'storage/' . $path;
        }

        // Clean empty missions
        if (isset($validated['mission']) && is_array($validated['mission'])) {
            $validated['mission'] = array_values(array_filter($validated['mission'], fn($m) => !empty(trim($m))));
        }

        $company->update($validated);

        $settings = WebsiteSetting::firstOrCreate(['id' => 1]);
        $settings->update([
            'meta_title' => $request->input('meta_title') ?? $settings->meta_title,
            'meta_description' => $request->input('meta_description') ?? $settings->meta_description,
        ]);

        return redirect()->route('admin.company.edit')->with('success', 'Profil Perusahaan berhasil diperbarui.');
    }
}
