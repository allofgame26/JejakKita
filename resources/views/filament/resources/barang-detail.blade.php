<x-filament::modal width="md">
    <div class="p-6 bg-gradient-to-br from-blue-50 to-white rounded-xl shadow-lg">
        <div class="flex items-center mb-4">
            <x-heroicon-o-information-circle class="w-6 h-6 text-blue-500 mr-2"/>
            <h2 class="text-xl font-bold text-blue-700">Detail Barang</h2>
        </div>
        <div class="divide-y divide-gray-200">
            <div class="py-2 flex justify-between items-center">
                <span class="font-semibold text-gray-600">Kode Barang:</span>
                <span class="px-2 py-1 rounded bg-blue-100 text-blue-700 font-mono">{{ $record->kode_barang }}</span>
            </div>
            <div class="py-2 flex justify-between items-center">
                <span class="font-semibold text-gray-600">Kategori Barang:</span>
                <span class="px-2 py-1 rounded bg-green-100 text-green-700">{{ $record->kategoriBarang->nama_kategori ?? '-' }}</span>
            </div>
            <div class="py-2 flex justify-between items-center">
                <span class="font-semibold text-gray-600">Nama Barang:</span>
                <span class="px-2 py-1 rounded bg-yellow-100 text-yellow-700">{{ $record->nama_barang }}</span>
            </div>
            <div class="py-2 flex justify-between items-center">
                <span class="font-semibold text-gray-600">Nama Satuan:</span>
                <span class="px-2 py-1 rounded bg-purple-100 text-purple-700">{{ $record->nama_satuan }}</span>
            </div>
            <div class="py-2 flex justify-between items-center">
                <span class="font-semibold text-gray-600">Harga Satuan:</span>
                <span class="px-2 py-1 rounded bg-red-100 text-red-700">Rp. {{ number_format($record->harga_satuan, 0, ',', '.') }}</span>
            </div>
            <div class="py-2 flex flex-col">
                <span class="font-semibold text-gray-600 mb-1">Deskripsi Barang:</span>
                <span class="px-2 py-1 rounded bg-gray-100 text-gray-700">{{ $record->deskripsi_barang }}</span>
            </div>
        </div>
    </div>
</x-filament::modal>