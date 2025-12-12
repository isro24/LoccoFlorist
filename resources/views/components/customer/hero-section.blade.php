@props([
    'imageUrl',
    'altText' => 'Hero Background',
    'brightness' => '0.5'
])

<section 
    class="relative h-[600px] flex items-center text-white bg-cover bg-center bg-no-repeat"
    style="background-image: url('{{ $imageUrl }}'); background-size: cover; background-position: center;"
>
    <div class="absolute inset-0" 
         style="background-color: rgba(0,0,0,{{ $brightness }});"></div>

    <div class="container mx-auto px-6 md:px-12 relative z-10 py-12">
        <div class="flex flex-wrap">
            <div class="w-full lg:w-6/12 text-left">
                {{ $slot }}
            </div>
        </div>
    </div>
</section>

