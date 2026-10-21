<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semua Kegiatan - Harjuna-Hub</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body class="bg-harjuna-cream text-gray-800 font-sans antialiased">
    <nav class="bg-harjuna-dark text-white shadow-lg py-4">
        <div class="max-w-6xl mx-auto px-4 flex justify-between items-center">
            <a href="{{ route('beranda') }}" class="text-xl font-serif-jawa font-bold tracking-widest text-harjuna-gold">HARJUNA-HUB</a>
            <a href="{{ route('beranda') }}" class="text-sm font-medium hover:text-harjuna-gold transition">&larr; Kembali ke Beranda</a>
        </div>
    </nav>

    <main class="max-w-6xl mx-auto px-4 py-12">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-serif-jawa font-bold text-harjuna-dark mb-4">Semua Agenda Kegiatan</h1>
            <p class="text-gray-600">Jadwal kegiatan Karang Taruna RW 06.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($kegiatan as $item)
            <div class="bg-white rounded-2xl p-6 shadow-md border-t-4 border-harjuna-gold hover:shadow-xl transition">
                <div class="text-harjuna-medium font-bold text-sm mb-2">{{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d F Y') }}</div>
                <h3 class="text-xl font-bold text-harjuna-dark mb-3">{{ $item->nama }}</h3>
                <p class="text-gray-500 text-sm mb-2 flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                    {{ $item->lokasi ?? 'Lokasi menyusul' }}
                </p>
                <p class="text-gray-600 text-sm line-clamp-3 mt-4">{{ $item->deskripsi }}</p>
            </div>
            @empty
            <div class="col-span-3 text-center text-gray-500">Belum ada agenda kegiatan.</div>
            @endforelse
        </div>
        <div class="mt-8">{{ $kegiatan->links() }}</div>
    </main>
</body>
</html>