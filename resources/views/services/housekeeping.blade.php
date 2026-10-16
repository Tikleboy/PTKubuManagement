@extends('layouts.app')

@section('title', __('Kubu Clean / Housekeeping') . ' | PT. KUBU MANAGEMENT BALI')
@section('meta_description', __('Housekeeping Header Subtitle'))

@section('content')
    <!-- Header -->
    <section class="bg-[#F5F1E8] py-12 lg:py-16 border-b border-[#E8DEC8]">
        <div class="w-full px-4 sm:px-8 lg:px-12 xl:px-16 2xl:px-20">
            <div class="max-w-3xl">
                <div class="inline-flex items-center gap-2 bg-white px-3 py-1 rounded-full border border-[#E8DEC8] text-xs mb-3">
                    <span class="w-2 h-2 rounded-full bg-[#6B2203]"></span>
                    <span class="label-caps text-[#6B2203] font-bold">{{ __('DIVISION 02') }}</span>
                </div>
                <h1 class="font-fraunces text-4xl sm:text-5xl font-bold text-[#6B2203] tracking-tight">
                    {{ __('Kubu Clean / Housekeeping') }}
                </h1>
                <p class="text-base sm:text-lg text-[#654A39] mt-3 italic border-l-2 border-[#D4A574] pl-3">
                    {{ __('Housekeeping Quote Tagline') }}
                </p>
                <p class="text-sm sm:text-base text-[#523A2C] mt-4 leading-relaxed">
                    {{ __('Housekeeping Header Subtitle') }}
                </p>
            </div>
        </div>
    </section>

    <!-- Services Detail Grid -->
    <section class="py-16 lg:py-24 bg-[#FAF7F2]">
        <div class="w-full px-4 sm:px-8 lg:px-12 xl:px-16 2xl:px-20 space-y-16">
            <!-- Hero Housekeeping Visual Banner -->
            <div class="rounded-[28px] overflow-hidden border border-[#E8DEC8] shadow-warm-md bg-[#43281C]">
                <picture>
                    <source media="(max-width: 768px)" srcset="{{ asset('images/kubu/housekeeping_service-mobile.webp') }}" type="image/webp">
                    <source srcset="{{ asset('images/kubu/housekeeping_service.webp') }}" type="image/webp">
                    <img src="{{ asset('images/kubu/housekeeping_service.jpg') }}" alt="Kubu Housekeeping Service Bali" width="1376" height="768" class="w-full h-[320px] sm:h-[420px] object-cover" loading="lazy" decoding="async">
                </picture>
            </div>

            <!-- 3 Service Categories Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- A. VILLA HOUSEKEEPING -->
                <div class="bg-white rounded-[24px] p-8 border border-[#E8DEC8] shadow-warm-sm hover:shadow-warm-md transition-all space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-[10px] bg-[#6B2203]/10 text-[#6B2203] flex items-center justify-center font-bold text-sm">
                            A
                        </div>
                        <h2 class="font-fraunces text-2xl font-bold text-[#6B2203]">
                            <a href="{{ route('services.show', 'villa-housekeeping') }}" class="hover:text-[#965E03] transition-colors">
                                {{ __('VILLA HOUSEKEEPING') }}
                            </a>
                        </h2>
                    </div>
                    <p class="text-sm text-[#523A2C] leading-relaxed">
                        {{ __('Villa Housekeeping Long Desc') }}
                    </p>
                    <div class="pt-2 border-t border-[#E8DEC8]">
                        <span class="label-caps text-[#6B2203] text-[10px] block mb-2 font-bold">{{ __('SCOPE OF WORK:') }}</span>
                        <ul class="space-y-2 text-sm text-[#43281C]">
                            <li class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-[#6B2203]"></span>
                                <span>{{ __('Bedroom cleaning') }}</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-[#6B2203]"></span>
                                <span>{{ __('Bathroom sanitization') }}</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-[#6B2203]"></span>
                                <span>{{ __('Kitchen cleaning') }}</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-[#6B2203]"></span>
                                <span>{{ __('Living area care') }}</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-[#6B2203]"></span>
                                <span>{{ __('Linen management') }}</span>
                            </li>
                        </ul>
                        <div class="pt-3 border-t border-[#E8DEC8]/80 flex justify-end">
                            <a href="{{ route('services.show', 'villa-housekeeping') }}" class="inline-flex items-center gap-1 text-xs font-semibold text-[#6B2203] hover:underline">
                                <span>{{ __('Details & Consultation') }}</span>
                                <span>→</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- B. HOTEL HOUSEKEEPING -->
                <div class="bg-white rounded-[24px] p-8 border border-[#E8DEC8] shadow-warm-sm hover:shadow-warm-md transition-all space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-[10px] bg-[#6B2203]/10 text-[#6B2203] flex items-center justify-center font-bold text-sm">
                            B
                        </div>
                        <h2 class="font-fraunces text-2xl font-bold text-[#6B2203]">
                            <a href="{{ route('services.show', 'hotel-housekeeping') }}" class="hover:text-[#965E03] transition-colors">
                                {{ __('HOTEL HOUSEKEEPING') }}
                            </a>
                        </h2>
                    </div>
                    <p class="text-sm text-[#523A2C] leading-relaxed">
                        {{ __('Hotel Housekeeping Long Desc') }}
                    </p>
                    <div class="pt-2 border-t border-[#E8DEC8]">
                        <span class="label-caps text-[#6B2203] text-[10px] block mb-2 font-bold">{{ __('SCOPE OF WORK:') }}</span>
                        <ul class="space-y-2 text-sm text-[#43281C]">
                            <li class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-[#6B2203]"></span>
                                <span>{{ __('Daily room attendant') }}</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-[#6B2203]"></span>
                                <span>{{ __('Public area cleaning') }}</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-[#6B2203]"></span>
                                <span>{{ __('Linen handling') }}</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-[#6B2203]"></span>
                                <span>{{ __('Cleaning support staff') }}</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-[#6B2203]"></span>
                                <span>{{ __('Turndown service') }}</span>
                            </li>
                        </ul>
                        <div class="pt-3 border-t border-[#E8DEC8]/80 flex justify-end">
                            <a href="{{ route('services.show', 'hotel-housekeeping') }}" class="inline-flex items-center gap-1 text-xs font-semibold text-[#6B2203] hover:underline">
                                <span>{{ __('Details & Consultation') }}</span>
                                <span>→</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- C. RESIDENTIAL HOUSEKEEPING -->
                <div class="bg-white rounded-[24px] p-8 border border-[#E8DEC8] shadow-warm-sm hover:shadow-warm-md transition-all space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-[10px] bg-[#6B2203]/10 text-[#6B2203] flex items-center justify-center font-bold text-sm">
                            C
                        </div>
                        <h2 class="font-fraunces text-2xl font-bold text-[#6B2203]">
                            <a href="{{ route('services.show', 'residential-housekeeping') }}" class="hover:text-[#965E03] transition-colors">
                                {{ __('RESIDENTIAL HOUSEKEEPING') }}
                            </a>
                        </h2>
                    </div>
                    <p class="text-sm text-[#523A2C] leading-relaxed">
                        {{ __('Residential Housekeeping Long Desc') }}
                    </p>
                    <div class="pt-2 border-t border-[#E8DEC8]">
                        <span class="label-caps text-[#6B2203] text-[10px] block mb-2 font-bold">{{ __('SERVICES FOR:') }}</span>
                        <ul class="space-y-2 text-sm text-[#43281C]">
                            <li class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-[#6B2203]"></span>
                                <span>{{ __('Private villas') }}</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-[#6B2203]"></span>
                                <span>{{ __('Houses') }}</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-[#6B2203]"></span>
                                <span>{{ __('Apartments') }}</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-[#6B2203]"></span>
                                <span>{{ __('Residential estates') }}</span>
                            </li>
                        </ul>
                        <div class="pt-3 border-t border-[#E8DEC8]/80 flex justify-end">
                            <a href="{{ route('services.show', 'residential-housekeeping') }}" class="inline-flex items-center gap-1 text-xs font-semibold text-[#6B2203] hover:underline">
                                <span>{{ __('Details & Consultation') }}</span>
                                <span>→</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Conversion Action -->
            <div class="bg-gradient-to-r from-[#6B2203] to-[#521A02] text-white p-8 sm:p-10 rounded-[24px] border border-[#965E03] flex flex-col md:flex-row items-center justify-between gap-6">
                <div>
                    <h3 class="font-fraunces text-2xl font-bold text-white">{{ __('Need Housekeeping Schedule in Bali?') }}</h3>
                    <p class="text-sm text-[#F5F1E8]/80 mt-1">{{ __('Consult housekeeping schedule directly via WhatsApp') }}</p>
                </div>
                <a href="{{ $globalContact->whatsapp_url ?? '#' }}" target="_blank" rel="noopener noreferrer" class="btn-primary bg-[#965E03] hover:bg-[#804e02] shrink-0 text-sm px-6 py-3.5 shadow-lg">
                    <span>{{ __('REQUEST A QUOTE (WHATSAPP)') }}</span>
                    <span>→</span>
                </a>
            </div>
        </div>
    </section>
@endsection
