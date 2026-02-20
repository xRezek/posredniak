<x-layout>
    <div class="flex justify-center ">
        <div class="text-center mt-10">
            <h1 class="text-7xl font-bold mb-4" style="font-family: 'Space Grotesk'">Mamy</h1>
            <p class="text-3xl text-gray-700">pracę dla ludzi z twoim wykształceniem.</p>
            <form action="{{ route('jobList') }}" method="GET" class="mt-30 flex justify-center">
                <div class="flex items-center border-2 border-black rounded-2xl overflow-hidden">
                    <div class="flex items-center px-4 py-3 gap-2">
                        <svg class="w-5 h-5 text-gray-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
                        </svg>
                        <input  type="text"
                                name="keyword" 
                                placeholder="Słowo kluczowe, Kategoria, Firma" class="w-72 focus:outline-none placeholder-gray-400 text-sm"
                                >
                    </div>
                    <div class="w-px h-8 bg-gray-300"></div>
                    <div class="flex items-center px-4 py-3 gap-2">
                        <svg class="w-5 h-5 text-gray-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5A2.5 2.5 0 1 1 12 6.5a2.5 2.5 0 0 1 0 5z"/>
                        </svg>
                        <input type="text" 
                               name="location"
                               placeholder="Lokalizacja"
                               class="w-48 focus:outline-none placeholder-gray-400 text-sm"
                               >
                    </div>
                    <button type="submit" class="bg-white text-black px-8 py-3 font-semibold border-l-2 border-black hover:bg-black hover:text-white transition-colors duration-300">Szukaj</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>