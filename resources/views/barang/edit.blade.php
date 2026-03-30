<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Produk - Kasir Kelontong</title>
    <style>
        :root {
            --primary: #2d6a4f;
            --admin: #047857;
            --bg-color: #f4f9f4;
            --card-bg: #ffffff;
            --text-dark: #1f2937;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: var(--bg-color);
            color: var(--text-dark);
            padding: 20px;
        }

        .form-box {
            background: var(--card-bg);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
            border-top: 4px solid var(--admin);
        }

        input,
        select,
        button {
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
            box-sizing: border-box;
        }

        button {
            background-color: var(--primary);
            color: white;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }

        .btn-batal {
            background-color: #95a5a6;
            text-decoration: none;
            color: white;
            padding: 10px;
            display: inline-block;
            text-align: center;
            border-radius: 5px;
            width: 100%;
            box-sizing: border-box;
        }
    </style>
</head>

<body>

    <div class="form-box">
        <h3 style="margin-top:0;">✏️ Edit Produk: {{ $barang->nama_barang }}</h3>

        <form method="POST" action="/barang/{{ $barang->id_barang }}">
            @csrf
            @method('PUT') <label>Nama Produk:</label>
            <input type="text" name="nama_barang" value="{{ $barang->nama_barang }}" required>

            <label>Kategori:</label>
            <select name="kategori" required>
                <option value="Sayur" {{ $barang->kategori == 'Sayur' ? 'selected' : '' }}>Sayur</option>
                <option value="Buah" {{ $barang->kategori == 'Buah' ? 'selected' : '' }}>Buah</option>
                <option value="Bumbu" {{ $barang->kategori == 'Bumbu' ? 'selected' : '' }}>Bumbu Dapur</option>
                <option value="Lainnya" {{ $barang->kategori == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
            </select>

            <label>Harga Jual (Rp):</label>
            <input type="number" name="harga" value="{{ $barang->harga }}" min="0" required>

            <label>Stok:</label>
            <input type="number" name="stok" value="{{ $barang->stok }}" min="0" required>

            <label>Diskon (%):</label>
            <input type="number" name="diskon" value="{{ $barang->diskon_persen }}" min="0" max="100">

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-top: 15px;">
                <a href="/barang" class="btn-batal">Batal</a>
                <button type="submit" style="margin: 0;">Simpan Perubahan</button>
            </div>
        </form>
    </div>

</body>

</html>