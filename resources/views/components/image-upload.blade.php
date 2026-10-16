@props([
    'name',
    'id' => null,
    'value' => null,
    'required' => false,
    'accept' => 'image/*',
    'height' => 'h-28',
    'class' => '',
])

@php
    $inputId = $id ?? 'upload_' . str_replace(['[', ']', '.'], ['_', '', '_'], $name) . '_' . substr(md5(uniqid()), 0, 6);
    $hasValue = !empty($value);
    $imageUrl = $hasValue ? asset($value) : '';
@endphp

<div class="image-upload-box relative group {{ $height }} w-full rounded-[14px] border-2 border-dashed border-[#E8DEC8] hover:border-[#965E03] bg-[#FAF7F2] transition-all duration-200 cursor-pointer overflow-hidden flex items-center justify-center {{ $class }}">
    <input type="file"
           name="{{ $name }}"
           id="{{ $inputId }}"
           accept="{{ $accept }}"
           {{ $required ? 'required' : '' }}
           class="file-upload-input absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20">

    {{-- State 1: Placeholder - Cuma Ikon Saja, Clean & Rapi --}}
    <div class="placeholder-icon flex items-center justify-center w-full h-full pointer-events-none select-none p-3 {{ $hasValue ? 'hidden' : '' }}">
        <img src="{{ asset('images/icons/upload-icon.png') }}"
             alt=""
             class="w-12 h-12 object-contain group-hover:scale-110 transition-transform duration-200 pointer-events-none">
    </div>

    {{-- State 2: Preview - Foto Terunggah + Hover Overlay Cuma Ikon Saja --}}
    <div class="preview-container absolute inset-0 w-full h-full pointer-events-none select-none {{ $hasValue ? '' : 'hidden' }}">
        <img src="{{ $imageUrl }}"
             alt=""
             class="preview-image w-full h-full object-cover pointer-events-none">
        <div class="preview-overlay absolute inset-0 bg-black/35 opacity-0 group-hover:opacity-100 transition-opacity duration-200 flex items-center justify-center">
            <img src="{{ asset('images/icons/upload-icon.png') }}"
                 alt=""
                 class="w-9 h-9 object-contain drop-shadow-md brightness-110 group-hover:scale-110 transition-transform duration-200 pointer-events-none">
        </div>
    </div>
</div>
