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

            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-harjuna-wood/10">
                <div class="p-6 text-gray-900">
                    
                    <!-- Header Tabel & Tombol Aksi -->
                    <div class="flex flex-col sm:flex-row justify-between items-center mb-6 space-y-3 sm:space-y-0">
                        <h3 class="text-lg font-bold text-harjuna-dark">Daftar Anggota Karang Taruna</h3>
                        
                        <div class="flex space-x-2">
                            <!-- Tombol Ekspor Excel -->
                            <a href="{{ auth()->user()->hasRole('ketua') ? route('dashboard.ketua.anggota.ekspor') : route('dashboard.sekretaris.anggota.ekspor') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-green-700 transition flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                Ekspor Excel (CSV)
                            </a>
                            
                            <!-- Tombol Tambah Anggota -->
                            <a href="{{ route($prefixRoute . 'create') }}" class="bg-harjuna-dark text-white px-4 py-2 rounded-lg text-sm hover:bg-harjuna-medium transition flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                Tambah Anggota
                            </a>
                        </div>
                    </div>

                    <!-- Tabel Data -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-harjuna-cream text-harjuna-dark border-b-2 border-harjuna-gold">
                                    <th class="p-4 font-semibold">Nama</th>
                                    <th class="p-4 font-semibold">Divisi</th>
                                    <th class="p-4 font-semibold">Jabatan</th>
                                    <th class="p-4 font-semibold">Status</th>
                                    <th class="p-4 font-semibold text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($anggota as $item)
                                <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                                    
                                    <!-- 1. Kolom Foto, Nama & Email -->
                                    <td class="p-4 flex items-center space-x-3">
                                        @if($item->foto)
                                            <img src="{{ asset('storage/' . $item->foto) }}" class="w-10 h-10 rounded-full object-cover border border-gray-200">
                                        @else
                                            <div class="w-10 h-10 rounded-full bg-harjuna-medium text-white flex items-center justify-center font-bold">
                                                {{ substr($item->nama, 0, 1) }}
                                            </div>
                                        @endif
                                        <div>
                                            <div class="font-bold text-harjuna-dark text-base">{{ $item->nama }}</div>
                                            @if($item->user)
                                                <div class="text-xs text-gray-500 font-mono mt-1">{{ $item->user->email }}</div>
                                            @else
                                                <div class="text-xs text-red-400 italic mt-1">Belum punya akun</div>
                                            @endif
                                        </div>
                                    </td>

                                    <!-- 2. Kolom Divisi -->
                                    <td class="p-4 text-gray-700">
                                        {{ $item->divisi->nama ?? '-' }}
                                    </td>

                                    <!-- 3. Kolom Jabatan -->
                                    <td class="p-4 text-gray-700">
                                        {{ $item->jabatan ?? 'Anggota' }}
                                    </td>

                                    <!-- 4. Kolom Status -->
                                    <td class="p-4">
                                        <span class="px-2.5 py-1 rounded-full text-xs font-bold tracking-wide {{ $item->status == 'aktif' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    </td>

                                    <!-- 5. Kolom Aksi -->
                                    <td class="p-4">
                                        <div class="flex items-center justify-center gap-2">
                                            @if(!$item->user_id)
                                                <!-- Tombol Buat Akun (Ikon User Plus) -->
                                                <a href="{{ auth()->user()->hasRole('ketua') ? route('dashboard.ketua.anggota.buatAkun', $item->id) : route('dashboard.sekretaris.anggota.buatAkun', $item->id) }}" 
                                                   class="p-2 bg-green-50 text-green-600 rounded-lg hover:bg-green-600 hover:text-white transition-colors duration-200"
                                                   title="Buat Akun Login"
                                                   onclick="return confirm('Buat akun login untuk anggota ini?');">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                                                </a>
                                            @else
                                                <!-- Indikator Akun Aktif -->
                                                <span class="p-2 bg-emerald-50 text-emerald-600 rounded-lg cursor-default" title="Akun sudah aktif">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                </span>
                                                
                                                <!-- Tombol Reset Password (Ikon Key) -->
                                                <a href="{{ auth()->user()->hasRole('ketua') ? route('dashboard.ketua.anggota.resetPassword', $item->id) : route('dashboard.sekretaris.anggota.resetPassword', $item->id) }}" 
                                                   class="p-2 bg-yellow-50 text-yellow-600 rounded-lg hover:bg-yellow-500 hover:text-white transition-colors duration-200"
                                                   title="Reset Password ke: password123"
                                                   onclick="return confirm('Reset password anggota ini menjadi password123?');">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>
                                                </a>
                                            @endif

                                            <!-- Tombol Edit (Ikon Pencil) -->
                                            <a href="{{ route($prefixRoute . 'edit', ['anggota' => $item->id]) }}" 
                                               class="p-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-600 hover:text-white transition-colors duration-200"
                                               title="Edit Data Anggota">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                            </a>

                                            <!-- Tombol Hapus (Ikon Trash) -->
                                            <form action="{{ route($prefixRoute . 'destroy', ['anggota' => $item->id]) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus anggota ini?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" 
                                                        class="p-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-600 hover:text-white transition-colors duration-200"
                                                        title="Hapus Anggota">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="p-8 text-center text-gray-500">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                            <span class="text-base">Belum ada data anggota.</span>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $anggota->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>