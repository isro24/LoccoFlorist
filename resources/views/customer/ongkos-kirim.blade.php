@extends('layouts.guest')

@section('title', 'Cek Ongkos Kirim')

@section('content')
<div class="bg-bgPage py-16">
    <div class="container mx-auto px-4 max-w-4xl">

        <div class="text-center mb-12 font-serif" data-aos="fade-up">
            <h2 class="text-5xl font-bold text-gray-900 mb-3">Cek Ongkos Kirim</h2>
            <p class="text-gray-500 text-xl">
                Pilih area pengiriman untuk melihat tarif ongkir tetap.
            </p>
            <p class="text-gray-500 text-xl">
                (Layanan Pengiriman hanya untuk produk Bunga Papan).
            </p>
        </div>

        <div class="bg-white shadow-md rounded-2xl px-8 py-10">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <label class="block font-semibold text-gray-900 mb-2">
                        Kota Asal
                    </label>
                    <select id="kotaAsal"
                        class="w-full text-lg rounded-full border-2 border-[#ffc1d6] px-5 py-3 shadow-sm
                               focus:border-[#ff4d94] focus:ring-4 focus:ring-[#ff4d94]/30 transition">
                        <option value="Yogyakarta">Yogyakarta (Toko Kami)</option>
                    </select>
                </div>

                <div>
                    <label class="block font-semibold text-gray-900 mb-2">
                        Pilih Area Pengiriman
                    </label>

                    <select id="areaTujuan"
                        class="w-full text-lg rounded-full border-2 border-[#ffc1d6] px-5 py-3 shadow-sm
                               focus:border-[#ff4d94] focus:ring-4 focus:ring-[#ff4d94]/30 transition">
                        <option value="">Pilih Area...</option>
                        <option value="UMY" data-ongkir="000">UMY</option>
                        <option value="Unjaya 2" data-ongkir="000">Unjaya 2</option>
                        <option value="Almaata" data-ongkir="000">Almaata</option>
                        <option value="UPY" data-ongkir="000">UPY</option>
                        <option value="Amayo" data-ongkir="000">Amayo</option>

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
                        <option value="UNY" data-ongkir="55000">UNY</option>
                        <option value="Dll" data-ongkir="55000">Dll</option>

                    </select>
                </div>

            </div>

            <div class="text-center mt-8">
                <button id="cekTarifBtn"
                    class="text-xl font-semibold shadow px-10 py-3 rounded-full bg-pinkButton text-white
                           transition duration-300 hover:scale-105">
                    Cek Tarif
                </button>
            </div>

            <div id="output"
                 class="hidden border border-gray-200 mt-8 p-6 rounded-xl bg-white text-center
                        opacity-0 translate-y-3 transition-all duration-500">

                <h5 class="text-xl font-bold text-gray-900 mb-3">
                    Ongkos Kirim ke <span id="outputArea" class="text-pink-600"></span>
                </h5>

                <p class="text-lg text-gray-700">
                    Tarif Ongkir:
                    <span id="outputOngkir" class="font-bold text-green-600"></span>
                </p>

                <p class="text-sm mt-3 text-gray-500">
                    Estimasi pengiriman: Hari yang sama untuk order sebelum jam 12.00.
                </p>
            </div>

            <div class="mt-10 text-center text-sm">
                <p class="mb-2 text-green-700 bg-green-50 border border-green-200 px-4 py-2 rounded-lg inline-block">
                    🎉 <span class="font-semibold">Gratis Ongkir</span> untuk area sekitar UMY dan Alma Atta.
                </p>

                <p class="text-gray-500 mt-3">
                    Area di luar Yogyakarta?  
                    <span class="text-pink-600 font-semibold">Hubungi admin</span> untuk informasi tarif pengiriman.
                </p>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
    @vite('resources/js/customer/ongkos-kirim.js')
@endpush
