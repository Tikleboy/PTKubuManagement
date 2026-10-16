@extends('layouts.app')

@section('title', __('PT. KUBU MANAGEMENT BALI | Professional Property Care Services in Bali'))

@section('content')
    <!-- 1. CINEMATIC HERO SECTION -->
    <section class="relative bg-[#F5F1E8] pt-8 pb-16 lg:pt-14 lg:pb-24 overflow-hidden border-b border-[#E8DEC8]">
        <div class="w-full px-4 sm:px-8 lg:px-12 xl:px-16 2xl:px-20">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center">
                <!-- Text Column -->
                <div class="lg:col-span-6 space-y-6">
                    <!-- Badge -->
                    <div class="inline-flex items-center gap-2 bg-white px-3.5 py-1.5 rounded-full border border-[#E8DEC8] shadow-warm-sm">
                        <span class="w-2 h-2 rounded-full bg-[#965E03]"></span>
                        <span class="label-caps text-[#965E03] text-[11px] font-semibold tracking-widest">
                            {{ __('LANDSCAPE • HOUSEKEEPING • PROPERTY CARE') }}
                        </span>
                    </div>

                    <!-- Main Headline (Fraunces) -->
                    <h1 class="font-fraunces text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-[#6B2203] leading-[1.12]">
                        KUBU MANAGEMENT BALI
                    </h1>

                    <!-- Positioning -->
                    <p class="text-xl sm:text-2xl font-fraunces text-[#965E03] font-semibold leading-snug">
                        {{ __('Professional Property Care Services in Bali') }}
                    </p>

                    <!-- Supporting Copy (Albert Sans) -->
                    <p class="text-base sm:text-lg text-[#523A2C] leading-relaxed max-w-xl">
                        {{ __('Professional landscape, garden maintenance, and housekeeping services for villas, hotels, residences, and commercial properties in Bali.') }}
                    </p>

                    <!-- CTAs -->
                    <div class="pt-2 flex flex-wrap items-center gap-4">
                        <a href="{{ $globalContact->whatsapp_url ?? '#' }}" target="_blank" rel="noopener noreferrer" class="btn-primary text-base px-6 py-3.5 shadow-warm-md hover:shadow-warm-lg">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.598 2.664-.698c.969.586 1.77.809 2.796.809 3.179 0 5.767-2.587 5.767-5.766.002-3.18-2.585-5.766-5.767-5.766zm9.969 5.766c0 5.485-4.457 9.943-9.97 9.943-1.637 0-3.21-.401-4.606-1.164l-5.424 1.42 1.447-5.289c-.87-1.464-1.387-3.197-1.387-4.91 0-5.484 4.458-9.942 9.97-9.942 5.514 0 9.97 4.458 9.97 9.942z"/></svg>
                            <span>{{ __('REQUEST A QUOTE') }}</span>
                        </a>

                        <a href="{{ route('services.index') }}" class="btn-secondary text-base px-6 py-3.5">
                            <span>{{ __('OUR SERVICES') }}</span>
                        </a>

                        <a href="{{ route('contact.index') }}" class="text-sm font-semibold text-[#6B2203] hover:text-[#965E03] px-3 py-2 underline underline-offset-4 transition-colors">
                            {{ __('CONTACT US') }} →
                        </a>
                    </div>

                    <!-- Client Target Scope Tags -->
                    <div class="pt-4 border-t border-[#E8DEC8] flex flex-wrap items-center gap-2 text-xs text-[#7A5B49]">
                        <span class="bg-white/80 px-2.5 py-1 rounded-[6px] border border-[#E8DEC8]">{{ __('Hotels') }}</span>
                        <span class="bg-white/80 px-2.5 py-1 rounded-[6px] border border-[#E8DEC8]">{{ __('Villas') }}</span>
                        <span class="bg-white/80 px-2.5 py-1 rounded-[6px] border border-[#E8DEC8]">{{ __('Resorts') }}</span>
                        <span class="bg-white/80 px-2.5 py-1 rounded-[6px] border border-[#E8DEC8]">{{ __('Residential') }}</span>
                        <span class="bg-white/80 px-2.5 py-1 rounded-[6px] border border-[#E8DEC8]">{{ __('Commercial') }}</span>
                    </div>
                </div>

                <!-- Cinematic Visual Column -->
                <div class="lg:col-span-6 relative">
                    <div class="relative mx-auto rounded-[32px] overflow-hidden shadow-warm-lg border border-[#E8DEC8] bg-[#2E3A23] group" style="aspect-ratio: 1376 / 768;">
                        <picture>
                            <source media="(max-width: 768px)" srcset="{{ asset('images/kubu/hero_bali-mobile.webp') }}" type="image/webp">
                            <source media="(min-width: 769px)" srcset="{{ asset('images/kubu/hero_bali.webp') }}" type="image/webp">
                            <img src="{{ asset('images/kubu/hero_bali.jpg') }}" 
                                 alt="Kubu Management Bali Luxury Villa & Garden Care" 
                                 width="1376" 
                                 height="768" 
                                 loading="eager" 
                                 fetchpriority="high" 
                                 decoding="async" 
                                 class="w-full h-[380px] sm:h-[460px] lg:h-[500px] object-cover transition-transform duration-700 group-hover:scale-105">
                        </picture>
                        <div class="absolute inset-0 bg-gradient-to-t from-[#6B2203]/75 via-transparent to-black/10"></div>
                        
                        <!-- Floating Glass Badge -->
                        <div class="absolute bottom-4 left-4 right-4 sm:bottom-6 sm:left-6 sm:right-6 bg-white/95 backdrop-blur-md p-4 sm:p-5 rounded-[20px] border border-[#E8DEC8] shadow-warm-md flex items-center justify-between gap-4">
                            <div class="space-y-0.5">
                                <span class="label-caps text-[#965E03] font-bold">{{ __('BALI PROPERTY EXCELLENCE') }}</span>
                                <p class="text-sm font-fraunces font-bold text-[#6B2203]">{{ __('Pristine Gardens & Spotless Suites') }}</p>
                                <p class="text-xs text-[#7A5B49]">{{ __('Professional garden and cleanliness standards across Bali') }}</p>
                            </div>
                            <div class="w-12 h-12 rounded-full bg-[#965E03]/10 text-[#965E03] flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. TWO MAIN SERVICE CATEGORIES SECTION -->
    <section class="py-16 lg:py-24 bg-[#FAF7F2]">
        <div class="w-full px-4 sm:px-8 lg:px-12 xl:px-16 2xl:px-20">
            <div class="text-center max-w-2xl mx-auto mb-14">
                <span class="label-caps text-[#965E03] font-bold block mb-2">{{ __('CORE SERVICES') }}</span>
                <h2 class="font-fraunces text-3xl sm:text-4xl font-bold text-[#6B2203] tracking-tight">
                    {{ __('Our Core Services') }}
                </h2>
                <p class="text-[#654A39] text-base mt-3">
                    {{ __('Integrated high-quality property care solutions for hotels, villas, residential, and commercial properties in Bali.') }}
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-10">
                <!-- Category 1: Kubu Landscape & Garden -->
                <div class="bg-white rounded-[24px] overflow-hidden border border-[#E8DEC8] shadow-warm-md hover:shadow-warm-lg transition-all duration-300 flex flex-col group">
                    <div class="relative h-64 overflow-hidden bg-[#2D3A24]">
                        <picture>
                            <source media="(max-width: 768px)" srcset="{{ asset('images/kubu/landscape_service-mobile.webp') }}" type="image/webp">
                            <source srcset="{{ asset('images/kubu/landscape_service.webp') }}" type="image/webp">
                            <img src="{{ asset('images/kubu/landscape_service.jpg') }}" 
                                 alt="Kubu Landscape & Garden" 
                                 width="1376" 
                                 height="768" 
                                 loading="lazy" 
                                 decoding="async" 
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                        </picture>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                        <div class="absolute bottom-4 left-6">
                            <span class="bg-[#965E03] text-white text-[11px] font-semibold uppercase tracking-wider px-3 py-1 rounded-full">
                                {{ __('DIVISION 01') }}
                            </span>
                        </div>
                    </div>

                    <div class="p-6 sm:p-8 flex-1 flex flex-col justify-between space-y-6">
                        <div class="space-y-3">
                            <h3 class="font-fraunces text-2xl font-bold text-[#6B2203]">
                                {{ __('LANDSCAPE & GARDEN') }}
                            </h3>
                            <p class="text-[#7A5B49] italic font-medium text-sm border-l-2 border-[#D4A574] pl-3">
                                {{ __('Landscape Quote Tagline') }}
                            </p>
                            <p class="text-[#523A2C] text-sm leading-relaxed pt-1">
                                {{ __('Landscape Description Short') }}
                            </p>

                            <div class="pt-2">
                                <span class="label-caps text-[#965E03] text-[10px] block mb-2 font-bold">{{ __('KEY SUB-SERVICES:') }}</span>
                                <div class="grid grid-cols-2 gap-2 text-xs text-[#523A2C]">
                                    <div class="flex items-start gap-1.5">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[#965E03] mt-1.5 shrink-0"></span>
                                        <span>{{ __('Garden Maintenance') }}</span>
                                    </div>
                                    <div class="flex items-start gap-1.5">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[#965E03] mt-1.5 shrink-0"></span>
                                        <span>{{ __('Landscape Maintenance') }}</span>
                                    </div>
                                    <div class="flex items-start gap-1.5">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[#965E03] mt-1.5 shrink-0"></span>
                                        <span>{{ __('Garden Improvement') }}</span>
                                    </div>
                                    <div class="flex items-start gap-1.5">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[#965E03] mt-1.5 shrink-0"></span>
                                        <span>{{ __('Irrigation Services') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pt-4 border-t border-[#E8DEC8] flex flex-col sm:flex-row md:flex-col lg:flex-row items-stretch sm:items-center md:items-stretch lg:items-center justify-between gap-3">
                            <a href="{{ route('services.landscape') }}" class="btn-primary text-xs px-5 py-3 w-full sm:w-auto md:w-full lg:w-auto text-center justify-center">
                                <span>{{ __('EXPLORE LANDSCAPE') }}</span>
                                <span>→</span>
                            </a>
                            <a href="{{ $globalContact->whatsapp_url ?? '#' }}" target="_blank" rel="noopener noreferrer" class="text-xs font-semibold text-[#965E03] hover:text-[#6B2203] underline text-center sm:text-right md:text-center lg:text-right py-1 whitespace-nowrap transition-colors">
                                {{ __('Request Quote') }}
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Category 2: Kubu Clean / Housekeeping -->
                <div class="bg-white rounded-[24px] overflow-hidden border border-[#E8DEC8] shadow-warm-md hover:shadow-warm-lg transition-all duration-300 flex flex-col group">
                    <div class="relative h-64 overflow-hidden bg-[#43281C]">
                        <picture>
                            <source media="(max-width: 768px)" srcset="{{ asset('images/kubu/housekeeping_service-mobile.webp') }}" type="image/webp">
                            <source srcset="{{ asset('images/kubu/housekeeping_service.webp') }}" type="image/webp">
                            <img src="{{ asset('images/kubu/housekeeping_service.jpg') }}" 
                                 alt="Kubu Clean / Housekeeping" 
                                 width="1376" 
                                 height="768" 
                                 loading="lazy" 
                                 decoding="async" 
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                        </picture>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                        <div class="absolute bottom-4 left-6">
                            <span class="bg-[#6B2203] text-white text-[11px] font-semibold uppercase tracking-wider px-3 py-1 rounded-full">
                                {{ __('DIVISION 02') }}
                            </span>
                        </div>
                    </div>

                    <div class="p-6 sm:p-8 flex-1 flex flex-col justify-between space-y-6">
                        <div class="space-y-3">
                            <h3 class="font-fraunces text-2xl font-bold text-[#6B2203]">
                                {{ __('HOUSEKEEPING') }}
                            </h3>
                            <p class="text-[#7A5B49] italic font-medium text-sm border-l-2 border-[#D4A574] pl-3">
                                {{ __('Housekeeping Quote Tagline') }}
                            </p>
                            <p class="text-[#523A2C] text-sm leading-relaxed pt-1">
                                {{ __('Housekeeping Description Short') }}
                            </p>

                            <div class="pt-2">
                                <span class="label-caps text-[#965E03] text-[10px] block mb-2 font-bold">{{ __('KEY SUB-SERVICES:') }}</span>
                                <div class="grid grid-cols-2 gap-2 text-xs text-[#523A2C]">
                                    <div class="flex items-start gap-1.5">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[#6B2203] mt-1.5 shrink-0"></span>
                                        <span>{{ __('Villa Housekeeping') }}</span>
                                    </div>
                                    <div class="flex items-start gap-1.5">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[#6B2203] mt-1.5 shrink-0"></span>
                                        <span>{{ __('Hotel Housekeeping') }}</span>
                                    </div>
                                    <div class="flex items-start gap-1.5">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[#6B2203] mt-1.5 shrink-0"></span>
                                        <span>{{ __('Residential Care') }}</span>
                                    </div>
                                    <div class="flex items-start gap-1.5">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[#6B2203] mt-1.5 shrink-0"></span>
                                        <span>{{ __('Linen & Sanitization') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pt-4 border-t border-[#E8DEC8] flex flex-col sm:flex-row md:flex-col lg:flex-row items-stretch sm:items-center md:items-stretch lg:items-center justify-between gap-3">
                            <a href="{{ route('services.housekeeping') }}" class="btn-primary text-xs px-5 py-3 w-full sm:w-auto md:w-full lg:w-auto text-center justify-center">
                                <span>{{ __('EXPLORE HOUSEKEEPING') }}</span>
                                <span>→</span>
                            </a>
                            <a href="{{ $globalContact->whatsapp_url ?? '#' }}" target="_blank" rel="noopener noreferrer" class="text-xs font-semibold text-[#965E03] hover:text-[#6B2203] underline text-center sm:text-right md:text-center lg:text-right py-1 whitespace-nowrap transition-colors">
                                {{ __('Request Quote') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. WHY CHOOSE KUBU MANAGEMENT (EXACTLY 6 POINTS, NO INVENTED NUMBERS) -->
    <section class="py-16 lg:py-24 bg-[#F5F1E8] border-y border-[#E8DEC8]">
        <div class="w-full px-4 sm:px-8 lg:px-12 xl:px-16 2xl:px-20">
            <div class="text-center max-w-2xl mx-auto mb-14">
                <span class="label-caps text-[#965E03] font-bold block mb-2">{{ __('COMMITMENT TO QUALITY') }}</span>
                <h2 class="font-fraunces text-3xl sm:text-4xl font-bold text-[#6B2203] tracking-tight">
                    {{ __('WHY CHOOSE KUBU MANAGEMENT?') }}
                </h2>
                <p class="text-[#654A39] text-base mt-3">
                    {{ __('Professional operational principles consistently applied to every property under our care.') }}
                </p>
            </div>

            <!-- 6 Visual Highlights -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                <!-- Highlight 1: Professional Team -->
                <div class="bg-white p-7 rounded-[16px] border border-[#E8DEC8] shadow-warm-sm hover:shadow-warm-md transition-shadow space-y-3">
                    <div class="w-12 h-12 rounded-[12px] bg-[#F5F1E8] border border-[#E8DEC8] text-[#965E03] flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <h3 class="font-fraunces text-lg font-bold text-[#6B2203]">{{ __('Professional Team') }}</h3>
                    <p class="text-[#654A39] text-sm leading-relaxed">
                        {{ __('Professional Team Desc') }}
                    </p>
                </div>

                <!-- Highlight 2: Experienced Staff -->
                <div class="bg-white p-7 rounded-[16px] border border-[#E8DEC8] shadow-warm-sm hover:shadow-warm-md transition-shadow space-y-3">
                    <div class="w-12 h-12 rounded-[12px] bg-[#F5F1E8] border border-[#E8DEC8] text-[#965E03] flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                    </div>
                    <h3 class="font-fraunces text-lg font-bold text-[#6B2203]">{{ __('Experienced Staff') }}</h3>
                    <p class="text-[#654A39] text-sm leading-relaxed">
                        {{ __('Experienced Staff Desc') }}
                    </p>
                </div>

                <!-- Highlight 3: Quality Service -->
                <div class="bg-white p-7 rounded-[16px] border border-[#E8DEC8] shadow-warm-sm hover:shadow-warm-md transition-shadow space-y-3">
                    <div class="w-12 h-12 rounded-[12px] bg-[#F5F1E8] border border-[#E8DEC8] text-[#965E03] flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                    </div>
                    <h3 class="font-fraunces text-lg font-bold text-[#6B2203]">{{ __('Quality Service') }}</h3>
                    <p class="text-[#654A39] text-sm leading-relaxed">
                        {{ __('Quality Service Desc') }}
                    </p>
                </div>

                <!-- Highlight 4: Flexible Management -->
                <div class="bg-white p-7 rounded-[16px] border border-[#E8DEC8] shadow-warm-sm hover:shadow-warm-md transition-shadow space-y-3">
                    <div class="w-12 h-12 rounded-[12px] bg-[#F5F1E8] border border-[#E8DEC8] text-[#965E03] flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                    </div>
                    <h3 class="font-fraunces text-lg font-bold text-[#6B2203]">{{ __('Flexible Management') }}</h3>
                    <p class="text-[#654A39] text-sm leading-relaxed">
                        {{ __('Flexible Management Desc') }}
                    </p>
                </div>

                <!-- Highlight 5: Regular Maintenance -->
                <div class="bg-white p-7 rounded-[16px] border border-[#E8DEC8] shadow-warm-sm hover:shadow-warm-md transition-shadow space-y-3">
                    <div class="w-12 h-12 rounded-[12px] bg-[#F5F1E8] border border-[#E8DEC8] text-[#965E03] flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <h3 class="font-fraunces text-lg font-bold text-[#6B2203]">{{ __('Regular Maintenance') }}</h3>
                    <p class="text-[#654A39] text-sm leading-relaxed">
                        {{ __('Regular Maintenance Desc') }}
                    </p>
                </div>

                <!-- Highlight 6: Client Focused -->
                <div class="bg-white p-7 rounded-[16px] border border-[#E8DEC8] shadow-warm-sm hover:shadow-warm-md transition-shadow space-y-3">
                    <div class="w-12 h-12 rounded-[12px] bg-[#F5F1E8] border border-[#E8DEC8] text-[#965E03] flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"/></svg>
                    </div>
                    <h3 class="font-fraunces text-lg font-bold text-[#6B2203]">{{ __('Client Focused') }}</h3>
                    <p class="text-[#654A39] text-sm leading-relaxed">
                        {{ __('Client Focused Desc') }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. OUR PROJECT SHOWCASE (BEFORE -> PROCESS -> FINAL RESULT STORYTELLING) -->
    <section class="py-16 lg:py-24 bg-[#FAF7F2]">
        <div class="w-full px-4 sm:px-8 lg:px-12 xl:px-16 2xl:px-20">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
                <div>
                    <span class="label-caps text-[#965E03] font-bold block mb-2">{{ __('VISUAL WORK EVIDENCE') }}</span>
                    <h2 class="font-fraunces text-3xl sm:text-4xl font-bold text-[#6B2203] tracking-tight">
                        {{ __('Our Project Portfolio') }}
                    </h2>
                    <p class="text-[#654A39] text-base mt-2 max-w-xl">
                        {{ __('Project Portfolio Subtitle') }}
                    </p>
                </div>
                <div>
                    <a href="{{ route('projects.index') }}" class="btn-secondary text-xs">
                        <span>{{ __('VIEW ALL PROJECTS') }}</span>
                        <span>→</span>
                    </a>
                </div>
            </div>

            <!-- Featured Project Story Block -->
            <div class="bg-white rounded-[28px] border border-[#E8DEC8] p-6 lg:p-10 shadow-warm-md mb-10">
                <div class="flex flex-col lg:flex-row justify-between lg:items-center pb-6 border-b border-[#E8DEC8] gap-4">
                    <div>
                        <span class="label-caps text-[#965E03] text-[11px] font-bold">{{ __('PROPERTY TRANSFORMATION STUDY') }}</span>
                        <h3 class="font-fraunces text-2xl sm:text-3xl font-bold text-[#6B2203] mt-1">
                            {{ __('Tropical Villa Courtyard Landscape Revitalization') }}
                        </h3>
                        <p class="text-sm text-[#7A5B49] mt-0.5">{{ __('Transformation Category Meta') }}</p>
                    </div>
                    <div class="text-xs text-[#7A5B49] bg-[#F5F1E8] px-4 py-2 rounded-[12px] border border-[#E8DEC8] self-start lg:self-auto">
                        <span class="font-semibold text-[#6B2203]">{{ __('Transformation Phases: 3 Comprehensive Stages') }}</span>
                    </div>
                </div>

                <!-- 3-Column Story: Before -> Process -> Final Result -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-8">
                    <!-- Step 1: Before -->
                    <div class="space-y-3">
                        <div class="relative rounded-[16px] overflow-hidden aspect-[4/3] border border-[#E8DEC8] bg-[#43281C]">
                            <picture>
                                <source media="(max-width: 768px)" srcset="{{ asset('images/kubu/project_before-mobile.webp') }}" type="image/webp">
                                <source srcset="{{ asset('images/kubu/project_before.webp') }}" type="image/webp">
                                <img src="{{ asset('images/kubu/project_before.jpg') }}" alt="Kondisi Awal / Before" width="1376" height="768" class="w-full h-full object-cover" loading="lazy" decoding="async">
                            </picture>
                            <span class="absolute top-3 left-3 bg-[#6B2203] text-white text-[11px] font-bold uppercase tracking-wider px-3 py-1 rounded-full shadow-md">
                                {{ __('1. BEFORE') }}
                            </span>
                        </div>
                        <h4 class="font-fraunces text-lg font-bold text-[#6B2203]">{{ __('Initial Condition') }}</h4>
                        <p class="text-xs text-[#523A2C] leading-relaxed">
                            {{ __('Before Step Desc') }}
                        </p>
                    </div>

                    <!-- Step 2: Process -->
                    <div class="space-y-3">
                        <div class="relative rounded-[16px] overflow-hidden aspect-[4/3] border border-[#E8DEC8] bg-[#3B2918]">
                            <picture>
                                <source media="(max-width: 768px)" srcset="{{ asset('images/kubu/project_process-mobile.webp') }}" type="image/webp">
                                <source srcset="{{ asset('images/kubu/project_process.webp') }}" type="image/webp">
                                <img src="{{ asset('images/kubu/project_process.jpg') }}" alt="Proses Pengerjaan / Process" width="1376" height="768" class="w-full h-full object-cover" loading="lazy" decoding="async">
                            </picture>
                            <span class="absolute top-3 left-3 bg-[#965E03] text-white text-[11px] font-bold uppercase tracking-wider px-3 py-1 rounded-full shadow-md">
                                {{ __('2. PROCESS') }}
                            </span>
                        </div>
                        <h4 class="font-fraunces text-lg font-bold text-[#6B2203]">{{ __('Work in Progress') }}</h4>
                        <p class="text-xs text-[#523A2C] leading-relaxed">
                            {{ __('Process Step Desc') }}
                        </p>
                    </div>

                    <!-- Step 3: Final Result -->
                    <div class="space-y-3">
                        <div class="relative rounded-[16px] overflow-hidden aspect-[4/3] border border-[#E8DEC8] bg-[#223824]">
                            <picture>
                                <source media="(max-width: 768px)" srcset="{{ asset('images/kubu/project_after-mobile.webp') }}" type="image/webp">
                                <source srcset="{{ asset('images/kubu/project_after.webp') }}" type="image/webp">
                                <img src="{{ asset('images/kubu/project_after.jpg') }}" alt="Hasil Akhir / Final Result" width="1376" height="768" class="w-full h-full object-cover" loading="lazy" decoding="async">
                            </picture>
                            <span class="absolute top-3 left-3 bg-[#2D6A4F] text-white text-[11px] font-bold uppercase tracking-wider px-3 py-1 rounded-full shadow-md">
                                {{ __('3. FINAL RESULT') }}
                            </span>
                        </div>
                        <h4 class="font-fraunces text-lg font-bold text-[#6B2203]">{{ __('Final Result') }}</h4>
                        <p class="text-xs text-[#523A2C] leading-relaxed">
                            {{ __('Final Step Desc') }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Other Projects Grid (Villa A, Hotel B, Villa C, Resort D) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($featuredProjects as $project)
                    @php
                        $mainImg = $project->main_image ?? 'images/kubu/hero_bali.jpg';
                        $webpImg = preg_replace('/\.(jpg|jpeg|png)$/i', '.webp', $mainImg);
                        $mobWebpImg = preg_replace('/\.(jpg|jpeg|png)$/i', '-mobile.webp', $mainImg);
                    @endphp
                    <div class="bg-white rounded-[16px] overflow-hidden border border-[#E8DEC8] shadow-warm-sm hover:shadow-warm-md transition-all group">
                        <div class="relative h-44 overflow-hidden bg-[#3B2918]">
                            <picture>
                                @if(file_exists(public_path($mobWebpImg)))
                                    <source media="(max-width: 640px)" srcset="{{ asset($mobWebpImg) }}" type="image/webp">
                                @endif
                                @if(file_exists(public_path($webpImg)))
                                    <source srcset="{{ asset($webpImg) }}" type="image/webp">
                                @endif
                                <img src="{{ asset($mainImg) }}" alt="{{ $project->title }}" width="600" height="340" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy" decoding="async">
                            </picture>
                            <span class="absolute bottom-2 left-3 bg-[#6B2203]/90 text-white text-[10px] font-semibold px-2.5 py-0.5 rounded-full">
                                {{ __($project->category) }}
                            </span>
                        </div>
                        <div class="p-4 space-y-2">
                            <div class="text-[11px] text-[#7A5B49]">
                                <span>{{ $project->location ?? 'Bali' }}</span>
                            </div>
                            <h4 class="font-fraunces text-base font-bold text-[#6B2203]">
                                {{ __($project->title) }}
                            </h4>
                            <p class="text-xs text-[#523A2C] line-clamp-2">
                                {{ __($project->description) }}
                            </p>
                            <div class="pt-2 border-t border-[#E8DEC8] text-right">
                                <a href="{{ route('projects.show', $project->slug) }}" class="text-xs font-semibold text-[#965E03] hover:underline inline-flex items-center gap-1">
                                    <span>{{ __('Transformation Details') }}</span>
                                    <span>→</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- 5. GALLERY HIGHLIGHTS -->
    <section class="py-16 lg:py-24 bg-[#F5F1E8]">
        <div class="w-full px-4 sm:px-8 lg:px-12 xl:px-16 2xl:px-20">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
                <div>
                    <span class="label-caps text-[#965E03] font-bold block mb-2">{{ __('VISUAL EXCELLENCE') }}</span>
                    <h2 class="font-fraunces text-3xl sm:text-4xl font-bold text-[#6B2203] tracking-tight">
                        {{ __('Photo Documentation Gallery') }}
                    </h2>
                    <p class="text-[#654A39] text-base mt-2">
                        {{ __('Gallery Subtitle') }}
                    </p>
                </div>
                <div>
                    <a href="{{ route('gallery.index') }}" class="btn-primary text-xs">
                        <span>{{ __('VIEW FULL GALLERY') }}</span>
                        <span>→</span>
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                @foreach($galleryPreviews as $item)
                    @php
                        $gImg = $item->image_path;
                        $gWebp = preg_replace('/\.(jpg|jpeg|png)$/i', '.webp', $gImg);
                        $gMobWebp = preg_replace('/\.(jpg|jpeg|png)$/i', '-mobile.webp', $gImg);
                    @endphp
                    <a href="{{ route('gallery.index') }}" class="group relative rounded-[16px] overflow-hidden aspect-square border border-[#E8DEC8] shadow-warm-sm block bg-[#3B2918]">
                        <picture>
                            @if(file_exists(public_path($gMobWebp)))
                                <source media="(max-width: 640px)" srcset="{{ asset($gMobWebp) }}" type="image/webp">
                            @endif
                            @if(file_exists(public_path($gWebp)))
                                <source srcset="{{ asset($gWebp) }}" type="image/webp">
                            @endif
                            <img src="{{ asset($gImg) }}" alt="{{ $item->title }}" width="400" height="400" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" loading="lazy" decoding="async">
                        </picture>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex flex-col justify-end p-3">
                            <span class="text-white text-xs font-fraunces font-bold leading-tight">{{ __($item->title) }}</span>
                            <span class="text-[#D4A574] text-[10px] uppercase font-semibold">{{ __($item->parent_group) }}</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- 6. HIGH-CONVERSION CTA BANNER (DIRECT TO WHATSAPP) -->
    <section class="py-16 bg-[#6B2203] text-white relative overflow-hidden">
        <div class="w-full px-4 sm:px-8 lg:px-12 xl:px-16 2xl:px-20 relative z-10">
            <div class="bg-gradient-to-r from-[#521A02] to-[#6B2203] rounded-[32px] p-8 sm:p-12 lg:p-16 border border-[#965E03]/40 shadow-warm-lg flex flex-col lg:flex-row items-center justify-between gap-8">
                <div class="max-w-2xl space-y-4 text-center lg:text-left">
                    <span class="label-caps text-[#D4A574] font-bold text-xs tracking-widest">
                        {{ __('CONSULTATION & INQUIRIES') }}
                    </span>
                    <h2 class="font-fraunces text-3xl sm:text-4xl lg:text-5xl font-bold !text-white text-white leading-tight" style="color: #FFFFFF !important;">
                        {{ __('Ready to Enhance Your Bali Property?') }}
                    </h2>
                    <p class="text-[#F5F1E8]/80 text-base leading-relaxed">
                        {{ __('CTA Banner Desc') }}
                    </p>
                </div>

                <div class="shrink-0 flex flex-col sm:flex-row items-center gap-4">
                    <a href="{{ $globalContact->whatsapp_url ?? '#' }}" target="_blank" rel="noopener noreferrer" class="btn-primary bg-[#965E03] hover:bg-[#825203] text-white text-base px-8 py-4 shadow-xl border border-white/20 transform hover:scale-105">
                        <svg class="w-5 h-5 mr-1" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.598 2.664-.698c.969.586 1.77.809 2.796.809 3.179 0 5.767-2.587 5.767-5.766.002-3.18-2.585-5.766-5.767-5.766zm9.969 5.766c0 5.485-4.457 9.943-9.97 9.943-1.637 0-3.21-.401-4.606-1.164l-5.424 1.42 1.447-5.289c-.87-1.464-1.387-3.197-1.387-4.91 0-5.484 4.458-9.942 9.97-9.942 5.514 0 9.97 4.458 9.97 9.942z"/></svg>
                        <span>{{ __('REQUEST A QUOTE') }}</span>
                    </a>

                    <a href="{{ route('contact.index') }}" class="btn-secondary border-white/40 text-white hover:bg-white/10 text-base px-6 py-4">
                        <span>{{ __('CONTACT US') }}</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
