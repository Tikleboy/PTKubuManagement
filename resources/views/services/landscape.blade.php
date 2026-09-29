@extends('layouts.app')

@section('title', __('Kubu Landscape & Garden') . ' | PT. KUBU MANAGEMENT BALI')
@section('meta_description', __('Landscape Header Subtitle'))

@section('content')
    <!-- Header -->
    <section class="bg-[#F5F1E8] py-12 lg:py-16 border-b border-[#E8DEC8]">
        <div class="w-full px-4 sm:px-8 lg:px-12 xl:px-16 2xl:px-20">
            <div class="max-w-3xl">
                <div class="inline-flex items-center gap-2 bg-white px-3 py-1 rounded-full border border-[#E8DEC8] text-xs mb-3">
                    <span class="w-2 h-2 rounded-full bg-[#965E03]"></span>
                    <span class="label-caps text-[#965E03] font-bold">{{ __('DIVISION 01') }}</span>
                </div>
                <h1 class="font-fraunces text-4xl sm:text-5xl font-bold text-[#6B2203] tracking-tight">
                    {{ __('Kubu Landscape & Garden') }}
                </h1>
                <p class="text-base sm:text-lg text-[#654A39] mt-3 italic border-l-2 border-[#D4A574] pl-3">
                    {{ __('Landscape Quote Tagline') }}
                </p>
                <p class="text-sm sm:text-base text-[#523A2C] mt-4 leading-relaxed">
                    {{ __('Landscape Header Subtitle') }}
                </p>
            </div>
        </div>
    </section>

    <!-- Services Detail Grid -->
    <section class="py-16 lg:py-24 bg-[#FAF7F2]">
        <div class="w-full px-4 sm:px-8 lg:px-12 xl:px-16 2xl:px-20 space-y-16">
            <!-- Hero Landscape Image Banner -->
            <div class="rounded-[28px] overflow-hidden border border-[#E8DEC8] shadow-warm-md bg-white">
                <img src="{{ asset('images/kubu/landscape_service.jpg') }}" alt="Kubu Landscape Service Bali" class="w-full h-[320px] sm:h-[420px] object-cover">
            </div>

            <!-- 4 Service Categories Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-10">
                <!-- A. GARDEN MAINTENANCE -->
                <div class="bg-white rounded-[24px] p-8 border border-[#E8DEC8] shadow-warm-sm hover:shadow-warm-md transition-all space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-[10px] bg-[#965E03]/10 text-[#965E03] flex items-center justify-center font-bold text-sm">
                            A
                        </div>
                        <h2 class="font-fraunces text-2xl font-bold text-[#6B2203]">
                            <a href="{{ route('services.show', 'garden-maintenance') }}" class="hover:text-[#965E03] transition-colors">
                                {{ __('Garden Maintenance') }}
                            </a>
                        </h2>
                    </div>
                    <p class="text-sm text-[#523A2C] leading-relaxed">
                        {{ __('Garden Maintenance Long Desc') }}
                    </p>
                    <div class="pt-2 border-t border-[#E8DEC8]">
                        <span class="label-caps text-[#965E03] text-[10px] block mb-2 font-bold">{{ __('SCOPE OF WORK:') }}</span>
                        <ul class="space-y-2 text-sm text-[#43281C]">
                            <li class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-[#965E03]"></span>
                                <span>{{ __('Plant & hedge pruning') }}</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-[#965E03]"></span>
                                <span>{{ __('Nutrient fertilization') }}</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-[#965E03]"></span>
                                <span>{{ __('Routine watering') }}</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-[#965E03]"></span>
                                <span>{{ __('Weed control') }}</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-[#965E03]"></span>
                                <span>{{ __('Specialized plant care') }}</span>
                            </li>
                        </ul>
                        <div class="pt-3 border-t border-[#E8DEC8]/80 flex justify-end">
                            <a href="{{ route('services.show', 'garden-maintenance') }}" class="inline-flex items-center gap-1 text-xs font-semibold text-[#965E03] hover:underline">
                                <span>{{ __('Details & Consultation') }}</span>
                                <span>→</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- B. LANDSCAPE MAINTENANCE -->
                <div class="bg-white rounded-[24px] p-8 border border-[#E8DEC8] shadow-warm-sm hover:shadow-warm-md transition-all space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-[10px] bg-[#965E03]/10 text-[#965E03] flex items-center justify-center font-bold text-sm">
                            B
                        </div>
                        <h2 class="font-fraunces text-2xl font-bold text-[#6B2203]">
                            <a href="{{ route('services.show', 'landscape-maintenance') }}" class="hover:text-[#965E03] transition-colors">
                                {{ __('Landscape Maintenance') }}
                            </a>
                        </h2>
                    </div>
                    <p class="text-sm text-[#523A2C] leading-relaxed">
                        {{ __('Landscape Maintenance Long Desc') }}
                    </p>
                    <div class="pt-2 border-t border-[#E8DEC8]">
                        <span class="label-caps text-[#965E03] text-[10px] block mb-2 font-bold">{{ __('SCOPE OF WORK:') }}</span>
                        <ul class="space-y-2 text-sm text-[#43281C]">
                            <li class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-[#965E03]"></span>
                                <span>{{ __('Garden maintenance') }}</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-[#965E03]"></span>
                                <span>{{ __('Outdoor grounds care') }}</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-[#965E03]"></span>
                                <span>{{ __('Tropical flora care') }}</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-[#965E03]"></span>
                                <span>{{ __('Villa & hotel garden management') }}</span>
                            </li>
                        </ul>
                        <div class="pt-3 border-t border-[#E8DEC8]/80 flex justify-end">
                            <a href="{{ route('services.show', 'landscape-maintenance') }}" class="inline-flex items-center gap-1 text-xs font-semibold text-[#965E03] hover:underline">
                                <span>{{ __('Details & Consultation') }}</span>
                                <span>→</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- C. GARDEN IMPROVEMENT -->
                <div class="bg-white rounded-[24px] p-8 border border-[#E8DEC8] shadow-warm-sm hover:shadow-warm-md transition-all space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-[10px] bg-[#965E03]/10 text-[#965E03] flex items-center justify-center font-bold text-sm">
                            C
                        </div>
                        <h2 class="font-fraunces text-2xl font-bold text-[#6B2203]">
                            <a href="{{ route('services.show', 'garden-improvement') }}" class="hover:text-[#965E03] transition-colors">
                                {{ __('Garden Improvement') }}
                            </a>
                        </h2>
                    </div>
                    <p class="text-sm text-[#523A2C] leading-relaxed">
                        {{ __('Garden Improvement Long Desc') }}
                    </p>
                    <div class="pt-2 border-t border-[#E8DEC8]">
                        <span class="label-caps text-[#965E03] text-[10px] block mb-2 font-bold">{{ __('SCOPE OF WORK:') }}</span>
                        <ul class="space-y-2 text-sm text-[#43281C]">
                            <li class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-[#965E03]"></span>
                                <span>{{ __('Landscape redesign') }}</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-[#965E03]"></span>
                                <span>{{ __('Plant replacement') }}</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-[#965E03]"></span>
                                <span>{{ __('New plant additions') }}</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-[#965E03]"></span>
                                <span>{{ __('Garden bed restoration') }}</span>
                            </li>
                        </ul>
                        <div class="pt-3 border-t border-[#E8DEC8]/80 flex justify-end">
                            <a href="{{ route('services.show', 'garden-improvement') }}" class="inline-flex items-center gap-1 text-xs font-semibold text-[#965E03] hover:underline">
                                <span>{{ __('Details & Consultation') }}</span>
                                <span>→</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- D. IRRIGATION -->
                <div class="bg-white rounded-[24px] p-8 border border-[#E8DEC8] shadow-warm-sm hover:shadow-warm-md transition-all space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-[10px] bg-[#965E03]/10 text-[#965E03] flex items-center justify-center font-bold text-sm">
                            D
                        </div>
                        <h2 class="font-fraunces text-2xl font-bold text-[#6B2203]">
                            <a href="{{ route('services.show', 'irrigation') }}" class="hover:text-[#965E03] transition-colors">
                                {{ __('Irrigation') }}
                            </a>
                        </h2>
                    </div>
                    <p class="text-sm text-[#523A2C] leading-relaxed">
                        {{ __('Irrigation Long Desc') }}
                    </p>
                    <div class="pt-2 border-t border-[#E8DEC8]">
                        <span class="label-caps text-[#965E03] text-[10px] block mb-2 font-bold">{{ __('SCOPE OF WORK:') }}</span>
                        <ul class="space-y-2 text-sm text-[#43281C]">
                            <li class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-[#965E03]"></span>
                                <span>{{ __('Sprinkler system inspection') }}</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-[#965E03]"></span>
                                <span>{{ __('Irrigation maintenance') }}</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-[#965E03]"></span>
                                <span>{{ __('Piping & sprinkler repair') }}</span>
                            </li>
                        </ul>
                        <div class="pt-3 border-t border-[#E8DEC8]/80 flex justify-end">
                            <a href="{{ route('services.show', 'irrigation') }}" class="inline-flex items-center gap-1 text-xs font-semibold text-[#965E03] hover:underline">
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
                    <h3 class="font-fraunces text-2xl font-bold text-white">{{ __('Need Garden Maintenance Schedule in Bali?') }}</h3>
                    <p class="text-sm text-[#F5F1E8]/80 mt-1">{{ __('Consult garden schedule directly via WhatsApp') }}</p>
                </div>
                <a href="{{ $globalContact->whatsapp_url ?? '#' }}" target="_blank" rel="noopener noreferrer" class="btn-primary bg-[#965E03] hover:bg-[#804e02] shrink-0 text-sm px-6 py-3.5 shadow-lg">
                    <span>{{ __('REQUEST A QUOTE (WHATSAPP)') }}</span>
                    <span>→</span>
                </a>
            </div>
        </div>
    </section>
@endsection
