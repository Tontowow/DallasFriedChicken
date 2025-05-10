<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <!-- Navbar remains unchanged -->
    <nav x-data="{ open: false }" class="bg-white border-gray-200 dark:bg-gray-300">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-5">
            <a href="{{route('dashboard')}}" class="flex items-center space-x-2 rtl:space-x-reverse">
                <img src="{{asset('images/logo.png')}}" class="h-16" alt="Flowbite Logo" />
            </a>
            <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                <button type="button"
                    class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                    id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown"
                    data-dropdown-placement="bottom">
                    <span class="sr-only">Open user menu</span>
                    <img class="w-8 h-8 rounded-full"
                        src="{{asset('images/profile.jpg')}}"
                        alt="user photo">
                </button>
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
                            {{ __('History') }}
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
                <a href="{{route('dashboard')}}" class="text-gray-900 hover:text-gray-700 dark:text-white">Home</a>
                <a href="{{route('destinasi')}}" class="text-gray-900 hover:text-gray-700 dark:text-white">Menu</a>
                <a href="{{route('gallery')}}" class="text-gray-900 hover:text-gray-700 dark:text-white">Paket Spesial</a>
            </div>
        </div>
    </nav>

    <!-- Main Content with Sidebar -->
    <section class="bg-white py-8 sm:py-12">
        <div class="max-w-screen-xl mx-auto px-4 2xl:px-0 flex">
            
            <!-- Sidebar -->
            <div class="w-1/4 bg-gray-200 p-5 rounded-lg shadow-md dark:bg-gray-300 dark:border-gray-700">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Filter Kategori</h3>
                <form method="get" action="{{ route('destinasi') }}" class="space-y-4">
                    <div>
                        <input type="text" name="search" class="border border-gray-300 rounded-lg px-4 py-2 w-full" placeholder="Cari Menu" value="{{ request('search') }}" />
                    </div>
                    <div>
                        <select name="kategori" class="border border-gray-300 rounded-lg px-4 py-2 w-full">
                            <option value="">Semua Kategori</option>
                            <option value="alam" {{ request('kategori') == 'alam' ? 'selected' : '' }}>Ayam</option>
                            <option value="kuliner" {{ request('kategori') == 'kuliner' ? 'selected' : '' }}>Burger</option>
                            <option value="hiburan" {{ request('kategori') == 'hiburan' ? 'selected' : '' }}>Minuman</option>
                        </select>
                    </div>
                    <div>
                        <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-yellow-300 w-full">Filter</button>
                    </div>
                </form>
            </div>

            <!-- Main Content -->
            <div class="w-3/4 ml-8">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">{{ $judul }}</h2>
                <div class="mt-8 grid gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                    @foreach ($filteredDestinasi as $item)
                    <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 ">
                        <img class="h-48 w-full object-cover rounded-md" src="{{ asset('storage/'. $item->gambar)}}" alt="{{ $item['nama'] }}">
                        <div class="mt-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $item['nama'] }}</h3>
                            <p class="text-gray-500 dark:text-gray-400">
                                {{ \Illuminate\Support\Str::words($item['deskripsi'], 6, '...') }}
                            </p>
                            <p class="mt-2 text-blue-600 dark:text-blue-400 font-semibold">Rp. {{ number_format($item['harga'], 0, ',', '.') }}</p>
                            <a href="{{ route('tickets.create', ['destinasiId' => $item['id']]) }}"
                                class="mt-2 inline-block items-center px-4 py-2 text-sm font-medium text-white bg-red-600 rounded hover:bg-yellow-300">
                                Pesan
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>

</html>
