@props([
    'imageUrl',
    'altText' => 'Hero Background',
    'brightness' => '0.6'
])

<section class="hero-section position-relative text-white">
    <img 
        src="{{ $imageUrl }}" 
        alt="{{ $altText }}" 
        class="bg-hero position-absolute top-0 start-0 w-100 h-100 object-fit-cover" 
        loading="lazy"
        style="object-fit: cover; filter: brightness({{ $brightness }});"
    >
    <div class="container position-relative py-5">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                
                {{ $slot }} 
                
            </div>
        </div>
    </div>
</section>