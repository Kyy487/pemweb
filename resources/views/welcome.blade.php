<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Rapor - Sistem Manajemen Rapor Digital Profesional</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        /* --- RESET & BASIC SETUP --- */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: #4a5568;
            background-color: #fcfcfc;
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* --- NAVBAR --- */
        nav {
            position: sticky;
            top: 0;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            z-index: 1000;
            padding: 15px 0;
            transition: all 0.3s ease;
        }

        .navbar-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 26px;
            font-weight: 800;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }

        .nav-menu {
            display: flex;
            gap: 35px;
            list-style: none;
            align-items: center;
        }

        .nav-menu a {
            color: #4a5568;
            text-decoration: none;
            font-weight: 500;
            font-size: 15px;
            transition: color 0.3s;
            position: relative;
        }

        .nav-menu a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 0;
            background-color: #764ba2;
            transition: width 0.3s ease;
        }

        .nav-menu a:hover::after {
            width: 100%;
        }

        .nav-menu a:hover {
            color: #764ba2;
        }

        .nav-buttons {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        /* --- BUTTONS --- */
        .btn {
            padding: 10px 28px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275); /* Efek membal */
            border: none;
            cursor: pointer;
            font-size: 0.95rem;
            display: inline-block;
            box-shadow: 0 4px 6px rgba(50, 50, 93, 0.11), 0 1px 3px rgba(0, 0, 0, 0.08);
        }

        .btn:hover {
            transform: translateY(-3px) scale(1.02); /* Naik & Membesar dikit */
            box-shadow: 0 7px 14px rgba(50, 50, 93, 0.1), 0 3px 6px rgba(0, 0, 0, 0.08);
        }

        .btn:active {
            transform: translateY(-1px);
        }

        .btn-outline {
            border: 2px solid #667eea;
            color: #667eea;
            background: transparent;
            box-shadow: none;
        }

        .btn-outline:hover {
            background: #667eea;
            color: white;
        }

        .btn-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        /* --- HERO SECTION --- */
        .hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 140px 20px 100px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        /* Dekorasi Background Bergerak */
        .hero::before, .hero::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            animation: float 6s infinite ease-in-out;
        }

        .hero::before {
            top: -50px; left: -50px;
            width: 300px; height: 300px;
            background: rgba(255, 255, 255, 0.1);
            animation-delay: 0s;
        }
        
        .hero::after {
            bottom: -50px; right: -50px;
            width: 400px; height: 400px;
            background: rgba(255, 255, 255, 0.05);
            animation-delay: 3s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) scale(1); }
            50% { transform: translateY(20px) scale(1.05); }
        }

        .hero-content {
            max-width: 800px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        .hero h1 {
            font-size: 3.5rem;
            margin-bottom: 25px;
            font-weight: 800;
            line-height: 1.2;
            text-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .hero p {
            font-size: 1.25rem;
            margin-bottom: 40px;
            opacity: 0.9;
            font-weight: 300;
        }

        .hero-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-white {
            background: white;
            color: #764ba2;
            padding: 14px 35px;
            font-size: 1rem;
        }

        /* --- FEATURES SECTION --- */
        .features {
            padding: 100px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-title {
            text-align: center;
            margin-bottom: 70px;
        }

        .section-title h2 {
            font-size: 2.5rem;
            margin-bottom: 15px;
            color: #2d3748;
            font-weight: 700;
        }

        .section-title p {
            font-size: 1.1rem;
            color: #718096;
            max-width: 600px;
            margin: 0 auto;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 40px;
        }

        .feature-card {
            background: white;
            padding: 40px 30px;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.05);
            text-align: center;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: 1px solid rgba(0,0,0,0.02);
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, #667eea, #764ba2);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .feature-card:hover::before {
            transform: scaleX(1);
        }

        .feature-card:hover {
            transform: translateY(-15px); /* Naik lebih tinggi */
            box-shadow: 0 20px 50px rgba(102, 126, 234, 0.2);
        }

        .feature-icon {
            font-size: 3.5rem;
            margin-bottom: 25px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: inline-block;
            transition: transform 0.3s;
        }

        /* Icon berputar sedikit saat hover */
        .feature-card:hover .feature-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .feature-card h3 {
            font-size: 1.4rem;
            margin-bottom: 15px;
            color: #2d3748;
            font-weight: 600;
        }

        .feature-card p {
            color: #718096;
            font-size: 1rem;
            line-height: 1.7;
        }

        /* --- CTA SECTION --- */
        .cta {
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
            color: white;
            padding: 100px 20px;
            text-align: center;
            margin: 50px 20px;
            border-radius: 30px;
            box-shadow: 0 20px 50px rgba(118, 75, 162, 0.2);
            position: relative;
            overflow: hidden;
        }

        .cta-content {
            max-width: 700px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        .cta h2 {
            font-size: 2.8rem;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .cta p {
            font-size: 1.2rem;
            margin-bottom: 40px;
            opacity: 0.95;
        }

        /* --- FOOTER --- */
        footer {
            background: #fff;
            padding: 50px 20px;
            text-align: center;
            color: #718096;
            border-top: 1px solid #edf2f7;
            font-size: 0.95rem;
        }
        /* --- TEAM SECTION (TAMBAHAN) --- */
        .team-section {
            padding: 80px 20px 100px;
            background-color: #f8fafc; /* Sedikit lebih gelap dari putih agar kontras */
            position: relative;
        }

        .team-grid {
            display: flex;
            justify-content: center; /* Agar 2 orang pas di tengah */
            gap: 40px;
            flex-wrap: wrap;
            margin-top: 50px;
        }

        .team-card {
            background: white;
            border-radius: 20px;
            padding: 40px 30px;
            text-align: center;
            width: 100%;
            max-width: 350px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
            border-top: 5px solid transparent;
        }

        .team-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(118, 75, 162, 0.15);
            border-top: 5px solid #764ba2; /* Aksen warna saat hover */
        }

        .team-photo-wrapper {
            width: 140px;
            height: 140px;
            margin: 0 auto 25px;
            padding: 5px;
            border-radius: 50%;
            /* Membuat border gradient melingkar */
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .team-photo {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid white; /* Pemisah antara foto dan gradient */
            background-color: #fff;
        }

        .team-name {
            font-size: 1.5rem;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 5px;
        }

        .team-role {
            font-size: 0.95rem;
            color: #667eea; /* Warna ungu muda */
            font-weight: 600;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .team-nim {
            font-size: 0.9rem;
            color: #718096;
            background: #edf2f7;
            padding: 5px 15px;
            border-radius: 20px;
            display: inline-block;
        }
        /* --- RESPONSIVE --- */
        @media (max-width: 768px) {
            .nav-menu { display: none; }
            .hero { padding: 120px 20px 80px; }
            .hero h1 { font-size: 2.5rem; }
            .hero-buttons { flex-direction: column; }
            .btn { width: 100%; text-align: center; }
            .cta { margin: 50px 0; border-radius: 0; padding: 80px 20px; }
        }
    </style>
</head>
<body>
    <nav data-aos="fade-down" data-aos-duration="1000">
        <div class="navbar-container">
            <div class="logo">
                <i class="bi bi-mortarboard-fill"></i> E-Rapor
            </div>
            <ul class="nav-menu">
                <li><a href="#features">Fitur</a></li>
                <li><a href="#about">Tentang</a></li>
                <li><a href="#cta">Hubungi</a></li>
            </ul>
            <div class="nav-buttons">
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-gradient">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline">Masuk</a>
                    <a href="{{ route('register') }}" class="btn btn-gradient">Daftar</a>
                @endauth
            </div>
        </div>
    </nav>

    <section class="hero">
        <div class="hero-content">
            <h1 data-aos="fade-up" data-aos-duration="1000">Manajemen Rapor Digital Profesional</h1>
            
            <p data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000">
                Sistem E-Rapor yang modern dan terintegrasi untuk institusi pendidikan. Kelola nilai, kelas, dan siswa dengan mudah dan efisien.
            </p>
            
            <div class="hero-buttons" data-aos="fade-up" data-aos-delay="400" data-aos-duration="1000">
                <a href="{{ route('login') }}" class="btn btn-white">Masuk Sekarang</a>
                <a href="{{ route('register') }}" class="btn btn-outline" style="border-color: white; color: white;">Daftar Admin</a>
            </div>
        </div>
    </section>

    <section class="features" id="features">
        <div class="section-title" data-aos="fade-up">
            <h2>Fitur Unggulan</h2>
            <p>Lengkap dengan semua yang Anda butuhkan untuk mengelola rapor secara digital</p>
        </div>
        
        <div class="features-grid">
            <div class="feature-card" data-aos="fade-up" data-aos-delay="100">
                <div class="feature-icon"><i class="bi bi-bar-chart-fill"></i></div>
                <h3>Dashboard Intuitif</h3>
                <p>Visualisasi data yang jelas dan mudah dipahami dengan statistik real-time untuk pemantauan.</p>
            </div>

            <div class="feature-card" data-aos="fade-up" data-aos-delay="200">
                <div class="feature-icon"><i class="bi bi-journal-bookmark-fill"></i></div>
                <h3>Manajemen Kelas</h3>
                <p>Kelola kelas, siswa, dan guru dengan sistem yang terorganisir dengan baik dan mudah diakses.</p>
            </div>

            <div class="feature-card" data-aos="fade-up" data-aos-delay="300">
                <div class="feature-icon"><i class="bi bi-people-fill"></i></div>
                <h3>User Management</h3>
                <p>Kelola pengguna dengan role berbeda: admin, guru, dan siswa dengan hak akses yang aman.</p>
            </div>

            <div class="feature-card" data-aos="fade-up" data-aos-delay="400">
                <div class="feature-icon"><i class="bi bi-graph-up-arrow"></i></div>
                <h3>Tracking Nilai</h3>
                <p>Input dan tracking nilai siswa dengan sistem yang akurat, transparan, dan realtime.</p>
            </div>

            <div class="feature-card" data-aos="fade-up" data-aos-delay="500">
                <div class="feature-icon"><i class="bi bi-shield-lock-fill"></i></div>
                <h3>Keamanan Terjamin</h3>
                <p>Sistem keamanan tingkat tinggi dengan enkripsi data untuk melindungi privasi sekolah.</p>
            </div>

            <div class="feature-card" data-aos="fade-up" data-aos-delay="600">
                <div class="feature-icon"><i class="bi bi-file-earmark-pdf-fill"></i></div>
                <h3>Export PDF Rapor</h3>
                <p>Cetak dan download rapor siswa dalam format PDF yang profesional dan siap dibagikan.</p>
            </div>
        </div>
    </section>

    <section class="cta" id="cta" data-aos="zoom-in" data-aos-duration="1000">
        <div class="cta-content">
            <h2>Siap Memulai?</h2>
            <p>Bergabunglah dengan institusi pendidikan yang telah mempercayai E-Rapor untuk mengelola sistem pelaporan mereka.</p>
            <a href="{{ route('register') }}" class="btn btn-white">Buat Akun Admin Gratis</a>
        </div>
    </section>
    <section class="team-section" id="about">
        <div class="section-title" data-aos="fade-up">
            <h2>Tim Pengembang</h2>
            <p>Bertemu dengan mahasiswa kreatif di balik layar E-Rapor</p>
        </div>

        <div class="team-grid">
            
            <div class="team-card" data-aos="fade-up" data-aos-delay="100">
                <div class="team-photo-wrapper">
                    <img src="https://via.placeholder.com/150/667eea/ffffff?text=Foto+1" alt="Foto Anggota 1" class="team-photo">
                </div>
                <h3 class="team-name">Moch Riezky Dwi Kuswanto</h3>
                <div class="team-role">Backend Developer</div>
                <div class="team-nim">NIM: 152024133</div>
            </div>

            <div class="team-card" data-aos="fade-up" data-aos-delay="200">
                <div class="team-photo-wrapper">
                    <img src="https://via.placeholder.com/150/764ba2/ffffff?text=Foto+2" alt="Foto Anggota 2" class="team-photo">
                </div>
                <h3 class="team-name">Adithya Luthfi</h3>
                <div class="team-role">Frontend Developer</div>
                <div class="team-nim">NIM: 152024139</div>
            </div>

        </div>
    </section>

    <footer>
        <p>&copy; {{ date('Y') }} E-Rapor. Semua hak dilindungi. Dibangun dengan <i class="bi bi-heart-fill" style="color: #e53e3e;"></i> menggunakan Laravel.</p>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true, /* Animasi hanya berjalan sekali saat scroll ke bawah */
            offset: 100, /* Jarak trigger animasi */
            duration: 800, /* Durasi animasi */
        });
    </script>
</body>
</html>