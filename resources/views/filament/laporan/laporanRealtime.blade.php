<!DOCTYPE html>
<html>
<head>
    <title>History Transaksi</title>
    <style>
        body {
            font-family: sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h1>Laporan Transaksi Donasi</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Kode Transaksi</th>
                <th>Nama Donatur</th>
                <th>Deskripsi</th>
                <th>Jumlah</th>
                <th>Metode Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transaksi as $item)
            <tr>
                <td>{{ $item->created_at->format('d M Y') }}</td>
                <td>{{ $item->kode_transaksi }}</td>
                <td>{{ $item->user->datadiri->nama_lengkap ?? $item->user->name }}</td>
                <td>{{ $item->deskripsi }}</td>
                <td>Rp. {{ number_format($item->jumlah_donasi, 0, ',', '.') }}</td>
                <td>{{ $item->metodePembayaran->nama_pembayaran }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6">Tidak ada Transaksi bulan ini.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
