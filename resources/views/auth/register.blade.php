<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Kasir Toko</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
            box-sizing: border-box;
        }

        .register-card {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            width: 100%;
            max-width: 450px;
            border-top: 5px solid #3498db;
        }

        .logo-text {
            text-align: center;
            font-size: 24px;
            font-weight: 800;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .subtitle {
            text-align: center;
            color: #7f8c8d;
            font-size: 14px;
            margin-bottom: 30px;
        }

        label {
            display: block;
            font-size: 13px;
            color: #34495e;
            font-weight: bold;
            margin-bottom: 8px;
        }

        input,
        select {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            box-sizing: border-box;
            font-family: inherit;
            transition: 0.3s;
        }

        input:focus,
        select:focus {
            border-color: #3498db;
            outline: none;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        }

        .btn-register {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 12px;
            width: 100%;
            border-radius: 6px;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
            font-family: inherit;
            transition: 0.2s;
            margin-top: 10px;
        }

        .btn-register:hover {
            background-color: #2980b9;
        }

        .link-login {
            display: block;
            text-align: center;
            margin-top: 20px;
            font-size: 13px;
            color: #7f8c8d;
            text-decoration: none;
        }

        .link-login:hover {
            color: #3498db;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="register-card">
        <div class="logo-text">KASIR TOKO</div>
        <div class="subtitle">Buat akun pegawai baru</div>

        @if ($errors->any())
            <div
                style="background: #fdeaea; color: #c0392b; padding: 10px; border-radius: 5px; font-size: 13px; margin-bottom: 20px; border: 1px solid #fad4d4;">
                Terdapat kesalahan pengisian. Pastikan email belum terpakai dan password minimal 8 karakter.
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <label>Nama Lengkap</label>
            <input type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="Cth: Budi Santoso">

            <label>Alamat Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required placeholder="nama@email.com">

            <label>Jabatan (Role)</label>
            <select name="role" required>
                <option value="Operator">Kasir (Operator)</option>
                <option value="Admin">Admin Toko</option>
                <option value="Super Admin">Super Admin</option>
            </select>

            <label>Password</label>
            <input type="password" name="password" required placeholder="Minimal 8 karakter">

            <label>Konfirmasi Password</label>
            <input type="password" name="password_confirmation" required placeholder="Ulangi password di atas">

            <button type="submit" class="btn-register">Daftar Akun Baru</button>
        </form>

        <a href="/login" class="link-login">Sudah punya akun? Masuk di sini</a>
    </div>
</body>

</html>