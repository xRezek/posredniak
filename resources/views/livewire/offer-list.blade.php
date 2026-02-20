<div class="w-2/5 overflow-y-auto border-r border-gray-200 p-3 flex flex-col gap-3">
    @foreach ($offers as $offer)
        <div wire:click="$dispatch('offerSelected', {id: {{ $offer->id }}})"
            class="border-2 border-gray-200 rounded-2xl p-4 cursor-pointer hover:border-black transition-colors duration-200">

            <div class="flex justify-between items-start">
                <h3 class="font-semibold text-sm">{{ $offer->title }}</h3>
                <span class="text-xs font-semibold border-2 border-black rounded-full px-2 py-0.5 shrink-0 ml-2">
                    {{ $offer->pay }} zł
                </span>
            </div>

            <p class="text-sm text-gray-500 mt-1">{{ $offer->company_name }}</p>

            <div class="flex items-center gap-1 mt-1 text-xs text-gray-400">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/>
                </svg>
                {{ $offer->localization }}
            </div>

            <div class="flex flex-wrap gap-1.5 mt-3">
                <span class="text-xs bg-gray-100 rounded-full px-2 py-0.5">{{ $offer->category->name }}</span>
                <span class="text-xs bg-gray-100 rounded-full px-2 py-0.5">{{ $offer->typeOfWork->name }}</span>
                <span class="text-xs bg-gray-100 rounded-full px-2 py-0.5">{{ $offer->placeOfWork->name }}</span>
            </div>
        </div>
    @endforeach
    {{ $offers->links() }}
</div>