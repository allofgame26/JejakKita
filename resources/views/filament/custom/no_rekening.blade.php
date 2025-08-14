@php
    $rekening = $getRecord()?->pembayaran;
@endphp

<div class="p-4 bg-gradient-to-br from-blue-100 to-blue-50 rounded-xl border border-blue-200 shadow-sm mb-4">
    <div class="flex items-center mb-2">
        <svg class="w-6 h-6 text-blue-600 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h10M7 19h10M7 5h10"/></svg>
        <span class="font-bold text-blue-800 text-lg">Nomor Rekening Tujuan</span>
    </div>
    @if($rekening && $rekening->nama_pembayaran && $rekening->no_rekening)
        <div class="flex flex-col gap-1 text-blue-900 mb-2">
            <span class="font-semibold text-base">{{ $rekening->nama_pembayaran }}</span>
            <div class="flex items-center gap-2">
                <span id="noRekening" class="text-xl tracking-wider font-mono select-all">{{ $rekening->no_rekening }}</span>
                <button type="button" onclick="navigator.clipboard.writeText('{{ $rekening->no_rekening }}'); this.querySelector('svg').classList.add('text-green-500'); setTimeout(() => this.querySelector('svg').classList.remove('text-green-500'), 1000);" class="ml-1 p-1 rounded hover:bg-blue-200 focus:outline-none" title="Copy">
                    <svg class="w-5 h-5 text-blue-600 transition-colors" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 16h8a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2zm0 0v2a2 2 0 0 0 2 2h4a2 2 0 0 0 2-2v-2"/></svg>
                </button>
            </div>
        </div>
        @if($rekening->deskripsi)
            <div class="text-xs text-blue-700 italic mt-1">{{ $rekening->deskripsi }}</div>
        @endif
        <div class="mt-3 flex items-center gap-2 bg-blue-200 rounded px-3 py-1 text-blue-800 text-sm">
            <svg class="w-4 h-4 text-blue-500 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3zm0 0V4m0 7v7"/></svg>
            <span>Transfer hanya ke rekening di atas sesuai nominal donasi.</span>
        </div>
    @else
        <div class="text-red-600">Data rekening tidak ditemukan.</div>
    @endif
</div>
