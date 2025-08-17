<section>
    <header>
        <h2 class="text-lg font-medium ff14-text">
            {{ __('Profiel Informatie') }}
        </h2>

        <p class="mt-1 text-sm ff14-text opacity-80">
            {{ __('Update je account profielinformatie en email adres.') }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Naam')" class="ff14-text" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- Username -->
        <div>
            <x-input-label for="username" :value="__('Gebruikersnaam')" class="ff14-text" />
            <x-text-input id="username" name="username" type="text" class="mt-1 block w-full" :value="old('username', $user->username)" autocomplete="username" />
            <p class="mt-1 text-sm ff14-text opacity-70">Kies een unieke gebruikersnaam voor je profiel</p>
            <x-input-error class="mt-2" :messages="$errors->get('username')" />
        </div>

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="ff14-text" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 ff14-text opacity-80">
                        {{ __('Je email adres is niet geverifieerd.') }}

                        <button form="send-verification" class="underline text-sm ff14-accent hover:opacity-80 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            {{ __('Klik hier om de verificatie email opnieuw te versturen.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-400">
                            {{ __('Er is een nieuwe verificatie link naar je email adres gestuurd.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Birthday -->
        <div>
            <x-input-label for="birthday" :value="__('Verjaardag')" class="ff14-text" />
            <x-text-input id="birthday" name="birthday" type="date" class="mt-1 block w-full" :value="old('birthday', $user->birthday ? $user->birthday->format('Y-m-d') : '')" />
            <p class="mt-1 text-sm ff14-text opacity-70">Optioneel - je verjaardag wordt alleen op je profiel getoond</p>
            <x-input-error class="mt-2" :messages="$errors->get('birthday')" />
        </div>

        <!-- Profile Photo -->
        <div>
            <x-input-label for="profile_photo" :value="__('Profielfoto')" class="ff14-text" />
            
            @if($user->profile_photo)
                <div class="mt-2 mb-2">
                    <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="Huidige profielfoto" class="w-20 h-20 rounded-full object-cover">
                </div>
            @endif
            
            <input type="file" name="profile_photo" id="profile_photo" accept="image/*" class="mt-1 block w-full text-sm text-gray-900 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            <p class="mt-1 text-sm ff14-text opacity-70">Ondersteunde formaten: JPG, PNG, GIF (max 2MB)</p>
            <x-input-error class="mt-2" :messages="$errors->get('profile_photo')" />
        </div>

        <!-- About Me -->
        <div>
            <x-input-label for="about_me" :value="__('Over Mij')" class="ff14-text" />
            <textarea id="about_me" name="about_me" rows="4" class="mt-1 block w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm" placeholder="Vertel iets over jezelf...">{{ old('about_me', $user->about_me) }}</textarea>
            <p class="mt-1 text-sm ff14-text opacity-70">Optioneel - een korte beschrijving over jezelf</p>
            <x-input-error class="mt-2" :messages="$errors->get('about_me')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="ff14-button">{{ __('Opslaan') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm ff14-text opacity-80"
                >{{ __('Opgeslagen.') }}</p>
            @endif
        </div>
    </form>
</section>
