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
    <nav class="fixed w-full top-0 z-50 bg-harjuna-dark/95 backdrop-blur-md text-white shadow-lg transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-20">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-harjuna-gold rounded-full flex items-center justify-center font-serif-jawa text-harjuna-dark text-xl font-bold">H</div>
                <div>
                    <h1 class="text-xl font-serif-jawa font-bold tracking-widest text-harjuna-gold">HARJUNA-HUB</h1>
                    <p class="text-[10px] text-gray-300 tracking-widest">KARANG TARUNA RW 06</p>
                </div>
            </div>
            <div class="hidden md:flex space-x-8 text-sm font-medium">
                <a href="{{ route('profil') }}" class="hover:text-harjuna-gold transition">Profil</a>
                <a href="{{ route('kegiatan.publik') }}" class="hover:text-harjuna-gold transition">Kegiatan</a>
                <a href="{{ route('berita.publik') }}" class="hover:text-harjuna-gold transition">Berita</a>
                <a href="#lapor" class="hover:text-harjuna-gold transition">Lapor Warga</a>
                <a href="{{ route('cek.laporan') }}" class="hover:text-harjuna-gold transition">Cek Laporan</a>
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
        
        <!-- Ornamen Gunungan / Wayang-->
        <!-- Ornamen Kiri -->
        <div class="absolute left-0 bottom-0 opacity-10 pointer-events-none transform -translate-x-1/4" id="wayang-left">
            <svg width="500" height="800" viewBox="0 0 100 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                <!-- Gambar Siluet Candi/Wayang Sederhana -->
                <path d="M50 0 L60 20 L70 15 L80 40 L100 50 L100 200 L0 200 L0 50 L20 40 L30 15 L40 20 Z" fill="#1B4332"/>
                <rect x="40" y="100" width="20" height="100" fill="#F5EFE6"/>
                <rect x="30" y="120" width="40" height="80" fill="#F5EFE6"/>
            </svg>
        </div>

        <!-- Ornamen Kanan -->
        <div class="absolute right-0 bottom-0 opacity-10 pointer-events-none transform translate-x-1/4" id="wayang-right">
            <svg width="500" height="800" viewBox="0 0 100 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M50 0 L60 20 L70 15 L80 40 L100 50 L100 200 L0 200 L0 50 L20 40 L30 15 L40 20 Z" fill="#1B4332"/>
                <rect x="40" y="100" width="20" height="100" fill="#F5EFE6"/>
                <rect x="30" y="120" width="40" height="80" fill="#F5EFE6"/>
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
                <a href="{{ route('kegiatan.publik') }}" class="bg-harjuna-dark text-white px-8 py-3 rounded-full font-bold shadow-lg hover:bg-harjuna-medium transition transform hover:-translate-y-1">Jelajahi Kegiatan</a>
                <a href="#lapor" class="bg-white text-harjuna-dark border-2 border-harjuna-dark px-8 py-3 rounded-full font-bold shadow-lg hover:bg-harjuna-cream transition transform hover:-translate-y-1">Lapor Kerusakan / Keluhan</a>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-16 bg-white relative z-10 border-y border-harjuna-wood/10">
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
        <div>
            <div class="text-4xl font-serif-jawa font-bold text-harjuna-dark">{{ $total_anggota }}</div>
            <div class="text-sm text-gray-500 uppercase tracking-wide mt-2">Anggota Aktif</div>
        </div>
        <div>
            <div class="text-4xl font-serif-jawa font-bold text-harjuna-dark">{{ $total_kegiatan }}</div>
            <div class="text-sm text-gray-500 uppercase tracking-wide mt-2">Kegiatan</div>
        </div>
        <div>
            <div class="text-4xl font-serif-jawa font-bold text-harjuna-dark">{{ $total_pengumuman }}</div>
            <div class="text-sm text-gray-500 uppercase tracking-wide mt-2">Berita & Info</div>
        </div>
        <div>
            <div class="text-4xl font-serif-jawa font-bold text-harjuna-dark">100%</div>
            <div class="text-sm text-gray-500 uppercase tracking-wide mt-2">Transparansi Kas</div>
        </div>
    </div>
    </section>

    <!-- Agenda Kegiatan -->
<section id="kegiatan" class="py-16 bg-harjuna-cream relative z-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-serif-jawa font-bold text-harjuna-dark">Agenda Terdekat</h2>
            <p class="text-gray-600 mt-2">Mari bergotong royong dan berpartisipasi dalam kegiatan RW 06.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($kegiatan as $item)
            <div class="bg-white rounded-2xl p-6 shadow-md border-t-4 border-harjuna-gold hover:shadow-xl transition">
                <div class="text-harjuna-medium font-bold text-sm mb-2">{{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d F Y') }} @if($item->waktu_mulai) - {{ $item->waktu_mulai }} @endif</div>
                <h3 class="text-xl font-bold text-harjuna-dark mb-3">{{ $item->nama }}</h3>
                <div class="flex items-center text-gray-500 text-sm mb-4">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    {{ $item->lokasi ?? 'Lokasi menyusul' }}
                </div>
                <p class="text-gray-600 text-sm line-clamp-3">{{ $item->deskripsi }}</p>
            </div>
            @empty
            <div class="col-span-3 text-center text-gray-500">Belum ada agenda kegiatan terdekat.</div>
            @endforelse
        </div>
    </div>
</section> 

    <!-- Berita / Kegiatan Terbaru -->
<section class="py-16 bg-white relative z-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-serif-jawa font-bold text-harjuna-dark">Kabar Karang Taruna</h2>
            <p class="text-gray-600 mt-2">Informasi dan kegiatan terbaru dari RW 06.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($pengumuman as $item)
            <div class="bg-harjuna-cream rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition group border border-harjuna-wood/10">
                @if($item->gambar)
                    <img src="{{ asset($item->gambar) }}" alt="{{ $item->judul }}" class="w-full h-48 object-cover group-hover:scale-105 transition duration-300">
                @else
                    <div class="w-full h-48 bg-harjuna-medium flex items-center justify-center text-harjuna-cream font-serif-jawa">Harjuna-Hub</div>
                @endif
                <div class="p-6">
                    <span class="text-xs font-bold text-harjuna-gold uppercase tracking-wider">{{ $item->kategori }}</span>
                    <h3 class="text-xl font-bold text-harjuna-dark mt-2 mb-3 line-clamp-2">{{ $item->judul }}</h3>
                    <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ Str::limit(strip_tags($item->isi), 100) }}</p>
                    <a href="{{ route('berita.detail', $item->slug) }}" class="text-harjuna-medium font-semibold text-sm hover:text-harjuna-dark">Baca Selengkapnya &rarr;</a>
                </div>
            </div>
            @empty
            <div class="col-span-3 text-center text-gray-500">Belum ada berita yang dipublikasikan.</div>
            @endforelse
        </div>
    </div>
</section>

    <!-- Form Lapor Warga -->
<section class="py-16 bg-harjuna-cream relative z-10 scroll-mt-24" id="lapor">
    <div class="max-w-3xl mx-auto px-4">
        <div class="bg-white p-8 rounded-2xl shadow-xl border border-harjuna-wood/10">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-serif-jawa font-bold text-harjuna-dark">Lapor Warga RW 06</h2>
                <p class="text-gray-600 mt-2">Sampaikan keluhan, kerusakan, atau usulan Anda untuk desa kita.</p>
            </div>

            <!-- Notifikasi Sukses (Menampilkan Kode Tiket) -->
            @if(session('success_tiket'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative text-center">
                    <p class="font-bold text-lg">Laporan Berhasil Dikirim!</p>
                    <p class="text-sm mt-1">Simpan kode tiket ini untuk mengecek status laporan Anda:</p>
                    <p class="text-3xl font-mono font-bold mt-2 text-harjuna-dark">{{ session('success_tiket') }}</p>
                </div>
            @endif

            <form action="{{ route('pelayanan.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text" name="nama_pelapor" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">No. HP / WA</label>
                        <input type="text" name="no_hp" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Kategori Laporan</label>
                        <select name="kategori" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                            <option value="infrastruktur">Kerusakan Infrastruktur</option>
                            <option value="keamanan">Keamanan (Kamtibmas)</option>
                            <option value="kebersihan">Kebersihan & Sampah</option>
                            <option value="sosial">Bantuan Sosial</option>
                            <option value="usulan_kegiatan">Usulan Kegiatan</option>
                            <option value="lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Lokasi (RT/RW / Patokan)</label>
                        <input type="text" name="lokasi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Judul Laporan</label>
                        <input type="text" name="judul" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required placeholder="Contoh: Lampu Jalan RT 02 Mati">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Detail Keluhan / Laporan</label>
                        <textarea name="deskripsi" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required></textarea>
                    </div>
                </div>
                <div class="mt-6">
                    <button type="submit" class="w-full bg-harjuna-dark text-white px-6 py-3 rounded-lg font-bold hover:bg-harjuna-medium transition shadow-lg text-lg">Kirim Laporan</button>
                </div>
            </form>
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