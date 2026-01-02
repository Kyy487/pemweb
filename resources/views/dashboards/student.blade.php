<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - E-Rapor</title>
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #333;
            min-height: 100vh;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 30px 20px;
        }

        .top-bar {
            background: white;
            padding: 20px 30px;
            border-radius: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
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
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 20px;
        }

        .user-details {
            text-align: right;
        }

        .user-details .name {
            font-weight: 600;
            color: #333;
            font-size: 15px;
        }

        .user-details .role {
            font-size: 12px;
            color: #999;
        }

        /* Student Info Card */
        .info-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            margin-bottom: 25px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            border-left: 5px solid #667eea;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .info-item h4 {
            font-size: 12px;
            color: #999;
            margin: 0 0 8px 0;
            text-transform: uppercase;
            font-weight: 600;
        }

        .info-item p {
            font-size: 16px;
            color: #333;
            margin: 0;
            font-weight: 500;
        }

        /* Grades Section */
        .grades-section {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 25px;
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

        /* Grades Table */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table thead th {
            background: #f5f7fa;
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: #667eea;
            border-bottom: 2px solid #e8ecf4;
        }

        table tbody td {
            padding: 15px;
            border-bottom: 1px solid #e8ecf4;
        }

        table tbody tr:hover {
            background: #f9fafb;
        }

        .grade-value {
            font-weight: 700;
            font-size: 16px;
            color: #333;
        }

        .grade-pass {
            color: #10b981;
        }

        .grade-fail {
            color: #ef4444;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 25px;
        }

        .stat-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 20px;
            border-radius: 12px;
            color: white;
            text-align: center;
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }

        .stat-card h4 {
            font-size: 12px;
            opacity: 0.9;
            margin: 0 0 8px 0;
            text-transform: uppercase;
        }

        .stat-card p {
            font-size: 28px;
            font-weight: 700;
            margin: 0;
        }

        /* Action Buttons */
        .action-buttons {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-top: 25px;
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

        .action-btn.logout {
            background: #ef4444;
            width: 100%;
            margin-top: auto;
        }

        .action-btn.logout:hover {
            background: #dc2626;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .top-bar {
                flex-direction: column;
                gap: 15px;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            table {
                font-size: 12px;
            }

            table th, table td {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Top Bar -->
        <div class="top-bar">
            <h1>Dashboard Siswa</h1>
            <div class="user-info">
                <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                <div class="user-details">
                    <div class="name">{{ Auth::user()->name }}</div>
                    <div class="role">Siswa</div>
                </div>
            </div>
        </div>

        <!-- Student Info Card -->
        <div class="info-card">
            <div class="section-title">
                <i class="bi bi-person-circle"></i> Informasi Siswa
            </div>
            <div class="info-grid">
                <div class="info-item">
                    <h4>Nama Lengkap</h4>
                    <p>{{ Auth::user()->name }}</p>
                </div>
                <div class="info-item">
                    <h4>Nomor Induk</h4>
                    <p>{{ $studentData->nisn ?? '-' }}</p>
                </div>
                <div class="info-item">
                    <h4>Kelas</h4>
                    <p>{{ $studentData->studyClass->name ?? '-' }}</p>
                </div>
                <div class="info-item">
                    <h4>Wali Kelas</h4>
                    <p>{{ $studentData->studyClass->homeroomTeacher->name ?? '-' }}</p>
                </div>
            </div>
        </div>

        <!-- Grade Summary Stats -->
        <div class="stats-grid">
            <div class="stat-card">
                <h4>Rata-rata Nilai</h4>
                <p>{{ $studentData->grades->count() > 0 ? number_format($studentData->grades->avg('score'), 1) : '0' }}</p>
            </div>
            <div class="stat-card">
                <h4>Total Mata Pelajaran</h4>
                <p>{{ $studentData->grades->count() }}</p>
            </div>
            <div class="stat-card">
                <h4>Status</h4>
                <p>{{ $studentData->grades->count() > 0 && $studentData->grades->where('score', '>=', 70)->count() === $studentData->grades->count() ? 'Lulus ✓' : ($studentData->grades->count() > 0 ? 'Belum Lulus' : '-') }}</p>
            </div>
            <div class="stat-card">
                <h4>Lulus</h4>
                <p>{{ $studentData->grades->where('score', '>=', 70)->count() }}/{{ $studentData->grades->count() }}</p>
            </div>
        </div>

        <!-- Grades Section -->
        <div class="grades-section">
            <div class="section-title">
                <i class="bi bi-file-earmark-text"></i> Nilai Mata Pelajaran
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Mata Pelajaran</th>
                        <th>Guru</th>
                        <th>Nilai</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($studentData->grades as $grade)
                        <tr>
                            <td>{{ $grade->subject->name ?? '-' }}</td>
                            <td>{{ $grade->teacher->name ?? '-' }}</td>
                            <td><span class="grade-value {{ $grade->score >= 70 ? 'grade-pass' : 'grade-fail' }}">{{ $grade->score }}</span></td>
                            <td>{{ $grade->score >= 70 ? 'Lulus' : 'Tidak Lulus' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="text-align: center; color: #999; padding: 30px;">Belum ada nilai.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Download Rapor -->
            <div class="action-buttons">
                <a href="/reports/student/view" class="action-btn">
                    <i class="bi bi-download"></i> Download Rapor
                </a>
                <a href="/reports/student/view" class="action-btn">
                    <i class="bi bi-printer"></i> Cetak Rapor
                </a>
            </div>
        </div>

        <!-- Logout -->
        <div style="margin-top: 30px;">
            <form method="POST" action="/logout">
                @csrf
                <button type="submit" class="action-btn logout">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </div>
    </div>
</body>
</html>
    </style>
</head>
<body>
    <div class="container">