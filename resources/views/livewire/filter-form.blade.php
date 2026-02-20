<div class="max-w-4xl mx-auto px-6 py-8">
    <form action="{{ route('jobList') }}">
        <div class="flex items-center border-2 border-black rounded-2xl overflow-hidden mb-4">
            <div class="flex items-center px-4 py-3 gap-2 flex-1">
                <svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
                </svg>
                <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Stanowisko, firma, słowo kluczowe"
                    class="w-full text-sm focus:outline-none placeholder-gray-400">
            </div>
            <div class="w-px h-8 bg-gray-300"></div>
            <div class="flex items-center px-4 py-3 gap-2 flex-1">
                <svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5A2.5 2.5 0 1 1 12 6.5a2.5 2.5 0 0 1 0 5z"/>
                </svg>
                <input type="text" name="location" value="{{ request('location') }}" placeholder="Lokalizacja"
                    class="w-full text-sm focus:outline-none placeholder-gray-400">
            </div>
            <button type="submit" class="bg-white text-black px-6 py-3 text-sm font-semibold hover:bg-black hover:text-white transition-colors duration-300 border-l-2 border-black">
                Szukaj
            </button>
        </div>

        <div class="flex flex-wrap gap-2 mx-3">
            <select name="category" class="border-2 border-black rounded-xl px-3 py-2 text-sm focus:outline-none cursor-pointer hover:bg-black hover:text-white transition-colors duration-200">
                <option value="">Kategoria</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>

            <select name="type" class="border-2 border-black rounded-xl px-3 py-2 text-sm focus:outline-none cursor-pointer hover:bg-black hover:text-white transition-colors duration-200">
                <option value="">Rodzaj umowy</option>
                @foreach ($typesOfWork as $type)
                    <option value="{{ $type->id }}" {{ request('type') == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                @endforeach
            </select>

            <select name="mode" class="border-2 border-black rounded-xl px-3 py-2 text-sm focus:outline-none cursor-pointer hover:bg-black hover:text-white transition-colors duration-200">
                <option value="">Tryb pracy</option>
                @foreach ($placesOfWork as $place)
                    <option value="{{ $place->id }}" {{ request('mode') == $place->id ? 'selected' : '' }}>{{ $place->name }}</option>
                @endforeach
            </select>

           <select name="experience_required" class="border-2 border-black rounded-xl px-3 py-2 text-sm focus:outline-none cursor-pointer hover:bg-black hover:text-white transition-colors duration-200">
                <option value="">Doświadczenie</option>
                <option value="1" {{ request('experience_required') === '1' ? 'selected' : '' }}>Wymagane</option>
                <option value="0" {{ request('experience_required') === '0' ? 'selected' : '' }}>Nie wymagane</option>
            </select>

            <select name="sort" class="border-2 border-black rounded-xl px-3 py-2 text-sm focus:outline-none cursor-pointer hover:bg-black hover:text-white transition-colors duration-200">
                <option value="">Sortuj</option>
                <option value="desc" {{ request('sort', 'desc') == 'desc' ? 'selected' : '' }}>Od najnowszej</option>
                <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Od najstarszej</option>
            </select>
        </div>
    </form>
</div>