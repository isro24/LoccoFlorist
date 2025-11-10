<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function send(Request $request)
{
    $request->validate([
        'nama_produk'       => 'required|string',
        'quantity'          => 'required|integer|min:1',
        'type'              => 'required|string',
        'name'              => 'required|string|max:255',
        'board_type'        => 'required_if:type,Sewa papan|string|nullable',
        'delivery_date'     => 'required|date',
        'delivery_time'     => 'required',
        'receiver_phone'    => 'required|numeric|digits_between:10,15|starts_with:0',
        'receiver_location' => 'required|string',
        'nama_gelar'        => 'required_if:type,Sewa papan|string',
        'note_text'         => 'required_if:type,Sewa papan|string',
        'from_text'         => 'required_if:type,Sewa papan|string',
    ],
    [
        'receiver_phone.starts_with' => 'Nomor WA penerima harus diawali dengan angka 0.',
        'receiver_phone.digits_between' => 'Nomor WA penerima harus terdiri dari 10 hingga 15 digit.',
    ]);

    $sellerNumber = env('SELLER_WHATSAPP_NUMBER');

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

    $message = "📦 *ORDER PRODUK*\n\n";
    $message .= "*Nama Produk:* {$request->nama_produk}\n";
    $message .= "*Nama Pemesan:* {$request->name}\n";
    $message .= ($request->type === 'Sewa papan') ? "*Tipe papan:* {$request->board_type}\n" : "";
    $message .= "*Tanggal:* {$request->delivery_date}\n";
    $message .= "*Jam pengantaran:* {$request->delivery_time}\n";
    $message .= "*Nomor WA Penerima:* {$request->receiver_phone}\n";
    $message .= $locationLink . "\n";

    if ($request->type === 'Sewa papan') {
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

    $contents = file_get_contents('OrderController.php');
if (mb_detect_encoding($contents, 'UTF-8', true)) {
    echo "File UTF-8 ✅";
} else {
    echo "Bukan UTF-8 ❌";
}

}

}
