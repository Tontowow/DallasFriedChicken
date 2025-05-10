<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;

class PaymentController extends Controller
{
    public function handleNotification(Request $request)
{
    // Set konfigurasi Midtrans
    \Midtrans\Config::$serverKey = config('midtrans.server_key');
    \Midtrans\Config::$isProduction = false;
    \Midtrans\Config::$isSanitized = true;
    \Midtrans\Config::$is3ds = true;

    // Ambil notifikasi dari Midtrans
    $notification = new \Midtrans\Notification();

    // Ambil data order ID dan status pembayaran
    $orderId = $notification->order_id;
    $transactionStatus = $notification->transaction_status;

    // Cari tiket berdasarkan ID
    $ticket = Ticket::findOrFail($orderId);

    // Cek status transaksi dan ubah status tiket
    if ($transactionStatus == 'capture' || $transactionStatus == 'settlement') {
        // Pembayaran berhasil
        $ticket->status = 'Paid';
    } elseif ($transactionStatus == 'pending') {
        // Pembayaran masih pending
        $ticket->status = 'Pending';
    } elseif ($transactionStatus == 'expire' || $transactionStatus == 'cancel') {
        // Pembayaran gagal
        $ticket->status = 'Failed';
    }

    // Simpan perubahan status tiket
    $ticket->save();

    return response()->json(['message' => 'Notification handled successfully'], 200);
}
}
