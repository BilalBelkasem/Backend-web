<x-app-layout>
    <x-slot name="header">
        <h2 class="ff14-text font-semibold text-xl leading-tight">
            {{ __('Contact') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="ff14-card overflow-hidden shadow-sm rounded-lg">
                <div class="p-8">
                    <!-- Contact Info -->
                    <div class="mb-8 text-center">
                        <svg class="w-6 h-6 mx-auto mb-4 ff14-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <h3 class="ff14-text text-2xl font-bold mb-2">Neem Contact Op</h3>
                        <p class="ff14-text opacity-80">Heb je een vraag of opmerking? Stuur ons een bericht!</p>
                    </div>

                    <!-- Contact Form -->
                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <!-- Name -->
                        <div>
                            <label for="name" class="block ff14-text text-sm font-medium mb-2">
                                Naam *
                            </label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white text-gray-900"
                                placeholder="Jouw naam">
                            @error('name')
                                <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block ff14-text text-sm font-medium mb-2">
                                Email *
                            </label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white text-gray-900"
                                placeholder="jouw@email.com">
                            @error('email')
                                <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Subject -->
                        <div>
                            <label for="subject" class="block ff14-text text-sm font-medium mb-2">
                                Onderwerp *
                            </label>
                            <input type="text" name="subject" id="subject" value="{{ old('subject') }}" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white text-gray-900"
                                placeholder="Waar gaat je bericht over?">
                            @error('subject')
                                <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Message -->
                        <div>
                            <label for="message" class="block ff14-text text-sm font-medium mb-2">
                                Bericht *
                            </label>
                            <textarea name="message" id="message" rows="6" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white text-gray-900"
                                placeholder="Schrijf hier je bericht...">{{ old('message') }}</textarea>
                            @error('message')
                                <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center">
                            <button type="submit" class="ff14-button text-lg px-8 py-3">
                                <svg class="w-6 h-6 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                </svg>
                                Bericht Versturen
                            </button>
                        </div>
                    </form>

                    <!-- Success Message -->
                    @if(session('success'))
                        <div class="mt-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                {{ session('success') }}
                            </div>
                        </div>
                    @endif

                    <!-- Additional Info (smaller and side by side) -->
                    <div class="mt-8 flex flex-col md:flex-row justify-center gap-4">
                        <div class="ff14-card p-4 text-center flex-1">
                            <svg class="w-6 h-6 mx-auto mb-2 ff14-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <h4 class="ff14-text font-semibold mb-1 text-base">Snelle Reactie</h4>
                            <p class="ff14-text opacity-80 text-xs">We proberen binnen 24 uur te reageren</p>
                        </div>
                        <div class="ff14-card p-4 text-center flex-1">
                            <svg class="w-6 h-6 mx-auto mb-2 ff14-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <h4 class="ff14-text font-semibold mb-1 text-base">Betrouwbaar</h4>
                            <p class="ff14-text opacity-80 text-xs">Je gegevens zijn veilig bij ons</p>
                        </div>
                        <div class="ff14-card p-4 text-center flex-1">
                            <svg class="w-6 h-6 mx-auto mb-2 ff14-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M12 2.25a9.75 9.75 0 100 19.5 9.75 9.75 0 000-19.5z"></path>
                            </svg>
                            <h4 class="ff14-text font-semibold mb-1 text-base">24/7 Beschikbaar</h4>
                            <p class="ff14-text opacity-80 text-xs">Stuur je bericht wanneer je wilt</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
