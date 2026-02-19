<x-layout>
    <div class="flex justify-center items-center pt-40 px-4">
        <div class="w-full max-w-md">
            <h1 class="text-3xl font-bold mb-2" style="font-family: 'Space Grotesk'">Zarejestruj się</h1>
            <p class="text-gray-500 mb-8 text-sm">Masz już konto? <a href="{{ route('login') }}" class="text-black font-semibold underline">Zaloguj się</a></p>

            <form method="POST" action="{{ route('register.post') }}" class="flex flex-col gap-4">
                @csrf

                <div class="flex gap-3">
                    <div class="flex flex-col gap-1 w-full">
                        <label for="first_name" class="text-sm font-medium">Imię i Nazwisko</label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            placeholder="Jan Kowalski"
                            class="border-2 border-black rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-black"
                            required
                        >
                    </div>
                </div>
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
                    <label for="password" class="text-sm font-medium">Hasło</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="••••••••"
                        class="border-2 border-black rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-black"
                        required
                    >
                </div>
                <div class="flex flex-col gap-1">
                    <label for="password_confirmation" class="text-sm font-medium">Powtórz hasło</label>
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        placeholder="••••••••"
                        class="border-2 border-black rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-black"
                        required
                    >
                </div>
                <div class="flex items-start gap-3">
                    <input
                        type="checkbox"
                        id="terms"
                        name="terms"
                        class="mt-1 w-4 h-4 accent-black cursor-pointer"
                        required
                    >
                    <label for="terms" class="text-sm text-gray-500">
                        Akceptuję <a href="#" class="text-black font-semibold underline">regulamin</a> oraz <a href="#" class="text-black font-semibold underline">politykę prywatności</a>
                    </label>
                </div>
                <button type="submit"class="mt-2 bg-black text-white py-3 rounded-xl font-semibold hover:bg-gray-800 transition-colors duration-300"> Zarejestruj się</button>
            </form>
        </div>
    </div>
</x-layout>