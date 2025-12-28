@props([
    'icon',
    'title',
    'description',
    'delay' => 0
])

<div data-aos="fade-up" data-aos-delay="{{ $delay }}">
    <div class="bg-white border-none shadow-sm h-full text-center p-6 transition-all duration-300 ease-in-out hover:-translate-y-[5px] rounded-lg">
        <div class="mb-4 flex justify-center"> {!! $icon !!} </div>
        <h5 class="font-bold mb-2 text-2xl font-serif">{{ $title }}</h5>
        <p class="text-gray-500 text-sm mb-0 font-sans">{{ $description }}</p>
    </div>
</div>