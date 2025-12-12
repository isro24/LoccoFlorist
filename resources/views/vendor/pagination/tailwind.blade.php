@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Navigasi Halaman" class="flex flex-col items-center mt-10">
        
        {{-- Bagian menampilkan info halaman saat ini --}}
        <div class="mb-2 text-gray-500 text-sm">
            Menampilkan <span class="font-semibold">{{ $paginator->firstItem() }}</span>–
            <span class="font-semibold">{{ $paginator->lastItem() }}</span> dari 
            <span class="font-semibold">{{ $paginator->total() }}</span> produk
        </div>


        <ul class="inline-flex items-center gap-1 text-sm font-medium">
            {{-- Tombol Previous --}}
            @if ($paginator->onFirstPage())
                <li>
                    <span class="px-3 py-2 rounded-xl bg-pink-100 text-pink-300 cursor-not-allowed select-none flex items-center justify-center transition-all duration-200">
                        <i class="bi bi-chevron-left"></i>
                    </span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                       class="px-3 py-2 rounded-xl bg-white border border-pink-200 text-pink-500 hover:bg-pink-50 hover:text-pink-600 flex items-center justify-center transition-all duration-200 shadow-sm">
                        <i class="bi bi-chevron-left"></i>
                    </a>
                </li>
            @endif

            {{-- Looping angka halaman --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li>
                        <span class="px-3 py-2 text-gray-400">...</span>
                    </li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li>
                                <span class="px-4 py-2 rounded-xl bg-pink-500 text-white shadow-md font-semibold transition-all duration-200">
                                    {{ $page }}
                                </span>
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}"
                                   class="px-4 py-2 rounded-xl bg-white border border-pink-200 text-pink-500 hover:bg-pink-50 hover:text-pink-600 transition-all duration-200 shadow-sm">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Tombol Next --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                       class="px-3 py-2 rounded-xl bg-white border border-pink-200 text-pink-500 hover:bg-pink-50 hover:text-pink-600 flex items-center justify-center transition-all duration-200 shadow-sm">
                        <i class="bi bi-chevron-right"></i>
                    </a>
                </li>
            @else
                <li>
                    <span class="px-3 py-2 rounded-xl bg-pink-100 text-pink-300 cursor-not-allowed select-none flex items-center justify-center transition-all duration-200">
                        <i class="bi bi-chevron-right"></i>
                    </span>
                </li>
            @endif
        </ul>
    </nav>
@endif
