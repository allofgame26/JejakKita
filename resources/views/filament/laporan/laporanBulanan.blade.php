<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Keuangan</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        .table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .table th, .table td { border: 1px solid #ddd; padding: 8px; }
        .table th { background-color: #f2f2f2; text-align: left; }
        h1, h2 { text-align: center; }
        .page-break { page-break-after: always; }
    </style>
</head>
<body>
    <h1>Laporan Transparansi Dana - SDIT AL Asror</h1>
    
    {{-- Menampilkan periode laporan secara dinamis --}}
    @if($detail)
        <p style="text-align: center;"><strong>Periode:</strong> {{ $startDate->format('d F Y') }} - {{ $reportDate->format('d F Y') }}</p>
    @else
        <p style="text-align: center;"><strong>Periode:</strong> {{ $reportDate->format('F Y') }}</p>
    @endif

    <h2>Ringkasan Keuangan</h2>
    <table class="table">
        <tr>
            <td>Total Pemasukan Donasi</td>
            <td><strong>Rp {{ number_format($donasi, 0, ',', '.') }}</strong></td>
        </tr>
        <tr>
            <td>Total Pengeluaran</td>
            <td><strong>Rp {{ number_format($totalpengeluaran, 0, ',', '.') }}</strong></td>
        </tr>
        <tr>
            <th>Saldo Akhir</th>
            <th><strong>Rp {{ number_format($donasi - $totalpengeluaran, 0, ',', '.') }}</strong></th>
        </tr>
    </table>

    {{-- Hanya tampilkan tabel detail jika ini adalah laporan realtime atau rentang waktu --}}
    @if($detail && $transaksi->isNotEmpty())
        <div class="page-break"></div>
        <h2>Detail Pemasukan Donasi</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Donatur</th>
                    <th>Deskripsi</th>
                    <th>Metode Pembayaran</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transaksi as $item)
                <tr>
                    <td>{{ $item->created_at->format('d M Y') }}</td>
                    <td>{{ $item->user->datadiri->nama_lengkap ?? $item->user->name }}</td>
                    <td>{{ $item->deskripsi_donasi }}</td>
                    <td>{{ $item->pembayaran->nama_pembayaran }}</td>
                    <td>Rp {{ number_format($item->jumlah_donasi, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    
    @if($pengeluaran->isNotEmpty())
        <div class="page-break"></div>
        <h2>Detail Pengeluaran</h2>
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
                @foreach($pengeluaran as $expense)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($expense->tanggal)->format('d-m-Y') }}</td>
                    <td>{{ $expense->kategori }}</td>
                    <td>{{ $expense->deskripsi }}</td>
                    <td>Rp {{ number_format($expense->jumlah, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>
</html>