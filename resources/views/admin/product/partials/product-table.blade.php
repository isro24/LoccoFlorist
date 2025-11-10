<div class="bg-white rounded-xl shadow-md">
    <div class="p-4">
        <div class="overflow-x-auto w-full">
            <table class="md-w-full md:table-auto border-collapse divide-y divide-gray-200 text-center">
                <thead class="bg-gray-600 text-white">
                    <tr>
                        <th class="py-2 px-4">No</th>
                        <th class="py-2 px-4">Gambar</th>
                        <th class="py-2 px-4">Nama</th>
                        <th class="py-2 px-4">Kategori</th>
                        <th class="py-2 px-4">Harga</th>
                        <th class="py-2 px-4">Status</th>
                        <th class="py-2 px-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr id="product-row-{{ $product->id }}" class="bg-white rounded-lg">
                            <td class="py-2 px-4">{{ $products->firstItem() + $loop->index }}</td>
                            <td class="py-2 px-4">
                                @if($product->image)
                                    <img src="/storage/{{ $product->image }}" alt="{{ $product->name }}" class="w-16 h-16 rounded-lg object-cover mx-auto">
                                @else
                                    <span class="text-gray-400 italic">N/A</span>
                                @endif
                            </td>
                            <td class="py-2 px-4 font-semibold">{{ $product->name }}</td>
                            <td class="py-2 px-4">{{ $product->category->name ?? '-' }}</td>
                            <td class="py-2 px-4">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td class="py-2 px-4">
                                @if($product->status)
                                    <span class="inline-block bg-green-500 text-white px-3 py-1 rounded-full text-sm">Tersedia</span>
                                @else
                                    <span class="inline-block bg-gray-400 text-white px-3 py-1 rounded-full text-sm">Tidak Tersedia</span>
                                @endif
                            </td>
                            <td class="py-2 px-4">
                                <div class="flex gap-2 justify-center">
                                    <button class="px-2 py-1 bg-teal-500 text-white rounded-lg text-sm flex items-center gap-1 btn-detail cursor-pointer" data-id="{{ $product->id }}">
                                        <i class="bi bi-eye-fill"></i> Detail
                                    </button>

                                    <a href="{{ route('admin.product.edit', $product->id) }}" class="px-2 py-1 bg-yellow-500 text-white rounded-lg text-sm flex items-center gap-1 no-underline">
                                        <i class="bi bi-pencil-fill"></i> Edit
                                    </a>
                                    <button class="px-2 py-1 bg-red-500 text-white rounded-lg text-sm flex items-center gap-1 btn-delete cursor-pointer" data-id="{{ $product->id }}">
                                        <i class="bi bi-trash-fill"></i> Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <div class="py-8 text-center bg-white rounded-lg">
                                    <i class="bi bi-inbox text-3xl text-pink-200"></i>
                                    @if(request('search'))
                                        <p class="mt-2 text-gray-400">Produk dengan nama <strong>{{ request('search') }}</strong> tidak ditemukan.</p>
                                    @else
                                        <p class="mt-2 text-gray-400">Belum ada produk yang ditambahkan.</p>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>