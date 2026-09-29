@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="space-y-8">
        <div>
            <h1 class="font-fraunces text-3xl font-bold text-[#6B2203]">
                Dashboard Administrator
            </h1>
            <p class="text-xs text-[#7A5B49] mt-1">
                Kelola konten website PT. KUBU MANAGEMENT BALI secara mandiri dan fleksibel.
            </p>
        </div>

        <!-- Metrics Cards Grid -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-5">
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
                <span class="label-caps text-[#965E03] text-[10px] font-bold">PESAN MASUK (INQUIRY)</span>
                <p class="font-fraunces text-3xl font-bold text-[#6B2203] mt-2">{{ $stats['inquiries_new'] }} <span class="text-xs font-normal text-[#7A5B49]">/ {{ $stats['inquiries_total'] }}</span></p>
                <a href="{{ route('admin.inquiries.index') }}" class="text-[11px] text-[#965E03] font-semibold hover:underline mt-2 inline-block">Lihat Pesan →</a>
            </div>
        </div>

        <!-- Two Column Quick Access -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            <!-- Recent Inquiries -->
            <div class="lg:col-span-7 bg-white p-6 sm:p-8 rounded-[24px] border border-[#E8DEC8] shadow-warm-sm space-y-4">
                <div class="flex items-center justify-between pb-3 border-b border-[#E8DEC8]">
                    <h2 class="font-fraunces text-xl font-bold text-[#6B2203]">Pesan Masuk Terbaru</h2>
                    <a href="{{ route('admin.inquiries.index') }}" class="text-xs font-bold text-[#965E03] hover:underline">Semua Pesan →</a>
                </div>

                @if($recentInquiries->count() > 0)
                    <div class="divide-y divide-[#E8DEC8]">
                        @foreach($recentInquiries as $inq)
                            <div class="py-3 flex items-center justify-between gap-4">
                                <div class="space-y-0.5">
                                    <div class="flex items-center gap-2">
                                        <span class="font-bold text-sm text-[#43281C]">{{ $inq->name }}</span>
                                        <span class="text-[10px] px-2 py-0.5 rounded-full {{ $inq->status === 'new' ? 'bg-[#965E03]/10 text-[#965E03] font-bold' : 'bg-gray-100 text-gray-600' }}">
                                            {{ strtoupper($inq->status) }}
                                        </span>
                                    </div>
                                    <p class="text-xs text-[#7A5B49] truncate max-w-md">{{ $inq->message }}</p>
                                </div>
                                <a href="{{ route('admin.inquiries.show', $inq->id) }}" class="text-xs font-semibold text-[#965E03] hover:underline shrink-0">
                                    Buka →
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-xs text-[#7A5B49] py-4 text-center">Belum ada pesan masuk dari pengunjung website.</p>
                @endif
            </div>

            <!-- Fast Shortcuts -->
            <div class="lg:col-span-5 bg-white p-6 sm:p-8 rounded-[24px] border border-[#E8DEC8] shadow-warm-sm space-y-4">
                <h2 class="font-fraunces text-xl font-bold text-[#6B2203]">Aksi Cepat</h2>
                <div class="space-y-2.5">
                    <a href="{{ route('admin.company.edit') }}" class="block p-3 rounded-[12px] bg-[#FAF7F2] hover:bg-[#F5F1E8] border border-[#E8DEC8] text-xs font-semibold text-[#6B2203]">
                        🏢 Edit Profil Perusahaan, Visi, Misi & SEO
                    </a>
                    <a href="{{ route('admin.contact.edit') }}" class="block p-3 rounded-[12px] bg-[#FAF7F2] hover:bg-[#F5F1E8] border border-[#E8DEC8] text-xs font-semibold text-[#6B2203]">
                        📱 Ubah Nomor WhatsApp & Pesan Default
                    </a>
                    <a href="{{ route('admin.projects.create') }}" class="block p-3 rounded-[12px] bg-[#FAF7F2] hover:bg-[#F5F1E8] border border-[#E8DEC8] text-xs font-semibold text-[#6B2203]">
                        ➕ Tambah Project & Upload Foto Before/After
                    </a>
                    <a href="{{ route('admin.services.create') }}" class="block p-3 rounded-[12px] bg-[#FAF7F2] hover:bg-[#F5F1E8] border border-[#E8DEC8] text-xs font-semibold text-[#6B2203]">
                        ➕ Tambah Layanan Baru
                    </a>
                    <a href="{{ route('admin.careers.create') }}" class="block p-3 rounded-[12px] bg-[#FAF7F2] hover:bg-[#F5F1E8] border border-[#E8DEC8] text-xs font-semibold text-[#6B2203]">
                        💼 Tambah Lowongan Pekerjaan
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
