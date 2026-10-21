<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-harjuna-dark leading-tight">
            {{ __('Tambah Kegiatan Baru') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            @php
                if(auth()->user()->hasRole('ketua')) $prefixRoute = 'dashboard.ketua.kegiatan.';
                elseif(auth()->user()->hasRole('korbid')) $prefixRoute = 'dashboard.korbid.kegiatan.';
                else $prefixRoute = 'dashboard.sekretaris.kegiatan.';
            @endphp

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl p-6 border border-harjuna-wood/10">
                <form action="{{ route($prefixRoute . 'store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Nama Kegiatan</label>
                            <input type="text" name="nama" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
                            <input type="date" name="tanggal_mulai" value="{{ date('Y-m-d') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Waktu (Jam)</label>
                            <input type="time" name="waktu_mulai" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Divisi Penyelenggara</label>
                            <select name="divisi_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                @foreach($divisi as $d)
                                    <option value="{{ $d->id }}">{{ $d->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Lokasi</label>
                            <input type="text" name="lokasi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                            <textarea name="deskripsi" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                <option value="draft">Draft (Belum Tayang)</option>
                                <option value="publish">Publish (Tayangkan)</option>
                            </select>
                        </div>
                        <div class="flex items-center mt-6">
                            <input type="checkbox" name="is_publik" id="is_publik" value="1" class="rounded border-gray-300 text-harjuna-dark shadow-sm" checked>
                            <label for="is_publik" class="ml-2 block text-sm text-gray-900 font-medium">Tampilkan di Halaman Depan (Publik)</label>
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end">
                        <a href="{{ route($prefixRoute . 'index') }}" class="mr-3 px-4 py-2 text-gray-600 hover:underline">Batal</a>
                        <button type="submit" class="bg-harjuna-dark text-white px-6 py-2 rounded-lg hover:bg-harjuna-medium transition">Simpan Kegiatan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>