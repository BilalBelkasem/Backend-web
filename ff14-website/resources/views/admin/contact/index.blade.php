<x-app-layout>
    <x-slot name="header">
        <h2 class="ff14-text font-semibold text-xl leading-tight">
            Contactberichten
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="ff14-card overflow-hidden shadow-sm rounded-lg p-6">
                <table class="min-w-full">
                    <thead>
                        <tr class="ff14-text text-left">
                            <th class="p-2">Naam</th>
                            <th class="p-2">Email</th>
                            <th class="p-2">Onderwerp</th>
                            <th class="p-2">Datum</th>
                            <th class="p-2">Status</th>
                            <th class="p-2">Acties</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($messages as $message)
                            <tr class="border-t border-gray-200 border-opacity-20">
                                <td class="p-2 ff14-text">{{ $message->name }}</td>
                                <td class="p-2 ff14-text">{{ $message->email }}</td>
                                <td class="p-2 ff14-text">{{ $message->subject }}</td>
                                <td class="p-2 ff14-accent">{{ $message->created_at->format('d/m/Y H:i') }}</td>
                                <td class="p-2 ff14-text">{{ $message->replied_at ? 'Beantwoord' : 'Open' }}</td>
                                <td class="p-2">
                                    <a href="{{ route('admin.contact.show', $message) }}" class="ff14-button">Bekijken</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $messages->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


