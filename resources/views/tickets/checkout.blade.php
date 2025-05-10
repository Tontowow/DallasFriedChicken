<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan Produk</title>

    <!-- Load Midtrans Script -->
    <script type="text/javascript"
        src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>

    <!-- Internal Styling for Better Look -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #5c6bc0;
            font-size: 2rem;
        }

        .ticket-info {
            display: flex;
            justify-content: space-between;
            padding: 10px;
            background-color: #f1f1f1;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .ticket-info div {
            flex: 1;
            padding: 5px;
            font-size: 1.1rem;
        }

        .ticket-info div:first-child {
            font-weight: bold;
            color: #555;
        }

        .ticket-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .pay-button {
            display: block;
            width: 100%;
            padding: 15px;
            background-color: #5c6bc0;
            color: white;
            font-size: 1.2rem;
            text-align: center;
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .pay-button:hover {
            background-color: #3f51b5;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 50;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: white;
            margin: 15% auto;
            padding: 20px;
            border-radius: 10px;
            width: 80%;
            max-width: 400px;
            text-align: center;
        }

        .close {
            color: #aaa;
            font-size: 28px;
            font-weight: bold;
            position: absolute;
            top: 0;
            right: 10px;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Detail Pemesanan Tiket</h2>

        <!-- Gambar destinasi diambil dari URL tiket -->
        <img src="{{ asset('storage/'. $destinasi->gambar)}}" alt="Destinasi" class="ticket-image">

        <!-- Informasi tiket -->
        <div class="ticket-info">
            <div>Destinasi</div>
            <div>: {{$destinasi->nama}}</div>
        </div>
        <div class="ticket-info">
            <div>Nama</div>
            <div>: {{$ticket->nama}}</div>
        </div>
        <div class="ticket-info">
            <div>Jumlah</div>
            <div>: {{$ticket->jumlah}}</div>
        </div>
        <div class="ticket-info">
            <div>Total Bayar</div>
            <div>: Rp. {{$ticket->total_harga}}</div>
        </div>

        <!-- Button Bayar -->
        <button class="pay-button" id="pay-button">Bayar Sekarang</button>

    </div>

    <!-- Main Modal -->
    <div id="successModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeModal">&times;</span>
            <div class="w-12 h-12 rounded-full bg-green-100 dark:bg-green-900 p-2 flex items-center justify-center mx-auto mb-3.5">
                <svg aria-hidden="true" class="w-8 h-8 text-green-500 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <p class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">Pembayaran Berhasil!</p>
        </div>
    </div>

    <form id="paymentForm" method="POST" action="{{ route('tickets.success', $destinasi->id) }}" style="display:none;">
        @csrf
        <input type="text" name="snap" value="{{$snapToken}}">
        <input type="text" name="tanggal" value="{{$ticket->tanggal}}">
        <button type="submit" id="submit">submit</button>
    </form>

    <script type="text/javascript">
        var payButton = document.getElementById('pay-button');
        var successModal = document.getElementById('successModal');
        var closeModal = document.getElementById('closeModal');
        var continueBtn = document.getElementById('continueBtn');

        payButton.addEventListener('click', function() {
            // Ensure that snapToken is available
            var snapToken = '{{$snapToken}}'; // Make sure this is correctly passed and not empty


            if (snapToken) {
                // Trigger snap popup
                window.snap.pay(snapToken, {
                    onSuccess: function(result) {
                        // Show the modal
                        successModal.style.display = "block";
                        console.log(result);

                        // Hide the submit button initially (optional)
                        var submitButton = document.getElementById("submit");
                        submitButton.style.display = "none";

                        // Redirect after 2 seconds
                        setTimeout(function() {
                            // Automatically trigger the button click
                            submitButton.click();
                        }, 2000); // 2-second delay before clicking the button
                    },
                    onPending: function(result) {
                        alert("Waiting for your payment!");
                        console.log(result);
                    },
                    onError: function(result) {
                        alert("Payment Failed!");
                        console.log(result);
                    },
                    onClose: function() {
                        alert('You closed the popup without finishing the payment');
                    }
                });
            } else {
                alert('Payment token not available');
            }
        });

        // Close the modal
        closeModal.addEventListener('click', function() {
            successModal.style.display = "none";
        });

        // Continue button to close modal and redirect
        continueBtn.addEventListener('click', function() {
            successModal.style.display = "none";
            window.location.href = "{{ route('destinasi.show', $destinasi->id) }}"; // Replace with the actual redirect route
        });
    </script>
</body>

</html>