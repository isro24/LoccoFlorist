@extends('layouts.admin')

@section('title', 'Tambah Kategori')

@section('content')

<div class="container mx-auto px-4">
    <h2 class="text-3xl font-bold text-black mb-6">Tambah Kategori</h2>

    <div class="bg-white shadow-sm rounded-lg overflow-hidden max-w-3xl mx-auto">
        <div class="p-8">

            <form action="{{ route('admin.category.store') }}" method="POST">
                @csrf

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
                        <ul class="list-disc ml-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="grid grid-cols-1 gap-6">

                    <x-form.input 
                        name="name" 
                        label="Nama Kategori" 
                        required
                        value="{{ old('name') }}"
                        oninvalid="this.setCustomValidity('Mohon masukkan nama kategori')"
                        oninput="this.setCustomValidity('')" 
                    />

                    <x-form.select 
                        name="type" 
                        label="Tipe Kategori" 
                        required
                        oninvalid="this.setCustomValidity('Mohon pilih tipe kategori')"
                        oninput="this.setCustomValidity('')"
                    >
                        <option value="">Pilih Tipe</option>
                        <option value="bunga" {{ old('type') == 'bunga' ? 'selected' : '' }}>Bunga</option>
                        <option value="banner" {{ old('type') == 'banner' ? 'selected' : '' }}>Banner</option>
                        <option value="papan" {{ old('type') == 'papan' ? 'selected' : '' }}>Sewa Papan</option>
                    </x-form.select>

                </div>

                <div class="mt-8 flex justify-end gap-3">
                    <a href="{{ route('admin.category.index') }}" 
                        class="px-5 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition no-underline">
                        Batal
                    </a>

                    <button type="submit" 
                        class="px-5 py-2 bg-pinkButton text-white font-semibold rounded-lg hover:opacity-90 transition cursor-pointer">
                        Simpan
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection
