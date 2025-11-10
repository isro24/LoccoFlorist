@props([
    'title',
    'text',
    'buttonText',
    'buttonLink',
    'buttonIcon' => null, 
])

<div {{ $attributes->merge(['class' => 'card border-0 shadow-lg overflow-hidden mb-5 card-gradient-pink']) }} 
     data-aos="zoom-in">
    <div class="card-body text-center text-white py-5 px-4">
        
        <h3 class="fw-bold mb-3">{{ $title }}</h3>
        
        <p class="mb-4 opacity-90">{{ $text }}</p>
        
        <a href="{{ $buttonLink }}" 
           target="{{ str_starts_with($buttonLink, 'http') ? '_blank' : '_self' }}" 
           class="btn btn-light btn-lg rounded-pill px-5 shadow-sm">
            
            @if($buttonIcon)
                <i class="{{ $buttonIcon }} me-2"></i>
            @endif
            
            {{ $buttonText }}
        </a>
    </div>
</div>