@props([
    'title',
    'text',
    'buttonText',
    'buttonLink',
    'buttonIcon' => null, 
])

<div {{ $attributes->merge(['class' => 'border-none shadow-lg overflow-hidden mb-12 bg-gradient-to-br from-[#ff79b0] to-[#ff4d94] text-white rounded-lg']) }} 
     data-aos="zoom-in">
    <div class="font-serif text-center text-white py-12 px-6">
        
        <h3 class="font-bold mb-4 text-3xl">{{ $title }}</h3>
        
        <p class="mb-6 opacity-90 text-2xl">{{ $text }}</p>
        
        <a href="{{ $buttonLink }}" 
           target="{{ str_starts_with($buttonLink, 'http') ? '_blank' : '_self' }}" 
           class="inline-block bg-white text-gray-900 font-semibold text-2xl py-2 px-12 rounded-full shadow-sm transition duration-300 ease-in-out hover:scale-105">
            
            @if($buttonIcon)
                <i class="{{ $buttonIcon }} mr-2"></i>
            @endif
            
            {{ $buttonText }}
        </a>
    </div>
</div>