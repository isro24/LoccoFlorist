@props([
    'imageUrl',
    'altText' => 'Hero Background',
    'brightness' => '0.5'
])

<section 
    class="relative h-[80vh] md:h-[85vh]  flex items-center justify-center bg-cover bg-center"
    style="background-image: url('{{ $imageUrl }}');"
    aria-label="{{ $altText }}"
>
    <div class="absolute inset-0" style="background-color: rgba(0,0,0,{{ $brightness }});"></div>

    <div class="relative z-10 w-full px-4 md:px-8 lg:px-16 flex flex-col items-center justify-center text-center h-full">
        {{ $slot }}
    </div>
</section>
