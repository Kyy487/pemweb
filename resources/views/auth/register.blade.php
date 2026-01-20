<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - E-Rapor</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container {
            width: 100%;
            max-width: 500px;
        }

        .register-box {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            animation: slideUp 0.5s ease;
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

        .header {
            text-align: center;
            margin-bottom: 35px;
        }

        .logo {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            color: white;
            font-weight: 700;
            margin: 0 auto 15px;
        }

        .header h1 {
            color: #333;
            font-size: 28px;
            margin: 0 0 5px;
        }

        .header p {
            color: #999;
            font-size: 0.95rem;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 500;
            font-size: 0.95rem;
        }

        input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-family: 'Poppins', sans-serif;
            font-size: 1rem;
            transition: all 0.3s;
            box-sizing: border-box;
        }

        input:focus {
            border-color: #667eea;
            outline: none;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        select {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-family: 'Poppins', sans-serif;
            font-size: 1rem;
            transition: all 0.3s;
            box-sizing: border-box;
            background-color: white;
            cursor: pointer;
        }

        select:focus {
            border-color: #667eea;
            outline: none;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s;
            font-family: 'Poppins', sans-serif;
            margin-top: 10px;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(40, 167, 69, 0.4);
        }

        .error {
            color: #e74c3c;
            background: #fadbd8;
            padding: 12px 15px;
            border: 1px solid #f5b7b1;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 0.9rem;
        }

        .error ul {
            margin: 5px 0 0 20px;
        }

        .error li {
            margin: 3px 0;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
        }

        .footer p {
            color: #999;
            font-size: 0.9rem;
            margin-bottom: 10px;
        }

        .footer a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
        }

        .footer a:hover {
            color: #764ba2;
        }

        .divider {
            text-align: center;
            color: #ccc;
            margin: 25px 0;
            font-size: 0.85rem;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .form-row .form-group {
            margin-bottom: 0;
        }

        @media (max-width: 480px) {
            .register-box {
                padding: 30px 20px;
            }

            .header h1 {
                font-size: 24px;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }

            .form-row .form-group {
                margin-bottom: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="register-box">
            <div class="header">
                <div class="logo">E</div>
                <h1>DAFTAR</h1>
                <p>Buat Akun E-Rapor Baru</p>
            </div>

            @if ($errors->any())
                <div class="error">
                    <strong>Error Pendaftaran!</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="Masukkan nama lengkap">
                    @error('name') <span style="color: #e74c3c; font-size: 0.85rem; margin-top: 5px; display: block;">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="nama@example.com">
                    @error('email') <span style="color: #e74c3c; font-size: 0.85rem; margin-top: 5px; display: block;">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="role">Pilih Peran</label>
                    <select id="role" name="role" required style="width: 100%; padding: 12px 15px; border: 2px solid #e0e0e0; border-radius: 8px; font-family: 'Poppins', sans-serif; font-size: 1rem; transition: all 0.3s; box-sizing: border-box;">
                        <option value="">-- Pilih Peran --</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="teacher" {{ old('role') == 'teacher' ? 'selected' : '' }}>Guru</option>
                        <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>Siswa</option>
                    </select>
                    @error('role') <span style="color: #e74c3c; font-size: 0.85rem; margin-top: 5px; display: block;">{{ $message }}</span> @enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required placeholder="••••••••" autocomplete="new-password">
                        @error('password') <span style="color: #e74c3c; font-size: 0.85rem; margin-top: 5px; display: block;">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Konfirmasi Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="••••••••" autocomplete="new-password">
                    </div>
                </div>

                <button type="submit">DAFTAR</button>
            </form>

            <div class="divider">atau</div>

            <div class="footer">
                <p>Sudah punya akun?</p>
                <a href="{{ route('login') }}">Masuk di Sini</a>
            </div>
        </div>
    </div>
</body>
</html>