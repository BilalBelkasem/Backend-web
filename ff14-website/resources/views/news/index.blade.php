<x-app-layout>
    <x-slot name="header">
        <h2 class="ff14-text font-semibold text-xl leading-tight">
            {{ __('Laatste Nieuws') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Admin controls -->
            @auth
                @if(Auth::user()->isAdmin())
                    <div class="mb-6">
                        <a href="{{ route('news.create') }}" class="ff14-button inline-flex items-center px-4 py-2">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Nieuws Toevoegen
                        </a>
                    </div>
                @endif
            @endauth

            <!-- News grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($news as $item)
                    <div class="ff14-card overflow-hidden shadow-sm rounded-lg">
                        @if($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gradient-to-br from-blue-400 to-purple-600 flex items-center justify-center">
                                <svg class="w-16 h-16 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                </svg>
                            </div>
                        @endif
                        
                        <div class="p-6">
                            <h3 class="ff14-text text-xl font-bold mb-2">{{ $item->title }}</h3>
                            <p class="ff14-text opacity-80 mb-4 line-clamp-3">{{ Str::limit($item->content, 120) }}</p>
                            
                            <div class="flex items-center justify-between mb-4">
                                <span class="ff14-accent text-sm">
                                    {{ $item->published_at ? $item->published_at->format('d/m/Y') : 'Draft' }}
                                </span>
                                <span class="ff14-text text-sm opacity-70">
                                    Door {{ $item->user->username ?? $item->user->name }}
                                </span>
                            </div>
                            
                            <div class="flex space-x-2">
                                <a href="{{ route('news.show', $item) }}" class="ff14-button text-sm px-3 py-2">
                                    Lees Meer
                                </a>
                                
                                @auth
                                    @if(Auth::user()->isAdmin())
                                        <a href="{{ route('news.edit', $item) }}" class="bg-yellow-600 hover:bg-yellow-700 text-white text-sm px-3 py-2 rounded transition-colors">
                                            Bewerken
                                        </a>
                                        <form action="{{ route('news.destroy', $item) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white text-sm px-3 py-2 rounded transition-colors" onclick="return confirm('Weet je zeker dat je dit nieuws wilt verwijderen?')">
                                                Verwijderen
                                            </button>
                                        </form>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full">
                        <div class="ff14-card p-8 text-center">
                            <svg class="w-16 h-16 mx-auto mb-4 ff14-accent opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <h3 class="ff14-text text-xl font-bold mb-2">Nog geen nieuws</h3>
                            <p class="ff14-text opacity-80">Er zijn nog geen nieuwsberichten gepubliceerd.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
