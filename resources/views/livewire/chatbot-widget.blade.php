<div x-data="{ open: false }" class="fixed bottom-6 right-6 z-50 font-sans">
    
    <button @click="open = true" x-show="!open" class="bg-primary-600 text-white p-4 rounded-full shadow-2xl hover:bg-primary-500 transition transform hover:scale-105">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.221-1.125-2.114-2.214-2.214A48.65 48.65 0 0 0 12 4.25c-2.43 0-4.81.1-7.135.29-1.1.1-2.214 1.01-2.214 2.214v4.286c0 1.22 1.125 2.114 2.214 2.214m12.33 8.334c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m-9.345-8.334a2.126 2.126 0 0 0-.476-.095" />
        </svg>
    </button>

    <div x-show="open" style="display: none;" class="w-80 sm:w-96 bg-white dark:bg-gray-800 rounded-xl shadow-2xl border border-gray-200 dark:border-gray-700 flex flex-col h-[500px] overflow-hidden">
        
        <div class="bg-primary-600 text-white p-4 flex justify-between items-center shadow-md">
            <div class="flex items-center gap-2">
                <span class="font-bold text-lg">Asisten RAG</span>
            </div>
            <button @click="open = false" class="text-white hover:text-gray-200 transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
            </button>
        </div>

        <div class="flex-1 p-4 overflow-y-auto flex flex-col gap-3 bg-gray-50 dark:bg-gray-900">
            @if(count($riwayatChat) === 0)
                <div class="text-center text-gray-400 text-sm mt-4">
                    Ketik pertanyaan Anda di bawah ini...
                </div>
            @endif

            @foreach($riwayatChat as $chat)
                <div class="p-3 rounded-2xl max-w-[85%] text-sm shadow-sm {{ $chat['role'] === 'user' ? 'bg-primary-100 text-primary-900 self-end rounded-tr-none' : 'bg-white dark:bg-gray-700 dark:text-white border border-gray-200 dark:border-gray-600 self-start rounded-tl-none' }}">
                    {!! nl2br(e($chat['content'])) !!}
                </div>
            @endforeach
            
            <div wire:loading wire:target="kirimPesan" class="text-xs text-gray-500 italic self-start mt-1">
                AI sedang berpikir...
            </div>
        </div>

        <div class="p-3 bg-white dark:bg-gray-800 border-t dark:border-gray-700 flex gap-2 items-center">
            <input wire:model="pesanInput" wire:keydown.enter="kirimPesan" type="text" placeholder="Tanya dokumen..." class="flex-1 border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 dark:bg-gray-700 dark:text-white transition">
            <button wire:click="kirimPesan" wire:loading.attr="disabled" class="bg-primary-600 text-white p-2 rounded-lg hover:bg-primary-700 transition disabled:opacity-50">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                    <path d="M3.478 2.404a.75.75 0 0 0-.926.941l2.432 7.905H13.5a.75.75 0 0 1 0 1.5H4.984l-2.432 7.905a.75.75 0 0 0 .926.94 60.519 60.519 0 0 0 18.445-8.986.75.75 0 0 0 0-1.218A60.517 60.517 0 0 0 3.478 2.404Z" />
                </svg>
            </button>
        </div>
    </div>
</div>