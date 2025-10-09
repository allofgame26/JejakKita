<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Keuangan</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        .table { width: 100%; border-collapse: collapse; }
        .table th, .table td { border: 1px solid #ddd; padding: 8px; }
        .table th { background-color: #f2f2f2; text-align: left; }
        h1 { text-align: center; }
    </style>
</head>
<body>
    <h1>Laporan Transparansi Dana - SDIT AL Asror</h1>
    <p><strong>Periode:</strong> {{ $reportDate->format('F Y') }}</p>

    <h2>Pemasukan</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Keterangan</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Total Donasi Diterima</td>
                <td>Rp {{ number_format($donasi, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <h2>Pengeluaran</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Kategori</th>
                <th>Deskripsi</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pengeluaran as $expense)
            <tr>
                <td>{{ \Carbon\Carbon::parse($expense->tanggal)->format('d-m-Y') }}</td>
                <td>{{ $expense->kategori }}</td>
                <td>{{ $expense->deskripsi }}</td>
                <td>Rp {{ number_format($expense->jumlah, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4">Tidak ada pengeluaran bulan ini.</td>
            </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3" style="text-align:right;">Total Pengeluaran</th>
                <th>Rp {{ number_format($totalpengeluaran, 0, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>
</body>
</html>