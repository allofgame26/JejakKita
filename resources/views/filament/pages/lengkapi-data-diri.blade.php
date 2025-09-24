<x-filament-panels::page.simple :has-logo="false">
    {{-- Ini akan merender form yang Anda definisikan di file PHP --}}
    <x-filament-panels::form wire:submit="save">
        {{ $this->form }}

        <x-filament-panels::form.actions
            :actions="$this->getFormActions()"
        />
    </x-filament-panels::form>
</x-filament-panels::page.simple>

