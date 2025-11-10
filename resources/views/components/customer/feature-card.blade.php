@props([
    'icon',
    'title',
    'description',
    'delay' => 0
])

<div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $delay }}">
    <div class="card border-0 shadow-sm h-100 hover-lift text-center p-4">
        <div class="mb-3 fs-1">{{ $icon }}</div>
        <h5 class="fw-bold mb-2">{{ $title }}</h5>
        <p class="text-muted small mb-0">{{ $description }}</p>
    </div>
</div>