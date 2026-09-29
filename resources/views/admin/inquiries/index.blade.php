@extends('layouts.admin')

@section('title', 'Pesan Masuk (Inquiries)')

@section('content')
    <div class="space-y-6">
        <div>
            <h1 class="font-fraunces text-2xl font-bold text-[#6B2203]">
                Pesan Masuk Pengunjung (Inquiries)
            </h1>
            <p class="text-xs text-[#7A5B49] mt-0.5">
                Daftar formulir konsultasi dan permintaan informasi dari website.
            </p>
        </div>

        <div class="bg-white rounded-[20px] border border-[#E8DEC8] shadow-warm-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-[#FAF7F2] text-[#6B2203] uppercase tracking-wider border-b border-[#E8DEC8]">
                        <tr>
                            <th class="p-4">Tanggal</th>
                            <th class="p-4">Nama Pengirim</th>
                            <th class="p-4">Kontak (Telp/Email)</th>
                            <th class="p-4">Properti / Layanan</th>
                            <th class="p-4">Status</th>
                            <th class="p-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#E8DEC8]">
                        @forelse($inquiries as $inq)
                            <tr class="hover:bg-[#FAF7F2]/50 {{ $inq->status === 'new' ? 'bg-[#FAF7F2]/30 font-semibold' : '' }}">
                                <td class="p-4 text-[#7A5B49]">
                                    {{ $inq->created_at->format('d/m/Y H:i') }}
                                </td>
                                <td class="p-4 text-[#43281C]">
                                    {{ $inq->name }}
                                </td>
                                <td class="p-4 text-[#523A2C]">
                                    {{ $inq->phone ?? '-' }}<br>
                                    <span class="text-[10px] text-[#7A5B49]">{{ $inq->email ?? '-' }}</span>
                                </td>
                                <td class="p-4 text-[#523A2C]">
                                    {{ $inq->property_type ?? '-' }}<br>
                                    <span class="text-[10px] text-[#965E03]">{{ $inq->service_needed ?? '-' }}</span>
                                </td>
                                <td class="p-4">
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold {{ $inq->status === 'new' ? 'bg-amber-100 text-amber-900' : ($inq->status === 'contacted' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800') }}">
                                        {{ ucfirst($inq->status) }}
                                    </span>
                                </td>
                                <td class="p-4 text-right space-x-2">
                                    <a href="{{ route('admin.inquiries.show', $inq->id) }}" class="font-bold text-[#965E03] hover:underline">
                                        Lihat Pesan
                                    </a>
                                    <form action="{{ route('admin.inquiries.destroy', $inq->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus pesan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="font-bold text-red-600 hover:underline">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-8 text-center text-[#7A5B49]">Belum ada pesan masuk.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-4 border-t border-[#E8DEC8]">
                {{ $inquiries->links() }}
            </div>
        </div>
    </div>
@endsection
