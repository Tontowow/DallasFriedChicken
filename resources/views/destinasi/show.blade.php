<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Destinasi</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
</head>

<body>
    <nav x-data="{ open: false }" class="bg-white border-gray-200 dark:bg-gray-900">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-5">
            <a href="{{route('dashboard')}}" class="flex items-center space-x-2 rtl:space-x-reverse">
                <img src="{{asset('images/logo2.png')}}" class="h-12" alt="Flowbite Logo" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Dallas</span>
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
            </div>
        </div>
    </nav>

    <div class="mx-auto max-w-screen-md px-4 py-12">
        <div class="bg-white rounded-lg shadow-md overflow-hidden dark:bg-gray-800">
            <img class="w-full h-64 object-cover" src="{{ asset('storage/'. $destinasi->gambar)}}" alt="{{ $destinasi['nama'] }}">
            <div class="p-6">
                <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $destinasi['nama'] }}</h2>
                <p class="mt-4 text-gray-700 dark:text-gray-300">{{ $destinasi['deskripsi'] }}</p>
                <p class="mt-4 text-blue-600 dark:text-blue-400 font-semibold">Harga: Rp. {{ number_format($destinasi['harga'], 0, ',', '.') }}</p>
                <a href="{{ route('destinasi') }}" class="mt-6 inline-block px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded hover:bg-blue-700">Kembali</a>
                <a href="{{ route('tickets.create', ['destinasiId' => $destinasi['id']]) }}"
                   class="mt-2 inline-block px-4 py-2 text-sm font-medium text-white bg-green-600 rounded hover:bg-green-700">Pesan Tiket</a>
            </div>
        </div>

        <!-- Form Rating dan Ulasan -->
        <div class="mt-8 bg-white p-6 rounded-lg shadow-md dark:bg-gray-800">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Berikan Rating dan Ulasan</h3>
            <form method="POST" action="{{ route('destinasi.ulasan', ['id' => $destinasi['id']]) }}" class="mt-4">
                @csrf
                <label for="rating" class="text-gray-700 dark:text-gray-300">Rating:</label>
                <select id="rating" name="ulasan" class="mt-2 block w-full p-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600">
                    <option value="0">Pilih Rating</option>
                    <option value="1">1 - Buruk</option>
                    <option value="2">2 - Cukup</option>
                    <option value="3">3 - Baik</option>
                    <option value="4">4 - Sangat Baik</option>
                    <option value="5">5 - Luar Biasa</option>
                </select>

                <button type="submit" class="mt-4 inline-block px-6 py-2 text-sm font-medium text-white bg-blue-600 rounded hover:bg-blue-700">
                    Kirim Ulasan
                </button>
            </form>
        </div>

        <!-- Ulasan Pengunjung -->
        <div class="mt-8 bg-white p-6 rounded-lg shadow-md dark:bg-gray-800">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Ulasan Pengunjung</h3>
            @if (!empty($ulasan))
            @foreach ($ulasan as $item)
            <div class="mt-4 p-4 border-b border-gray-200 dark:border-gray-600">
                <p class="text-yellow-500">{{$item->users->name}} : {{ str_repeat('★', $item['ulasan']) . str_repeat('☆', 5 - $item['ulasan']) }}</p>
            </div>
            @endforeach
            @else
            <p class="text-gray-500 dark:text-gray-400">Belum ada ulasan untuk destinasi ini.</p>
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>

</html>
