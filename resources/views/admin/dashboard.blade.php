<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-3xl font-bold text-gray-800">
                🛠️ Admin Dashboard
            </h2>

            <span class="bg-indigo-600 text-white px-4 py-2 rounded-lg shadow">
                Administrator
            </span>
        </div>
    </x-slot>

    <div class="py-10">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-6 rounded-lg bg-green-100 border border-green-400 text-green-700 px-5 py-4">
                    ✅ {{ session('success') }}
                </div>
            @endif

            <!-- Statistics -->

            <div class="grid grid-cols-1 md:grid-cols-5 gap-5 mb-8">

                <div class="bg-blue-600 text-white rounded-xl shadow-lg p-6">
                    <p class="text-sm uppercase">Jami Ticket</p>
                    <h2 class="text-4xl font-bold mt-3">
                        {{ $totalTickets }}
                    </h2>
                </div>

                <div class="bg-cyan-600 text-white rounded-xl shadow-lg p-6">
                    <p class="text-sm uppercase">Open</p>
                    <h2 class="text-4xl font-bold mt-3">
                        {{ $openTickets }}
                    </h2>
                </div>

                <div class="bg-yellow-500 text-white rounded-xl shadow-lg p-6">
                    <p class="text-sm uppercase">In Progress</p>
                    <h2 class="text-4xl font-bold mt-3">
                        {{ $inProgressTickets }}
                    </h2>
                </div>

                <div class="bg-green-600 text-white rounded-xl shadow-lg p-6">
                    <p class="text-sm uppercase">Closed</p>
                    <h2 class="text-4xl font-bold mt-3">
                        {{ $closedTickets }}
                    </h2>
                </div>

                <div class="bg-purple-600 text-white rounded-xl shadow-lg p-6">
                    <p class="text-sm uppercase">Users</p>
                    <h2 class="text-4xl font-bold mt-3">
                        {{ $usersCount }}
                    </h2>
                </div>

            </div>

            <!-- Search -->

            <div class="bg-white rounded-xl shadow-lg mb-8">

                <div class="p-6">

                    <form method="GET"
                          action="action="/admin/dashboard">

                        <div class="grid md:grid-cols-3 gap-4">

                            <div>

                                <label class="font-semibold">
                                    🔍 Search
                                </label>

                                <input
                                    type="text"
                                    name="search"
                                    value="{{ request('search') }}"
                                    placeholder="Ticket, user yoki email..."

                                    class="mt-2 w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">

                            </div>

                            <div>

                                <label class="font-semibold">
                                    🎯 Status
                                </label>

                                <select
                                    name="status"
                                    class="mt-2 w-full border rounded-lg px-4 py-3">

                                    <option value="">
                                        Barchasi
                                    </option>

                                    <option value="open"
                                        {{ request('status')=='open' ? 'selected':'' }}>
                                        Open
                                    </option>

                                    <option value="in_progress"
                                        {{ request('status')=='in_progress' ? 'selected':'' }}>
                                        In Progress
                                    </option>

                                    <option value="closed"
                                        {{ request('status')=='closed' ? 'selected':'' }}>
                                        Closed
                                    </option>

                                </select>

                            </div>

                            <div class="flex items-end gap-3">

                                <button
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg">

                                    Search

                                </button>

                                <a href="<a href="/admin/dashboard""
                                   class="bg-gray-500 hover:bg-gray-700 text-white px-6 py-3 rounded-lg">

                                    Reset

                                </a>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

            <!-- Tickets -->

            <div class="bg-white rounded-xl shadow-lg">

                <div class="border-b p-6">

                    <h2 class="text-2xl font-bold">
                        📋 Ticketlar
                    </h2>

                </div>

                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead class="bg-gray-100">

                        <tr>

                            <th class="p-4 text-left">
                                #
                            </th>

                            <th class="p-4 text-left">
                                Title
                            </th>

                            <th class="p-4 text-left">
                                User
                            </th>

                            <th class="p-4 text-left">
                                Status
                            </th>

                            <th class="p-4 text-left">
                                Created
                            </th>

                            <th class="p-4 text-center">
                                Action
                            </th>

                        </tr>

                        </thead>

                        <tbody>

                            @forelse($tickets as $ticket)
                                                            <tr class="border-b hover:bg-gray-50">

                                    <td class="p-4">
                                        {{ $ticket->id }}
                                    </td>

                                    <td class="p-4">

                                        <div class="font-bold">
                                            {{ $ticket->title }}
                                        </div>

                                        <div class="text-sm text-gray-500 mt-1">
                                            {{ \Illuminate\Support\Str::limit($ticket->description,60) }}
                                        </div>

                                    </td>

                                    <td class="p-4">

                                        <div class="font-semibold">
                                            {{ $ticket->user->name }}
                                        </div>

                                        <div class="text-sm text-gray-500">
                                            {{ $ticket->user->email }}
                                        </div>

                                    </td>

                                    <td class="p-4">

                                        @if($ticket->status=='open')

                                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">
                                                Open
                                            </span>

                                        @elseif($ticket->status=='in_progress')

                                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">
                                                In Progress
                                            </span>

                                        @else

                                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                                Closed
                                            </span>

                                        @endif

                                    </td>

                                    <td class="p-4">
                                        {{ $ticket->created_at->format('d.m.Y H:i') }}
                                    </td>

                                    <td class="p-4">

                                        <div class="flex gap-2 justify-center">

                                            <a href="/tickets/{{ $ticket->id }}"
                                               class="bg-gray-700 hover:bg-black text-white px-3 py-2 rounded-lg">

                                                👁

                                            </a>

                                            <form action="/admin/tickets/{{ $ticket->id }}/status"
                                                  method="POST">

                                                @csrf
                                                @method('PUT')

                                                <select
                                                    name="status"
                                                    onchange="this.form.submit()"
                                                    class="border rounded-lg px-2 py-2">

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

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="6"
                                        class="text-center py-10 text-gray-500">

                                        Hozircha ticket mavjud emas.

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                <div class="p-6 border-t">

                    {{ $tickets->links() }}

                </div>

            </div>

        </div>

    </div>

</x-app-layout>