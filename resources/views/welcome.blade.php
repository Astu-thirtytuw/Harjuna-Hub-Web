<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Harjuna-Hub | Karang Taruna RW 06</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Efek Cursor Batik */
        .cursor-dot {
            width: 20px; height: 20px;
            background-color: rgba(212, 160, 23, 0.5); /* Emas transparan */
            border-radius: 50%;
            position: fixed; pointer-events: none;
            transform: translate(-50%, -50%);
            transition: width 0.2s, height 0.2s;
            z-index: 9999;
        }
        body:hover .cursor-dot { width: 30px; height: 30px; }
    </style>
</head>
<body class="bg-harjuna-cream text-gray-800 font-sans overflow-x-hidden">
    
    <!-- Cursor Effect -->
    <div class="cursor-dot hidden md:block" id="cursor"></div>

    <!-- Navbar -->
    <nav class="fixed w-full top-0 z-50 bg-harjuna-dark/90 backdrop-blur-md text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-20">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-harjuna-gold rounded-full flex items-center justify-center font-serif-jawa text-harjuna-dark text-xl font-bold">H</div>
                <div>
                    <h1 class="text-xl font-serif-jawa font-bold tracking-widest text-harjuna-gold">HARJUNA-HUB</h1>
                    <p class="text-[10px] text-gray-300 tracking-widest">KARANG TARUNA RW 06</p>
                </div>
            </div>
            <div class="hidden md:flex space-x-8 text-sm font-medium">
                <a href="#" class="hover:text-harjuna-gold transition">Profil</a>
                <a href="#" class="hover:text-harjuna-gold transition">Kegiatan</a>
                <a href="#" class="hover:text-harjuna-gold transition">Berita</a>
                <a href="#" class="hover:text-harjuna-gold transition">Lapor Warga</a>
            </div>
            <div>
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="bg-harjuna-gold text-harjuna-dark px-5 py-2 rounded-full text-sm font-bold hover:bg-yellow-500 transition">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="bg-transparent border border-harjuna-gold text-harjuna-gold px-5 py-2 rounded-full text-sm font-bold hover:bg-harjuna-gold hover:text-harjuna-dark transition">Log in Pengurus</a>
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <!-- Hero Section with Parallax -->
    <section class="relative h-screen flex items-center justify-center pt-20 overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10" style="background-image: url('https://www.transparenttextures.com/patterns/batik.png');"></div>
        
        <!-- Ornamen Gunungan / Wayang (Bisa diganti gambar asli nanti) -->
        <div class="absolute left-0 bottom-0 opacity-20 pointer-events-none transform -translate-x-1/4" id="wayang-left">
            <svg width="400" height="600" viewBox="0 0 100 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M50 0 L100 50 L100 200 L0 200 L0 50 Z" fill="#1B4332"/>
            </svg>
        </div>
        <div class="absolute right-0 bottom-0 opacity-20 pointer-events-none transform translate-x-1/4" id="wayang-right">
            <svg width="400" height="600" viewBox="0 0 100 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M50 0 L100 50 L100 200 L0 200 L0 50 Z" fill="#1B4332"/>
            </svg>
        </div>

        <div class="relative z-10 text-center px-4 max-w-3xl mx-auto">
            <span class="text-harjuna-gold font-bold tracking-[0.2em] uppercase text-sm mb-4 block">Sesarengan Mbangun Desa</span>
            <h2 class="text-5xl md:text-7xl font-serif-jawa font-bold text-harjuna-dark leading-tight mb-6">
                Guyub Rukun, <br> <span class="text-harjuna-medium italic">Nyawiji Karya</span>
            </h2>
            <p class="text-lg text-gray-600 mb-10 leading-relaxed">
                Platform digital terpusat untuk mengelola keanggotaan, keuangan, kegiatan, dan pelayanan warga Karang Taruna RW 06. Terhubung langsung dengan masyarakat.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="#" class="bg-harjuna-dark text-white px-8 py-3 rounded-full font-bold shadow-lg hover:bg-harjuna-medium transition transform hover:-translate-y-1">Jelajahi Kegiatan</a>
                <a href="#" class="bg-white text-harjuna-dark border-2 border-harjuna-dark px-8 py-3 rounded-full font-bold shadow-lg hover:bg-harjuna-cream transition transform hover:-translate-y-1">Lapor Kerusakan / Keluhan</a>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-16 bg-white relative z-10 border-y border-harjuna-wood/10">
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div>
                <div class="text-4xl font-serif-jawa font-bold text-harjuna-dark">120+</div>
                <div class="text-sm text-gray-500 uppercase tracking-wide mt-2">Anggota Aktif</div>
            </div>
            <div>
                <div class="text-4xl font-serif-jawa font-bold text-harjuna-dark">45</div>
                <div class="text-sm text-gray-500 uppercase tracking-wide mt-2">Kegiatan</div>
            </div>
            <div>
                <div class="text-4xl font-serif-jawa font-bold text-harjuna-dark">12</div>
                <div class="text-sm text-gray-500 uppercase tracking-wide mt-2">Program Kerja</div>
            </div>
            <div>
                <div class="text-4xl font-serif-jawa font-bold text-harjuna-dark">100%</div>
                <div class="text-sm text-gray-500 uppercase tracking-wide mt-2">Transparansi Kas</div>
            </div>
        </div>
    </section>

    <!-- Script Animasi Cursor & Parallax -->
    <script>
        // Cursor Effect
        const cursor = document.getElementById('cursor');
        document.addEventListener('mousemove', (e) => {
            cursor.style.left = e.clientX + 'px';
            cursor.style.top = e.clientY + 'px';
        });

        // Parallax Effect Wayang
        document.addEventListener('mousemove', (e) => {
            const x = (window.innerWidth - e.pageX * 2) / 100;
            const y = (window.innerHeight - e.pageY * 2) / 100;
            
            document.getElementById('wayang-left').style.transform = `translate(${x}px, ${y}px)`;
            document.getElementById('wayang-right').style.transform = `translate(${-x}px, ${-y}px)`;
        });
    </script>
</body>
</html>