<x-layout>
    <div class="flex flex-col h-screen overflow-hidden">
        @livewire('filter-form')
        <div class="flex flex-1 overflow-hidden">
            @livewire('offer-list')
            @livewire('offer-details')
        </div>
    </div>
</x-layout>