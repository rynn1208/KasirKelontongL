<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang - Kasir Toko</title>
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
        }

        /* KARTU FORM & TABEL */
        .card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
            margin-bottom: 30px;
            border-top: 4px solid #3498db;
        }

        .card-header {
            margin-top: 0;
            margin-bottom: 20px;
            color: #2c3e50;
            font-size: 18px;
            border-bottom: 2px solid #ecf0f1;
            padding-bottom: 10px;
        }

        /* FORM INPUT */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        input,
        select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            box-sizing: border-box;
            font-family: inherit;
        }

        .btn-submit {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 12px;
            width: 100%;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
            font-family: inherit;
            grid-column: span 2;
        }

        /* TABEL */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background-color: #f8f9fa;
            color: #7f8c8d;
            text-align: left;
            padding: 15px;
            font-size: 13px;
            text-transform: uppercase;
            border-bottom: 2px solid #ecf0f1;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #ecf0f1;
            color: #2c3e50;
            font-size: 14px;
            font-weight: 600;
        }

        .badge-kategori {
            background-color: #ecf0f1;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 12px;
            color: #7f8c8d;
        }

        .text-harga {
            color: #2ecc71;
            font-weight: 800;
            font-size: 15px;
        }
    </style>
</head>

<body>

    <nav class="navbar">
        <div class="brand">KASIR TOKO | <span class="role-badge">{{ Auth::user()->role }}</span></div>
        <div class="nav-links">
            <a href="/dashboard">Dashboard</a>
            @if(Auth::user()->role == 'Super Admin') <a href="/user">Kelola User</a> @endif
            <a href="/barang" class="active">Data Barang</a>
            <a href="/laporan">Laporan</a>
            <a href="/kasir" style="color: #2ecc71;">Mesin Kasir</a>
            <form method="POST" action="{{ route('logout') }}" style="margin: 0;"><button
                    class="btn-logout">Logout</button></form>
        </div>
    </nav>

    <div class="container">
        <div class="card">
            <h3 class="card-header">📦 Tambah Produk Baru</h3>
            <form method="POST" action="/barang" class="form-grid">
                @csrf
                <input type="text" name="nama_barang" placeholder="Nama Produk" required>
                <select name="kategori" required>
                    <option value="">-- Pilih Kategori --</option>
                    <option value="Sayur">Sayur</option>
                    <option value="Buah">Buah</option>
                    <option value="Bumbu">Bumbu Dapur</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
                <input type="number" name="harga" placeholder="Harga Jual (Rp)" min="0" required>
                <input type="number" name="stok" placeholder="Jumlah Stok" min="0" required>
                <input type="number" name="diskon" placeholder="Diskon (%)" value="0" min="0" max="100">
                <button type="submit" class="btn-submit">+ Simpan Produk</button>
            </form>
        </div>

        <div class="card" style="border-top-color: #2c3e50;">
            <h3 class="card-header">📋 Daftar Produk Etalase</h3>
            <div style="overflow-x: auto;">
                <table>
                    <tr>
                        <th>Kategori</th>
                        <th>Nama Produk</th>
                        <th>Harga Jual</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                    @foreach($barangs as $row)
                        <tr>
                            <td><span class="badge-kategori">{{ $row->kategori }}</span></td>
                            <td>{{ $row->nama_barang }}</td>
                            <td class="text-harga">Rp {{ number_format($row->harga, 0, ',', '.') }}</td>
                            <td>{{ $row->stok }}</td>
                            <td>
                                <div style="display: flex; gap: 15px; align-items: center;">
                                    <a href="/barang/{{ $row->id_barang }}/edit"
                                        style="color: #3498db; text-decoration: none; font-weight: bold;">✏️ Edit</a>
                                    <form action="/barang/{{ $row->id_barang }}" method="POST" style="margin: 0;"
                                        id="form-hapus-{{ $row->id_barang }}">
                                        @csrf @method('DELETE')
                                        <button type="button" onclick="konfirmasiHapus({{ $row->id_barang }})"
                                            style="background: none; color: #e74c3c; border: none; font-weight: bold; cursor: pointer; font-family: inherit; font-size: 14px; padding: 0;">❌
                                            Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({ title: 'Berhasil!', text: '{{ session("success") }}', icon: 'success', confirmButtonColor: '#2ecc71' });
            });
        </script>
    @endif
    <script>
        function konfirmasiHapus(id) {
            Swal.fire({
                title: 'Hapus Produk?', icon: 'warning', showCancelButton: true, confirmButtonColor: '#e74c3c', confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) document.getElementById('form-hapus-' + id).submit();
            })
        }
    </script>
</body>

</html>