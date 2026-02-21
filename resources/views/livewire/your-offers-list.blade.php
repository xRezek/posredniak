<div
    x-data
    x-on:open-offer-modal.window="$flux.modal('offer-modal').show()"
    x-on:toast.window="$flux.toast($event.detail.message, { variant: $event.detail.type === 'error' ? 'danger' : 'success' })"
>
    <div class="sticky top-0 bg-white z-10 border-b border-gray-200 px-6 py-4 flex justify-between items-center max-w-2xl mx-auto">
        <h1 class="text-2xl font-bold" style="font-family: 'Space Grotesk'">Moje oferty pracy</h1>
        <button wire:click="openCreateModal"
            class="flex items-center gap-2 bg-black text-white px-4 py-2 rounded-xl text-sm font-semibold hover:bg-gray-800 transition-colors duration-200">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
            </svg>
            Dodaj ofertę
        </button>
    </div>

    <div class="max-w-2xl mx-auto px-6 py-6">
        <div class="flex flex-col gap-4">
            @forelse ($offers as $offer)
                <div wire:key="offer-{{ $offer->id }}" class="border-2 border-gray-200 rounded-2xl p-4 hover:border-black transition-colors duration-200">
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
                        <span class="text-xs bg-gray-100 rounded-full px-2 py-0.5">{{ $offer->category?->name }}</span>
                        <span class="text-xs bg-gray-100 rounded-full px-2 py-0.5">{{ $offer->typeOfWork?->name }}</span>
                        <span class="text-xs bg-gray-100 rounded-full px-2 py-0.5">{{ $offer->placeOfWork?->name }}</span>
                        <span class="text-xs bg-gray-100 rounded-full px-2 py-0.5">Doświadczenie: {{ $offer->experience_required == 1 ? 'Tak' : 'Nie' }}</span>
                    </div>
                    <div class="flex justify-between items-center mt-4">
                        <span class="text-xs text-gray-400">Opublikowano: {{ \Carbon\Carbon::parse($offer->created_at)->locale('pl')->diffForHumans() }}</span>
                        <div class="flex gap-3">
                            <button wire:click="openEditModal({{ $offer->id }})"
                                class="text-sm font-medium text-black hover:underline">Edytuj</button>
                            <button wire:click="deleteOffer({{ $offer->id }})"
                                wire:confirm="Na pewno chcesz usunąć tę ofertę?"
                                class="text-sm font-medium text-red-500 hover:underline">Usuń</button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="flex flex-col items-center justify-center py-20 text-gray-400">
                    <svg class="w-12 h-12 mb-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                    </svg>
                    <p class="text-sm">Nie masz jeszcze żadnych ofert.</p>
                    <p class="text-xs mt-1">Dodaj swoją pierwszą ofertę aby zacząć przyciągać kandydatów.</p>
                </div>
            @endforelse
        </div>
        <div class="mt-6">
            {{ $offers->links() }}
        </div>
    </div>

    <flux:modal name="offer-modal" class="max-w-2xl w-full">
        <div class="p-6">
            <h2 class="text-xl font-bold mb-6" style="font-family: 'Space Grotesk'">
                {{ $editingOfferId ? 'Edytuj ofertę' : 'Nowa oferta pracy' }}
            </h2>
            <form wire:submit.prevent="saveOffer" class="flex flex-col gap-4">
                <div class="flex gap-3">
                    <div class="flex flex-col gap-1 w-full">
                        <label class="text-sm font-medium">Stanowisko</label>
                        <input type="text" wire:model="title" placeholder="np. Senior Developer"
                            class="border-2 border-black rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-black">
                        @error('title') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div class="flex flex-col gap-1 w-full">
                        <label class="text-sm font-medium">Wynagrodzenie (zł)</label>
                        <input type="number" wire:model="pay" placeholder="np. 8000"
                            class="border-2 border-black rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-black">
                        @error('pay') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="flex gap-3">
                    <div class="flex flex-col gap-1 w-full">
                        <label class="text-sm font-medium">Firma</label>
                        <input type="text" wire:model="company_name" placeholder="Nazwa firmy"
                            class="border-2 border-black rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-black">
                        @error('company_name') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div class="flex flex-col gap-1 w-full">
                        <label class="text-sm font-medium">Lokalizacja</label>
                        <input type="text" wire:model="localization" placeholder="np. Warszawa"
                            class="border-2 border-black rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-black">
                        @error('localization') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="flex gap-3">
                    <div class="flex flex-col gap-1 w-full">
                        <label class="text-sm font-medium">Kategoria</label>
                        <select wire:model="category_id" class="border-2 border-black rounded-xl px-4 py-3 text-sm focus:outline-none">
                            <option value="" disabled>Wybierz</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div class="flex flex-col gap-1 w-full">
                        <label class="text-sm font-medium">Rodzaj umowy</label>
                        <select wire:model="type_of_contract_id" class="border-2 border-black rounded-xl px-4 py-3 text-sm focus:outline-none">
                            <option value="">Wybierz</option>
                            @foreach($typesOfWork as $type)
                                <option value="{{ $type->id }}" {{ $type_of_contract_id == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                            @endforeach
                        </select>
                        @error('type_of_contract_id') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div class="flex flex-col gap-1 w-full">
                        <label class="text-sm font-medium">Tryb pracy</label>
                        <select wire:model="place_of_work_id" class="border-2 border-black rounded-xl px-4 py-3 text-sm focus:outline-none">
                            <option value="">Wybierz</option>
                            @foreach($placesOfWork as $place)
                                <option value="{{ $place->id }}" {{ $place_of_work_id == $place->id ? 'selected' : '' }}>{{ $place->name }}</option>
                            @endforeach
                        </select>
                        @error('place_of_work_id') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-sm font-medium">Kontakt</label>
                    <input type="text" wire:model="contact" placeholder="email lub telefon"
                        class="border-2 border-black rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-black">
                    @error('contact') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-sm font-medium">Opis stanowiska</label>
                    <textarea wire:model="description" rows="4" placeholder="Opisz stanowisko, wymagania, benefity..."
                        class="border-2 border-black rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-black resize-none"></textarea>
                </div>
                <div class="flex items-center gap-3">
                    <input type="checkbox" wire:model="experience_required" id="experience_required" class="w-4 h-4 accent-black">
                    <label for="experience_required" class="text-sm font-medium">Wymagane doświadczenie</label>
                </div>
                <div class="flex gap-3 mt-2">
                    <button type="submit"
                        class="flex-1 bg-black text-white py-3 rounded-xl font-semibold hover:bg-gray-800 transition-colors duration-300">
                        {{ $editingOfferId ? 'Zaktualizuj' : 'Zapisz ofertę' }}
                    </button>
                    <flux:modal.close>
                        <button type="button"
                            class="flex-1 border-2 border-black py-3 rounded-xl font-semibold hover:bg-gray-100 transition-colors duration-300">
                            Anuluj
                        </button>
                    </flux:modal.close>
                </div>
            </form>
        </div>
    </flux:modal>
</div>