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
    <body class="font-sans antialiased bg-harjuna-cream">
        <div class="min-h-screen flex">
            
            <!-- SIDEBAR -->
            <aside id="sidebar" class="hidden md:flex w-64 bg-harjuna-dark text-harjuna-cream flex-col shadow-2xl z-20">
                <div class="h-20 flex items-center px-6 border-b border-white/10">
                    <h1 class="text-2xl font-serif-jawa font-bold text-harjuna-gold tracking-wider">Harjuna<span class="text-white">Hub</span></h1>
                </div>
                
                <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                    <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 text-gray-300 hover:text-white hover:bg-white/10 rounded-lg font-medium transition">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        Dashboard
                    </a>

                    @if(auth()->user()->hasRole('sekretaris', 'ketua'))
                        @php $routeAnggota = auth()->user()->hasRole('ketua') ? 'dashboard.ketua.anggota.index' : 'dashboard.sekretaris.anggota.index'; @endphp
                        <a href="{{ route($routeAnggota) }}" class="flex items-center px-4 py-3 text-gray-300 hover:text-white hover:bg-white/10 rounded-lg font-medium transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            Data Anggota
                        </a>
                    @endif

                    @if(auth()->user()->hasRole('bendahara', 'ketua'))
                        @php $routeKeuangan = auth()->user()->hasRole('ketua') ? 'dashboard.ketua.keuangan.index' : 'dashboard.bendahara.keuangan.index'; @endphp
                        <a href="{{ route($routeKeuangan) }}" class="flex items-center px-4 py-3 text-gray-300 hover:text-white hover:bg-white/10 rounded-lg font-medium transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Keuangan
                        </a>
                        <a href="{{ auth()->user()->hasRole('ketua') ? route('dashboard.ketua.iuran.index') : route('dashboard.bendahara.iuran.index') }}" class="flex items-center px-4 py-3 text-gray-300 hover:text-white hover:bg-white/10 rounded-lg font-medium transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                            Kas Anggota
                        </a>
                    @endif

                    @if(auth()->user()->hasRole('sekretaris', 'ketua'))
                        @php $routePelayanan = auth()->user()->hasRole('ketua') ? 'dashboard.ketua.pelayanan.index' : 'dashboard.sekretaris.pelayanan.index'; @endphp
                        <a href="{{ route($routePelayanan) }}" class="flex items-center px-4 py-3 text-gray-300 hover:text-white hover:bg-white/10 rounded-lg font-medium transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                            Lapor Warga
                        </a>
                    @endif

                    @if(auth()->user()->hasRole('sekretaris', 'ketua'))
                        @php $routePengumuman = auth()->user()->hasRole('ketua') ? 'dashboard.ketua.pengumuman.index' : 'dashboard.sekretaris.pengumuman.index'; @endphp
                        <a href="{{ route($routePengumuman) }}" class="flex items-center px-4 py-3 text-gray-300 hover:text-white hover:bg-white/10 rounded-lg font-medium transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                            Pengumuman
                        </a>
                    @endif

                    @if(auth()->user()->hasRole('ketua', 'sekretaris', 'korbid'))
                        @php
                            if(auth()->user()->hasRole('ketua')) $routeKegiatan = 'dashboard.ketua.kegiatan.index';
                            elseif(auth()->user()->hasRole('korbid')) $routeKegiatan = 'dashboard.korbid.kegiatan.index';
                            else $routeKegiatan = 'dashboard.sekretaris.kegiatan.index';
                        @endphp
                        <a href="{{ route($routeKegiatan) }}" class="flex items-center px-4 py-3 text-gray-300 hover:text-white hover:bg-white/10 rounded-lg font-medium transition">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            Kegiatan
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
                <header class="bg-white shadow-sm h-16 flex items-center justify-between px-4 sm:px-6 border-b border-harjuna-wood/10 z-10">
                    <div class="flex items-center">
                        <!-- Tombol Hamburger -->
                        <button id="mobile-menu-btn" class="md:hidden mr-4 text-harjuna-dark focus:outline-none">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                        </button>

                        <h2 class="font-semibold text-xl text-harjuna-dark leading-tight">
                            {{ $header ?? 'Dashboard' }}
                        </h2>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('profile.edit') }}" class="text-sm text-gray-600 hover:text-harjuna-dark transition underline hidden sm:block">
                            Edit Profil
                        </a>
                        <div class="flex items-center">
                            <span class="text-sm text-gray-600 mr-3 hidden sm:block">Halo, <strong class="text-harjuna-dark">{{ auth()->user()->nama }}</strong></span>
                            <!-- Avatar Foto Profil -->
                            <div class="w-10 h-10 rounded-full bg-harjuna-medium text-white flex items-center justify-center font-bold overflow-hidden border border-harjuna-wood/20">
                                @if(auth()->user()->foto)
                                    <img src="{{ asset('storage/' . auth()->user()->foto) }}" class="w-full h-full object-cover">
                                @else
                                    {{ substr(auth()->user()->nama, 0, 1) }}
                                @endif
                            </div>
                        </div>
                    </div>
                </header>

                <!-- PAGE CONTENT -->
                <main class="flex-1 overflow-y-auto p-6">
                    {{ $slot }}
                </main>
            </div>
        </div>

        <!-- SCRIPT MOBILE MENU (Hanya 1 Saja) -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const btn = document.getElementById('mobile-menu-btn');
                const sidebar = document.getElementById('sidebar');
                
                if (btn && sidebar) {
                    btn.addEventListener('click', function() {
                        sidebar.classList.toggle('hidden');
                        sidebar.classList.toggle('absolute'); 
                        sidebar.classList.toggle('h-full');   
                    });
                }
            });
        </script>
    </body>
</html>