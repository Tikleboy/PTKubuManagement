@extends('layouts.app')

@section('title', __('CAREERS') . ' | PT. KUBU MANAGEMENT BALI')
@section('meta_description', __('Career Header Subtitle'))

@section('content')
    <!-- Header -->
    <section class="bg-[#F5F1E8] py-12 lg:py-16 border-b border-[#E8DEC8]">
        <div class="w-full px-4 sm:px-8 lg:px-12 xl:px-16 2xl:px-20">
            <span class="label-caps text-[#965E03] font-bold block mb-2">{{ __('CAREERS & OPPORTUNITIES') }}</span>
            <h1 class="font-fraunces text-4xl sm:text-5xl font-bold text-[#6B2203] tracking-tight">
                {{ __('Careers & Job Opportunities') }}
            </h1>
            <p class="text-base sm:text-lg text-[#654A39] mt-3 max-w-2xl">
                {{ __('Career Header Subtitle') }}
            </p>
        </div>
    </section>

    <!-- Career Listing Section -->
    <section class="py-16 lg:py-24 bg-[#FAF7F2]">
        <div class="w-full px-4 sm:px-8 lg:px-12 xl:px-16 2xl:px-20 space-y-10">
            @if($careers->count() > 0)
                <div class="space-y-6">
                    @foreach($careers as $career)
                        <div class="bg-white rounded-[24px] p-8 border border-[#E8DEC8] shadow-warm-sm hover:shadow-warm-md transition-all space-y-4">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-[#E8DEC8]">
                                <div>
                                    <span class="label-caps text-[#965E03] font-bold">{{ __($career->employment_type) }} • {{ $career->location }}</span>
                                    <h2 class="font-fraunces text-2xl font-bold text-[#6B2203] mt-1">
                                        <a href="{{ route('career.show', $career->slug) }}" class="hover:underline">
                                            {{ $career->position }}
                                        </a>
                                    </h2>
                                </div>
                                <span class="bg-[#965E03]/10 text-[#965E03] text-xs font-semibold px-3 py-1 rounded-full self-start sm:self-auto">
                                    {{ __('Open Position') }}
                                </span>
                            </div>

                            <div class="space-y-3 text-sm text-[#523A2C]">
                                <h3 class="font-bold text-[#6B2203]">{{ __('Job Description:') }}</h3>
                                <p class="leading-relaxed">{{ $career->description }}</p>

                                <h3 class="font-bold text-[#6B2203] pt-2">{{ __('Qualifications & Requirements:') }}</h3>
                                <div class="bg-[#FAF7F2] p-4 rounded-[12px] border border-[#E8DEC8] whitespace-pre-line text-xs">
                                    {{ $career->requirements }}
                                </div>

                                @if($career->application_info)
                                    <div class="pt-2 text-xs text-[#7A5B49]">
                                        <strong>{{ __('Application Instructions:') }}</strong> {{ $career->application_info }}
                                    </div>
                                @endif
                            </div>

                            <div class="pt-4 border-t border-[#E8DEC8] flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                                <span class="text-xs text-[#7A5B49]">{{ __('Location:') }} {{ $career->location }}</span>
                                <a href="mailto:{{ $globalContact->email ?? 'info@kubumanagementbali.com' }}?subject=Application%20for%20{{ urlencode($career->position) }}" class="btn-primary text-xs px-5 py-2.5 w-full sm:w-auto text-center justify-center">
                                    <span>{{ __('APPLY VIA EMAIL') }}</span>
                                    <span>→</span>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Appropriate Empty State (Per prompt instruction: Do not invent fake jobs!) -->
                <div class="bg-white rounded-[32px] p-10 sm:p-16 border border-[#E8DEC8] shadow-warm-sm text-center max-w-2xl mx-auto space-y-6">
                    <div class="w-16 h-16 rounded-full bg-[#FAF7F2] border border-[#E8DEC8] text-[#965E03] flex items-center justify-center mx-auto">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>

                    <div class="space-y-2">
                        <span class="label-caps text-[#965E03] font-bold">{{ __('RECRUITMENT STATUS') }}</span>
                        <h2 class="font-fraunces text-2xl sm:text-3xl font-bold text-[#6B2203]">
                            {{ __('No Open Positions at This Time') }}
                        </h2>
                        <p class="text-sm sm:text-base text-[#654A39] leading-relaxed max-w-lg mx-auto">
                            {{ __('Career Empty State Subtitle') }}
                        </p>
                    </div>

                    <div class="bg-[#FAF7F2] p-6 rounded-[16px] border border-[#E8DEC8] text-xs text-[#7A5B49] max-w-md mx-auto space-y-2">
                        <p class="font-semibold text-[#6B2203]">{{ __('Interested in Joining Our Talent Pool?') }}</p>
                        <p>{{ __('Talent Pool Desc') }}</p>
                        <div class="pt-2">
                            <a href="mailto:{{ $globalContact->email ?? 'info@kubumanagementbali.com' }}?subject=Talent%20Pool%20CV%20Submission%20-%20Kubu%20Management" class="font-bold text-[#965E03] hover:underline">
                                {{ $globalContact->email ?? 'info@kubumanagementbali.com' }}
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
