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
            'description' => "PT KUBU MANAGEMENT BALI adalah perusahaan jasa profesional yang bergerak di bidang pengelolaan lanskap, perawatan taman, dan tata graha (housekeeping) untuk hotel, vila, properti hunian, serta properti komersial di Bali.\n\nDidirikan dan dipimpin oleh I Wayan Suardika & Ni Putu Devi Handayani, KUBU MANAGEMENT hadir dengan komitmen untuk memberikan pelayanan berkualitas, menjaga keindahan lingkungan, serta memastikan setiap properti dikelola dengan baik, bersih, nyaman, dan terawat.\n\nDengan mengutamakan profesionalisme, ketelitian, dan kepuasan pelanggan, PT KUBU MANAGEMENT BALI terus berupaya menjadi mitra terpercaya dalam menciptakan lingkungan properti yang asri, harmonis, dan bernilai tinggi. Berlandaskan semangat pelayanan dan tanggung jawab, kami percaya bahwa setiap detail memiliki arti penting dalam menghadirkan kenyamanan dan kualitas terbaik bagi setiap klien.\n\nKUBU MANAGEMENT BALI — Merawat Keindahan, Menjaga Kenyamanan, Membangun Kepercayaan.",
            'vision' => 'Menjadi mitra layanan properti profesional tepercaya di Bali.',
            'mission' => [
                'Memberikan pelayanan profesional dan dapat diandalkan.',
                'Menjaga standar kualitas, kebersihan, dan estetika properti secara konsisten.',
                'Mengembangkan tenaga kerja yang kompeten, disiplin, dan terlatih.',
                'Memberikan solusi yang disesuaikan dengan kebutuhan setiap klien.',
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
            'about_image' => 'nullable|image|mimes:jpeg,png,webp,jpg|max:4096',
            'hero_image' => 'nullable|image|mimes:jpeg,png,webp,jpg|max:4096',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);

        $oldAboutImage = $company->about_image;
        $oldHeroImage = $company->hero_image;

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

        \Illuminate\Support\Facades\DB::transaction(function () use ($company, $validated, $request) {
            $company->update($validated);

            $settings = WebsiteSetting::firstOrCreate(['id' => 1]);
            $settings->update([
                'meta_title' => $request->input('meta_title') ?? $settings->meta_title,
                'meta_description' => $request->input('meta_description') ?? $settings->meta_description,
            ]);
        });

        // After transaction commits successfully, clean up replaced unreferenced uploads
        if ($request->hasFile('about_image') && $oldAboutImage && $oldAboutImage !== $company->about_image) {
            \App\Services\ManagedUploadService::deleteIfUnreferenced($oldAboutImage);
        }
        if ($request->hasFile('hero_image') && $oldHeroImage && $oldHeroImage !== $company->hero_image) {
            \App\Services\ManagedUploadService::deleteIfUnreferenced($oldHeroImage);
        }

        return redirect()->route('admin.company.edit')->with('success', 'Profil Perusahaan berhasil diperbarui.');
    }
}
