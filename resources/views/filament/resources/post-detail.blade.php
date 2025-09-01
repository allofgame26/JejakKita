{{-- filepath: resources/views/filament/resources/post-detail.blade.php --}}
<x-filament::modal width="md">
    <div class="p-6 bg-gradient-to-br from-blue-50 to-white rounded-xl shadow-lg">
        <div class="flex items-center mb-4">
            <x-heroicon-o-newspaper class="w-6 h-6 text-blue-500 mr-2"/>
            <h2 class="text-xl font-bold text-blue-700">Detail Postingan</h2>
        </div>
        <div class="mb-4">
            @if($record->getFirstMediaUrl('media'))
                <img src="{{ $record->getFirstMediaUrl('media') }}" class="w-full rounded-lg" alt="Media Foto">
            @endif
        </div>
        <div class="divide-y divide-gray-200">
            <div class="py-2 flex justify-between items-center">
                <span class="font-semibold text-gray-600">Judul:</span>
                <span>{{ $record->title }}</span>
            </div>
            <div class="py-2 flex justify-between items-center">
                <span class="font-semibold text-gray-600">Slug:</span>
                <span>{{ $record->slug }}</span>
            </div>
            <div class="py-2 flex justify-between items-center">
                <span class="font-semibold text-gray-600">Kategori:</span>
                <span>
                    @foreach($record->kategori as $kategori)
                        <span class="px-2 py-1 rounded bg-blue-100 text-blue-700">{{ $kategori->title }}</span>
                    @endforeach
                </span>
            </div>
            <div class="py-2 flex justify-between items-center">
                <span class="font-semibold text-gray-600">Meta Deskripsi:</span>
                <span>{{ $record->meta_description }}</span>
            </div>
            <div class="py-2 flex flex-col">
                <span class="font-semibold text-gray-600 mb-1">Deskripsi:</span>
                <span>{{ $record->content }}</span>
            </div>
            <div class="py-2 flex justify-between items-center">
                <span class="font-semibold text-gray-600">Status Publish:</span>
                <span>{{ $record->is_published ? 'Published' : 'Draft' }}</span>
            </div>
            <div class="py-2 flex justify-between items-center">
                <span class="font-semibold text-gray-600">Tanggal Dibuat:</span>
                <span>{{ \Carbon\Carbon::parse($record->created_at)->format('d M Y') }}</span>
            </div>
        </div>
    </div>
</x-filament::modal>