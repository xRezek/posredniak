<flux:navbar class="text-black border-b border-slate-400 pb-1 flex items-center w-full">
    <a href="{{ route('home') }}"><x-app-logo /></a>
    <div class="w-px h-5 bg-slate-800"></div>
    <flux:navbar.item href="{{ route('home') }}" class="ml-4 text-black" :current="Route::is('home')">Strona Główna</flux:navbar.item>
    <flux:navbar.item href="{{ route('jobList') }}" class="ml-4 text-black" :current="Route::is('jobList')">Przeglądaj oferty</flux:navbar.item>

    @auth
        <div class="ml-auto flex items-center gap-4">
            <flux:navbar.item href="{{ route('profile') }}" class="text-base font-bold text-black">
                <span class="flex items-center gap-2">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0zM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
                    </svg>
                    Profil
                </span>
            </flux:navbar.item>
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