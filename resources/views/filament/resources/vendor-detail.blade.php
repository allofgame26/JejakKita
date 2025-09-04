{{-- filepath: resources/views/filament/resources/vendor-detail.blade.php --}}
<x-filament::modal width="md">
    <div class="p-6 bg-gradient-to-br from-blue-50 to-white rounded-xl shadow-lg">
        <div class="flex items-center mb-4">
            <x-heroicon-o-shopping-bag class="w-6 h-6 text-blue-500 mr-2"/>
            <h2 class="text-xl font-bold text-blue-700">Detail Vendor</h2>
        </div>
        <div class="divide-y divide-gray-200">
            <div class="py-2 flex justify-between items-center">
                <span class="font-semibold text-gray-600">Kode Vendor:</span>
                <span>{{ $record->kode_vendor }}</span>
            </div>
            <div class="py-2 flex justify-between items-center">
                <span class="font-semibold text-gray-600">Nama Vendor:</span>
                <span>{{ $record->nama_vendor }}</span>
            </div>
            <div class="py-2 flex justify-between items-center">
                <span class="font-semibold text-gray-600">Alamat Vendor:</span>
                <span>{{ $record->alamat_vendor }}</span>
            </div>
            <div class="py-2 flex justify-between items-center">
                <span class="font-semibold text-gray-600">Nomor Telepon / WhatsApp:</span>
                <span>{{ $record->no_telepon }}</span>
            </div>
            <div class="py-2 flex justify-between items-center">
                <span class="font-semibold text-gray-600">Keterangan:</span>
                <span>{{ $record->keterangan }}</span>
            </div>
            <div class="py-2 flex justify-between items-center">
                <span class="font-semibold text-gray-600">Status:</span>
                <span>{{ ucfirst($record->status) }}</span>
            </div>
        </div>
    </div>
</x-filament::modal>