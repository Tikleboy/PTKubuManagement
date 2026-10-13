@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="space-y-8">
        <!-- Welcome & Session Header -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="font-fraunces text-2xl sm:text-3xl font-bold text-[#6B2203]">
                    Selamat Datang, {{ auth()->user()->name }}!
                </h1>
                <p class="text-xs text-[#7A5B49] mt-1">
                    Kelola operasional dan konten website PT. KUBU MANAGEMENT BALI secara terpadu.
                </p>
            </div>
            <div class="flex items-center gap-3 text-xs bg-white px-3.5 py-2 rounded-[12px] border border-[#E8DEC8] shadow-warm-sm self-start sm:self-auto">
                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold border {{ auth()->user()->role_badge_classes }}">
                    {{ auth()->user()->role_label }}
                </span>
                <span class="text-[#7A5B49]">•</span>
                <span class="text-[#7A5B49]">
                    @if(auth()->user()->last_login_at)
                        Login terakhir: <strong class="text-[#43281C]">{{ auth()->user()->last_login_at->format('d M Y, H:i') }} WITA</strong>
                    @else
                        Sesi aktif saat ini
                    @endif
                </span>
            </div>
        </div>

        <!-- Metrics Cards Grid (5 Cards) -->
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4 sm:gap-5">
            <div class="bg-white p-5 rounded-[16px] border border-[#E8DEC8] shadow-warm-sm">
                <span class="label-caps text-[#965E03] text-[10px] font-bold">TOTAL LAYANAN</span>
                <p class="font-fraunces text-3xl font-bold text-[#6B2203] mt-2">{{ $stats['services'] }}</p>
                <a href="{{ route('admin.services.index') }}" class="text-[11px] text-[#965E03] font-semibold hover:underline mt-2 inline-block">Kelola Layanan →</a>
            </div>

            <div class="bg-white p-5 rounded-[16px] border border-[#E8DEC8] shadow-warm-sm">
                <span class="label-caps text-[#965E03] text-[10px] font-bold">PORTOFOLIO</span>
                <p class="font-fraunces text-3xl font-bold text-[#6B2203] mt-2">{{ $stats['projects'] }}</p>
                <a href="{{ route('admin.projects.index') }}" class="text-[11px] text-[#965E03] font-semibold hover:underline mt-2 inline-block">Kelola Portofolio →</a>
            </div>

            <div class="bg-white p-5 rounded-[16px] border border-[#E8DEC8] shadow-warm-sm">
                <span class="label-caps text-[#965E03] text-[10px] font-bold">GALERI FOTO</span>
                <p class="font-fraunces text-3xl font-bold text-[#6B2203] mt-2">{{ $stats['gallery'] }}</p>
                <a href="{{ route('admin.gallery.index') }}" class="text-[11px] text-[#965E03] font-semibold hover:underline mt-2 inline-block">Kelola Galeri →</a>
            </div>

            <div class="bg-white p-5 rounded-[16px] border border-[#E8DEC8] shadow-warm-sm">
                <span class="label-caps text-[#965E03] text-[10px] font-bold">KARIR & LOKER</span>
                <p class="font-fraunces text-3xl font-bold text-[#6B2203] mt-2">{{ $stats['careers'] }}</p>
                <a href="{{ route('admin.careers.index') }}" class="text-[11px] text-[#965E03] font-semibold hover:underline mt-2 inline-block">Kelola Karir →</a>
            </div>

            <div class="bg-white p-5 rounded-[16px] border border-[#E8DEC8] shadow-warm-sm col-span-2 sm:col-span-1">
                <div class="flex items-center justify-between">
                    <span class="label-caps text-[#965E03] text-[10px] font-bold">PESAN MASUK</span>
                    @if($stats['inquiries_new'] > 0)
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-[#965E03] text-white">
                            {{ $stats['inquiries_new'] }} Baru
                        </span>
                    @endif
                </div>
                <p class="font-fraunces text-3xl font-bold text-[#6B2203] mt-2">
                    {{ $stats['inquiries_new'] }} 
                    <span class="text-xs font-normal text-[#7A5B49]">/ {{ $stats['inquiries_total'] }}</span>
                </p>
                <a href="{{ route('admin.inquiries.index') }}" class="text-[11px] text-[#965E03] font-semibold hover:underline mt-2 inline-block">Lihat Pesan →</a>
            </div>
        </div>

        <!-- Two Column Quick Access -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            <!-- Recent Inquiries Section -->
            <div class="lg:col-span-7 bg-white p-6 sm:p-8 rounded-[24px] border border-[#E8DEC8] shadow-warm-sm space-y-4">
                <div class="flex items-center justify-between pb-3 border-b border-[#E8DEC8]">
                    <div class="space-y-0.5">
                        <span class="label-caps text-[#965E03] text-[10px] font-bold">INBOX FORMULIR PENGUNJUNG</span>
                        <h2 class="font-fraunces text-xl font-bold text-[#6B2203]">Pesan Masuk Terbaru</h2>
                    </div>
                    <a href="{{ route('admin.inquiries.index') }}" class="text-xs font-bold text-[#965E03] hover:underline flex items-center gap-1">
                        <span>Semua Pesan</span> →
                    </a>
                </div>

                @if($recentInquiries->count() > 0)
                    <div class="divide-y divide-[#E8DEC8]">
                        @foreach($recentInquiries as $inq)
                            <div class="py-3.5 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                                <div class="space-y-1 min-w-0">
                                    <div class="flex items-center gap-2 flex-wrap">
                                        <span class="font-bold text-sm text-[#43281C]">{{ $inq->name }}</span>
                                        <span class="text-[10px] px-2 py-0.5 rounded-full font-bold {{ $inq->status === 'new' ? 'bg-amber-100 text-amber-900 border border-amber-300' : ($inq->status === 'contacted' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800') }}">
                                            {{ strtoupper($inq->status) }}
                                        </span>
                                        <span class="text-[11px] text-[#7A5B49]">{{ $inq->created_at->format('d M Y, H:i') }} WITA</span>
                                    </div>
                                    <div class="text-xs text-[#7A5B49] flex items-center gap-2">
                                        @if($inq->service_needed)
                                            <span class="font-semibold text-[#965E03]">{{ $inq->service_needed }}</span>
                                            <span>•</span>
                                        @endif
                                        <span>{{ $inq->phone ?? $inq->email ?? '-' }}</span>
                                    </div>
                                    <p class="text-xs text-[#523A2C] line-clamp-1 italic">"{{ $inq->message }}"</p>
                                </div>
                                <div class="shrink-0">
                                    <a href="{{ route('admin.inquiries.show', $inq->id) }}" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-[8px] bg-[#FAF7F2] hover:bg-[#F5F1E8] border border-[#E8DEC8] text-xs font-bold text-[#965E03] transition-colors">
                                        <span>Buka</span> →
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="py-8 text-center text-[#7A5B49] space-y-2">
                        <div class="w-12 h-12 rounded-full bg-[#FAF7F2] text-[#965E03] flex items-center justify-center mx-auto border border-[#E8DEC8]">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                        </div>
                        <p class="text-xs font-semibold">Belum ada pesan masuk dari pengunjung website.</p>
                        <p class="text-[11px] text-[#7A5B49]">Pesan yang dikirim melalui formulir kontak website akan otomatis tampil di sini.</p>
                    </div>
                @endif
            </div>

            <!-- Right Column: Shortcuts & Contact Info -->
            <div class="lg:col-span-5 space-y-6">
                <!-- Fast Shortcuts -->
                <div class="bg-white p-6 rounded-[24px] border border-[#E8DEC8] shadow-warm-sm space-y-3">
                    <h2 class="font-fraunces text-lg font-bold text-[#6B2203]">Aksi Cepat</h2>
                    <div class="space-y-2">
                        @if(auth()->user()->canManageInquiries())
                            <a href="{{ route('admin.inquiries.index') }}" class="flex items-center justify-between p-2.5 rounded-[12px] bg-[#FAF7F2] hover:bg-[#F5F1E8] border border-[#E8DEC8] text-xs font-semibold text-[#6B2203]">
                                <span>📬 Kelola Semua Pesan Masuk</span>
                                <span class="text-[#965E03]">→</span>
                            </a>
                        @endif

                        @if(auth()->user()->canManageSettings())
                            <a href="{{ route('admin.company.edit') }}" class="flex items-center justify-between p-2.5 rounded-[12px] bg-[#FAF7F2] hover:bg-[#F5F1E8] border border-[#E8DEC8] text-xs font-semibold text-[#6B2203]">
                                <span>🏢 Edit Profil Perusahaan & SEO</span>
                                <span class="text-[#965E03]">→</span>
                            </a>
                            <a href="{{ route('admin.contact.edit') }}" class="flex items-center justify-between p-2.5 rounded-[12px] bg-[#FAF7F2] hover:bg-[#F5F1E8] border border-[#E8DEC8] text-xs font-semibold text-[#6B2203]">
                                <span>📱 Ubah Nomor WhatsApp & Kontak</span>
                                <span class="text-[#965E03]">→</span>
                            </a>
                        @endif

                        @if(auth()->user()->canManageContent())
                            <a href="{{ route('admin.projects.create') }}" class="flex items-center justify-between p-2.5 rounded-[12px] bg-[#FAF7F2] hover:bg-[#F5F1E8] border border-[#E8DEC8] text-xs font-semibold text-[#6B2203]">
                                <span>➕ Tambah Project Portofolio Baru</span>
                                <span class="text-[#965E03]">→</span>
                            </a>
                        @endif

                        @if(auth()->user()->canManageCareers())
                            <a href="{{ route('admin.careers.create') }}" class="flex items-center justify-between p-2.5 rounded-[12px] bg-[#FAF7F2] hover:bg-[#F5F1E8] border border-[#E8DEC8] text-xs font-semibold text-[#6B2203]">
                                <span>💼 Tambah Lowongan Karir / Loker</span>
                                <span class="text-[#965E03]">→</span>
                            </a>
                        @endif

                        @if(auth()->user()->canManageUsers())
                            <a href="{{ route('admin.users.index') }}" class="flex items-center justify-between p-2.5 rounded-[12px] bg-[#FAF7F2] hover:bg-[#F5F1E8] border border-[#E8DEC8] text-xs font-semibold text-[#6B2203]">
                                <span>👥 Kelola & Tambah Akun Admin</span>
                                <span class="text-[#965E03]">→</span>
                            </a>
                        @endif

                        <a href="{{ route('admin.profile.edit') }}" class="flex items-center justify-between p-2.5 rounded-[12px] bg-[#FAF7F2] hover:bg-[#F5F1E8] border border-[#E8DEC8] text-xs font-semibold text-[#6B2203]">
                            <span>⚙️ Pengaturan Profil & Kata Sandi</span>
                            <span class="text-[#965E03]">→</span>
                        </a>
                    </div>
                </div>

                <!-- Integration Summary Card -->
                <div class="bg-white p-6 rounded-[24px] border border-[#E8DEC8] shadow-warm-sm space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="label-caps text-[#965E03] text-[10px] font-bold">STATUS INTEGRASI KONTAK</span>
                        <a href="{{ route('admin.contact.edit') }}" class="text-[11px] font-bold text-[#965E03] hover:underline">Edit →</a>
                    </div>
                    <div class="text-xs space-y-2 text-[#43281C]">
                        <div class="flex items-center justify-between pb-2 border-b border-[#E8DEC8]">
                            <span class="text-[#7A5B49]">WhatsApp Resmi:</span>
                            <span class="font-bold">{{ $contact->whatsapp_number ?? '+62 857-3826-1654' }}</span>
                        </div>
                        <div class="flex items-center justify-between pb-2 border-b border-[#E8DEC8]">
                            <span class="text-[#7A5B49]">Email Resmi:</span>
                            <span class="font-bold truncate max-w-[180px]">{{ $contact->email ?? 'info@kubumanagementbali.com' }}</span>
                        </div>
                        <div class="pt-1 flex items-center justify-between text-[11px]">
                            <span class="text-[#2D6A4F] font-semibold flex items-center gap-1">
                                <span class="w-2 h-2 rounded-full bg-[#2D6A4F]"></span>
                                Formulir Website Aktif
                            </span>
                            <a href="{{ route('contact.index') }}" target="_blank" class="text-[#965E03] hover:underline font-semibold">Buka Halaman Kontak ↗</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
