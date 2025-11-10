@extends('layouts.guest')

@section('title', 'Cek Ongkos Kirim')

@push('styles')
    @vite(['resources/css/customer/ongkos-kirim.css'])
@endpush

@section('content')
<div class="bg-page py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <div class="text-center mb-5" data-aos="fade-up">
                    <h2 class="fw-bold text-black mb-2">Cek Ongkos Kirim</h2>
                    <p class="text-muted">
                        Masukkan alamat tujuan atau pilih langsung di peta, lalu tekan tombol di bawah
                        untuk menghitung biaya pengiriman dari toko kami.
                    </p>
                </div>

                <div class="card border-0 shadow-sm rounded-4 p-4" data-aos="fade-up">
                    <div class="form-group mb-4">
                        <label for="destination" class="form-label fw-semibold text-dark">
                            <i class="bi bi-geo-alt-fill me-2 text-danger"></i>Alamat Tujuan:
                        </label>
                        <input type="text" id="destination" 
                               class="form-control form-control-lg shadow-sm input-destination"
                               placeholder="Masukkan atau pilih alamat tujuan Anda">
                    </div>

                    <div id="map" class="shadow-sm map-container rounded-4 mb-4"></div>

                    <div class="text-center">
                        <button id="checkCostBtn" class="btn btn-lg px-4 py-2 fw-semibold shadow-sm btn-count text-white">
                            <i class="me-2"></i>Hitung Ongkos Kirim
                        </button>
                    </div>

                    <div id="output" class="card border-0 p-4 mt-4 text-center fade-in output-card">
                        <h5 class="fw-bold text-dark mb-3">
                            <i class="bi bi-truck me-2 text-success"></i>Biaya Pengiriman
                        </h5>
                        <p class="fs-5 mb-0 text-muted">
                            <strong>Tujuan:</strong> <span id="tujuan" class="text-dark fw-semibold"></span><br>
                            <strong>Jarak:</strong> <span id="distance" class="text-dark fw-semibold"></span><br>
                            <strong>Ongkos Kirim:</strong> <span id="cost" class="text-success fw-bold"></span>
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script src="{{ Vite::asset('resources/js/customer/ongkos-kirim.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.api_key') }}&libraries=places&callback=initMap" async defer></script>   
@endpush
@endsection
