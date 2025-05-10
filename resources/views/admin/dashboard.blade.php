<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- Flowbite CSS -->
    <link href="https://cdn.jsdelivr.net/npm/flowbite@1.5.1/dist/flowbite.min.css" rel="stylesheet">
    
    <!-- My CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <title>Admin Dashboard</title>
</head>

<body>
    <!-- SIDEBAR -->
    <section id="sidebar">
	<a href="{{ route('admin.dashboard') }}" class="brand">
        <i class='bx bxs-leaf'></i>
            <span class="text">Dallas</span>
        </a>
        <ul class="side-menu top">
            <li class="active">
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
        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Dashboard</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a href="#">Dashboard</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>
                            <a class="active" href="#">Home</a>
                        </li>
                    </ul>
                </div>
            </div>

            <ul class="box-info">
                <li>
                    <i class='bx bxs-chart'></i>
                    <span class="text">
                        <h3>{{ $countTicket }}</h3>
                        <p>Pesanan Terjual</p>
                    </span>
                </li>
                <li>
                    <i class='bx bxs-group'></i>
                    <span class="text">
                        <h3>{{ $countUser }}</h3>
                        <p>User Registered</p>
                    </span>
                </li>
                <li>
                    <i class='bx bxs-home'></i>
                    <span class="text">
                        <h3>{{ $countDestinasi }}</h3>
                        <p>Total Menu</p>
                    </span>
                </li>
            </ul>

            <div class="table-data">
                <div class="order">
                    <div class="head">
                        <h3>Recent Orders</h3>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Date Order</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentTickets as $ticket)
                            <tr>
                                <td>
                                    <!-- Assuming there's a relationship between Ticket and User -->
                                    <p>{{ $ticket->user->name ?? 'N/A' }}</p>
                                </td>
                                <td>{{ $ticket->created_at->format('Y-m-d') }}</td>
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
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="todo">
                    <div class="head">
                        <h3>Recent Pesanan</h3>
                    </div>
                    <ul class="todo-list">
                        @foreach($recentDestinasi as $destinasi)
                        <li class="completed">
                            <p>{{ $destinasi->nama ?? 'No Destination Available' }}</p>
                        </li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->

    <!-- Flowbite JS -->
    <script src="https://cdn.jsdelivr.net/npm/flowbite@1.5.1/dist/flowbite.min.js"></script>
	<script src="{{asset('js/script.js')}}"></script>
    <script>
        // Dropdown toggle
        document.getElementById('dropdownDefault').addEventListener('click', function() {
            document.getElementById('dropdown').classList.toggle('hidden');
        });
    </script>

</body>

</html>
