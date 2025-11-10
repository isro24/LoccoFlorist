@props([
    'action' => '#',
    'value' => '',
    'placeholder' => 'Cari produk...',
])

<div class="text-center mb-5" data-aos="fade-up">
    <div class="mx-auto" style="max-width: 600px;">
        <form action="{{ $action }}" method="GET">
            <div class="input-group search-bar-custom">
                <span class="input-group-text"><i class="bi bi-search text-muted"></i></span>
                <input type="text" name="search" value="{{ $value }}" 
                    class="form-control" placeholder="{{ $placeholder }}">
                <button class="btn btn-primary-pink" type="submit">
                    <span class="fw-semibold">Cari</span>
                </button>
            </div>
        </form>
    </div>
</div>
