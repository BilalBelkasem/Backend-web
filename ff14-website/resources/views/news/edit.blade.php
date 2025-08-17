<x-app-layout>
    <x-slot name="header">
        <h2 class="ff14-text font-semibold text-xl leading-tight">
            {{ __('Nieuws Bewerken') }}: {{ $news->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="ff14-card overflow-hidden shadow-sm rounded-lg">
                <div class="p-6">
                    <form action="{{ route('news.update', $news) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <!-- Title -->
                        <div class="mb-6">
                            <label for="title" class="block ff14-text text-sm font-medium mb-2">
                                Titel *
                            </label>
                            <input type="text" name="title" id="title" value="{{ old('title', $news->title) }}" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white text-gray-900">
                            @error('title')
                                <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Current Image -->
                        @if($news->image)
                            <div class="mb-6">
                                <label class="block ff14-text text-sm font-medium mb-2">
                                    Huidige Afbeelding
                                </label>
                                <div class="flex items-center space-x-4">
                                    <img src="{{ asset('storage/' . $news->image) }}" alt="Huidige afbeelding" class="w-32 h-32 object-cover rounded">
                                    <div>
                                        <p class="ff14-text text-sm opacity-70">Huidige afbeelding wordt behouden als je geen nieuwe selecteert</p>
                                        <label class="inline-flex items-center mt-2">
                                            <input type="checkbox" name="remove_image" value="1" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                            <span class="ml-2 ff14-text text-sm">Afbeelding verwijderen</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- New Image -->
                        <div class="mb-6">
                            <label for="image" class="block ff14-text text-sm font-medium mb-2">
                                Nieuwe Afbeelding
                            </label>
                            <input type="file" name="image" id="image" accept="image/*"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white text-gray-900">
                            <p class="mt-1 ff14-text text-sm opacity-70">Ondersteunde formaten: JPG, PNG, GIF (max 2MB)</p>
                            @error('image')
                                <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Content -->
                        <div class="mb-6">
                            <label for="content" class="block ff14-text text-sm font-medium mb-2">
                                Inhoud *
                            </label>
                            <textarea name="content" id="content" rows="8" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white text-gray-900">{{ old('content', $news->content) }}</textarea>
                            @error('content')
                                <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Published Date -->
                        <div class="mb-6">
                            <label for="published_at" class="block ff14-text text-sm font-medium mb-2">
                                Publicatiedatum
                            </label>
                            <input type="datetime-local" name="published_at" id="published_at" 
                                value="{{ old('published_at', $news->published_at ? $news->published_at->format('Y-m-d\TH:i') : '') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white text-gray-900">
                            <p class="mt-1 ff14-text text-sm opacity-70">Laat leeg voor draft status</p>
                            @error('published_at')
                                <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit buttons -->
                        <div class="flex items-center justify-between">
                            <a href="{{ route('news.show', $news) }}" class="ff14-text hover:ff14-accent transition-colors">
                                ← Terug naar Nieuws
                            </a>
                            
                            <div class="flex space-x-3">
                                <button type="submit" class="ff14-button">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Wijzigingen Opslaan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
