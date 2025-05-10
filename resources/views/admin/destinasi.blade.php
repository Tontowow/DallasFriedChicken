<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- My CSS -->
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{asset('css/style.css')}}">

    <title>Admin Menu</title>
</head>

<body>
    <!-- SIDEBAR -->
     <!-- SIDEBAR -->
     <section id="sidebar">
	<a href="{{ route('admin.dashboard') }}" class="brand">
        <i class='bx bxs-leaf'></i>
            <span class="text">Dallas</span>
        </a>
        <ul class="side-menu top">
        <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li class="active">
                <a href="{{ route('admin.destinasi') }}">
                    <i class='bx bxs-shopping-bag-alt'></i>
                    <span class="text">Menu</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.ticket') }}">
                    <i class='bx bxs-message-dots'></i>
                    <span class="text">Pesanan</span>
                </a>
            </li>
        </ul>

    </section>
    <!-- SIDEBAR -->

    <!-- CONTENT -->
    <section id="content">
        <!-- NAVBAR -->
        <nav>
            <i class='bx bx-menu'></i>
            <!-- <a href="#" class="nav-link">Categories</a> -->
            <form action="#">
                <div class="form-input">
                    <!-- <input type="search" placeholder="Search...">
                    <button type="submit" class="search-btn"><i class='bx bx-search'></i></button> -->
                </div>
            </form>
            <input type="checkbox" id="switch-mode" hidden>
            <label for="switch-mode" class="switch-mode"></label>

            <!-- Profile Dropdown -->
            <div class="relative">
                <button id="dropdownDefault" data-dropdown-toggle="dropdown" class="flex items-center space-x-2 text-gray-600 hover:text-gray-900">
                    <img class="w-8 h-8 rounded-full" src="{{ asset('images/profile.jpg') }}" alt="Profile Image">
                </button>

                <!-- Dropdown menu -->
                <div id="dropdown" class="hidden z-10 w-44 bg-white rounded-lg shadow-md dark:bg-gray-800 dark:text-white">
                    <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                        <!-- Displaying the name of the logged-in admin -->
                        <span class="font-medium">{{ Auth::user()->name }}</span>
                    </div>
                    <div class="px-4 py-2">
                        <!-- Logout button inside dropdown -->
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="block w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        
            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Menu</title>
                <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
            </head>

            <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
            <script src="{{asset('js/script.js')}}"></script>
</body>

</html>


<section class="bg-gray-50 py-8 antialiased dark:bg-gray-900 md:py-12">
    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        <div class="relative overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
            <div class="flex-row items-center justify-between p-4 space-y-3 sm:flex sm:space-y-0 sm:space-x-4">
                <div>
                    <h5 class="mr-3 font-semibold dark:text-white">Kelola Menu</h5>
                    <p class="text-gray-500 dark:text-gray-400">Dallas Solusi Saat Lapar</p>
                </div>
                <a href="{{ route('destinasi.create') }}" 
    class="flex items-center justify-center px-4 py-2 text-sm font-medium dark:text-white rounded-lg bg-green-500 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-2 -ml-1" viewBox="0 0 20 20" fill="currentColor"
        aria-hidden="true">
        <path
            d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z" />
    </svg>
    Add new Menu
</a>

            </div>
        </div>
        <div id="defaultModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
           
        </div>


        <!-- Destinasi Card -->
        <div class="mt-8 grid gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
            @foreach ($data as $item)
            <!-- Contoh Destinasi Card -->
            <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <img class="h-48 w-full object-cover rounded-md" src="{{ asset('storage/'. $item->gambar)}}" alt="{{ $item['nama'] }}">
                <div class="mt-4">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $item['nama'] }}</h3>
                    <p class="text-gray-500 dark:text-gray-400">
                        {{ \Illuminate\Support\Str::words($item['deskripsi'], 5, '...') }}
                    </p>
                    <p class="mt-2 text-blue-600 dark:text-blue-400 font-semibold">Rp. {{ number_format($item['harga'], 0, ',', '.') }}</p>
                    <a href="{{route('destinasi.showEdit',['id' => $item->id])}}" class="mt-4 inline-block px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded hover:bg-blue-700">
                        Edit Menu
                    </a>
                    <!-- Form Hapus Menu -->
<form id="deleteForm{{ $item->id }}" action="{{ route('destinasi.delete', ['id' => $item->id]) }}" method="POST" class="hidden">
    @csrf
    @method('DELETE')
</form>

<button type="button" onclick="showDeleteConfirmationModal({{ $item->id }})"
    class="mt-2 inline-block px-4 py-2 text-sm font-medium text-white bg-green-600 rounded hover:bg-green-700">
    Hapus Menu
</button>

<!-- Modal Konfirmasi Hapus -->
<div id="confirmationModal{{ $item->id }}" class="fixed inset-0  bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-white p-6 rounded-md shadow-lg w-96">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Konfirmasi Penghapusan</h3>
        <p class="text-gray-700 mb-4">Apakah Anda yakin ingin menghapus Menu ini?</p>
        <div class="flex justify-end space-x-4">
            <!-- Tombol Batal -->
            <button onclick="cancelDelete({{ $item->id }})" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md">Batal</button>
            <!-- Tombol Ya, Hapus -->
            <button onclick="confirmDelete({{ $item->id }})" class="px-4 py-2 bg-red-500 text-white rounded-md">Ya, Hapus</button>
        </div>
    </div>
</div>

<script>
    // Fungsi untuk menampilkan modal konfirmasi
    function showDeleteConfirmationModal(itemId) {
        document.getElementById("confirmationModal" + itemId).classList.remove("hidden");
    }

    // Fungsi untuk membatalkan penghapusan
    function cancelDelete(itemId) {
        document.getElementById("confirmationModal" + itemId).classList.add("hidden");
    }

    // Fungsi untuk mengonfirmasi penghapusan
    function confirmDelete(itemId) {
        document.getElementById("deleteForm" + itemId).submit(); // Mengirim form untuk menghapus destinasi
    }
</script>

                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>