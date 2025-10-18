    <!-- // Komponen ini diinisialisasi dengan Alpine.js.
    // 'selectedPaymentId' akan melacak ID pembayaran yang dipilih.
    // Nilainya diambil dari state form Filament saat ini ($wire.get('data.pembayaran_id'))
    // agar tetap tersimpan jika ada validasi error atau saat mengedit. -->
<div 
    x-data="{ selectedPaymentId: $wire.get('data.pembayaran_id') }"
    class="grid grid-cols-2 md:grid-cols-3 gap-4"
>
    {{-- Loop melalui setiap opsi pembayaran --}}
    @foreach ($options as $option)
        <div
            {{-- 
                Saat div ini diklik:
                1. 'selectedPaymentId' di Alpine di-update dengan ID opsi ini.
                2. State 'pembayaran_id' di form Filament di-update secara real-time.
            --}}
            @click="selectedPaymentId = {{ $option->id }}; $wire.set('data.pembayaran_id', {{ $option->id }})"
            
            {{-- 
                Tambahkan kelas CSS secara kondisional.
                Jika 'selectedPaymentId' sama dengan ID opsi ini, tambahkan border biru dan ring.
            --}}
            :class="{ 
                'border-primary-500 ring-2 ring-primary-500': selectedPaymentId === {{ $option->id }},
                'border-gray-300 dark:border-gray-600': selectedPaymentId !== {{ $option->id }}
            }"
            class="relative flex items-center p-4 border rounded-lg cursor-pointer transition-all duration-200 hover:shadow-md hover:border-primary-400"
        >
            {{-- Tampilkan logo pembayaran --}}
            <img 
                src="{{ $option->getFirstMediaUrl('logo_metode_pembayaran') }}"
                alt="{{ $option->nama_pembayaran }}" 
                class="h-10 w-auto object-contain mr-4"
            >

            {{-- Tampilkan nama pembayaran --}}
            <span class="font-semibold text-gray-700 dark:text-gray-200">{{ $option->nama_pembayaran }}</span>

            {{-- Tanda centang yang muncul saat opsi dipilih --}}
            <div x-show="selectedPaymentId === {{ $option->id }}" class="absolute top-2 right-2 text-primary-500">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
            </div>
        </div>
    @endforeach
</div>