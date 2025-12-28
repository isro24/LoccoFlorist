<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function send(Request $request)
    {
        $product = Product::where('name', $request->nama_produk)
            ->with('category')
            ->firstOrFail();

        $type = strtolower($product->category->type ?? '');

        $isPapan  = str_contains($type, 'papan');
        $isBanner = str_contains($type, 'banner');
        $isBunga = str_contains($type, 'bunga');

        $rules = [
            'nama_produk'       => 'required|string',
            'name'              => 'required|string|max:255',
            'delivery_date'     => 'required|date',
            'delivery_time'     => 'required',
        ];

        if ($isPapan) {
            $rules['receiver_location'] = 'required|string';
            $rules['detailed']          = 'required|string';
            $rules['receiver_name']     = 'required|string';
            $rules['receiver_phone'] = [
                'required',
                'starts_with:08,62',
                'digits_between:10,15',
            ];
        }
        
        if ($isBanner || $isBunga) {
            $rules['pickup_method'] = 'required|string';
        }

        if ($isBanner) {
            $rules['banner_option'] = 'required|string';
            if (in_array($request->banner_option, ['design_only', 'design_cetak'])) {
                $rules['banner_pax'] = 'required';
            }
        }

        $validator = Validator::make($request->all(), $rules, [
            'delivery_date.required'        => 'Tanggal wajib diisi.',
            'delivery_date.date'            => 'Format tanggal tidak valid.',
            'delivery_time.required'        => 'Jam wajib diisi.',
            'receiver_phone.starts_with'   => 'Nomor WA penerima harus diawali angka 08 atau 62.',
            'receiver_phone.digits_between' => 'Nomor WA penerima harus 10–15 digit.',
            'receiver_location.required'   => 'Mohon isi nama gedung/lokasi pengiriman.',
            'detailed.required'            => 'Mohon isi detail/patokan tempat.',
            'banner_option.required'       => 'Silakan pilih opsi desain banner.',
            'banner_pax.required'          => 'Silakan pilih jumlah orang dalam foto.',
            'pickup_method.required'       => 'Silakan pilih metode pengambilan.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $sellerNumber = config('umkm.whatsapp.seller_number');
        if ($isBanner) {
            $sellerNumber = config('umkm.whatsapp.seller_banner_number') ?: $sellerNumber;
        }

        $message  = "\u{1F4E6} *ORDER PRODUK*\n\n";
        $message .= "*Nama Produk:* {$product->name}\n";
        $message .= "*Kategori:* {$product->category->name}\n";
        $message .= "*Nama Pemesan:* {$request->name}\n";
        $message .= "*Tanggal:* {$request->delivery_date}\n";

        if ($isPapan) {
            $message .= "*Jam Pengantaran:* {$request->delivery_time}\n";
            $message .= "*Nama Penerima:* {$request->receiver_name}\n";
            $message .= "*Nomor WA Penerima:* {$request->receiver_phone}\n";

            $message .= "\n";

            $message .= "\u{1F4CD} *LOKASI PENGIRIMAN*\n";
            $message .= "*Tempat:* {$request->receiver_location}\n";

            if ($request->filled('detailed')) {
                $message .= "*Alamat/Patokan:* {$request->detailed}\n";
            }
            $message .= "(Shareloc menyusul jika diperlukan)\n";

            // $receiver_location = trim($request->receiver_location);
            // if (preg_match('/https?:\/\/(www\.)?(google\.com\/maps|maps\.app\.goo\.gl|goo\.gl\/maps)/i', $receiver_location)) {
            //     $locationLink = "📍 *Lokasi Pengiriman (klik untuk buka)*:\n{$receiver_location}";
            // } elseif (preg_match('/-?\d{1,3}\.\d+,\s*-?\d{1,3}\.\d+/', $receiver_location, $matches)) {
            //     $coords = trim($matches[0]);
            //     $googleMapsUrl = "https://www.google.com/maps?q=" . urlencode($coords);
            //     $locationLink = "📍 *Lokasi Pengiriman (klik untuk buka)*:\n{$googleMapsUrl}";
            // } else {
            //     $googleMapsUrl = "https://www.google.com/maps/search/?api=1&query=" . urlencode($receiver_location);
            //     $locationLink = "📍 *Lokasi Pengiriman (klik untuk buka)*:\n{$googleMapsUrl}";
            // }

            // $message .= $locationLink . "\n";
            // $message .= "*Detail:* {$request->detailed}\n";

            $message .= "\n-----------------------------------------\n";
            $message .= "\u{1F4DD} *FORMAT KALIMAT*\n\n";
            $message .= "*Ucapan:* {$request->board_type}\n";
            $message .= "*Nama + Gelar:* {$request->nama_gelar}\n";
            $message .= "*Note:* {$request->note_text}\n";
            $message .= "*From:* {$request->from_text}\n";
        } elseif ($isBanner || $isBunga) {
            $message .= "*Jam Ambil/Kirim:* {$request->delivery_time}\n";
            
            if ($isBanner) {
                $message .= "\n\u{1F3A8} *DETAIL BANNER*\n";
                $opsiText = match ($request->banner_option) {
                    'design_only' => 'Jasa Desain Saja',
                    'cetak_only' => 'Cetak Banner Saja',
                    'cetak_stand_x' => 'Cetak & Stand X Banner',
                    'cetak_stand_y' => 'Cetak & Stand Y Banner',
                    'design_cetak' => 'Desain + Cetak Banner & Stand',
                    default => $request->banner_option,
                };
                $message .= "• Opsi: *{$opsiText}*\n";
                 if (in_array($request->banner_option, ['design_only', 'design_cetak']) && $request->has('banner_pax')) {
                    $paxValue = $request->banner_pax;
                    $paxDisplay = match ($paxValue) {
                        '0' => "1-3 Orang (Standard)",
                        '5000' => "4-6 Orang (+5rb)",
                        '10000' => "7-10 Orang (+10rb)",
                        default => "Custom / Lainnya",
                    };
                    $message .= "• Jumlah Wajah: {$paxDisplay}\n";
                }
                if ($request->filled('estimated_price')) {
                    $formattedPrice = number_format((float)$request->estimated_price, 0, ',', '.');
                    $message .= "• Estimasi Web: *Rp {$formattedPrice}*\n";
                }
            }

            $pickup = $request->pickup_method;
            if ($pickup == 'gosend') {
                $message .= "• Pengambilan: *GOSEND* (Pesan Sendiri)\n";
            } else {
                $message .= "• Pengambilan: *Ambil Sendiri*\n";
            }
        }


        // $message .= "\n-----------------------------------------\n";
        // $message .= "💸 *METODE PEMBAYARAN*\n";
        // $message .= "Pembayaran hanya dengan:\n• Pesanan : (isi nanti)\n• Ongkir  : (isi nanti)\n*Total = (isi nanti)*\n\n";
        // $message .= "🏦 BCA 0601350997 \n(An. FADHILA KHAIRUN NISA)\n\n";
        // $message .= "*Notes:* Wajib melakukan payment terlebih dahulu (minimal DP 50%) / full payment agar pesanan kakak bisa di-keep dan diproses ☺🙏\n\n";
        // $message .= "WAJIB MELAMPIRKAN BUKTI PEMBAYARAN";

        $encodedMessage = rawurlencode($message);
        // $whatsappUrl = "https://wa.me/{$sellerNumber}?text={$encodedMessage}";

        // return redirect()->away($whatsappUrl);

        $whatsappUrl = "https://api.whatsapp.com/send?phone={$sellerNumber}&text={$encodedMessage}";

        return redirect()->back()->with('wa_link', $whatsappUrl);
    }
}
