@extends('layouts.guest')

@section('title', 'Cek Ongkos Kirim')

@section('content')
<div class="min-h-screen bg-bgPage py-16">
    <div class="container mx-auto px-4 max-w-3xl">

        <div class="text-center mb-12" data-aos="fade-down">

            <h2 class="text-4xl md:text-5xl font-bold font-serif text-gray-900 mb-4 tracking-tight">
                Cek Ongkos Kirim
            </h2>

            <p class="text-gray-600 text-lg max-w-lg mx-auto leading-relaxed font-serif">
                Pilih area tujuan untuk melihat tarif pengiriman tetap.
            </p>
            
            <div class="mt-4 inline-block px-4 py-1.5 bg-red-50 border border-red-100 rounded-full font-serif">
                <p class="text-red-500 text-sm font-medium flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-7-4a1 1 0 1 1-2 0 1 1 0 0 1 2 0ZM9 9a.75.75 0 0 0 0 1.5h.253a.25.25 0 0 1 .244.304l-.459 2.066A1.75 1.75 0 0 0 10.747 15H11a.75.75 0 0 0 0-1.5h-.253a.25.25 0 0 1-.244-.304l.459-2.066A1.75 1.75 0 0 0 9.253 9H9Z" clip-rule="evenodd" />
                    </svg>
                    Khusus produk <span class="font-bold underline decoration-red-300">Bunga Papan</span>
                </p>
            </div>
        </div>

        <div class="bg-white shadow-sm rounded-3xl overflow-hidden border border-white" data-aos="fade-right">
            
            <div class="h-2 bg-pinkButton w-full"></div>

            <div class="px-8 py-10 md:px-12">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                    <div class="group">
                        <label class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">
                            Dari
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#ff4d94]" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <select id="kotaAsal" disabled
                                class="w-full pl-12 bg-gray-50 text-gray-500 font-medium rounded-xl border-2 border-[#ffc1d6] px-5 py-4 cursor-not-allowed appearance-none bg-none">
                                <option value="Yogyakarta">Locco Florist (Jogja)</option>
                            </select>
                        </div>
                    </div>

                    <div class="group">
                        <label class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">
                            Ke Tujuan
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-focus-within:text-[#ff4d94] transition-colors" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-11.25a.75.75 0 00-1.5 0v2.5h-2.5a.75.75 0 000 1.5h2.5v2.5a.75.75 0 001.5 0v-2.5h2.5a.75.75 0 000-1.5h-2.5v-2.5z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <select id="areaTujuan"
                                class="w-full pl-12 text-gray-800 font-medium rounded-xl border-2 border-[#ffc1d6] px-5 py-4 shadow-sm
                                       focus:border-[#ff4d94] focus:ring-4 focus:ring-[#ff4d94]/30 transition duration-200 bg-white cursor-pointer">
                                <option value="">Pilih Kampus / Area...</option>
                                
                                <optgroup label="Area Sekitar (Promo)">
                                    <option value="UMY" data-ongkir="0">UMY</option>
                                    <option value="Unjaya 2" data-ongkir="0">Unjaya 2</option>
                                    <option value="Almaata" data-ongkir="0">Almaata</option>
                                    <option value="UPY" data-ongkir="0">UPY</option>
                                    <option value="Amayo" data-ongkir="0">Amayo</option>
                                </optgroup>

                                <optgroup label="Yogyakarta Area">
                                    <option value="Unjaya 1" data-ongkir="20000">Unjaya 1</option>
                                    <option value="Poltekes Kemenkes" data-ongkir="20000">Poltekes Kemenkes</option>
                                    <option value="UAD 1" data-ongkir="30000">UAD 1</option>
                                    <option value="UAD 2" data-ongkir="30000">UAD 2</option>
                                    <option value="UAD 3" data-ongkir="30000">UAD 3</option>
                                    <option value="UAD 4" data-ongkir="30000">UAD 4</option>
                                    <option value="MMTC" data-ongkir="30000">MMTC</option>
                                    <option value="POLITEKNIK YPKN" data-ongkir="30000">POLITEKNIK YPKN</option>
                                    <option value="UKDW" data-ongkir="30000">UKDW</option>
                                    <option value="ISI" data-ongkir="30000">ISI</option>
                                    <option value="UGM" data-ongkir="35000">UGM</option>
                                    <option value="UNY" data-ongkir="35000">UNY</option>
                                    <option value="USD" data-ongkir="35000">USD</option>
                                    <option value="UII Demangan" data-ongkir="35000">UII Demangan</option>
                                    <option value="UIN SUKA" data-ongkir="35000">UIN SUKA</option>
                                    <option value="UTY 1" data-ongkir="35000">UTY 1</option>
                                    <option value="UTY 2" data-ongkir="35000">UTY 2</option>
                                    <option value="Marcu Buana 3" data-ongkir="45000">Marcu Buana 3</option>
                                    <option value="UPN" data-ongkir="45000">UPN</option>
                                    <option value="Insiter" data-ongkir="45000">Insiter</option>
                                    <option value="STIE YKPN" data-ongkir="45000">STIE YKPN</option>
                                    <option value="Pascasarjana UIN SUKA" data-ongkir="45000">Pascasarjana UIN SUKA</option>
                                    <option value="UII" data-ongkir="55000">UII</option>
                                    <option value="Area Lain >20 Km" data-ongkir="55000">Area Lain >20 Km</option>
                                </optgroup>
                            </select>
                        </div>
                    </div>

                </div>

                <div class="mt-10">
                    <button id="cekTarifBtn"
                        class="w-full bg-pinkButton hover:bg-pink-600 text-white font-bold text-lg py-4 rounded-xl shadow-lg shadow-pink-200 
                               transform transition hover:-translate-y-1 hover:shadow-xl active:scale-95 duration-300 flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        Cek Tarif Sekarang
                    </button>
                </div>

                <div id="output"
                     class="hidden mt-10 relative bg-white border-2 border-dashed border-[#ffc1d6] p-8 rounded-2xl text-center
                            opacity-0 translate-y-3 transition-all duration-500">
                    
                    <div class="absolute top-1/2 -left-3 w-6 h-6 bg-pink-50 rounded-full"></div>
                    <div class="absolute top-1/2 -right-3 w-6 h-6 bg-pink-50 rounded-full"></div>

                    <p class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-1">Estimasi Biaya Ke</p>
                    <h5 id="outputArea" class="text-2xl font-serif font-bold text-gray-800 mb-6">
                        -
                    </h5>

                    <div class="inline-block bg-pink-50 px-8 py-4 rounded-xl">
                        <span class="block text-sm text-[#ff4d94] mb-1">Total Ongkir</span>
                        <span id="outputOngkir" class="text-3xl font-extrabold text-pinkButton tracking-tight">
                            -
                        </span>
                    </div>
                </div>

            </div>
            
            <div class="bg-gray-50 px-8 py-6 border-t border-gray-100 text-center">
                <div class="inline-flex items-center gap-2 bg-white border border-green-200 rounded-lg px-4 py-2 shadow-sm mb-3">
                    <span class="text-xl">🎉</span>
                    <span class="text-green-700 text-sm font-medium"><span class="font-bold">Gratis Ongkir</span> area UMY, Alma Atta dan sekitarnya</span>
                </div>
                <p class="text-xs text-gray-400 mt-2">
                    Diluar area diatas? <a href="#" class="text-pinkButton hover:underline">Hubungi Admin</a> melalui WA untuk info lengkap.
                </p>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
    @vite('resources/js/customer/ongkos-kirim.js')
@endpush