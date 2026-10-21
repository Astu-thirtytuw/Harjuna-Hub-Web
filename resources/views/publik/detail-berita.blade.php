<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $berita->judul }} - Harjuna-Hub</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body class="bg-harjuna-cream text-gray-800 font-sans antialiased">
    
    <!-- Navbar Sederhana -->
    <nav class="bg-harjuna-dark text-white shadow-lg py-4">
        <div class="max-w-4xl mx-auto px-4 flex justify-between items-center">
            <a href="{{ route('beranda') }}" class="text-xl font-serif-jawa font-bold tracking-widest text-harjuna-gold">HARJUNA-HUB</a>
            <a href="{{ route('beranda') }}" class="text-sm font-medium hover:text-harjuna-gold transition">&larr; Kembali ke Beranda</a>
        </div>
    </nav>

    <!-- Konten Berita -->
    <main class="max-w-4xl mx-auto px-4 py-12">
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-harjuna-wood/10">
            
            @if($berita->gambar)
                <img src="{{ asset($berita->gambar) }}" alt="{{ $berita->judul }}" class="w-full h-80 object-cover">
            @else
                <div class="w-full h-32 bg-harjuna-medium"></div>
            @endif

            <div class="p-8 md:p-12">
                <div class="flex items-center text-sm font-bold text-harjuna-gold uppercase tracking-widest mb-4">
                    <span>{{ $berita->kategori }}</span>
                    <span class="mx-2">&bull;</span>
                    <span>{{ $berita->published_at ? $berita->published_at->format('d F Y') : $berita->created_at->format('d F Y') }}</span>
                </div>

                <h1 class="text-3xl md:text-5xl font-serif-jawa font-bold text-harjuna-dark leading-tight mb-6">
                    {{ $berita->judul }}
                </h1>

                <div class="flex items-center mb-8 pb-8 border-b border-gray-100">
                    <div class="w-10 h-10 rounded-full bg-harjuna-dark text-harjuna-gold flex items-center justify-center font-bold mr-3">
                        {{ substr($berita->penulis->nama ?? 'A', 0, 1) }}
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-800">{{ $berita->penulis->nama ?? 'Admin' }}</p>
                        <p class="text-xs text-gray-500">Penulis</p>
                    </div>
                </div>

                <!-- Isi Berita -->
                <div class="prose prose-lg text-gray-700 leading-relaxed max-w-none">
                    {!! nl2br(e($berita->isi)) !!}
                </div>
            </div>
        </div>
    </main>

    <footer class="text-center py-8 text-sm text-gray-500">
        &copy; {{ date('Y') }} Karang Taruna RW 06. Dibuat dengan Harjuna-Hub.
    </footer>
</body>
</html>