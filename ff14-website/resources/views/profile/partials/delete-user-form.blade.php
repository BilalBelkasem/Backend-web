<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium ff14-text">
            {{ __('Account Verwijderen') }}
        </h2>

        <p class="mt-1 text-sm ff14-text opacity-80">
            {{ __('Zodra je account wordt verwijderd, worden alle bijbehorende gegevens permanent verwijderd. Download voordat je je account verwijdert alle gegevens of informatie die je wilt behouden.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md transition-colors"
    >{{ __('Account Verwijderen') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium ff14-text">
                {{ __('Weet je zeker dat je je account wilt verwijderen?') }}
            </h2>

            <p class="mt-1 text-sm ff14-text opacity-80">
                {{ __('Zodra je account wordt verwijderd, worden alle bijbehorende gegevens permanent verwijderd. Voer je wachtwoord in om te bevestigen dat je je account permanent wilt verwijderen.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Wachtwoord') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Wachtwoord') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')" class="ff14-text border border-gray-300 hover:bg-gray-50 px-4 py-2 rounded-md transition-colors">
                    {{ __('Annuleren') }}
                </x-secondary-button>

                <x-danger-button class="ms-3 bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md transition-colors">
                    {{ __('Account Verwijderen') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
