<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ticket tafsilotlari
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


                    <h3 class="text-2xl font-bold mb-4">
                        {{ $ticket->title }}
                    </h3>


                    <div class="mb-6">
                        <strong>Muammo tavsifi:</strong>

                        <p class="mt-2">
                            {{ $ticket->description }}
                        </p>
                    </div>


                    <div class="mb-6">
                        <strong>Status:</strong>

                        {{ $ticket->status }}
                    </div>


                    <div class="mb-8">
                        <strong>Yaratilgan sana:</strong>

                        {{ $ticket->created_at->format('d.m.Y H:i') }}
                    </div>

                    <hr class="mb-6">

                    <h4 class="text-xl font-semibold mb-4">
                        Izohlar
                    </h4>

                    @if($ticket->comments->count() > 0)

                        <div class="space-y-4 mb-8">

                            @foreach($ticket->comments as $comment)

                                <div class="border p-4 rounded-lg">

                                    <p>
                                        {{ $comment->message }}
                                    </p>

                                    <p class="text-sm mt-2">
                                        <strong>Yozgan:</strong>
                                        {{ $comment->user->name }}
                                    </p>

                                    <p class="text-sm text-gray-500">
                                        {{ $comment->created_at->format('d.m.Y H:i') }}
                                    </p>

                                </div>

                            @endforeach

                        </div>

                    @else

                        <p class="mb-8">
                            Hozircha izohlar yo‘q.
                        </p>

                    @endif


                    <hr class="mb-6">


                    <h4 class="text-xl font-semibold mb-4">
                        Yangi izoh yozish
                    </h4>


                    <form action="/tickets/{{ $ticket->id }}/comments" method="POST">

                        @csrf

                        <textarea
                            name="message"
                            rows="5"
                            class="w-full border rounded-lg p-3"
                            placeholder="Izohingizni yozing..."
                            required></textarea>

                        @error('message')
                            <p class="text-red-600 mt-2">
                                {{ $message }}
                            </p>
                        @enderror

                        <button
                            type="submit"
                            class="mt-4 bg-blue-600 text-white px-5 py-2 rounded-lg">
                            Izoh yuborish
                        </button>

                    </form>


                    <br>


                    <a href="/dashboard"
                       class="inline-block bg-gray-600 text-white px-4 py-2 rounded">
                        ← Ortga qaytish
                    </a>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>