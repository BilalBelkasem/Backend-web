<x-app-layout>
    <x-slot name="header">
        <h2 class="ff14-text font-semibold text-xl leading-tight">
            {{ $user->name }}'s Profiel
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="ff14-card overflow-hidden shadow-sm rounded-lg">
                <div class="p-8">
                    <!-- Profile Header -->
                    <div class="text-center mb-8">
                        <div class="mb-4">
                            @if($user->profile_photo)
                                <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="Profile photo" class="w-32 h-32 rounded-full object-cover mx-auto border-4 border-blue-200">
                            @else
                                <div class="w-32 h-32 rounded-full bg-gray-300 flex items-center justify-center mx-auto border-4 border-blue-200">
                                    <span class="text-gray-600 font-bold text-4xl">{{ substr($user->name, 0, 1) }}</span>
                                </div>
                            @endif
                        </div>
                        
                        <h1 class="ff14-text text-3xl font-bold mb-2">{{ $user->name }}</h1>
                        
                        @if($user->username)
                            <p class="ff14-text text-lg opacity-80 mb-2">@{{ $user->username }}</p>
                        @endif
                        
                        @if($user->is_admin)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                                Administrator
                            </span>
                        @endif
                    </div>

                    <!-- Profile Information -->
                    <div class="grid md:grid-cols-2 gap-8">
                        <!-- Left Column -->
                        <div class="space-y-6">
                            @if($user->birthday)
                                <div class="ff14-card p-4">
                                    <div class="flex items-center">
                                        <svg class="w-6 h-6 ff14-accent mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <div>
                                            <h3 class="ff14-text font-semibold">Verjaardag</h3>
                                            <p class="ff14-text opacity-80">{{ $user->birthday->format('d F Y') }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if($user->about_me)
                                <div class="ff14-card p-4">
                                    <div class="flex items-start">
                                        <svg class="w-6 h-6 ff14-accent mr-3 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                        </svg>
                                        <div>
                                            <h3 class="ff14-text font-semibold mb-2">Over Mij</h3>
                                            <p class="ff14-text opacity-80">{{ $user->about_me }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="ff14-card p-4">
                                <div class="flex items-center">
                                    <svg class="w-6 h-6 ff14-accent mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    <div>
                                        <h3 class="ff14-text font-semibold">Lid sinds</h3>
                                        <p class="ff14-text opacity-80">{{ $user->created_at->format('F Y') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="space-y-6">
                            <!-- Latest News by this user (if admin) -->
                            @if($user->is_admin && $user->news->count() > 0)
                                <div class="ff14-card p-4">
                                    <h3 class="ff14-text font-semibold mb-3 flex items-center">
                                        <svg class="w-5 h-5 ff14-accent mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                        </svg>
                                        Laatste Nieuws
                                    </h3>
                                    <div class="space-y-3">
                                        @foreach($user->news->take(3) as $news)
                                            <div class="border-l-4 border-blue-500 pl-3">
                                                <h4 class="ff14-text font-medium text-sm">{{ $news->title }}</h4>
                                                <p class="ff14-text opacity-60 text-xs">{{ $news->published_at ? $news->published_at->format('d/m/Y') : 'Draft' }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- Contact Info -->
                            <div class="ff14-card p-4">
                                <h3 class="ff14-text font-semibold mb-3 flex items-center">
                                    <svg class="w-5 h-5 ff14-accent mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                    Contact
                                </h3>
                                <p class="ff14-text opacity-80 text-sm">{{ $user->email }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Back Button -->
                    <div class="text-center mt-8">
                        <a href="{{ url()->previous() }}" class="ff14-button inline-flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Terug
                        </a>
                    </div>

                    <!-- Wall Posts & Private Message -->
                    <div class="mt-10 grid md:grid-cols-2 gap-8">
                        <div class="ff14-card p-6">
                            <h3 class="ff14-text font-semibold mb-3">Muurberichten</h3>
                            @auth
                                @if(Auth::id() !== $user->id)
                                    <form action="{{ route('profile.post', $user->username) }}" method="POST" class="mb-4">
                                        @csrf
                                        <textarea name="content" rows="3" class="w-full ff14-card ff14-text rounded p-3" placeholder="Laat een bericht achter..." required>{{ old('content') }}</textarea>
                                        @error('content')
                                            <p class="text-red-500 text-sm">{{ $message }}</p>
                                        @enderror
                                        <button class="ff14-button mt-2">Plaatsen</button>
                                    </form>
                                @endif
                            @endauth

                            <div class="space-y-3">
                                @forelse($user->profilePosts as $post)
                                    <div class="ff14-card p-4 rounded flex justify-between">
                                        <div>
                                            <div class="ff14-text text-sm font-semibold">
                                                {{ $post->author->username ?? $post->author->name }}
                                                <span class="ff14-accent text-xs font-normal ml-2">{{ $post->created_at->diffForHumans() }}</span>
                                            </div>
                                            <div class="ff14-text mt-1">{!! nl2br(e($post->content)) !!}</div>
                                        </div>
                                        @auth
                                            @if(Auth::id() === $post->author_user_id || Auth::id() === $post->profile_user_id || Auth::user()->isAdmin())
                                                <form action="{{ route('profile.post.destroy', $post) }}" method="POST" onsubmit="return confirm('Verwijderen?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="text-red-500 hover:text-red-600 text-sm">Verwijderen</button>
                                                </form>
                                            @endif
                                        @endauth
                                    </div>
                                @empty
                                    <p class="ff14-text text-sm opacity-75">Nog geen berichten.</p>
                                @endforelse
                            </div>
                        </div>

                        <div class="ff14-card p-6">
                            <h3 class="ff14-text font-semibold mb-3">Privébericht sturen</h3>
                            @auth
                                @if(Auth::id() !== $user->id)
                                    <form action="{{ route('messages.store', $user->username) }}" method="POST">
                                        @csrf
                                        <textarea name="content" rows="3" class="w-full ff14-card ff14-text rounded p-3" placeholder="Schrijf een privébericht..." required>{{ old('content') }}</textarea>
                                        @error('content')
                                            <p class="text-red-500 text-sm">{{ $message }}</p>
                                        @enderror
                                        <button class="ff14-button mt-2">Versturen</button>
                                    </form>
                                    <a href="{{ route('messages.inbox') }}" class="ff14-text underline text-sm mt-3 inline-block">Ga naar je inbox</a>
                                @else
                                    <p class="ff14-text text-sm opacity-75">Je kunt jezelf geen bericht sturen.</p>
                                @endif
                            @else
                                <p class="ff14-text text-sm opacity-75">Log in om een bericht te sturen.</p>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
