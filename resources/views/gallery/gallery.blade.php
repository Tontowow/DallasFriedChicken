<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dallas</title>

    <!-- Load Tailwind First -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Flowbite CSS -->
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
</head>

<body class="bg-white dark:bg-gray-300">

    <!-- Navbar -->
    <nav class="bg-white border-gray-200 dark:bg-gray-300">
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
                    <img class="w-8 h-8 rounded-full" src="{{asset('images/profile.jpg')}}" alt="user photo">
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
                                onclick="event.preventDefault(); this.closest('form').submit();">
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

    <!-- Hero Section -->
    <section class="bg-white py-8 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gray-800 rounded-2xl shadow-xl overflow-hidden relative">
                <div class="h-64 sm:h-96 w-full bg-gray-900 relative overflow-hidden">
                    <img src="images/banner2.jpg" alt="" class="absolute inset-0 w-full h-full object-cover object-center">
                </div>
            </div>
        </div>
    </section>

    <!-- Promo Section -->
    <section class="bg-white py-2 sm:py-4">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl lg:mx-0">
                <h2 class="text-4xl font-semibold tracking-tight text-gray-900 sm:text-xl">Promo dan Paket</h2>
                <div class="mt-4">
                    <a href="{{ route('gallery') }}" class="text-red-600 hover:text-yellow-300 font-medium inline-flex items-center">
                        Lihat Paket Spesial Lengkap
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>

            <div class="mx-auto mt-6 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-12 sm:mt-8 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                <!-- Promo Cards -->
                <div class="flex flex-col items-start">
                    <div class="relative w-full">
                        <img src="images/promo1.png" alt="Destination" class="aspect-[16/9] w-full rounded-2xl bg-gray-100 object-cover">
                    </div>
                    <div class="flex items-center gap-x-4 mt-4 text-sm">
                        <time datetime="2024-04-12" class="text-gray-500">April 12, 2024</time>
                        <span class="relative z-10 rounded-full bg-gray-100 px-3 py-1.5 font-medium text-gray-600">Menu</span>
                    </div>
                </div>

                <div class="flex flex-col items-start">
                    <div class="relative w-full">
                        <img src="images/promo1.png" alt="Food" class="aspect-[16/9] w-full rounded-2xl bg-gray-100 object-cover">
                    </div>
                    <div class="flex items-center gap-x-4 mt-4 text-sm">
                        <time datetime="2024-04-10" class="text-gray-500">April 10, 2024</time>
                        <span class="relative z-10 rounded-full bg-gray-100 px-3 py-1.5 font-medium text-gray-600">Kuliner</span>
                    </div>
                </div>

                <div class="flex flex-col items-start">
                    <div class="relative w-full">
                        <img src="images/promo1.png" alt="Package" class="aspect-[16/9] w-full rounded-2xl bg-gray-100 object-cover">
                    </div>
                    <div class="flex items-center gap-x-4 mt-4 text-sm">
                        <time datetime="2024-03-25" class="text-gray-500">March 25, 2024</time>
                        <span class="relative z-10 rounded-full bg-gray-100 px-3 py-1.5 font-medium text-gray-600">Paket Spesial</span>
                    </div>
                </div>
            </div>
        </div>

          
  <div class="bg-white py-2 sm:py-4"> <!-- Mengurangi padding di sini -->
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
      <div class="mx-auto max-w-2xl lg:mx-0">
        <h2 class="text-4xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-1xl">Cara Pesan di Dallas Fried Chicken</h2>
        <div class="mt-4">
            <a href="{{ route('destinasi') }}" class="text-red-600 hover:text-yellow-300 font-medium inline-flex items-center">
              Pilih menu sekarang
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
              </svg>
            </a>
          </div>
      </div>
    </div>
    <div class="bg-white py-8 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"> 
          <div class="bg-gray-800 rounded-2xl shadow-xl overflow-hidden relative">
          <div class="relative w-full">
                        <img src="images/deliv1.jpg" alt="Package" class="aspect-[16/9] w-full rounded-2xl bg-gray-100 object-cover">
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white py-12">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="flex flex-col items-center justify-center gap-8">
                <nav class="flex flex-wrap justify-center gap-6">
                    <a href="#" class="text-sm font-medium text-gray-600 hover:text-gray-900">About</a>
                    <a href="#" class="text-sm font-medium text-gray-600 hover:text-gray-900">Blog</a>
                    <a href="#" class="text-sm font-medium text-gray-600 hover:text-gray-900">Jobs</a>
                    <a href="#" class="text-sm font-medium text-gray-600 hover:text-gray-900">Press</a>
                    <a href="#" class="text-sm font-medium text-gray-600 hover:text-gray-900">Privacy</a>
                    <a href="#" class="text-sm font-medium text-gray-600 hover:text-gray-900">Partners</a>
                </nav>
                <p class="text-sm text-gray-500">© 2025 Dallas, All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Flowbite Script -->
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>

</html>
