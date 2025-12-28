<footer class="bg-pinkBg text-white">
    <div class="container mx-auto px-4 py-12 max-w-7xl font-serif text-xl">
        <div class="grid grid-cols-12 gap-6">

            <div class="lg:col-span-4 md:col-span-6 col-span-12">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('assets/images/logoNoBg.png') }}" alt="Locco Florist Logo"
                        class="h-[35px] w-auto object-contain rounded-lg mb-4 transition-all duration-200 ease-in-out hover:scale-105 inline-flex">
                </a>
                <p class="leading-[1.7] opacity-75 mb-4">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed
                    cursus ante dapibus diam.
                </p>
                <h6 class="font-bold mb-2">Ikuti Kami</h6>
                <div class="flex gap-2">
                    <a href="https://www.instagram.com/locco.florist/"
                        class="w-10 h-10 bg-white rounded-full flex items-center justify-center transition-all duration-200 ease-in-out hover:scale-105 font-sans">
                        <i class="bi bi-instagram text-darkPinkColor"></i>
                    </a>
                    <a href="https://www.tiktok.com/@locco.florist"
                        class="w-10 h-10 bg-white rounded-full flex items-center justify-center transition-all duration-200 ease-in-out hover:scale-105 font-sans">
                        <i class="bi bi-tiktok text-darkPinkColor"></i>
                    </a>
                </div>
            </div>

            <div class="lg:col-span-2 md:col-span-6 col-span-6 mb-6 md:mb-0">
                <h6 class="font-bold mb-4">Menu Cepat</h6>
                <ul class="space-y-2">
                    <li><a href="{{ route('home') }}"
                            class="text-white no-underline inline-flex items-center transition-all duration-200 ease-in-out opacity-90 hover:pl-[5px] hover:opacity-100"><i
                                class="bi bi-chevron-right mr-1"></i> Beranda</a></li>
                    <li><a href="{{ route('product.catalog') }}"
                            class="text-white no-underline inline-flex items-center transition-all duration-200 ease-in-out opacity-90 hover:pl-[5px] hover:opacity-100"><i
                                class="bi bi-chevron-right mr-1"></i> Katalog</a></li>
                    <li><a href="{{ route('about.us') }}"
                            class="text-white no-underline inline-flex items-center transition-all duration-200 ease-in-out opacity-90 hover:pl-[5px] hover:opacity-100"><i
                                class="bi bi-chevron-right mr-1"></i> Tentang Kami</a></li>
                    <li><a href="{{ route('ongkos.kirim') }}"
                            class="text-white no-underline inline-flex items-center transition-all duration-200 ease-in-out opacity-90 hover:pl-[5px] hover:opacity-100"><i
                                class="bi bi-chevron-right mr-1"></i> Ongkos Kirim</a></li>
                </ul>
            </div>

            <div class="lg:col-span-3 md:col-span-6 col-span-6 mb-6 md:mb-0">
                <h6 class="font-bold mb-4">Kategori Produk</h6>
                <ul class="space-y-2">
                    @forelse ($categories as $category)
                    <li>
                        <a href="{{ route('product.catalog', ['category' => $category->name]) }}"
                            class="text-white no-underline inline-flex items-center transition-all duration-200 ease-in-out opacity-90 hover:pl-[5px] hover:opacity-100">
                            <i class="bi bi-chevron-right mr-1"></i> {{ $category->name }}
                        </a>
                    </li>
                    @empty
                    <li class="mb-2"><span class="opacity-75">Belum ada kategori</span></li>
                    @endforelse
                </ul>
            </div>

            <div class="lg:col-span-3 md:col-span-6 col-span-12">
                <h6 class="font-bold mb-4">Hubungi Kami</h6>
                <ul class="space-y-4">
                    <li class="flex items-start gap-2">
                        <i class="bi bi-whatsapp mt-1"></i>
                        <div class="flex flex-col">
                            <a href="https://wa.me/6281234567890" target="_blank"
                                class="text-white no-underline transition-all duration-200 ease-in-out opacity-90 hover:opacity-100">
                                Chat WhatsApp
                            </a>
                            <span class="text-sm text-white mt-1 leading-relaxed">
                                Jam Operasional:<br>
                                Senin - Minggu: 08.00 - 23.00
                            </span>
                        </div>
                    </li>
                </ul>
            </div>

        </div>
        <div class="grid grid-cols-12 gap-6 mt-6 pt-6 border-t border-white/25">
            <div class="lg:col-span-6 col-span-12">
                <h6 class="font-bold mb-4 text-white">Metode Pembayaran</h6>

                <div
                    class="flex items-center gap-4 p-3 rounded-xl max-w-sm backdrop-blur-sm hover:bg-white/10 transition-colors duration-300">
                    <div
                        class="bg-white h-12 w-20 rounded-lg flex items-center justify-center p-2 shadow-sm flex-shrink-0">
                        <img src="{{ asset('assets/images/bca.png') }}" alt="BCA" class="h-full w-full object-contain">
                    </div>

                    <div class="flex flex-col justify-center">
                        <span class="text-lg font-mono font-bold text-white tracking-wider">
                            4452 7233 21
                        </span>
                        <span class="text-xs text-white uppercase tracking-wide mt-0.5">
                            An. Khusnul Mandala W
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="border-t border-white/25">
        <div class="container mx-auto px-4 py-4 text-center">
            <p class="mb-0 opacity-90 text-sm">&copy; {{ date('Y') }} <strong>Locco Florist</strong>. All Rights
                Reserved.</p>
        </div>
    </div>
</footer>
