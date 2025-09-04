@php
    $donasi = $record;
    $pembayaran = $donasi->pembayaran;
@endphp

<div
    class="p-4 md:p-6 bg-white dark:bg-gray-800 rounded-xl shadow border border-blue-200 dark:border-gray-700 max-w-2xl mx-auto text-gray-900 dark:text-gray-100">
    <div class="mb-3 flex items-center gap-2">
        <svg class="w-6 h-6 text-blue-700 dark:text-blue-400" fill="none" stroke="currentColor" stroke-width="2"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3zm0 0V4m0 7v7" />
        </svg>
        <span class="font-extrabold text-blue-900 dark:text-blue-300 text-lg md:text-xl tracking-wide">Detail
            Donasi</span>
    </div>
    <div class="overflow-x-auto">
        <table
            class="w-full bg-white dark:bg-gray-900 rounded-lg border border-blue-100 dark:border-gray-700 shadow text-sm md:text-base">
            <tbody>
                <tr class="border-b border-gray-200 dark:border-gray-700">
                    <td class="py-2 px-3 font-semibold text-blue-800 dark:text-blue-300 w-1/3">Nama Donatur</td>
                    <td class="py-2 px-3 font-medium">{{ $donasi->nama_lengkap_donatur }}</td>
                </tr>
                <tr class="border-b border-gray-200 dark:border-gray-700">
                    <td class="py-2 px-3 font-semibold text-blue-800 dark:text-blue-300">Nominal Donasi</td>
                    <td class="py-2 px-3">
                        <span
                            class="inline-block bg-green-100 dark:bg-green-800 text-green-800 dark:text-green-100 font-bold px-3 py-1 rounded shadow">
                            Rp {{ number_format($donasi->jumlah_donasi, 0, ',', '.') }}
                        </span>
                    </td>
                </tr>
                <tr class="border-b border-gray-200 dark:border-gray-700">
                    <td class="py-2 px-3 font-semibold text-blue-800 dark:text-blue-300">Tanggal Donasi</td>
                    <td class="py-2 px-3">
                        <span
                            class="inline-block bg-blue-100 dark:bg-blue-800 text-blue-900 dark:text-blue-100 px-2 py-1 rounded">
                            {{ $donasi->created_at->format('d M Y H:i') }}
                        </span>
                    </td>
                </tr>
                <tr class="border-b border-gray-200 dark:border-gray-700">
                    <td class="py-2 px-3 font-semibold text-blue-800 dark:text-blue-300">Pesan Donatur</td>
                    <td class="py-2 px-3 italic">{{ $donasi->pesan_donatur ?: '-' }}</td>
                </tr>
                <tr class="border-b border-gray-200 dark:border-gray-700">
                    <td class="py-2 px-3 font-semibold text-blue-800 dark:text-blue-300">Metode Pembayaran</td>
                    <td class="py-2 px-3">
                        <span
                            class="inline-block bg-blue-200 dark:bg-blue-700 text-blue-900 dark:text-blue-100 px-2 py-1 rounded">
                            {{ $pembayaran->nama_pembayaran ?? '-' }}
                        </span>
                    </td>
                </tr>
                <tr class="border-b border-gray-200 dark:border-gray-700">
                    <td class="py-2 px-3 font-semibold text-blue-800 dark:text-blue-300">No. Rekening</td>
                    <td class="py-2 px-3">
                        <span
                            class="inline-flex items-center gap-2 bg-blue-100 dark:bg-blue-800 text-blue-900 dark:text-blue-100 px-2 py-1 rounded font-mono">
                            {{ $pembayaran->no_rekening ?? '-' }}
                        </span>
                    </td>
                </tr>
                @if ($pembayaran && $pembayaran->deskripsi)
                    <tr class="border-b border-gray-200 dark:border-gray-700">
                        <td class="py-2 px-3 font-semibold text-blue-800 dark:text-blue-300">Nama Rekening</td>
                        <td class="py-2 px-3">{{ $pembayaran->deskripsi }}</td>
                    </tr>
                @endif

                {{-- Bukti Pembayaran --}}
                <tr>
                    <td class="py-2 px-3 font-semibold text-blue-800 dark:text-blue-300">Bukti Pembayaran</td>
                    <td class="py-2 px-3">
                        @if ($donasi->hasMedia('bukti_pembayaran_pengisian_lansia'))
                            @php
                                $url = $donasi->getFirstMediaUrl('bukti_pembayaran_pengisian_lansia');
                            @endphp

                            <div x-data="{ show: false }" class="flex flex-col items-center">
                                <img src="{{ $url }}" alt="Bukti Pembayaran"
                                    class="h-36 w-auto object-cover rounded-lg border border-blue-200 dark:border-gray-700 shadow-sm bg-white dark:bg-gray-900 cursor-zoom-in hover:scale-105 transition-transform"
                                    @click="show = true" title="Klik untuk perbesar">
                                <span class="text-xs text-gray-500 mt-1">Klik gambar untuk lihat besar</span>
                                <div x-show="show" x-transition
                                    class="fixed inset-0 z-50 flex items-center justify-center bg-black/70"
                                    @click.away="show = false">
                                    <div
                                        class="bg-white dark:bg-gray-900 p-2 rounded shadow-lg max-w-full max-h-full flex flex-col items-center">
                                        <img src="{{ $url }}" alt="Bukti Pembayaran"
                                            class="max-h-[60vh] max-w-[80vw] object-contain rounded">
                                        <button @click="show = false"
                                            class="mt-3 px-4 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        @else
                            <span class="text-red-600 dark:text-red-400 font-semibold">Belum diupload</span>
                        @endif
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</div>
