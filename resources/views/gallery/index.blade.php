@extends('layouts.app')

@section('title', __('GALLERY') . ' | PT. KUBU MANAGEMENT BALI')
@section('meta_description', __('Gallery Header Subtitle'))

@section('content')
    <!-- Header -->
    <section class="bg-[#F5F1E8] py-12 lg:py-16 border-b border-[#E8DEC8]">
        <div class="w-full px-4 sm:px-8 lg:px-12 xl:px-16 2xl:px-20">
            <span class="label-caps text-[#965E03] font-bold block mb-2">{{ __('VISUAL PORTFOLIO') }}</span>
            <h1 class="font-fraunces text-4xl sm:text-5xl font-bold text-[#6B2203] tracking-tight">
                {{ __('Work Gallery') }}
            </h1>
            <p class="text-base sm:text-lg text-[#654A39] mt-3 max-w-2xl">
                {{ __('Gallery Header Subtitle') }}
            </p>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="py-12 lg:py-20 bg-[#FAF7F2]">
        <div class="w-full px-4 sm:px-8 lg:px-12 xl:px-16 2xl:px-20 space-y-8">
            <!-- Main Group Filters: ALL, LANDSCAPE, HOUSEKEEPING -->
            <div class="flex flex-wrap items-center justify-between gap-4 border-b border-[#E8DEC8] pb-6">
                <div class="flex flex-wrap items-center gap-2">
                    <a href="{{ route('gallery.index', ['group' => 'all']) }}" class="px-5 py-2.5 rounded-full text-xs font-bold transition-all {{ $group === 'all' ? 'bg-[#6B2203] text-white shadow-warm-sm' : 'bg-white text-[#6B2203] border border-[#E8DEC8] hover:bg-[#F5F1E8]' }}">
                        {{ __('ALL PHOTOS') }}
                    </a>
                    <a href="{{ route('gallery.index', ['group' => 'landscape']) }}" class="px-5 py-2.5 rounded-full text-xs font-bold transition-all {{ $group === 'landscape' ? 'bg-[#965E03] text-white shadow-warm-sm' : 'bg-white text-[#6B2203] border border-[#E8DEC8] hover:bg-[#F5F1E8]' }}">
                        {{ __('LANDSCAPE') }}
                    </a>
                    <a href="{{ route('gallery.index', ['group' => 'housekeeping']) }}" class="px-5 py-2.5 rounded-full text-xs font-bold transition-all {{ $group === 'housekeeping' ? 'bg-[#965E03] text-white shadow-warm-sm' : 'bg-white text-[#6B2203] border border-[#E8DEC8] hover:bg-[#F5F1E8]' }}">
                        {{ __('HOUSEKEEPING') }}
                    </a>
                </div>

                <!-- Subcategory Filter Pills -->
                <div class="flex flex-wrap items-center gap-1.5 text-xs">
                    <span class="text-[#7A5B49] font-medium mr-1">{{ __('Category Filter:') }}</span>
                    @if($group === 'all' || $group === 'landscape')
                        @foreach($landscapeCategories as $lc)
                            <a href="{{ route('gallery.index', ['group' => 'landscape', 'category' => $lc->slug]) }}" class="px-3 py-1 rounded-[8px] {{ $categorySlug === $lc->slug ? 'bg-[#965E03] text-white' : 'bg-white text-[#654A39] border border-[#E8DEC8] hover:bg-[#F5F1E8]' }}">
                                {{ __($lc->name) }}
                            </a>
                        @endforeach
                    @endif

                    @if($group === 'all' || $group === 'housekeeping')
                        @foreach($housekeepingCategories as $hc)
                            <a href="{{ route('gallery.index', ['group' => 'housekeeping', 'category' => $hc->slug]) }}" class="px-3 py-1 rounded-[8px] {{ $categorySlug === $hc->slug ? 'bg-[#965E03] text-white' : 'bg-white text-[#654A39] border border-[#E8DEC8] hover:bg-[#F5F1E8]' }}">
                                {{ __($hc->name) }}
                            </a>
                        @endforeach
                    @endif
                </div>
            </div>

            <!-- Responsive Gallery Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse($images as $img)
                    <div class="gallery-card bg-white rounded-[20px] overflow-hidden border border-[#E8DEC8] shadow-warm-sm hover:shadow-warm-md transition-all group cursor-pointer" onclick="openLightbox('{{ asset($img->image_path) }}', '{{ addslashes(__($img->title)) }}', '{{ addslashes(__($img->caption ?? '')) }}')">
                        <div class="relative aspect-square overflow-hidden bg-[#F5F1E8]">
                            <img src="{{ asset($img->image_path) }}" alt="{{ __($img->title) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-4">
                                <span class="text-[10px] uppercase font-bold tracking-wider text-[#D4A574]">
                                    {{ __($img->parent_group) }} • {{ __($img->category->name ?? '') }}
                                </span>
                                <h3 class="font-fraunces font-bold text-white text-sm mt-0.5 leading-snug">
                                    {{ __($img->title) }}
                                </h3>
                                @if($img->caption)
                                    <p class="text-white/80 text-xs mt-1 line-clamp-2">{{ __($img->caption) }}</p>
                                @endif
                                <span class="text-[10px] text-white/90 underline mt-2 inline-flex items-center gap-1 font-semibold">
                                    <span>{{ __('Click to enlarge') }}</span> 🔍
                                </span>
                            </div>
                            <span class="absolute top-3 left-3 bg-[#6B2203]/80 text-white text-[9px] uppercase px-2 py-0.5 rounded font-bold backdrop-blur-sm">
                                {{ __($img->parent_group) }}
                            </span>
                        </div>
                        <div class="p-3.5 bg-white border-t border-[#E8DEC8]">
                            <h4 class="font-fraunces font-bold text-xs text-[#6B2203] truncate">
                                {{ __($img->title) }}
                            </h4>
                            <p class="text-[11px] text-[#7A5B49] truncate mt-0.5">
                                {{ __($img->category->name ?? ucfirst($img->parent_group)) }}
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-16 text-center bg-white rounded-[24px] border border-[#E8DEC8] p-8">
                        <p class="font-fraunces text-xl text-[#6B2203]">{{ __('No photos found in this category') }}</p>
                        <p class="text-sm text-[#7A5B49] mt-2">{{ __('Please choose another category to view our project photos.') }}</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Interactive Lightbox Modal -->
    <div id="lightbox-modal" class="fixed inset-0 z-50 bg-black/90 backdrop-blur-md hidden flex items-center justify-center p-4">
        <!-- Close button -->
        <button onclick="closeLightbox()" class="absolute top-6 right-6 text-white/80 hover:text-white p-2 text-3xl font-light focus:outline-none" aria-label="{{ __('Close Preview') }}">
            &times;
        </button>

        <!-- Container -->
        <div class="max-w-4xl w-full bg-[#1A0E05] rounded-[24px] overflow-hidden border border-[#965E03]/50 shadow-2xl flex flex-col md:flex-row">
            <div class="md:w-2/3 bg-black flex items-center justify-center p-2">
                <img id="lightbox-img" src="" alt="Detail Foto" class="max-h-[70vh] w-auto object-contain">
            </div>
            <div class="md:w-1/3 p-6 sm:p-8 flex flex-col justify-between text-white space-y-4 bg-[#231206]">
                <div class="space-y-3">
                    <span class="label-caps text-[#D4A574] text-[10px] font-bold">KUBU MANAGEMENT BALI</span>
                    <h3 id="lightbox-title" class="font-fraunces text-xl font-bold text-white"></h3>
                    <p id="lightbox-caption" class="text-xs text-[#F5F1E8]/80 leading-relaxed"></p>
                </div>
                <div class="pt-4 border-t border-white/10 space-y-3">
                    <a href="{{ $globalContact->whatsapp_url ?? '#' }}" target="_blank" rel="noopener noreferrer" class="btn-primary w-full py-2.5 text-xs text-center">
                        <span>{{ __('INQUIRE SIMILAR SERVICE') }}</span>
                    </a>
                    <button onclick="closeLightbox()" class="w-full text-center text-xs text-[#D4A574] hover:underline">
                        {{ __('Close Preview') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function openLightbox(src, title, caption) {
        document.getElementById('lightbox-img').src = src;
        document.getElementById('lightbox-title').innerText = title;
        document.getElementById('lightbox-caption').innerText = caption || "{{ __('Professional operational documentation by PT. Kubu Management Bali.') }}";
        document.getElementById('lightbox-modal').classList.remove('hidden');
        document.body.classList.add('lightbox-open');
    }

    function closeLightbox() {
        document.getElementById('lightbox-modal').classList.add('hidden');
        document.body.classList.remove('lightbox-open');
    }

    // Close on Escape key or outside click
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeLightbox();
    });

    document.getElementById('lightbox-modal').addEventListener('click', function(e) {
        if (e.target === this) closeLightbox();
    });
</script>
@endpush
