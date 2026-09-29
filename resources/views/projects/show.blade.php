@extends('layouts.app')

@section('title', __($project->title) . ' - ' . __('Project Details') . ' | PT. KUBU MANAGEMENT BALI')
@section('meta_description', __($project->description) ?? 'PT. KUBU MANAGEMENT BALI')

@section('content')
    <section class="bg-[#F5F1E8] py-12 lg:py-16 border-b border-[#E8DEC8]">
        <div class="w-full px-4 sm:px-8 lg:px-12 xl:px-16 2xl:px-20">
            <div class="max-w-3xl">
                <a href="{{ route('projects.index') }}" class="text-xs font-semibold text-[#965E03] hover:underline mb-2 inline-block">
                    ← {{ __('Back to All Projects') }}
                </a>
                <div class="flex items-center gap-2 mb-2">
                    <span class="bg-[#965E03] text-white text-[11px] font-semibold px-2.5 py-0.5 rounded-full uppercase">
                        {{ __($project->category) }}
                    </span>
                    @if($project->location)
                        <span class="text-xs text-[#7A5B49] font-medium">• {{ $project->location }}</span>
                    @endif
                </div>
                <h1 class="font-fraunces text-4xl sm:text-5xl font-bold text-[#6B2203] tracking-tight">
                    {{ __($project->title) }}
                </h1>
                <p class="text-base text-[#654A39] mt-3">
                    {{ __('Property Transformation Documentation: Before → Process → Final Result') }}
                </p>
            </div>
        </div>
    </section>

    <section class="py-16 lg:py-24 bg-[#FAF7F2]">
        <div class="w-full px-4 sm:px-8 lg:px-12 xl:px-16 2xl:px-20 space-y-16">
            <!-- Project Main Overview -->
            <div class="bg-white rounded-[28px] border border-[#E8DEC8] p-8 sm:p-12 shadow-warm-md">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    <div class="lg:col-span-7 rounded-[20px] overflow-hidden border border-[#E8DEC8]">
                        <img src="{{ asset($project->main_image ?? 'images/kubu/hero_bali.jpg') }}" alt="{{ __($project->title) }}" class="w-full h-[360px] sm:h-[420px] object-cover">
                    </div>
                    <div class="lg:col-span-5 space-y-4">
                        <span class="label-caps text-[#965E03] font-bold">{{ __('WORK SUMMARY') }}</span>
                        <h2 class="font-fraunces text-2xl font-bold text-[#6B2203]">{{ __('Focus & Methodology') }}</h2>
                        <p class="text-sm sm:text-base text-[#523A2C] leading-relaxed">
                            {{ __($project->description) }}
                        </p>
                        <div class="pt-4 border-t border-[#E8DEC8] space-y-2 text-xs text-[#7A5B49]">
                            <p><strong>{{ __('Category:') }}</strong> {{ __($project->category) }}</p>
                            <p><strong>{{ __('Location:') }}</strong> {{ $project->location ?? 'Bali' }}</p>
                            <p class="italic text-[11px] text-[#965E03]">{{ __('Project Note Demonstration') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- VISUAL STORYTELLING: BEFORE -> PROCESS -> FINAL RESULT -->
            <div class="space-y-8">
                <div class="text-center max-w-2xl mx-auto">
                    <span class="label-caps text-[#965E03] font-bold block mb-2">{{ __('VISUAL STORYTELLING') }}</span>
                    <h2 class="font-fraunces text-3xl font-bold text-[#6B2203]">
                        {{ __('Property Transformation Stages') }}
                    </h2>
                    <p class="text-sm text-[#7A5B49] mt-2">
                        {{ __('Visual Storytelling Subtitle') }}
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Before -->
                    <div class="bg-white rounded-[24px] p-6 border border-[#E8DEC8] shadow-warm-sm flex flex-col justify-between space-y-4">
                        <div class="space-y-3">
                            <div class="relative rounded-[16px] overflow-hidden aspect-[4/3] border border-[#E8DEC8]">
                                @php $beforeImg = $project->images->where('image_type', 'before')->first(); @endphp
                                <img src="{{ asset($beforeImg->image_path ?? 'images/kubu/project_before.jpg') }}" alt="Before" class="w-full h-full object-cover">
                                <span class="absolute top-3 left-3 bg-[#6B2203] text-white text-[11px] font-bold uppercase tracking-wider px-3 py-1 rounded-full shadow-md">
                                    1. {{ __('BEFORE') }}
                                </span>
                            </div>
                            <h3 class="font-fraunces text-xl font-bold text-[#6B2203]">{{ __('Initial Condition') }}</h3>
                            <p class="text-xs text-[#523A2C] leading-relaxed">
                                {{ __($beforeImg->caption ?? 'Initial condition prior to Kubu Management care and revitalization.') }}
                            </p>
                        </div>
                    </div>

                    <!-- Process -->
                    <div class="bg-white rounded-[24px] p-6 border border-[#E8DEC8] shadow-warm-sm flex flex-col justify-between space-y-4">
                        <div class="space-y-3">
                            <div class="relative rounded-[16px] overflow-hidden aspect-[4/3] border border-[#E8DEC8]">
                                @php $processImg = $project->images->where('image_type', 'process')->first(); @endphp
                                <img src="{{ asset($processImg->image_path ?? 'images/kubu/project_process.jpg') }}" alt="Process" class="w-full h-full object-cover">
                                <span class="absolute top-3 left-3 bg-[#965E03] text-white text-[11px] font-bold uppercase tracking-wider px-3 py-1 rounded-full shadow-md">
                                    2. {{ __('PROCESS') }}
                                </span>
                            </div>
                            <h3 class="font-fraunces text-xl font-bold text-[#6B2203]">{{ __('Work in Progress') }}</h3>
                            <p class="text-xs text-[#523A2C] leading-relaxed">
                                {{ __($processImg->caption ?? 'Work in progress by skilled staff and technicians utilizing standardized equipment.') }}
                            </p>
                        </div>
                    </div>

                    <!-- Final Result -->
                    <div class="bg-white rounded-[24px] p-6 border border-[#E8DEC8] shadow-warm-sm flex flex-col justify-between space-y-4">
                        <div class="space-y-3">
                            <div class="relative rounded-[16px] overflow-hidden aspect-[4/3] border border-[#E8DEC8]">
                                @php $afterImg = $project->images->where('image_type', 'after')->first(); @endphp
                                <img src="{{ asset($afterImg->image_path ?? 'images/kubu/project_after.jpg') }}" alt="Final Result" class="w-full h-full object-cover">
                                <span class="absolute top-3 left-3 bg-[#2D6A4F] text-white text-[11px] font-bold uppercase tracking-wider px-3 py-1 rounded-full shadow-md">
                                    3. {{ __('FINAL RESULT') }}
                                </span>
                            </div>
                            <h3 class="font-fraunces text-xl font-bold text-[#6B2203]">{{ __('Final Result') }}</h3>
                            <p class="text-xs text-[#523A2C] leading-relaxed">
                                {{ __($afterImg->caption ?? 'Final Result Caption') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Conversion Card -->
            <div class="bg-[#F5F1E8] border border-[#E8DEC8] p-8 sm:p-10 rounded-[28px] flex flex-col sm:flex-row items-center justify-between gap-6">
                <div>
                    <h3 class="font-fraunces text-2xl font-bold text-[#6B2203]">{{ __('Interested in Similar Results?') }}</h3>
                    <p class="text-sm text-[#654A39] mt-1">{{ __('Consult your property directly with our management team.') }}</p>
                </div>
                <a href="{{ $globalContact->whatsapp_url ?? '#' }}" target="_blank" rel="noopener noreferrer" class="btn-primary shrink-0">
                    <span>{{ __('REQUEST A QUOTE (WHATSAPP)') }}</span>
                    <span>→</span>
                </a>
            </div>
        </div>
    </section>
@endsection
