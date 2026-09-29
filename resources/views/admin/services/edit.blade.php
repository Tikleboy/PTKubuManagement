@extends('layouts.admin')

@section('title', 'Edit Layanan')

@section('content')
    <div class="max-w-3xl space-y-6">
        <div>
            <a href="{{ route('admin.services.index') }}" class="text-xs text-[#965E03] hover:underline mb-1 inline-block">
                ← Kembali ke Daftar Layanan
            </a>
            <h1 class="font-fraunces text-2xl font-bold text-[#6B2203]">
                Edit Layanan: {{ $service->title }}
            </h1>
        </div>

        <form action="{{ route('admin.services.update', $service->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 sm:p-8 rounded-[20px] border border-[#E8DEC8] shadow-warm-sm space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-xs font-bold text-[#6B2203] uppercase mb-1">Divisi / Kategori Utama</label>
                <select name="service_category_id" required class="w-full px-3 py-2.5 rounded-[10px] bg-[#FAF7F2] border border-[#E8DEC8] text-xs">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ $service->service_category_id == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold text-[#6B2203] uppercase mb-1">Judul Layanan</label>
                <input type="text" name="title" value="{{ old('title', $service->title) }}" required class="w-full px-3 py-2.5 rounded-[10px] bg-[#FAF7F2] border border-[#E8DEC8] text-xs">
            </div>

            <div>
                <label class="block text-xs font-bold text-[#6B2203] uppercase mb-1">Deskripsi Singkat</label>
                <textarea name="description" rows="3" class="w-full px-3 py-2.5 rounded-[10px] bg-[#FAF7F2] border border-[#E8DEC8] text-xs">{{ old('description', $service->description) }}</textarea>
            </div>

            <div>
                <label class="block text-xs font-bold text-[#6B2203] uppercase mb-1">
                    Cakupan Pekerjaan (Satu baris per poin)
                </label>
                @php
                    $featuresText = is_array($service->features) ? implode("\n", $service->features) : '';
                @endphp
                <textarea name="features" rows="5" class="w-full px-3 py-2.5 rounded-[10px] bg-[#FAF7F2] border border-[#E8DEC8] text-xs">{{ old('features', $featuresText) }}</textarea>
            </div>

            <div class="grid grid-cols-2 gap-4 items-center">
                <div>
                    <label class="block text-xs font-bold text-[#6B2203] uppercase mb-1">Urutan Tampil (Sort Order)</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $service->sort_order) }}" class="w-full px-3 py-2 rounded-[10px] bg-[#FAF7F2] border border-[#E8DEC8] text-xs">
                </div>
                <div>
                    <label class="block text-xs font-bold text-[#6B2203] uppercase mb-1">Ganti Foto Layanan</label>
                    @if($service->image)
                        <div class="mb-1 w-16 h-10 rounded overflow-hidden border border-[#E8DEC8]">
                            <img src="{{ asset($service->image) }}" alt="" class="w-full h-full object-cover">
                        </div>
                    @endif
                    <input type="file" name="image" accept="image/*" class="text-xs text-[#7A5B49]">
                </div>
            </div>

            <div class="pt-2">
                <label class="flex items-center gap-2 cursor-pointer text-xs">
                    <input type="checkbox" name="is_published" value="1" {{ $service->is_published ? 'checked' : '' }} class="rounded text-[#965E03]">
                    <span class="font-bold text-[#6B2203]">Publikasikan di Website</span>
                </label>
            </div>

            <div class="pt-4 border-t border-[#E8DEC8]">
                <button type="submit" class="btn-primary text-xs px-6 py-2.5">
                    PERBARUI LAYANAN
                </button>
            </div>
        </form>
    </div>
@endsection
