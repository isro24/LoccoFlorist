@extends('layouts.admin')

@section('title', 'Tambah Produk Baru')

@section('content')

<div class="container mx-auto px-4">
    <h2 class="text-3xl font-bold text-black mb-6">Tambah Produk Baru</h2>

    <div class="bg-white shadow-sm rounded-lg overflow-hidden max-w-4xl mx-auto">
        <div class="p-8">
            <form id="product-form" action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <x-form.input name="name" label="Nama Produk" required 
                        oninvalid="this.setCustomValidity('Mohon masukkan nama produk')" 
                        oninput="this.setCustomValidity('')" />

                    <x-form.select name="category_id" label="Kategori" required
                        oninvalid="this.setCustomValidity('Mohon pilih kategori produk')" 
                        oninput="this.setCustomValidity('')">
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </x-form.select>

                    <x-form.input type="number" name="price" label="Harga" required
                        oninvalid="this.setCustomValidity('Mohon masukkan harga produk')" 
                        oninput="this.setCustomValidity('')" />

                    <x-form.select name="status" label="Status" required
                        oninvalid="this.setCustomValidity('Mohon masukkan status produk')" 
                        oninput="this.setCustomValidity('')">
                        <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>Tersedia</option>
                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Tidak tersedia</option>
                    </x-form.select>
                    

                </div>

                <div class="mt-6">
                    <x-form.text-area name="description" label="Deskripsi" required
                        oninvalid="this.setCustomValidity('Mohon masukkan deskripsi produk')" 
                        oninput="this.setCustomValidity('')" />
                </div>

                <div class="mt-6">
                    <x-form.file-input name="image" label="Gambar Produk" accept="image/*" required
                        oninvalid="this.setCustomValidity('Mohon masukkan gambar produk')" 
                        oninput="this.setCustomValidity('')" />
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

                    <div id="extraImagesPreview" class="flex flex-wrap gap-3 mt-3"></div>
                </div>

                <div class="mt-8 flex justify-end gap-3">
                    <a href="{{ route('admin.product.index') }}" 
                        class="px-5 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition no-underline">
                        Batal
                    </a>
                    <button type="submit" 
                        class="px-5 py-2 bg-pinkButton text-white font-semibold rounded-lg hover:opacity-90 transition cursor-pointer">
                        Simpan Produk
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
