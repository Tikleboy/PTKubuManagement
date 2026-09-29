@extends('layouts.admin')

@section('title', 'Kelola Project')

@section('content')
    <div class="space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="font-fraunces text-2xl font-bold text-[#6B2203]">
                    Kelola Project Portfolio
                </h1>
                <p class="text-xs text-[#7A5B49] mt-0.5">
                    Daftar portofolio pengerjaan dengan visual Before → Process → Final Result.
                </p>
            </div>
            <a href="{{ route('admin.projects.create') }}" class="btn-primary text-xs px-4 py-2.5">
                ➕ Tambah Project Baru
            </a>
        </div>

        <div class="bg-white rounded-[20px] border border-[#E8DEC8] shadow-warm-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-[#FAF7F2] text-[#6B2203] uppercase tracking-wider border-b border-[#E8DEC8]">
                        <tr>
                            <th class="p-4">Foto Utama</th>
                            <th class="p-4">Nama Project</th>
                            <th class="p-4">Kategori Layanan</th>
                            <th class="p-4">Lokasi</th>
                            <th class="p-4">Foto Storytelling</th>
                            <th class="p-4">Status</th>
                            <th class="p-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#E8DEC8]">
                        @forelse($projects as $p)
                            <tr class="hover:bg-[#FAF7F2]/50">
                                <td class="p-4">
                                    <div class="w-12 h-10 rounded-[6px] overflow-hidden bg-gray-100 border border-[#E8DEC8]">
                                        <img src="{{ asset($p->main_image ?? 'images/kubu/hero_bali.jpg') }}" alt="" class="w-full h-full object-cover">
                                    </div>
                                </td>
                                <td class="p-4 font-bold text-[#43281C]">
                                    {{ $p->title }}
                                </td>
                                <td class="p-4 text-[#7A5B49]">
                                    {{ $p->category }}
                                </td>
                                <td class="p-4 text-[#7A5B49]">
                                    {{ $p->location ?? 'Bali' }}
                                </td>
                                <td class="p-4 text-[#7A5B49]">
                                    <span class="inline-flex items-center gap-1 font-semibold text-[#965E03]">
                                        {{ $p->images->count() }} Foto (Before/Proc/After)
                                    </span>
                                </td>
                                <td class="p-4">
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold {{ $p->is_published ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-600' }}">
                                        {{ $p->is_published ? 'Aktif' : 'Draft' }}
                                    </span>
                                </td>
                                <td class="p-4 text-right space-x-2">
                                    <a href="{{ route('admin.projects.edit', $p->id) }}" class="font-bold text-[#965E03] hover:underline">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.projects.destroy', $p->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus project ini?')">
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
                                <td colspan="7" class="p-8 text-center text-[#7A5B49]">Belum ada data project.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
