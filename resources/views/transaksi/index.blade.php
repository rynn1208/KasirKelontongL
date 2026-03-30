<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mesin Kasir - Kasir Toko</title>
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
            margin-bottom: 20px;
        }

        .navbar .brand {
            font-size: 18px;
            font-weight: 800;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .role-badge {
            background-color: #27ae60;
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
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: 6fr 4fr;
            gap: 20px;
            align-items: start;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
        }

        .card-header {
            margin-top: 0;
            margin-bottom: 15px;
            color: #2c3e50;
            font-size: 18px;
            border-bottom: 2px solid #ecf0f1;
            padding-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background-color: #f8f9fa;
            color: #7f8c8d;
            text-align: left;
            padding: 12px;
            font-size: 13px;
            text-transform: uppercase;
            border-bottom: 2px solid #ecf0f1;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #ecf0f1;
            color: #2c3e50;
            font-size: 14px;
            font-weight: 600;
        }

        .btn-add {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            font-family: inherit;
        }

        input[type="number"] {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 60px;
            font-family: inherit;
            text-align: center;
        }

        /* Keranjang Area */
        .cart-box {
            border-top: 4px solid #2ecc71;
        }

        .total-text {
            text-align: right;
            color: #2ecc71;
            font-size: 24px;
            font-weight: 800;
            margin-top: 20px;
            padding-top: 15px;
            border-top: 2px dashed #ecf0f1;
        }

        .btn-bayar {
            background-color: #2ecc71;
            color: white;
            border: none;
            padding: 15px;
            width: 100%;
            border-radius: 8px;
            font-weight: 800;
            cursor: pointer;
            font-size: 16px;
            font-family: inherit;
            transition: 0.2s;
        }

        .btn-bayar:hover {
            background-color: #27ae60;
        }

        .btn-kosong {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 15px;
            width: 100%;
            border-radius: 8px;
            font-weight: 800;
            cursor: pointer;
            font-family: inherit;
        }
    </style>
</head>

<body>

    <nav class="navbar">
        <div class="brand">KASIR TOKO | <span class="role-badge"
                style="background-color: {{ Auth::user()->role == 'Operator' ? '#27ae60' : '#e67e22' }}">{{ Auth::user()->role }}</span>
        </div>
        <div class="nav-links">
            <a href="/dashboard">Dashboard</a>
            @if(Auth::user()->role == 'Super Admin') <a href="/user">Kelola User</a> @endif
            @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'Super Admin')
                <a href="/barang">Data Barang</a>
                <a href="/laporan">Laporan</a>
            @endif
            <a href="/kasir" class="active"
                style="color: #2ecc71; border-bottom: 2px solid #2ecc71; padding-bottom: 5px;">Mesin Kasir</a>
            <form method="POST" action="{{ route('logout') }}" style="margin: 0;"><button
                    class="btn-logout">Logout</button></form>
        </div>
    </nav>

    <div class="container">

        <div class="card" style="border-top: 4px solid #34495e;">
            <h3 class="card-header">🛒 Etalase Produk</h3>
            <div style="overflow-y: auto; max-height: 600px;">
                <table>
                    <tr>
                        <th>Produk & Stok</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                    @foreach($barangs as $row)
                        <tr>
                            <td>
                                <div style="font-weight: 800;">{{ $row->nama_barang }}</div>
                                <div style="font-size: 12px; color: #7f8c8d; margin-top: 4px;">Sisa Stok: {{ $row->stok }}
                                </div>
                            </td>
                            <td style="color: #2ecc71; font-weight: 800;">Rp {{ number_format($row->harga, 0, ',', '.') }}
                            </td>
                            <td>
                                <form action="/kasir/tambah" method="POST" style="display: flex; gap: 8px;">
                                    @csrf
                                    <input type="hidden" name="id_barang" value="{{ $row->id_barang }}">
                                    <input type="number" name="jumlah" value="1" min="1" max="{{ $row->stok }}">
                                    <button type="submit" class="btn-add">+ Tambah</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>

        <div class="card cart-box">
            <h3 class="card-header">🛍️ Keranjang Belanja</h3>
            @if(count($keranjang) > 0)
                <table>
                    <tr>
                        <th>Item</th>
                        <th style="text-align: right;">Subtotal</th>
                    </tr>
                    @foreach($keranjang as $id => $item)
                        <tr>
                            <td>
                                <div style="font-weight: 800;">{{ $item['nama_barang'] }}</div>
                                <div style="font-size: 12px; color: #7f8c8d;">{{ $item['jumlah'] }} x Rp
                                    {{ number_format($item['harga'], 0, ',', '.') }}</div>
                            </td>
                            <td style="text-align: right; font-weight: 800;">Rp
                                {{ number_format($item['harga'] * $item['jumlah'], 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </table>

                <div class="total-text">Total: Rp {{ number_format($total_belanja, 0, ',', '.') }}</div>

                <div style="display: flex; gap: 10px; margin-top: 20px;">
                    <form action="/kasir/reset" method="POST" style="flex: 1;">
                        @csrf <button type="submit" class="btn-kosong">Kosongkan</button>
                    </form>
                    <form action="/kasir/bayar" method="POST" style="flex: 2;">
                        @csrf <button type="submit" class="btn-bayar">💳 Proses Bayar</button>
                    </form>
                </div>
            @else
                <div style="text-align: center; padding: 50px 0; color: #bdc3c7;">
                    <div style="font-size: 40px; margin-bottom: 10px;">🛒</div>
                    <p style="font-weight: 600;">Keranjang masih kosong.</p>
                </div>
            @endif
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if(session('success'))
                Swal.mixin({ toast: true, position: 'top-end', showConfirmButton: false, timer: 1500 }).fire({ icon: 'success', title: '{{ session("success") }}' });
            @endif
            @if(session('error'))
                Swal.fire({ title: 'Oops!', text: '{{ session("error") }}', icon: 'error', confirmButtonColor: '#e74c3c' });
            @endif
            @if(session('success_bayar'))
                Swal.fire({ title: 'Pembayaran Sukses!', text: '{{ session("success_bayar") }}', icon: 'success', confirmButtonColor: '#2ecc71', confirmButtonText: 'Lanjut Transaksi Baru' });
            @endif
        });
    </script>
</body>

</html>