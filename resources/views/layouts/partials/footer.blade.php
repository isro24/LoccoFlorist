
<footer class="footer-main text-white">
    <div class="container py-5">
        <div class="row g-4">

            <div class="col-lg-4 col-md-6">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('assets/images/logo hd.png') }}" alt="Locco Florist Logo" class="footer-logo mb-3">
                </a>
                <p class="footer-description opacity-75 mb-3">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam.
                </p>
                <h6 class="fw-bold mb-2">Ikuti Kami</h6>
                <div class="d-flex gap-2">
                    <a href="#" class="social-icon-btn btn btn-light btn-sm rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-instagram text-pink"></i>
                    </a>
                    <a href="#" class="social-icon-btn btn btn-light btn-sm rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-tiktok text-pink"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-2 col-md-6 col-6">
                <h6 class="fw-bold mb-3">Menu Cepat</h6>
                <ul class="list-unstyled footer-links">
                    <li class="mb-2"><a href="{{ route('home') }}" class="text-white text-decoration-none d-flex align-items-center"><i class="bi bi-chevron-right me-1"></i> Beranda</a></li>
                    <li class="mb-2"><a href="{{ route('product.catalog') }}" class="text-white text-decoration-none d-flex align-items-center"><i class="bi bi-chevron-right me-1"></i> Katalog</a></li>
                    <li class="mb-2"><a href="{{ route('about.us') }}" class="text-white text-decoration-none d-flex align-items-center"><i class="bi bi-chevron-right me-1"></i> Tentang Kami</a></li>
                    <li class="mb-2"><a href="{{ route('ongkos.kirim') }}" class="text-white text-decoration-none d-flex align-items-center"><i class="bi bi-chevron-right me-1"></i> Ongkos Kirim</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-6 col-6">
                <h6 class="fw-bold mb-3">Kategori Produk</h6>
                <ul class="list-unstyled footer-links">
                    @forelse ($categories as $category)
                        <li class="mb-2">
                            <a href="{{ route('product.catalog', ['category' => $category->name]) }}" class="text-white text-decoration-none d-flex align-items-center">
                                <i class="bi bi-chevron-right me-1"></i> {{ $category->name }}
                            </a>
                        </li>
                    @empty
                        <li class="mb-2"><span class="opacity-75">Belum ada kategori.</span></li>
                    @endforelse
                </ul>
            </div>

            <div class="col-lg-3 col-md-6">
                <h6 class="fw-bold mb-3">Hubungi Kami</h6>
                <ul class="list-unstyled footer-links">
                    <li class="mb-3 d-flex align-items-start">
                        <i class="bi bi-telephone-fill me-2 mt-1"></i>
                        <div>
                            <a href="tel:+6281234567890" class="text-white text-decoration-none d-block">+62 812-3456-7890</a>
                            <small class="opacity-75">Senin - Minggu: 08.00 - 20.00</small>
                        </div>
                    </li>
                    <li class="mb-3 d-flex align-items-center">
                        <i class="bi bi-envelope-fill me-2"></i>
                        <a href="mailto:info@loccoflorist.com" class="text-white text-decoration-none">info@loccoflorist.com</a>
                    </li>
                    <li class="d-flex align-items-center">
                        <i class="bi bi-whatsapp me-2"></i>
                        <a href="https://wa.me/6281234567890" target="_blank" class="text-white text-decoration-none">Chat WhatsApp</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="row mt-4 pt-4 border-top border-white border-opacity-25">
            <div class="col-lg-6">
                <h6 class="fw-bold mb-3">Metode Pembayaran</h6>
                <div class="d-flex flex-wrap gap-2">
                    <div class="bg-white rounded px-3 py-2">
                        <img src="{{ asset('assets/images/bca.png') }}" alt="BCA" class="payment-logo">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="border-top border-white border-opacity-25">
        <div class="container py-3 text-center">
            <p class="mb-0 opacity-90 small">&copy; {{ date('Y') }} <strong>Locco Florist</strong>. All Rights Reserved.</p>
        </div>
    </div>
</footer>