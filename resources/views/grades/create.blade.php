<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Nilai - E-Rapor</title>
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
            padding: 30px 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
        }

        .form-card {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        }

        .form-header {
            margin-bottom: 30px;
            text-align: center;
        }

        .form-header h1 {
            font-size: 28px;
            color: #667eea;
            margin-bottom: 10px;
        }

        .form-header p {
            color: #999;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
            font-size: 14px;
        }

        input, select {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e8ecf4;
            border-radius: 8px;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            transition: all 0.3s;
        }

        input:focus, select:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        input[type="number"] {
            padding: 12px 15px;
        }

        .form-actions {
            display: flex;
            gap: 10px;
            margin-top: 30px;
        }

        .btn {
            flex: 1;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
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
            background: #f0f2ff;
            color: #667eea;
            border: 2px solid #667eea;
        }

        .btn-secondary:hover {
            background: #667eea;
            color: white;
        }

        .error {
            color: #ef4444;
            font-size: 12px;
            margin-top: 5px;
        }

        .form-group.has-error input,
        .form-group.has-error select {
            border-color: #ef4444;
        }

        @media (max-width: 600px) {
            .form-card {
                padding: 20px;
            }

            .form-actions {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-card">
            <div class="form-header">
                <h1><i class="bi bi-plus-circle"></i> Tambah Nilai</h1>
                <p>Masukkan nilai siswa baru</p>
            </div>

            <form action="{{ route('grades.store') }}" method="POST">
                @csrf

                <div class="form-group {{ $errors->has('student_id') ? 'has-error' : '' }}">
                    <label for="student_id">Siswa</label>
                    <select name="student_id" id="student_id" required>
                        <option value="">-- Pilih Siswa --</option>
                        @foreach ($students as $student)
                            <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>
                                {{ $student->name }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('student_id'))
                        <div class="error">{{ $errors->first('student_id') }}</div>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('subject_id') ? 'has-error' : '' }}">
                    <label for="subject_id">Mata Pelajaran</label>
                    <select name="subject_id" id="subject_id" required>
                        <option value="">-- Pilih Mata Pelajaran --</option>
                        @foreach ($subjects as $subject)
                            <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
                                {{ $subject->name }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('subject_id'))
                        <div class="error">{{ $errors->first('subject_id') }}</div>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('score') ? 'has-error' : '' }}">
                    <label for="score">Nilai (0-100)</label>
                    <input type="number" name="score" id="score" min="0" max="100" placeholder="Masukkan nilai" value="{{ old('score') }}" required>
                    @if ($errors->has('score'))
                        <div class="error">{{ $errors->first('score') }}</div>
                    @endif
                </div>

                <div class="form-actions">
                    <a href="{{ route('grades.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle"></i> Simpan Nilai
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
