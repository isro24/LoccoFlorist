<div class="bg-white shadow-sm rounded-lg flex flex-col h-full">
    <div class="px-4 py-3 border-b border-gray-100">
        <h5 class="font-semibold text-gray-800 flex items-center gap-2 text-lg">
            <i class="bi bi-pie-chart text-pinkColor"></i> Produk per Kategori
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
                    <div class="h-2 rounded-full bg-linear-to-r from-pinkColor to-darkPinkColor" 
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
