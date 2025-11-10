@extends('layouts.admin')

@section('title', 'Tambah Produk Baru')

@section('content')
<div>
    <h2 class="text-2xl font-bold text-pink-600 mb-4">Tambah Produk Baru</h2>
</div>

<div class="bg-white rounded-xl shadow-md overflow-hidden">
    <div class="p-6">
        <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

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

            <x-form.text-area name="description" label="Deskripsi" required
                oninvalid="this.setCustomValidity('Mohon masukkan deskripsi produk')" 
                oninput="this.setCustomValidity('')" />

            <x-form.file-input name="image" label="Gambar Produk" accept="image/*" required
                oninvalid="this.setCustomValidity('Mohon masukkan gambar produk')" 
                oninput="this.setCustomValidity('')" />

            <div class="mt-6 flex justify-end gap-3">
                <a href="{{ route('admin.product.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition no-underline">Batal</a>
                <button type="submit" class="px-4 py-2 bg-linier-to-r from-pink-400 to-pink-600 text-white font-semibold rounded-lg hover:opacity-90 transition">Simpan Produk</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
    @vite('resources/js/admin/product.js')
@endpush