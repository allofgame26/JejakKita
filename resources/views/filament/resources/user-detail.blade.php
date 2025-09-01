{{-- filepath: resources/views/filament/resources/user-detail.blade.php --}}
<x-filament::modal width="md">
    <div class="p-6 bg-gradient-to-br from-blue-50 to-white rounded-xl shadow-lg">
        <div class="flex items-center mb-4">
            <x-heroicon-o-user class="w-6 h-6 text-blue-500 mr-2"/>
            <h2 class="text-xl font-bold text-blue-700">Detail User</h2>
        </div>
        <div class="flex justify-center mb-4">
            @if($record->profile_url)
                <img src="{{ $record->profile_url }}" class="w-24 h-24 rounded-full ring-2 ring-blue-400" alt="Foto Profile">
            @else
                <span class="text-gray-400">Tidak ada foto</span>
            @endif
        </div>
        <div class="divide-y divide-gray-200">
            <div class="py-2 flex justify-between items-center">
                <span class="font-semibold text-gray-600">Username:</span>
                <span>{{ $record->name }}</span>
            </div>
            <div class="py-2 flex justify-between items-center">
                <span class="font-semibold text-gray-600">Email:</span>
                <span>{{ $record->email }}</span>
            </div>
            <div class="py-2 flex justify-between items-center">
                <span class="font-semibold text-gray-600">NIP:</span>
                <span>{{ $record->datadiri->nip ?? '-' }}</span>
            </div>
            <div class="py-2 flex justify-between items-center">
                <span class="font-semibold text-gray-600">Nama Lengkap:</span>
                <span>{{ $record->datadiri->nama_lengkap ?? '-' }}</span>
            </div>
            <div class="py-2 flex justify-between items-center">
                <span class="font-semibold text-gray-600">Roles:</span>
                <span>
                    @foreach($record->roles as $role)
                        <span class="px-2 py-1 rounded bg-blue-100 text-blue-700">{{ $role->name }}</span>
                    @endforeach
                </span>
            </div>
        </div>
    </div>
</x-filament::modal>