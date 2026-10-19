<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-harjuna-dark leading-tight">
            {{ __('Manajemen Anggota') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @php
                // Deteksi role untuk URL dinamis
                $prefixRoute = auth()->user()->hasRole('ketua') ? 'dashboard.ketua.anggota.' : 'dashboard.sekretaris.anggota.';
            @endphp

            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-harjuna-wood/10">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-bold text-harjuna-dark">Daftar Anggota Karang Taruna</h3>
                        <a href="{{ route($prefixRoute . 'create') }}" class="bg-harjuna-dark text-white px-4 py-2 rounded-lg text-sm hover:bg-harjuna-medium transition">+ Tambah Anggota</a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-harjuna-cream text-harjuna-dark border-b-2 border-harjuna-gold">
                                    <th class="p-3 font-semibold">Nama</th>
                                    <th class="p-3 font-semibold">Divisi</th>
                                    <th class="p-3 font-semibold">Jabatan</th>
                                    <th class="p-3 font-semibold">Status</th>
                                    <th class="p-3 font-semibold text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($anggota as $item)
                                <tr class="border-b border-gray-100 hover:bg-gray-50">
                                    <td class="p-3">{{ $item->nama }}</td>
                                    <td class="p-3">{{ $item->divisi->nama ?? '-' }}</td>
                                    <td class="p-3">{{ $item->jabatan ?? 'Anggota' }}</td>
                                    <td class="p-3">
                                        <span class="px-2 py-1 rounded text-xs font-bold {{ $item->status == 'aktif' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    </td>
                                    <td class="p-3 text-center">
                                        <a href="{{ route($prefixRoute . 'edit', ['anggota' => $item->id]) }}" class="text-blue-600 hover:underline mr-3">Edit</a>
                                        <form action="{{ route($prefixRoute . 'destroy', ['anggota' => $item->id]) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus anggota ini?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="p-6 text-center text-gray-500">Belum ada data anggota.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-4">
                        {{ $anggota->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>