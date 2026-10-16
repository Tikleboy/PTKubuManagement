@extends('layouts.admin')

@section('title', 'Tambah Project Baru')

@section('content')
    <div class="max-w-3xl space-y-6">
        <div>
            <a href="{{ route('admin.projects.index') }}" class="text-xs text-[#965E03] hover:underline mb-1 inline-block">
                ← Kembali ke Daftar Project
            </a>
            <h1 class="font-fraunces text-2xl font-bold text-[#6B2203]">
                Tambah Project Portfolio Baru
            </h1>
        </div>

        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 sm:p-8 rounded-[20px] border border-[#E8DEC8] shadow-warm-sm space-y-5">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-[#6B2203] uppercase mb-1">Nama Project (Contoh: Villa A)</label>
                    <input type="text" name="title" value="{{ old('title') }}" required placeholder="Contoh: Villa A" class="w-full px-3 py-2.5 rounded-[10px] bg-[#FAF7F2] border border-[#E8DEC8] text-xs">
                </div>
                <div>
                    <label class="block text-xs font-bold text-[#6B2203] uppercase mb-1">Kategori Layanan</label>
                    <select name="category" required class="w-full px-3 py-2.5 rounded-[10px] bg-[#FAF7F2] border border-[#E8DEC8] text-xs">
                        <option value="Landscape Maintenance">Landscape Maintenance</option>
                        <option value="Garden Management">Garden Management</option>
                        <option value="Housekeeping Service">Housekeeping Service</option>
                        <option value="Landscape & Housekeeping">Landscape & Housekeeping</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 items-start">
                <div>
                    <label class="block text-xs font-bold text-[#6B2203] uppercase mb-1">Lokasi di Bali</label>
                    <input type="text" name="location" value="{{ old('location', 'Seminyak, Bali') }}" placeholder="Contoh: Seminyak, Bali" class="w-full px-3 py-2.5 rounded-[10px] bg-[#FAF7F2] border border-[#E8DEC8] text-xs">
                </div>
                <div>
                    <label class="block text-xs font-bold text-[#6B2203] uppercase mb-1">Foto Utama (Cover)</label>
                    <x-image-upload name="main_image" height="h-28" />
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-[#6B2203] uppercase mb-1">Deskripsi Pengerjaan</label>
                <textarea name="description" rows="3" class="w-full px-3 py-2.5 rounded-[10px] bg-[#FAF7F2] border border-[#E8DEC8] text-xs" placeholder="Uraian singkat pekerjaan yang dilakukan...">{{ old('description') }}</textarea>
            </div>

            <!-- Upload Dokumentasi 3 Tahapan: Before -> Process -> Final Result -->
            <div class="pt-4 border-t border-[#E8DEC8] space-y-4">
                <span class="label-caps text-[#965E03] text-xs font-bold block">
                    UNGGAH DOKUMENTASI STORYTELLING (BEFORE → PROCESS → FINAL RESULT)
                </span>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="p-4 rounded-[16px] bg-white border border-[#E8DEC8] space-y-2 shadow-warm-sm">
                        <span class="label-caps text-[#6B2203] font-bold text-[10px] block">1. BEFORE IMAGE</span>
                        <x-image-upload name="before_image" height="h-32" />
                    </div>

                    <div class="p-4 rounded-[16px] bg-white border border-[#E8DEC8] space-y-2 shadow-warm-sm">
                        <span class="label-caps text-[#965E03] font-bold text-[10px] block">2. PROCESS IMAGE</span>
                        <x-image-upload name="process_image" height="h-32" />
                    </div>

                    <div class="p-4 rounded-[16px] bg-white border border-[#E8DEC8] space-y-2 shadow-warm-sm">
                        <span class="label-caps text-green-800 font-bold text-[10px] block">3. FINAL RESULT IMAGE</span>
                        <x-image-upload name="after_image" height="h-32" />
                    </div>
                </div>
            </div>

            <div class="pt-2">
                <label class="flex items-center gap-2 cursor-pointer text-xs">
                    <input type="checkbox" name="is_published" value="1" checked class="rounded text-[#965E03]">
                    <span class="font-bold text-[#6B2203]">Publikasikan di Halaman Portfolio</span>
                </label>
            </div>

            <div class="pt-4 border-t border-[#E8DEC8]">
                <button type="submit" class="btn-primary text-xs px-6 py-2.5">
                    SIMPAN PROJECT
                </button>
            </div>
        </form>
    </div>
@endsection
