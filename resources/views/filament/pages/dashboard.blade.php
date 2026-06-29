<x-filament-panels::page class="fi-dashboard-page">
    <x-filament-widgets::widgets
        :columns="$this->getColumns()"
        :data="$this->getWidgetData()"
        :widgets="$this->getVisibleWidgets()"
    />

    @livewire('chatbot-widget')
</x-filament-panels::page>