@extends('layouts.admin')

@section('title', 'Company Profile & Settings')

@section('content')
    <div class="max-w-4xl space-y-6">
        <div>
            <h1 class="font-fraunces text-2xl font-bold text-[#6B2203]">
                Kelola Profil Perusahaan & Konten Dasar
            </h1>
            <p class="text-xs text-[#7A5B49] mt-0.5">
                Perbarui visi, misi, deskripsi, gambar utama, dan pengaturan SEO website.
            </p>
        </div>

        <form action="{{ route('admin.company.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Identitas Dasar -->
            <div class="bg-white p-6 rounded-[20px] border border-[#E8DEC8] shadow-warm-sm space-y-4">
                <h2 class="font-fraunces text-lg font-bold text-[#6B2203] border-b border-[#E8DEC8] pb-2">
                    Identitas Perusahaan
                </h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-[#6B2203] uppercase mb-1">Nama Perusahaan</label>
                        <input type="text" name="name" value="{{ old('name', $company->name) }}" required class="w-full px-3 py-2.5 rounded-[10px] bg-[#FAF7F2] border border-[#E8DEC8] text-xs">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[#6B2203] uppercase mb-1">Main Tagline</label>
                        <input type="text" name="tagline" value="{{ old('tagline', $company->tagline) }}" required class="w-full px-3 py-2.5 rounded-[10px] bg-[#FAF7F2] border border-[#E8DEC8] text-xs">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-[#6B2203] uppercase mb-1">Badge Sub-tagline</label>
                    <input type="text" name="subtagline" value="{{ old('subtagline', $company->subtagline) }}" class="w-full px-3 py-2.5 rounded-[10px] bg-[#FAF7F2] border border-[#E8DEC8] text-xs">
                </div>

                <div>
                    <label class="block text-xs font-bold text-[#6B2203] uppercase mb-1">Deskripsi Perusahaan (About Us)</label>
                    <textarea name="description" rows="8" required class="w-full px-3 py-2.5 rounded-[10px] bg-[#FAF7F2] border border-[#E8DEC8] text-xs leading-relaxed">{{ old('description', $company->description) }}</textarea>
                </div>
            </div>

            <!-- Visi & Misi -->
            <div class="bg-white p-6 rounded-[20px] border border-[#E8DEC8] shadow-warm-sm space-y-4">
                <h2 class="font-fraunces text-lg font-bold text-[#6B2203] border-b border-[#E8DEC8] pb-2">
                    Visi & Misi
                </h2>

                <div>
                    <label class="block text-xs font-bold text-[#6B2203] uppercase mb-1">Visi (Vision)</label>
                    <input type="text" name="vision" value="{{ old('vision', $company->vision) }}" required class="w-full px-3 py-2.5 rounded-[10px] bg-[#FAF7F2] border border-[#E8DEC8] text-xs">
                </div>

                <div>
                    <label class="block text-xs font-bold text-[#6B2203] uppercase mb-1">Poin Misi (Mission)</label>
                    <div class="space-y-2">
                        @php $missions = $company->mission ?? []; @endphp
                        <input type="text" name="mission[]" value="{{ $missions[0] ?? 'Memberikan pelayanan profesional.' }}" class="w-full px-3 py-2 rounded-[8px] bg-[#FAF7F2] border border-[#E8DEC8] text-xs" placeholder="Poin 1">
                        <input type="text" name="mission[]" value="{{ $missions[1] ?? 'Menjaga kualitas dan kebersihan properti.' }}" class="w-full px-3 py-2 rounded-[8px] bg-[#FAF7F2] border border-[#E8DEC8] text-xs" placeholder="Poin 2">
                        <input type="text" name="mission[]" value="{{ $missions[2] ?? 'Mengembangkan tenaga kerja yang kompeten.' }}" class="w-full px-3 py-2 rounded-[8px] bg-[#FAF7F2] border border-[#E8DEC8] text-xs" placeholder="Poin 3">
                        <input type="text" name="mission[]" value="{{ $missions[3] ?? 'Memberikan solusi sesuai kebutuhan setiap klien.' }}" class="w-full px-3 py-2 rounded-[8px] bg-[#FAF7F2] border border-[#E8DEC8] text-xs" placeholder="Poin 4">
                    </div>
                </div>
            </div>

            <!-- Foto Utama -->
            <div class="bg-white p-6 rounded-[20px] border border-[#E8DEC8] shadow-warm-sm space-y-4">
                <h2 class="font-fraunces text-lg font-bold text-[#6B2203] border-b border-[#E8DEC8] pb-2">
                    Media Gambar
                </h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-[#6B2203] uppercase mb-1">Hero Image (Halaman Utama)</label>
                        <x-image-upload name="hero_image" :value="$company->hero_image" height="h-36" />
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[#6B2203] uppercase mb-1">About Image (Halaman Tentang Kami)</label>
                        <x-image-upload name="about_image" :value="$company->about_image" height="h-36" />
                    </div>
                </div>
            </div>

            <!-- Pengaturan SEO -->
            <div class="bg-white p-6 rounded-[20px] border border-[#E8DEC8] shadow-warm-sm space-y-4">
                <h2 class="font-fraunces text-lg font-bold text-[#6B2203] border-b border-[#E8DEC8] pb-2">
                    SEO & Metadata
                </h2>

                <div>
                    <label class="block text-xs font-bold text-[#6B2203] uppercase mb-1">Meta Title</label>
                    <input type="text" name="meta_title" value="{{ old('meta_title', $settings->meta_title ?? '') }}" class="w-full px-3 py-2.5 rounded-[10px] bg-[#FAF7F2] border border-[#E8DEC8] text-xs">
                </div>

                <div>
                    <label class="block text-xs font-bold text-[#6B2203] uppercase mb-1">Meta Description</label>
                    <textarea name="meta_description" rows="2" class="w-full px-3 py-2.5 rounded-[10px] bg-[#FAF7F2] border border-[#E8DEC8] text-xs">{{ old('meta_description', $settings->meta_description ?? '') }}</textarea>
                </div>
            </div>

            <div>
                <button type="submit" class="btn-primary px-8 py-3 text-xs font-bold">
                    SIMPAN PERUBAHAN
                </button>
            </div>
        </form>
    </div>
@endsection
