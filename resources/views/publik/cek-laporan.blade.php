<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Status Laporan - Harjuna-Hub</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body class="bg-harjuna-cream text-gray-800 font-sans antialiased min-h-screen flex items-center justify-center p-4">
    
    <div class="bg-white p-8 rounded-3xl shadow-xl w-full max-w-2xl border border-harjuna-wood/10">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-serif-jawa font-bold text-harjuna-dark">Cek Status Laporan</h1>
            <p class="text-sm text-gray-500 mt-2">Masukkan Kode Tiket (Contoh: HRJ-A1B2) atau Nomor HP/WA yang Anda gunakan saat melapor.</p>
        </div>

        @if($error)
            <div class="mb-6 bg-red-100 text-red-700 p-4 rounded-xl text-sm text-center font-medium border border-red-200">
                {{ $error }}
            </div>
        @endif

        <form action="{{ route('cek.laporan') }}" method="POST" class="flex flex-col sm:flex-row gap-3">
            @csrf
            <input type="text" name="search" value="{{ $search }}" placeholder="Kode Tiket / No HP" class="w-full rounded-xl border-gray-300 uppercase font-mono focus:border-harjuna-gold focus:ring-harjuna-gold" required>
            <button type="submit" class="bg-harjuna-dark text-white px-8 py-3 rounded-xl font-bold hover:bg-harjuna-medium transition whitespace-nowrap">Cari Laporan</button>
        </form>

        @if($laporan && $laporan->count() > 0)
            <div class="mt-8 border-t border-gray-100 pt-6 space-y-4">
                <h3 class="font-bold text-harjuna-dark text-lg mb-2">Hasil Pencarian ({{ $laporan->count() }} laporan)</h3>
                
                @foreach($laporan as $item)
                <div class="bg-gray-50 p-5 rounded-xl border border-gray-200">
                    <div class="flex justify-between items-start mb-2">
                        <div>
                            <span class="font-mono text-xs font-bold text-harjuna-medium bg-harjuna-cream px-2 py-1 rounded">{{ $item->kode_tiket }}</span>
                            <span class="text-xs text-gray-400 ml-2">{{ $item->created_at->format('d/m/Y') }}</span>
                        </div>
                        <span class="px-3 py-1 rounded-full text-xs font-bold uppercase 
                            {{ $item->status == 'selesai' ? 'bg-green-100 text-green-700' : ($item->status == 'baru' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">
                            {{ $item->status }}
                        </span>
                    </div>
                    <h4 class="font-bold text-lg text-harjuna-dark">{{ $item->judul }}</h4>
                    <p class="text-sm text-gray-600 mt-1 mb-3">{{ $item->deskripsi }}</p>
                    <p class="text-xs text-gray-500 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                        {{ $item->lokasi ?? 'Lokasi tidak disebutkan' }}
                    </p>
                </div>
                @endforeach
            </div>
        @endif

        <div class="mt-8 text-center border-t border-gray-100 pt-6">
            <a href="{{ route('beranda') }}" class="text-sm text-harjuna-medium font-semibold hover:underline">&larr; Kembali ke Beranda</a>
        </div>
    </div>
</body>
</html>