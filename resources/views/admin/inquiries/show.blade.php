@extends('layouts.admin')

@section('title', 'Detail Pesan Masuk')

@section('content')
    <div class="max-w-2xl space-y-6">
        <div>
            <a href="{{ route('admin.inquiries.index') }}" class="text-xs text-[#965E03] hover:underline mb-1 inline-block">
                ← Kembali ke Daftar Pesan
            </a>
            <h1 class="font-fraunces text-2xl font-bold text-[#6B2203]">
                Detail Pesan dari: {{ $inquiry->name }}
            </h1>
        </div>

        <div class="bg-white p-6 sm:p-8 rounded-[20px] border border-[#E8DEC8] shadow-warm-sm space-y-5">
            <div class="grid grid-cols-2 gap-4 pb-4 border-b border-[#E8DEC8] text-xs">
                <div>
                    <span class="text-[#7A5B49] block">Tanggal Dikirim:</span>
                    <span class="font-bold text-[#43281C]">{{ $inquiry->created_at->format('d F Y, H:i') }} WITA</span>
                </div>
                <div>
                    <span class="text-[#7A5B49] block">Status:</span>
                    <span class="font-bold text-[#965E03] uppercase">{{ $inquiry->status }}</span>
                </div>
            </div>

            <div class="space-y-3 text-xs">
                <div>
                    <span class="text-[#7A5B49] block">Nama Lengkap:</span>
                    <span class="text-sm font-bold text-[#43281C]">{{ $inquiry->name }}</span>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <span class="text-[#7A5B49] block">Nomor Telepon / WhatsApp:</span>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $inquiry->phone) }}" target="_blank" class="font-bold text-[#965E03] hover:underline">
                            {{ $inquiry->phone ?? '-' }} ↗ (Chat WA)
                        </a>
                    </div>
                    <div>
                        <span class="text-[#7A5B49] block">Email:</span>
                        <a href="mailto:{{ $inquiry->email }}" class="font-bold text-[#965E03] hover:underline">
                            {{ $inquiry->email ?? '-' }}
                        </a>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 pt-2">
                    <div>
                        <span class="text-[#7A5B49] block">Jenis Properti:</span>
                        <span class="font-medium text-[#43281C]">{{ $inquiry->property_type ?? '-' }}</span>
                    </div>
                    <div>
                        <span class="text-[#7A5B49] block">Layanan Diminta:</span>
                        <span class="font-medium text-[#43281C]">{{ $inquiry->service_needed ?? '-' }}</span>
                    </div>
                </div>

                <div class="pt-3">
                    <span class="text-[#7A5B49] block mb-1">Isi Pesan:</span>
                    <div class="p-4 rounded-[12px] bg-[#FAF7F2] border border-[#E8DEC8] text-[#3B2114] whitespace-pre-wrap leading-relaxed text-xs">
                        {{ $inquiry->message }}
                    </div>
                </div>
            </div>

            <!-- Update Status Form -->
            <div class="pt-4 border-t border-[#E8DEC8] flex flex-col sm:flex-row items-center justify-between gap-4">
                <form action="{{ route('admin.inquiries.status', $inquiry->id) }}" method="POST" class="flex items-center gap-2">
                    @csrf
                    @method('PUT')
                    <label class="text-xs font-bold text-[#6B2203]">Ubah Status:</label>
                    <select name="status" class="px-2 py-1.5 rounded-[8px] bg-[#FAF7F2] border border-[#E8DEC8] text-xs">
                        <option value="new" {{ $inquiry->status == 'new' ? 'selected' : '' }}>New</option>
                        <option value="contacted" {{ $inquiry->status == 'contacted' ? 'selected' : '' }}>Contacted</option>
                        <option value="resolved" {{ $inquiry->status == 'resolved' ? 'selected' : '' }}>Resolved</option>
                    </select>
                    <button type="submit" class="bg-[#965E03] text-white px-3 py-1.5 rounded-[8px] text-xs font-semibold">
                        Simpan
                    </button>
                </form>

                <form action="{{ route('admin.inquiries.destroy', $inquiry->id) }}" method="POST" class="confirm-delete-form" data-title="Hapus Pesan Masuk?" data-message="Apakah kamu yakin ingin menghapus pesan dari &quot;{{ $inquiry->name }}&quot;? Tindakan ini tidak dapat dibatalkan.">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-xs text-red-600 font-semibold hover:underline">
                        Hapus Pesan Ini
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
