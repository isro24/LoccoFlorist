@props(['icon' => '🌺', 'title', 'message', 'buttonText' => null, 'buttonLink' => null])

<div class="text-center py-5 bg-white rounded-4 shadow-sm" data-aos="fade-up">
    <div class="display-1 opacity-25 mb-4">{{ $icon }}</div>
    <h4 class="fw-bold mb-3 text-pink">{{ $title }}</h4>
    <p class="text-muted mb-4 px-3">{{ $message }}</p>
    @if($buttonText && $buttonLink)
        <a href="{{ $buttonLink }}" class="btn btn-lg rounded-pill px-5 btn-gradient-pink text-white">
            <i class="bi bi-arrow-left me-2"></i> {{ $buttonText }}
        </a>
    @endif
</div>
