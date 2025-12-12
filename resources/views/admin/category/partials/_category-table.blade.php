<div class="bg-white/80 backdrop-blur-sm border border-pink-100 rounded-2xl shadow-[0_8px_25px_rgba(0,0,0,0.05)] transition-all duration-300 hover:shadow-[0_12px_35px_rgba(0,0,0,0.08)]">
    <div class="p-3 md:p-6">

        <div class="overflow-x-auto rounded-xl">
            <table class="w-full border-collapse text-center text-gray-700">
                <thead class="bg-pinkBg text-white">
                    <tr>
                        <th class="py-3 px-4 text-sm font-semibold uppercase tracking-wide">No</th>
                        <th class="py-3 px-4 text-sm font-semibold uppercase tracking-wide">Nama Kategori</th>
                        <th class="py-3 px-4 text-sm font-semibold uppercase tracking-wide">Tipe</th>
                        <th class="py-3 px-4 text-sm font-semibold uppercase tracking-wide">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-pink-50">

                    @forelse($categories as $category)
                        <tr id="category-row-{{ $category->id }}" class="hover:bg-pink-50/50 transition-colors duration-300">
                            <td class="py-3 px-4 font-medium text-gray-600">
                                {{ $categories->firstItem() + $loop->index }}
                            </td>

                            <td class="py-3 px-4 font-semibold text-gray-800">
                                {{ $category->name }}
                            </td>

                            <td class="py-3 px-4 text-gray-600 capitalize">
                                {{ $category->type }}
                            </td>

                            <td class="py-3 px-4">
                                <div class="flex gap-1 justify-center">

                                    <a href="{{ route('admin.category.edit', $category->id) }}"
                                       class="flex items-center justify-center gap-1 px-2 py-1 rounded-lg text-xs md:text-sm font-medium text-white bg-yellow-500 hover:bg-yellow-400 active:scale-95 transition-all duration-200">
                                       <i class="bi bi-pencil-fill"></i>
                                       <span class="hidden lg:inline">Edit</span>
                                    </a>

                                    <button 
                                        class="btn-delete flex items-center justify-center gap-1 px-2 py-1 rounded-lg text-xs md:text-sm font-medium text-white bg-rose-500 hover:bg-rose-400 active:scale-95 transition-all duration-200"
                                        data-id="{{ $category->id }}">
                                        <i class="bi bi-trash-fill"></i>
                                        <span class="hidden lg:inline">Hapus</span>
                                    </button>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">
                                <div class="py-10 text-center bg-white/60 rounded-lg">
                                    <i class="bi bi-inbox text-4xl text-pink-300"></i>

                                    @if(request('search'))
                                        <p class="mt-3 text-gray-500">
                                            Kategori dengan nama <strong>{{ request('search') }}</strong> tidak ditemukan.
                                        </p>
                                    @else
                                        <p class="mt-3 text-gray-500">Belum ada kategori yang ditambahkan.</p>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

        @if($categories->hasPages())
            <div class="mt-6 flex justify-center">
                {{ $categories->links('pagination::tailwind') }}
            </div>
        @endif

    </div>
</div>
