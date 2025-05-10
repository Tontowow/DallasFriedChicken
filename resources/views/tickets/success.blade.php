<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Sukses</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            text-align: center;
            padding: 50px;
        }
        .container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 600px;
            margin: 0 auto;
        }
        h1 {
            color: #4CAF50;
        }
        .ticket-details {
            margin: 20px 0;
            text-align: left;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
        }
        .ticket-details td {
            padding: 8px 12px;
        }
        .ticket-details th {
            text-align: left;
            padding-right: 20px;
        }
        .btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        .btn:hover {
            background-color: #45a049;
        }
        .footer {
            margin-top: 20px;
            color: #777;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Pembayaran Sukses!</h1>
        <p>Terima kasih telah melakukan pembayaran. Tiket Anda berhasil dipesan.</p>
        
        <h3>Detail Tiket</h3>
        <table class="ticket-details">
            <tr>
                <th>Nama</th>
                <td>: {{$ticket->nama}}</td>
            </tr>
            <tr>
                <th>Jumlah</th>
                <td>: {{$ticket->jumlah}}</td>
            </tr>
            <tr>
                <th>Total Harga</th>
                <td>: Rp. {{number_format($ticket->total_harga, 0, ',', '.')}}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>: {{$ticket->status}}</td>
            </tr>
            <tr>
                <th>Tanggal Pemesanan</th>
                <td>: {{$ticket->created_at}}</td>
            </tr>
        </table>

        <a href="{{ route('home') }}" class="btn">Kembali ke Beranda</a>
    </div>

    <div class="footer">
        <p>&copy; 2024 Tiket Anda - Semua hak dilindungi.</p>
    </div>
</body>
</html>
