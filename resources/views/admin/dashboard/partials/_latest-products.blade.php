<div class="bg-white shadow-sm rounded-lg h-full flex flex-col">
    <div class="flex justify-between items-center px-6 py-4">
        <h5 class="flex items-center font-semibold text-gray-800 text-lg gap-2">
            <i class="bi bi-clock-history text-pinkText"></i> Produk Terbaru
        </h5>
        <a href="{{ route('admin.product.index') }}" 
           class="text-sm font-medium px-3 py-1.5 border border-gray-300 rounded-full hover:bg-gray-100 active:scale-95 transition-all duration-200 flex items-center gap-1">
            Lihat Semua <i class="bi bi-arrow-right"></i>
        </a>
    </div>

    <div class="overflow-x-auto grow rounded-b-2xl">
        <table class="w-full border-collapse text-left text-gray-700">
            <thead class="bg-pinkBg text-white">
                <tr>
                    <th class="py-3 px-4 text-sm font-semibold uppercase tracking-wide">Gambar</th>
                    <th class="py-3 px-4 text-sm font-semibold uppercase tracking-wide">Nama</th>
                    <th class="py-3 px-4 text-sm font-semibold uppercase tracking-wide">Kategori</th>
                    <th class="py-3 px-4 text-sm font-semibold uppercase tracking-wide">Harga</th>
                    <th class="py-3 px-4 text-sm font-semibold uppercase tracking-wide text-center">Status</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-pink-50">
                @forelse($latestProducts as $product)
                    <tr class="hover:bg-pink-50/50 transition-colors duration-300">
                        <td class="py-3 px-4">
                            @if($product->image)
                                <div class="w-12 h-12 rounded-xl overflow-hidden shadow-sm ring-1 ring-pink-100">
                                    <img src="{{ asset('storage/' . $product->image) }}" 
                                         alt="{{ $product->name }}" 
                                         class="object-cover w-full h-full transition-transform duration-300 hover:scale-110">
                                </div>
                            @else
                                <span class="text-gray-400 italic">N/A</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 font-semibold text-gray-800">{{ Str::limit($product->name, 30) }}</td>
                        <td class="py-3 px-4 text-gray-600">{{ $product->category->name ?? '-' }}</td>
                        <td class="py-3 px-4 font-medium">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </td>
                        <td class="py-3 px-4 text-center">
                            @if($product->status)
                                <span class="inline-flex items-center gap-1 bg-green-100 text-green-700 px-3 py-1.5 rounded-full text-xs font-semibold">
                                    <i class="bi bi-check-circle-fill text-base"></i> Tersedia
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 bg-gray-100 text-gray-600 px-3 py-1.5 rounded-full text-xs font-semibold">
                                    <i class="bi bi-x-circle-fill text-base"></i> Tidak
                                </span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            <div class="py-10 text-center bg-white/60 rounded-lg">
                                <i class="bi bi-inbox text-4xl text-pink-300"></i>
                                <p class="mt-3 text-gray-500">Belum ada produk</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
