<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-harjuna-dark leading-tight">
            {{ __('Tambah Anggota Baru') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            
            @php
               $prefixRoute = auth()->user()->hasRole('ketua') ? 'dashboard.ketua.anggota.' : 'dashboard.sekretaris.anggota.';
            @endphp

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl p-6 border border-harjuna-wood/10">
                <form action="{{ route($prefixRoute . 'store') }}" method="POST">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                            <input type="text" name="nama" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-harjuna-gold focus:ring-harjuna-gold" required>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700">NIK (Opsional)</label>
                            <input type="text" name="nik" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-harjuna-gold focus:ring-harjuna-gold">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">No. HP</label>
                            <input type="text" name="no_hp" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-harjuna-gold focus:ring-harjuna-gold">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Divisi</label>
                            <select name="divisi_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                @foreach($divisi as $d)
                                    <option value="{{ $d->id }}">{{ $d->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Jabatan (Opsional)</label>
                            <input type="text" name="jabatan" placeholder="Contoh: Anggota / Koordinator" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                <option value="aktif">Aktif</option>
                                <option value="nonaktif">Non-Aktif</option>
                                <option value="alumni">Alumni</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal Gabung</label>
                            <input type="date" name="tanggal_gabung" value="{{ date('Y-m-d') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <a href="{{ route($prefixRoute . 'index') }}" class="mr-3 px-4 py-2 text-gray-600 hover:underline">Batal</a>
                        <button type="submit" class="bg-harjuna-dark text-white px-6 py-2 rounded-lg hover:bg-harjuna-medium transition">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>