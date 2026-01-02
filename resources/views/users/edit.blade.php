<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengguna - E-Rapor</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 20px; }
        .form-container { background: white; padding: 40px; border-radius: 12px; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15); max-width: 600px; width: 100%; }
        .form-header { margin-bottom: 30px; text-align: center; }
        .form-header h1 { font-size: 28px; color: #667eea; margin-bottom: 5px; display: flex; align-items: center; justify-content: center; gap: 10px; }
        .form-header p { color: #999; font-size: 14px; }
        .form-group { margin-bottom: 25px; }
        label { display: block; margin-bottom: 8px; font-weight: 600; color: #333; font-size: 14px; }
        input, select { width: 100%; padding: 12px 15px; border: 2px solid #e8ecf4; border-radius: 8px; font-family: 'Poppins', sans-serif; font-size: 14px; transition: all 0.3s; }
        input:focus, select:focus { border-color: #667eea; box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1); outline: none; }
        input::placeholder { color: #ccc; }
        .error-msg { color: #ef4444; font-size: 12px; margin-top: 5px; display: block; }
        .form-actions { display: flex; gap: 15px; margin-top: 30px; }
        .btn { padding: 12px 24px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; border-radius: 8px; cursor: pointer; font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 14px; transition: all 0.3s; flex: 1; text-align: center; text-decoration: none; display: flex; align-items: center; justify-content: center; gap: 8px; }
        .btn:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4); }
        .btn-secondary { background: #f0f2ff; color: #667eea; border: 2px solid #667eea; }
        .btn-secondary:hover { background: #667eea; color: white; }
        .helper-text { font-size: 12px; color: #999; margin-top: 5px; }
        @media (max-width: 600px) { 
            .form-container { padding: 20px; }
            .form-header h1 { font-size: 22px; }
            .form-actions { flex-direction: column; }
        }
    </style>
</head>
<body>
    <div class="form-container">
        <div class="form-header">
            <h1><i class="bi bi-pencil-square"></i> Edit Pengguna</h1>
            <p>Perbarui informasi pengguna</p>
        </div>

        <form method="POST" action="{{ route('users.update', $user) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Nama Lengkap *</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" placeholder="Contoh: John Doe" required>
                @error('name') <span class="error-msg"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="email">Email *</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" placeholder="contoh@email.com" required>
                @error('email') <span class="error-msg"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah">
                <p class="helper-text">Minimal 8 karakter jika ingin mengubah password</p>
                @error('password') <span class="error-msg"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password baru jika ada">
            </div>

            <div class="form-group">
                <label for="role">Role *</label>
                <select id="role" name="role" required onchange="toggleStudentFields()">
                    <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>👤 Admin</option>
                    <option value="teacher" {{ old('role', $user->role) === 'teacher' ? 'selected' : '' }}>👨‍🏫 Guru</option>
                    <option value="student" {{ old('role', $user->role) === 'student' ? 'selected' : '' }}>👨‍🎓 Siswa</option>
                </select>
                @error('role') <span class="error-msg"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span> @enderror
            </div>

            <div id="student-fields" style="display: none;">
                <div class="form-group">
                    <label for="nisn">NISN (Nomor Induk Siswa) *</label>
                    <input type="text" id="nisn" name="nisn" value="{{ old('nisn', $student?->nisn) }}" placeholder="Nomor Induk Siswa">
                    @error('nisn') <span class="error-msg"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="study_class_id">Kelas *</label>
                    <select id="study_class_id" name="study_class_id">
                        <option value="">-- Pilih Kelas --</option>
                        @foreach($classes as $class)
                            <option value="{{ $class->id }}" {{ old('study_class_id', $student?->study_class_id) == $class->id ? 'selected' : '' }}>
                                {{ $class->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('study_class_id') <span class="error-msg"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('users.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
                <button type="submit" class="btn">
                    <i class="bi bi-check-circle"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
    <script>
        function toggleStudentFields() {
            const roleSelect = document.getElementById('role');
            const studentFields = document.getElementById('student-fields');
            const nisn = document.getElementById('nisn');
            const studyClassId = document.getElementById('study_class_id');
            
            if (roleSelect.value === 'student') {
                studentFields.style.display = 'block';
                nisn.required = true;
                studyClassId.required = true;
            } else {
                studentFields.style.display = 'none';
                nisn.required = false;
                studyClassId.required = false;
            }
        }
        
        // Panggil saat halaman dimuat
        window.addEventListener('DOMContentLoaded', toggleStudentFields);
    </script>
</body>
</html>
