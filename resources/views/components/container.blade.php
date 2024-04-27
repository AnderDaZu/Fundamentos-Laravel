@props([
    // Este 👇 "width" es como si fuese una propiedad de la clase
    'width' => '7xl',
])
@php
    // acá se usa dicha propiedad "width", el valor se asigna desde donde se llama al componente
    switch ($width) {
        case '4xl':
            $width = 'max-w-4xl';
            break;

        default:
            $width = 'max-w-7xl';
            break;
    }
@endphp

<div {{ $attributes->merge(['class' => $width . ' mx-auto px-4 sm:px-6 lg:px-8']) }}>
{{-- <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"> --}}
    {{ $slot }}
</div>