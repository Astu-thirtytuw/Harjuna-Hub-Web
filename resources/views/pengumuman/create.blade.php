<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-harjuna-dark leading-tight">
            {{ __('Buat Pengumuman Baru') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            @php
                $prefixRoute = auth()->user()->hasRole('ketua') ? 'dashboard.ketua.pengumuman.' : 'dashboard.sekretaris.pengumuman.';
            @endphp

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl p-6 border border-harjuna-wood/10">
                <!-- enctype wajib ada untuk upload file -->
                <form action="{{ route($prefixRoute . 'store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Judul Berita / Pengumuman</label>
                            <input type="text" name="judul" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Kategori</label>
                            <select name="kategori" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                <option value="berita">Berita Acara</option>
                                <option value="pengumuman">Pengumuman Resmi</option>
                                <option value="artikel">Artikel / Tulisan</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Isi Konten</label>
                            <textarea name="isi" rows="8" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required placeholder="Tulis isi berita di sini..."></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Upload Gambar (Opsional)</label>
                            <input type="file" name="gambar" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-harjuna-cream file:text-harjuna-dark hover:file:bg-harjuna-gold">
                        </div>

                        <div class="flex items-center mt-2">
                            <input type="checkbox" name="is_publik" id="is_publik" value="1" class="rounded border-gray-300 text-harjuna-dark shadow-sm focus:ring-harjuna-gold" checked>
                            <label for="is_publik" class="ml-2 block text-sm text-gray-900 font-medium">Publish langsung ke Halaman Depan (Web Publik)</label>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <a href="{{ route($prefixRoute . 'index') }}" class="mr-3 px-4 py-2 text-gray-600 hover:underline">Batal</a>
                        <button type="submit" class="bg-harjuna-dark text-white px-6 py-2 rounded-lg hover:bg-harjuna-medium transition">Simpan & Publikasikan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>