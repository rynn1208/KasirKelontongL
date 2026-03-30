<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Kasir Toko</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-card {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            width: 100%;
            max-width: 400px;
            border-top: 5px solid #229cde;
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

        input {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 6px;
            box-sizing: border-box;
            font-family: inherit;
            transition: 0.3s;
        }

        input:focus {
            border-color: #229cde;
            outline: none;
            box-shadow: 0 0 0 3px rgba(17, 107, 226, 0.2);
        }

        .btn-login {
            background-color: #229cde;
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

        .btn-login:hover {
            background-color: #0a537b;
        }

        .link-register {
            display: block;
            text-align: center;
            margin-top: 20px;
            font-size: 13px;
            color: #7f8c8d;
            text-decoration: none;
        }

        .link-register:hover {
            color: #0a537b;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="login-card">
        <div class="logo-text">KASIR TOKO</div>
        <div class="subtitle">Silakan masuk ke akun Anda</div>

        @if ($errors->any())
            <div
                style="background: #fdeaea; color: #c0392b; padding: 10px; border-radius: 5px; font-size: 13px; margin-bottom: 20px; text-align: center; border: 1px solid #fad4d4;">
                Email atau password yang Anda masukkan salah!
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <label>Alamat Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="nama@email.com">

            <label>Password</label>
            <input type="password" name="password" required placeholder="••••••••">

            <button type="submit" class="btn-login">Masuk ke Sistem</button>
        </form>

        <a href="/register" class="link-register">Belum punya akun? Daftar di sini</a>
    </div>
</body>

</html>