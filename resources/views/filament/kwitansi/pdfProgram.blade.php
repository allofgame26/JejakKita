<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kwitansi Donasi</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; font-size: 14px; color: #333; }
        .container { width: 100%; margin: 0 auto; padding: 20px; border: 1px solid #eee; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h1 { margin: 0; font-size: 24px; color: #000; }
        .header p { margin: 0; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        td { padding: 8px; }
        .details-table td:first-child { font-weight: bold; width: 150px; }
        .footer { text-align: center; margin-top: 40px; font-size: 12px; color: #777; }
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
                <td>{{ $transaksi->created_at }}</td>
            </tr>
            <tr>
                <td>Diterima Dari:</td>
                <td>{{ $transaksi->user->name }}</td>
            </tr>
            <tr>
                <td>E - Mail:</td>
                <td>{{ $transaksi->user->email }}</td>
            </tr>
            <tr>
                <td>Untuk Program:</td>
                <td>{{ $transaksi->program->nama_pembangunan }}</td>
            </tr>
            <tr>
                <td>Jumlah Donasi:</td>
                <td><strong>Rp {{ number_format($transaksi->jumlah_donasi, 0, ',', '.') }}</strong></td>
            </tr>
            <tr>
                <td>Status:</td>
                <td>LUNAS</td>
            </tr>
        </table>

        <div class="footer">
            Terima kasih atas donasi Anda.
        </div>
    </div>
</body>
</html>