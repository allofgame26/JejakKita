<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kwitansi Donasi Barang</title>
    <style>
        /* Gaya CSS untuk PDF, dibuat sederhana agar kompatibel */
        body {
            font-family: 'Helvetica', DejaVu Sans, sans-serif; /* DejaVu Sans untuk karakter unicode */
            font-size: 14px;
            color: #333;
        }
        .container {
            width: 100%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #eee;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            color: #000;
        }
        .header p {
            margin: 5px 0 0;
            font-size: 14px;
            color: #555;
        }
        .details-table {
            width: 100%;
            margin-bottom: 25px;
        }
        .details-table td {
            padding: 5px 0;
        }
        .details-table td:first-child {
            font-weight: bold;
            width: 160px; /* Lebar kolom label */
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .items-table th, .items-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        .items-table thead {
            background-color: #f9f9f9;
        }
        .items-table th {
            font-weight: bold;
        }
        .text-right {
            text-align: right;
        }
        .total-section {
            margin-top: 20px;
            text-align: right;
        }
        .total-section strong {
            font-size: 16px;
        }
        .footer {
            text-align: center;
            margin-top: 40px;
            font-size: 12px;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>KWITANSI DONASI</h1>
            <p>JejakKita Foundation</p>
        </div>

        <table class="details-table">
            <tr>
                <td>No. Transaksi:</td>
                <td>#{{ $transaksi->id }}</td>
            </tr>
            <tr>
                <td>Tanggal:</td>
                <td>{{ $transaksi->created_at}}</td>
            </tr>
            <tr>
                <td>Nama Lengkap:</td>
                <td>{{ $transaksi->user->datadiri->nama_lengkap ?? '-' }}</td>
            </tr>
            <tr>
                <td>Diterima Dari:</td>
                <td>{{ $transaksi->user->name ?? '-' }}</td>
            </tr>
            <tr>
                <td>Status Pembayaran:</td>
                <td><strong>LUNAS / TERVERIFIKASI</strong></td>
            </tr>
        </table>

        {{-- ========================================================== --}}
        {{-- === INI ADALAH BAGIAN TABEL BARANG YANG ANDA INGINKAN   === --}}
        {{-- ========================================================== --}}
        <table class="items-table">
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Program Terkait</th>
                    <th class="text-right">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                {{-- INI ADALAH BAGIAN KUNCINYA --}}
                {{-- '$transaksi->kebutuhanBarang' berisi SEMUA barang yang terhubung dengan transaksi ini --}}
                @forelse ($transaksi->kebutuhan as $item)
                    {{-- Loop ini akan berjalan untuk setiap barang yang ditemukan --}}
                    <tr>
                        <td>
                            {{ $item->barang->nama_barang ?? 'N/A' }}
                        </td>
                        <td>
                            {{ $item->program->nama_pembangunan ?? 'N/A' }}
                        </td>
                        <td class="text-right">
                            {{ $item->jumlah_barang ?? 'N/A' }} {{ $item->barang->nama_satuan ?? 'Unit' }}
                        </td>
                    </tr>
                @empty
                    {{-- Bagian ini hanya akan tampil jika tidak ada barang sama sekali --}}
                    <tr>
                        <td colspan="3" style="text-align: center;">Tidak ada detail barang untuk donasi ini.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="total-section">
            <p>Total Nominal Donasi (Estimasi): <strong>Rp {{ number_format($transaksi->jumlah_donasi, 0, ',', '.') }}</strong></p>
        </div>

        <div class="footer">
            Terima kasih atas donasi dan kebaikan Anda. Semoga menjadi berkah.
        </div>
    </div>
</body>
</html>