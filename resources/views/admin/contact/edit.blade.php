@extends('layouts.admin')

@section('title', 'Kontak & WhatsApp')

@section('content')
    <div class="max-w-3xl space-y-6">
        <div>
            <h1 class="font-fraunces text-2xl font-bold text-[#6B2203]">
                Pengaturan Kontak & WhatsApp
            </h1>
            <p class="text-xs text-[#7A5B49] mt-0.5">
                Konfigurasi nomor WhatsApp untuk tombol "REQUEST A QUOTE", pesan otomatis, email resmi, dan alamat kantor.
            </p>
        </div>

        <form action="{{ route('admin.contact.update') }}" method="POST" class="bg-white p-6 sm:p-8 rounded-[20px] border border-[#E8DEC8] shadow-warm-sm space-y-5">
            @csrf
            @method('PUT')

            <!-- WhatsApp Configuration -->
            <div class="p-4 rounded-[16px] bg-[#FAF7F2] border border-[#965E03]/30 space-y-4">
                <span class="label-caps text-[#965E03] font-bold block text-xs">
                    INTEGRASI WHATSAPP (UTAMA)
                </span>

                <div>
                    <label class="block text-xs font-bold text-[#6B2203] uppercase mb-1">
                        Nomor WhatsApp Resmi
                    </label>
                    <input type="text" name="whatsapp_number" value="{{ old('whatsapp_number', $contact->whatsapp_number) }}" required placeholder="+62 812-3456-7890" class="w-full px-3 py-2.5 rounded-[10px] bg-white border border-[#E8DEC8] text-xs font-medium">
                    <span class="text-[11px] text-[#7A5B49] mt-1 block">Nomor ini menjadi tujuan seluruh tombol "REQUEST A QUOTE" di website dan mobile.</span>
                </div>

                <div>
                    <label class="block text-xs font-bold text-[#6B2203] uppercase mb-1">
                        Pesan Default WhatsApp (Saat Pengunjung Klik Tombol)
                    </label>
                    <textarea name="default_whatsapp_message" rows="3" required class="w-full px-3 py-2.5 rounded-[10px] bg-white border border-[#E8DEC8] text-xs">{{ old('default_whatsapp_message', $contact->default_whatsapp_message) }}</textarea>
                    <span class="text-[11px] text-[#7A5B49]">Default dari brief: "Halo KUBU MANAGEMENT BALI, saya ingin mendapatkan informasi mengenai layanan Landscape/Housekeeping."</span>
                </div>
            </div>

            <!-- Email & Instagram -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-[#6B2203] uppercase mb-1">Email Resmi</label>
                    <input type="email" name="email" value="{{ old('email', $contact->email) }}" required class="w-full px-3 py-2.5 rounded-[10px] bg-[#FAF7F2] border border-[#E8DEC8] text-xs">
                </div>

                <div>
                    <label class="block text-xs font-bold text-[#6B2203] uppercase mb-1">Akun Instagram</label>
                    <input type="text" name="instagram" value="{{ old('instagram', $contact->instagram) }}" placeholder="@kubumanagementbali" class="w-full px-3 py-2.5 rounded-[10px] bg-[#FAF7F2] border border-[#E8DEC8] text-xs">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-[#6B2203] uppercase mb-1">URL Profil Instagram</label>
                <input type="url" name="instagram_url" value="{{ old('instagram_url', $contact->instagram_url) }}" placeholder="https://instagram.com/kubumanagementbali" class="w-full px-3 py-2.5 rounded-[10px] bg-[#FAF7F2] border border-[#E8DEC8] text-xs">
            </div>

            <!-- Alamat & Jam Kerja -->
            <div>
                <label class="block text-xs font-bold text-[#6B2203] uppercase mb-1">Alamat Kantor di Bali</label>
                <textarea name="office_address" rows="2" required class="w-full px-3 py-2.5 rounded-[10px] bg-[#FAF7F2] border border-[#E8DEC8] text-xs">{{ old('office_address', $contact->office_address) }}</textarea>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-[#6B2203] uppercase mb-1">Jam Operasional</label>
                    <input type="text" name="operating_hours" value="{{ old('operating_hours', $contact->operating_hours) }}" placeholder="Senin - Sabtu: 08:00 - 17:00 WITA" class="w-full px-3 py-2.5 rounded-[10px] bg-[#FAF7F2] border border-[#E8DEC8] text-xs">
                </div>
                <div>
                    <label class="block text-xs font-bold text-[#6B2203] uppercase mb-1">Link Embed Google Maps (src URL)</label>
                    <input type="text" name="google_maps_embed" value="{{ old('google_maps_embed', $contact->google_maps_embed) }}" placeholder="https://www.google.com/maps/embed?..." class="w-full px-3 py-2.5 rounded-[10px] bg-[#FAF7F2] border border-[#E8DEC8] text-xs">
                </div>
            </div>

            <div class="pt-4 border-t border-[#E8DEC8]">
                <button type="submit" class="btn-primary text-xs px-8 py-3 font-bold">
                    SIMPAN PENGATURAN KONTAK
                </button>
            </div>
        </form>
    </div>
@endsection
