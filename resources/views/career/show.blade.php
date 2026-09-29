@extends('layouts.app')

@section('title', $career->position . ' | ' . __('CAREERS') . ' - PT. KUBU MANAGEMENT BALI')
@section('meta_description', $career->position . ' - PT. KUBU MANAGEMENT BALI')

@section('content')
    <section class="bg-[#F5F1E8] py-12 lg:py-16 border-b border-[#E8DEC8]">
        <div class="w-full px-4 sm:px-8 lg:px-12 xl:px-16 2xl:px-20">
            <div class="max-w-3xl">
                <a href="{{ route('career.index') }}" class="text-xs font-semibold text-[#965E03] hover:underline mb-2 inline-block">
                    ← {{ __('Back to All Openings') }}
                </a>
                <div class="flex items-center gap-2 mb-2">
                    <span class="bg-[#965E03] text-white text-[11px] font-semibold px-2.5 py-0.5 rounded-full uppercase">
                        {{ __($career->employment_type) }}
                    </span>
                    <span class="text-xs text-[#7A5B49] font-medium">• {{ $career->location }}</span>
                </div>
                <h1 class="font-fraunces text-4xl sm:text-5xl font-bold text-[#6B2203] tracking-tight">
                    {{ $career->position }}
                </h1>
                <p class="text-base text-[#654A39] mt-3">
                    {{ __('Join the professional team of PT. KUBU MANAGEMENT BALI') }}
                </p>
            </div>
        </div>
    </section>

    <section class="py-16 lg:py-24 bg-[#FAF7F2]">
        <div class="w-full px-4 sm:px-8 lg:px-12 xl:px-16 2xl:px-20 space-y-8">
            <div class="bg-white rounded-[24px] p-8 sm:p-10 border border-[#E8DEC8] shadow-warm-sm space-y-6">
                <div>
                    <h2 class="font-fraunces text-xl font-bold text-[#6B2203] mb-2">{{ __('Position Description') }}</h2>
                    <p class="text-sm text-[#523A2C] leading-relaxed whitespace-pre-line">{{ $career->description }}</p>
                </div>

                <div class="pt-4 border-t border-[#E8DEC8]">
                    <h2 class="font-fraunces text-xl font-bold text-[#6B2203] mb-3">{{ __('Qualifications & Requirements:') }}</h2>
                    <div class="bg-[#FAF7F2] p-5 rounded-[16px] border border-[#E8DEC8] text-xs text-[#43281C] whitespace-pre-line leading-relaxed">
                        {{ $career->requirements }}
                    </div>
                </div>

                @if($career->application_info)
                    <div class="pt-4 border-t border-[#E8DEC8]">
                        <h2 class="font-fraunces text-lg font-bold text-[#6B2203] mb-2">{{ __('Registration Information') }}</h2>
                        <p class="text-xs text-[#7A5B49] leading-relaxed">{{ $career->application_info }}</p>
                    </div>
                @endif

                <div class="pt-6 border-t border-[#E8DEC8] flex flex-col sm:flex-row items-center justify-between gap-4">
                    <span class="text-xs text-[#7A5B49]">{{ __('Location:') }} <strong>{{ $career->location }}</strong></span>
                    <a href="mailto:{{ $globalContact->email ?? 'info@kubumanagementbali.com' }}?subject=Application%20for%20{{ urlencode($career->position) }}" class="btn-primary text-xs px-6 py-3">
                        <span>{{ __('APPLY VIA EMAIL') }}</span>
                        <span>→</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
