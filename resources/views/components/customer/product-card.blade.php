<div data-aos="fade-up" data-aos-delay="{{ $delay }}">
    <div class="border-none shadow-md  h-full bg-white overflow-hidden transition-all duration-300 ease-in-out hover:-translate-y-1 hover:shadow group rounded-lg">
        <a href="{{ route('product.show', $product->slug) }}" class="no-underline text-gray-900">
            <div class="relative overflow-hidden rounded-sm">
                @if($product->is_best_seller)
                    <div class="absolute top-0 left-0 z-20">
                        <div class="bg-pink-500 text-white text-[10px] md:text-xs font-bold px-3 py-1.5 rounded-br-xl shadow-md flex items-center gap-1">
                            <i class="bi bi-star-fill text-yellow-300 text-[10px]"></i> Best Seller
                        </div>
                    </div>
                @endif
                <div class="aspect-square">
                    <img 
                        src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/400' }}" 
                        class="object-cover w-full h-full transition-transform duration-400 ease-in-out group-hover:scale-108" 
                        alt="{{ $product->name }}" 
                        loading="lazy">
                    <!-- <div class="absolute bottom-0 w-full bg-black/50 text-center py-2 opacity-0 group-hover:opacity-100 md:opacity-0 md:group-hover:opacity-100 sm:opacity-70">
                        <span class="text-white font-semibold text-sm">Lihat Produk</span>
                    </div> -->
                </div>
            </div>

            <div class="text-center p-4">            
                <!-- <span class="font-medium text-gray-900 mb-2 truncate text-sm">
                    {{ $product->category->name ?? 'Umum' }}
                </span> -->
                <h6 class="font-serif font-bold text-pinkColor mb-2 truncate text-2xl" title="{{ $product->name }}">
                    {{ $product->name }}
                </h6>
                <p class="font-sans mb-2 font-medium text-black/80">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                </p>

              <!-- <span class="block py-2 text-sm text-white text-center rounded-full bg-pinkButton shadow-sm transition-all duration-150 hover:scale-105 hover:shadow-[0_4px_12px_rgba(255,121,176,0.4)]">
                    Detail Produk
                </span> -->
            </div>
        </a>
    </div>
</div>
