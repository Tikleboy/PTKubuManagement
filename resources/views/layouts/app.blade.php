<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', ($globalSettings->meta_title ?? 'PT. KUBU MANAGEMENT BALI | Professional Property Care Services in Bali'))</title>
    <meta name="description" content="@yield('meta_description', ($globalSettings->meta_description ?? 'Professional landscape, garden maintenance, and housekeeping services for villas, hotels, residences, and commercial properties in Bali.'))">
    
    <!-- Favicon & Title URL Icons -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <!-- Open Graph / Facebook / WhatsApp -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('title', ($globalSettings->meta_title ?? 'PT. KUBU MANAGEMENT BALI'))">
    <meta property="og:description" content="@yield('meta_description', ($globalSettings->meta_description ?? 'Professional Property Care Services in Bali'))">
    <meta property="og:image" content="{{ asset('images/kubu/logo.png') }}">
    <meta property="og:url" content="{{ url()->current() }}">

    <!-- Google Fonts: Fraunces (600, 700) & Albert Sans (400, 500, 600, 700) with swap display -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Albert+Sans:wght@400;500;600;700&family=Fraunces:opsz,wght@9..144,600;9..144,700&display=swap" rel="stylesheet">

    @if(request()->routeIs('home') || request()->is('/'))
    <!-- Preload Hero LCP Image -->
    <link rel="preload" as="image" href="{{ asset('images/kubu/hero_bali-mobile.webp') }}" type="image/webp" media="(max-width: 768px)" fetchpriority="high">
    <link rel="preload" as="image" href="{{ asset('images/kubu/hero_bali.webp') }}" type="image/webp" media="(min-width: 769px)" fetchpriority="high">
    @endif

    <!-- Vite Assets (Tailwind CSS) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Fallbacks and Astryx custom palette tokens */
        :root {
            --primary-brown: #965E03;
            --dark-brown: #6B2203;
            --amber-accent: #D4A574;
            --beige-surface: #F5F1E8;
            --cream-card: #FFFFFF;
            --warm-border: #E8DEC8;
        }
        body {
            font-family: 'Albert Sans', sans-serif;
            background-color: #F5F1E8;
            color: #3B2114;
        }
        /* Hide browser scrollbar & prevent horizontal jitter */
        html, body {
            scrollbar-width: none; /* Firefox */
            -ms-overflow-style: none; /* IE and Edge */
            overflow-x: hidden;
        }
        ::-webkit-scrollbar {
            display: none;
            width: 0px;
            height: 0px;
            background: transparent;
        }
    </style>
</head>
<body class="bg-[#F5F1E8] text-[#3B2114] flex flex-col min-h-screen selection:bg-[#D4A574]/30 selection:text-[#6B2203]">

    <!-- Main Navigation Header -->
    <header class="sticky top-0 z-50 bg-[#F5F1E8]/95 backdrop-blur-md border-b border-[#E8DEC8] transition-all duration-200">
        <div class="w-full px-4 sm:px-8 lg:px-12 xl:px-16 2xl:px-20">
            <div class="flex items-center justify-between h-20 gap-3 xl:gap-6">
                <!-- Brand / Logo -->
                <a href="{{ route('home') }}" class="group flex items-center shrink-0 py-1" title="PT. KUBU MANAGEMENT BALI">
                    <picture>
                        <source srcset="{{ asset('images/kubu/logo.webp') }}" type="image/webp">
                        <img src="{{ asset('images/kubu/logo.png') }}" 
                             alt="PT. KUBU MANAGEMENT BALI Logo" 
                             width="114" 
                             height="48"
                             fetchpriority="high"
                             decoding="async"
                             class="h-10 sm:h-11 md:h-12 w-auto max-w-[130px] sm:max-w-[150px] object-contain transition-transform duration-200 group-hover:scale-105 shrink-0"
                             style="height: 44px; max-height: 46px; width: auto; max-width: 140px; object-fit: contain; display: block;">
                    </picture>
                </a>

                <!-- Desktop Nav -->
                <nav class="hidden lg:flex items-center gap-3.5 xl:gap-6 2xl:gap-7">
                    <a href="{{ route('home') }}" 
                       class="text-xs xl:text-[13px] 2xl:text-sm font-semibold tracking-wider whitespace-nowrap py-2 transition-colors relative {{ request()->routeIs('home') ? 'text-[#965E03] font-bold after:absolute after:bottom-0 after:left-0 after:w-full after:h-[2px] after:bg-[#965E03] after:rounded-full' : 'text-[#4A2D1B] hover:text-[#965E03]' }}">
                        {{ __('HOME') }}
                    </a>
                    <a href="{{ route('about') }}" 
                       class="text-xs xl:text-[13px] 2xl:text-sm font-semibold tracking-wider whitespace-nowrap py-2 transition-colors relative {{ request()->routeIs('about') ? 'text-[#965E03] font-bold after:absolute after:bottom-0 after:left-0 after:w-full after:h-[2px] after:bg-[#965E03] after:rounded-full' : 'text-[#4A2D1B] hover:text-[#965E03]' }}">
                        {{ __('ABOUT US') }}
                    </a>

                    <!-- Services Dropdown -->
                    <div class="relative group" x-data="{ open: false }">
                        <a href="{{ route('services.index') }}" 
                           class="text-xs xl:text-[13px] 2xl:text-sm font-semibold tracking-wider whitespace-nowrap py-2 inline-flex items-center gap-1 transition-colors relative {{ request()->routeIs('services.*') ? 'text-[#965E03] font-bold after:absolute after:bottom-0 after:left-0 after:w-full after:h-[2px] after:bg-[#965E03] after:rounded-full' : 'text-[#4A2D1B] hover:text-[#965E03]' }}">
                            <span>{{ __('SERVICES') }}</span>
                            <svg class="w-3.5 h-3.5 text-[#965E03] group-hover:rotate-180 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </a>
                        <div class="absolute left-0 top-full pt-3 w-64 hidden group-hover:block transition-all z-50">
                            <div class="bg-white rounded-[16px] shadow-warm-lg border border-[#E8DEC8] p-3 space-y-1">
                                <a href="{{ route('services.landscape') }}" class="block px-3 py-2.5 rounded-[8px] hover:bg-[#F5F1E8] transition-colors">
                                    <div class="font-semibold text-sm text-[#6B2203]">{{ __('Kubu Landscape & Garden') }}</div>
                                    <div class="text-xs text-[#7A5B49] mt-0.5">{{ __('Tropical garden, maintenance, & irrigation') }}</div>
                                </a>
                                <a href="{{ route('services.housekeeping') }}" class="block px-3 py-2.5 rounded-[8px] hover:bg-[#F5F1E8] transition-colors">
                                    <div class="font-semibold text-sm text-[#6B2203]">{{ __('Kubu Clean / Housekeeping') }}</div>
                                    <div class="text-xs text-[#7A5B49] mt-0.5">{{ __('Villa, hotel, & residence care') }}</div>
                                </a>
                                <div class="pt-2 border-t border-[#E8DEC8]/60 mt-1">
                                    <a href="{{ route('services.index') }}" class="block px-3 py-1.5 text-xs font-semibold text-[#965E03] hover:underline">
                                        {{ __('View All Services') }} →
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('projects.index') }}" 
                       class="text-xs xl:text-[13px] 2xl:text-sm font-semibold tracking-wider whitespace-nowrap py-2 transition-colors relative {{ request()->routeIs('projects.*') ? 'text-[#965E03] font-bold after:absolute after:bottom-0 after:left-0 after:w-full after:h-[2px] after:bg-[#965E03] after:rounded-full' : 'text-[#4A2D1B] hover:text-[#965E03]' }}">
                        {{ __('OUR PROJECTS') }}
                    </a>
                    <a href="{{ route('gallery.index') }}" 
                       class="text-xs xl:text-[13px] 2xl:text-sm font-semibold tracking-wider whitespace-nowrap py-2 transition-colors relative {{ request()->routeIs('gallery.*') ? 'text-[#965E03] font-bold after:absolute after:bottom-0 after:left-0 after:w-full after:h-[2px] after:bg-[#965E03] after:rounded-full' : 'text-[#4A2D1B] hover:text-[#965E03]' }}">
                        {{ __('GALLERY') }}
                    </a>
                    <a href="{{ route('career.index') }}" 
                       class="text-xs xl:text-[13px] 2xl:text-sm font-semibold tracking-wider whitespace-nowrap py-2 transition-colors relative {{ request()->routeIs('career.*') ? 'text-[#965E03] font-bold after:absolute after:bottom-0 after:left-0 after:w-full after:h-[2px] after:bg-[#965E03] after:rounded-full' : 'text-[#4A2D1B] hover:text-[#965E03]' }}">
                        {{ __('CAREERS') }}
                    </a>
                    <a href="{{ route('contact.index') }}" 
                       class="text-xs xl:text-[13px] 2xl:text-sm font-semibold tracking-wider whitespace-nowrap py-2 transition-colors relative {{ request()->routeIs('contact.index') ? 'text-[#965E03] font-bold after:absolute after:bottom-0 after:left-0 after:w-full after:h-[2px] after:bg-[#965E03] after:rounded-full' : 'text-[#4A2D1B] hover:text-[#965E03]' }}">
                        {{ __('CONTACT') }}
                    </a>
                </nav>

                <!-- Action CTA & Language Switcher -->
                <div class="hidden lg:flex items-center gap-2.5 xl:gap-3 shrink-0">
                    <!-- Language Switcher Pill -->
                    <div class="inline-flex items-center bg-[#EAE2D2] border border-[#D9CEB8] p-0.5 rounded-full shadow-inner shrink-0" title="{{ __('Select Language') }}">
                        <a href="{{ route('lang.switch', 'id') }}" 
                           class="px-2.5 py-1 rounded-full text-[11px] font-bold tracking-wider transition-all duration-200 {{ app()->getLocale() === 'id' ? 'bg-[#965E03] text-white shadow-xs' : 'text-[#6B2203]/70 hover:text-[#6B2203]' }}"
                           title="Bahasa Indonesia">
                            ID
                        </a>
                        <a href="{{ route('lang.switch', 'en') }}" 
                           class="px-2.5 py-1 rounded-full text-[11px] font-bold tracking-wider transition-all duration-200 {{ app()->getLocale() === 'en' ? 'bg-[#965E03] text-white shadow-xs' : 'text-[#6B2203]/70 hover:text-[#6B2203]' }}"
                           title="English">
                            EN
                        </a>
                    </div>

                    <!-- Admin CMS Portal Link -->
                    <a href="{{ auth()->check() ? route('admin.dashboard') : route('admin.login') }}" 
                       class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full border border-[#D9CEB8] bg-white/80 hover:bg-white text-[#6B2203] hover:text-[#965E03] text-xs font-semibold transition-all duration-200 shadow-xs shrink-0" 
                       title="{{ auth()->check() ? 'Admin Dashboard' : 'CMS Portal Admin' }}">
                        <svg class="w-3.5 h-3.5 text-[#965E03]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        <span>{{ auth()->check() ? 'Dashboard' : 'Admin' }}</span>
                    </a>

                    <!-- Clean Vertical Divider -->
                    <span class="h-6 w-px bg-[#E8DEC8] hidden lg:block shrink-0"></span>

                    <!-- Request Quote Button -->
                    <a href="{{ $globalContact->whatsapp_url ?? '#' }}" target="_blank" rel="noopener noreferrer" 
                       class="btn-primary !py-2.5 !px-3.5 xl:!px-5 text-xs xl:text-sm font-semibold tracking-wide shrink-0 whitespace-nowrap rounded-[10px] shadow-warm-sm hover:shadow-warm-md">
                        <svg class="w-4 h-4 shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.598 2.664-.698c.969.586 1.77.809 2.796.809 3.179 0 5.767-2.587 5.767-5.766.002-3.18-2.585-5.766-5.767-5.766zm9.969 5.766c0 5.485-4.457 9.943-9.97 9.943-1.637 0-3.21-.401-4.606-1.164l-5.424 1.42 1.447-5.289c-.87-1.464-1.387-3.197-1.387-4.91 0-5.484 4.458-9.942 9.97-9.942 5.514 0 9.97 4.458 9.97 9.942z"/></svg>
                        <span class="whitespace-nowrap">{{ __('REQUEST A QUOTE') }}</span>
                    </a>
                </div>

                <!-- Mobile Menu Hamburger Button & Compact Language Switcher -->
                <div class="lg:hidden flex items-center gap-2">
                    <div class="flex items-center bg-[#EAE2D2] border border-[#D9CEB8] p-0.5 rounded-full text-[11px] font-bold tracking-wider">
                        <a href="{{ route('lang.switch', 'id') }}" 
                           class="px-2 py-0.5 rounded-full transition-all {{ app()->getLocale() === 'id' ? 'bg-[#965E03] text-white shadow-xs' : 'text-[#6B2203]' }}">ID</a>
                        <a href="{{ route('lang.switch', 'en') }}" 
                           class="px-2 py-0.5 rounded-full transition-all {{ app()->getLocale() === 'en' ? 'bg-[#965E03] text-white shadow-xs' : 'text-[#6B2203]' }}">EN</a>
                    </div>
                    <a href="{{ auth()->check() ? route('admin.dashboard') : route('admin.login') }}" 
                       class="p-2.5 rounded-[12px] bg-white border border-[#E8DEC8] text-[#6B2203] hover:bg-[#F5F1E8] focus:outline-none transition-colors" 
                       title="Portal Admin" 
                       aria-label="Portal Admin">
                        <svg class="w-5 h-5 text-[#965E03]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    </a>
                    <button id="mobile-menu-btn" type="button" class="p-2.5 rounded-[12px] bg-white border border-[#E8DEC8] text-[#6B2203] hover:bg-[#F5F1E8] focus:outline-none transition-colors" aria-label="Toggle Navigation">
                        <svg id="hamburger-icon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                        <svg id="close-icon" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Drawer -->
        <div id="mobile-menu" class="hidden lg:hidden border-b border-[#E8DEC8] bg-[#F5F1E8] px-4 pt-2 pb-6 space-y-3">
            <div class="flex items-center justify-between px-3 py-2 border-b border-[#E8DEC8]/80 mb-2">
                <span class="text-xs font-semibold text-[#6B2203] tracking-wide uppercase">{{ __('Select Language') }}</span>
                <div class="flex items-center bg-[#EFE9DC] border border-[#E8DEC8] p-1 rounded-full text-xs font-bold">
                    <a href="{{ route('lang.switch', 'id') }}" class="px-3 py-1 rounded-full transition-all {{ app()->getLocale() === 'id' ? 'bg-[#965E03] text-white shadow-sm' : 'text-[#6B2203]' }}">ID</a>
                    <a href="{{ route('lang.switch', 'en') }}" class="px-3 py-1 rounded-full transition-all {{ app()->getLocale() === 'en' ? 'bg-[#965E03] text-white shadow-sm' : 'text-[#6B2203]' }}">EN</a>
                </div>
            </div>
            <a href="{{ route('home') }}" class="block px-3 py-2 text-base font-semibold text-[#6B2203] rounded-[8px] hover:bg-white">{{ __('HOME') }}</a>
            <a href="{{ route('about') }}" class="block px-3 py-2 text-base font-semibold text-[#6B2203] rounded-[8px] hover:bg-white">{{ __('ABOUT US') }}</a>
            <div class="px-3 py-2">
                <span class="label-caps text-[#965E03] block mb-1">{{ __('SERVICES') }}</span>
                <div class="pl-2 space-y-1 border-l-2 border-[#D4A574]/40 mt-2">
                    <a href="{{ route('services.landscape') }}" class="block py-1.5 text-sm font-medium text-[#4A2D1B] hover:text-[#965E03]">{{ __('Kubu Landscape & Garden') }}</a>
                    <a href="{{ route('services.housekeeping') }}" class="block py-1.5 text-sm font-medium text-[#4A2D1B] hover:text-[#965E03]">{{ __('Kubu Clean / Housekeeping') }}</a>
                    <a href="{{ route('services.index') }}" class="block py-1.5 text-sm font-semibold text-[#965E03]">{{ __('View All Services') }} →</a>
                </div>
            </div>
            <a href="{{ route('projects.index') }}" class="block px-3 py-2 text-base font-semibold text-[#6B2203] rounded-[8px] hover:bg-white">{{ __('OUR PROJECTS') }}</a>
            <a href="{{ route('gallery.index') }}" class="block px-3 py-2 text-base font-semibold text-[#6B2203] rounded-[8px] hover:bg-white">{{ __('GALLERY') }}</a>
            <a href="{{ route('career.index') }}" class="block px-3 py-2 text-base font-semibold text-[#6B2203] rounded-[8px] hover:bg-white">{{ __('CAREERS') }}</a>
            <a href="{{ route('contact.index') }}" class="block px-3 py-2 text-base font-semibold text-[#6B2203] rounded-[8px] hover:bg-white">{{ __('CONTACT') }}</a>

            <div class="pt-2 border-t border-[#E8DEC8]/80">
                <a href="{{ auth()->check() ? route('admin.dashboard') : route('admin.login') }}" class="flex items-center justify-between px-3 py-2.5 text-sm font-semibold text-[#6B2203] rounded-[8px] hover:bg-white transition-colors bg-[#EFE9DC]/50 border border-[#E8DEC8]">
                    <span class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-[#965E03]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        <span>{{ auth()->check() ? 'Admin Dashboard' : 'CMS Portal Admin' }}</span>
                    </span>
                    <span class="text-[10px] font-bold tracking-wider uppercase text-[#965E03] bg-[#EAE2D2] px-2 py-0.5 rounded-full border border-[#D9CEB8]">CMS</span>
                </a>
            </div>

            <div class="pt-2">
                <a href="{{ $globalContact->whatsapp_url ?? '#' }}" target="_blank" rel="noopener noreferrer" class="btn-primary w-full text-center">
                    <svg class="w-4 h-4 inline mr-1.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.598 2.664-.698c.969.586 1.77.809 2.796.809 3.179 0 5.767-2.587 5.767-5.766.002-3.18-2.585-5.766-5.767-5.766zm9.969 5.766c0 5.485-4.457 9.943-9.97 9.943-1.637 0-3.21-.401-4.606-1.164l-5.424 1.42 1.447-5.289c-.87-1.464-1.387-3.197-1.387-4.91 0-5.484 4.458-9.942 9.97-9.942 5.514 0 9.97 4.458 9.97 9.942z"/></svg>
                    <span>{{ __('REQUEST A QUOTE (WHATSAPP)') }}</span>
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Floating WhatsApp conversion widget for Mobile & Desktop -->
    <aside aria-label="WhatsApp Quick Contact" class="fixed bottom-6 right-6 z-40">
        <a href="{{ $globalContact->whatsapp_url ?? '#' }}" target="_blank" rel="noopener noreferrer" class="group flex items-center gap-2.5 bg-[#965E03] hover:bg-[#6B2203] text-white px-4 py-3 rounded-full shadow-warm-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-105" title="{{ __('Contact via Official WhatsApp') }}">
            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.598 2.664-.698c.969.586 1.77.809 2.796.809 3.179 0 5.767-2.587 5.767-5.766.002-3.18-2.585-5.766-5.767-5.766zm9.969 5.766c0 5.485-4.457 9.943-9.97 9.943-1.637 0-3.21-.401-4.606-1.164l-5.424 1.42 1.447-5.289c-.87-1.464-1.387-3.197-1.387-4.91 0-5.484 4.458-9.942 9.97-9.942 5.514 0 9.97 4.458 9.97 9.942z"/></svg>
            <span class="text-xs font-semibold tracking-wider pr-1 hidden sm:inline">{{ __('REQUEST A QUOTE') }}</span>
        </a>
    </aside>

    <!-- Footer in Dark Brown #6B2203 -->
    <footer class="bg-[#6B2203] text-[#F5F1E8] pt-16 pb-10 border-t border-[#965E03]/30">
        <div class="w-full px-4 sm:px-8 lg:px-12 xl:px-16 2xl:px-20">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 lg:gap-12 pb-12 border-b border-[#965E03]/30">
                <!-- Column 1: Company Profile -->
                <div class="space-y-4">
                    <div class="space-y-2.5">
                        <div class="inline-block bg-white px-3 py-1.5 rounded-[12px] shadow-sm">
                            <picture>
                                <source srcset="{{ asset('images/kubu/logo.webp') }}" type="image/webp">
                                <img src="{{ asset('images/kubu/logo.png') }}" 
                                     alt="PT. KUBU MANAGEMENT BALI Logo" 
                                     width="96" 
                                     height="40"
                                     loading="lazy"
                                     decoding="async"
                                     class="h-8 sm:h-9 w-auto object-contain"
                                     style="height: 34px; max-height: 36px; width: auto; max-width: 120px; object-fit: contain; display: block;">
                            </picture>
                        </div>
                        <p class="label-caps text-[#E8DEC8] text-[10px] tracking-wider font-semibold">PT. KUBU MANAGEMENT BALI</p>
                    </div>
                    <p class="text-sm text-[#F5F1E8]/80 leading-relaxed font-light">
                        {{ __('Company Footer Description') }}
                    </p>
                    <div class="pt-2">
                        <a href="{{ $globalContact->whatsapp_url ?? '#' }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 text-xs font-semibold text-[#D4A574] hover:text-white transition-colors">
                            <span>{{ __('Contact via Official WhatsApp') }}</span>
                            <span>→</span>
                        </a>
                    </div>
                </div>

                <!-- Column 2: Quick Links -->
                <div>
                    <h3 class="font-fraunces font-bold text-base text-white mb-4 tracking-wide">{{ __('Quick Navigation') }}</h3>
                    <ul class="space-y-2.5 text-sm text-[#F5F1E8]/80">
                        <li><a href="{{ route('home') }}" class="hover:text-[#D4A574] transition-colors">{{ __('HOME') }}</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-[#D4A574] transition-colors">{{ __('ABOUT US') }}</a></li>
                        <li><a href="{{ route('services.index') }}" class="hover:text-[#D4A574] transition-colors">{{ __('SERVICES') }}</a></li>
                        <li><a href="{{ route('projects.index') }}" class="hover:text-[#D4A574] transition-colors">{{ __('OUR PROJECTS') }}</a></li>
                        <li><a href="{{ route('gallery.index') }}" class="hover:text-[#D4A574] transition-colors">{{ __('GALLERY') }}</a></li>
                        <li><a href="{{ route('career.index') }}" class="hover:text-[#D4A574] transition-colors">{{ __('CAREERS') }}</a></li>
                        <li><a href="{{ route('contact.index') }}" class="hover:text-[#D4A574] transition-colors">{{ __('CONTACT') }}</a></li>
                    </ul>
                </div>

                <!-- Column 3: Services -->
                <div>
                    <h3 class="font-fraunces font-bold text-base text-white mb-4 tracking-wide">{{ __('Our Services') }}</h3>
                    <ul class="space-y-2.5 text-sm text-[#F5F1E8]/90">
                        <li>
                            <a href="{{ route('services.landscape') }}" class="hover:text-[#D4A574] transition-colors font-medium text-white/95">
                                {{ __('Kubu Landscape & Garden') }}
                            </a>
                            <div class="text-xs text-[#F5F1E8]/90 mt-0.5 leading-relaxed">{{ __('Garden Maintenance, Landscape Care, Garden Improvement, Irrigation') }}</div>
                        </li>
                        <li class="pt-2">
                            <a href="{{ route('services.housekeeping') }}" class="hover:text-[#D4A574] transition-colors font-medium text-white/95">
                                {{ __('Kubu Clean / Housekeeping') }}
                            </a>
                            <div class="text-xs text-[#F5F1E8]/90 mt-0.5 leading-relaxed">{{ __('Villa Housekeeping, Hotel Housekeeping, Residential Housekeeping') }}</div>
                        </li>
                    </ul>
                </div>

                <!-- Column 4: Contact Information -->
                <div>
                    <h3 class="font-fraunces font-bold text-base text-white mb-4 tracking-wide">{{ __('Contact Info') }}</h3>
                    <ul class="space-y-3 text-sm text-[#F5F1E8]/85">
                        <li class="flex items-start gap-2.5">
                            <svg class="w-4 h-4 text-[#D4A574] mt-1 shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.598 2.664-.698c.969.586 1.77.809 2.796.809 3.179 0 5.767-2.587 5.767-5.766.002-3.18-2.585-5.766-5.767-5.766zm9.969 5.766c0 5.485-4.457 9.943-9.97 9.943-1.637 0-3.21-.401-4.606-1.164l-5.424 1.42 1.447-5.289c-.87-1.464-1.387-3.197-1.387-4.91 0-5.484 4.458-9.942 9.97-9.942 5.514 0 9.97 4.458 9.97 9.942z"/></svg>
                            <div>
                                <span class="block text-xs font-semibold text-[#E8DEC8]">WhatsApp:</span>
                                <a href="{{ $globalContact->whatsapp_url ?? '#' }}" target="_blank" rel="noopener noreferrer" class="hover:text-white transition-colors">
                                    {{ $globalContact->whatsapp_number ?? '+62 857-3826-1654' }}
                                </a>
                            </div>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <svg class="w-4 h-4 text-[#D4A574] mt-1 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <div>
                                <span class="block text-xs font-semibold text-[#E8DEC8]">Email:</span>
                                <a href="mailto:{{ $globalContact->email ?? 'info@kubumanagementbali.com' }}" class="hover:text-white transition-colors">
                                    {{ $globalContact->email ?? 'info@kubumanagementbali.com' }}
                                </a>
                            </div>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <svg class="w-4 h-4 text-[#D4A574] mt-1 shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.79-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                            <div>
                                <span class="block text-xs font-semibold text-[#E8DEC8]">Instagram:</span>
                                <a href="{{ $globalContact->instagram_url ?? 'https://instagram.com/kubumanagementbali' }}" target="_blank" rel="noopener noreferrer" class="text-white/90 hover:text-white transition-colors">
                                    {{ $globalContact->instagram ?? '@kubumanagementbali' }}
                                </a>
                            </div>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <svg class="w-4 h-4 text-[#D4A574] mt-1 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <div>
                                <span class="block text-xs font-semibold text-[#E8DEC8]">{{ __('Office Address') }}:</span>
                                <span>{{ $globalContact->office_address ?? 'Jalan Pura Banyukuning No.1, Padangsambian, Kecamatan Denpasar Barat, Kota Denpasar, Bali 80119' }}</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Copyright -->
            <div class="pt-8 pb-16 sm:pb-6 flex items-center justify-center text-center text-xs text-[#F5F1E8]/70">
                <p>© {{ date('Y') }} PT. KUBU MANAGEMENT BALI. {{ __('All Rights Reserved') }}.</p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
