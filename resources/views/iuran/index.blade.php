<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-harjuna-dark leading-tight">
            {{ __('Manajemen Kas Anggota') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Form Catat Iuran -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl p-6 border border-harjuna-wood/10">
                <h3 class="text-lg font-bold text-harjuna-dark mb-4">Catat Pembayaran Kas Bulanan</h3>
                <form action="{{ route('dashboard.bendahara.iuran.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-5 gap-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Anggota</label>
                        <select name="anggota_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm" required>
                            @foreach($anggota as $a)
                                <option value="{{ $a->id }}">{{ $a->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Bulan</label>
                        <select name="bulan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm" required>
                            @for($i=1; $i<=12; $i++)
                                <option value="{{ $i }}">{{ date('F', mktime(0,0,0,$i,1)) }}</option>
                            @endfor
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tahun</label>
                        <input type="number" name="tahun" value="{{ date('Y') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jumlah Kas (Rp)</label>
                        <input type="number" name="jumlah" value="10000" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm" required>
                    </div>
                    <div class="flex items-end">
                        <input type="hidden" name="status" value="lunas">
                        <button type="submit" class="w-full bg-harjuna-dark text-white px-4 py-2 rounded-lg hover:bg-harjuna-medium transition text-sm">Simpan</button>
                    </div>
                </form>
            </div>

            <!-- Tabel Iuran -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-harjuna-wood/10">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold text-harjuna-dark mb-4">Riwayat Kas Masuk</h3>
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-harjuna-cream text-harjuna-dark border-b-2 border-harjuna-gold">
                                <th class="p-3 font-semibold">Nama Anggota</th>
                                <th class="p-3 font-semibold">Bulan / Tahun</th>
                                <th class="p-3 font-semibold">Jumlah</th>
                                <th class="p-3 font-semibold">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($iuran as $item)
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="p-3 font-medium">{{ $item->anggota->nama ?? 'Terhapus' }}</td>
                                <td class="p-3">{{ $item->nama_bulan }} {{ $item->tahun }}</td>
                                <td class="p-3 text-right">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                                <td class="p-3">
                                    <span class="px-2 py-1 rounded text-xs font-bold uppercase {{ $item->status == 'lunas' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                        {{ $item->status }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="p-6 text-center text-gray-500">Belum ada data iuran.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4">{{ $iuran->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>