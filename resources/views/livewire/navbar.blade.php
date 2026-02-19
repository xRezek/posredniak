<flux:navbar class="text-black border-b border-slate-400 pb-1 flex items-center w-full">
    <a href="#"><x-app-logo /></a>
    <div class="w-px h-5 bg-slate-800"></div>
    <flux:navbar.item href="{{ route('home') }}" class="ml-4 text-black" :current="Route::is('home')">Strona Główna</flux:navbar.item>
    <flux:navbar.item href="{{ route('jobList') }}" class="ml-4 text-black" :current="Route::is('jobList')">Przeglądaj oferty</flux:navbar.item>

    @auth
        <div class="ml-auto flex items-center gap-4">
            <span class="text-sm text-gray-500">{{ Auth::user()->name }}</span>
            <div class="w-px h-5 bg-slate-800"></div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <flux:navbar.item as="button" type="submit" class="p-4 font-bold text-black">Wyloguj się</flux:navbar.item>
            </form>
        </div>
    @endauth

    @guest
        <div class="ml-auto flex items-center gap-2">
            <flux:navbar.item href="{{ route('login') }}" class="p-4 font-bold text-black">Zaloguj się</flux:navbar.item>
            <div class="w-px h-5 bg-slate-800"></div>
            <flux:navbar.item href="{{ route('register') }}" class="p-4 font-bold text-black mr-2">Zarejestruj się</flux:navbar.item>
        </div>
    @endguest
</flux:navbar>