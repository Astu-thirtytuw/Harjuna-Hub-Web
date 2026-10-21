<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-harjuna-dark leading-tight">
            {{ __('Dashboard Ketua') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-harjuna-dark rounded-2xl p-8 mb-8 text-white relative overflow-hidden shadow-xl">
                <div class="absolute inset-0 opacity-10" style="background-image: url('https://www.transparenttextures.com/patterns/batik.png');"></div>
                <h1 class="text-3xl font-serif-jawa font-bold text-harjuna-gold relative z-10">Sugeng Rawuh, {{ auth()->user()->nama }}!</h1>
                <p class="mt-2 text-gray-200 relative z-10">Semoga hari ini membawa berkah untuk Karang Taruna RW 06.</p>
            </div>

            <!-- Kartu Statistik -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Anggota -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-harjuna-wood/10 flex items-center">
                    <div class="p-4 rounded-full bg-blue-100 text-blue-600 mr-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Anggota Aktif</p>
                        <p class="text-2xl font-bold text-harjuna-dark">{{ $stats['total_anggota'] }}</p>
                    </div>
                </div>

                <!-- Kas -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-harjuna-wood/10 flex items-center">
                    <div class="p-4 rounded-full bg-green-100 text-green-600 mr-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Saldo Kas</p>
                        <p class="text-xl font-bold text-harjuna-dark">Rp {{ number_format($stats['total_kas'], 0, ',', '.') }}</p>
                    </div>
                </div>

                <!-- Laporan -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-harjuna-wood/10 flex items-center">
                    <div class="p-4 rounded-full bg-red-100 text-red-600 mr-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Laporan Baru</p>
                        <p class="text-2xl font-bold text-harjuna-dark">{{ $stats['total_laporan_baru'] }}</p>
                    </div>
                </div>

                <!-- Pengumuman -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-harjuna-wood/10 flex items-center">
                    <div class="p-4 rounded-full bg-yellow-100 text-yellow-600 mr-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Pengumuman</p>
                        <p class="text-2xl font-bold text-harjuna-dark">{{ $stats['total_pengumuman'] }}</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>