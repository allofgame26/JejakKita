{{-- filepath: resources/views/filament/resources/feedback-detail.blade.php --}}
<x-filament::modal width="md">
    <div class="p-6 bg-gradient-to-br from-blue-50 to-white rounded-xl shadow-lg">
        <div class="flex items-center mb-4">
            <x-heroicon-o-chat-bubble-left-ellipsis class="w-6 h-6 text-blue-500 mr-2"/>
            <h2 class="text-xl font-bold text-blue-700">Detail Feedback</h2>
        </div>
        <div class="divide-y divide-gray-200">
            <div class="py-2 flex justify-between items-center">
                <span class="font-semibold text-gray-600">E-Mail:</span>
                <span>{{ $record->user->email ?? '-' }}</span>
            </div>
            <div class="py-2 flex justify-between items-center">
                <span class="font-semibold text-gray-600">Subjek Feedback:</span>
                <span>{{ $record->subject_feedback }}</span>
            </div>
            <div class="py-2 flex flex-col">
                <span class="font-semibold text-gray-600 mb-1">Isi Feedback:</span>
                <span>{{ $record->isi_feedback }}</span>
            </div>
            <div class="py-2 flex justify-between items-center">
                <span class="font-semibold text-gray-600">Rating:</span>
                <span>{{ $record->rate }}</span>
            </div>
            <div class="py-2 flex flex-col">
                <span class="font-semibold text-gray-600 mb-1">Foto Feedback:</span>
                @if($record->getFirstMediaUrl('feedback'))
                    <img src="{{ $record->getFirstMediaUrl('feedback') }}" class="w-full rounded-lg mt-2" alt="Foto Feedback">
                @else
                    <span class="text-gray-400">Belum ada foto</span>
                @endif
            </div>
            <div class="py-2 flex justify-between items-center">
                <span class="font-semibold text-gray-600">Tanggal Dibuat:</span>
                <span>{{ \Carbon\Carbon::parse($record->created_at)->format('d M Y H:i') }}</span>
            </div>
        </div>
    </div>
</x-filament::modal>