<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proses Pembayaran - Dallas Fried Chicken</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <!-- Navbar -->
    <nav x-data="{ open: false }" class="bg-white border-gray-200 dark:bg-gray-300">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-5">
            <a href="{{ route('dashboard') }}" class="flex items-center space-x-2 rtl:space-x-reverse">
                <img src="{{ asset('images/logo.png') }}" class="h-12" alt="Flowbite Logo" />
            </a>
            <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                <button type="button"
                    class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                    id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown"
                    data-dropdown-placement="bottom">
                    <span class="sr-only">Open user menu</span>
                    <img class="w-8 h-8 rounded-full" src="{{ asset('images/profile.jpg') }}" alt="user photo">
                </button>
                <!-- Dropdown menu -->
                <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600"
                    id="user-dropdown">
                    <div class="px-4 py-3">
                        <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                    <ul class="py-2" aria-labelledby="user-menu-button">
                        <li>
                            <x-responsive-nav-link :href="route('profile.edit')" class="text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                {{ __('Profile') }}
                            </x-responsive-nav-link>
                        </li>
                        <x-responsive-nav-link :href="route('user.tickets')" class="text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                            {{ __('Keranjang') }}
                        </x-responsive-nav-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-responsive-nav-link class="text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white" :href="route('logout')"
                                onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-responsive-nav-link>
                        </form>
                    </ul>
                </div>
            </div>

            <div class="flex items-center space-x-8">
                <!-- Menu Links -->
                <a href="{{ route('dashboard') }}" class="text-gray-900 hover:text-gray-700 dark:text-white">Home</a>
                <a href="{{ route('destinasi') }}" class="text-gray-900 hover:text-gray-700 dark:text-white">Menu</a>
                <a href="{{ route('gallery') }}" class="text-gray-900 hover:text-gray-700 dark:text-white">Paket Spesial</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Progress Steps -->
        <div class="flex justify-between mb-12">
            <div class="flex flex-col items-center">
                <div class="w-10 h-10 rounded-full bg-red-600 flex items-center justify-center text-white font-bold mb-2">1</div>
                <span class="text-sm font-medium text-gray-700">Keranjang</span>
            </div>
            <div class="flex flex-col items-center">
                <div class="w-10 h-10 rounded-full bg-red-600 flex items-center justify-center text-white font-bold mb-2">2</div>
                <span class="text-sm font-medium text-gray-700">Pembayaran</span>
            </div>
            <div class="flex flex-col items-center">
                <div class="w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center text-gray-600 font-bold mb-2">3</div>
                <span class="text-sm font-medium text-gray-500">Selesai</span>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Form Pembayaran -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Informasi Pembayaran</h2>
                    
                    <form method="POST" action="">
                        @csrf
                        <div class="mb-6">
                            <label class="block text-gray-700 font-medium mb-2">Metode Pembayaran</label>
                            <div class="grid grid-cols-2 gap-4">
                                <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:border-red-500">
                                    <input type="radio" name="payment" class="form-radio h-5 w-5 text-red-600" checked>
                                    <span class="ml-3">Transfer Bank</span>
                                </label>
                                <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:border-red-500">
                                    <input type="radio" name="payment" class="form-radio h-5 w-5 text-red-600">
                                    <span class="ml-3">E-Wallet</span>
                                </label>
                                <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:border-red-500">
                                    <input type="radio" name="payment" class="form-radio h-5 w-5 text-red-600">
                                    <span class="ml-3">COD</span>
                                </label>
                                <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:border-red-500">
                                    <input type="radio" name="payment" class="form-radio h-5 w-5 text-red-600">
                                    <span class="ml-3">Kartu Kredit</span>
                                </label>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label class="block text-gray-700 font-medium mb-2">Pilih Bank</label>
                            <select class="w-full px-4 py-2 border rounded-lg focus:ring-red-500 focus:border-red-500">
                                <option>BCA - 1234567890</option>
                                <option>Mandiri - 0987654321</option>
                                <option>BNI - 5647382910</option>
                            </select>
                        </div>

                        <div class="mb-6">
                            <label class="block text-gray-700 font-medium mb-2">Catatan Pesanan (Opsional)</label>
                            <textarea rows="3" class="w-full px-4 py-2 border rounded-lg focus:ring-red-500 focus:border-red-500" placeholder="Contoh: Pedas level 2, no acar"></textarea>
                        </div>
                        <button type="submit" class="block w-full py-3 bg-red-600 text-white rounded-lg font-bold hover:bg-red-700 transition-colors text-center">
                            Bayar Sekarang
                        </button>
                    </form>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Informasi Pengiriman</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Nama Penerima</label>
                            <input type="text" class="w-full px-4 py-2 border rounded-lg focus:ring-red-500 focus:border-red-500" value="{{ old('recipient_name', 'Farhan Solih') }}">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">No. Telepon</label>
                            <input type="tel" class="w-full px-4 py-2 border rounded-lg focus:ring-red-500 focus:border-red-500" value="{{ old('phone_number', '081234567890') }}">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-gray-700 font-medium mb-2">Alamat Lengkap</label>
                            <textarea rows="3" class="w-full px-4 py-2 border rounded-lg focus:ring-red-500 focus:border-red-500">{{ old('address', 'Jl. Sudirman No. 123, Jakarta Selatan') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Ringkasan Pesanan -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6 sticky top-28">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Ringkasan Pesanan</h2>
                    
                    <div class="space-y-4 mb-6">
                        <div class="flex justify-between">
                            <span class="text-gray-600">{{ $destinasi->nama }}</span>
                            <span class="font-medium">Rp {{ number_format($destinasi->harga, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Biaya Pengiriman</span>
                            <span class="font-medium">Rp 15.000</span>
                        </div>
                        <div class="flex justify-between border-t pt-3">
                            <span class="text-lg font-bold">Total</span>
                            <span class="text-lg font-bold text-red-600">Rp {{ number_format($destinasi->harga + 15000, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    
                    <form id="orderForm" action="{{ route('tickets.checkout', ['destinasiId' => $destinasi->id]) }}" method="POST" >
                        @csrf
                        <button type="button" onclick="showConfirmationModal()"
                            class="block w-full py-3 bg-red-600 text-white rounded-lg font-bold hover:bg-red-700 transition-colors text-center">
                            Bayar Sekarang
                        </button>   
                    </form>
                    
                    <p class="text-xs text-gray-500 mt-4 text-center">
                        Dengan melanjutkan, Anda menyetujui Syarat & Ketentuan kami
                    </p>
                </div>
            </div>
        </div>
    </div>

    

    <script>
        const userButton = document.getElementById('user-menu-button');
        const userDropdown = document.getElementById('user-dropdown');
  
        userButton.addEventListener('click', () => {
            userDropdown.classList.toggle('hidden');
        });
  
        // Optional: Close dropdown if clicked outside
        window.addEventListener('click', (e) => {
            if (!userButton.contains(e.target) && !userDropdown.contains(e.target)) {
                userDropdown.classList.add('hidden');
            }
        });
    </script>



<script>
    // Fungsi untuk menampilkan modal konfirmasi
    function showConfirmationModal() {
        document.getElementById("confirmationModal").classList.remove("hidden");
    }

    // Fungsi untuk menutup modal konfirmasi
    function cancelOrder() {
        document.getElementById("confirmationModal").classList.add("hidden");
    }

    // Fungsi untuk mengonfirmasi pemesanan
    function confirmOrder() {
        document.querySelector("form").submit(); // Mengirim form setelah konfirmasi
    }
</script>


</body>

</html>
