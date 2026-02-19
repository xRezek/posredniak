<x-layout>    
    <div class="flex justify-center items-center mt-40 px-4">
        <div class="w-full max-w-md">
            <h1 class="text-3xl font-bold mb-2" style="font-family: 'Space Grotesk'">Zaloguj się</h1>
            <p class="text-gray-500 mb-8 text-sm">Nie masz konta? <a href="{{ route('register') }}" class="text-black font-semibold underline">Zarejestruj się</a></p>

            <form method="POST" action="{{ route('login.post') }}" class="flex flex-col gap-4">
                @csrf

                <div class="flex flex-col gap-1">
                    <label for="email" class="text-sm font-medium">Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="jan@kowalski.pl"
                        class="border-2 border-black rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-black"
                        required
                    >
                </div>
                <div class="flex flex-col gap-1">
                    <div class="flex justify-between items-center">
                        <label for="password" class="text-sm font-medium">Hasło</label>
                        <a href="#" class="text-xs text-gray-500 hover:text-black transition-colors">Zapomniałeś hasła?</a>
                    </div>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="••••••••"
                        class="border-2 border-black rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-black"
                        required
                    >
                </div>
                <button type="submit" class="mt-2 bg-black text-white py-3 rounded-xl font-semibold hover:bg-gray-800 transition-colors duration-300">Zaloguj się</button>
            </form>
        </div>
    </div>

    @session('error')
        <div class="fixed bottom-4 left-1/2 transform -translate-x-1/2 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg">
            {{ session('error') }}
        </div>
    @endsession
</x-layout>