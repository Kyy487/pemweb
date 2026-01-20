<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Rapor - Sistem Manajemen Rapor Digital Profesional</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: #333;
            line-height: 1.6;
        }

        /* Navbar */
        nav {
            position: sticky;
            top: 0;
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            z-index: 1000;
            padding: 15px 0;
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
            font-size: 24px;
            font-weight: 700;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav-menu {
            display: flex;
            gap: 30px;
            list-style: none;
            align-items: center;
        }

        .nav-menu a {
            color: #333;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav-menu a:hover {
            color: #667eea;
        }

        .nav-buttons {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .btn {
            padding: 10px 25px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            font-size: 0.95rem;
            display: inline-block;
        }

        .btn-outline {
            border: 2px solid #667eea;
            color: #667eea;
            background: transparent;
        }

        .btn-outline:hover {
            background: #f0f2ff;
            transform: translateY(-2px);
        }

        .btn-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
        }

        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 100px 20px;
            text-align: center;
            animation: slideUp 0.8s ease;
        }

        .hero-content {
            max-width: 800px;
            margin: 0 auto;
        }

        .hero h1 {
            font-size: 3rem;
            margin-bottom: 20px;
            font-weight: 700;
            animation: bounceAnimation 1s ease 0.2s both;
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 30px;
            opacity: 0.95;
            animation: slideUp 0.8s ease 0.4s both;
        }

        .hero-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
            animation: slideUp 0.8s ease 0.6s both;
        }

        .btn-white {
            background: white;
            color: #667eea;
            padding: 12px 30px;
        }

        .btn-white:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes bounceAnimation {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        /* Features Section */
        .features {
            padding: 80px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-title {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-title h2 {
            font-size: 2.5rem;
            margin-bottom: 15px;
            color: #333;
        }

        .section-title p {
            font-size: 1.1rem;
            color: #999;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .feature-card {
            background: white;
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            text-align: center;
            transition: all 0.3s;
            animation: slideUp 0.8s ease;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(102, 126, 234, 0.2);
        }

        .feature-icon {
            font-size: 3rem;
            margin-bottom: 20px;
        }

        .feature-card h3 {
            font-size: 1.3rem;
            margin-bottom: 15px;
            color: #333;
        }

        .feature-card p {
            color: #999;
            font-size: 0.95rem;
        }

        /* CTA Section */
        .cta {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            color: white;
            padding: 80px 20px;
            text-align: center;
            margin: 80px 0;
        }

        .cta-content {
            max-width: 600px;
            margin: 0 auto;
        }

        .cta h2 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        .cta p {
            font-size: 1.1rem;
            margin-bottom: 30px;
            opacity: 0.95;
        }

        /* Footer */
        footer {
            background: #f8f9fa;
            padding: 40px 20px;
            text-align: center;
            color: #666;
            border-top: 1px solid #e0e0e0;
        }

        @media (max-width: 768px) {
            .nav-menu {
                display: none;
            }

            .hero h1 {
                font-size: 2rem;
            }

            .section-title h2 {
                font-size: 2rem;
            }

            .cta h2 {
                font-size: 1.8rem;
            }

            .hero-buttons {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav>
        <div class="navbar-container">
            <div class="logo">E-Rapor</div>
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

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Manajemen Rapor Digital Profesional</h1>
            <p>Sistem E-Rapor yang modern dan terintegrasi untuk institusi pendidikan. Kelola nilai, kelas, dan siswa dengan mudah dan efisien.</p>
            <div class="hero-buttons">
                <a href="{{ route('login') }}" class="btn btn-white">Masuk Sekarang</a>
                <a href="{{ route('register') }}" class="btn btn-gradient">Daftar Admin</a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features" id="features">
        <div class="section-title">
            <h2>Fitur Unggulan</h2>
            <p>Lengkap dengan semua yang Anda butuhkan untuk mengelola rapor secara digital</p>
        </div>
        
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">📊</div>
                <h3>Dashboard Intuitif</h3>
                <p>Visualisasi data yang jelas dan mudah dipahami dengan statistik real-time</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">📚</div>
                <h3>Manajemen Kelas</h3>
                <p>Kelola kelas, siswa, dan guru dengan sistem yang terorganisir dengan baik</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">👥</div>
                <h3>User Management</h3>
                <p>Kelola pengguna dengan role berbeda: admin, guru, dan siswa</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">📈</div>
                <h3>Tracking Nilai</h3>
                <p>Input dan tracking nilai siswa dengan sistem yang akurat dan transparan</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">🔒</div>
                <h3>Keamanan Terjamin</h3>
                <p>Sistem keamanan tingkat tinggi dengan enkripsi dan kontrol akses</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">�</div>
                <h3>Export PDF Rapor</h3>
                <p>Cetak dan download rapor siswa dalam format PDF yang profesional dan siap dibagikan</p>
            </div>
    </section>

    <!-- CTA Section -->
    <section class="cta" id="cta">
        <div class="cta-content">
            <h2>Siap Memulai?</h2>
            <p>Bergabunglah dengan institusi pendidikan yang telah mempercayai E-Rapor untuk mengelola sistem pelaporan mereka</p>
            <a href="{{ route('register') }}" class="btn btn-white">Buat Akun Admin Gratis</a>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 E-Rapor. Semua hak dilindungi. Dibangun dengan ❤️ menggunakan Laravel.</p>
    </footer>
</body>
</html>
