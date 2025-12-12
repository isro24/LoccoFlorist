@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container-fluid px-4">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4 gap-2">
        <div>
            <h2 class="text-2xl font-bold text-black mb-1">Dashboard</h2>
            <p class="text-gray-500">Selamat datang kembali, {{ Auth::user()->name }}! 👋</p>
        </div>
        <div class="text-gray-500 flex items-center gap-1">
            <i class="bi bi-calendar3"></i> {{ now()->isoFormat('dddd, D MMMM Y') }}
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4 mb-4">
        <x-admin.stat-card 
            title="Total Produk"
            :value="$totalProducts"
            icon="bi-box-seam"
            badgeText="<i class='bi bi-arrow-up'></i> Semua Produk"
            color="primary"
        />
        <x-admin.stat-card 
            title="Produk Tersedia"
            :value="$activeProducts"
            icon="bi-check-circle"
            :badgeText="'<i class=\'bi bi-graph-up\'></i> ' . ($totalProducts > 0 ? round(($activeProducts / $totalProducts) * 100) : 0) . '%'"
            color="success"
        />
        <x-admin.stat-card 
            title="Produk Tidak Tersedia"
            :value="$inactiveProducts"
            icon="bi-pause-circle"
            :badgeText="'<i class=\'bi bi-graph-down\'></i> ' . ($totalProducts > 0 ? round(($inactiveProducts / $totalProducts) * 100) : 0) . '%'"
            color="warning"
        />
        <x-admin.stat-card 
            title="Total Kategori"
            :value="$totalCategories"
            icon="bi-grid-3x3-gap"
            badgeText="<i class='bi bi-tags'></i> Kategori Aktif"
            color="info"
        />
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-8 gap-4 mb-4">
        <div class="lg:col-span-5">
            @include('admin.dashboard.partials._latest-products', ['latestProducts' => $latestProducts])
        </div>

        <div class="lg:col-span-3">
            @include('admin.dashboard.partials._products-by-category', [
                'productsByCategory' => $productsByCategory,
                'totalProducts' => $totalProducts
            ])
        </div>
    </div>
</div>
@endsection
