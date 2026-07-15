<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900">

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                            {{ session('success') }}
                        </div>
                    @endif

                    <h3 class="text-2xl font-bold mb-6">
                        Helpdesk-Pro tizimi
                    </h3>

                    <a href="/tickets/create"
                       class="inline-block bg-blue-600 text-white px-5 py-2 rounded-lg mb-6">
                        + Yangi Ticket yaratish
                    </a>

                    <h4 class="text-xl font-semibold mb-4">
                        Mening ticketlarim
                    </h4>

                    @if($tickets->count() > 0)

                        <div class="space-y-4">

                            @foreach($tickets as $ticket)

                                <div class="border rounded-lg p-5">

                                    <h5 class="text-xl font-bold">
                                        {{ $ticket->title }}
                                    </h5>

                                    <p class="mt-3">
                                        {{ $ticket->description }}
                                    </p>

                                    <p class="mt-3">
                                        <strong>Status:</strong>
                                        {{ ucfirst($ticket->status) }}
                                    </p>

                                    <p class="mb-4 text-sm text-gray-500">
                                        {{ $ticket->created_at->format('d.m.Y H:i') }}
                                    </p>

                                    <div class="flex gap-2">

                                        <a href="/tickets/{{ $ticket->id }}"
                                           class="bg-blue-600 text-white px-4 py-2 rounded">
                                            Ko'rish
                                        </a>

                                        <a href="/tickets/{{ $ticket->id }}/edit"
                                           class="bg-yellow-500 text-white px-4 py-2 rounded">
                                            Tahrirlash
                                        </a>

                                        <form action="/tickets/{{ $ticket->id }}" method="POST">

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                onclick="return confirm('Rostdan ham ticketni o‘chirmoqchimisiz?')"
                                                class="bg-red-600 text-white px-4 py-2 rounded">
                                                O'chirish
                                            </button>

                                        </form>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    @else

                        <p>
                            Hozircha ticketlar yo'q.
                        </p>

                    @endif

                </div>

            </div>

        </div>

    </div>

</x-app-layout>