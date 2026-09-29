<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactSetting;
use Illuminate\Http\Request;

class ContactSettingController extends Controller
{
    public function edit()
    {
        $contact = ContactSetting::firstOrCreate(['id' => 1]);
        return view('admin.contact.edit', compact('contact'));
    }

    public function update(Request $request)
    {
        $contact = ContactSetting::firstOrCreate(['id' => 1]);

        $validated = $request->validate([
            'whatsapp_number' => 'required|string|max:50',
            'default_whatsapp_message' => 'required|string|max:500',
            'email' => 'required|email|max:255',
            'instagram' => 'nullable|string|max:100',
            'instagram_url' => 'nullable|url|max:255',
            'office_address' => 'required|string',
            'google_maps_embed' => 'nullable|string',
            'operating_hours' => 'nullable|string|max:255',
        ]);

        $contact->update($validated);

        return redirect()->route('admin.contact.edit')->with('success', 'Pengaturan Kontak & WhatsApp berhasil disimpan.');
    }
}
