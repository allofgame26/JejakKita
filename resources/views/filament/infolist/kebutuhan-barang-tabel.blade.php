@php
    // Mengambil record utama (transaksi spesifik)
    $record = $getRecord();
    // Mengambil semua item kebutuhan yang terhubung melalui relasi yang benar
    $kebutuhanItems = $record->kebutuhan;
@endphp

<div>
    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
        Detail Barang yang Didonasikan
    </h3>

    <div class="border border-gray-300 dark:border-gray-700 rounded-lg overflow-hidden">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="bg-gray-50 dark:bg-gray-700 text-xs text-gray-700 uppercase dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-4 py-3">Nama Barang</th>
                    <th scope="col" class="px-4 py-3">Program Terkait</th>
                    <th scope="col" class="px-4 py-3 text-center">Jumlah Didonasikan</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($kebutuhanItems as $item)
                    <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-4 py-3 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            {{-- Akses nama barang melalui relasi 'barang' di model TKebutuhanBarangProgram --}}
                            {{ $item->barang->nama_barang ?? 'N/A' }}
                        </td>
                        <td class="px-4 py-3">
                            {{-- Akses nama program melalui relasi 'program' di model TKebutuhanBarangProgram --}}
                            {{ $item->program->nama_pembangunan ?? 'N/A' }}
                        </td>
                        <td class="px-4 py-3 text-center">
                        {{ $item->jumlah_barang ?? 'N/A'}}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center px-4 py-4">
                            Tidak ada detail barang untuk donasi ini.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
