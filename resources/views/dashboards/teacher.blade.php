<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard - E-Rapor</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; background: #f5f7fa; color: #333; }
        .wrapper { display: flex; min-height: 100vh; }
        
        /* Sidebar Styles */
        .sidebar { width: 260px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 30px 0; position: fixed; height: 100vh; overflow-y: auto; box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1); }
        .sidebar-header { padding: 0 20px 30px; border-bottom: 1px solid rgba(255, 255, 255, 0.1); text-align: center; }
        .sidebar-logo { font-size: 24px; font-weight: 700; margin-bottom: 5px; }
        .sidebar-subtitle { font-size: 12px; opacity: 0.8; }
        .sidebar-menu { list-style: none; margin-top: 30px; }
        .sidebar-menu a { display: flex; align-items: center; padding: 15px 20px; color: rgba(255, 255, 255, 0.8); transition: all 0.3s; border-left: 3px solid transparent; gap: 12px; text-decoration: none; }
        .sidebar-menu a:hover { background: rgba(255, 255, 255, 0.1); color: white; border-left-color: white; }
        .sidebar-menu a.active { background: rgba(255, 255, 255, 0.15); color: white; border-left-color: white; font-weight: 600; }
        .sidebar-menu i { font-size: 18px; width: 20px; }
        .logout-btn { position: absolute; bottom: 20px; left: 20px; right: 20px; padding: 12px 15px; background: rgba(255, 255, 255, 0.2); border: 1px solid rgba(255, 255, 255, 0.3); color: white; border-radius: 8px; cursor: pointer; text-align: center; transition: all 0.3s; font-family: 'Poppins', sans-serif; font-weight: 600; text-decoration: none; display: flex; align-items: center; justify-content: center; gap: 8px; }
        .logout-btn:hover { background: rgba(255, 255, 255, 0.3); }

        /* Main Content */
        .main-content { margin-left: 260px; flex: 1; padding: 30px; }
        .top-bar { background: white; padding: 20px 30px; border-radius: 12px; display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06); }
        .top-bar h1 { font-size: 28px; color: #667eea; margin: 0; }
        .user-info { display: flex; align-items: center; gap: 15px; }
        .user-avatar { width: 45px; height: 45px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 18px; }
        .user-details { text-align: right; }
        .user-details .name { font-weight: 600; color: #333; }
        .user-details .role { font-size: 12px; color: #999; }

        /* Stats Grid */
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 30px; }
        .stat-card { background: white; padding: 25px; border-radius: 12px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06); display: flex; align-items: center; gap: 20px; transition: all 0.3s; }
        .stat-card:hover { transform: translateY(-5px); box-shadow: 0 5px 20px rgba(102, 126, 234, 0.2); }
        .stat-icon { width: 60px; height: 60px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 28px; }
        .stat-icon.subjects { background: #fdf2f8; color: #ec4899; }
        .stat-icon.classes { background: #e8f1ff; color: #667eea; }
        .stat-icon.students { background: #f0fdf4; color: #10b981; }
        .stat-icon.grades { background: #fef3e8; color: #f59e0b; }
        .stat-content h3 { font-size: 12px; color: #999; margin: 0 0 8px 0; text-transform: uppercase; font-weight: 500; }
        .stat-content p { font-size: 32px; font-weight: 700; color: #333; margin: 0; }

        /* Content Section */
        .content-section { background: white; padding: 30px; border-radius: 12px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06); margin-bottom: 30px; }
        .section-title { font-size: 20px; font-weight: 700; color: #333; margin-bottom: 25px; display: flex; align-items: center; gap: 10px; }
        .section-title i { color: #667eea; font-size: 24px; }

        /* Table Styles */
        table { width: 100%; border-collapse: collapse; }
        table thead th { background: #f5f7fa; padding: 15px; text-align: left; font-weight: 600; color: #667eea; border-bottom: 2px solid #e8ecf4; }
        table tbody td { padding: 15px; border-bottom: 1px solid #e8ecf4; vertical-align: middle; }
        table tbody tr:hover { background: #f9fafb; }
        
        .score-value { font-weight: bold; }
        .status-badge { padding: 6px 12px; border-radius: 6px; font-size: 12px; font-weight: 600; display: inline-block;}
        .status-pass { background: #d1fae5; color: #065f46; }
        .status-fail { background: #fee2e2; color: #991b1b; }

        /* Action Buttons */
        .action-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; }
        .action-btn { padding: 15px 20px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; border-radius: 8px; cursor: pointer; font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 14px; text-decoration: none; display: flex; align-items: center; justify-content: center; gap: 8px; transition: all 0.3s; }
        .action-btn:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4); }
        .action-btn.secondary { background: #f0f2ff; color: #667eea; border: 2px solid #667eea; }
        .action-btn.secondary:hover { background: #667eea; color: white; }
        .btn-small { padding: 6px 12px; font-size: 12px; gap: 5px; border-radius: 6px;}

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar { width: 0; position: absolute; }
            .main-content { margin-left: 0; }
            .top-bar { flex-direction: column; gap: 15px; }
            .stats-grid { grid-template-columns: 1fr; }
            table { font-size: 12px; }
            table th, table td { padding: 10px; }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-logo">📚 E-Rapor</div>
                <div class="sidebar-subtitle">Guru</div>
            </div>

            <ul class="sidebar-menu">
                <li><a href="/dashboard" class="active"><i class="bi bi-speedometer2"></i> Dashboard</a></li>
                <li><a href="/grades/create"><i class="bi bi-pencil-square"></i> Input Nilai</a></li>
                <li><a href="/grades"><i class="bi bi-file-text"></i> Daftar Nilai</a></li>
                <li><a href="/reports/all/view"><i class="bi bi-file-earmark-pdf"></i> Laporan</a></li>
            </ul>

            <form method="POST" action="/logout" style="position: absolute; bottom: 20px; left: 20px; right: 20px;">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </div>

        <div class="main-content">
            <div class="top-bar">
                <h1>Dashboard Guru</h1>
                <div class="user-info">
                    <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                    <div class="user-details">
                        <div class="name">{{ Auth::user()->name }}</div>
                        <div class="role">Guru</div>
                    </div>
                </div>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon subjects">📖</div>
                    <div class="stat-content">
                        <h3>Mata Pelajaran</h3>
                        <p>{{ $subjectsCount ?? 0 }}</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon classes">🏫</div>
                    <div class="stat-content">
                        <h3>Kelas Ajar</h3>
                        <p>
                        @if(isset($classesCount))
                            {{ $classesCount }}
                        @elseif(isset($managedClasses))
                            {{ $managedClasses->count() }}
                        @else
                            0
                        @endif
                        </p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon students">👨‍🎓</div>
                    <div class="stat-content">
                        <h3>Total Siswa</h3>
                        <p>{{ $studentsCount ?? 0 }}</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon grades">⭐</div>
                    <div class="stat-content">
                        <h3>Nilai Diinput</h3>
                        <p>{{ $gradesCount ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="content-section">
                <div class="section-title">
                    <i class="bi bi-pencil-square"></i> Masukan Nilai
                </div>
                <div class="action-grid">
                    <a href="/grades/create" class="action-btn">
                        <i class="bi bi-plus-circle"></i> Input Nilai Baru
                    </a>
                    <a href="/grades" class="action-btn secondary">
                        <i class="bi bi-eye"></i> Lihat Semua Nilai
                    </a>
                </div>
            </div>

            <div class="content-section">
                <div class="section-title">
                    <i class="bi bi-building"></i> Kelas Saya
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Kelas</th>
                            <th>Mata Pelajaran</th>
                            <th>Jumlah Siswa</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($managedClasses) && $managedClasses->count() > 0)
                            @foreach($managedClasses as $mc)
                                <tr>
                                    <td>{{ $mc->name }}</td>
                                    <td> - </td>
                                    <td>{{ $mc->students ? $mc->students->count() : 0 }}</td>
                                    <td>
                                        <a href="{{ route('grades.index') }}" class="action-btn btn-small secondary">
                                            <i class="bi bi-pencil"></i> Input / Lihat
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" style="text-align: center; color: #999;">Belum ada kelas yang Anda kelola.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <div class="content-section">
                <div class="section-title">
                    <i class="bi bi-table"></i> Data Nilai (Riwayat Input Terbaru)
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Siswa</th>
                            <th>Mata Pelajaran</th>
                            <th>Guru</th>
                            <th>Nilai</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($recentGrades) && $recentGrades->count() > 0)
                            @foreach($recentGrades as $grade)
                                <tr>
                                    <td><strong>{{ $grade->student->user->name ?? 'N/A' }}</strong></td>
                                    <td>{{ $grade->subject->name ?? 'N/A' }}</td>
                                    <td>{{ Auth::user()->name }}</td>
                                    <td>
                                        <span class="score-value" style="color: {{ $grade->score >= 70 ? '#10b981' : '#ef4444' }}">
                                            {{ $grade->score }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="status-badge {{ $grade->score >= 70 ? 'status-pass' : 'status-fail' }}">
                                            {{ $grade->score >= 70 ? 'Lulus' : 'Tidak Lulus' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div style="display: flex; gap: 5px;">
                                            <a href="{{ route('report.student.detail', $grade->student->id) }}" class="action-btn btn-small secondary" target="_blank">
                                                <i class="bi bi-printer"></i> Cetak
                                            </a>
                                            <a href="{{ route('grades.edit', $grade->id) }}" class="action-btn btn-small secondary">
                                                <i class="bi bi-pencil"></i> Edit
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" style="text-align: center; color: #999; padding: 30px;">
                                    Belum ada data nilai yang diinput.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <div class="content-section">
                <div class="section-title">
                    <i class="bi bi-file-earmark-pdf"></i> Laporan & Export
                </div>
                <div class="action-grid">
                    <a href="/reports/all/view" class="action-btn secondary">
                        <i class="bi bi-download"></i> Cetak Laporan Nilai
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>