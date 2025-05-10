<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Destinasi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\PDF;
use BaconQrCode\Writer;
use BaconQrCode\Renderer\Image\PngWriter; // Menggunakan PngWriter yang tepat
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use Illuminate\Support\Facades\Storage;



class TicketController extends Controller
{
    // Menampilkan form pemesanan
    public function create($destinasiId)
    {
        $destinasi = Destinasi::findOrFail($destinasiId);
        return view('tickets.create', compact('destinasi'));
    }

    // Menyimpan data ke database
    public function checkout(Request $request, $destinasiId)
    {
        // Validasi data input
        $request->validate([
            'jumlah' => 'required|integer|min:1',
            'nama' => 'required|string|max:255',
            'tanggal' => 'required|date|after_or_equal:today',
        ]);
    
        // Ambil data destinasi berdasarkan ID
        $destinasi = Destinasi::findOrFail($destinasiId);
    
        // Ambil ID pengguna yang sedang login
        $userId = Auth::id();
    
        // Hitung total harga
        $totalHarga = $request->jumlah * $destinasi->harga;
        $status = 'pending';
        $payment_status = 'unpaid';
    
        // Filter data untuk keamanan
        $ticketData = [
            'destinasi_id' => $destinasi->id,
            'nama' => $request->nama,
            'tanggal' => $request->tanggal,
            'jumlah' => $request->jumlah,
            'total_harga' => $totalHarga,
            'status' => $status,
            'payment_status' => $payment_status,
            'user_id' => $userId,
        ];
    
        // Simpan data tiket ke dalam database
        $ticket = Ticket::create($ticketData);
    
        // Gunakan ticket->id langsung sebagai order_id
        $order_id = 'order-' . $ticket->id . '-' . time();
        $orderId = (string) Str::uuid();  // Menggunakan Laravel's Str::uuid() untuk membuat UUID

     
        // Set konfigurasi Midtrans
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = false; // Development/Sandbox Environment
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;
    
        // Membuat parameter untuk transaksi Midtrans
        $params = [
            'transaction_details' => [
                'order_id' => $order_id,  // Menggunakan ticket->id sebagai order_id
                'gross_amount' => $ticket->total_harga,
            ],
            'customer_details' => [
                'first_name' => $request->nama,
                'email' => Auth::user()->email, // Menggunakan email dari pengguna yang login
            ],
        ];
    
        // Dapatkan snap token dari Midtrans
        $snapToken = \Midtrans\Snap::getSnapToken($params);
    
        // Return view dengan snapToken dan tiket
        return view('tickets.checkout', compact('snapToken', 'ticket', 'destinasi'));
    }
    


    public function userTickets()
    {
        // Ambil tiket berdasarkan user yang sedang login, dengan relasi destinasi
        $tickets = Ticket::where('user_id', Auth::id())
                         ->with('destinasi') // Memuat relasi destinasi
                         ->get();
    
        // Mengirimkan data tiket ke view
        return view('tickets.user_tickets', compact('tickets'));
    }


public function print($id)
{
    $ticket = Ticket::with('destinasi')->findOrFail($id);

    // Pastikan Anda memiliki view khusus untuk tiket PDF
    return view('tickets.pdf', compact('ticket'));
    // $pdf = PDF::loadView('tickets.pdf', compact('ticket'));
    // return $pdf->download('tiket_' . $ticket->id . '.pdf');
}


public function success(Request $request , $id){
    $request->validate([
        'snap' => 'string',
        'tanggal' => 'string'
    ]);

    
    $dataTiket = Ticket::where([['destinasi_id',$id],['user_id',Auth::id()],['tanggal',$request->tanggal]])->first();
    // dd($dataTiket);
    if (isset($request->snap) != null) {
        // dd($dataTiket->get());

        $dataTiket->update([
            'status' => 'completed',
            'payment_status' => 'paid'
        ]);

        return redirect()->route('destinasi.show',['id'=>$id]);
    }else {
        return redirect()->back();
    }
}

public function checkoutUser(Request $request,$id){
    $request->validate([
        'jumlah' => 'required|integer|min:1',
        'nama' => 'required|string|max:255',
        'tanggal' => 'required|date|after_or_equal:today',
    ]);

    
    $ticket = Ticket::find($id);
    
    // Ambil data destinasi berdasarkan ID
    $destinasi = Destinasi::findOrFail($ticket->destinasi_id);
    
    // dd($destinasi);
    // Ambil ID pengguna yang sedang login
    $userId = Auth::id();

    // Hitung total harga
    $totalHarga = $request->jumlah * $destinasi->harga;
    $status = 'pending';
    $payment_status = 'unpaid';

    // Filter data untuk keamanan
    // $ticketData = [
    //     'destinasi_id' => $destinasi->id,
    //     'nama' => $request->nama,
    //     'tanggal' => $request->tanggal,
    //     'jumlah' => $request->jumlah,
    //     'total_harga' => $totalHarga,
    //     'status' => $status,
    //     'payment_status' => $payment_status,
    //     'user_id' => $userId,
    // ];

    // Simpan data tiket ke dalam database
    // $ticket = Ticket::create($ticketData);

    // Gunakan ticket->id langsung sebagai order_id
    // $order_id = 'order-' . $ticket->id . '-' . time();
    $orderId = (string) Str::uuid();  // Menggunakan Laravel's Str::uuid() untuk membuat UUID

 
    // Set konfigurasi Midtrans
    \Midtrans\Config::$serverKey = config('midtrans.server_key');
    \Midtrans\Config::$isProduction = false; // Development/Sandbox Environment
    \Midtrans\Config::$isSanitized = true;
    \Midtrans\Config::$is3ds = true;

    // Membuat parameter untuk transaksi Midtrans
    $params = [
        'transaction_details' => [
            'order_id' => $id,  // Menggunakan ticket->id sebagai order_id
            'gross_amount' => $ticket->total_harga,
        ],
        'customer_details' => [
            'first_name' => $request->nama,
            'email' => Auth::user()->email, // Menggunakan email dari pengguna yang login
        ],
    ];

    // Dapatkan snap token dari Midtrans
    $snapToken = \Midtrans\Snap::getSnapToken($params);
    // dd($snapToken);
    // Return view dengan snapToken dan tiket
    return view('tickets.checkout', compact('snapToken', 'ticket', 'destinasi'));
}

}
