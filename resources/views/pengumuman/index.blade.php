<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-harjuna-dark leading-tight">
            {{ __('Manajemen Pengumuman & Berita') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @php
                $prefixRoute = auth()->user()->hasRole('ketua') ? 'dashboard.ketua.pengumuman.' : 'dashboard.sekretaris.pengumuman.';
            @endphp

            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-harjuna-wood/10">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-bold text-harjuna-dark">Daftar Publikasi</h3>
                        <a href="{{ route($prefixRoute . 'create') }}" class="bg-harjuna-dark text-white px-4 py-2 rounded-lg text-sm hover:bg-harjuna-medium transition">+ Buat Pengumuman</a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-harjuna-cream text-harjuna-dark border-b-2 border-harjuna-gold">
                                    <th class="p-3 font-semibold">Judul</th>
                                    <th class="p-3 font-semibold">Kategori</th>
                                    <th class="p-3 font-semibold">Status</th>
                                    <th class="p-3 font-semibold">Tanggal</th>
                                    <th class="p-3 font-semibold text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pengumuman as $item)
                                <tr class="border-b border-gray-100 hover:bg-gray-50">
                                    <td class="p-3 font-medium">{{ $item->judul }}</td>
                                    <td class="p-3">{{ ucfirst($item->kategori) }}</td>
                                    <td class="p-3">
                                        <span class="px-2 py-1 rounded text-xs font-bold {{ $item->is_publik ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                            {{ $item->is_publik ? 'Publik' : 'Draft' }}
                                        </span>
                                    </td>
                                    <td class="p-3 text-sm">{{ $item->created_at->format('d/m/Y') }}</td>
                                    <td class="p-3 text-center">
                                        <form action="{{ route($prefixRoute . 'destroy', ['pengumuman' => $item->id]) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus pengumuman ini?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="p-6 text-center text-gray-500">Belum ada pengumuman.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-4">
                        {{ $pengumuman->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>