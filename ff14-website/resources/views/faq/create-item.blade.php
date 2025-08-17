<x-app-layout>
    <x-slot name="header">
        <h2 class="ff14-text font-semibold text-xl leading-tight">
            {{ __('FAQ Vraag Toevoegen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="ff14-card overflow-hidden shadow-sm rounded-lg">
                <div class="p-6">
                    <form action="{{ route('faq.store-item') }}" method="POST">
                        @csrf
                        
                        <!-- Category -->
                        <div class="mb-6">
                            <label for="faq_category_id" class="block ff14-text text-sm font-medium mb-2">
                                Categorie *
                            </label>
                            <select name="faq_category_id" id="faq_category_id" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white text-gray-900">
                                <option value="">Selecteer een categorie</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('faq_category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('faq_category_id')
                                <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Question -->
                        <div class="mb-6">
                            <label for="question" class="block ff14-text text-sm font-medium mb-2">
                                Vraag *
                            </label>
                            <input type="text" name="question" id="question" value="{{ old('question') }}" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white text-gray-900"
                                placeholder="Stel je vraag hier...">
                            @error('question')
                                <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Answer -->
                        <div class="mb-6">
                            <label for="answer" class="block ff14-text text-sm font-medium mb-2">
                                Antwoord *
                            </label>
                            <textarea name="answer" id="answer" rows="6" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white text-gray-900"
                                placeholder="Geef hier je antwoord...">{{ old('answer') }}</textarea>
                            @error('answer')
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
                                Vraag Opslaan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
