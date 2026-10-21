<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Harjuna-Hub') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex">
            
            <!-- Kiri: Area Gambar/Ornamen -->
            <div class="hidden lg:flex w-1/2 bg-harjuna-dark relative items-center justify-center overflow-hidden">
                <div class="absolute inset-0 opacity-10" style="background-image: url('https://www.transparenttextures.com/patterns/batik.png');"></div>
                <div class="relative z-10 text-center px-12">
                    <div class="w-24 h-24 bg-harjuna-gold rounded-full flex items-center justify-center mx-auto mb-6 shadow-2xl border-4 border-white/20">
                        <span class="text-4xl font-serif-jawa font-bold text-harjuna-dark">H</span>
                    </div>
                    <h1 class="text-4xl font-serif-jawa font-bold text-harjuna-gold tracking-widest mb-4">HARJUNA-HUB</h1>
                    <p class="text-gray-300 text-lg">Sistem Informasi Manajemen<br>Karang Taruna RW 06</p>
                    <p class="mt-8 text-sm text-harjuna-gold/70 italic">"Sesarengan Mbangun Desa"</p>
                </div>
            </div>

            <!-- Kanan: Form Login -->
            <div class="w-full lg:w-1/2 flex items-center justify-center bg-harjuna-cream p-6 sm:p-12">
                <div class="w-full max-w-md">
                    <!-- Logo untuk Mobile -->
                    <div class="lg:hidden text-center mb-8">
                        <h1 class="text-3xl font-serif-jawa font-bold text-harjuna-dark tracking-widest">HARJUNA-HUB</h1>
                    </div>

                    <div class="bg-white px-8 py-10 shadow-2xl sm:rounded-3xl border border-harjuna-wood/10">
                        {{ $slot }}
                    </div>
                    
                    <div class="text-center mt-8 text-sm text-gray-500">
                        &copy; {{ date('Y') }} Karang Taruna RW 06.
                    </div>
                </div>
            </div>

        </div>
    </body>
</html>