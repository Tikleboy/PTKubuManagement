@extends('layouts.admin')

@section('title', 'Kelola Galeri Foto')

@section('content')
    <div class="space-y-8">
        <div>
            <h1 class="font-fraunces text-2xl font-bold text-[#6B2203]">
                Kelola Galeri Foto
            </h1>
            <p class="text-xs text-[#7A5B49] mt-0.5">
                Unggah dan kelola foto dokumentasi landscape dan tata graha.
            </p>
        </div>

        <!-- Upload Form -->
        <div class="bg-white p-6 sm:p-8 rounded-[20px] border border-[#E8DEC8] shadow-warm-sm space-y-4">
            <h2 class="font-fraunces text-lg font-bold text-[#6B2203] border-b border-[#E8DEC8] pb-2">
                Unggah Foto Baru ke Galeri
            </h2>

            <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-[#6B2203] uppercase mb-1">Judul Foto</label>
                        <input type="text" name="title" required placeholder="Contoh: Courtyard Garden" class="w-full px-3 py-2 rounded-[10px] bg-[#FAF7F2] border border-[#E8DEC8] text-xs">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[#6B2203] uppercase mb-1">Divisi Utama</label>
                        <select name="parent_group" required class="w-full px-3 py-2 rounded-[10px] bg-[#FAF7F2] border border-[#E8DEC8] text-xs">
                            <option value="landscape">Landscape</option>
                            <option value="housekeeping">Housekeeping</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[#6B2203] uppercase mb-1">Sub Kategori</label>
                        <select name="gallery_category_id" class="w-full px-3 py-2 rounded-[10px] bg-[#FAF7F2] border border-[#E8DEC8] text-xs">
                            <option value="">Pilih Kategori (Opsional)</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">[{{ strtoupper($cat->parent_group) }}] {{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 items-start">
                    <div>
                        <label class="block text-xs font-bold text-[#6B2203] uppercase mb-1">Keterangan / Caption</label>
                        <input type="text" name="caption" placeholder="Uraian singkat foto..." class="w-full px-3 py-2 rounded-[10px] bg-[#FAF7F2] border border-[#E8DEC8] text-xs">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[#6B2203] uppercase mb-1">Pilih File Gambar</label>
                        <x-image-upload name="image" required height="h-28" />
                    </div>
                </div>

                <div class="pt-2 text-right">
                    <button type="submit" class="btn-primary text-xs px-6 py-2.5">
                        UNGGAH FOTO
                    </button>
                </div>
            </form>
        </div>

        <!-- Image Grid List -->
        <div class="space-y-4">
            <h2 class="font-fraunces text-xl font-bold text-[#6B2203]">
                Daftar Foto Galeri Saat Ini ({{ $images->count() }})
            </h2>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                @forelse($images as $img)
                    <div class="bg-white rounded-[16px] overflow-hidden border border-[#E8DEC8] shadow-warm-sm flex flex-col justify-between">
                        <div class="relative aspect-square overflow-hidden bg-gray-100">
                            <img src="{{ asset($img->image_path) }}" alt="{{ $img->title }}" class="w-full h-full object-cover">
                            <span class="absolute top-2 left-2 bg-[#6B2203]/90 text-white text-[9px] uppercase px-2 py-0.5 rounded font-bold">
                                {{ $img->parent_group }}
                            </span>
                        </div>
                        <div class="p-3 space-y-1">
                            <p class="font-bold text-xs text-[#43281C] truncate">{{ $img->title }}</p>
                            <p class="text-[10px] text-[#7A5B49] truncate">{{ $img->category->name ?? '-' }}</p>
                            <div class="pt-2 border-t border-[#E8DEC8] text-right">
                                <form action="{{ route('admin.gallery.destroy', $img->id) }}" method="POST" class="inline confirm-delete-form" data-title="Hapus Foto Galeri?" data-message="Apakah kamu yakin ingin menghapus foto &quot;{{ $img->title }}&quot; dari galeri? Tindakan ini tidak dapat dibatalkan.">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-[11px] font-bold text-red-600 hover:underline">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-8 text-center bg-white rounded-[16px] border border-[#E8DEC8] text-[#7A5B49] text-xs">
                        Belum ada foto yang diunggah ke galeri.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
