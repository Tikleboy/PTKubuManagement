@extends('layouts.app')

@section('title', __('CONTACT') . ' | PT. KUBU MANAGEMENT BALI')
@section('meta_description', __('Contact Header Subtitle'))

@section('content')
    <!-- Header -->
    <section class="bg-[#F5F1E8] py-12 lg:py-16 border-b border-[#E8DEC8]">
        <div class="w-full px-4 sm:px-8 lg:px-12 xl:px-16 2xl:px-20">
            <span class="label-caps text-[#965E03] font-bold block mb-2">{{ __('CONTACT US') }}</span>
            <h1 class="font-fraunces text-4xl sm:text-5xl font-bold text-[#6B2203] tracking-tight">
                {{ __('CONTACT KUBU MANAGEMENT BALI') }}
            </h1>
            <p class="text-base sm:text-lg text-[#654A39] mt-3 max-w-2xl leading-relaxed">
                {{ __('Contact Header Subtitle') }}
            </p>
        </div>
    </section>

    <!-- Main Contact Content Section -->
    <section class="py-16 lg:py-24 bg-[#FAF7F2]">
        <div class="w-full px-4 sm:px-8 lg:px-12 xl:px-16 2xl:px-20 space-y-12">
            @if(session('success'))
                <div class="p-4 rounded-[16px] bg-[#2D6A4F]/10 border border-[#2D6A4F]/30 text-[#2D6A4F] flex items-center gap-3">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span class="text-sm font-semibold">{{ session('success') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="p-4 rounded-[16px] bg-red-50 border border-red-200 text-red-700 text-sm space-y-1">
                    <p class="font-bold">{{ __('Please correct the errors in the form:') }}</p>
                    <ul class="list-disc list-inside text-xs">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 sm:gap-12 items-start">
                <!-- Left Column: Contact Channels & WhatsApp CTA -->
                <div class="lg:col-span-5 space-y-8">
                    <!-- Conversion Box: Request a Quote (WhatsApp) -->
                    <div class="bg-[#6B2203] text-white p-8 rounded-[24px] border border-[#965E03] shadow-warm-lg space-y-5 relative overflow-hidden">
                        <div class="absolute -right-12 -top-12 w-44 h-44 bg-[#965E03]/20 rounded-full blur-2xl pointer-events-none"></div>

                        <div class="space-y-3 relative z-10">
                            <span class="label-caps text-[#D4A574] font-bold text-xs tracking-wider block">{{ __('FAST WHATSAPP RESPONSE') }}</span>
                            <h2 class="font-fraunces text-2xl font-bold !text-white text-white leading-snug" style="color: #FFFFFF !important;">
                                {{ __('Need a Fast Quote?') }}
                            </h2>
                            <p class="text-sm text-[#F5F1E8]/85 leading-relaxed">
                                {{ __('Contact Box WhatsApp Subtitle') }}
                            </p>
                        </div>

                        <div class="pt-2 relative z-10">
                            <a href="{{ $contact->whatsapp_url ?? 'https://wa.me/6285738261654' }}" target="_blank" rel="noopener noreferrer" class="btn-primary bg-[#965E03] hover:bg-[#825203] text-white w-full py-4 text-center text-sm shadow-xl flex items-center justify-center gap-2 font-bold transition-all transform hover:scale-[1.01]">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.598 2.664-.698c.969.586 1.77.809 2.796.809 3.179 0 5.767-2.587 5.767-5.766.002-3.18-2.585-5.766-5.767-5.766zm9.969 5.766c0 5.485-4.457 9.943-9.97 9.943-1.637 0-3.21-.401-4.606-1.164l-5.424 1.42 1.447-5.289c-.87-1.464-1.387-3.197-1.387-4.91 0-5.484 4.458-9.942 9.97-9.942 5.514 0 9.97 4.458 9.97 9.942z"/></svg>
                                <span>{{ __('REQUEST A QUOTE') }}</span>
                                <span>→</span>
                            </a>
                        </div>
                        <div class="text-[11px] text-[#D4A574]/80 italic text-center relative z-10">
                            {{ __('Pre-filled WhatsApp message ready for your convenience') }}
                        </div>
                    </div>

                    <!-- Direct Contact Details -->
                    <div class="bg-white p-8 rounded-[24px] border border-[#E8DEC8] shadow-warm-sm space-y-6">
                        <h3 class="font-fraunces text-xl font-bold text-[#6B2203]">{{ __('Official Contact Information') }}</h3>
                        <ul class="space-y-4 text-sm text-[#43281C]">
                            <li class="flex items-start gap-3">
                                <div class="w-9 h-9 rounded-[8px] bg-[#FAF7F2] text-[#965E03] flex items-center justify-center shrink-0 border border-[#E8DEC8]">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.598 2.664-.698c.969.586 1.77.809 2.796.809 3.179 0 5.767-2.587 5.767-5.766.002-3.18-2.585-5.766-5.767-5.766zm9.969 5.766c0 5.485-4.457 9.943-9.97 9.943-1.637 0-3.21-.401-4.606-1.164l-5.424 1.42 1.447-5.289c-.87-1.464-1.387-3.197-1.387-4.91 0-5.484 4.458-9.942 9.97-9.942 5.514 0 9.97 4.458 9.97 9.942z"/></svg>
                                </div>
                                <div>
                                    <span class="block text-xs font-bold text-[#965E03]">{{ __('WhatsApp:') }}</span>
                                    <a href="{{ $contact->whatsapp_url ?? 'https://wa.me/6285738261654' }}" target="_blank" rel="noopener noreferrer" class="font-semibold hover:text-[#965E03] transition-colors">
                                        {{ $contact->whatsapp_number ?? '+62 857-3826-1654' }}
                                    </a>
                                </div>
                            </li>

                            <li class="flex items-start gap-3">
                                <div class="w-9 h-9 rounded-[8px] bg-[#FAF7F2] text-[#965E03] flex items-center justify-center shrink-0 border border-[#E8DEC8]">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                </div>
                                <div>
                                    <span class="block text-xs font-bold text-[#965E03]">{{ __('Email:') }}</span>
                                    <a href="mailto:{{ $contact->email ?? 'info@kubumanagementbali.com' }}" class="hover:text-[#965E03] transition-colors">
                                        {{ $contact->email ?? 'info@kubumanagementbali.com' }}
                                    </a>
                                </div>
                            </li>

                            <li class="flex items-start gap-3">
                                <div class="w-9 h-9 rounded-[8px] bg-[#FAF7F2] text-[#965E03] flex items-center justify-center shrink-0 border border-[#E8DEC8]">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.79-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                                </div>
                                <div>
                                    <span class="block text-xs font-bold text-[#965E03]">{{ __('Instagram:') }}</span>
                                    <a href="{{ $contact->instagram_url ?? 'https://instagram.com/kubumanagementbali' }}" target="_blank" rel="noopener noreferrer" class="hover:text-[#965E03] transition-colors">
                                        {{ $contact->instagram ?? '@kubumanagementbali' }}
                                    </a>
                                </div>
                            </li>

                            <li class="flex items-start gap-3">
                                <div class="w-9 h-9 rounded-[8px] bg-[#FAF7F2] text-[#965E03] flex items-center justify-center shrink-0 border border-[#E8DEC8]">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                </div>
                                <div>
                                    <span class="block text-xs font-bold text-[#965E03]">{{ __('Office Address') }}:</span>
                                    <span class="leading-relaxed">{{ $contact->office_address ?? 'Jalan Pura Banyukuning No.1, Padangsambian, Kecamatan Denpasar Barat, Kota Denpasar, Bali 80119' }}</span>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <!-- Google Maps Section -->
                    <div class="bg-white p-6 rounded-[24px] border border-[#E8DEC8] shadow-warm-sm space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="label-caps text-[#965E03] font-bold">{{ __('SERVICE LOCATION') }}</span>
                            <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($contact->office_address ?? 'Jalan Pura Banyukuning No.1, Padangsambian, Denpasar Barat, Bali') }}" target="_blank" rel="noopener noreferrer" class="text-xs font-bold text-[#965E03] hover:underline">
                                {{ __('Buka di Google Maps') }} ↗
                            </a>
                        </div>
                        <div class="w-full h-56 rounded-[16px] overflow-hidden border border-[#E8DEC8] bg-[#FAF7F2]">
                            @if(!empty($contact->google_maps_embed))
                                <iframe src="{{ $contact->google_maps_embed }}" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                            @else
                                <div class="w-full h-full flex flex-col items-center justify-center p-4 text-center text-[#7A5B49] text-xs">
                                    <svg class="w-8 h-8 text-[#965E03] mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    <p class="font-bold text-[#6B2203]">{{ __('Service Area: Throughout Bali') }}</p>
                                    <p class="mt-0.5">{{ __('Badung, Denpasar, Gianyar, Tabanan, and surrounding areas.') }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Right Column: Contact Inquiry Form -->
                <div class="lg:col-span-7 bg-white p-8 sm:p-10 rounded-[28px] border border-[#E8DEC8] shadow-warm-md space-y-6">
                    <div class="space-y-2">
                        <span class="label-caps text-[#965E03] font-bold">{{ __('INQUIRY FORM') }}</span>
                        <h2 class="font-fraunces text-2xl sm:text-3xl font-bold text-[#6B2203]">
                            {{ __('Send Us a Message') }}
                        </h2>
                        <p class="text-sm text-[#7A5B49]">
                            {{ __('Inquiry Form Subtitle') }}
                        </p>
                    </div>

                    <form id="contact-form" action="{{ route('contact.send') }}" method="POST" class="space-y-5">
                        @csrf

                        <div>
                            <label for="name" class="block text-xs font-bold text-[#6B2203] uppercase tracking-wider mb-1.5">
                                {{ __('Full Name') }} <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required class="w-full px-4 py-3 rounded-[12px] bg-[#FAF7F2] border border-[#E8DEC8] text-sm focus:outline-none focus:border-[#965E03] focus:ring-1 focus:ring-[#965E03]" placeholder="{{ __('Your name or property representative') }}">
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="email" class="block text-xs font-bold text-[#6B2203] uppercase tracking-wider mb-1.5">
                                    {{ __('Email Address') }}
                                </label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}" class="w-full px-4 py-3 rounded-[12px] bg-[#FAF7F2] border border-[#E8DEC8] text-sm focus:outline-none focus:border-[#965E03]" placeholder="contoh@domain.com">
                            </div>
                            <div>
                                <label for="phone" class="block text-xs font-bold text-[#6B2203] uppercase tracking-wider mb-1.5">
                                    {{ __('Phone / WhatsApp Number') }}
                                </label>
                                <input type="text" name="phone" id="phone" value="{{ old('phone') }}" class="w-full px-4 py-3 rounded-[12px] bg-[#FAF7F2] border border-[#E8DEC8] text-sm focus:outline-none focus:border-[#965E03]" placeholder="+62 812-XXXX-XXXX">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="property_type" class="block text-xs font-bold text-[#6B2203] uppercase tracking-wider mb-1.5">
                                    {{ __('Property Type') }}
                                </label>
                                @php $selectedProp = old('property_type', 'Villa'); @endphp
                                <select name="property_type" id="property_type" class="w-full px-4 py-3 rounded-[12px] bg-[#FAF7F2] border border-[#E8DEC8] text-sm focus:outline-none focus:border-[#965E03]">
                                    <option value="Villa" {{ $selectedProp === 'Villa' ? 'selected' : '' }}>{{ __('Villa (Private / Commercial)') }}</option>
                                    <option value="Hotel" {{ $selectedProp === 'Hotel' ? 'selected' : '' }}>{{ __('Hotel / Resort') }}</option>
                                    <option value="Residential" {{ $selectedProp === 'Residential' ? 'selected' : '' }}>{{ __('Residential / Private Home') }}</option>
                                    <option value="Commercial" {{ $selectedProp === 'Commercial' ? 'selected' : '' }}>{{ __('Commercial / Office / Cafe') }}</option>
                                </select>
                            </div>
                            <div>
                                <label for="service_needed" class="block text-xs font-bold text-[#6B2203] uppercase tracking-wider mb-1.5">
                                    {{ __('Service Required') }}
                                </label>
                                @php $selectedServ = old('service_needed', 'Landscape & Garden'); @endphp
                                <select name="service_needed" id="service_needed" class="w-full px-4 py-3 rounded-[12px] bg-[#FAF7F2] border border-[#E8DEC8] text-sm focus:outline-none focus:border-[#965E03]">
                                    <option value="Landscape & Garden" {{ $selectedServ === 'Landscape & Garden' ? 'selected' : '' }}>{{ __('Kubu Landscape & Garden') }}</option>
                                    <option value="Kubu Clean / Housekeeping" {{ $selectedServ === 'Kubu Clean / Housekeeping' ? 'selected' : '' }}>{{ __('Kubu Clean / Housekeeping') }}</option>
                                    <option value="Integrated Package" {{ $selectedServ === 'Integrated Package' ? 'selected' : '' }}>{{ __('Integrated Package (Both Services)') }}</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label for="message" class="block text-xs font-bold text-[#6B2203] uppercase tracking-wider mb-1.5">
                                {{ __('Message / Requirements Detail') }} <span class="text-red-500">*</span>
                            </label>
                            <textarea name="message" id="message" rows="5" required class="w-full px-4 py-3 rounded-[12px] bg-[#FAF7F2] border border-[#E8DEC8] text-sm focus:outline-none focus:border-[#965E03]" placeholder="{{ __('Describe your garden maintenance or housekeeping requirements...') }}">{{ old('message') }}</textarea>
                        </div>

                        <div>
                            <button type="submit" class="btn-primary w-full py-4 text-center font-bold text-sm shadow-warm-md hover:shadow-warm-lg flex items-center justify-center gap-2">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.598 2.664-.698c.969.586 1.77.809 2.796.809 3.179 0 5.767-2.587 5.767-5.766.002-3.18-2.585-5.766-5.767-5.766zm9.969 5.766c0 5.485-4.457 9.943-9.97 9.943-1.637 0-3.21-.401-4.606-1.164l-5.424 1.42 1.447-5.289c-.87-1.464-1.387-3.197-1.387-4.91 0-5.484 4.458-9.942 9.97-9.942 5.514 0 9.97 4.458 9.97 9.942z"/></svg>
                                <span>{{ __('SEND MESSAGE NOW') }}</span>
                                <span>→</span>
                            </button>
                            <p class="text-center text-[11px] text-[#7A5B49] mt-2">
                                {{ __('Pesan konsultasi akan terhubung langsung ke WhatsApp resmi PT KUBU MANAGEMENT BALI.') }}
                            </p>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Bottom 3-Pillar Commitment Banner -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-4">
                <div class="p-6 rounded-[20px] bg-white border border-[#E8DEC8] shadow-warm-sm space-y-2">
                    <div class="w-10 h-10 rounded-[10px] bg-[#FAF7F2] text-[#965E03] flex items-center justify-center font-bold text-lg border border-[#E8DEC8]">
                        🌿
                    </div>
                    <h4 class="font-fraunces text-base font-bold text-[#6B2203]">{{ __('Spesialis Lanskap Tropis') }}</h4>
                    <p class="text-xs text-[#7A5B49] leading-relaxed">
                        {{ __('Perawatan menyeluruh tanaman tropis, pemupukan berkala, sistem irigasi, serta estetika visual taman vila & resort.') }}
                    </p>
                </div>

                <div class="p-6 rounded-[20px] bg-white border border-[#E8DEC8] shadow-warm-sm space-y-2">
                    <div class="w-10 h-10 rounded-[10px] bg-[#FAF7F2] text-[#965E03] flex items-center justify-center font-bold text-lg border border-[#E8DEC8]">
                        ✨
                    </div>
                    <h4 class="font-fraunces text-base font-bold text-[#6B2203]">{{ __('Tata Graha Standar Hospitality') }}</h4>
                    <p class="text-xs text-[#7A5B49] leading-relaxed">
                        {{ __('Tim housekeeping profesional dengan ketelitian tinggi dalam menjaga kebersihan, kerapian, dan sanitasi vila mewah.') }}
                    </p>
                </div>

                <div class="p-6 rounded-[20px] bg-white border border-[#E8DEC8] shadow-warm-sm space-y-2">
                    <div class="w-10 h-10 rounded-[10px] bg-[#FAF7F2] text-[#965E03] flex items-center justify-center font-bold text-lg border border-[#E8DEC8]">
                        🤝
                    </div>
                    <h4 class="font-fraunces text-base font-bold text-[#6B2203]">{{ __('Survei Lokasi & Penawaran Transparan') }}</h4>
                    <p class="text-xs text-[#7A5B49] leading-relaxed">
                        {{ __('Konsultasikan properti Anda langsung bersama tim kami untuk penjadwalan survei dan penawaran biaya yang detail dan terukur.') }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('contact-form');
            if (form) {
                form.addEventListener('submit', function() {
                    const name = document.getElementById('name')?.value || '';
                    const phone = document.getElementById('phone')?.value || '';
                    const propType = document.getElementById('property_type')?.value || '';
                    const service = document.getElementById('service_needed')?.value || '';
                    const message = document.getElementById('message')?.value || '';

                    const waNum = '{{ preg_replace("/[^0-9]/", "", $contact->whatsapp_number ?? "6285738261654") }}';
                    let text = `Halo PT KUBU MANAGEMENT BALI,%0A%0ASaya ingin konsultasi layanan:%0A- *Nama*: ${encodeURIComponent(name)}`;
                    if (phone) text += `%0A- *Kontak*: ${encodeURIComponent(phone)}`;
                    if (propType) text += `%0A- *Jenis Properti*: ${encodeURIComponent(propType)}`;
                    if (service) text += `%0A- *Layanan*: ${encodeURIComponent(service)}`;
                    if (message) text += `%0A- *Kebutuhan*: ${encodeURIComponent(message)}`;
                    text += `%0A%0AMohon informasi penawaran dan jadwal survei lokasi. Terima kasih.`;

                    try {
                        window.open(`https://wa.me/${waNum}?text=${text}`, '_blank');
                    } catch (e) {
                        // ignore popup blockers
                    }
                });
            }
        });
    </script>
@endsection
