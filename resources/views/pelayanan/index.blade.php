<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-harjuna-dark leading-tight">
            {{ __('Laporan & Pelayanan Warga') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @php
                $prefixRoute = auth()->user()->hasRole('ketua') ? 'dashboard.ketua.pelayanan.' : 'dashboard.sekretaris.pelayanan.';
            @endphp

            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-harjuna-wood/10">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold text-harjuna-dark mb-6">Daftar Laporan Masuk</h3>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-harjuna-cream text-harjuna-dark border-b-2 border-harjuna-gold">
                                    <th class="p-3 font-semibold">Tiket / Tanggal</th>
                                    <th class="p-3 font-semibold">Pelapor</th>
                                    <th class="p-3 font-semibold">Laporan</th>
                                    <th class="p-3 font-semibold">Status</th>
                                    <th class="p-3 font-semibold text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pelayanan as $item)
                                <tr class="border-b border-gray-100 hover:bg-gray-50">
                                    <td class="p-3">
                                        <span class="font-bold font-mono text-harjuna-dark block">{{ $item->kode_tiket }}</span>
                                        <span class="text-xs text-gray-500">{{ $item->created_at->format('d/m/Y') }}</span>
                                    </td>
                                    <td class="p-3">
                                        <span class="block font-medium">{{ $item->nama_pelapor }}</span>
                                        <span class="text-xs text-gray-500">{{ $item->no_hp }}</span>
                                    </td>
                                    <td class="p-3">
                                        <span class="block font-bold">{{ $item->judul }}</span>
                                        <span class="text-xs text-gray-500">{{ Str::limit($item->deskripsi, 50) }}</span>
                                    </td>
                                    <td class="p-3">
                                        @php
                                            $statusColor = match($item->status) {
                                                'baru' => 'bg-red-100 text-red-700',
                                                'diproses' => 'bg-yellow-100 text-yellow-700',
                                                'selesai' => 'bg-green-100 text-green-700',
                                                default => 'bg-gray-100 text-gray-700',
                                            };
                                        @endphp
                                        <span class="px-2 py-1 rounded text-xs font-bold uppercase {{ $statusColor }}">
                                            {{ $item->status }}
                                        </span>
                                    </td>
                                    <td class="p-3 text-center">
                                        <!-- Form Ubah Status -->
                                        <form action="{{ route($prefixRoute . 'update', ['pelayanan' => $item->id]) }}" method="POST" class="flex items-center justify-center space-x-2">
                                            @csrf
                                            @method('PUT')
                                            <select name="status" class="text-sm border-gray-300 rounded-md shadow-sm py-1" onchange="this.form.submit()">
                                                <option value="baru" {{ $item->status == 'baru' ? 'selected' : '' }}>Baru</option>
                                                <option value="diverifikasi" {{ $item->status == 'diverifikasi' ? 'selected' : '' }}>Verifikasi</option>
                                                <option value="diproses" {{ $item->status == 'diproses' ? 'selected' : '' }}>Proses</option>
                                                <option value="selesai" {{ $item->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                                <option value="ditolak" {{ $item->status == 'ditolak' ? 'selected' : '' }}>Tolak</option>
                                            </select>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="p-6 text-center text-gray-500">Belum ada laporan masuk dari warga.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-4">
                        {{ $pelayanan->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>