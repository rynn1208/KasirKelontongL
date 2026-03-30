<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pegawai - Kasir Toko</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f4f6f9;
            color: #333;
            margin: 0;
            padding-bottom: 40px;
        }

        /* NAVBAR ELEGAN */
        .navbar {
            background-color: #2c3e50;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .navbar .brand {
            font-size: 18px;
            font-weight: 800;
            letter-spacing: 1px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .role-badge {
            background-color: #e67e22;
            font-size: 12px;
            padding: 4px 12px;
            border-radius: 20px;
            font-weight: bold;
            text-transform: capitalize;
        }

        .nav-links {
            display: flex;
            gap: 25px;
            align-items: center;
            font-size: 14px;
            font-weight: 600;
        }

        .nav-links a {
            color: #bdc3c7;
            text-decoration: none;
            transition: 0.3s;
        }

        .nav-links a:hover,
        .nav-links a.active {
            color: white;
        }

        .btn-logout {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            font-family: inherit;
        }

        .container {
            max-width: 1100px;
            margin: 30px auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 20px;
            align-items: start;
        }

        /* KARTU FORM & TABEL */
        .card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
        }

        .card-header {
            margin-top: 0;
            margin-bottom: 20px;
            color: #2c3e50;
            font-size: 18px;
            border-bottom: 2px solid #ecf0f1;
            padding-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
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
        }

        .btn-submit {
            background-color: #2ecc71;
            color: white;
            border: none;
            padding: 12px;
            width: 100%;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
            font-family: inherit;
            transition: 0.2s;
        }

        .btn-submit:hover {
            background-color: #27ae60;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background-color: #34495e;
            color: white;
            text-align: left;
            padding: 12px 15px;
            font-size: 14px;
        }

        td {
            padding: 12px 15px;
            border-bottom: 1px solid #ecf0f1;
            color: #2c3e50;
            font-size: 14px;
        }

        .badge-role {
            padding: 5px 10px;
            border-radius: 5px;
            font-weight: bold;
            font-size: 12px;
            color: white;
        }

        .bg-super {
            background-color: #e67e22;
        }

        .bg-admin {
            background-color: #2980b9;
        }

        .bg-operator {
            background-color: #27ae60;
        }

        .btn-delete {
            background: none;
            color: #e74c3c;
            border: none;
            cursor: pointer;
            font-weight: bold;
            font-family: inherit;
            padding: 0;
        }
    </style>
</head>

<body>

    <nav class="navbar">
        <div class="brand">
            KASIR TOKO | <span class="role-badge">{{ Auth::user()->role }}</span>
        </div>
        <div class="nav-links">
            <a href="/dashboard">Dashboard</a>
            <a href="/user" class="active">Kelola User</a>
            <a href="/barang">Data Barang</a>
            <a href="/laporan">Laporan</a>
            <a href="/kasir" style="color: #2ecc71;">Mesin Kasir</a>
            <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                @csrf
                <button type="submit" class="btn-logout">Logout</button>
            </form>
        </div>
    </nav>

    <div class="container">

        <div class="card" style="border-top: 4px solid #2ecc71;">
            <h3 class="card-header">👤 Tambah Pegawai</h3>
            <form action="/user" method="POST">
                @csrf
                <label style="font-size: 13px; color: #7f8c8d; font-weight: bold;">Nama Lengkap</label>
                <input type="text" name="name" required placeholder="Cth: Budi Santoso">

                <label style="font-size: 13px; color: #7f8c8d; font-weight: bold;">Alamat Email</label>
                <input type="email" name="email" required placeholder="budi@gmail.com">

                <label style="font-size: 13px; color: #7f8c8d; font-weight: bold;">Password (Min. 8 Karakter)</label>
                <input type="password" name="password" required placeholder="••••••••">

                <label style="font-size: 13px; color: #7f8c8d; font-weight: bold;">Pilih Jabatan (Role)</label>
                <select name="role" required>
                    <option value="Operator">Kasir (Operator)</option>
                    <option value="Admin">Admin Toko</option>
                    <option value="Super Admin">Super Admin</option>
                </select>

                <button type="submit" class="btn-submit">+ Simpan Akun Baru</button>
            </form>
        </div>

        <div class="card" style="border-top: 4px solid #34495e; overflow-x: auto;">
            <h3 class="card-header">📋 Daftar Akun Pegawai</h3>
            <table>
                <tr>
                    <th>Nama Pegawai</th>
                    <th>Email</th>
                    <th>Jabatan</th>
                    <th>Aksi</th>
                </tr>
                @foreach($users as $u)
                    <tr>
                        <td style="font-weight: bold;">{{ $u->name }}</td>
                        <td>{{ $u->email }}</td>
                        <td>
                            <span
                                class="badge-role 
                                        {{ $u->role == 'Super Admin' ? 'bg-super' : ($u->role == 'Admin' ? 'bg-admin' : 'bg-operator') }}">
                                {{ $u->role }}
                            </span>
                        </td>
                        <td>
                            <form action="/user/{{ $u->id }}" method="POST" id="form-hapus-{{ $u->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn-delete"
                                    onclick="konfirmasiHapus({{ $u->id }}, '{{ $u->name }}')">❌ Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if(session('success'))
                Swal.fire({ icon: 'success', title: 'Berhasil!', text: '{{ session("success") }}', confirmButtonColor: '#2ecc71' });
            @endif
            @if(session('error'))
                Swal.fire({ icon: 'error', title: 'Ditolak!', text: '{{ session("error") }}', confirmButtonColor: '#e74c3c' });
            @endif
        });

        function konfirmasiHapus(id, nama) {
            Swal.fire({
                title: 'Hapus Pegawai?',
                text: "Anda yakin ingin menghapus akun " + nama + "?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e74c3c',
                cancelButtonColor: '#95a5a6',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('form-hapus-' + id).submit();
                }
            })
        }
    </script>
</body>

</html>