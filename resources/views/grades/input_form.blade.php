<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Nilai Siswa - E-Rapor</title>
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

        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            border-radius: 8px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }

        .header h1 {
            font-size: 24px;
            margin-bottom: 5px;
        }

        .header p {
            font-size: 14px;
            opacity: 0.9;
        }

        .card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            padding: 25px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            color: #333;
        }

        select, input[type="number"] {
            width: 100%;
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-family: Poppins, sans-serif;
            font-size: 13px;
            transition: border-color 0.3s;
        }

        select:focus, input[type="number"]:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .filter-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            font-family: Poppins, sans-serif;
            font-size: 13px;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-secondary {
            background: #f0f0f0;
            color: #333;
        }

        .btn-secondary:hover {
            background: #e0e0e0;
        }

        .alert {
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-warning {
            background: #fff3cd;
            color: #856404;
            border: 1px solid #ffeaa7;
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #667eea;
            color: white;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            font-size: 12px;
        }

        tbody tr:nth-child(even) {
            background: #f9f9f9;
        }

        tbody tr:hover {
            background: #f0f2ff;
        }

        .input-grade {
            width: 80px;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 3px;
            text-align: center;
        }

        .input-grade:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 2px rgba(102, 126, 234, 0.1);
        }

        .button-group {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            margin-top: 25px;
        }

        .empty-state {
            text-align: center;
            padding: 40px;
            color: #999;
        }

        .empty-state i {
            font-size: 48px;
            margin-bottom: 15px;
            opacity: 0.5;
        }

        .note {
            background: #e3f2fd;
            border-left: 4px solid #2196F3;
            padding: 15px;
            border-radius: 3px;
            margin-bottom: 20px;
            font-size: 12px;
            color: #1565c0;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>📊 Input Nilai Siswa</h1>
            <p>Masukkan nilai siswa per kelas dan mata pelajaran</p>
        </div>

        <!-- Success Alert -->
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <i class="bi bi-check-circle"></i> {{ $message }}
            </div>
        @endif

        <!-- Filter Card -->
        <div class="card">
            <form method="GET" action="{{ route('grades.input.form') }}">
                <div class="filter-row">
                    <div class="form-group">
                        <label for="class_id">📚 Pilih Kelas:</label>
                        <select name="class_id" id="class_id" onchange="this.form.submit()">
                            <option value="">-- Pilih Kelas --</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}" {{ request('class_id') == $class->id ? 'selected' : '' }}>
                                    {{ $class->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="subject_id">📖 Pilih Mata Pelajaran:</label>
                        <select name="subject_id" id="subject_id" onchange="this.form.submit()">
                            <option value="">-- Pilih Mata Pelajaran --</option>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}" {{ request('subject_id') == $subject->id ? 'selected' : '' }}>
                                    {{ $subject->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>
        </div>

        <!-- Students Grades Input -->
        @if($classId && $subjectId)
            @if($students->count() > 0)
                <div class="note">
                    <i class="bi bi-info-circle"></i> <strong>Catatan:</strong> Nilai harus antara 0-100. Input nilai langsung di tabel lalu klik "Simpan Nilai" untuk menyimpan perubahan.
                </div>

                <div class="card">
                    <h3 style="margin-bottom: 20px;">
                        <i class="bi bi-pencil-square"></i> Masukkan Nilai Siswa
                    </h3>

                    <form method="POST" action="{{ route('grades.store.batch') }}">
                        @csrf

                        <input type="hidden" name="class_id" value="{{ $classId }}">
                        <input type="hidden" name="subject_id" value="{{ $subjectId }}">

                        <div class="table-container">
                            <table>
                                <thead>
                                    <tr>
                                        <th width="40">No.</th>
                                        <th>Nama Siswa</th>
                                        <th width="100">NISN</th>
                                        <th width="120">Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($students as $index => $student)
                                        @php
                                            $existingGrade = $student->grades->first();
                                        @endphp
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <strong>{{ $student->user->name ?? 'N/A' }}</strong>
                                            </td>
                                            <td>{{ $student->nisn ?? '-' }}</td>
                                            <td>
                                                <input 
                                                    type="number" 
                                                    name="grades[{{ $student->id }}][score]" 
                                                    class="input-grade"
                                                    min="0" 
                                                    max="100" 
                                                    value="{{ $existingGrade->score ?? '' }}"
                                                    placeholder="0-100"
                                                    required
                                                >
                                                <input type="hidden" name="grades[{{ $student->id }}][student_id]" value="{{ $student->id }}">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="button-group">
                            <a href="{{ route('grades.input.form') }}" class="btn btn-secondary">
                                <i class="bi bi-x-circle"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle"></i> Simpan Nilai
                            </button>
                        </div>
                    </form>
                </div>
            @else
                <div class="card">
                    <div class="empty-state">
                        <i class="bi bi-inbox"></i>
                        <h3>Tidak ada siswa</h3>
                        <p>Belum ada siswa di kelas ini</p>
                    </div>
                </div>
            @endif
        @else
            <div class="card">
                <div class="empty-state">
                    <i class="bi bi-arrow-left-right"></i>
                    <h3>Pilih Kelas dan Mata Pelajaran</h3>
                    <p>Silakan pilih kelas dan mata pelajaran di atas untuk memulai memasukkan nilai</p>
                </div>
            </div>
        @endif
    </div>
</body>
</html>
