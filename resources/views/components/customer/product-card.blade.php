@props(['product', 'delay' => 0])

<div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-6" data-aos="fade-up" data-aos-delay="{{ $delay }}">
    <div class="card border-0 shadow-sm h-100 product-card">
        <a href="{{ route('product.show', $product->id) }}" class="text-decoration-none text-dark">
            <div class="position-relative overflow-hidden rounded-top">
                <div class="ratio ratio-1x1">
                    <img 
                        src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/400' }}" 
                        class="card-img-top object-fit-cover product-img" 
                        alt="{{ $product->name }}" 
                        loading="lazy">
                </div>

                <span class="position-absolute top-0 end-0 m-2 badge rounded-pill shadow-sm badge-pink">
                    {{ $product->category->name ?? 'Umum' }}
                </span>
            </div>

            <div class="card-body text-center p-3">
                <h6 class="card-title fw-bold text-dark mb-2 text-truncate" title="{{ $product->name }}">
                    {{ $product->name }}
                </h6>
                <p class="mb-2 fw-bold text-pink">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                </p>
                <span class="btn btn-sm text-white w-100 rounded-pill shadow-sm hover-button btn-gradient-pink">
                    <i class="me-1"></i> Detail Produk
                </span>
            </div>
        </a>
    </div>
</div>
