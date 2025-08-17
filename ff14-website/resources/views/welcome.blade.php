<x-app-layout>
    <x-slot name="header">
        Welkom bij de Final Fantasy 14 Community
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Hero Section -->
        <div class="text-center mb-12">
            <h1 class="ff14-text text-5xl font-bold mb-4">
                Welkom in Eorzea
            </h1>
            <p class="ff14-text text-xl mb-8 max-w-3xl mx-auto">
                Ontdek de magische wereld van Final Fantasy 14. Beheer je profiel, lees het laatste nieuws, 
                vind antwoorden op je vragen en maak contact met andere spelers.
            </p>
            <div class="flex justify-center gap-4">
                <a href="{{ route('news.index') }}" class="ff14-button">
                    Bekijk Nieuws
                </a>
                <a href="{{ route('faq.index') }}" class="ff14-button">
                    FAQ
                </a>
                <a href="{{ route('contact.index') }}" class="ff14-button">
                    Contact
                </a>
            </div>
        </div>

        <!-- Feature Cards -->
        <div class="grid md:grid-cols-3 gap-8 mb-12">
            <div class="ff14-card p-6 rounded-lg">
                <h3 class="ff14-accent text-xl font-bold mb-3">📰 Nieuws & Updates</h3>
                <p class="ff14-text">
                    Blijf op de hoogte van het laatste nieuws, events en updates uit de wereld van FF14.
                </p>
            </div>
            
            <div class="ff14-card p-6 rounded-lg">
                <h3 class="ff14-accent text-xl font-bold mb-3">❓ FAQ & Help</h3>
                <p class="ff14-text">
                    Vind snel antwoorden op veelgestelde vragen en krijg hulp bij je avonturen.
                </p>
            </div>
            
            <div class="ff14-card p-6 rounded-lg">
                <h3 class="ff14-accent text-xl font-bold mb-3">👥 Community</h3>
                <p class="ff14-text">
                    Maak contact met andere spelers en deel je ervaringen in de FF14 community.
                </p>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="ff14-card p-6 rounded-lg text-center">
            <h3 class="ff14-accent text-2xl font-bold mb-4">Community Statistieken</h3>
            <div class="grid md:grid-cols-3 gap-6">
                <div>
                    <div class="ff14-text text-3xl font-bold">{{ App\Models\News::count() }}</div>
                    <div class="ff14-text">Nieuws Items</div>
                </div>
                <div>
                    <div class="ff14-text text-3xl font-bold">{{ App\Models\FaqItem::count() }}</div>
                    <div class="ff14-text">FAQ Items</div>
                </div>
                <div>
                    <div class="ff14-text text-3xl font-bold">{{ App\Models\User::count() }}</div>
                    <div class="ff14-text">Geregistreerde Spelers</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
