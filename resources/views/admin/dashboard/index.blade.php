@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container-fluid px-4">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4 gap-2">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 mb-1">Dashboard</h2>
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
            <div class="bg-white shadow-sm rounded-lg h-full flex flex-col">
                <div class="flex justify-between items-center px-4 py-3 border-b border-gray-100">
                    <h5 class="flex items-center font-semibold text-gray-800 text-lg gap-2">
                        <i class="bi bi-clock-history text-pink-500"></i> Produk Terbaru
                    </h5>
                    <a href="{{ route('admin.product.index') }}" class="text-sm font-medium px-3 py-1.5 border border-gray-300 rounded-full hover:bg-gray-50 transition">
                        Lihat Semua <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                <div class="overflow-x-auto grow">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Gambar</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Nama</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Kategori</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Harga</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @forelse($latestProducts as $product)
                            <tr class="hover:bg-pink-50 transition-colors">
                                <td class="px-4 py-2">
                                    <img src="{{ asset('storage/' . $product->image) }}" 
                                         alt="{{ $product->name }}" 
                                         class="w-12 h-12 rounded object-cover">
                                </td>
                                <td class="px-4 py-2 font-semibold">{{ Str::limit($product->name, 30) }}</td>
                                <td class="px-4 py-2">{{ $product->category->name ?? '-' }}</td>
                                <td class="px-4 py-2 text-pink-400 font-semibold">Rp {{ number_format($product->price,0,',','.') }}</td>
                                <td class="px-4 py-2">
                                    @if($product->status)
                                        <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Tersedia</span>
                                    @else
                                        <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Tidak Tersedia</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="py-6 text-center text-gray-400">
                                    <i class="bi bi-inbox fs-1 mb-2 d-block"></i>
                                    Belum ada produk
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="lg:col-span-3">
            <div class="bg-white shadow-sm rounded-lg flex flex-col h-full">
                <div class="px-4 py-3 border-b border-gray-100">
                    <h5 class="font-semibold text-gray-800 flex items-center gap-2 text-lg">
                        <i class="bi bi-pie-chart text-blue-400"></i> Produk per Kategori
                    </h5>
                </div>
                <div class="p-4 flex flex-col gap-3">
                    @forelse($productsByCategory as $category)
                    <div>
                        <div class="flex justify-between items-center mb-1">
                            <span class="text-sm font-semibold text-gray-700">{{ $category->name }}</span>
                            <span class="px-2 py-0.5 rounded-full text-xs bg-blue-100 text-blue-700">{{ $category->products_count }}</span>
                        </div>
                        <div class="w-full h-2 bg-gray-200 rounded-full">
                            <div class="h-2 rounded-full bg-gradient-to-r from-pink-400 to-pink-600" 
                                 style="width: {{ $totalProducts > 0 ? ($category->products_count / $totalProducts) * 100 : 0 }}%">
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="py-6 text-center text-gray-400">
                        <i class="bi bi-folder-x fs-1 mb-2 d-block"></i>
                        Belum ada kategori
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
