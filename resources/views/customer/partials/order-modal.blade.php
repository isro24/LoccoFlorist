<div id="orderModalBackdrop" class="fixed inset-0 bg-black/50 z-1050 hidden opacity-0 transition-opacity duration-300 ease-in-out"></div>

<div id="orderModal" tabindex="-1" aria-hidden="true" 
    class="fixed inset-0 z-1100 items-start justify-center p-4
           opacity-0 translate-y-8 transition-all duration-400 ease-out">

    <div class="relative w-full max-w-4xl bg-white rounded-2xl border-none backdrop-blur-lg
                shadow-[0_8px_30px_rgba(255,105,180,0.2)] max-h-[90vh] overflow-y-auto">

        <div class="p-6 md:p-12">

            <div class="flex justify-end mb-3">
                <button type="button" id="closeOrderModalBtn" class="text-gray-500 hover:text-gray-800 cursor-pointer" aria-label="Close">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <div class="text-center mb-4">
                <img src="{{ asset('storage/' . $product->image) }}" 
                     alt="{{ $product->name }}" 
                     class="w-[180px] h-[180px] object-cover border-4 border-[#ffe4ef] rounded-xl shadow-sm inline-block">
            </div>
            <h4 class="text-center text-2xl font-bold text-[#ff4b8b] mb-1">Formulir Pemesanan</h4>
            <p class="text-center text-gray-500 mb-6 text-base">{{ $product->name }}</p>

            <form action="{{ route('order.send') }}" method="POST"> 
                @csrf
                <input type="hidden" name="nama_produk" value="{{ $product->name }}">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <div class="col-span-1">
                        <label class="form-label font-semibold mb-2 block">Kategori</label>

                        <input type="text" 
                            value="{{ $product->category->name }}" 
                            readonly
                            class="w-full bg-gray-200 rounded-xl py-3 px-4 border-none">
                        <input type="hidden" name="type" value="{{ $product->category->type }}">
                    </div>

                    <div class="col-span-1">
                        <label class="form-label font-semibold mb-2 block">Nama Pemesan</label>
                        <input type="text" name="name" class="form-input w-full bg-[#f2f2f2] border-none rounded-xl py-3 px-4 focus:ring-0 focus:shadow-[0_0_0_3px_rgba(255,128,171,0.3)]" required placeholder="Contoh: Andra">
                    </div>

                    <div class="col-span-1 md:col-span-2 hidden" id="boardTypeWrapper">
                        <label class="form-label font-semibold mb-2 block">Tipe Papan</label>

                        <select 
                            name="board_type" 
                            id="board_type"
                            class="form-input w-full bg-[#f2f2f2] border-none rounded-xl py-3 px-4">
                            
                            <option value="">Pilih Tipe Papan</option>
                            <option value="Ucapan Selamat">Papan Ucapan Selamat</option>
                        </select>
                    </div>


                    <div class="flex-1">
                        <label for="delivery_date" class="form-label font-semibold mb-2 block">Tanggal Pengantaran</label>
                        <input 
                            type="text" 
                            id="delivery_date" 
                            name="delivery_date" 
                            class="form-input w-full bg-[#f2f2f2] border-none rounded-xl py-3 px-4" 
                            placeholder="Pilih tanggal pengantaran" 
                            required>
                    </div>

                    <div class="flex-1">
                        <label for="delivery_time" class="form-label font-semibold mb-2 block">Jam Pengantaran</label>
                        <input 
                            type="text" 
                            id="delivery_time" 
                            name="delivery_time" 
                            class="form-input w-full bg-[#f2f2f2] border-none rounded-xl py-3 px-4" 
                            placeholder="Pilih jam pengantaran" 
                            required>
                    </div>


                    <div>
                        <label class="form-label font-semibold mb-2 block">Nama Penerima</label>
                        <input 
                            type="text" 
                            name="receiver_name" 
                            class="w-full bg-[#f2f2f2] border-none rounded-xl py-4 px-5 focus:ring-0 focus:shadow-[0_0_0_3px_rgba(255,128,171,0.3)]" 
                            required 
                            placeholder="Contoh: Andra">
                    </div>

                    <div>
                        <label class="form-label font-semibold mb-2 block">Nomor Penerima</label>
                        <input 
                            type="text" 
                            name="receiver_phone" 
                            class="w-full bg-[#f2f2f2] border-none rounded-xl py-4 px-5" 
                            required 
                            placeholder="Contoh: 081234567890">
                    </div>

                    <div class="col-span-1 md:col-span-2">
                        <label class="form-label font-semibold mb-2 block">Lokasi Penerima</label>
                        
                        <input type="text" id="map-search-input" class="form-input w-full bg-[#f2f2f2] border-none rounded-xl py-3 px-4 mb-2" placeholder="Cari alamat atau nama tempat...">
                        
                        <div id="map" class="map-container mb-2 rounded-xl h-[200px] bg-gray-200"></div>
                        
                        <input type="text" name="receiver_location" id="receiver_location" class="form-input w-full bg-[#f2f2f2] border-none rounded-xl py-3 px-4" placeholder="Lokasi akan terisi otomatis" readonly required>

                        <input type="text" name="detailed" class="form-input w-full bg-[#f2f2f2] border-none rounded-xl py-3 px-4 mt-2" placeholder="Patokan (Contoh: Pagar hitam, sebelah warkop)" required>
                    </div>

                    <div class="col-span-1 md:col-span-2 hidden" id="formatKalimatWrapper">
                        <hr class="my-4">
                        <h6 class="font-bold text-[#ff4b8b] mb-4 text-lg">Format Kalimat (Untuk Tipe Sewa Papan)</h6>
                        <div class="mb-3">
                            <label class="form-label font-semibold mb-2 block">Nama + Gelar</label>
                            <input type="text" name="nama_gelar" class="form-input w-full bg-[#f2f2f2] border-none rounded-xl py-3 px-4" disabled placeholder="Contoh: Dr. Sinta Rahayu, M.Pd.">
                        </div>
                        <div class="mb-3">
                            <label class="form-label font-semibold mb-2 block">Note</label>
                            <textarea name="note_text" class="form-textarea w-full bg-[#f2f2f2] border-none rounded-xl py-3 px-4" rows="2" disabled placeholder="Ucapan singkat di papan..."></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label font-semibold mb-2 block">From</label>
                            <input type="text" name="from_text" class="form-input w-full bg-[#f2f2f2] border-none rounded-xl py-3 px-4" disabled placeholder="Dari siapa...">
                        </div>
                    </div>

                </div>

                <div class="text-center mt-6">
                    <button type="submit" class="inline-block bg-[#ff4b8b] text-white border-none transition-all duration-300 ease-in-out hover:bg-[#e43b78] hover:-translate-y-0.5 rounded-xl font-semibold py-3 px-8 w-full md:w-auto">
                        Pesan Sekarang
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>