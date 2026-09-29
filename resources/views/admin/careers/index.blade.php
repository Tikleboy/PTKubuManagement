@extends('layouts.admin')

@section('title', 'Kelola Karir / Loker')

@section('content')
    <div class="space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="font-fraunces text-2xl font-bold text-[#6B2203]">
                    Kelola Lowongan Karir (Loker)
                </h1>
                <p class="text-xs text-[#7A5B49] mt-0.5">
                    Buat dan kelola lowongan pekerjaan yang tampil di website. Jika tidak ada lowongan aktif, sistem otomatis menampilkan empty state yang rapi.
                </p>
            </div>
            <a href="{{ route('admin.careers.create') }}" class="btn-primary text-xs px-4 py-2.5">
                ➕ Tambah Lowongan Baru
            </a>
        </div>

        <div class="bg-white rounded-[20px] border border-[#E8DEC8] shadow-warm-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-[#FAF7F2] text-[#6B2203] uppercase tracking-wider border-b border-[#E8DEC8]">
                        <tr>
                            <th class="p-4">Posisi / Jabatan</th>
                            <th class="p-4">Tipe Pekerjaan</th>
                            <th class="p-4">Lokasi</th>
                            <th class="p-4">Status Publikasi</th>
                            <th class="p-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#E8DEC8]">
                        @forelse($careers as $c)
                            <tr class="hover:bg-[#FAF7F2]/50">
                                <td class="p-4 font-bold text-[#43281C]">
                                    {{ $c->position }}
                                </td>
                                <td class="p-4 text-[#7A5B49]">
                                    {{ $c->employment_type }}
                                </td>
                                <td class="p-4 text-[#7A5B49]">
                                    {{ $c->location }}
                                </td>
                                <td class="p-4">
                                    <form action="{{ route('admin.careers.toggle', $c->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="px-2.5 py-1 rounded-full text-[10px] font-bold cursor-pointer transition-colors {{ $c->is_published ? 'bg-green-100 text-green-800 hover:bg-green-200' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                                            {{ $c->is_published ? '● Tayang (Aktif)' : '○ Non-aktif (Draft)' }}
                                        </button>
                                    </form>
                                </td>
                                <td class="p-4 text-right space-x-2">
                                    <a href="{{ route('admin.careers.edit', $c->id) }}" class="font-bold text-[#965E03] hover:underline">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.careers.destroy', $c->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus lowongan ini?')">
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
                                <td colspan="5" class="p-8 text-center text-[#7A5B49]">
                                    Saat ini belum ada data lowongan pekerjaan. (Halaman publik akan menampilkan status belum ada lowongan dibuka).
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
