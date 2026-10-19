<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Harjuna-Hub') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-harjuna-cream relative">
        
        <!-- Pattern Batik (Pakai SVG transparan sederhana) -->
        <div class="absolute inset-0 opacity-5 pointer-events-none" style="background-image: radial-gradient(circle, #1B4332 10%, transparent 11%), radial-gradient(circle, #1B4332 10%, transparent 11%); background-size: 40px 40px; background-position: 0 0, 20px 20px;"></div>

        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative z-10">
            <div>
                <a href="/" class="flex flex-col items-center">
                    <!-- Ganti dengan logo Sinomanku nanti -->
                    <div class="w-20 h-20 bg-harjuna-dark rounded-full flex items-center justify-center mb-4 shadow-lg border-4 border-harjuna-gold">
                        <span class="text-harjuna-gold font-serif-jawa text-3xl font-bold">H</span>
                    </div>
                    <h1 class="text-3xl font-serif-jawa font-bold text-harjuna-dark">Harjuna-Hub</h1>
                    <p class="text-sm text-harjuna-wood mt-1">Karang Taruna RW 06</p>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-8 px-8 py-10 bg-white shadow-2xl overflow-hidden sm:rounded-3xl border border-harjuna-wood/20">
                {{ $slot }}
            </div>
            
            <div class="mt-8 text-sm text-harjuna-wood/70">
                &copy; {{ date('Y') }} Karang Taruna RW 06.
            </div>
        </div>
    </body>
</html>