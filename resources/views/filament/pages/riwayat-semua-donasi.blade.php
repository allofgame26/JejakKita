<x-filament-panels::page>
    <div class="fi-ta-ctn overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">
        <table class="fi-ta-table w-full table-auto divide-y divide-gray-200 text-start dark:divide-white/5">
            <thead class="bg-gray-50 dark:bg-gray-800">
                <tr class="text-sm">
                    <th class="fi-ta-header-cell px-3 py-3.5 sm:px-6">Tanggal</th>
                    <th class="fi-ta-header-cell px-3 py-3.5 sm:px-6">Nama Donatur</th>
                    <th class="fi-ta-header-cell px-3 py-3.5 sm:px-6">Jenis Donasi</th>
                    <th class="fi-ta-header-cell px-3 py-3.5 sm:px-6">Detail</th>
                    <th class="fi-ta-header-cell px-3 py-3.5 sm:px-6 text-right">Jumlah (Rp)</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 whitespace-nowrap dark:divide-white/5">
                {{-- Lakukan perulangan pada variabel $semuaDonasi yang sudah kita siapkan --}}
                @forelse ($semuaDonasi as $donasi)
                    <tr class="fi-ta-row text-sm">
                        <td class="fi-ta-cell p-0 first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3">
                           <div class="px-3 py-4">{{ $donasi['tanggal']->format('d M Y H:i') }}</div>
                        </td>
                        <td class="fi-ta-cell p-0 first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3">
                           <div class="px-3 py-4">{{ $donasi['nama_donatur'] }}</div>
                        </td>
                         <td class="fi-ta-cell p-0 first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3">
                           <div class="px-3 py-4">
                                @if($donasi['jenis_donasi'] === 'Program')
                                    <span class="fi-badge fi-color-success text-xs font-medium inline-flex items-center gap-x-1 rounded-md px-2 py-1 bg-success-100 text-success-700 dark:bg-success-500/10 dark:text-success-400">
                                        {{ $donasi['jenis_donasi'] }}
                                    </span>
                                @else
                                    <span class="fi-badge fi-color-primary text-xs font-medium inline-flex items-center gap-x-1 rounded-md px-2 py-1 bg-primary-100 text-primary-700 dark:bg-primary-500/10 dark:text-primary-400">
                                        {{ $donasi['jenis_donasi'] }}
                                    </span>
                                @endif
                           </div>
                        </td>
                        <td class="fi-ta-cell p-0 first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3">
                           <div class="px-3 py-4">{{ $donasi['status_pembayaran'] }}</div>
                        </td>
                        <td class="fi-ta-cell p-0 first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3">
                           <div class="px-3 py-4 text-right">{{ number_format($donasi['jumlah'], 0, ',', '.') }}</div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center p-6">
                            Tidak ada riwayat donasi yang ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-filament-panels::page>
