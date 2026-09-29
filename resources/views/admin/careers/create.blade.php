@extends('layouts.admin')

@section('title', 'Tambah Lowongan Baru')

@section('content')
    <div class="max-w-3xl space-y-6">
        <div>
            <a href="{{ route('admin.careers.index') }}" class="text-xs text-[#965E03] hover:underline mb-1 inline-block">
                ← Kembali ke Daftar Lowongan
            </a>
            <h1 class="font-fraunces text-2xl font-bold text-[#6B2203]">
                Tambah Lowongan Karir Baru
            </h1>
        </div>

        <form action="{{ route('admin.careers.store') }}" method="POST" class="bg-white p-6 sm:p-8 rounded-[20px] border border-[#E8DEC8] shadow-warm-sm space-y-5">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-[#6B2203] uppercase mb-1">Posisi / Jabatan <span class="text-red-500">*</span></label>
                    <input type="text" name="position" value="{{ old('position') }}" required placeholder="Contoh: Gardener / Housekeeping Staff" class="w-full px-3 py-2.5 rounded-[10px] bg-[#FAF7F2] border border-[#E8DEC8] text-xs focus:outline-none focus:border-[#965E03]">
                </div>
                <div>
                    <label class="block text-xs font-bold text-[#6B2203] uppercase mb-1">Tipe Pekerjaan <span class="text-red-500">*</span></label>
                    @php $selectedType = old('employment_type', 'Full-time'); @endphp
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
                    <input type="text" name="location" value="{{ old('location', 'Badung, Bali') }}" required class="w-full px-3 py-2.5 rounded-[10px] bg-[#FAF7F2] border border-[#E8DEC8] text-xs focus:outline-none focus:border-[#965E03]">
                </div>
                <div>
                    <label class="block text-xs font-bold text-[#6B2203] uppercase mb-1">Urutan Tampil (Sort Order)</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" min="0" class="w-full px-3 py-2 rounded-[10px] bg-[#FAF7F2] border border-[#E8DEC8] text-xs focus:outline-none focus:border-[#965E03]">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-[#6B2203] uppercase mb-1">Deskripsi Pekerjaan <span class="text-red-500">*</span></label>
                <textarea name="description" rows="4" required class="w-full px-3 py-2.5 rounded-[10px] bg-[#FAF7F2] border border-[#E8DEC8] text-xs focus:outline-none focus:border-[#965E03]" placeholder="Uraian tanggung jawab posisi ini...">{{ old('description') }}</textarea>
            </div>

            <div>
                <label class="block text-xs font-bold text-[#6B2203] uppercase mb-1">Kualifikasi / Persyaratan <span class="text-red-500">*</span></label>
                <textarea name="requirements" rows="4" required class="w-full px-3 py-2.5 rounded-[10px] bg-[#FAF7F2] border border-[#E8DEC8] text-xs focus:outline-none focus:border-[#965E03]" placeholder="- Berpengalaman minimal 1 tahun di bidangnya&#10;- Jujur, teliti, dan bertanggung jawab">{{ old('requirements') }}</textarea>
            </div>

            <div>
                <label class="block text-xs font-bold text-[#6B2203] uppercase mb-1">Petunjuk Pengiriman Lamaran</label>
                <input type="text" name="application_info" value="{{ old('application_info', 'Kirimkan CV ke info@kubumanagementbali.com dengan subjek nama posisi.') }}" class="w-full px-3 py-2.5 rounded-[10px] bg-[#FAF7F2] border border-[#E8DEC8] text-xs focus:outline-none focus:border-[#965E03]">
            </div>

            <div class="pt-2">
                <label class="flex items-center gap-2 cursor-pointer text-xs">
                    <input type="checkbox" name="is_published" value="1" {{ old('is_published', true) ? 'checked' : '' }} class="rounded text-[#965E03]">
                    <span class="font-bold text-[#6B2203]">Langsung Tayangkan di Website</span>
                </label>
            </div>

            <div class="pt-4 border-t border-[#E8DEC8] flex items-center justify-between">
                <button type="submit" class="btn-primary text-xs px-6 py-2.5">
                    SIMPAN LOWONGAN
                </button>
                <a href="{{ route('admin.careers.index') }}" class="btn-secondary text-xs px-5 py-2">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection
