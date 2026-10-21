<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-harjuna-dark leading-tight">
            {{ __('Dashboard Anggota') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Kartu Sambutan & Profil -->
            <div class="bg-harjuna-dark rounded-2xl p-8 text-white relative overflow-hidden shadow-xl flex items-center justify-between">
                <div class="absolute inset-0 opacity-10" style="background-image: url('https://www.transparenttextures.com/patterns/batik.png');"></div>
                <div class="relative z-10">
                    <h1 class="text-3xl font-serif-jawa font-bold text-harjuna-gold">Sugeng Rawuh, {{ auth()->user()->nama }}!</h1>
                    <p class="mt-2 text-gray-200">Terima kasih telah menjadi bagian dari Karang Taruna RW 06.</p>
                    
                    @if($anggota)
                        <div class="mt-4 inline-flex items-center bg-white/10 px-4 py-2 rounded-lg border border-white/20">
                            <span class="text-sm text-gray-300 mr-2">Divisi:</span>
                            <span class="font-bold text-harjuna-gold">{{ $anggota->divisi->nama ?? 'Belum ada' }}</span>
                            <span class="mx-3 text-gray-500">|</span>
                            <span class="text-sm text-gray-300 mr-2">Jabatan:</span>
                            <span class="font-bold text-harjuna-gold">{{ $anggota->jabatan ?? 'Anggota' }}</span>
                        </div>
                    @endif
                </div>
            </div>

            @if($anggota)
            <!-- Tabel Iuran -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-harjuna-wood/10">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold text-harjuna-dark mb-4">Riwayat Kas Anggota</h3>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-harjuna-cream text-harjuna-dark border-b-2 border-harjuna-gold">
                                    <th class="p-3 font-semibold">Tahun</th>
                                    <th class="p-3 font-semibold">Bulan</th>
                                    <th class="p-3 font-semibold text-right">Nominal</th>
                                    <th class="p-3 font-semibold text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($iuran as $item)
                                <tr class="border-b border-gray-100 hover:bg-gray-50">
                                    <td class="p-3 font-medium">{{ $item->tahun }}</td>
                                    <td class="p-3">{{ $item->nama_bulan }}</td> <!-- Memanggil accessor dari Model Iuran -->
                                    <td class="p-3 text-right font-bold text-gray-700">
                                        Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                                    </td>
                                    <td class="p-3 text-center">
                                        <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide 
                                            {{ $item->status == 'lunas' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                            {{ $item->status }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="p-8 text-center text-gray-500">
                                        Belum ada catatan iuran untuk Anda.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @else
            <!-- Peringatan jika akun belum terhubung ke data anggota -->
            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-lg">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" /></svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-yellow-700">
                            Akun Anda belum terhubung dengan Data Anggota Karang Taruna. Silakan hubungi Sekretaris untuk melengkapi data Anda.
                        </p>
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
</x-app-layout>