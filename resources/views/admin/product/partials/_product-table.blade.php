<div class="bg-white/80 backdrop-blur-sm border border-pink-100 rounded-2xl shadow-[0_8px_25px_rgba(0,0,0,0.05)] transition-all duration-300 hover:shadow-[0_12px_35px_rgba(0,0,0,0.08)]">
    <div class="p-3 md:p-6">
        <div class="hidden md:block overflow-x-auto rounded-xl">
            <table id="product-table" class="w-full border-collapse text-center text-gray-700">
                <thead class="bg-pinkBg text-white">
                    <tr>
                        <th class="py-3 px-4 text-sm font-semibold uppercase tracking-wide">No</th>
                        <th class="py-3 px-4 text-sm font-semibold uppercase tracking-wide">Gambar</th>
                        <th class="py-3 px-4 text-sm font-semibold uppercase tracking-wide">Nama</th>
                        <th class="py-3 px-4 text-sm font-semibold uppercase tracking-wide">Kategori</th>
                        <th class="py-3 px-4 text-sm font-semibold uppercase tracking-wide">Harga</th>
                        <th class="py-3 px-4 text-sm font-semibold uppercase tracking-wide">Status</th>
                        <th class="py-3 px-4 text-sm font-semibold uppercase tracking-wide">Best Seller</th>
                        <th class="py-3 px-4 text-sm font-semibold uppercase tracking-wide">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-pink-50">
                    @forelse($products as $product)
                        <tr id="product-row-{{ $product->id }}" class="hover:bg-pink-50/50 transition-colors duration-300">
                            <td class="py-3 px-4 font-medium text-gray-600">{{ $products->firstItem() + $loop->index }}</td>
                            <td class="py-3 px-4">
                                @if($product->image)
                                    <div class="w-12 h-12 md:w-16 md:h-16 mx-auto rounded-xl overflow-hidden shadow-sm ring-1 ring-pink-100">
                                        <img src="/storage/{{ $product->image }}" alt="{{ $product->name }}" class="object-cover w-full h-full transition-transform duration-300 hover:scale-110">
                                    </div>
                                @else
                                    <span class="text-gray-400 italic">N/A</span>
                                @endif
                            </td>
                            <td class="py-3 px-4 font-semibold text-gray-800 text-sm md:text-base">{{ $product->name }}</td>
                            <td class="py-3 px-4 text-gray-600 text-sm md:text-base">{{ $product->category->name ?? '-' }}</td>
                            <td class="py-3 px-4 font-medium text-sm md:text-base">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td class="py-3 px-4">
                                @if($product->status)
                                    <span class="inline-flex items-center gap-1 bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs md:text-sm font-medium">
                                        <i class="bi bi-check-circle-fill text-base"></i> Tersedia
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 bg-gray-100 text-gray-600 px-2 py-1 rounded-full text-xs md:text-sm font-medium">
                                        <i class="bi bi-x-circle-fill text-base"></i> Tidak Tersedia
                                    </span>
                                @endif
                            </td>
                            <td class="py-3 px-4">
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="checkbox" class="sr-only peer toggle-best-seller" 
                                           data-id="{{ $product->id }}" 
                                           {{ $product->is_best_seller ? 'checked' : '' }}>
                                    <div class="relative w-9 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-pink-500"></div>
                                </label>
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex gap-1 justify-center flex-nowrap">
                                    <button 
                                        class="flex items-center justify-center gap-1 px-2 py-1 rounded-lg text-xs md:text-sm font-medium text-white bg-teal-500 hover:bg-teal-400 active:scale-95 transition-all duration-200 btn-detail" 
                                        data-id="{{ $product->id }}">
                                        <i class="bi bi-eye-fill"></i>
                                        <span class="hidden lg:inline-flex">Detail</span>
                                    </button>

                                    <a href="{{ route('admin.product.edit', $product->id) }}" 
                                    class="flex items-center justify-center gap-1 px-2 py-1 rounded-lg text-xs md:text-sm font-medium text-white bg-yellow-500 hover:bg-yellow-400 active:scale-95 transition-all duration-200">
                                        <i class="bi bi-pencil-fill"></i>
                                        <span class="hidden lg:inline-flex">Edit</span>
                                    </a>

                                    <button 
                                        class="btn-delete flex items-center justify-center gap-1 px-2 py-1 rounded-lg text-xs md:text-sm font-medium text-white bg-rose-500 hover:bg-rose-400 active:scale-95 transition-all duration-200" 
                                        data-id="{{ $product->id }}">
                                        <i class="bi bi-trash-fill"></i>
                                        <span class="hidden lg:inline-flex">Hapus</span>
                                    </button>
                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <div class="py-10 text-center bg-white/60 rounded-lg">
                                    <i class="bi bi-inbox text-4xl text-pink-300"></i>
                                    @if(request('search'))
                                        <p class="mt-3 text-gray-500">Produk dengan nama <strong>{{ request('search') }}</strong> tidak ditemukan.</p>
                                    @else
                                        <p class="mt-3 text-gray-500">Belum ada produk yang ditambahkan.</p>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="md:hidden grid grid-cols-2 gap-2">
            @forelse($products as $product)
                <div id="product-card-{{ $product->id }}" class="bg-white border border-pink-100 rounded-lg p-2 shadow-sm hover:shadow-md transition-shadow duration-200">
                    <div class="mb-2">
                        @if($product->image)
                            <div class="w-full aspect-square rounded-lg overflow-hidden shadow-sm ring-1 ring-pink-100">
                                <img src="/storage/{{ $product->image }}" alt="{{ $product->name }}" class="object-cover w-full h-full">
                            </div>
                        @else
                            <div class="w-full aspect-square rounded-lg bg-gray-100 flex items-center justify-center">
                                <i class="bi bi-image text-3xl text-gray-400"></i>
                            </div>
                        @endif
                    </div>

                    <h3 class="font-semibold text-gray-800 mb-1 text-xs line-clamp-2 min-h-8">{{ $product->name }}</h3>
                    <p class="text-[10px] text-gray-600 mb-1">{{ $product->category->name ?? '-' }}</p>
                    <p class="font-semibold mb-2 text-xs">Rp {{ number_format($product->price, 0, ',', '.') }}</p>

                    <div class="flex justify-between items-center mb-2 bg-gray-50 p-1 rounded">
                        @if($product->status)
                            <span class="text-[9px] text-green-700 font-medium flex items-center gap-1"><i class="bi bi-check-circle-fill"></i> Ada</span>
                        @else
                            <span class="text-[9px] text-gray-600 font-medium flex items-center gap-1"><i class="bi bi-x-circle-fill"></i> Kosong</span>
                        @endif

                        <label class="inline-flex items-center cursor-pointer scale-75 origin-right" title="Jadikan Best Seller">
                            <input type="checkbox" class="sr-only peer toggle-best-seller" 
                                   data-id="{{ $product->id }}" 
                                   {{ $product->is_best_seller ? 'checked' : '' }}>
                            <div class="relative w-9 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-pink-500"></div>
                            <span class="ms-1 text-[10px] text-gray-500 peer-checked:text-pink-600 font-bold"><i class="bi bi-star-fill"></i></span>
                        </label>
                    </div>

                    <div class="flex gap-1">
                        <button class="flex-1 flex items-center justify-center gap-1 px-1 py-1 rounded text-[9px] font-medium text-white bg-teal-500 hover:bg-teal-400 active:scale-95 transition-all duration-200 btn-detail" data-id="{{ $product->id}}" title="Detail"><i class="bi bi-eye-fill"></i></button>
                        <a href="{{ route('admin.product.edit', $product->id) }}" class="flex-1 flex items-center justify-center gap-1 px-1 py-1 rounded text-[9px] font-medium text-white bg-yellow-500 hover:bg-yellow-400 active:scale-95 transition-all duration-200" title="Edit"><i class="bi bi-pencil-fill"></i></a>
                        <button class="btn-delete flex-1 flex items-center justify-center gap-1 px-1 py-1 rounded text-[9px] font-medium text-white bg-rose-500 hover:bg-rose-400 active:scale-95 transition-all duration-200" data-id="{{ $product->id}}" title="Hapus"><i class="bi bi-trash-fill"></i></button>
                    </div>
                </div>
            @empty
                <div class="col-span-2 py-10 text-center bg-white/60 rounded-lg">
                    <i class="bi bi-inbox text-4xl text-pink-300"></i>
                    @if(request('search'))
                        <p class="mt-3 text-gray-500">Produk dengan nama <strong>{{ request('search') }}</strong> tidak ditemukan.</p>
                    @else
                        <p class="mt-3 text-gray-500">Belum ada produk yang ditambahkan.</p>
                    @endif
                </div>
            @endforelse
        </div>
    </div>
</div>
