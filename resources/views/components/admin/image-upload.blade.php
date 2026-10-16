@props([
    'name',
    'id' => null,
    'value' => null,
    'required' => false,
    'accept' => 'image/*',
    'height' => 'h-28',
    'class' => '',
])

<x-image-upload :name="$name" :id="$id" :value="$value" :required="$required" :accept="$accept" :height="$height" :class="$class" />
