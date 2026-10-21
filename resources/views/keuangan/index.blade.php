<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-harjuna-dark leading-tight">
            {{ __('Manajemen Keuangan') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @php
                $prefixRoute = auth()->user()->hasRole('ketua') ? 'dashboard.ketua.keuangan.' : 'dashboard.bendahara.keuangan.';
            @endphp

            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Kartu Saldo -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-harjuna-wood/10 border-l-4 border-l-green-500">
                    <h4 class="text-gray-500 text-sm font-medium">Total Pemasukan</h4>
                    <p class="text-2xl font-bold text-green-600 mt-2">Rp {{ number_format($totalMasuk, 0, ',', '.') }}</p>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-harjuna-wood/10 border-l-4 border-l-red-500">
                    <h4 class="text-gray-500 text-sm font-medium">Total Pengeluaran</h4>
                    <p class="text-2xl font-bold text-red-600 mt-2">Rp {{ number_format($totalKeluar, 0, ',', '.') }}</p>
                </div>
                <div class="bg-harjuna-dark p-6 rounded-2xl shadow-lg border border-harjuna-gold/30">
                    <h4 class="text-harjuna-gold text-sm font-medium">Saldo Kas Saat Ini</h4>
                    <p class="text-3xl font-serif-jawa font-bold text-white mt-2">Rp {{ number_format($saldo, 0, ',', '.') }}</p>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-harjuna-wood/10">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-bold text-harjuna-dark">Riwayat Transaksi</h3>
                        <a href="{{ route($prefixRoute . 'create') }}" class="bg-harjuna-dark text-white px-4 py-2 rounded-lg text-sm hover:bg-harjuna-medium transition">+ Catat Transaksi</a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-harjuna-cream text-harjuna-dark border-b-2 border-harjuna-gold">
                                    <th class="p-3 font-semibold">Tanggal</th>
                                    <th class="p-3 font-semibold">Kategori</th>
                                    <th class="p-3 font-semibold">Keterangan</th>
                                    <th class="p-3 font-semibold text-right">Jumlah (Rp)</th>
                                    <th class="p-3 font-semibold text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($keuangan as $item)
                                <tr class="border-b border-gray-100 hover:bg-gray-50">
                                    <td class="p-3">{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                                    <td class="p-3">{{ $item->kategori->nama ?? '-' }}</td>
                                    <td class="p-3">{{ $item->keterangan ?? $item->sumber }}</td>
                                    <td class="p-3 text-right font-bold {{ $item->jenis == 'masuk' ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $item->jenis == 'masuk' ? '+' : '-' }} {{ number_format($item->jumlah, 0, ',', '.') }}
                                    </td>
                                    <td class="p-3 text-center">
                                        <form action="{{ route($prefixRoute . 'destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus transaksi ini?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="p-6 text-center text-gray-500">Belum ada data transaksi.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-4">
                        {{ $keuangan->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>