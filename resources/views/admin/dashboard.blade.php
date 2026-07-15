<x-app-layout>

    <x-slot name="header">

        <div class="flex justify-between items-center">

            <div>
                <h2 class="text-3xl font-bold text-gray-800">
                    🛠 Admin Dashboard
                </h2>

                <p class="text-gray-500 mt-1">
                    Helpdesk tizimini boshqarish paneli
                </p>
            </div>


            <span class="bg-indigo-600 text-white px-5 py-2 rounded-xl shadow">
                Administrator
            </span>

        </div>

    </x-slot>



    <div class="py-10">


        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">



            @if(session('success'))

                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-5 py-4 rounded-xl">

                    ✅ {{ session('success') }}

                </div>

            @endif




            <!-- Statistics -->


            <div class="grid grid-cols-1 md:grid-cols-5 gap-5 mb-8">


                <div class="bg-white rounded-2xl shadow p-6 border-l-4 border-blue-600">

                    <p class="text-gray-500">
                        Jami Ticket
                    </p>

                    <h2 class="text-4xl font-bold mt-3">
                        {{ $totalTickets }}
                    </h2>

                </div>



                <div class="bg-white rounded-2xl shadow p-6 border-l-4 border-cyan-500">

                    <p class="text-gray-500">
                        Open
                    </p>

                    <h2 class="text-4xl font-bold mt-3">
                        {{ $openTickets }}
                    </h2>

                </div>



                <div class="bg-white rounded-2xl shadow p-6 border-l-4 border-yellow-500">

                    <p class="text-gray-500">
                        In Progress
                    </p>

                    <h2 class="text-4xl font-bold mt-3">
                        {{ $inProgressTickets }}
                    </h2>

                </div>



                <div class="bg-white rounded-2xl shadow p-6 border-l-4 border-green-600">

                    <p class="text-gray-500">
                        Closed
                    </p>

                    <h2 class="text-4xl font-bold mt-3">
                        {{ $closedTickets }}
                    </h2>

                </div>



                <div class="bg-white rounded-2xl shadow p-6 border-l-4 border-purple-600">

                    <p class="text-gray-500">
                        Users
                    </p>

                    <h2 class="text-4xl font-bold mt-3">
                        {{ $usersCount }}
                    </h2>

                </div>


            </div>





            <!-- Search -->


            <div class="bg-white rounded-2xl shadow mb-8">


                <div class="p-6">


                    <form method="GET" action="/admin/dashboard">


                        <div class="grid md:grid-cols-3 gap-5">



                            <div>

                                <label class="font-semibold">
                                    🔍 Search
                                </label>


                                <input
                                    type="text"
                                    name="search"
                                    value="{{ request('search') }}"
                                    placeholder="Ticket yoki user..."
                                    class="mt-2 w-full border rounded-xl px-4 py-3">


                            </div>





                            <div>


                                <label class="font-semibold">
                                    🎯 Status
                                </label>


                                <select
                                    name="status"
                                    class="mt-2 w-full border rounded-xl px-4 py-3">


                                    <option value="">
                                        Barchasi
                                    </option>


                                    <option value="open"
                                    {{ request('status')=='open'?'selected':'' }}>
                                        Open
                                    </option>


                                    <option value="in_progress"
                                    {{ request('status')=='in_progress'?'selected':'' }}>
                                        In Progress
                                    </option>


                                    <option value="closed"
                                    {{ request('status')=='closed'?'selected':'' }}>
                                        Closed
                                    </option>


                                </select>


                            </div>





                            <div class="flex items-end gap-3">


                                <button
                                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl">

                                    Search

                                </button>



                                <a href="/admin/dashboard"
                                   class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-xl">

                                    Reset

                                </a>


                            </div>


                        </div>


                    </form>


                </div>


            </div>
                        <!-- Tickets Table -->

            <div class="bg-white rounded-2xl shadow overflow-hidden">


                <div class="p-6 border-b">

                    <h2 class="text-2xl font-bold text-gray-800">
                        📋 Ticketlar
                    </h2>

                </div>



                <div class="overflow-x-auto">


                    <table class="w-full">


                        <thead class="bg-gray-50">

                            <tr>

                                <th class="p-4 text-left text-gray-600">
                                    #
                                </th>

                                <th class="p-4 text-left text-gray-600">
                                    Ticket
                                </th>

                                <th class="p-4 text-left text-gray-600">
                                    User
                                </th>

                                <th class="p-4 text-left text-gray-600">
                                    Status
                                </th>

                                <th class="p-4 text-left text-gray-600">
                                    Sana
                                </th>

                                <th class="p-4 text-center text-gray-600">
                                    Action
                                </th>

                            </tr>


                        </thead>



                        <tbody>


                        @forelse($tickets as $ticket)



                            <tr class="border-b hover:bg-gray-50 transition">



                                <td class="p-4 font-semibold">

                                    #{{ $ticket->id }}

                                </td>




                                <td class="p-4">


                                    <div class="font-bold text-gray-800">

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


                                    @if($ticket->status == 'open')


                                        <span class="px-3 py-1 rounded-full text-sm bg-blue-100 text-blue-700">

                                            Open

                                        </span>


                                    @elseif($ticket->status == 'in_progress')


                                        <span class="px-3 py-1 rounded-full text-sm bg-yellow-100 text-yellow-700">

                                            In Progress

                                        </span>


                                    @else


                                        <span class="px-3 py-1 rounded-full text-sm bg-green-100 text-green-700">

                                            Closed

                                        </span>


                                    @endif



                                </td>





                                <td class="p-4 text-gray-600">

                                    {{ $ticket->created_at->format('d.m.Y H:i') }}

                                </td>






                                <td class="p-4">


                                    <div class="flex justify-center gap-2">



                                        <a href="/tickets/{{ $ticket->id }}"
                                           class="bg-gray-800 hover:bg-black text-white px-3 py-2 rounded-lg">

                                            👁

                                        </a>






                                        <form action="/admin/tickets/{{ $ticket->id }}/status"
                                              method="POST">


                                            @csrf
                                            @method('PUT')



                                            <select
                                                name="status"
                                                onchange="this.form.submit()"
                                                class="border rounded-lg px-3 py-2">



                                                <option value="open"
                                                {{ $ticket->status=='open'?'selected':'' }}>

                                                    Open

                                                </option>




                                                <option value="in_progress"
                                                {{ $ticket->status=='in_progress'?'selected':'' }}>

                                                    In Progress

                                                </option>




                                                <option value="closed"
                                                {{ $ticket->status=='closed'?'selected':'' }}>

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