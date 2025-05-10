<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiket Pemesanan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        .ticket-container {
            max-width: 600px;
            margin: 50px auto;
            background: #fff;
            border: 2px dashed #ccc;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .ticket-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .ticket-header img {
            max-width: 100px;
        }

        .ticket-header h1 {
            font-size: 1.8rem;
            color: #333;
        }

        .ticket-info {
            margin: 20px 0;
            border-collapse: collapse;
            width: 100%;
        }

        .ticket-info th,
        .ticket-info td {
            text-align: left;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .ticket-info th {
            color: #555;
            font-weight: bold;
            background-color: #f9f9f9;
        }

        .ticket-info td {
            color: #333;
        }

        .barcode {
            text-align: center;
            margin-top: 20px;
        }

        .barcode img {
            max-width: 500px;
        }

        .ticket-footer {
            margin-top: 20px;
            text-align: center;
            color: #777;
            font-size: 0.9rem;
        }

        .download-btn {
            display: block;
            margin: 30px auto;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .download-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="ticket-container" id="ticketContainer">
        <div class="ticket-header">
            <img src="{{ asset('images/logo2.png') }}" alt="Logo">
            <h1>Detail Tiket Pemesanan</h1>
        </div>

        <table class="ticket-info">
            <tr>
                <th>Nama Pemesan</th>
                <td>{{ $ticket->nama }}</td>
            </tr>
            <tr>
                <th>Destinasi</th>
                <td>{{ $ticket->destinasi->nama }}</td>
            </tr>
            <tr>
                <th>Tanggal</th>
                <td>{{ $ticket->tanggal }}</td>
            </tr>
            <tr>
                <th>Jumlah Tiket</th>
                <td>{{ $ticket->jumlah }}</td>
            </tr>
            <tr>
                <th>Total Harga</th>
                <td>Rp {{ number_format($ticket->total_harga, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ ucfirst($ticket->status) }}</td>
            </tr>
        </table>

        <div class="barcode">
            <p>Scan Barcode:</p>
            <img src="{{ asset('images/barcode.png') }}" alt="Barcode">
        </div>

        <div class="ticket-footer">
            <p>Terima kasih telah memesan tiket melalui Trektrove!</p>
        </div>

        <!-- Button to download PDF -->
        <button class="download-btn" id="downloadPDFBtn">Unduh PDF</button>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>


    <script>
    document.getElementById('downloadPDFBtn').addEventListener('click', function() {
        const element = document.getElementById('ticketContainer');
        const printButton = document.getElementById('downloadPDFBtn');

        // Sembunyikan tombol cetak
        printButton.style.display = 'none';

        const options = {
            filename: 'tiket-pemesanan.pdf',
            html2canvas: {
                scale: 3,  // Menentukan kualitas gambar yang lebih tinggi
                logging: true,
                letterRendering: true,
                useCORS: true,
            },
            jsPDF: {
                unit: 'mm',
                format: 'a4',
                orientation: 'portrait',
                margin: [10, 10, 10, 10],  // Menambahkan margin untuk menghindari pemotongan
            }
        };

        html2pdf().from(element).set(options).save().then(() => {
            // Tampilkan kembali tombol cetak setelah selesai
            printButton.style.display = 'block';
        }).catch((error) => {
            // Jika ada error, tetap tampilkan tombol cetak
            printButton.style.display = 'block';
            console.error('Error generating PDF:', error);
        });
    });
</script>




</body>
</html>
