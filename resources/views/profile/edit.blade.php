<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trektrove</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Navbar -->
    <body>
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
                <a href="{{route('dashboard')}}" class="text-gray-900 hover:text-gray-700 dark:text-white">Home</a>
                <a href="{{route('destinasi')}}" class="text-gray-900 hover:text-gray-700 dark:text-white">Menu</a>
                <a href="{{route('gallery')}}" class="text-gray-900 hover:text-gray-700 dark:text-white">Paket Spesial</a>
            </div>
        </div>
    </nav>
</head>

<body>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Grid Layout -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- User Info Section -->
                <div class="p-6 bg-white shadow-md rounded-lg">
                    <h3 class="text-lg font-bold mb-4">User info</h3>
                    <div>
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <!-- Password Section -->
                <div class="p-6 bg-white shadow-md rounded-lg">
                    <h3 class="text-lg font-bold mb-4">Password</h3>
                    <div>
                        @include('profile.partials.update-password-form')
                    </div>

                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>


                </div>
            </div>

            <!-- Save Changes Section -->
            <div class="flex justify-end space-x-4">
                <button class="bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2 px-4 rounded">
                    Save changes
                </button>
                <button class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded">
                    Discard
                </button>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>

</html>