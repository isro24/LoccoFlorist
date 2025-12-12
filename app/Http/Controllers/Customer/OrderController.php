<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class OrderController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'nama_produk'       => 'required|string',
            'name'              => 'required|string|max:255',
            'delivery_date'     => 'required|date',
            'delivery_time'     => 'required',
            'receiver_name'     => 'required|string',
            'receiver_phone'    => 'required|numeric|digits_between:10,15|starts_with:0',
            'receiver_location' => 'required|string',
            'detailed'          => 'required|string',
            'nama_gelar'        => 'nullable|string',
            'note_text'         => 'nullable|string',
            'from_text'         => 'nullable|string',
        ], [
            'receiver_phone.starts_with'   => 'Nomor WA penerima harus diawali angka 0.',
            'receiver_phone.digits_between'=> 'Nomor WA penerima harus 10–15 digit.',
        ]);

        $product = Product::where('name', $request->nama_produk)
                    ->with('category')
                    ->firstOrFail();

        $type = strtolower($product->category->type ?? '');

        $sellerNumber = env('SELLER_WHATSAPP_NUMBER');

        if (str_contains($type, 'banner')) {
            $sellerNumber = env('SELLER_WHATSAPP_BANNER');
        }

        $receiver_location = trim($request->receiver_location);

        if (preg_match('/https?:\/\/(www\.)?(google\.com\/maps|maps\.app\.goo\.gl|goo\.gl\/maps)/i', $receiver_location)) {
            $locationLink = "📍 *Lokasi Pengiriman (klik untuk buka)*:\n{$receiver_location}";
        } elseif (preg_match('/-?\d{1,3}\.\d+,\s*-?\d{1,3}\.\d+/', $receiver_location, $matches)) {
            $coords = trim($matches[0]);
            $googleMapsUrl = "https://www.google.com/maps?q=" . urlencode($coords);
            $locationLink = "📍 *Lokasi Pengiriman (klik untuk buka)*:\n{$googleMapsUrl}";
        } else {
            $googleMapsUrl = "https://www.google.com/maps/search/?api=1&query=" . urlencode($receiver_location);
            $locationLink = "📍 *Lokasi Pengiriman (klik untuk buka)*:\n{$googleMapsUrl}";
        }

        $message  = "📦 *ORDER PRODUK*\n\n";
        $message .= "*Nama Produk:* {$product->name}\n";
        $message .= "*Kategori:* {$product->category->name}\n";
        $message .= "*Tipe:* {$product->category->type}\n";
        $message .= "*Nama Pemesan:* {$request->name}\n";
        $message .= "*Tanggal:* {$request->delivery_date}\n";
        $message .= "*Jam pengantaran:* {$request->delivery_time}\n";
        $message .= "*Nama Penerima:* {$request->receiver_name}\n";
        $message .= "*Nomor WA Penerima:* {$request->receiver_phone}\n";
        $message .= $locationLink . "\n";
        $message .= "*Rincian Alamat:* {$request->detailed}\n";

        if (str_contains($type, 'papan')) {
            $message .= "\n-----------------------------------------\n";
            $message .= "📝 *FORMAT KALIMAT*\n\n";
            $message .= "*Congratulation*\n\n";
            $message .= "*Nama + Gelar:* {$request->nama_gelar}\n";
            $message .= "*Note:* {$request->note_text}\n";
            $message .= "*From:* {$request->from_text}\n";
        }

        // $message .= "\n-----------------------------------------\n";
        // $message .= "💸 *METODE PEMBAYARAN*\n";
        // $message .= "Pembayaran hanya dengan:\n• Pesanan : (isi nanti)\n• Ongkir  : (isi nanti)\n*Total = (isi nanti)*\n\n";
        // $message .= "🏦 BCA 0601350997 \n(An. FADHILA KHAIRUN NISA)\n\n";
        // $message .= "*Notes:* Wajib melakukan payment terlebih dahulu (minimal DP 50%) / full payment agar pesanan kakak bisa di-keep dan diproses ☺🙏\n\n";
        // $message .= "WAJIB MELAMPIRKAN BUKTI PEMBAYARAN";

        $encodedMessage = rawurlencode($message);
        $whatsappUrl = "https://wa.me/{$sellerNumber}?text={$encodedMessage}";

        return redirect()->away($whatsappUrl);
    }
}
