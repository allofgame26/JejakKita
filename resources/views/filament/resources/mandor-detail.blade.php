{{-- filepath: resources/views/filament/resources/mandor-detail.blade.php --}}
<x-filament::modal width="md">
    <div class="p-6 bg-gradient-to-br from-blue-50 to-white rounded-xl shadow-lg">
        <div class="flex items-center mb-4">
            <x-heroicon-o-user class="w-6 h-6 text-blue-500 mr-2"/>
            <h2 class="text-xl font-bold text-blue-700">Detail Mandor</h2>
        </div>
        <div class="flex justify-center mb-4">
            @if($record->getFirstMediaUrl('mandor'))
                <img src="{{ $record->getFirstMediaUrl('mandor') }}" class="w-24 h-24 rounded-full ring-2 ring-blue-400" alt="Foto Mandor">
            @else
                <span class="text-gray-400">Tidak ada foto</span>
            @endif
        </div>
        <div class="divide-y divide-gray-200">
            <div class="py-2 flex justify-between items-center">
                <span class="font-semibold text-gray-600">Nama Lengkap:</span>
                <span>{{ $record->nama_lengkap }}</span>
            </div>
            <div class="py-2 flex justify-between items-center">
                <span class="font-semibold text-gray-600">NIK:</span>
                <span>{{ $record->nik }}</span>
            </div>
            <div class="py-2 flex justify-between items-center">
                <span class="font-semibold text-gray-600">Tempat Lahir:</span>
                <span>{{ $record->tempat_lahir }}</span>
            </div>
            <div class="py-2 flex justify-between items-center">
                <span class="font-semibold text-gray-600">Tanggal Lahir:</span>
                <span>{{ \Carbon\Carbon::parse($record->tanggal_lahir)->format('d/m/Y') }}</span>
            </div>
            <div class="py-2 flex justify-between items-center">
                <span class="font-semibold text-gray-600">Alamat:</span>
                <span>{{ $record->alamat }}</span>
            </div>
            <div class="py-2 flex justify-between items-center">
                <span class="font-semibold text-gray-600">Jenis Kelamin:</span>
                <span>{{ ucfirst($record->jenis_kelamin) }}</span>
            </div>
            <div class="py-2 flex justify-between items-center">
                <span class="font-semibold text-gray-600">Nomor Telepon:</span>
                <span>{{ $record->no_telp }}</span>
            </div>
        </div>
    </div>
</x-filament::modal>