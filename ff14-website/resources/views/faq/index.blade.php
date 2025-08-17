<x-app-layout>
    <x-slot name="header">
        <h2 class="ff14-text font-semibold text-xl leading-tight">
            {{ __('Veelgestelde Vragen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Admin controls -->
            @auth
                @if(Auth::user()->isAdmin())
                    <div class="mb-6 flex space-x-4">
                        <a href="{{ route('faq.create-category') }}" class="ff14-button inline-flex items-center px-4 py-2">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Categorie Toevoegen
                        </a>
                        <a href="{{ route('faq.create-item') }}" class="ff14-button inline-flex items-center px-4 py-2">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Vraag Toevoegen
                        </a>
                    </div>
                @endif
            @endauth

            <!-- FAQ Categories -->
            @forelse($categories as $category)
                <div class="ff14-card overflow-hidden shadow-sm rounded-lg mb-6">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="ff14-text text-xl font-bold">{{ $category->name }}</h3>
                            
                            @auth
                                @if(Auth::user()->isAdmin())
                                    <div class="flex space-x-2">
                                        <form action="{{ route('faq.destroy-category', $category) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white text-sm px-3 py-2 rounded transition-colors" onclick="return confirm('Weet je zeker dat je deze categorie wilt verwijderen? Alle vragen in deze categorie worden ook verwijderd.')">
                                                Categorie Verwijderen
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            @endauth
                        </div>
                        
                        <!-- FAQ Items in this category -->
                        <div class="space-y-4">
                            @forelse($category->faqItems as $item)
                                <div class="border-l-4 border-blue-500 pl-4">
                                    <div class="flex items-start justify-between">
                                        <div class="flex-1">
                                            <h4 class="ff14-text font-semibold mb-2">{{ $item->question }}</h4>
                                            <p class="ff14-text opacity-80">{{ $item->answer }}</p>
                                        </div>
                                        
                                        @auth
                                            @if(Auth::user()->isAdmin())
                                                <div class="flex space-x-2 ml-4">
                                                    <form action="{{ route('faq.destroy-item', $item) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white text-sm px-2 py-1 rounded transition-colors" onclick="return confirm('Weet je zeker dat je deze vraag wilt verwijderen?')">
                                                            Verwijderen
                                                        </button>
                                                    </form>
                                                </div>
                                            @endif
                                        @endauth
                                    </div>
                                </div>
                            @empty
                                <p class="ff14-text opacity-60 italic">Geen vragen in deze categorie.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            @empty
                <div class="ff14-card p-8 text-center">
                    <svg class="w-16 h-16 mx-auto mb-4 ff14-accent opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="ff14-text text-xl font-bold mb-2">Nog geen FAQ</h3>
                    <p class="ff14-text opacity-80">Er zijn nog geen veelgestelde vragen toegevoegd.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
