<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semua Berita - Harjuna-Hub</title>
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
            <h1 class="text-4xl font-serif-jawa font-bold text-harjuna-dark mb-4">Kabar & Berita Terbaru</h1>
            <p class="text-gray-600">Informasi terhangat dari Karang Taruna RW 06.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($pengumuman as $item)
            <div class="bg-white rounded-2xl overflow-hidden shadow-md border border-harjuna-wood/10 hover:shadow-xl transition">
                @if($item->gambar)
                    <img src="{{ asset($item->gambar) }}" alt="{{ $item->judul }}" class="w-full h-48 object-cover">
                @else
                    <div class="w-full h-48 bg-harjuna-medium flex items-center justify-center text-white font-serif-jawa">Harjuna-Hub</div>
                @endif
                <div class="p-6">
                    <span class="text-xs font-bold text-harjuna-gold uppercase tracking-wider">{{ $item->kategori }}</span>
                    <h3 class="text-xl font-bold text-harjuna-dark mt-2 mb-3 line-clamp-2">{{ $item->judul }}</h3>
                    <a href="{{ route('berita.detail', $item->slug) }}" class="text-harjuna-medium font-semibold text-sm hover:text-harjuna-dark">Baca Selengkapnya &rarr;</a>
                </div>
            </div>
            @empty
            <div class="col-span-3 text-center text-gray-500">Belum ada berita.</div>
            @endforelse
        </div>
        <div class="mt-8">{{ $pengumuman->links() }}</div>
    </main>
</body>
</html>