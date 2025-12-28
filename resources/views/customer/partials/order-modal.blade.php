<div id="orderModalBackdrop" class="fixed inset-0 bg-black/50 z-[1050] hidden opacity-0 transition-opacity duration-300 ease-in-out"></div>

<div id="orderModal" tabindex="-1" aria-hidden="true" 
    class="fixed inset-0 z-[1100] hidden flex items-center justify-center p-4 opacity-0 scale-95 transition-all duration-300 ease-out">

    <div class="relative w-full max-w-4xl bg-white rounded-[2rem] border-none backdrop-blur-lg shadow-2xl flex flex-col max-h-[90vh]">

        <div class="flex-shrink-0 flex justify-between items-center md:grid md:grid-cols-3 px-4 py-3 md:p-5 border-b border-pink-100 bg-pinkButton text-white rounded-t-2xl md:rounded-t-[2rem]">
            <div class="hidden md:block"></div>
            <div class="text-left md:text-center">
                <h3 class="text-base md:text-xl font-bold font-serif tracking-wide leading-tight">
                    Formulir Pemesanan
                </h3>
                <p class="text-[10px] md:text-xs text-white/90 font-light leading-tight mt-0.5 md:mt-1">
                    Langkah terakhir sebelum ke WhatsApp
                </p>
            </div>
            <button id="closeOrderModalBtn"
                class="w-7 h-7 md:w-8 md:h-8 flex items-center justify-center rounded-full bg-white/20 hover:bg-white/40 text-white transition duration-200 md:justify-self-end">
                <i class="bi bi-x-lg text-xs md:text-sm"></i>
            </button>
        </div>

        <div class="p-6 md:p-10 overflow-y-auto custom-scrollbar">

            <div class="flex items-center gap-4 mb-8 bg-pink-50 p-4 rounded-2xl border border-pink-100 relative">
                @if($product->is_best_seller)
                    <div class="absolute -top-3 -right-3 bg-pink-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-md flex items-center gap-1 z-10">
                        <i class="bi bi-star-fill text-[10px] text-yellow-300"></i> Best Seller
                    </div>
                @endif
                <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/no-image.png') }}" 
                     alt="{{ $product->name }}" 
                     class="w-16 h-16 object-cover rounded-xl border-2 border-white shadow-sm">
                <div>
                    <p class="text-xs text-pinkText font-bold uppercase tracking-wider mb-1">{{ $product->category->name ?? 'Produk' }}</p>
                    <h4 class="font-serif text-lg font-bold text-gray-800 leading-tight">{{ $product->name }}</h4>
                </div>
            </div>
            <form action="{{ route('order.send') }}" method="POST" id="orderForm"> 
                @csrf
                <input type="hidden" name="nama_produk" value="{{ $product->name }}">
                <input type="hidden" id="categoryType" name="type" value="{{ strtolower($product->category->type ?? '') }}">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div class="col-span-1">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Nama Pemesan</label>
                        <input value="{{ old('name') }}" type="text" name="name" class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3 px-4 focus:ring-2 focus:ring-pinkButton focus:border-transparent transition" required placeholder="Nama Anda (Contoh: Safina)">
                    </div>

                    <div class="col-span-1" id="receiverNameContainer">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Nama Penerima</label>
                        <input value="{{ old('receiver_name') }}" type="text" name="receiver_name" id="receiver_name_input" class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3 px-4 focus:ring-2 focus:ring-pinkButton focus:border-transparent transition" placeholder="Nama Penerima (Contoh: Mutiara)">
                    </div>

                    <div class="col-span-1" id="receiverPhoneContainer">
                        <label class="block text-sm font-bold text-gray-700 mb-2">
                            WhatsApp Penerima
                        </label>

                        <input type="text"
                            name="receiver_phone"
                            id="receiver_phone_input"
                            value="{{ old('receiver_phone') }}"
                            class="w-full bg-gray-50 border rounded-xl py-3 px-4
                                focus:ring-2 focus:ring-pinkButton focus:border-transparent transition
                                {{ $errors->has('receiver_phone') ? 'border-red-500 bg-red-50' : 'border-gray-200' }}"
                            placeholder="08xxxxxxxxxx">

                        @error('receiver_phone')
                            <p class="text-xs text-red-600 mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="col-span-1 grid grid-cols-2 gap-3">
                        <div>
                            <label for="delivery_date" class="block text-sm font-bold text-gray-700 mb-2">Tanggal </span> <span id="labelDateAction">Kirim</span></label>
                            <div class="relative">
                                <input value="{{ old('delivery_date') }}" type="date" id="delivery_date" name="delivery_date" class="w-full bg-gray-50 border rounded-xl py-3 px-4 pl-10 focus:ring-2 focus:ring-pinkButton focus:border-transparent transition {{ $errors->has('delivery_date') ? 'border-red-500 bg-red-50' : 'border-gray-200' }}" required placeholder="Tanggal">
                                <i class="bi bi-calendar-event absolute left-3 top-3.5 text-gray-400"></i>
                            </div>

                            @error('delivery_date')
                                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="delivery_time" class="block text-sm font-bold text-gray-700 mb-2">Jam </span> <span id="labelTimeAction">Kirim</span></label>
                            <div class="relative">
                                <input value="{{ old('delivery_time') }}" type="time" id="delivery_time" name="delivery_time" class="w-full bg-gray-50 border rounded-xl py-3 px-4 pl-10 focus:ring-2 focus:ring-pinkButton focus:border-transparent transition {{ $errors->has('delivery_time') ? 'border-red-500 bg-red-50' : 'border-gray-200' }}" required placeholder="Jam">
                                <i class="bi bi-clock absolute left-3 top-3.5 text-gray-400"></i>
                            </div>

                            @error('delivery_time')
                                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div id="bannerSpecificFields" class="col-span-1 md:col-span-2 hidden grid grid-cols-1 md:grid-cols-2 gap-4 border-2 border-[#ffe4ef] p-5 rounded-2xl bg-white mb-2">
                        <div class="col-span-1 md:col-span-2">
                            <h6 class="font-bold text-pinkButton mb-2 flex items-center gap-2">
                                <i class="bi bi-gear-fill"></i> Konfigurasi Banner
                            </h6>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Pilih Paket Jasa</label>
                            <select name="banner_option" id="banner_option" class="w-full border-gray-200 rounded-xl focus:ring-pinkButton focus:border-pinkButton">
                                <option value="" selected disabled>Pilih Opsi</option>
                                <option value="design_only" data-price="{{ $product->price }}" data-needs-pax="true">Desain Saja (Mulai Rp {{ number_format($product->price, 0, ',', '.') }})</option>
                                <option value="cetak_only" data-price="35000" data-needs-pax="false">Cetak Banner Saja (Rp 35.000)</option>
                                <option value="cetak_stand_x" data-price="75000" data-needs-pax="false">Cetak & Stand X Banner (Rp 75.000)</option>
                                <option value="cetak_stand_y" data-price="85000" data-needs-pax="false">Cetak & Stand Y Banner(Rp 85.000)</option>
                                <option value="design_cetak" data-price="{{ $product->price + 70000 }}" data-needs-pax="true">Desain + Cetak Banner & Stand (Mulai Rp {{ number_format($product->price + 70000, 0, ',', '.') }})</option>
                            </select>
                        </div>

                        <div id="paxWrapper" class="hidden">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Jumlah Orang (Foto)</label>
                            <select name="banner_pax" id="banner_pax_select" class="w-full border-gray-200 rounded-xl focus:ring-pinkButton focus:border-pinkButton">
                                <option value="" selected disabled>Pilih Jumlah</option>
                                <option value="0">1-3 Orang (Harga Dasar)</option>
                                <option value="5000">4-6 Orang (+ Rp 5.000)</option>
                                <option value="10000">7-10 Orang (+ Rp 10.000)</option>
                            </select>
                        </div>
                    </div>

                    <div id="pickupMethodWrapper" class="col-span-1 md:col-span-2 hidden">
                         <div class="bg-white border-2 border-gray-100 p-5 rounded-2xl">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Metode Pengambilan</label>
                            <select name="pickup_method" id="pickup_method" class="w-full border-gray-200 rounded-xl focus:ring-pinkButton focus:border-pinkButton">
                                <option value="">Pilih Metode</option>
                                <option value="pickup">Ambil Sendiri ke Toko</option>
                                <option value="gosend">Pesan GOSEND Sendiri</option>
                            </select>

                            <div id="gosendAlert" class="hidden bg-yellow-50 border-l-4 border-yellow-400 p-3 rounded-r-xl mt-3">
                                <p class="text-xs text-yellow-800">
                                    <b>Info Gosend:</b> Silakan pesan Gosend sendiri setelah admin konfirmasi. Titik jemput: <b>Locco Florist</b>.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div id="locationFieldsWrapper" class="col-span-1 md:col-span-2 hidden bg-gray-50 p-4 rounded-2xl border border-gray-200">
                        <div class="flex items-center gap-2 mb-3">
                            <div class="bg-pink-100 p-1.5 rounded-full text-pinkButton text-xs">
                                <i class="bi bi-geo-alt-fill"></i>
                            </div>
                            <h6 class="font-bold text-gray-700 text-sm">Lokasi Pengantaran</h6>
                        </div>

                        <div class="grid grid-cols-1 gap-3">
                            <div>
                                <label class="block text-xs font-bold text-gray-600 mb-1">
                                    Nama Tempat <span class="text-red-500">*</span>
                                </label>
                                <input value="{{ old('receiver_location') }}" type="text" name="receiver_location" id="receiver_location" 
                                    class="w-full bg-white border border-gray-300 rounded-xl py-2.5 px-4 focus:ring-2 focus:ring-pinkButton focus:border-transparent transition text-sm shadow-sm" 
                                    placeholder="Contoh: UMY, Unjaya...">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-600 mb-1">
                                    Alamat Lengkap / Patokan
                                </label>
                                <textarea name="detailed" id="detailedInput" rows="2"
                                    class="w-full bg-white border border-gray-300 rounded-xl py-2.5 px-4 focus:ring-2 focus:ring-pinkButton focus:border-transparent transition text-sm shadow-sm" 
                                    placeholder="Contoh: Parkiran, Masuk gerbang utara...">{{ old('detailed') }}</textarea>
                            </div>

                            <div class="bg-blue-50 border-l-4 border-blue-400 p-2 rounded-r-lg">
                                <p class="text-[10px] text-blue-800 flex gap-2 items-center">
                                    <i class="bi bi-info-circle-fill"></i>
                                    <span>Bisa kirim <b>Share Loc</b> via WhatsApp nanti jika lokasi sulit.</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-1 md:col-span-2 hidden bg-gray-50 p-5 rounded-2xl border border-gray-200" id="formatKalimatWrapper">
                        <h6 class="font-bold text-pinkButton mb-4 flex items-center gap-2">
                            <i class="bi bi-chat-quote-fill"></i> Format Tulisan
                        </h6>
                        <div id="boardTypeWrapper" class="mb-4">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Tipe Ucapan</label>
                            <select name="board_type" id="board_type" class="w-full border-gray-200 rounded-xl">
                                <option value="">Pilih Tipe</option>
                                <option value="Ucapan Selamat">Ucapan Selamat</option>
                                <option value="Happy Wedding">Happy Wedding</option>
                                <option value="Duka Cita">Duka Cita</option>
                                <option value="Grand Opening">Grand Opening</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Nama + Gelar</label>
                            <input value="{{ old('nama_gelar') }}" type="text" name="nama_gelar" class="w-full border-gray-200 rounded-xl py-2 px-4" placeholder="Contoh: Dr. Sinta Rahayu, M.Pd.">
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Note (Disarankan tidak terlalu panjang)</label>
                            <textarea value="{{ old('note_text') }}" name="note_text" class="w-full border-gray-200 rounded-xl py-2 px-4" rows="2" placeholder="Contoh: Semoga sukses selalu...">{{ old('note_text') }}</textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">From</label>
                            <input value="{{ old('from_text') }}" type="text" name="from_text" class="w-full border-gray-200 rounded-xl py-2 px-4" placeholder="Contoh: Keluarga Besar H. Ahmad">
                        </div>
                    </div>

                    <div id="priceEstimationWrapper" class="col-span-1 md:col-span-2 hidden animate-fade-in">
                        <div class="p-5 bg-[#fff0f6] rounded-2xl border border-[#ffadd2] text-center">
                            <p class="text-gray-600 text-sm font-medium mb-1 uppercase tracking-wide">Estimasi Total Biaya</p>
                            <h3 class="text-3xl font-extrabold text-[#ff4b8b]" id="displayPrice">Rp 0</h3>
                            <input type="hidden" name="estimated_price" id="inputEstimatedPrice">
                            
                            <p class="text-xs text-gray-500 mt-2 italic">
                                *Harga final & desain fix akan dikonfirmasi admin via WhatsApp
                            </p>
                        </div>
                    </div>

                </div>
                
                <div class="mt-8 pt-6 border-t border-gray-100 flex flex-col items-center">
                    <button type="submit" class="w-full md:w-auto bg-greenColor hover:bg-[#1da851] text-white text-lg font-bold py-4 px-12 rounded-full shadow-xl shadow-green-100 transition-all transform hover:-translate-y-1 flex items-center justify-center gap-3">
                        <span>Lanjut ke WhatsApp</span>
                        <i class="bi bi-whatsapp text-xl"></i>
                    </button>
                    <p class="text-xs text-gray-400 mt-3">Data Anda aman dan hanya digunakan untuk pemrosesan pesanan.</p>
                </div>

            </form>
        </div>
    </div>
</div>
@if ($errors->any())
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const backdrop = document.getElementById("orderModalBackdrop");
        const modal = document.getElementById("orderModal");

        if (backdrop && modal) {
            backdrop.classList.remove("hidden");
            modal.classList.remove("hidden");
            document.body.style.overflow = "hidden";

            setTimeout(() => {
                backdrop.classList.add("opacity-100");
                modal.classList.add("opacity-100", "translate-y-0");
            }, 10);
        }
    });
</script>
@endif
