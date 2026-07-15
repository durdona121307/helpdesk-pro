<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-gray-800">
                🛠️ Admin Dashboard
            </h2>

            <span class="bg-blue-600 text-white px-4 py-2 rounded-lg">
                Administrator
            </span>
        </div>
    </x-slot>

    <div class="py-10">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-5 py-4 rounded-lg">
                    ✅ {{ session('success') }}
                </div>
            @endif


            <!-- STATISTICS -->

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

                <div class="bg-gradient-to-r from-blue-500 to-blue-700 text-white rounded-xl shadow-lg p-6">

                    <h3 class="text-lg font-semibold">
                        📂 Open Tickets
                    </h3>

                    <p class="text-5xl font-bold mt-4">
                        {{ $openTickets }}
                    </p>

                </div>



                <div class="bg-gradient-to-r from-yellow-400 to-orange-500 text-white rounded-xl shadow-lg p-6">

                    <h3 class="text-lg font-semibold">
                        ⏳ In Progress
                    </h3>

                    <p class="text-5xl font-bold mt-4">
                        {{ $inProgressTickets }}
                    </p>

                </div>



                <div class="bg-gradient-to-r from-green-500 to-emerald-700 text-white rounded-xl shadow-lg p-6">

                    <h3 class="text-lg font-semibold">
                        ✅ Closed Tickets
                    </h3>

                    <p class="text-5xl font-bold mt-4">
                        {{ $closedTickets }}
                    </p>

                </div>

            </div>


            <!-- TICKETS -->

            <div class="bg-white rounded-xl shadow-lg">

                <div class="border-b p-6">

                    <h3 class="text-2xl font-bold">
                        📋 Barcha Ticketlar
                    </h3>

                </div>


                <div class="p-6">

                    @forelse($tickets as $ticket)

                        <div class="border rounded-xl shadow-sm p-6 mb-6 hover:shadow-lg transition">

                            <div class="flex justify-between">

                                <div>

                                    <h3 class="text-2xl font-bold">
                                        {{ $ticket->title }}
                                    </h3>

                                    <p class="text-gray-600 mt-2">
                                        {{ $ticket->description }}
                                    </p>

                                </div>

                                <div>

                                    @if($ticket->status=="open")

                                        <span class="bg-blue-100 text-blue-700 px-4 py-2 rounded-full">
                                            Open
                                        </span>

                                    @elseif($ticket->status=="in_progress")

                                        <span class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full">
                                            In Progress
                                        </span>

                                    @else

                                        <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full">
                                            Closed
                                        </span>

                                    @endif

                                </div>

                            </div>


                            <hr class="my-5">


                            <div class="grid md:grid-cols-2 gap-4">

                                <div>

                                    <p>
                                        <strong>👤 Foydalanuvchi:</strong>

                                        {{ $ticket->user->name }}
                                    </p>

                                    <p class="mt-2">

                                        <strong>📧 Email:</strong>

                                        {{ $ticket->user->email }}

                                    </p>

                                </div>

                                <div>

                                    <form method="POST"
                                          action="/admin/tickets/{{ $ticket->id }}/status">

                                        @csrf
                                        @method('PUT')

                                        <label class="font-semibold">
                                            Statusni o'zgartirish
                                        </label>

                                        <div class="flex mt-3">

                                            <select
                                                name="status"
                                                class="border rounded-lg px-4 py-2 w-full">

                                                <option value="open"
                                                    {{ $ticket->status=='open' ? 'selected':'' }}>
                                                    Open
                                                </option>

                                                <option value="in_progress"
                                                    {{ $ticket->status=='in_progress' ? 'selected':'' }}>
                                                    In Progress
                                                </option>

                                                <option value="closed"
                                                    {{ $ticket->status=='closed' ? 'selected':'' }}>
                                                    Closed
                                                </option>

                                            </select>


                                            <button
                                                class="ml-3 bg-blue-600 hover:bg-blue-700 text-white px-6 rounded-lg">

                                                💾 Saqlash

                                            </button>

                                        </div>

                                    </form>

                                </div>

                            </div>


                            <div class="mt-6 flex gap-3">

                                <a href="/tickets/{{ $ticket->id }}"
                                   class="bg-gray-800 hover:bg-black text-white px-5 py-2 rounded-lg">

                                    👁 Ticketni ko'rish

                                </a>

                            </div>

                        </div>

                    @empty

                        <div class="text-center py-10">

                            <h3 class="text-2xl font-bold text-gray-500">

                                Hozircha ticketlar mavjud emas.

                            </h3>

                        </div>

                    @endforelse

                </div>

            </div>

        </div>

    </div>

</x-app-layout>