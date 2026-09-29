@extends('layouts.app')

@section('title', __('Our Projects') . ' | PT. KUBU MANAGEMENT BALI')
@section('meta_description', __('Project Portfolio Header Subtitle'))

@section('content')
    <!-- Banner -->
    <section class="bg-[#F5F1E8] py-12 lg:py-16 border-b border-[#E8DEC8]">
        <div class="w-full px-4 sm:px-8 lg:px-12 xl:px-16 2xl:px-20">
            <span class="label-caps text-[#965E03] font-bold block mb-2">{{ __('VISUAL WORK EVIDENCE') }}</span>
            <h1 class="font-fraunces text-4xl sm:text-5xl font-bold text-[#6B2203] tracking-tight">
                {{ __('Our Project Portfolio') }}
            </h1>
            <p class="text-base sm:text-lg text-[#654A39] mt-3 max-w-2xl">
                {{ __('Project Portfolio Subtitle') }}
            </p>
        </div>
    </section>

    <!-- Project List Section -->
    <section class="py-16 lg:py-24 bg-[#FAF7F2]">
        <div class="w-full px-4 sm:px-8 lg:px-12 xl:px-16 2xl:px-20 space-y-12">
            <!-- Category Filter Tabs -->
            <div class="flex flex-wrap items-center gap-2 border-b border-[#E8DEC8] pb-4">
                <a href="{{ route('projects.index', ['category' => 'all']) }}" class="px-4 py-2 rounded-full text-xs font-semibold transition-all {{ $activeCategory === 'all' ? 'bg-[#965E03] text-white shadow-warm-sm' : 'bg-white text-[#6B2203] border border-[#E8DEC8] hover:bg-[#F5F1E8]' }}">
                    {{ __('All Categories') }}
                </a>
                @foreach($categories as $cat)
                    <a href="{{ route('projects.index', ['category' => $cat]) }}" class="px-4 py-2 rounded-full text-xs font-semibold transition-all {{ $activeCategory === $cat ? 'bg-[#965E03] text-white shadow-warm-sm' : 'bg-white text-[#6B2203] border border-[#E8DEC8] hover:bg-[#F5F1E8]' }}">
                        {{ __($cat) }}
                    </a>
                @endforeach
            </div>

            <!-- Projects Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8 lg:gap-10">
                @forelse($projects as $project)
                    <div class="bg-white rounded-[24px] overflow-hidden border border-[#E8DEC8] shadow-warm-md hover:shadow-warm-lg transition-all duration-300 flex flex-col group">
                        <!-- Main Image -->
                        <div class="relative h-64 overflow-hidden">
                            <img src="{{ asset($project->main_image ?? 'images/kubu/hero_bali.jpg') }}" alt="{{ __($project->title) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                            <div class="absolute bottom-4 left-6 flex items-center gap-2">
                                <span class="bg-[#965E03] text-white text-[11px] font-semibold px-3 py-1 rounded-full uppercase tracking-wider">
                                    {{ __($project->category) }}
                                </span>
                                @if($project->location)
                                    <span class="bg-black/60 text-white text-[11px] px-2.5 py-1 rounded-full">
                                        {{ $project->location }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Card Content -->
                        <div class="p-6 sm:p-8 flex-1 flex flex-col justify-between space-y-6">
                            <div class="space-y-3">
                                <h3 class="font-fraunces text-2xl font-bold text-[#6B2203]">
                                    {{ __($project->title) }}
                                </h3>
                                <p class="text-sm text-[#523A2C] leading-relaxed">
                                    {{ __($project->description) }}
                                </p>

                                <!-- Before/Process/After Preview Strip -->
                                @if($project->images->count() > 0)
                                    <div class="pt-2">
                                        <span class="label-caps text-[#965E03] text-[10px] block mb-2 font-bold">{{ __('DOCUMENTATION PHASE:') }}</span>
                                        <div class="grid grid-cols-3 gap-2">
                                            @foreach($project->images as $img)
                                                <div class="relative rounded-[8px] overflow-hidden aspect-[4/3] border border-[#E8DEC8]">
                                                    <img src="{{ asset($img->image_path) }}" alt="{{ $img->caption }}" class="w-full h-full object-cover">
                                                    <span class="absolute bottom-1 left-1 bg-black/70 text-white text-[9px] uppercase px-1.5 py-0.5 rounded font-bold">
                                                        {{ __($img->image_type) }}
                                                    </span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="pt-4 border-t border-[#E8DEC8] flex items-center justify-between">
                                <a href="{{ route('projects.show', $project->slug) }}" class="btn-primary text-xs px-4 py-2.5">
                                    <span>{{ __('VIEW TRANSFORMATION DETAILS') }}</span>
                                    <span>→</span>
                                </a>
                                <span class="text-xs text-[#7A5B49] italic">{{ __('Portfolio Showcase') }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-16 bg-white rounded-[24px] border border-[#E8DEC8] p-8">
                        <p class="font-fraunces text-xl text-[#6B2203]">{{ __('No projects found in this category') }}</p>
                        <p class="text-sm text-[#7A5B49] mt-2">{{ __('Please select another category or contact us for more information.') }}</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="pt-6">
                {{ $projects->links() }}
            </div>
        </div>
    </section>
@endsection
