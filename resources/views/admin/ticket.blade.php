<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
	<link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />

	<title>Admin Pesanan</title>
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
            <li>
                <a href="{{ route('admin.destinasi') }}">
                    <i class='bx bxs-shopping-bag-alt'></i>
                    <span class="text">Menu</span>
                </a>
            </li>
			<li class="active">
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
        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Jalur Pesanan</h1>
                 
                </div>
            </div>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5">
				<div class="flex text-bold w-full text-xl py-4 px-4">
					<strong>Jalur Pesanan</strong>
				</div>
				<div class="overflow-x-auto">
					<table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
						<thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
							<tr>
								<th scope="col" class="px-4 py-3">Nama Pemesan</th>
								<th scope="col" class="px-4 py-3">Menu</th>
								<th scope="col" class="px-4 py-3">Tanggal</th>
								<th scope="col" class="px-4 py-3">Jumlah</th>
								<th scope="col" class="px-4 py-3">Total Harga</th>
								<th scope="col" class="px-4 py-3">Status</th>
							</tr>
						</thead>
						<tbody>
							@forelse($tickets as $ticket)
							<tr class="border-b dark:border-gray-700">
								<th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
									{{ $ticket->nama ?? 'N/A' }}
								</th>
								<td class="px-4 py-3">{{ $ticket->destinasi->nama ?? 'N/A' }}</td>
								<td class="px-4 py-3">{{ $ticket->tanggal }}</td>
								<td class="px-4 py-3">{{ $ticket->jumlah }}</td>
								<td class="px-4 py-3">Rp {{ number_format($ticket->total_harga, 0, ',', '.') }}</td>
								<td>
									<span class="status 
                @if($ticket->payment_status == 'paid') 
                    paid
                @elseif($ticket->payment_status == 'unpaid') 
                    unpaid
                @endif
            ">
										{{ ucfirst($ticket->payment_status) }}
									</span>
								</td>
							</tr>
							@empty
							<tr>
								<td colspan="5" class="px-4 py-3 text-center">Data Pesanan tidak tersedia</td>
							</tr>
							@endforelse
						</tbody>

					</table>
				</div>
			</section>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->

	<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
	<script src="{{asset('js/script.js')}}"></script>
</body>

</html>