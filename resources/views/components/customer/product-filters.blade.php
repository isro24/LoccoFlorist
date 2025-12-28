@props(['categories', 'layout' => 'desktop'])

@if ($layout === 'desktop')
    <div class="flex items-center gap-4 font-serif">
        <div class="relative">
            <select name="category" 
                    class="appearance-none bg-white border border-gray-200 rounded-full px-4 py-2 pr-10 shadow-sm font-medium cursor-pointer transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-pink-300 focus:border-pink-400"
                    onchange="this.form.submit()">
                <option value="">Semua Kategori</option>
                @foreach($categories as $category)
                    <option value="{{ $category->slug }}" @selected(request('category') == $category->slug)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            <i class="bi bi-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
        </div>

        <div class="relative">
            <select name="sort" 
                class="appearance-none bg-white border border-gray-200 rounded-full px-4 py-2 pr-10 shadow-sm font-medium cursor-pointer transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-pink-300 focus:border-pink-400"
                onchange="this.form.submit()">
                <option value="latest" @selected(request('sort') == 'latest' || !request('sort'))>Terbaru</option>
                <option value="price_asc" @selected(request('sort') == 'price_asc')>Harga Terendah</option>
                <option value="price_desc" @selected(request('sort') == 'price_desc')>Harga Tertinggi</option>
            </select>
            <i class="bi bi-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
        </div>
    </div>
@else
    <div class="space-y-4 font-serif">
        <div>
            <label class="font-semibold text-gray-700">Kategori</label>
            <select name="category" class="w-full border border-gray-200 rounded-lg px-4 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-300 focus:border-pink-400"
                    onchange="this.form.submit()">
                <option value="">Semua Kategori</option>
                @foreach($categories as $category)
                    {{-- PERUBAHAN DI SINI JUGA: value pakai slug --}}
                    <option value="{{ $category->slug }}" @selected(request('category') == $category->slug)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="font-semibold text-gray-700">Urutkan</label>
            <select name="sort" class="w-full border border-gray-200 rounded-lg px-4 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-300 focus:border-pink-400"
                    onchange="this.form.submit()">
                <option value="latest" @selected(request('sort') == 'latest' || !request('sort'))>Terbaru</option>
                <option value="price_asc" @selected(request('sort') == 'price_asc')>Harga Terendah</option>
                <option value="price_desc" @selected(request('sort') == 'price_desc')>Harga Tertinggi</option>
            </select>
        </div>
    </div>
@endif