<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex bg-gray-50 dark:bg-gray-900">
            <!-- Left Side: Hero & Branding (Hidden on mobile) -->
            <div class="hidden lg:flex lg:w-1/2 relative bg-indigo-900 items-center justify-center overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-900 to-indigo-900 opacity-90 z-10"></div>
                <!-- Background Pattern or Image -->
                <img src="https://images.unsplash.com/photo-1500382017468-9049fed747ef?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" 
                     alt="Desa Rambah Samo Barat" 
                     class="absolute inset-0 w-full h-full object-cover mix-blend-overlay opacity-50">
                
                <div class="relative z-20 text-white text-center p-12">
                    <x-application-logo class="w-24 h-24 mx-auto mb-6 fill-current text-white opacity-90" />
                    <h1 class="text-4xl font-bold tracking-tight mb-2">Sistem Informasi Desa</h1>
                    <h2 class="text-2xl font-light opacity-90">Rambah Samo Barat</h2>
                    <div class="w-24 h-1 bg-white mx-auto my-6 rounded-full opacity-50"></div>
                    <p class="text-lg opacity-80 max-w-md mx-auto">
                        Mewujudkan tata kelola pemerintahan desa yang transparan, akuntabel, dan melayani.
                    </p>
                </div>
            </div>

            <!-- Right Side: Form -->
            <div class="w-full lg:w-1/2 flex flex-col justify-center items-center p-8 bg-white dark:bg-gray-800">
                <div class="w-full max-w-md space-y-8">
                    <div class="lg:hidden text-center mb-8">
                        <x-application-logo class="w-16 h-16 mx-auto mb-4 fill-current text-indigo-600" />
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">SID Rambah Samo Barat</h2>
                    </div>

                    {{ $slot }}
                    
                    <div class="mt-8 text-center text-sm text-gray-500">
                        &copy; {{ date('Y') }} Pemerintah Desa Rambah Samo Barat. HAK CIPTA DILINDUNGI.
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
