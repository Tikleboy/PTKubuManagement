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

    <!-- Global Custom Centered Confirmation Modal (Matched to UI Design) -->
    <div id="confirmDeleteModal" 
         class="fixed inset-0 z-[100] flex items-center justify-center p-4 transition-all duration-200 opacity-0 pointer-events-none invisible"
         role="dialog" 
         aria-modal="true" 
         aria-labelledby="confirmDeleteTitle" 
         aria-describedby="confirmDeleteMessage">
        
        <!-- Backdrop with Blur -->
        <div id="confirmDeleteBackdrop" class="fixed inset-0 bg-black/45 backdrop-blur-sm transition-opacity duration-200"></div>

        <!-- Modal Dialog Card (Centered in viewport) -->
        <div id="confirmDeleteCard" class="relative bg-white rounded-[24px] p-6 sm:p-8 max-w-[420px] w-full shadow-2xl transition-all duration-200 transform scale-95 z-10 text-center">
            
            <!-- Close 'X' Button -->
            <button type="button" 
                    id="confirmDeleteCloseBtn" 
                    class="absolute top-5 right-5 text-gray-400 hover:text-[#43281C] p-1.5 rounded-full hover:bg-[#FAF7F2] transition-colors focus:outline-none"
                    aria-label="Tutup modal">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <!-- Trash Icon in Warm Circle Badge -->
            <div class="w-20 h-20 rounded-full bg-[#FAF4ED] flex items-center justify-center mx-auto mb-5">
                <svg class="w-9 h-9 text-[#8C5E3C]" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M7 4V2.5C7 2.22386 7.22386 2 7.5 2H16.5C16.7761 2 17 2.22386 17 2.5V4H21.5C21.7761 4 22 4.22386 22 4.5V5.5C22 5.77614 21.7761 6 21.5 6H20.5V20.5C20.5 21.3284 19.8284 22 19 22H5C4.17157 22 3.5 21.3284 3.5 20.5V6H2.5C2.22386 6 2 5.77614 2 5.5V4.5C2 4.22386 2.22386 4 2.5 4H7ZM8.5 3.5V4H15.5V3.5H8.5ZM5.5 6V20.5H18.5V6H5.5ZM8.5 8.5C8.77614 8.5 9 8.72386 9 9V17.5C9 17.7761 8.77614 18 8.5 18C8.22386 18 8 17.7761 8 17.5V9C8 8.72386 8.22386 8.5 8.5 8.5ZM12 8.5C12.2761 8.5 12.5 8.72386 12.5 9V17.5C12.5 17.7761 12.2761 18 12 18C11.7239 18 11.5 17.7761 11.5 17.5V9C11.5 8.72386 11.7239 8.5 12 8.5ZM15.5 8.5C15.7761 8.5 16 8.72386 16 9V17.5C16 17.7761 15.7761 18 15.5 18C15.2239 18 15 17.7761 15 17.5V9C15 8.72386 15.2239 8.5 15.5 8.5Z"/>
                </svg>
            </div>

            <!-- Title & Message -->
            <h3 id="confirmDeleteTitle" class="font-bold text-xl sm:text-2xl text-[#2A1810] mb-2 tracking-tight">
                Hapus Project?
            </h3>
            <p id="confirmDeleteMessage" class="text-xs sm:text-sm text-[#7A5B49] leading-relaxed max-w-[320px] mx-auto mb-7">
                Apakah kamu yakin ingin menghapus project ini? Tindakan ini tidak dapat dibatalkan.
            </p>

            <!-- Action Buttons: Batal & Ya, Hapus -->
            <div class="grid grid-cols-2 gap-3.5">
                <button type="button" 
                        id="confirmDeleteCancelBtn" 
                        class="w-full py-2.5 sm:py-3 px-4 rounded-[14px] border border-[#E8DEC8] hover:bg-[#FAF7F2] text-[#43281C] font-semibold text-xs sm:text-sm transition-colors focus:outline-none focus:ring-2 focus:ring-[#965E03]/20">
                    Batal
                </button>
                <button type="button" 
                        id="confirmDeleteSubmitBtn" 
                        class="w-full py-2.5 sm:py-3 px-4 rounded-[14px] bg-[#8C5E3C] hover:bg-[#764C2E] text-white font-semibold text-xs sm:text-sm shadow-sm transition-colors focus:outline-none focus:ring-2 focus:ring-[#8C5E3C]/40">
                    Ya, Hapus
                </button>
            </div>
        </div>
    </div>

    <!-- Scripts: Image Preview & Global Confirmation Modal Handlers -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // 1. Dynamic File Upload Preview
            document.addEventListener('change', function (e) {
                if (e.target && e.target.classList.contains('file-upload-input')) {
                    const input = e.target;
                    const container = input.closest('.image-upload-box');
                    if (!container) return;

                    const placeholder = container.querySelector('.placeholder-icon');
                    const previewContainer = container.querySelector('.preview-container');
                    const previewImage = container.querySelector('.preview-image');

                    if (input.files && input.files[0]) {
                        const file = input.files[0];
                        if (file.type.startsWith('image/')) {
                            const reader = new FileReader();
                            reader.onload = function (evt) {
                                if (previewImage) {
                                    previewImage.src = evt.target.result;
                                }
                                if (placeholder) {
                                    placeholder.classList.add('hidden');
                                }
                                if (previewContainer) {
                                    previewContainer.classList.remove('hidden');
                                }
                            };
                            reader.readAsDataURL(file);
                        }
                    }
                }
            });

            // 2. Custom Centered Confirmation Modal Controller
            let pendingFormToSubmit = null;
            const modal = document.getElementById('confirmDeleteModal');
            const card = document.getElementById('confirmDeleteCard');
            const titleEl = document.getElementById('confirmDeleteTitle');
            const msgEl = document.getElementById('confirmDeleteMessage');

            function openConfirmModal(form) {
                pendingFormToSubmit = form;
                const title = form.getAttribute('data-title') || 'Hapus Data?';
                const message = form.getAttribute('data-message') || 'Apakah kamu yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.';

                if (titleEl) titleEl.textContent = title;
                if (msgEl) msgEl.textContent = message;

                if (modal && card) {
                    modal.classList.remove('opacity-0', 'pointer-events-none', 'invisible');
                    modal.classList.add('opacity-100');
                    card.classList.remove('scale-95');
                    card.classList.add('scale-100');
                    document.body.classList.add('overflow-hidden');
                }
            }

            function closeConfirmModal() {
                if (modal && card) {
                    modal.classList.remove('opacity-100');
                    modal.classList.add('opacity-0', 'pointer-events-none', 'invisible');
                    card.classList.remove('scale-100');
                    card.classList.add('scale-95');
                    document.body.classList.remove('overflow-hidden');
                }
                pendingFormToSubmit = null;
            }

            // Intercept form submissions with .confirm-delete-form
            document.addEventListener('submit', function (e) {
                const form = e.target;
                if (form && form.classList.contains('confirm-delete-form')) {
                    e.preventDefault();
                    openConfirmModal(form);
                }
            });

            // Event Listeners for Modal Actions
            document.getElementById('confirmDeleteCancelBtn')?.addEventListener('click', closeConfirmModal);
            document.getElementById('confirmDeleteCloseBtn')?.addEventListener('click', closeConfirmModal);
            document.getElementById('confirmDeleteBackdrop')?.addEventListener('click', closeConfirmModal);

            document.getElementById('confirmDeleteSubmitBtn')?.addEventListener('click', function () {
                if (pendingFormToSubmit) {
                    const form = pendingFormToSubmit;
                    pendingFormToSubmit = null;
                    closeConfirmModal();
                    form.submit();
                }
            });

            // Escape key handler
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape' && modal && !modal.classList.contains('invisible')) {
                    closeConfirmModal();
                }
            });
        });
    </script>
</body>
</html>
