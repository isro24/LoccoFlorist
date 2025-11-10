<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;

class OngkirController extends Controller
{
    public function index()
    {
        return view('customer.ongkos-kirim');
    }

    public function calculate(Request $request)
    {
        $origin = $request->origin;   // alamat toko
        $destination = $request->destination; // tujuan user

        $apiKey = config('services.google_maps.key');

        $response = Http::get("https://maps.googleapis.com/maps/api/distancematrix/json", [
            'origins' => $origin,
            'destinations' => $destination,
            'key' => $apiKey,
            'units' => 'metric',
        ]);

        $data = $response->json();

        if ($data['status'] !== 'OK') {
            return response()->json(['error' => 'Gagal menghitung jarak'], 500);
        }

        $distanceText = $data['rows'][0]['elements'][0]['distance']['text'] ?? '0 km';
        $distanceValue = $data['rows'][0]['elements'][0]['distance']['value'] ?? 0; // meter

        $distanceKm = $distanceValue / 1000;

        if ($distanceKm > 2) {
            $ongkir = ceil(($distanceKm - 2) * 2000);
        } else {
            $ongkir = 0;
        }

        return response()->json([
            'distance' => round($distanceKm, 2),
            'distance_text' => $distanceText,
            'ongkir' => $ongkir,
        ]);
    }
}
