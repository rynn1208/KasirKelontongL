<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi - Kasir Toko</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
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
            max-width: 900px;
            margin: 30px auto;
            padding: 0 20px;
        }

        /* KARTU TABEL */
        .card {
            background: white;
            padding: 0;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
            border-top: 4px solid #34495e;
            overflow: hidden;
        }

        .card-header {
            padding: 20px;
            border-bottom: 1px solid #ecf0f1;
            background-color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-header h3 {
            margin: 0;
            color: #2c3e50;
            font-size: 18px;
        }

        /* Tombol Cetak */
        .btn-print {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            font-family: inherit;
            transition: 0.2s;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .btn-print:hover {
            background-color: #2980b9;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background-color: #f8f9fa;
            color: #7f8c8d;
            text-align: left;
            padding: 15px 20px;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #ecf0f1;
        }

        td {
            padding: 15px 20px;
            border-bottom: 1px solid #ecf0f1;
            color: #2c3e50;
            font-size: 15px;
            font-weight: 600;
        }

        /* ID Struk */
        .struk-id {
            color: #3498db;
        }

        /* Total Uang */
        .text-uang {
            color: #2ecc71;
            font-weight: 800;
            font-size: 16px;
        }

        /* Sembunyikan elemen saat diprint */
        @media print {

            .navbar,
            .btn-print,
            .btn-logout {
                display: none !important;
            }

            body {
                background-color: white;
                padding: 0;
            }

            .container {
                margin: 0;
                max-width: 100%;
            }

            .card {
                box-shadow: none;
                border: none;
            }
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
            @if(Auth::user()->role == 'Super Admin')
                <a href="/user">Kelola User</a>
            @endif
            <a href="/barang">Data Barang</a>
            <a href="/laporan" class="active">Laporan</a>
            <a href="/kasir" style="color: #2ecc71;">Mesin Kasir</a>
            <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                @csrf
                <button type="submit" class="btn-logout">Logout</button>
            </form>
        </div>
    </nav>

    <div class="container">

        <div class="card">
            <div class="card-header">
                <h3>📈 Riwayat Transaksi Penjualan</h3>
                <button class="btn-print" onclick="window.print()">🖨️ Cetak Laporan</button>
            </div>
            <div style="overflow-x: auto;">
                <table>
                    <tr>
                        <th>ID Transaksi</th>
                        <th>Tanggal & Waktu</th>
                        <th>Total Belanja</th>
                    </tr>
                    @foreach($transaksis as $t)
                        <tr>
                            <td class="struk-id">#TRX-{{ str_pad($t->id_transaksi, 5, '0', STR_PAD_LEFT) }}</td>
                            <td>{{ date('d M Y - H:i', strtotime($t->tanggal)) }} WIB</td>
                            <td class="text-uang">Rp {{ number_format($t->total_bayar, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach

                    @if(count($transaksis) == 0)
                        <tr>
                            <td colspan="3" style="text-align: center; color: #7f8c8d; padding: 30px;">Belum ada transaksi
                                yang dilakukan.</td>
                        </tr>
                    @endif
                </table>
            </div>
        </div>

    </div>

</body>

</html>