<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Siswa - E-Rapor</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; background: #f5f7fa; color: #333; }
        .wrapper { display: flex; min-height: 100vh; }
        .sidebar { width: 260px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 30px 0; position: fixed; height: 100vh; overflow-y: auto; box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1); }
        .sidebar-header { padding: 0 20px 30px; border-bottom: 1px solid rgba(255, 255, 255, 0.1); text-align: center; }
        .sidebar-logo { font-size: 24px; font-weight: 700; margin-bottom: 5px; }
        .sidebar-subtitle { font-size: 12px; opacity: 0.8; }
        .sidebar-menu { list-style: none; margin-top: 30px; }
        .sidebar-menu li { margin: 0; }
        .sidebar-menu a { display: flex; align-items: center; padding: 15px 20px; color: rgba(255, 255, 255, 0.8); transition: all 0.3s; border-left: 3px solid transparent; gap: 12px; text-decoration: none; }
        .sidebar-menu a:hover { background: rgba(255, 255, 255, 0.1); color: white; border-left-color: white; }
        .sidebar-menu a.active { background: rgba(255, 255, 255, 0.15); color: white; border-left-color: white; font-weight: 600; }
        .sidebar-menu i { font-size: 18px; width: 20px; }
        .logout-btn { position: absolute; bottom: 20px; left: 20px; right: 20px; padding: 12px 15px; background: rgba(255, 255, 255, 0.2); border: 1px solid rgba(255, 255, 255, 0.3); color: white; border-radius: 8px; cursor: pointer; text-align: center; transition: all 0.3s; font-family: 'Poppins', sans-serif; font-weight: 600; text-decoration: none; display: flex; align-items: center; justify-content: center; gap: 8px; }
        .logout-btn:hover { background: rgba(255, 255, 255, 0.3); }
        .main-content { margin-left: 260px; flex: 1; padding: 30px; }
        .page-header { background: white; padding: 20px 30px; border-radius: 12px; display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06); gap: 20px; }
        .page-header h1 { font-size: 28px; color: #667eea; margin: 0; }
        .btn { padding: 12px 24px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; border-radius: 8px; cursor: pointer; font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 14px; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; transition: all 0.3s; }
        .btn:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4); color: white; }
        .btn-secondary { background: #f0f2ff; color: #667eea; border: 2px solid #667eea; padding: 8px 12px; font-size: 12px; gap: 4px; }
        .btn-secondary:hover { background: #667eea; color: white; }
        .btn-danger { background: #ef4444; padding: 8px 12px; font-size: 12px; gap: 4px; margin-left: 5px; }
        .btn-danger:hover { background: #dc2626; }
        .content { background: white; padding: 30px; border-radius: 12px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06); }
        .alert { padding: 15px 20px; border-radius: 8px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; }
        .alert-success { background: #d1fae5; color: #065f46; border-left: 4px solid #10b981; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table thead th { background: #f5f7fa; padding: 15px; text-align: left; font-weight: 600; color: #667eea; border-bottom: 2px solid #e8ecf4; }
        table tbody td { padding: 15px; border-bottom: 1px solid #e8ecf4; }
        table tbody tr:hover { background: #f9fafb; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05); }
        .actions { display: flex; gap: 6px; align-items: center; flex-wrap: wrap; }
        .btn-sm { padding: 8px 12px; font-size: 12px; white-space: nowrap; }
        .badge { display: inline-block; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; }
        .badge-class { background: #dcfce7; color: #166534; }
        .badge-teacher { background: #fee2e2; color: #991b1b; }
        .empty-state { text-align: center; padding: 40px 20px; color: #999; }
        @media (max-width: 768px) { 
            .sidebar { width: 0; } 
            .main-content { margin-left: 0; padding: 15px; }
            .page-header { flex-direction: column; gap: 15px; align-items: flex-start; }
            table { font-size: 12px; }
            table th, table td { padding: 10px; }
            .actions { flex-direction: column; }
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
                    <li><a href="{{ route('students.index') }}" class="active"><i class="bi bi-people-fill"></i> Kelola Siswa</a></li>
                    <li><a href="{{ route('subjects.index') }}"><i class="bi bi-book"></i> Mata Pelajaran</a></li>
                    <li><a href="{{ route('users.index') }}"><i class="bi bi-person-circle"></i> Pengguna</a></li>
                    <li><a href="{{ route('grades.index') }}"><i class="bi bi-graph-up"></i> Nilai</a></li>
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
            <div class="page-header">
                <div>
                    <h1><i class="bi bi-people-fill"></i> Kelola Siswa</h1>
                    <p style="color: #999; margin-top: 5px; font-size: 14px;">Kelola penempatan siswa ke kelas</p>
                </div>
                <a href="{{ route('students.create') }}" class="btn">
                    <i class="bi bi-plus-circle"></i> Tambah Siswa
                </a>
            </div>

            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <i class="bi bi-check-circle"></i>
                    <span>{{ $message }}</span>
                </div>
            @endif

            <div class="content">
                @if ($students->count() > 0)
                    <table>
                        <thead>
                            <tr>
                                <th>Nama Siswa</th>
                                <th>NISN</th>
                                <th>Kelas</th>
                                <th>Wali Kelas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                <tr>
                                    <td><strong>{{ $student->name }}</strong></td>
                                    <td>{{ $student->nisn }}</td>
                                    <td>
                                        <span class="badge badge-class">
                                            {{ $student->studyClass->name ?? 'Tidak ada kelas' }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($student->studyClass && $student->studyClass->homeroomTeacher)
                                            <span class="badge badge-teacher">
                                                {{ $student->studyClass->homeroomTeacher->name }}
                                            </span>
                                        @else
                                            <span style="color: #999;">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="actions">
                                            <a href="{{ route('students.edit', $student->id) }}" class="btn btn-secondary btn-sm">
                                                <i class="bi bi-pencil"></i> Edit
                                            </a>
                                            <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus siswa ini dari kelas?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="bi bi-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="empty-state">
                        <div style="font-size: 48px; margin-bottom: 10px;">👥</div>
                        <h3 style="color: #333; margin-bottom: 5px;">Belum Ada Siswa di Kelas</h3>
                        <p>Mulai dengan menambahkan siswa ke kelas</p>
                        <a href="{{ route('students.create') }}" class="btn" style="margin-top: 15px;">
                            <i class="bi bi-plus-circle"></i> Tambah Siswa Pertama
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
