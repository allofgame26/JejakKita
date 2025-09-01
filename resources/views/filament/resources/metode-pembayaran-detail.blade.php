<x-filament::modal width="md">
    <div class="p-6 bg-gradient-to-br from-blue-50 to-white rounded-xl shadow-lg">
        <div class="flex items-center mb-4">
            <x-heroicon-o-credit-card class="w-6 h-6 text-blue-500 mr-2"/>
            <h2 class="text-xl font-bold text-blue-700">Detail Metode Pembayaran</h2>
        </div>
        <div class="divide-y divide-gray-200">
            <div class="py-2 flex justify-between items-center">
                <span class="font-semibold text-gray-600">Nama Metode:</span>
                <span>{{ $record->nama_metode }}</span>
            </div>
            <div class="py-2 flex justify-between items-center">
                <span class="font-semibold text-gray-600">Kode Metode:</span>
                <span>{{ $record->kode_metode }}</span>
            </div>
            <div class="py-2 flex flex-col">
                <span class="font-semibold text-gray-600 mb-1">Deskripsi:</span>
                <span>{{ $record->deskripsi }}</span>
            </div>
            <div class="py-2 flex justify-between items-center">
                <span class="font-semibold text-gray-600">Status:</span>
                <span>
                    @if($record->status)
                        <span class="px-2 py-1 rounded bg-green-100 text-green-700">Aktif</span>
                    @else
                        <span class="px-2 py-1 rounded bg-red-100 text-red-700">Nonaktif</span>
                    @endif
                </span>
            </div>
            <div class="py-2 flex justify-between items-center">
                <span class="font-semibold text-gray-600">Tanggal Dibuat:</span>
                <span>{{ \Carbon\Carbon::parse($record->created_at)->format('d M Y') }}</span>
            </div>
        </div>
    </div>
</x-filament::modal>