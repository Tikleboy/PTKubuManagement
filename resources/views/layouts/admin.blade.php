<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') | PT. KUBU MANAGEMENT BALI CMS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Albert+Sans:wght@400;500;600;700&family=Fraunces:wght@600;700&display=swap" rel="stylesheet">
    <!-- Favicon & Title URL Icons -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Albert Sans', sans-serif; }
        .font-fraunces { font-family: 'Fraunces', serif; }
    </style>
</head>
<body class="bg-[#F5F1E8] text-[#3B2114] min-h-screen flex flex-col">

    <!-- Top Admin Bar -->
    <header class="bg-[#6B2203] text-white px-6 py-3.5 border-b border-[#965E03]/40 flex items-center justify-between shadow-sm">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.dashboard') }}" class="inline-block bg-white px-2.5 py-1.5 rounded-[10px] shadow-sm">
                <img src="{{ asset('images/kubu/logo.png') }}" 
                     alt="Kubu Management Logo" 
                     width="72"
                     height="30"
                     class="h-6 w-auto object-contain" 
                     style="height: 24px; max-height: 26px; width: auto; max-width: 90px; object-fit: contain; display: block;">
            </a>
            <div>
                <a href="{{ route('admin.dashboard') }}" class="font-fraunces font-bold text-base tracking-wide text-white hover:text-[#D4A574]">
                    KUBU MANAGEMENT BALI <span class="text-xs font-normal text-[#D4A574] ml-1">CMS Admin</span>
                </a>
            </div>
        </div>

        <div class="flex items-center gap-3 text-xs">
            <a href="{{ route('home') }}" target="_blank" class="text-[#D4A574] hover:text-white flex items-center gap-1 transition-colors">
                <span>Lihat Website</span> ↗
            </a>
            <span class="text-white/30">|</span>
            <a href="{{ route('admin.profile.edit') }}" title="Buka Profil Saya" class="flex items-center gap-2 px-2.5 py-1 rounded-[8px] bg-white/10 hover:bg-white/20 text-white transition-colors {{ request()->routeIs('admin.profile.*') ? 'ring-1 ring-[#D4A574]' : '' }}">
                <span class="w-5 h-5 rounded-full bg-[#D4A574] text-[#6B2203] flex items-center justify-center font-bold text-[10px]">
                    {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                </span>
                <span class="font-medium text-xs">{{ Auth::user()->name ?? 'Administrator' }}</span>
                <span class="text-[10px] px-1.5 py-0.5 bg-[#D4A574]/20 text-[#D4A574] rounded font-semibold">{{ Auth::user()->role_short_label ?? 'Admin' }}</span>
            </a>
            <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="bg-[#965E03] hover:bg-[#825203] px-3 py-1.5 rounded-[8px] text-white font-medium transition-colors">
                    Logout
                </button>
            </form>
        </div>
    </header>

    <div class="flex-1 flex flex-col md:flex-row">
        <!-- Sidebar Navigation -->
        <aside class="w-full md:w-64 bg-white border-r border-[#E8DEC8] p-5 shrink-0 space-y-6">
            <div class="space-y-1">
                <span class="label-caps text-[#965E03] text-[10px] font-bold px-3">MENU UTAMA</span>
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-[10px] text-xs font-semibold {{ request()->routeIs('admin.dashboard') ? 'bg-[#965E03] text-white' : 'text-[#4A2D1B] hover:bg-[#FAF7F2]' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    <span>Dashboard</span>
                </a>

                @if(Auth::user()->canManageSettings())
                    <a href="{{ route('admin.company.edit') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-[10px] text-xs font-semibold {{ request()->routeIs('admin.company.*') ? 'bg-[#965E03] text-white' : 'text-[#4A2D1B] hover:bg-[#FAF7F2]' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        <span>Company Profile</span>
                    </a>
                @endif

                @if(Auth::user()->canManageContent())
                    <a href="{{ route('admin.services.index') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-[10px] text-xs font-semibold {{ request()->routeIs('admin.services.*') ? 'bg-[#965E03] text-white' : 'text-[#4A2D1B] hover:bg-[#FAF7F2]' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        <span>Kelola Layanan (Services)</span>
                    </a>
                    <a href="{{ route('admin.projects.index') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-[10px] text-xs font-semibold {{ request()->routeIs('admin.projects.*') ? 'bg-[#965E03] text-white' : 'text-[#4A2D1B] hover:bg-[#FAF7F2]' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span>Kelola Project (Portfolio)</span>
                    </a>
                    <a href="{{ route('admin.gallery.index') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-[10px] text-xs font-semibold {{ request()->routeIs('admin.gallery.*') ? 'bg-[#965E03] text-white' : 'text-[#4A2D1B] hover:bg-[#FAF7F2]' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span>Kelola Galeri Foto</span>
                    </a>
                @endif

                @if(Auth::user()->canManageCareers())
                    <a href="{{ route('admin.careers.index') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-[10px] text-xs font-semibold {{ request()->routeIs('admin.careers.*') ? 'bg-[#965E03] text-white' : 'text-[#4A2D1B] hover:bg-[#FAF7F2]' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <span>Kelola Karir / Loker</span>
                    </a>
                @endif
            </div>

            @if(Auth::user()->canManageUsers() || Auth::user()->canManageInquiries() || Auth::user()->canManageSettings())
                <div class="space-y-1 pt-4 border-t border-[#E8DEC8]">
                    <span class="label-caps text-[#965E03] text-[10px] font-bold px-3">AKSES & KOMUNIKASI</span>

                    @if(Auth::user()->canManageUsers())
                        <a href="{{ route('admin.users.index') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-[10px] text-xs font-semibold {{ request()->routeIs('admin.users.*') ? 'bg-[#965E03] text-white' : 'text-[#4A2D1B] hover:bg-[#FAF7F2]' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                            <span>Kelola Akun Admin</span>
                        </a>
                    @endif

                    @if(Auth::user()->canManageInquiries())
                        <a href="{{ route('admin.inquiries.index') }}" class="flex items-center justify-between px-3 py-2 rounded-[10px] text-xs font-semibold {{ request()->routeIs('admin.inquiries.*') ? 'bg-[#965E03] text-white' : 'text-[#4A2D1B] hover:bg-[#FAF7F2]' }}">
                            <div class="flex items-center gap-2.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                                <span>Pesan Masuk (Inquiries)</span>
                            </div>
                            @php
                                $inboxBadgeCount = \App\Models\Inquiry::where('status', 'new')->count();
                            @endphp
                            @if($inboxBadgeCount > 0)
                                <span class="px-1.5 py-0.5 text-[10px] font-bold rounded-full {{ request()->routeIs('admin.inquiries.*') ? 'bg-white text-[#965E03]' : 'bg-[#965E03] text-white' }}">
                                    {{ $inboxBadgeCount }}
                                </span>
                            @endif
                        </a>
                    @endif

                    @if(Auth::user()->canManageSettings())
                        <a href="{{ route('admin.contact.edit') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-[10px] text-xs font-semibold {{ request()->routeIs('admin.contact.*') ? 'bg-[#965E03] text-white' : 'text-[#4A2D1B] hover:bg-[#FAF7F2]' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                            <span>Kontak & WhatsApp</span>
                        </a>
                    @endif
                </div>
            @endif

            <div class="space-y-1 pt-4 border-t border-[#E8DEC8]">
                <span class="label-caps text-[#965E03] text-[10px] font-bold px-3">AKUN SAYA</span>
                <a href="{{ route('admin.profile.edit') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-[10px] text-xs font-semibold {{ request()->routeIs('admin.profile.*') ? 'bg-[#965E03] text-white' : 'text-[#4A2D1B] hover:bg-[#FAF7F2]' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    <span>Profil & Kata Sandi</span>
                </a>
            </div>
        </aside>

        <!-- Main Workspace -->
        <main class="flex-1 p-6 md:p-10">
            @if(session('success'))
                <div class="mb-6 p-4 rounded-[12px] bg-[#2D6A4F]/10 border border-[#2D6A4F]/30 text-[#2D6A4F] text-xs font-semibold flex items-center gap-2">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 p-4 rounded-[12px] bg-red-50 border border-red-200 text-red-700 text-xs space-y-1">
                    <p class="font-bold">Perhatian:</p>
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>
