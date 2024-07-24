<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" sizes="57x57" href="/frontend/images/fav-icon.png">
    <title>{{ $title ?? __('global.dashboard') }} | {{ config('app.name') }} Admin</title>
    @include('admin.layouts.css')
</head>

<body>
    <div class="flex h-screen bg-gray-100 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">

        <x-admin.components.side-bar />

        <div class="flex flex-col flex-1 w-full">

            <x-admin.components.nav-bar />

            <main class="h-full overflow-y-auto">
                <div class="container grid px-6 py-6 mx-auto">

                    <div class="flex items-center justify-between">
                        <strong class="text-lg font-bold md:text-2xl dark:text-white">
                            @yield('page_title', $title)
                        </strong>

                        {{ $actionButton ?? '' }}

                    </div>

                    <div class="w-full py-4 mb-8 rounded-lg shadow-xs">
                        {{ $slot ?? '' }}
                        @yield('page')
                    </div>
                </div>
            </main>
        </div>
    </div>

    <x-notify-component />
    @include('admin.layouts.js')
    @stack('js')

</body>

</html>
