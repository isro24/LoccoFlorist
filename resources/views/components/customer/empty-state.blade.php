@props(['icon' => '🌺', 'title', 'message', 'buttonText' => null, 'buttonLink'
=> null])

<div class="text-center py-12 bg-white rounded-lg shadow-sm" data-aos="fade-up">
    <div class="text-7xl font-light opacity-25 mb-6">{{ $icon }}</div>
    <h4 class="font-bold mb-4 text-2xl text-[#ff79b0]">{{ $title }}</h4>
    <p class="text-gray-500 mb-6 px-4">{{ $message }}</p>

    @if($buttonText && $buttonLink)
    <a
        href="{{ $buttonLink }}"
        class="inline-block text-xl font-semibold py-2 px-12 rounded-full bg-pinkButton text-white border-none transition-all duration-100 ease-in-out hover:scale-105 hover:shadow-[0_4px_12px_rgba(0,0,0,0.2)]"
    >
        <i class="bi bi-arrow-left mr-2"></i> {{ $buttonText }}
    </a>
    @endif
</div>
