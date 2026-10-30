@extends('layouts.app')

@section('title', __('OUR SERVICES') . ' | PT. KUBU MANAGEMENT BALI')
@section('meta_description', __('Services Header Desc'))

@section('content')
    <!-- Banner -->
    <section class="bg-[#F5F1E8] py-12 lg:py-16 border-b border-[#E8DEC8]">
        <div class="w-full px-4 sm:px-8 lg:px-12 xl:px-16 2xl:px-20">
            <span class="label-caps text-[#965E03] font-bold block mb-2">{{ __('SERVICES OVERVIEW') }}</span>
            <h1 class="font-fraunces text-4xl sm:text-5xl font-bold text-[#6B2203] tracking-tight">
                {{ __('Integrated Property Services') }}
            </h1>
            <p class="text-base sm:text-lg text-[#654A39] mt-3 max-w-2xl">
                {{ __('Services Header Desc') }}
            </p>
        </div>
    </section>

    <!-- Services Section -->
    <section class="py-16 lg:py-24 bg-[#FAF7F2]">
        <div class="w-full px-4 sm:px-8 lg:px-12 xl:px-16 2xl:px-20 space-y-16">
            <!-- 1. Kubu Landscape & Garden Division -->
            <div class="bg-white rounded-[32px] border border-[#E8DEC8] p-6 sm:p-12 shadow-warm-md">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center pb-8 border-b border-[#E8DEC8]">
                    <div class="lg:col-span-8 space-y-3">
                        <span class="label-caps text-[#965E03] font-bold">{{ __('DIVISION 01') }}</span>
                        <h2 class="font-fraunces text-3xl font-bold text-[#6B2203]">
                            {{ __('KUBU LANDSCAPE & GARDEN') }}
                        </h2>
                        <p class="text-sm sm:text-base text-[#523A2C] leading-relaxed">
                            {{ __('Landscape Division Desc') }}
                        </p>
                    </div>
                    <div class="lg:col-span-4 lg:text-right">
                        <a href="{{ route('services.landscape') }}" class="btn-primary w-full sm:w-auto text-center justify-center">
                            <span>{{ __('EXPLORE LANDSCAPE DIVISION') }}</span>
                            <span>→</span>
                        </a>
                    </div>
                </div>

                <!-- 4 Sub-services under Landscape -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 pt-8">
                    <!-- A. Garden Maintenance -->
                    <div class="p-6 rounded-[16px] bg-[#FAF7F2] border border-[#E8DEC8] space-y-3 hover:border-[#965E03] transition-colors">
                        <span class="w-8 h-8 rounded-full bg-[#965E03]/10 text-[#965E03] flex items-center justify-center font-bold text-xs">A</span>
                        <h3 class="font-fraunces text-lg font-bold text-[#6B2203]">
                            <a href="{{ route('services.show', 'garden-maintenance') }}" class="hover:text-[#965E03] transition-colors">
                                {{ __('Garden Maintenance') }}
                            </a>
                        </h3>
                        <ul class="text-xs text-[#523A2C] space-y-1.5 pt-1">
                            <li class="flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-[#965E03]"></span> {{ __('Plant & hedge pruning') }}</li>
                            <li class="flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-[#965E03]"></span> {{ __('Nutrient fertilization') }}</li>
                            <li class="flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-[#965E03]"></span> {{ __('Routine watering') }}</li>
                            <li class="flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-[#965E03]"></span> {{ __('Weed control') }}</li>
                            <li class="flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-[#965E03]"></span> {{ __('Specialized plant care') }}</li>
                        </ul>
                    </div>

                    <!-- B. Landscape Maintenance -->
                    <div class="p-6 rounded-[16px] bg-[#FAF7F2] border border-[#E8DEC8] space-y-3 hover:border-[#965E03] transition-colors">
                        <span class="w-8 h-8 rounded-full bg-[#965E03]/10 text-[#965E03] flex items-center justify-center font-bold text-xs">B</span>
                        <h3 class="font-fraunces text-lg font-bold text-[#6B2203]">
                            <a href="{{ route('services.show', 'landscape-maintenance') }}" class="hover:text-[#965E03] transition-colors">
                                {{ __('Landscape Maintenance') }}
                            </a>
                        </h3>
                        <ul class="text-xs text-[#523A2C] space-y-1.5 pt-1">
                            <li class="flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-[#965E03]"></span> {{ __('Garden maintenance') }}</li>
                            <li class="flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-[#965E03]"></span> {{ __('Outdoor grounds care') }}</li>
                            <li class="flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-[#965E03]"></span> {{ __('Tropical flora care') }}</li>
                            <li class="flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-[#965E03]"></span> {{ __('Villa & hotel garden management') }}</li>
                        </ul>
                    </div>

                    <!-- C. Garden Improvement -->
                    <div class="p-6 rounded-[16px] bg-[#FAF7F2] border border-[#E8DEC8] space-y-3 hover:border-[#965E03] transition-colors">
                        <span class="w-8 h-8 rounded-full bg-[#965E03]/10 text-[#965E03] flex items-center justify-center font-bold text-xs">C</span>
                        <h3 class="font-fraunces text-lg font-bold text-[#6B2203]">
                            <a href="{{ route('services.show', 'garden-improvement') }}" class="hover:text-[#965E03] transition-colors">
                                {{ __('Garden Improvement') }}
                            </a>
                        </h3>
                        <ul class="text-xs text-[#523A2C] space-y-1.5 pt-1">
                            <li class="flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-[#965E03]"></span> {{ __('Landscape redesign') }}</li>
                            <li class="flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-[#965E03]"></span> {{ __('Plant replacement') }}</li>
                            <li class="flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-[#965E03]"></span> {{ __('New plant additions') }}</li>
                            <li class="flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-[#965E03]"></span> {{ __('Garden bed restoration') }}</li>
                        </ul>
                    </div>

                    <!-- D. Irrigation -->
                    <div class="p-6 rounded-[16px] bg-[#FAF7F2] border border-[#E8DEC8] space-y-3 hover:border-[#965E03] transition-colors">
                        <span class="w-8 h-8 rounded-full bg-[#965E03]/10 text-[#965E03] flex items-center justify-center font-bold text-xs">D</span>
                        <h3 class="font-fraunces text-lg font-bold text-[#6B2203]">
                            <a href="{{ route('services.show', 'irrigation') }}" class="hover:text-[#965E03] transition-colors">
                                {{ __('Irrigation') }}
                            </a>
                        </h3>
                        <ul class="text-xs text-[#523A2C] space-y-1.5 pt-1">
                            <li class="flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-[#965E03]"></span> {{ __('Sprinkler system inspection') }}</li>
                            <li class="flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-[#965E03]"></span> {{ __('Irrigation maintenance') }}</li>
                            <li class="flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-[#965E03]"></span> {{ __('Piping & sprinkler repair') }}</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- 2. Kubu Clean / Housekeeping Division -->
            <div class="bg-white rounded-[32px] border border-[#E8DEC8] p-6 sm:p-12 shadow-warm-md">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center pb-8 border-b border-[#E8DEC8]">
                    <div class="lg:col-span-8 space-y-3">
                        <span class="label-caps text-[#6B2203] font-bold">{{ __('DIVISION 02') }}</span>
                        <h2 class="font-fraunces text-3xl font-bold text-[#6B2203]">
                            {{ __('KUBU CLEAN / HOUSEKEEPING') }}
                        </h2>
                        <p class="text-sm sm:text-base text-[#523A2C] leading-relaxed">
                            {{ __('Housekeeping Division Desc') }}
                        </p>
                    </div>
                    <div class="lg:col-span-4 lg:text-right">
                        <a href="{{ route('services.housekeeping') }}" class="btn-primary w-full sm:w-auto text-center justify-center">
                                <span>{{ __('EXPLORE HOUSEKEEPING DIVISION') }}</span>
                            <span>→</span>
                        </a>
                    </div>
                </div>

                <!-- 3 Sub-services under Housekeeping -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 pt-8">
                    <!-- A. Villa Housekeeping -->
                    <div class="p-6 rounded-[16px] bg-[#FAF7F2] border border-[#E8DEC8] space-y-3 hover:border-[#6B2203] transition-colors">
                        <span class="w-8 h-8 rounded-full bg-[#6B2203]/10 text-[#6B2203] flex items-center justify-center font-bold text-xs">A</span>
                        <h3 class="font-fraunces text-lg font-bold text-[#6B2203]">
                            <a href="{{ route('services.show', 'villa-housekeeping') }}" class="hover:text-[#965E03] transition-colors">
                                {{ __('Villa Housekeeping') }}
                            </a>
                        </h3>
                        <ul class="text-xs text-[#523A2C] space-y-1.5 pt-1">
                            <li class="flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-[#6B2203]"></span> {{ __('Bedroom cleaning') }}</li>
                            <li class="flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-[#6B2203]"></span> {{ __('Bathroom sanitization') }}</li>
                            <li class="flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-[#6B2203]"></span> {{ __('Kitchen cleaning') }}</li>
                            <li class="flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-[#6B2203]"></span> {{ __('Living area care') }}</li>
                            <li class="flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-[#6B2203]"></span> {{ __('Linen management') }}</li>
                        </ul>
                    </div>

                    <!-- B. Hotel Housekeeping -->
                    <div class="p-6 rounded-[16px] bg-[#FAF7F2] border border-[#E8DEC8] space-y-3 hover:border-[#6B2203] transition-colors">
                        <span class="w-8 h-8 rounded-full bg-[#6B2203]/10 text-[#6B2203] flex items-center justify-center font-bold text-xs">B</span>
                        <h3 class="font-fraunces text-lg font-bold text-[#6B2203]">
                            <a href="{{ route('services.show', 'hotel-housekeeping') }}" class="hover:text-[#965E03] transition-colors">
                                {{ __('Hotel Housekeeping') }}
                            </a>
                        </h3>
                        <ul class="text-xs text-[#523A2C] space-y-1.5 pt-1">
                            <li class="flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-[#6B2203]"></span> {{ __('Daily room attendant') }}</li>
                            <li class="flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-[#6B2203]"></span> {{ __('Public area cleaning') }}</li>
                            <li class="flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-[#6B2203]"></span> {{ __('Linen handling') }}</li>
                            <li class="flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-[#6B2203]"></span> {{ __('Cleaning support staff') }}</li>
                            <li class="flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-[#6B2203]"></span> {{ __('Turndown service') }}</li>
                        </ul>
                    </div>

                    <!-- C. Residential Housekeeping -->
                    <div class="p-6 rounded-[16px] bg-[#FAF7F2] border border-[#E8DEC8] space-y-3 hover:border-[#6B2203] transition-colors">
                        <span class="w-8 h-8 rounded-full bg-[#6B2203]/10 text-[#6B2203] flex items-center justify-center font-bold text-xs">C</span>
                        <h3 class="font-fraunces text-lg font-bold text-[#6B2203]">
                            <a href="{{ route('services.show', 'residential-housekeeping') }}" class="hover:text-[#965E03] transition-colors">
                                {{ __('Residential Housekeeping') }}
                            </a>
                        </h3>
                        <p class="text-xs text-[#7A5B49] font-medium">{{ __('SERVICES FOR:') }}</p>
                        <ul class="text-xs text-[#523A2C] space-y-1.5 pt-1">
                            <li class="flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-[#6B2203]"></span> {{ __('Private villas') }}</li>
                            <li class="flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-[#6B2203]"></span> {{ __('Houses') }}</li>
                            <li class="flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-[#6B2203]"></span> {{ __('Apartments') }}</li>
                            <li class="flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-[#6B2203]"></span> {{ __('Residential estates') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
