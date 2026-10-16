@extends('layouts.admin')

@section('title', 'Kelola Layanan')

@section('content')
    <div class="space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="font-fraunces text-2xl font-bold text-[#6B2203]">
                    Kelola Layanan (Services)
                </h1>
                <p class="text-xs text-[#7A5B49] mt-0.5">
                    Daftar sub-layanan di bawah divisi Kubu Landscape dan Kubu Clean.
                </p>
            </div>
            <a href="{{ route('admin.services.create') }}" class="btn-primary text-xs px-4 py-2.5">
                Tambah Layanan Baru
            </a>
        </div>

        <div class="bg-white rounded-[20px] border border-[#E8DEC8] shadow-warm-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-[#FAF7F2] text-[#6B2203] uppercase tracking-wider border-b border-[#E8DEC8]">
                        <tr>
                            <th class="p-4">Foto</th>
                            <th class="p-4">Judul Layanan</th>
                            <th class="p-4">Divisi / Kategori</th>
                            <th class="p-4">Item Lingkup Kerja</th>
                            <th class="p-4">Status</th>
                            <th class="p-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#E8DEC8]">
                        @forelse($services as $s)
                            <tr class="hover:bg-[#FAF7F2]/50">
                                <td class="p-4">
                                    <div class="w-12 h-10 rounded-[6px] overflow-hidden bg-gray-100 border border-[#E8DEC8]">
                                        <img src="{{ asset($s->image ?? 'images/kubu/landscape_service.jpg') }}" alt="" class="w-full h-full object-cover">
                                    </div>
                                </td>
                                <td class="p-4 font-bold text-[#43281C]">
                                    {{ $s->title }}
                                </td>
                                <td class="p-4 text-[#7A5B49]">
                                    {{ $s->category->name ?? '-' }}
                                </td>
                                <td class="p-4 text-[#7A5B49]">
                                    {{ is_array($s->features) ? count($s->features) : 0 }} Poin
                                </td>
                                <td class="p-4">
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold {{ $s->is_published ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-600' }}">
                                        {{ $s->is_published ? 'Aktif' : 'Draft' }}
                                    </span>
                                </td>
                                <td class="p-4 text-right space-x-2">
                                    <a href="{{ route('admin.services.edit', $s->id) }}" class="font-bold text-[#965E03] hover:underline">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.services.destroy', $s->id) }}" method="POST" class="inline confirm-delete-form" data-title="Hapus Layanan?" data-message="Apakah kamu yakin ingin menghapus layanan &quot;{{ $s->title }}&quot;? Tindakan ini tidak dapat dibatalkan.">
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
                                <td colspan="6" class="p-8 text-center text-[#7A5B49]">Belum ada data layanan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
