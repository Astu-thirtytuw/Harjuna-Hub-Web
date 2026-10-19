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
    <body class="font-sans antialiased bg-harjuna-cream">
        <div class="min-h-screen flex">
            
            <!-- SIDEBAR -->
            <aside class="w-64 bg-harjuna-dark text-harjuna-cream flex-col hidden md:flex shadow-2xl z-20">
                <div class="h-20 flex items-center px-6 border-b border-white/10">
                    <h1 class="text-2xl font-serif-jawa font-bold text-harjuna-gold tracking-wider">Harjuna<span class="text-white">Hub</span></h1>
                </div>
                
                <nav class="flex-1 px-4 py-6 space-y-2">
                    <!-- Menu Dashboard -->
                    <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 text-gray-300 hover:text-white hover:bg-white/10 rounded-lg font-medium transition">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        Dashboard
                    </a>

                    <!-- Menu Data Anggota (Hanya Ketua & Sekretaris) -->
                    @if(auth()->user()->hasRole('sekretaris', 'ketua'))
                        @php
$routeAnggota = auth()->user()->hasRole('ketua') ? 'dashboard.ketua.anggota.index' : 'dashboard.sekretaris.anggota.index';
                        @endphp
                        <a href="{{ route($routeAnggota) }}" class="flex items-center px-4 py-3 text-gray-300 hover:text-white hover:bg-white/10 rounded-lg font-medium transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            Data Anggota
                        </a>
                    @endif
                </nav>
                
                <div class="p-4 border-t border-white/10">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-300 hover:text-red-100 transition">Log Out</button>
                    </form>
                </div>
            </aside>

            <!-- MAIN CONTENT -->
            <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
                <!-- HEADER -->
                <header class="bg-white shadow-sm h-16 flex items-center justify-between px-6 border-b border-harjuna-wood/10 z-10">
                    <h2 class="font-semibold text-xl text-harjuna-dark leading-tight">
                        {{ $header ?? 'Dashboard' }}
                    </h2>
                    <div class="flex items-center">
                        <span class="text-sm text-gray-600 mr-3">Halo, <strong class="text-harjuna-dark">{{ auth()->user()->nama }}</strong></span>
                        <div class="w-10 h-10 rounded-full bg-harjuna-medium text-white flex items-center justify-center font-bold">
                            {{ substr(auth()->user()->nama, 0, 1) }}
                        </div>
                    </div>
                </header>

                <!-- PAGE CONTENT -->
                <main class="flex-1 overflow-y-auto p-6">
                    {{ $slot }}
                </main>
            </div>
            
        </div>
    </body>
</html>