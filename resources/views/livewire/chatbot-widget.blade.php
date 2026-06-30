<div x-data="{ open: false }" style="position: fixed; bottom: 30px; right: 30px; z-index: 99999;" class="font-sans">
    
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
                <div class="flex w-full {{ $chat['role'] === 'user' ? 'justify-end' : 'justify-start' }}">
                    
                    @if($chat['role'] === 'assistant')
                    <div class="flex-shrink-0 mr-2 mt-1">
                        <div class="w-8 h-8 bg-primary-600 rounded-full flex items-center justify-center text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 21v-4.872c0-1.143.9-2.094 2.03-2.193a2.12 2.12 0 0 1 .72.062 1.93 1.93 0 0 0 .848 0 2.12 2.12 0 0 1 .72-.062c1.13.099 2.03 1.05 2.03 2.193V21M15.75 21h3a2.25 2.25 0 0 0 2.25-2.25V13.5m0 0a2.25 2.25 0 0 0-2.25-2.25h-3m3 0V8.25m0 3.75V8.25m-3-3.75h3m0 0V3.75m0 0a2.25 2.25 0 0 0-2.25-2.25h-3M8.25 21H5.25A2.25 2.25 0 0 1 3 18.75V13.5m0 0a2.25 2.25 0 0 1 2.25-2.25h3m-3 0V8.25m0 3.75V8.25m3-3.75h-3m0 0V3.75m0 0A2.25 2.25 0 0 1 5.25 1.5h3M12 15h.008v.008H12V15Z" />
                            </svg>
                        </div>
                    </div>
                    @endif

                    <div class="flex flex-col {{ $chat['role'] === 'user' ? 'items-end' : 'items-start' }}">
                        <div class="p-3 rounded-2xl max-w-[100%] text-sm shadow-sm {{ $chat['role'] === 'user' ? 'bg-primary-100 text-primary-900 rounded-tr-none' : 'bg-white dark:bg-gray-700 dark:text-white border border-gray-200 dark:border-gray-600 rounded-tl-none' }}">
                            {!! nl2br(e($chat['content'])) !!}
                        </div>
                        
                        @if($chat['role'] === 'assistant' && isset($chat['metrics']))
                            <span class="text-[10px] text-gray-400 mt-1 ml-1">{{ $chat['metrics'] }}</span>
                        @endif
                    </div>

                    @if($chat['role'] === 'user')
                    <div class="flex-shrink-0 ml-2 mt-1">
                        <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                    @endif

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