<nav x-data="{ open: false }" class="ff14-card border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="ff14-text text-2xl font-bold">
                        🎮 FF14 Community
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <a href="{{ route('news.index') }}" class="ff14-text hover:ff14-accent px-3 py-2 rounded-md text-sm font-medium">
                        📰 Nieuws
                    </a>
                    <a href="{{ route('faq.index') }}" class="ff14-text hover:ff14-accent px-3 py-2 rounded-md text-sm font-medium">
                        ❓ FAQ
                    </a>
                    <a href="{{ route('contact.index') }}" class="ff14-text hover:ff14-accent px-3 py-2 rounded-md text-sm font-medium">
                        📧 Contact
                    </a>
                    @auth
                        <a href="{{ route('dashboard') }}" class="ff14-text hover:ff14-accent px-3 py-2 rounded-md text-sm font-medium">
                            🏠 Dashboard
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md ff14-text ff14-card hover:ff14-accent focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name ?? Auth::user()->username ?? 'Speler' }}</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            @if(Auth::user()->isAdmin())
                                <x-dropdown-link :href="route('admin.users.index')">
                                    👥 Gebruikers Beheren
                                </x-dropdown-link>
                            @endif

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <div class="flex space-x-4">
                        <a href="{{ route('login') }}" class="ff14-button">
                            Log in
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ff14-button">
                                Registreer
                            </a>
                        @endif
                    </div>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md ff14-text hover:ff14-accent focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('news.index') }}" class="ff14-text hover:ff14-accent block px-3 py-2 rounded-md text-base font-medium">
                📰 Nieuws
            </a>
            <a href="{{ route('faq.index') }}" class="ff14-text hover:ff14-accent block px-3 py-2 rounded-md text-base font-medium">
                ❓ FAQ
            </a>
            <a href="{{ route('contact.index') }}" class="ff14-text hover:ff14-accent block px-3 py-2 rounded-md text-base font-medium">
                📧 Contact
            </a>
            @auth
                <a href="{{ route('dashboard') }}" class="ff14-text hover:ff14-accent block px-3 py-2 rounded-md text-base font-medium">
                    🏠 Dashboard
                </a>
            @endauth
        </div>

        <!-- Responsive Settings Options -->
        @auth
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base ff14-text">{{ Auth::user()->name ?? Auth::user()->username ?? 'Speler' }}</div>
                    <div class="font-medium text-sm ff14-accent">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @else
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4 space-y-2">
                    <a href="{{ route('login') }}" class="ff14-button block text-center">
                        Log in
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ff14-button block text-center">
                            Registreer
                        </a>
                    @endif
                </div>
            </div>
        @endauth
    </div>
</nav>
