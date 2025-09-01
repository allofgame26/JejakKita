{{-- filepath: resources/views/filament/resources/kategori-post-detail.blade.php --}}
<x-filament::modal width="md">
    <div class="p-6 bg-gradient-to-br from-blue-50 to-white rounded-xl shadow-lg">
        <div class="flex items-center mb-4">
            <x-heroicon-o-folder class="w-6 h-6 text-blue-500 mr-2"/>
            <h2 class="text-xl font-bold text-blue-700">Detail Kategori Post</h2>
        </div>
        <div class="divide-y divide-gray-200">
            <div class="py-2 flex justify-between items-center">
                <span class="font-semibold text-gray-600">Nama Kategori:</span>
                <span>{{ $record->title }}</span>
            </div>
            <div class="py-2 flex justify-between items-center">
                <span class="font-semibold text-gray-600">Slug:</span>
                <span>{{ $record->slug }}</span>
            </div>
            <div class="py-2 flex flex-col">
                <span class="font-semibold text-gray-600 mb-1">Deskripsi:</span>
                <span>{{ $record->content }}</span>
            </div>
        </div>
    </div>
</x-filament::modal>