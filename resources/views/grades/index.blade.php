<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Nilai - E-Rapor</title>
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
            text-decoration: none;
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

        .main-content {
            margin-left: 260px;
            flex: 1;
            padding: 30px;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            background: white;
            padding: 20px 30px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        }

        .page-header h1 {
            font-size: 28px;
            color: #667eea;
            margin: 0;
        }

        .btn {
            padding: 12px 24px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-secondary {
            background: #f0f2ff;
            color: #667eea;
            border: 2px solid #667eea;
        }

        .btn-secondary:hover {
            background: #667eea;
            color: white;
        }

        .btn-small {
            padding: 8px 12px;
            font-size: 12px;
            gap: 4px;
        }

        .btn-danger {
            background: #ef4444;
        }

        .btn-danger:hover {
            background: #dc2626;
        }

        .content {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        }

        .alert {
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border-left: 4px solid #10b981;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border-left: 4px solid #ef4444;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
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

        .score-pass {
            color: #10b981;
            font-weight: 600;
        }

        .score-fail {
            color: #ef4444;
            font-weight: 600;
        }

        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: #999;
        }

        .empty-state i {
            font-size: 48px;
            color: #ddd;
            margin-bottom: 10px;
        }

        .actions {
            display: flex;
            gap: 8px;
        }

        @media (max-width: 768px) {
            .sidebar { width: 0; }
            .main-content { margin-left: 0; padding: 15px; }
            .page-header {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }

            table {
                font-size: 12px;
            }

            table th, table td {
                padding: 10px;
            }
        }

        @media print {
            .sidebar, .logout-btn, .btn, .actions form, .empty-state, .pagination {
                display: none !important;
            }
            
            .main-content {
                margin-left: 0;
                padding: 20px;
            }

            .page-header {
                background: none;
                box-shadow: none;
                border-bottom: 2px solid #667eea;
                padding: 20px 0;
                margin-bottom: 20px;
            }

            .content {
                background: none;
                box-shadow: none;
                padding: 0;
            }

            table {
                page-break-inside: avoid;
            }

            table thead {
                display: table-header-group;
            }

            table tr {
                page-break-inside: avoid;
            }

            .btn-secondary {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-logo"><i class="bi bi-mortarboard"></i> E-Rapor</div>
                <div class="sidebar-subtitle">Sistem Rapor Digital</div>
            </div>
            <ul class="sidebar-menu">
                <li><a href="{{ route('dashboard') }}"><i class="bi bi-speedometer2"></i> Dashboard</a></li>
                @if(Auth::user()->role === 'admin')
                    <li><a href="{{ route('classes.index') }}"><i class="bi bi-building"></i> Kelas</a></li>
                    <li><a href="{{ route('students.index') }}"><i class="bi bi-people-fill"></i> Kelola Siswa</a></li>
                    <li><a href="{{ route('subjects.index') }}"><i class="bi bi-book"></i> Mata Pelajaran</a></li>
                    <li><a href="{{ route('users.index') }}"><i class="bi bi-person-circle"></i> Pengguna</a></li>
                    <li><a href="{{ route('grades.index') }}" class="active"><i class="bi bi-graph-up"></i> Nilai</a></li>
                @elseif(Auth::user()->role === 'teacher')
                    <li><a href="{{ route('grades.input.form') }}"><i class="bi bi-pencil-square"></i> Input Nilai</a></li>
                    <li><a href="{{ route('grades.index') }}" class="active"><i class="bi bi-graph-up"></i> Data Nilai</a></li>
                @else
                    <li><a href="{{ route('grades.index') }}" class="active"><i class="bi bi-graph-up"></i> Nilai Saya</a></li>
                @endif
            </ul>
            <form method="POST" action="{{ route('logout') }}" style="display: contents;">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Page Header -->
            <div class="page-header" style="justify-content: space-between;">
                <h1><i class="bi bi-file-earmark-text"></i> Manajemen Nilai</h1>
                <div style="display: flex; gap: 10px;">
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('grades.print') }}" class="btn btn-secondary" target="_blank" title="Cetak semua nilai">
                            <i class="bi bi-printer"></i> Cetak Semua
                        </a>
                        <button onclick="window.print()" class="btn btn-secondary" title="Cetak halaman nilai">
                            <i class="bi bi-printer"></i> Cetak
                        </button>
                        <a href="{{ route('grades.create') }}" class="btn">
                            <i class="bi bi-plus-circle"></i> Tambah Nilai
                        </a>
                    @elseif(Auth::user()->role === 'teacher')
                        <button onclick="window.print()" class="btn btn-secondary" title="Cetak halaman nilai">
                            <i class="bi bi-printer"></i> Cetak
                        </button>
                    @else
                        <button onclick="window.print()" class="btn btn-secondary" title="Cetak halaman nilai">
                            <i class="bi bi-printer"></i> Cetak
                        </button>
                    @endif
                </div>
            </div>

            <!-- Alerts -->
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                <i class="bi bi-check-circle"></i>
                <span>{{ $message }}</span>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-error">
                <i class="bi bi-exclamation-circle"></i>
                <span>Ada kesalahan dalam form</span>
            </div>
        @endif

        <!-- Content -->
        <div class="content">
            @if ($grades->count() > 0)
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
                        @foreach ($grades as $grade)
                            <tr>
                                <td>
                                    <strong>{{ $grade->student->name ?? 'N/A' }}</strong>
                                </td>
                                <td>{{ $grade->subject->name ?? 'N/A' }}</td>
                                <td>{{ $grade->teacher->name ?? 'N/A' }}</td>
                                <td>
                                    <span class="{{ $grade->score >= 70 ? 'score-pass' : 'score-fail' }}">
                                        {{ $grade->score }}
                                    </span>
                                </td>
                                <td>
                                    @if ($grade->score >= 70)
                                        <span style="background: #d1fae5; color: #065f46; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 600;">Lulus</span>
                                    @else
                                        <span style="background: #fee2e2; color: #991b1b; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 600;">Tidak Lulus</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="actions">
                                        <a href="{{ route('report.student.view', $grade->student->id) }}" class="btn btn-secondary btn-small" target="_blank" title="Cetak rapor siswa">
                                            <i class="bi bi-printer"></i> Cetak
                                        </a>
                                        @if(Auth::user()->role === 'admin' || (Auth::user()->role === 'teacher' && $grade->student->studyClass->homeroom_teacher_id === Auth::id()))
                                            <a href="{{ route('grades.edit', $grade->id) }}" class="btn btn-secondary btn-small">
                                                <i class="bi bi-pencil"></i> Edit
                                            </a>
                                        @endif
                                        @if(Auth::user()->role === 'admin')
                                            <form action="{{ route('grades.destroy', $grade->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus nilai ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-small">
                                                    <i class="bi bi-trash"></i> Hapus
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination -->
                <div style="margin-top: 20px; display: flex; justify-content: center;">
                    {{ $grades->links() }}
                </div>
            @else
                <div class="empty-state">
                    <div style="font-size: 48px; margin-bottom: 10px;">📝</div>
                    <h3 style="color: #333; margin-bottom: 5px;">Belum Ada Nilai</h3>
                    <p>Mulai dengan menambahkan nilai siswa baru</p>
                    <a href="{{ route('grades.create') }}" class="btn" style="margin-top: 15px;">
                        <i class="bi bi-plus-circle"></i> Tambah Nilai Pertama
                    </a>
                </div>
            @endif
            </div>
        </div>
    </div>
</body>
</html>
