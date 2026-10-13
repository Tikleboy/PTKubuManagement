@extends('layouts.app')

@section('title', __($service->title) . ' | PT. KUBU MANAGEMENT BALI')
@section('meta_description', __($service->description) ?? 'PT. KUBU MANAGEMENT BALI')

@section('content')
    <section class="bg-[#F5F1E8] py-12 lg:py-16 border-b border-[#E8DEC8]">
        <div class="w-full px-4 sm:px-8 lg:px-12 xl:px-16 2xl:px-20">
            <div class="max-w-3xl">
                <a href="{{ $service->category->slug === 'kubu-landscape' ? route('services.landscape') : route('services.housekeeping') }}" class="text-xs font-semibold text-[#965E03] hover:underline mb-2 inline-block">
                    ← {{ __('Back to') }} {{ __($service->category->name) }}
                </a>
                <h1 class="font-fraunces text-4xl sm:text-5xl font-bold text-[#6B2203] tracking-tight">
                    {{ __($service->title) }}
                </h1>
                <p class="text-base text-[#654A39] mt-3">
                    {{ __('Division of') }} {{ __($service->category->name) }} - PT. KUBU MANAGEMENT BALI
                </p>
            </div>
        </div>
    </section>

    <section class="py-16 lg:py-24 bg-[#FAF7F2]">
        <div class="w-full px-4 sm:px-8 lg:px-12 xl:px-16 2xl:px-20">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
                <div class="lg:col-span-7 space-y-6">
                    <div class="rounded-[24px] overflow-hidden border border-[#E8DEC8] shadow-warm-md bg-white">
                        <img src="{{ asset($service->image ?? 'images/kubu/landscape_service.jpg') }}" alt="{{ __($service->title) }}" class="w-full h-[360px] sm:h-[440px] object-cover">
                    </div>

                    <div class="bg-white p-8 rounded-[24px] border border-[#E8DEC8] shadow-warm-sm space-y-4">
                        <h2 class="font-fraunces text-2xl font-bold text-[#6B2203]">{{ __('Service Description') }}</h2>
                        <p class="text-sm sm:text-base text-[#523A2C] leading-relaxed">
                            {{ __($service->description) }}
                        </p>

                        @if(!empty($service->features))
                            <div class="pt-4 border-t border-[#E8DEC8]">
                                <h3 class="label-caps text-[#965E03] text-xs font-bold mb-3">{{ __('Item Scope of Work:') }}</h3>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-sm text-[#43281C]">
                                    @foreach($service->features as $f)
                                        <div class="flex items-center gap-2">
                                            <span class="w-2 h-2 rounded-full bg-[#965E03]"></span>
                                            <span>{{ __($f) }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Sidebar Quote Card -->
                <div class="lg:col-span-5 space-y-6">
                    <div class="bg-white p-8 rounded-[24px] border border-[#E8DEC8] shadow-warm-md space-y-6">
                        <div class="space-y-2">
                            <span class="label-caps text-[#965E03] font-bold">{{ __('FREE CONSULTATION') }}</span>
                            <h3 class="font-fraunces text-2xl font-bold text-[#6B2203]">
                                {{ __('Get a Custom Quote') }}
                            </h3>
                            <p class="text-xs text-[#7A5B49] leading-relaxed">
                                {{ __('Service Detail Quote Subtitle') }}
                            </p>
                        </div>

                        <div class="space-y-3">
                            <a href="{{ $globalContact->whatsapp_url ?? '#' }}" target="_blank" rel="noopener noreferrer" class="btn-primary w-full py-3.5 text-center">
                                <svg class="w-5 h-5 mr-1" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.598 2.664-.698c.969.586 1.77.809 2.796.809 3.179 0 5.767-2.587 5.767-5.766.002-3.18-2.585-5.766-5.767-5.766zm9.969 5.766c0 5.485-4.457 9.943-9.97 9.943-1.637 0-3.21-.401-4.606-1.164l-5.424 1.42 1.447-5.289c-.87-1.464-1.387-3.197-1.387-4.91 0-5.484 4.458-9.942 9.97-9.942 5.514 0 9.97 4.458 9.97 9.942z"/></svg>
                                <span>{{ __('REQUEST A QUOTE (WHATSAPP)') }}</span>
                            </a>
                            <a href="{{ route('contact.index') }}" class="btn-secondary w-full py-3 text-center">
                                <span>{{ __('CONTACT US') }}</span>
                            </a>
                        </div>

                        <div class="pt-4 border-t border-[#E8DEC8] text-xs text-[#7A5B49] space-y-1">
                            <p><strong>{{ __('Hotline:') }}</strong> {{ $globalContact->whatsapp_number ?? '+62 857-3826-1654' }}</p>
                            <p><strong>{{ __('Email:') }}</strong> {{ $globalContact->email ?? 'info@kubumanagementbali.com' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
