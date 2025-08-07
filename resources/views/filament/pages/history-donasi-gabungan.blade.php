{{-- filepath: resources/views/filament/pages/history-donasi-gabungan.blade.php --}}
<x-filament::page>
    <h2 class="text-lg font-bold mb-4">History Donasi Gabungan</h2>
    <table class="table-auto w-full">
        <thead>
            <tr>
                <th>No</th>
                <th>Jenis</th>
                <th>Nama Program/Barang</th>
                <th>Nama Donatur</th>
                <th>Jumlah Donasi</th>
                <th>Status</th>
                <th>Pesan</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($history as $i => $item)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ ucfirst($item->tipe) }}</td>
                <td>
                    {{ $item->tipe == 'program'
                        ? ($item->program->nama_pembangunan ?? '-')
                        : ($item->barang->nama_barang ?? '-') }}
                </td>
                <td>{{ $item->user->name ?? '-' }}</td>
                <td>
                    @if($item->tipe == 'program')
                        Rp{{ number_format($item->jumlah_donasi, 0, ',', '.') }}
                    @else
                        -
                    @endif
                </td>
                <td>{{ $item->status_pembayaran }}</td>
                <td>{{ $item->pesan_donatur }}</td>
                <td>{{ $item->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</x-filament::page>