@extends('layouts.admin')

@section('title', 'Edit Lowongan')

@section('content')
    <div class="max-w-3xl space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <a href="{{ route('admin.careers.index') }}" class="text-xs text-[#965E03] hover:underline mb-1 inline-block">
                    ← Kembali ke Daftar Lowongan
                </a>
                <h1 class="font-fraunces text-2xl font-bold text-[#6B2203]">
                    Edit Lowongan: {{ $career->position }}
                </h1>
            </div>
            <div>
                <a href="{{ route('career.show', $career->slug) }}" target="_blank" class="text-xs text-[#965E03] hover:underline inline-flex items-center gap-1 font-semibold">
                    <span>Lihat di Website</span> ↗
                </a>
            </div>
        </div>

        <form action="{{ route('admin.careers.update', $career->id) }}" method="POST" class="bg-white p-6 sm:p-8 rounded-[20px] border border-[#E8DEC8] shadow-warm-sm space-y-5">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-[#6B2203] uppercase mb-1">Posisi / Jabatan <span class="text-red-500">*</span></label>
                    <input type="text" name="position" value="{{ old('position', $career->position) }}" required class="w-full px-3 py-2.5 rounded-[10px] bg-[#FAF7F2] border border-[#E8DEC8] text-xs focus:outline-none focus:border-[#965E03]">
                </div>
                <div>
                    <label class="block text-xs font-bold text-[#6B2203] uppercase mb-1">Tipe Pekerjaan <span class="text-red-500">*</span></label>
                    @php $selectedType = old('employment_type', $career->employment_type); @endphp
                    <select name="employment_type" required class="w-full px-3 py-2.5 rounded-[10px] bg-[#FAF7F2] border border-[#E8DEC8] text-xs focus:outline-none focus:border-[#965E03]">
                        <option value="Full-time" {{ $selectedType == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                        <option value="Part-time" {{ $selectedType == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                        <option value="Contract" {{ $selectedType == 'Contract' ? 'selected' : '' }}>Contract</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-[#6B2203] uppercase mb-1">Lokasi Kerja <span class="text-red-500">*</span></label>
                    <input type="text" name="location" value="{{ old('location', $career->location) }}" required class="w-full px-3 py-2.5 rounded-[10px] bg-[#FAF7F2] border border-[#E8DEC8] text-xs focus:outline-none focus:border-[#965E03]">
                </div>
                <div>
                    <label class="block text-xs font-bold text-[#6B2203] uppercase mb-1">Urutan Tampil (Sort Order)</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $career->sort_order ?? 0) }}" min="0" class="w-full px-3 py-2 rounded-[10px] bg-[#FAF7F2] border border-[#E8DEC8] text-xs focus:outline-none focus:border-[#965E03]">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-[#6B2203] uppercase mb-1">Deskripsi Pekerjaan <span class="text-red-500">*</span></label>
                <textarea name="description" rows="4" required class="w-full px-3 py-2.5 rounded-[10px] bg-[#FAF7F2] border border-[#E8DEC8] text-xs focus:outline-none focus:border-[#965E03]">{{ old('description', $career->description) }}</textarea>
            </div>

            <div>
                <label class="block text-xs font-bold text-[#6B2203] uppercase mb-1">Kualifikasi / Persyaratan <span class="text-red-500">*</span></label>
                <textarea name="requirements" rows="4" required class="w-full px-3 py-2.5 rounded-[10px] bg-[#FAF7F2] border border-[#E8DEC8] text-xs focus:outline-none focus:border-[#965E03]">{{ old('requirements', $career->requirements) }}</textarea>
            </div>

            <div>
                <label class="block text-xs font-bold text-[#6B2203] uppercase mb-1">Petunjuk Pengiriman Lamaran</label>
                <input type="text" name="application_info" value="{{ old('application_info', $career->application_info) }}" class="w-full px-3 py-2.5 rounded-[10px] bg-[#FAF7F2] border border-[#E8DEC8] text-xs focus:outline-none focus:border-[#965E03]">
            </div>

            <div class="pt-2">
                <label class="flex items-center gap-2 cursor-pointer text-xs">
                    <input type="checkbox" name="is_published" value="1" {{ old('is_published', $career->is_published) ? 'checked' : '' }} class="rounded text-[#965E03]">
                    <span class="font-bold text-[#6B2203]">Publikasikan di Website (Tayang)</span>
                </label>
            </div>

            <div class="pt-4 border-t border-[#E8DEC8] flex items-center justify-between">
                <button type="submit" class="btn-primary text-xs px-6 py-2.5">
                    PERBARUI LOWONGAN
                </button>
                <a href="{{ route('admin.careers.index') }}" class="btn-secondary text-xs px-5 py-2">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection
