<x-app-layout>
    <x-slot name="header">
        <h2 class="ff14-text font-semibold text-xl leading-tight">
            {{ __('FAQ Categorie Toevoegen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="ff14-card overflow-hidden shadow-sm rounded-lg">
                <div class="p-6">
                    <form action="{{ route('faq.store-category') }}" method="POST">
                        @csrf
                        
                        <!-- Category Name -->
                        <div class="mb-6">
                            <label for="name" class="block ff14-text text-sm font-medium mb-2">
                                Categorie Naam *
                            </label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white text-gray-900"
                                placeholder="Bijv. Algemene Vragen, Technische Problemen, etc.">
                            @error('name')
                                <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit buttons -->
                        <div class="flex items-center justify-between">
                            <a href="{{ route('faq.index') }}" class="ff14-text hover:ff14-accent transition-colors">
                                ← Terug naar FAQ
                            </a>
                            
                            <button type="submit" class="ff14-button">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Categorie Opslaan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
