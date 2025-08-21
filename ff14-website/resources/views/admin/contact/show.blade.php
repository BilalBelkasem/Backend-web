<x-app-layout>
    <x-slot name="header">
        <h2 class="ff14-text font-semibold text-xl leading-tight">
            Bericht van {{ $message->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="ff14-card overflow-hidden shadow-sm rounded-lg p-6 space-y-6">
                <div>
                    <div class="ff14-text"><strong>Onderwerp:</strong> {{ $message->subject }}</div>
                    <div class="ff14-text"><strong>Email:</strong> {{ $message->email }}</div>
                    <div class="ff14-accent text-sm">Verstuurd op {{ $message->created_at->format('d/m/Y H:i') }}</div>
                </div>

                <div>
                    <div class="ff14-text font-semibold mb-2">Bericht</div>
                    <div class="ff14-card p-4 rounded">{!! nl2br(e($message->message)) !!}</div>
                </div>

                <div class="border-t border-gray-200 border-opacity-20 pt-4">
                    <div class="ff14-text font-semibold mb-2">Antwoord</div>

                    @if($message->admin_reply)
                        <div class="ff14-card p-4 rounded mb-4">
                            <div class="ff14-accent text-sm mb-1">Beantwoord op {{ $message->replied_at?->format('d/m/Y H:i') }}</div>
                            <div>{!! nl2br(e($message->admin_reply)) !!}</div>
                        </div>
                    @endif

                    <form action="{{ route('admin.contact.reply', $message) }}" method="POST" class="space-y-3">
                        @csrf
                        <textarea name="admin_reply" rows="5" class="w-full ff14-card ff14-text rounded p-3" placeholder="Schrijf een antwoord..." required>{{ old('admin_reply', $message->admin_reply) }}</textarea>
                        @error('admin_reply')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                        <button type="submit" class="ff14-button">Verstuur Antwoord</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


