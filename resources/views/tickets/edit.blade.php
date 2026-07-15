<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ticketni tahrirlash
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6">

                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="/tickets/{{ $ticket->id }}" method="POST">

                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="block font-semibold mb-2">
                                Sarlavha
                            </label>

                            <input
                                type="text"
                                name="title"
                                value="{{ old('title', $ticket->title) }}"
                                class="w-full border rounded-lg p-3"
                                required>
                        </div>

                        <div class="mb-4">
                            <label class="block font-semibold mb-2">
                                Muammo tavsifi
                            </label>

                            <textarea
                                name="description"
                                rows="6"
                                class="w-full border rounded-lg p-3"
                                required>{{ old('description', $ticket->description) }}</textarea>
                        </div>

                        <div class="mb-6">
                            <label class="block font-semibold mb-2">
                                Status
                            </label>

                            <select
                                name="status"
                                class="w-full border rounded-lg p-3">

                                <option value="open" {{ $ticket->status == 'open' ? 'selected' : '' }}>
                                    Open
                                </option>

                                <option value="in_progress" {{ $ticket->status == 'in_progress' ? 'selected' : '' }}>
                                    In Progress
                                </option>

                                <option value="closed" {{ $ticket->status == 'closed' ? 'selected' : '' }}>
                                    Closed
                                </option>

                            </select>
                        </div>

                        <button
                            type="submit"
                            class="bg-blue-600 text-white px-5 py-2 rounded-lg">
                            Saqlash
                        </button>

                        <a
                            href="/tickets/{{ $ticket->id }}"
                            class="ml-3 bg-gray-600 text-white px-5 py-2 rounded-lg">
                            Bekor qilish
                        </a>

                    </form>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>