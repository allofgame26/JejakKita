<x-filament-panels::page>
    <form method="post" wire:submit='save'>
        {{ $this->form }}
        <button type="button" class="mt-4 bg-green-500 w-40 hover:bg-blue-400 text-white font-bold py-2 px-3">
            Save
        </button>
    </form>
</x-filament-panels::page>