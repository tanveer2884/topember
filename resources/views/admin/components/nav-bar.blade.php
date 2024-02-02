<header class="z-10 py-4 bg-white shadow-md dark:bg-gray-800">
    <div class="container flex items-center justify-between h-full px-6 mx-auto text-purple-600 dark:text-purple-300">
        <!-- Mobile hamburger -->
        <button class="p-1 mr-5 -ml-1 rounded-md md:hidden focus:outline-none focus:shadow-outline-purple"
            @click="toggleSideMenu" aria-label="Menu">
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                    clip-rule="evenodd">
                </path>
            </svg>
        </button>
        <div class="flex justify-center flex-1 lg:mr-32"></div>
        <ul class="flex items-center flex-shrink-0 space-x-6">
            <!-- Theme toggler -->
            <li class="flex hidden">
                <x-admin.components.theme-toggler />
            </li>
            <!-- Notifications menu -->
            <li class="relative hidden">
                <x-admin.components.notifications />
            </li>
            <!-- Profile menu -->
            <li class="relative" x-data="{ profileOpen: false }" @click.outside="profileOpen = false">
                <button @click="profileOpen = !profileOpen" aria-label="Account" aria-haspopup="true"
                    class="focus:outline-none">
                    <img class="object-cover w-8 h-8 rounded-full" src="{{ auth()->user()->profileImageUrl }}"
                        alt="" aria-hidden="true" />
                </button>
                <!-- Dropdown menu for the user profile -->
                <div x-cloak
                    class="absolute right-0 mt-2 align-middle bg-white rounded-md rounded-full shadow-lg top-full ring-1 ring-black ring-opacity-5 focus:outline-none focus:shadow-outline-purple"
                    x-show="profileOpen" @click.away="profileOpen = false">
                    <a href="{{ route('admin.staff.profile') }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                    <hr class="my-1 border-gray-200">
                    <livewire:admin.auth.admin-logout-controller :isSideBar="true" />

                    <!-- Add more dropdown options if needed -->
                </div>
            </li>
        </ul>
    </div>
</header>
