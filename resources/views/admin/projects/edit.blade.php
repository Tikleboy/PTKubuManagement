@extends('layouts.admin')

@section('title', 'Edit Project')

@section('content')
    <div class="max-w-3xl space-y-6">
        <div>
            <a href="{{ route('admin.projects.index') }}" class="text-xs text-[#965E03] hover:underline mb-1 inline-block">
                ← Kembali ke Daftar Project
            </a>
            <h1 class="font-fraunces text-2xl font-bold text-[#6B2203]">
                Edit Project: {{ $project->title }}
            </h1>
        </div>

        <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 sm:p-8 rounded-[20px] border border-[#E8DEC8] shadow-warm-sm space-y-5">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-[#6B2203] uppercase mb-1">Nama Project</label>
                    <input type="text" name="title" value="{{ old('title', $project->title) }}" required class="w-full px-3 py-2.5 rounded-[10px] bg-[#FAF7F2] border border-[#E8DEC8] text-xs">
                </div>
                <div>
                    <label class="block text-xs font-bold text-[#6B2203] uppercase mb-1">Kategori Layanan</label>
                    <select name="category" required class="w-full px-3 py-2.5 rounded-[10px] bg-[#FAF7F2] border border-[#E8DEC8] text-xs">
                        <option value="Landscape Maintenance" {{ $project->category == 'Landscape Maintenance' ? 'selected' : '' }}>Landscape Maintenance</option>
                        <option value="Garden Management" {{ $project->category == 'Garden Management' ? 'selected' : '' }}>Garden Management</option>
                        <option value="Housekeeping Service" {{ $project->category == 'Housekeeping Service' ? 'selected' : '' }}>Housekeeping Service</option>
                        <option value="Landscape & Housekeeping" {{ $project->category == 'Landscape & Housekeeping' ? 'selected' : '' }}>Landscape & Housekeeping</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-[#6B2203] uppercase mb-1">Lokasi di Bali</label>
                    <input type="text" name="location" value="{{ old('location', $project->location) }}" class="w-full px-3 py-2.5 rounded-[10px] bg-[#FAF7F2] border border-[#E8DEC8] text-xs">
                </div>
                <div>
                    <label class="block text-xs font-bold text-[#6B2203] uppercase mb-1">Foto Utama (Cover)</label>
                    @if($project->main_image)
                        <div class="mb-1 w-16 h-10 rounded overflow-hidden border border-[#E8DEC8]">
                            <img src="{{ asset($project->main_image) }}" alt="" class="w-full h-full object-cover">
                        </div>
                    @endif
                    <input type="file" name="main_image" accept="image/*" class="text-xs text-[#7A5B49]">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-[#6B2203] uppercase mb-1">Deskripsi Pengerjaan</label>
                <textarea name="description" rows="3" class="w-full px-3 py-2.5 rounded-[10px] bg-[#FAF7F2] border border-[#E8DEC8] text-xs">{{ old('description', $project->description) }}</textarea>
            </div>

            <!-- Upload Dokumentasi 3 Tahapan: Before -> Process -> Final Result -->
            <div class="pt-4 border-t border-[#E8DEC8] space-y-4">
                <span class="label-caps text-[#965E03] text-xs font-bold block">
                    UNGGAH DOKUMENTASI STORYTELLING (BEFORE → PROCESS → FINAL RESULT)
                </span>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <!-- Before -->
                    @php $beforeImg = $project->images->where('image_type', 'before')->first(); @endphp
                    <div class="p-4 rounded-[12px] bg-[#FAF7F2] border border-[#E8DEC8] space-y-2">
                        <span class="label-caps text-[#6B2203] font-bold text-[10px] block">1. BEFORE IMAGE</span>
                        @if($beforeImg)
                            <div class="h-20 rounded overflow-hidden border border-[#E8DEC8]">
                                <img src="{{ asset($beforeImg->image_path) }}" alt="Before" class="w-full h-full object-cover">
                            </div>
                        @endif
                        <input type="file" name="before_image" accept="image/*" class="text-xs text-[#7A5B49]">
                    </div>

                    <!-- Process -->
                    @php $processImg = $project->images->where('image_type', 'process')->first(); @endphp
                    <div class="p-4 rounded-[12px] bg-[#FAF7F2] border border-[#E8DEC8] space-y-2">
                        <span class="label-caps text-[#965E03] font-bold text-[10px] block">2. PROCESS IMAGE</span>
                        @if($processImg)
                            <div class="h-20 rounded overflow-hidden border border-[#E8DEC8]">
                                <img src="{{ asset($processImg->image_path) }}" alt="Process" class="w-full h-full object-cover">
                            </div>
                        @endif
                        <input type="file" name="process_image" accept="image/*" class="text-xs text-[#7A5B49]">
                    </div>

                    <!-- Final Result -->
                    @php $afterImg = $project->images->where('image_type', 'after')->first(); @endphp
                    <div class="p-4 rounded-[12px] bg-[#FAF7F2] border border-[#E8DEC8] space-y-2">
                        <span class="label-caps text-green-800 font-bold text-[10px] block">3. FINAL RESULT IMAGE</span>
                        @if($afterImg)
                            <div class="h-20 rounded overflow-hidden border border-[#E8DEC8]">
                                <img src="{{ asset($afterImg->image_path) }}" alt="After" class="w-full h-full object-cover">
                            </div>
                        @endif
                        <input type="file" name="after_image" accept="image/*" class="text-xs text-[#7A5B49]">
                    </div>
                </div>
            </div>

            <div class="pt-2">
                <label class="flex items-center gap-2 cursor-pointer text-xs">
                    <input type="checkbox" name="is_published" value="1" {{ $project->is_published ? 'checked' : '' }} class="rounded text-[#965E03]">
                    <span class="font-bold text-[#6B2203]">Publikasikan di Halaman Portfolio</span>
                </label>
            </div>

            <div class="pt-4 border-t border-[#E8DEC8]">
                <button type="submit" class="btn-primary text-xs px-6 py-2.5">
                    PERBARUI PROJECT
                </button>
            </div>
        </form>
    </div>
@endsection
