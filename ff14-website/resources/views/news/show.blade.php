<x-app-layout>
    <x-slot name="header">
        <h2 class="ff14-text font-semibold text-xl leading-tight">
            {{ $news->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="ff14-card overflow-hidden shadow-sm rounded-lg">
                <!-- Image -->
                @if($news->image)
                    <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}" class="w-full h-96 object-cover">
                @else
                    <div class="w-full h-96 bg-gradient-to-br from-blue-400 to-purple-600 flex items-center justify-center">
                        <svg class="w-24 h-24 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                        </svg>
                    </div>
                @endif
                
                <div class="p-8">
                    <!-- Meta info -->
                    <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-200 border-opacity-20">
                        <div class="flex items-center space-x-4">
                            <span class="ff14-accent text-sm font-medium">
                                {{ $news->published_at ? $news->published_at->format('d/m/Y H:i') : 'Draft' }}
                            </span>
                            <span class="ff14-text text-sm opacity-70">
                                Door {{ $news->user->username ?? $news->user->name }}
                            </span>
                        </div>
                        
                        @auth
                            @if(Auth::user()->isAdmin())
                                <div class="flex space-x-2">
                                    <a href="{{ route('news.edit', $news) }}" class="bg-yellow-600 hover:bg-yellow-700 text-white text-sm px-3 py-2 rounded transition-colors">
                                        Bewerken
                                    </a>
                                    <form action="{{ route('news.destroy', $news) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white text-sm px-3 py-2 rounded transition-colors" onclick="return confirm('Weet je zeker dat je dit nieuws wilt verwijderen?')">
                                            Verwijderen
                                        </button>
                                    </form>
                                </div>
                            @endif
                        @endauth
                    </div>
                    
                    <!-- Content -->
                    <div class="prose prose-lg max-w-none ff14-text">
                        {!! nl2br(e($news->content)) !!}
                    </div>
                    
                    <!-- Back button -->
                    <div class="mt-8 pt-6 border-t border-gray-200 border-opacity-20">
                        <a href="{{ route('news.index') }}" class="ff14-button inline-flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Terug naar Nieuws
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
