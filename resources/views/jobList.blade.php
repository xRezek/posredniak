<x-layout>
    <div class="flex flex-col h-screen overflow-hidden">
        @livewire('filter-form')
        <div class="flex flex-1 overflow-hidden">
            @livewire('offer-list', ['keyword'=>$keyword, 'location'=>$location])
            @livewire('offer-details', ['keyword'=>$keyword, 'location'=>$location])
        </div>
    </div>
</x-layout>