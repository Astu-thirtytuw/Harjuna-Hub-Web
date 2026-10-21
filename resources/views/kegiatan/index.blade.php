<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-harjuna-dark leading-tight">
            {{ __('Manajemen Kegiatan') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @php
                if(auth()->user()->hasRole('ketua')) $prefixRoute = 'dashboard.ketua.kegiatan.';
                elseif(auth()->user()->hasRole('korbid')) $prefixRoute = 'dashboard.korbid.kegiatan.';
                else $prefixRoute = 'dashboard.sekretaris.kegiatan.';
            @endphp

            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-harjuna-wood/10">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-bold text-harjuna-dark">Daftar Kegiatan</h3>
                        <a href="{{ route($prefixRoute . 'create') }}" class="bg-harjuna-dark text-white px-4 py-2 rounded-lg text-sm hover:bg-harjuna-medium transition">+ Tambah Kegiatan</a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-harjuna-cream text-harjuna-dark border-b-2 border-harjuna-gold">
                                    <th class="p-3 font-semibold">Nama Kegiatan</th>
                                    <th class="p-3 font-semibold">Tanggal</th>
                                    <th class="p-3 font-semibold">Divisi</th>
                                    <th class="p-3 font-semibold">Status</th>
                                    <th class="p-3 font-semibold text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($kegiatan as $item)
                                <tr class="border-b border-gray-100 hover:bg-gray-50">
                                    <td class="p-3 font-bold text-harjuna-dark">{{ $item->nama }}</td>
                                    <td class="p-3">{{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d M Y') }}</td>
                                    <td class="p-3">{{ $item->divisi->nama ?? '-' }}</td>
                                    <td class="p-3">
                                        <span class="px-2 py-1 rounded text-xs font-bold uppercase {{ $item->status == 'publish' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                            {{ $item->status }}
                                        </span>
                                    </td>
                                    <td class="p-3 text-center">
                                        <form action="{{ route($prefixRoute . 'destroy', ['kegiatan' => $item->id]) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus kegiatan ini?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="p-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-600 hover:text-white transition-colors duration-200" title="Hapus">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="p-6 text-center text-gray-500">Belum ada kegiatan.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">{{ $kegiatan->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>