<x-app-layout>
    <x-slot name="header">
        <h2 class="ff14-text font-semibold text-xl leading-tight">
            Mijn Inbox
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="ff14-card overflow-hidden shadow-sm rounded-lg p-6">
                <div class="space-y-4">
                    @forelse($messages as $message)
                        <div class="ff14-card p-4 rounded">
                            <div class="flex items-center justify-between">
                                <div>
                                    <div class="ff14-text text-sm">
                                        Van <strong>{{ $message->sender->username ?? $message->sender->name }}</strong>
                                        <span class="ff14-accent text-xs ml-2">{{ $message->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                                <div class="text-right">
                                    @if(!$message->read_at)
                                        <form action="{{ route('messages.read', $message) }}" method="POST">
                                            @csrf
                                            <button class="ff14-button">Markeer als gelezen</button>
                                        </form>
                                    @else
                                        <span class="ff14-accent text-xs">Gelezen</span>
                                    @endif
                                </div>
                            </div>
                            <div class="ff14-text mt-2">{!! nl2br(e($message->content)) !!}</div>
                        </div>
                    @empty
                        <p class="ff14-text">Geen berichten.</p>
                    @endforelse
                </div>

                <div class="mt-4">
                    {{ $messages->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


