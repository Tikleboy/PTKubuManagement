@extends('layouts.app')

@section('title', __('About Us') . ' | PT. KUBU MANAGEMENT BALI')
@section('meta_description', __('About Header Subtitle'))

@section('content')
    <!-- Header Banner -->
    <section class="bg-[#F5F1E8] py-12 lg:py-16 border-b border-[#E8DEC8]">
        <div class="w-full px-4 sm:px-8 lg:px-12 xl:px-16 2xl:px-20">
            <div class="max-w-3xl">
                <span class="label-caps text-[#965E03] font-bold block mb-2">{{ __('ABOUT COMPANY') }}</span>
                <h1 class="font-fraunces text-4xl sm:text-5xl font-bold text-[#6B2203] tracking-tight">
                    {{ __('About Us') }}
                </h1>
                <p class="text-base sm:text-lg text-[#654A39] mt-3 font-normal">
                    {{ __('About Header Subtitle') }}
                </p>
            </div>
        </div>
    </section>

    <!-- Main Editorial Section -->
    <section class="py-16 lg:py-24 bg-[#FAF7F2]">
        <div class="w-full px-4 sm:px-8 lg:px-12 xl:px-16 2xl:px-20">
            <!-- 2-Column Story: Visual & Philosophy + Comprehensive Profile -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-start">
                <!-- Left Visual Column (5 cols) -->
                <div class="lg:col-span-5 space-y-6">
                    <!-- Editorial Visual -->
                    <div class="relative rounded-[28px] overflow-hidden border border-[#E8DEC8] shadow-warm-lg bg-white group">
                        @php
                            $aboutImg = $company->about_image ? asset($company->about_image) : asset('images/kubu/landscape_service.jpg');
                            $aboutWebp = preg_replace('/\.(jpg|jpeg|png)$/i', '.webp', $aboutImg);
                            $aboutMobWebp = preg_replace('/\.(jpg|jpeg|png)$/i', '-mobile.webp', $aboutImg);
                        @endphp
                        <picture>
                            <source media="(max-width: 768px)" srcset="{{ $aboutMobWebp }}" type="image/webp">
                            <source srcset="{{ $aboutWebp }}" type="image/webp">
                            <img src="{{ $aboutImg }}" 
                                 alt="Kubu Management Bali Professional Team" 
                                 width="1376"
                                 height="768"
                                 class="w-full h-[400px] sm:h-[480px] lg:h-[520px] object-cover transition-transform duration-700 group-hover:scale-105" 
                                 loading="lazy"
                                 decoding="async">
                        </picture>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/65 via-transparent to-transparent"></div>
                        
                        <!-- Floating Badge on Image -->
                        <div class="absolute bottom-5 left-5 right-5 bg-white/95 backdrop-blur-md p-4 sm:p-5 rounded-[20px] border border-[#E8DEC8] shadow-warm-md">
                            <div class="flex items-center gap-3">
                                <div class="w-11 h-11 rounded-full bg-white border border-[#E8DEC8] flex items-center justify-center p-1.5 shrink-0 shadow-sm">
                                    <picture>
                                        <source srcset="{{ asset('images/kubu/logo-emblem.webp') }}" type="image/webp">
                                        <img src="{{ asset('images/kubu/logo-emblem.png') }}" alt="Kubu Management Logo" width="44" height="44" class="w-full h-full object-contain" loading="lazy" decoding="async">
                                    </picture>
                                </div>
                                <div class="min-w-0">
                                    <p class="font-fraunces font-bold text-sm sm:text-base text-[#6B2203] truncate">PT. KUBU MANAGEMENT BALI</p>
                                    <p class="text-[11px] sm:text-xs text-[#965E03] font-semibold mt-0.5">
                                        {{ __('Merawat Keindahan, Menjaga Kenyamanan, Membangun Kepercayaan') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Service Philosophy & 3 Pillars Card -->
                    <div class="bg-white p-6 sm:p-7 rounded-[24px] border border-[#E8DEC8] shadow-warm-sm space-y-4">
                        <div class="flex items-center justify-between border-b border-[#E8DEC8] pb-3">
                            <span class="label-caps text-[#965E03] font-bold text-xs">{{ __('FILOSOFI PELAYANAN') }}</span>
                            <span class="text-[11px] font-semibold text-[#7A5B49] bg-[#FAF7F2] px-2.5 py-1 rounded-full border border-[#E8DEC8]">Bali, Indonesia</span>
                        </div>
                        <div class="grid grid-cols-1 gap-3">
                            <!-- Pillar 1: Merawat Keindahan -->
                            <div class="flex items-start gap-3.5 p-3.5 rounded-[16px] bg-[#FAF7F2] border border-[#E8DEC8]/80 transition-all hover:bg-white hover:shadow-warm-sm">
                                <div class="w-9 h-9 rounded-full bg-[#965E03]/15 text-[#965E03] flex items-center justify-center text-base shrink-0 mt-0.5">
                                    🌿
                                </div>
                                <div>
                                    <h3 class="font-fraunces font-bold text-sm text-[#6B2203]">{{ __('Merawat Keindahan') }}</h3>
                                    <p class="text-xs text-[#7A5B49] mt-0.5 leading-relaxed">{{ __('Pengelolaan lanskap & perawatan taman tropis berestetika tinggi.') }}</p>
                                </div>
                            </div>
                            <!-- Pillar 2: Menjaga Kenyamanan -->
                            <div class="flex items-start gap-3.5 p-3.5 rounded-[16px] bg-[#FAF7F2] border border-[#E8DEC8]/80 transition-all hover:bg-white hover:shadow-warm-sm">
                                <div class="w-9 h-9 rounded-full bg-[#965E03]/15 text-[#965E03] flex items-center justify-center text-base shrink-0 mt-0.5">
                                    ✨
                                </div>
                                <div>
                                    <h3 class="font-fraunces font-bold text-sm text-[#6B2203]">{{ __('Menjaga Kenyamanan') }}</h3>
                                    <p class="text-xs text-[#7A5B49] mt-0.5 leading-relaxed">{{ __('Tata graha (housekeeping) higienis, bersih, dan berstandar perhotelan.') }}</p>
                                </div>
                            </div>
                            <!-- Pillar 3: Membangun Kepercayaan -->
                            <div class="flex items-start gap-3.5 p-3.5 rounded-[16px] bg-[#FAF7F2] border border-[#E8DEC8]/80 transition-all hover:bg-white hover:shadow-warm-sm">
                                <div class="w-9 h-9 rounded-full bg-[#965E03]/15 text-[#965E03] flex items-center justify-center text-base shrink-0 mt-0.5">
                                    🤝
                                </div>
                                <div>
                                    <h3 class="font-fraunces font-bold text-sm text-[#6B2203]">{{ __('Membangun Kepercayaan') }}</h3>
                                    <p class="text-xs text-[#7A5B49] mt-0.5 leading-relaxed">{{ __('Profesionalisme, ketelitian, dan integritas kemitraan jangka panjang.') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Editorial Content Column (7 cols) -->
                <div class="lg:col-span-7 space-y-8">
                    <!-- Company Profile Statement -->
                    <div class="bg-white p-8 sm:p-10 rounded-[28px] border border-[#E8DEC8] shadow-warm-sm space-y-6">
                        <div class="space-y-2 border-b border-[#E8DEC8] pb-5">
                            <span class="label-caps text-[#965E03] font-bold">{{ __('COMPANY PROFILE') }}</span>
                            <h2 class="font-fraunces text-2xl sm:text-3xl font-bold text-[#6B2203] leading-snug">
                                {{ __('Commitment to Cleanliness, Natural Beauty, and Service Excellence') }}
                            </h2>
                        </div>

                        <!-- Paragraf 1: Profil Perusahaan & Lingkup Layanan -->
                        <div class="space-y-2">
                            <p class="text-[#523A2C] text-base leading-relaxed">
                                {{ __('About Paragraph 1') }}
                            </p>
                        </div>

                        <!-- Paragraf 2: Pendiri & Komitmen Pelayanan (Highlighted Box) -->
                        <div class="bg-[#FAF7F2] p-5 sm:p-6 rounded-[20px] border border-[#E8DEC8] space-y-3 relative overflow-hidden shadow-inner/50">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-[#965E03]/15 text-[#965E03] flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5 text-[#965E03]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                <div>
                                    <span class="label-caps text-[#965E03] font-bold text-[10px] block tracking-wider">{{ __('PENDIRI & PIMPINAN') }}</span>
                                    <h3 class="font-fraunces font-bold text-base text-[#6B2203]">I Wayan Suardika & Ni Putu Devi Handayani</h3>
                                </div>
                            </div>
                            <p class="text-[#523A2C] text-sm sm:text-base leading-relaxed pl-2 border-l-2 border-[#965E03]/50 ml-1">
                                {{ __('About Paragraph 2') }}
                            </p>
                        </div>

                        <!-- Paragraf 3: Filosofi, Ketelitian, dan Kepuasan Pelanggan -->
                        <div class="space-y-2">
                            <p class="text-[#523A2C] text-base leading-relaxed">
                                {{ __('About Paragraph 3') }}
                            </p>
                        </div>

                        <!-- Slogan Tagline Banner -->
                        <div class="pt-2">
                            <div class="p-4 sm:p-5 rounded-[20px] bg-gradient-to-r from-[#6B2203] via-[#7F2E07] to-[#965E03] text-white shadow-warm-sm flex flex-col sm:flex-row items-center justify-between gap-4">
                                <div class="space-y-1 text-center sm:text-left">
                                    <span class="label-caps text-[#D4A574] text-[10px] tracking-wider font-semibold">{{ __('MOTTO KAMI') }}</span>
                                    <p class="font-fraunces text-sm sm:text-base font-bold tracking-wide text-white">
                                        {{ __('Merawat Keindahan, Menjaga Kenyamanan, Membangun Kepercayaan.') }}
                                    </p>
                                </div>
                                <span class="bg-white/15 backdrop-blur-sm text-[#FAF7F2] border border-white/20 px-3.5 py-1.5 rounded-full text-xs font-semibold tracking-wider shrink-0 whitespace-nowrap shadow-sm">
                                    KUBU MANAGEMENT
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Vision & Mission Block (Balanced 2-Column Layout) -->
            <div class="mt-12 lg:mt-16 grid grid-cols-1 md:grid-cols-12 gap-8">
                <!-- Vision (5 columns) -->
                <div class="md:col-span-5 bg-white p-7 sm:p-8 rounded-[24px] border border-[#E8DEC8] shadow-warm-sm border-l-4 border-l-[#965E03] flex flex-col justify-between space-y-4">
                    <div class="space-y-3">
                        <span class="label-caps text-[#965E03] font-bold text-xs tracking-wider">{{ __('VISION') }}</span>
                        <h3 class="font-fraunces text-xl sm:text-2xl font-bold text-[#6B2203] leading-snug">
                            {{ __('Vision Statement') }}
                        </h3>
                        <p class="text-xs sm:text-sm text-[#7A5B49] leading-relaxed">
                            {{ __('Vision Body') }}
                        </p>
                    </div>
                    <div class="pt-4 border-t border-[#E8DEC8]/70 flex items-center gap-2 text-xs font-semibold text-[#965E03]">
                        <span>✨</span>
                        <span>{{ __('Dedicated Property Partner in Bali') }}</span>
                    </div>
                </div>

                <!-- Mission (7 columns) -->
                <div class="md:col-span-7 bg-white p-7 sm:p-8 rounded-[24px] border border-[#E8DEC8] shadow-warm-sm border-l-4 border-l-[#6B2203] space-y-4">
                    <span class="label-caps text-[#6B2203] font-bold text-xs tracking-wider">{{ __('MISSION') }}</span>
                    <ul class="space-y-3">
                        <li class="flex items-start gap-3.5 text-xs sm:text-sm text-[#43281C]">
                            <span class="w-6 h-6 rounded-full bg-[#965E03]/15 text-[#965E03] flex items-center justify-center text-xs font-bold shrink-0 mt-0.5">1</span>
                            <span>{{ __('Mission Point 1') }}</span>
                        </li>
                        <li class="flex items-start gap-3.5 text-xs sm:text-sm text-[#43281C]">
                            <span class="w-6 h-6 rounded-full bg-[#965E03]/15 text-[#965E03] flex items-center justify-center text-xs font-bold shrink-0 mt-0.5">2</span>
                            <span>{{ __('Mission Point 2') }}</span>
                        </li>
                        <li class="flex items-start gap-3.5 text-xs sm:text-sm text-[#43281C]">
                            <span class="w-6 h-6 rounded-full bg-[#965E03]/15 text-[#965E03] flex items-center justify-center text-xs font-bold shrink-0 mt-0.5">3</span>
                            <span>{{ __('Mission Point 3') }}</span>
                        </li>
                        <li class="flex items-start gap-3.5 text-xs sm:text-sm text-[#43281C]">
                            <span class="w-6 h-6 rounded-full bg-[#965E03]/15 text-[#965E03] flex items-center justify-center text-xs font-bold shrink-0 mt-0.5">4</span>
                            <span>{{ __('Mission Point 4') }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Scope of Services & Target Clients Banner -->
    <section class="py-16 bg-[#F5F1E8] border-t border-[#E8DEC8]">
        <div class="w-full px-4 sm:px-8 lg:px-12 xl:px-16 2xl:px-20">
            <div class="bg-white rounded-[24px] border border-[#E8DEC8] p-8 sm:p-12 shadow-warm-sm">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8 text-center sm:text-left">
                    <div class="lg:col-span-2 space-y-2">
                        <span class="label-caps text-[#965E03] font-bold">{{ __('CLIENT SEGMENTS') }}</span>
                        <h3 class="font-fraunces text-2xl font-bold text-[#6B2203]">{{ __('Who We Serve') }}</h3>
                        <p class="text-sm text-[#654A39]">
                            {{ __('Target Scope Desc') }}
                        </p>
                    </div>
                    <div class="lg:col-span-3 grid grid-cols-2 sm:grid-cols-3 gap-4 text-center">
                        <div class="p-4 rounded-[12px] bg-[#FAF7F2] border border-[#E8DEC8]">
                            <p class="font-fraunces font-bold text-[#6B2203] text-base">{{ __('Hotels') }}</p>
                            <p class="text-xs text-[#7A5B49] mt-1">{{ __('Boutique & Resort') }}</p>
                        </div>
                        <div class="p-4 rounded-[12px] bg-[#FAF7F2] border border-[#E8DEC8]">
                            <p class="font-fraunces font-bold text-[#6B2203] text-base">{{ __('Villas') }}</p>
                            <p class="text-xs text-[#7A5B49] mt-1">{{ __('Private & Commercial') }}</p>
                        </div>
                        <div class="p-4 rounded-[12px] bg-[#FAF7F2] border border-[#E8DEC8]">
                            <p class="font-fraunces font-bold text-[#6B2203] text-base">{{ __('Resorts') }}</p>
                            <p class="text-xs text-[#7A5B49] mt-1">{{ __('Hospitality Area') }}</p>
                        </div>
                        <div class="p-4 rounded-[12px] bg-[#FAF7F2] border border-[#E8DEC8]">
                            <p class="font-fraunces font-bold text-[#6B2203] text-base">{{ __('Residences') }}</p>
                            <p class="text-xs text-[#7A5B49] mt-1">{{ __('Homes & Apartments') }}</p>
                        </div>
                        <div class="p-4 rounded-[12px] bg-[#FAF7F2] border border-[#E8DEC8] sm:col-span-2">
                            <p class="font-fraunces font-bold text-[#6B2203] text-base">{{ __('Commercial') }}</p>
                            <p class="text-xs text-[#7A5B49] mt-1">{{ __('Offices, Cafes & Business Venues') }}</p>
                        </div>
                    </div>
                </div>

                <div class="mt-8 pt-8 border-t border-[#E8DEC8] flex flex-col sm:flex-row items-center justify-between gap-4">
                    <p class="text-sm text-[#7A5B49]">
                        {{ __('About CTA Question') }}
                    </p>
                    <a href="{{ $globalContact->whatsapp_url ?? '#' }}" target="_blank" rel="noopener noreferrer" class="btn-primary text-xs">
                        <span>{{ __('CONSULT VIA WHATSAPP') }}</span>
                        <span>→</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
