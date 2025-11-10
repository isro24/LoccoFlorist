@props(['categories', 'layout' => 'desktop'])

@if ($layout == 'desktop')
    <select name="category" class="form-select rounded-pill shadow-sm custom-select"
            onchange="this.form.submit()">
        <option value="">Semua Kategori</option>
        @foreach($categories as $category)
            <option value="{{ $category->name }}" @selected(request('category') == $category->name)>
                {{ $category->name }}
            </option>
        @endforeach
    </select>

    <select name="sort" class="form-select rounded-pill shadow-sm custom-select"
            onchange="this.form.submit()">
        <option value="latest" @selected(request('sort') == 'latest' || !request('sort'))>Terbaru</option>
        <option value="price_asc" @selected(request('sort') == 'price_asc')>Harga Terendah</option>
        <option value="price_desc" @selected(request('sort') == 'price_desc')>Harga Tertinggi</option>
    </select>
@else
    <div class="mb-3">
        <label class="form-label fw-semibold">Kategori</label>
        <select name="category" class="form-select" onchange="this.form.submit()">
            <option value="">Semua Kategori</option>
            @foreach($categories as $category)
                <option value="{{ $category->name }}" @selected(request('category') == $category->name)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="form-label fw-semibold">Urutkan</label>
        <select name="sort" class="form-select" onchange="this.form.submit()">
            <option value="latest" @selected(request('sort') == 'latest' || !request('sort'))>Terbaru</option>
            <option value="price_asc" @selected(request('sort') == 'price_asc')>Harga Terendah</option>
            <option value="price_desc" @selected(request('sort') == 'price_desc')>Harga Tertinggi</option>
        </select>
    </div>
@endif