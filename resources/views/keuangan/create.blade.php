<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-harjuna-dark leading-tight">
            {{ __('Catat Transaksi Baru') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            
            @php
                $prefixRoute = auth()->user()->hasRole('ketua') ? 'dashboard.ketua.keuangan.' : 'dashboard.bendahara.keuangan.';
            @endphp

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl p-6 border border-harjuna-wood/10">
                <form action="{{ route($prefixRoute . 'store') }}" method="POST">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Jenis Transaksi</label>
                            <select name="jenis" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                <option value="masuk">Pemasukan (Kas Masuk)</option>
                                <option value="keluar">Pengeluaran (Kas Keluar)</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Kategori</label>
                            <select name="kategori_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                @foreach($kategori as $k)
                                    <option value="{{ $k->id }}">{{ $k->nama }} ({{ $k->jenis }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Jumlah (Rp)</label>
                            <input type="number" name="jumlah" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required placeholder="Contoh: 50000">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal</label>
                            <input type="date" name="tanggal" value="{{ date('Y-m-d') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Sumber / Tujuan (Opsional)</label>
                            <input type="text" name="sumber" placeholder="Contoh: Iuran Anggota / Beli ATK" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Keterangan Tambahan</label>
                            <textarea name="keterangan" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <a href="{{ route($prefixRoute . 'index') }}" class="mr-3 px-4 py-2 text-gray-600 hover:underline">Batal</a>
                        <button type="submit" class="bg-harjuna-dark text-white px-6 py-2 rounded-lg hover:bg-harjuna-medium transition">Simpan Transaksi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>