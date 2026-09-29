<?php

namespace App\Http\Controllers;

use App\Models\ContactSetting;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contact = ContactSetting::first();

        return view('contact.index', compact('contact'));
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'property_type' => 'nullable|string|max:100',
            'service_needed' => 'nullable|string|max:100',
            'message' => 'required|string|max:3000',
        ]);

        Inquiry::create($validated);

        return redirect()->route('contact.index')
            ->with('success', __('Your message has been sent successfully. The Kubu Management Bali team will contact you shortly.'));
    }
}
