<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Organisasi - Harjuna-Hub</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body class="bg-harjuna-cream text-gray-800 font-sans antialiased">
    
    <!-- Navbar -->
    <nav class="bg-harjuna-dark text-white shadow-lg py-4">
        <div class="max-w-6xl mx-auto px-4 flex justify-between items-center">
            <a href="{{ route('beranda') }}" class="text-xl font-serif-jawa font-bold tracking-widest text-harjuna-gold">HARJUNA-HUB</a>
            <a href="{{ route('beranda') }}" class="text-sm font-medium hover:text-harjuna-gold transition">&larr; Kembali ke Beranda</a>
        </div>
    </nav>

    <!-- Konten Profil -->
    <main class="max-w-6xl mx-auto px-4 py-12">
        <div class="text-center mb-16">
            <h1 class="text-4xl md:text-5xl font-serif-jawa font-bold text-harjuna-dark mb-4">Struktur Pengurus</h1>
            <p class="text-gray-600 max-w-2xl mx-auto">Karang Taruna RW 06 berkomitmen untuk membangun desa yang guyub, rukun, dan maju bersama para pemuda-pemudi terbaik.</p>
        </div>

        <!-- PENGURUS INTI -->
        <h2 class="text-2xl font-bold text-harjuna-dark mb-6 border-b-2 border-harjuna-gold pb-2 inline-block">Pengurus Inti</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-16">
            @forelse($pengurusInti as $item)
            <div class="bg-white rounded-2xl shadow-md p-6 text-center border border-harjuna-wood/10 hover:shadow-xl transition transform hover:-translate-y-1">
                <!-- Tambahkan overflow-hidden agar foto terpotong rapi mengikuti lingkaran -->
                <div class="w-24 h-24 mx-auto bg-harjuna-cream rounded-full flex items-center justify-center mb-4 border-2 border-harjuna-gold overflow-hidden">
                    @if($item->foto)
                        <img src="{{ asset('storage/' . $item->foto) }}" class="w-full h-full object-cover">
                    @else
                        <span class="text-3xl font-serif-jawa text-harjuna-dark">{{ substr($item->nama, 0, 1) }}</span>
                    @endif
                </div>
                <h3 class="text-lg font-bold text-harjuna-dark">{{ $item->nama }}</h3>
                <p class="text-sm font-bold text-harjuna-medium mt-1 uppercase tracking-wide">{{ $item->jabatan }}</p>
                <p class="text-xs text-gray-500 mt-2">{{ $item->divisi->nama ?? 'Pengurus Inti' }}</p>
            </div>
            @empty
            <div class="col-span-4 text-center text-gray-500 py-4">Data pengurus inti belum diisi.</div>
            @endforelse
        </div>

        <!-- KOORDINATOR BIDANG -->
        @if($korbid->count() > 0)
        <h2 class="text-2xl font-bold text-harjuna-dark mb-6 border-b-2 border-harjuna-gold pb-2 inline-block">Koordinator Bidang</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($korbid as $item)
            <div class="bg-white rounded-2xl shadow-md p-6 text-center border border-harjuna-wood/10 hover:shadow-xl transition">
                <div class="w-20 h-20 mx-auto bg-harjuna-cream rounded-full flex items-center justify-center mb-4 border-2 border-harjuna-gold overflow-hidden">
                    @if($item->foto)
                        <img src="{{ asset('storage/' . $item->foto) }}" class="w-full h-full object-cover">
                    @else
                        <span class="text-2xl font-serif-jawa text-harjuna-dark">{{ substr($item->nama, 0, 1) }}</span>
                    @endif
                </div>
                <h3 class="text-base font-bold text-harjuna-dark">{{ $item->nama }}</h3>
                <p class="text-xs font-bold text-harjuna-medium mt-1 uppercase tracking-wide">{{ $item->jabatan }} {{ $item->divisi->nama ?? '' }}</p>
            </div>
            @endforeach
        </div>
        @endif
    </main>

    <footer class="text-center py-8 text-sm text-gray-500">
        &copy; {{ date('Y') }} Karang Taruna RW 06.
    </footer>
</body>
</html>