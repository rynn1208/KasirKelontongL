<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Kasir Toko</title>
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

        /* Badge Role Dinamis */
        .role-badge {
            background-color: #e67e22;
            font-size: 12px;
            padding: 4px 12px;
            border-radius: 20px;
            font-weight: bold;
            text-transform: capitalize;
        }

        .role-badge.operator {
            background-color: #27ae60;
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
            font-size: 14px;
            font-family: inherit;
            transition: 0.2s;
        }

        .btn-logout:hover {
            background-color: #c0392b;
        }

        /* KONTINER UTAMA */
        .container {
            max-width: 1100px;
            margin: 30px auto;
            padding: 0 20px;
        }

        /* KARTU SELAMAT DATANG */
        .welcome-card {
            background: white;
            padding: 40px 20px;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
            border-bottom: 4px solid #e67e22;
            margin-bottom: 25px;
        }

        .welcome-card h1 {
            margin: 0 0 10px 0;
            font-size: 26px;
            color: #2c3e50;
        }

        .welcome-card p {
            margin: 0;
            color: #7f8c8d;
            font-size: 15px;
        }

        /* ALERT MERAH */
        .alert-red {
            background-color: #fdeaea;
            color: #c0392b;
            border: 1px solid #fad4d4;
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 25px;
            font-size: 14px;
        }

        /* GRID STATISTIK */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
        }

        .stat-card.green {
            border-left: 5px solid #2ecc71;
            background-color: #f8fdfa;
        }

        .stat-card.green .title {
            color: #7f8c8d;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.5px;
        }

        .stat-card.green .value {
            color: #2ecc71;
            font-size: 26px;
            font-weight: 800;
            margin-top: 8px;
        }

        .stat-card.orange {
            border-left: 5px solid #e67e22;
        }

        .stat-card.orange .title {
            color: #7f8c8d;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.5px;
        }

        .stat-card.orange .value {
            color: #2c3e50;
            font-size: 26px;
            font-weight: 800;
            margin-top: 8px;
        }

        .stat-card.blue {
            border-left: 5px solid #34495e;
        }

        .stat-card.blue .title {
            color: #7f8c8d;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.5px;
        }

        .stat-card.blue .value {
            color: #2c3e50;
            font-size: 26px;
            font-weight: 800;
            margin-top: 8px;
        }

        /* TABEL PERINGATAN */
        .table-card {
            background: white;
            padding: 0;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
            border-top: 4px solid #e74c3c;
            overflow: hidden;
        }

        .table-header {
            padding: 20px;
            border-bottom: 1px solid #ecf0f1;
        }

        .table-header h3 {
            margin: 0;
            color: #e74c3c;
            font-size: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background-color: #34495e;
            color: white;
            text-align: left;
            padding: 15px 20px;
            font-size: 14px;
        }

        td {
            padding: 15px 20px;
            border-bottom: 1px solid #ecf0f1;
            color: #2c3e50;
            font-size: 14px;
            font-weight: 600;
        }

        .badge-red {
            background-color: #ff0000;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-weight: bold;
            font-size: 12px;
        }
    </style>
</head>

<body>

    <nav class="navbar">
        <div class="brand">
            KASIR TOKO |
            <span class="role-badge {{ Auth::user()->role == 'Operator' ? 'operator' : '' }}">
                {{ Auth::user()->role }}
            </span>
        </div>
        <div class="nav-links">
            <a href="/dashboard" class="active">Dashboard</a>

            @if(Auth::user()->role == 'Super Admin')
                <a href="/user">Kelola User</a>
            @endif

            @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'Super Admin')
                <a href="/barang">Data Barang</a>
                <a href="/laporan">Laporan</a>
            @endif

            <a href="/kasir" style="color: #2ecc71;">Mesin Kasir</a>

            <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                @csrf
                <button type="submit" class="btn-logout">Logout</button>
            </form>
        </div>
    </nav>

    <div class="container">

        <div class="welcome-card">
            <h1>Selamat Datang, {{ Auth::user()->name }}!</h1>
            <p>Anda login sebagai <strong>{{ Auth::user()->role }}</strong>.</p>
        </div>

        @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'Super Admin')

            @if(count($stok_menipis) > 0)
                <div class="alert-red">
                    ⚠️ <strong>PERINGATAN STOK MENIPIS:</strong> Ada {{ count($stok_menipis) }} barang yang stoknya 5 atau
                    kurang! Silakan cek tabel di bawah.
                </div>
            @endif

            <div class="stats-grid">
                <div class="stat-card green">
                    <div class="title">💰 TOTAL PENDAPATAN</div>
                    <div class="value">Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</div>
                </div>
                <div class="stat-card orange">
                    <div class="title">🛒 TOTAL TRANSAKSI</div>
                    <div class="value">{{ $jumlah_transaksi }} Struk</div>
                </div>
                <div class="stat-card blue">
                    <div class="title">📦 TOTAL MACAM BARANG</div>
                    <div class="value">{{ $total_barang }} Item</div>
                </div>
            </div>

            @if(count($stok_menipis) > 0)
                <div class="table-card">
                    <div class="table-header">
                        <h3>🚨 Daftar Barang Perlu Restok (Stok ≤ 5)</h3>
                    </div>
                    <table>
                        <tr>
                            <th>Kategori</th>
                            <th>Nama Barang</th>
                            <th>Sisa Stok</th>
                        </tr>
                        @foreach($stok_menipis as $item)
                            <tr>
                                <td style="font-weight: normal;">{{ $item->kategori }}</td>
                                <td>{{ $item->nama_barang }}</td>
                                <td><span class="badge-red">{{ $item->stok }}</span></td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            @endif

        @else
            <div style="text-align: center; margin-top: 40px;">
                <p style="color: #7f8c8d;">Silakan klik menu <strong>Mesin Kasir</strong> di atas untuk mulai melayani
                    pelanggan.</p>
            </div>
        @endif

    </div>

</body>

</html>