@props([
    'action' => '#',
    'value' => '',
    'placeholder' => 'Cari produk...',
])

<div class="text-center mb-12" data-aos="fade-up">
    <div class="mx-auto max-w-[600px]">
        <form action="{{ $action }}" method="GET" onsubmit="return (this.querySelector('input[name=search]')?.value || '').trim().length > 0;">
            <div class="font-serif text-xl flex rounded-full overflow-hidden bg-white shadow-md">
                <span class="bg-white border-none pl-6 flex items-center">
                    <i class="bi bi-search text-gray-500"></i>
                </span>
                <input type="text" name="search" value="{{ $value }}" 
                       class="form-input border-none shadow-none py-4 w-full focus:ring-0" 
                       placeholder="{{ $placeholder }}">
                <button class="bg-pinkButton text-white border-none px-6 py-4 hover:bg-[#FF0080] duration-300 cursor-pointer" type="submit">
                    <span class="font-semibold">Cari</span>
                </button>
            </div>
        </form>
    </div>
</div>