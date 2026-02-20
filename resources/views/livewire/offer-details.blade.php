<div class="w-3/5 flex flex-col overflow-hidden">
    @empty($offer)
        <div class="flex flex-col items-center justify-center h-full text-gray-400">
            <svg class="w-12 h-12 mb-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9"/>
            </svg>
            <p class="text-sm">Kliknij w ofertę aby zobaczyć szczegóły</p>
        </div>
    @else
        <div class="p-8 border-b border-gray-100">
            <h1 class="text-2xl font-bold" style="font-family: 'Space Grotesk'">{{$offer->title}}</h1>
            <p class="text-gray-500 mt-1">{{ $offer->company_name . " · " . $offer->localization}}</p>

            <div class="flex flex-wrap gap-2 mt-4">
                <span class="px-3 py-1 border-2 border-black rounded-full text-sm font-medium">{{$offer->pay}} zł</span>
                <span class="px-3 py-1 border border-gray-300 rounded-full text-sm text-gray-500">{{ $offer->category->name }}</span>
                <span class="px-3 py-1 border border-gray-300 rounded-full text-sm text-gray-500">{{ $offer->placeOfWork->name }}</span>
                <span class="px-3 py-1 border border-gray-300 rounded-full text-sm text-gray-500">{{ $offer->typeOfWork->name }}</span>
                <span class="px-3 py-1 border border-gray-300 rounded-full text-sm text-gray-500">Wymagane doświadczenie: {{ $offer->experience_required == 1 ? 'Tak' : 'Nie' }}</span>
            </div>
            <button class="mt-6 bg-black text-white px-8 py-3 rounded-xl font-semibold hover:bg-gray-800 cursor-pointer transition-colors duration-300 w-full flex items-center justify-center gap-2">
                Aplikuj teraz
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-up-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5"/>
                    <path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0z"/>
                </svg>
            </button>
        </div>

        <div class="overflow-y-auto p-8 flex-1">
            <div class="mt-0 pt-0">
                <h2 class="font-semibold mb-3">Opis stanowiska</h2>
                <p class="text-sm text-gray-700 leading-relaxed break-all">{{ $offer->description }}</p>
            </div>
            <div class="mt-6 border-t border-gray-100 pt-6">
                <h2 class="font-semibold mb-3">Szczegóły</h2>
                <div class="grid grid-cols-2 gap-3 text-sm">
                    <div>
                        <p class="text-gray-400">Kontakt</p>
                        <p class="font-medium">{{ $offer->contact }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400">Doświadczenie</p>
                        <p class="font-medium">{{ $offer->experience_required == 1 ? 'Wymagane' : 'Nie wymagane' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400">Lokalizacja</p>
                        <p class="font-medium">{{ $offer->localization }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400">Dodano</p>
                        <p class="font-medium">{{ date('d-m-Y', strtotime($offer->created_at)) }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endempty
</div>