@extends('layouts.admin')

@section('title', 'Edit Produk: ' . $product->name)

@section('content')

<div class="container mx-auto px-4">
    <h2 class="text-3xl font-bold text-black mb-6">Edit Produk</h2>

    <div class="bg-white shadow-sm rounded-lg overflow-hidden max-w-4xl mx-auto">
        <div class="p-8">
            <form id="product-form" action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-form.input name="name" label="Nama Produk" :value="$product->name" required
                        oninvalid="this.setCustomValidity('Mohon masukkan nama produk')" 
                        oninput="this.setCustomValidity('')" />

                    <x-form.select name="category_id" label="Kategori" required
                        oninvalid="this.setCustomValidity('Mohon pilih kategori produk')" 
                        oninput="this.setCustomValidity('')">
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </x-form.select>

                    <x-form.input type="number" name="price" label="Harga" :value="$product->price" required
                        oninvalid="this.setCustomValidity('Mohon masukkan harga produk')" 
                        oninput="this.setCustomValidity('')" />

                    <x-form.select name="status" label="Status" required
                        oninvalid="this.setCustomValidity('Mohon masukkan status produk')" 
                        oninput="this.setCustomValidity('')">
                        <option value="1" {{ old('status', $product->status) == 1 ? 'selected' : '' }}>Tersedia</option>
                        <option value="0" {{ old('status', $product->status) == 0 ? 'selected' : '' }}>Tidak tersedia</option>
                    </x-form.select>
                </div>

                <div class="mt-6">
                    <x-form.text-area name="description" label="Deskripsi" :value="$product->description" required
                        oninvalid="this.setCustomValidity('Mohon masukkan deskripsi produk')" 
                        oninput="this.setCustomValidity('')" />
                </div>

                <div class="mt-6">
                    <x-form.file-input name="image" label="Ganti Gambar Produk" accept="image/*">
                        @if($product->image)
                            <p class="text-xs text-gray-500 mb-1">Gambar saat ini:</p>
                            <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="mx-auto rounded shadow-sm max-h-52">
                        @endif
                    </x-form.file-input>
                </div>

                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Gambar Tambahan (opsional)
                    </label>

                    <input type="file" 
                        id="extra_images" 
                        name="extra_images[]" 
                        multiple 
                        accept="image/*"
                        class="block w-full text-sm border rounded-lg p-2">

                    @if ($product->images && $product->images->count())
                        <p class="text-xs text-gray-500 mt-2">Gambar tambahan saat ini:</p>
                        <div class="flex gap-3 flex-wrap mt-2">
                            @foreach ($product->images as $img)
                                <div class="relative">
                                    <img src="{{ Storage::url($img->image) }}" 
                                        class="w-24 h-24 object-cover rounded shadow">

                                    <button type="button"
                                        class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center delete-extra-image"
                                        data-id="{{ $img->id }}">
                                        &times;
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <div id="extraImagesPreview" class="flex flex-wrap gap-3 mt-3"></div>
                </div>

                <div class="mt-8 flex justify-end gap-3">
                    <a href="{{ route('admin.product.index') }}" 
                        class="px-5 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition no-underline">
                        Batal
                    </a>
                    <button type="submit" 
                        class="px-5 py-2 bg-pinkButton text-white font-semibold rounded-lg hover:opacity-90 transition cursor-pointer">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
    @vite('resources/js/admin/product.js')
@endpush
