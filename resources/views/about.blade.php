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
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
                <!-- Large Editorial Visual -->
                <div class="lg:col-span-6">
                    <div class="relative rounded-[32px] overflow-hidden border border-[#E8DEC8] shadow-warm-lg bg-white">
                        <img src="{{ asset('images/kubu/landscape_service.jpg') }}" alt="Kubu Management Bali Professional Team" class="w-full h-[450px] sm:h-[520px] object-cover" loading="lazy">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></div>
                        <div class="absolute bottom-6 left-6 right-6 bg-white/95 backdrop-blur-md p-5 rounded-[16px] border border-[#E8DEC8]">
                            <p class="font-fraunces font-bold text-base text-[#6B2203]">PT. KUBU MANAGEMENT BALI</p>
                            <p class="text-xs text-[#7A5B49] mt-0.5">{{ __('Professional Property Care Services in Bali') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Text Content & Editorial Copy -->
                <div class="lg:col-span-6 space-y-8">
                    <!-- Company Profile Statement -->
                    <div class="bg-white p-8 rounded-[24px] border border-[#E8DEC8] shadow-warm-sm space-y-4">
                        <span class="label-caps text-[#965E03] font-bold">{{ __('COMPANY PROFILE') }}</span>
                        <h2 class="font-fraunces text-2xl sm:text-3xl font-bold text-[#6B2203] leading-snug">
                            {{ __('Commitment to Cleanliness, Natural Beauty, and Service Excellence') }}
                        </h2>
                        <p class="text-[#523A2C] text-base leading-relaxed">
                            {{ __('Company Profile Body') }}
                        </p>
                    </div>

                    <!-- Vision & Mission Block -->
                    <div class="grid grid-cols-1 sm:grid-cols-1 gap-6">
                        <!-- Vision -->
                        <div class="bg-white p-7 rounded-[20px] border border-[#E8DEC8] shadow-warm-sm border-l-4 border-l-[#965E03] space-y-2">
                            <span class="label-caps text-[#965E03] font-bold text-xs tracking-wider">{{ __('VISION') }}</span>
                            <h3 class="font-fraunces text-xl font-bold text-[#6B2203]">
                                {{ __('Vision Statement') }}
                            </h3>
                            <p class="text-xs text-[#7A5B49] leading-relaxed">
                                {{ __('Vision Body') }}
                            </p>
                        </div>

                        <!-- Mission -->
                        <div class="bg-white p-7 rounded-[20px] border border-[#E8DEC8] shadow-warm-sm border-l-4 border-l-[#6B2203] space-y-4">
                            <span class="label-caps text-[#6B2203] font-bold text-xs tracking-wider">{{ __('MISSION') }}</span>
                            <ul class="space-y-3">
                                <li class="flex items-start gap-3 text-sm text-[#43281C]">
                                    <span class="w-5 h-5 rounded-full bg-[#965E03]/15 text-[#965E03] flex items-center justify-center text-xs font-bold shrink-0 mt-0.5">1</span>
                                    <span>{{ __('Mission Point 1') }}</span>
                                </li>
                                <li class="flex items-start gap-3 text-sm text-[#43281C]">
                                    <span class="w-5 h-5 rounded-full bg-[#965E03]/15 text-[#965E03] flex items-center justify-center text-xs font-bold shrink-0 mt-0.5">2</span>
                                    <span>{{ __('Mission Point 2') }}</span>
                                </li>
                                <li class="flex items-start gap-3 text-sm text-[#43281C]">
                                    <span class="w-5 h-5 rounded-full bg-[#965E03]/15 text-[#965E03] flex items-center justify-center text-xs font-bold shrink-0 mt-0.5">3</span>
                                    <span>{{ __('Mission Point 3') }}</span>
                                </li>
                                <li class="flex items-start gap-3 text-sm text-[#43281C]">
                                    <span class="w-5 h-5 rounded-full bg-[#965E03]/15 text-[#965E03] flex items-center justify-center text-xs font-bold shrink-0 mt-0.5">4</span>
                                    <span>{{ __('Mission Point 4') }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
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
