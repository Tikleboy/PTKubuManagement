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

        <!-- Recent Inquiries Section (Full Width & Clean Layout) -->
        <div class="bg-white p-6 sm:p-8 rounded-[24px] border border-[#E8DEC8] shadow-warm-sm space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-[#E8DEC8]">
                <div class="space-y-1">
                    <span class="label-caps text-[#965E03] text-[10px] font-bold">INBOX FORMULIR PENGUNJUNG</span>
                    <h2 class="font-fraunces text-xl sm:text-2xl font-bold text-[#6B2203]">Pesan Masuk Terbaru</h2>
                    <p class="text-xs text-[#7A5B49]">
                        Menampilkan pertanyaan & permintaan layanan terkini dari calon klien melalui website.
                    </p>
                </div>
                <a href="{{ route('admin.inquiries.index') }}" class="btn-primary text-xs px-4 py-2.5 rounded-[12px] flex items-center justify-center gap-2 self-start sm:self-auto shadow-warm-sm">
                    <span>Lihat Semua Pesan ({{ $stats['inquiries_total'] }})</span>
                    <span>→</span>
                </a>
            </div>

            @if($recentInquiries->count() > 0)
                <div class="space-y-3.5">
                    @foreach($recentInquiries as $inq)
                        <div class="p-4 sm:p-5 rounded-[16px] bg-[#FAF7F2]/60 hover:bg-[#FAF7F2] border border-[#E8DEC8] transition-colors flex flex-col md:flex-row md:items-center justify-between gap-4">
                            <div class="space-y-2 flex-1 min-w-0">
                                <div class="flex items-center gap-2.5 flex-wrap">
                                    <span class="font-bold text-sm sm:text-base text-[#43281C]">{{ $inq->name }}</span>
                                    <span class="text-[10px] px-2.5 py-0.5 rounded-full font-bold border {{ $inq->status === 'new' ? 'bg-amber-100 text-amber-900 border-amber-300' : ($inq->status === 'contacted' ? 'bg-blue-100 text-blue-800 border-blue-200' : 'bg-green-100 text-green-800 border-green-200') }}">
                                        {{ strtoupper($inq->status) }}
                                    </span>
                                    @if($inq->service_needed)
                                        <span class="text-[11px] font-semibold text-[#965E03] bg-white px-2.5 py-0.5 rounded-full border border-[#E8DEC8]">
                                            {{ $inq->service_needed }}
                                        </span>
                                    @endif
                                    <span class="text-[11px] text-[#7A5B49] ml-auto md:ml-0">{{ $inq->created_at->format('d M Y, H:i') }} WITA</span>
                                </div>

                                <div class="flex items-center gap-4 text-xs text-[#7A5B49] flex-wrap">
                                    @if($inq->phone)
                                        <span class="inline-flex items-center gap-1.5 font-medium">
                                            <svg class="w-3.5 h-3.5 text-[#965E03]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                            {{ $inq->phone }}
                                        </span>
                                    @endif
                                    @if($inq->email)
                                        <span class="inline-flex items-center gap-1.5 font-medium">
                                            <svg class="w-3.5 h-3.5 text-[#965E03]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                            {{ $inq->email }}
                                        </span>
                                    @endif
                                </div>

                                <p class="text-xs sm:text-sm text-[#523A2C] line-clamp-2 italic bg-white p-3 rounded-[12px] border border-[#E8DEC8]/80 mt-1">
                                    "{{ $inq->message }}"
                                </p>
                            </div>

                            <div class="shrink-0 flex items-center md:self-center">
                                <a href="{{ route('admin.inquiries.show', $inq->id) }}" class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-[12px] bg-white hover:bg-[#FAF7F2] border border-[#E8DEC8] text-xs font-bold text-[#965E03] shadow-sm hover:border-[#965E03] transition-all">
                                    <span>Buka Detail Pesan</span>
                                    <span>→</span>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="py-14 text-center text-[#7A5B49] space-y-3">
                    <div class="w-14 h-14 rounded-full bg-[#FAF7F2] text-[#965E03] flex items-center justify-center mx-auto border border-[#E8DEC8]">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                    </div>
                    <p class="text-sm font-semibold text-[#43281C]">Belum ada pesan masuk dari pengunjung website</p>
                    <p class="text-xs text-[#7A5B49] max-w-sm mx-auto">Setiap pertanyaan atau pesanan layanan yang dikirim melalui formulir website akan otomatis tampil di sini.</p>
                </div>
            @endif
        </div>
    </div>
@endsection
