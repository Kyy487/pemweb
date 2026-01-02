<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - E-Rapor</title>
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
            background: #f5f7fa;
            color: #333;
        }

        .wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 260px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px 0;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar-header {
            padding: 0 20px 30px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
        }

        .sidebar-logo {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .sidebar-subtitle {
            font-size: 12px;
            opacity: 0.8;
        }

        .sidebar-menu {
            list-style: none;
            margin-top: 30px;
        }

        .sidebar-menu li {
            margin: 0;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 15px 20px;
            color: rgba(255, 255, 255, 0.8);
            transition: all 0.3s;
            border-left: 3px solid transparent;
            gap: 12px;
        }

        .sidebar-menu a:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border-left-color: white;
        }

        .sidebar-menu a.active {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            border-left-color: white;
            font-weight: 600;
        }

        .sidebar-menu i {
            font-size: 18px;
            width: 20px;
        }

        .logout-btn {
            position: absolute;
            bottom: 20px;
            left: 20px;
            right: 20px;
            padding: 12px 15px;
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            border-radius: 8px;
            cursor: pointer;
            text-align: center;
            transition: all 0.3s;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        /* Main Content */
        .main-content {
            margin-left: 260px;
            flex: 1;
            padding: 30px;
        }

        .top-bar {
            background: white;
            padding: 20px 30px;
            border-radius: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        }

        .top-bar h1 {
            font-size: 28px;
            color: #667eea;
            margin: 0;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 18px;
        }

        .user-details {
            text-align: right;
        }

        .user-details .name {
            font-weight: 600;
            color: #333;
        }

        .user-details .role {
            font-size: 12px;
            color: #999;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            display: flex;
            align-items: center;
            gap: 20px;
            transition: all 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(102, 126, 234, 0.2);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
        }

        .stat-icon.classes {
            background: #e8f1ff;
            color: #667eea;
        }

        .stat-icon.teachers {
            background: #fef3e8;
            color: #f59e0b;
        }

        .stat-icon.students {
            background: #f0fdf4;
            color: #10b981;
        }

        .stat-icon.subjects {
            background: #fdf2f8;
            color: #ec4899;
        }

        .stat-content h3 {
            font-size: 12px;
            color: #999;
            margin: 0 0 8px 0;
            text-transform: uppercase;
            font-weight: 500;
        }

        .stat-content p {
            font-size: 32px;
            font-weight: 700;
            color: #333;
            margin: 0;
        }

        /* Content Section */
        .content-section {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 20px;
            font-weight: 700;
            color: #333;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title i {
            color: #667eea;
            font-size: 24px;
        }

        /* Action Buttons */
        .action-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }

        .action-btn {
            padding: 15px 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.3s;
        }

        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .action-btn.secondary {
            background: #f0f2ff;
            color: #667eea;
            border: 2px solid #667eea;
        }

        .action-btn.secondary:hover {
            background: #667eea;
            color: white;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 0;
                position: absolute;
            }

            .main-content {
                margin-left: 0;
            }

            .top-bar {
                flex-direction: column;
                gap: 15px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-logo">📚 E-Rapor</div>
                <div class="sidebar-subtitle">Admin Panel</div>
            </div>

            <ul class="sidebar-menu">
                <li><a href="/dashboard" class="active"><i class="bi bi-speedometer2"></i> Dashboard</a></li>
                <li><a href="/classes"><i class="bi bi-building"></i> Kelas</a></li>
                <li><a href="/students"><i class="bi bi-people-fill"></i> Kelola Siswa</a></li>
                <li><a href="/subjects"><i class="bi bi-book"></i> Mata Pelajaran</a></li>
                <li><a href="/users"><i class="bi bi-person-circle"></i> Pengguna</a></li>
                <li><a href="/grades"><i class="bi bi-graph-up"></i> Nilai</a></li>
            </ul>

            <form method="POST" action="/logout" style="position: absolute; bottom: 20px; left: 20px; right: 20px;">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Top Bar -->
            <div class="top-bar">
                <h1>Dashboard</h1>
                <div class="user-info">
                    <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                    <div class="user-details">
                        <div class="name">{{ Auth::user()->name }}</div>
                        <div class="role">Administrator</div>
                    </div>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon classes">📚</div>
                    <div class="stat-content">
                        <h3>Total Kelas</h3>
                        <p>{{ $total_classes }}</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon teachers">👨‍🏫</div>
                    <div class="stat-content">
                        <h3>Total Guru</h3>
                        <p>{{ $total_teachers }}</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon students">👨‍🎓</div>
                    <div class="stat-content">
                        <h3>Total Siswa</h3>
                        <p>{{ $total_students }}</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon subjects">📖</div>
                    <div class="stat-content">
                        <h3>Mata Pelajaran</h3>
                        <p>{{ $total_subjects }}</p>
                    </div>
                </div>
            </div>

            <!-- Management Section -->
            <div class="content-section">
                <div class="section-title">
                    <i class="bi bi-gear"></i> Manajemen Data
                </div>
                <div class="action-grid">
                    <a href="/classes" class="action-btn">
                        <i class="bi bi-plus-circle"></i> Kelola Kelas
                    </a>
                    <a href="/students" class="action-btn">
                        <i class="bi bi-plus-circle"></i> Kelola Siswa
                    </a>
                    <a href="/subjects" class="action-btn">
                        <i class="bi bi-plus-circle"></i> Kelola Mata Pelajaran
                    </a>
                    <a href="/users" class="action-btn">
                        <i class="bi bi-plus-circle"></i> Kelola Pengguna
                    </a>
                    <a href="/grades" class="action-btn secondary">
                        <i class="bi bi-eye"></i> Lihat Nilai
                    </a>
                </div>
            </div>

            <!-- Reports Section -->
            <div class="content-section">
                <div class="section-title">
                    <i class="bi bi-file-earmark-pdf"></i> Laporan & Export
                </div>
                <div class="action-grid">
                    <a href="/reports/all/view" class="action-btn secondary">
                        <i class="bi bi-download"></i> Export Semua Siswa
                    </a>
                    <a href="/reports/class/1/view" class="action-btn secondary">
                        <i class="bi bi-download"></i> Lihat Rapor Kelas
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<style>
            border-bottom: 1px solid #e0e0e0;
            padding-bottom: 15px;
        }
        .header h1 { color: #34495e; margin: 0; }
        
        /* Statistik Cards */
        .stat-grid { 
            display: grid; 
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); 
            gap: 20px; 
            margin-bottom: 30px; 
        }
        .stat-card { 
            background: white; 
            padding: 25px; 
            border-radius: 8px; 
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08); 
            border-left: 5px solid #3498db; /* Default accent */
        }
        .card-blue { border-left-color: #3498db; }
        .card-green { border-left-color: #2ecc71; }
        .card-red { border-left-color: #e74c3c; }
        .card-yellow { border-left-color: #f1c40f; }

        .stat-card h3 { 
            margin-top: 0; 
            color: #7f8c8d; 
            font-size: 0.9em; 
            text-transform: uppercase;
        }
        .stat-card p { 
            font-size: 2.5em; 
            margin: 5px 0 0 0; 
            font-weight: 600; 
            color: #34495e;
        }
        
        /* Aksi Cepat */
        .quick-actions a {
            padding: 10px 20px; 
            background-color: #3498db;
            color: white; 
            border-radius: 5px; 
            margin-right: 15px; 
            display: inline-block;
            transition: background-color 0.3s;
        }
        .quick-actions a:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="sidebar">
            <h3>E-Rapor V.1</h3>
            <a href="{{ route('dashboard') }}" class="active">Dashboard Utama</a>
            <div style="margin-top: 15px; padding: 0 20px; font-size: 0.9em; color: #7f8c8d; font-weight: bold;">MANAJEMEN DATA</div>
            <a href="{{ route('classes.index') }}">Kelola Kelas</a>
            <a href="{{ route('subjects.index') }}">Kelola Mata Pelajaran</a>
            <a href="{{ route('users.index') }}">Kelola Akun User</a>
            
            <form method="POST" action="{{ route('logout') }}" style="margin-top: 50px;">
                @csrf
                <button type="submit" style="background: none; border: none; color: #e74c3c; padding: 12px 20px; width: 100%; text-align: left; cursor: pointer;">
                    Logout ({{ Auth::user()->name }})
                </button>
            </form>
        </div>
            </div>
        </div>
    </div>
</body>
</html>
