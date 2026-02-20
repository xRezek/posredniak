
    <x-layout>
        <div class="max-w-4xl mx-auto px-6 py-8">
            <h1 class="text-2xl font-bold mb-6">Twój Profil</h1>
            <p class="text-gray-700 mb-4">Witaj, {{ auth()->user()->name }}! To jest Twój profil. Tutaj możesz zarządzać zamieszczonymi ofetami pracy.</p>
            @livewire('your-offers-list')
        </div>
    </x-layout>

