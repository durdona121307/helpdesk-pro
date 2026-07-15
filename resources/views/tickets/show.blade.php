<x-app-layout>

    <x-slot name="header">

        <h2 class="text-3xl font-bold text-gray-800">
            🎫 Ticket tafsilotlari
        </h2>

    </x-slot>



    <div class="py-10">


        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">


            @if(session('success'))

                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-5 py-4 rounded-xl">

                    ✅ {{ session('success') }}

                </div>

            @endif




            <!-- Ticket Card -->

            <div class="bg-white shadow-lg rounded-2xl p-8 mb-8">


                <div class="flex justify-between items-start mb-6">


                    <div>

                        <h1 class="text-3xl font-bold text-gray-800">

                            {{ $ticket->title }}

                        </h1>


                        <p class="text-gray-500 mt-2">

                            Yaratilgan:
                            {{ $ticket->created_at->format('d.m.Y H:i') }}

                        </p>


                    </div>




                    @if($ticket->status == 'open')

                        <span class="bg-blue-100 text-blue-700 px-4 py-2 rounded-full">

                            Open

                        </span>


                    @elseif($ticket->status == 'in_progress')

                        <span class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full">

                            In Progress

                        </span>


                    @else

                        <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full">

                            Closed

                        </span>


                    @endif


                </div>




                <div class="bg-gray-50 rounded-xl p-5">


                    <h3 class="font-bold mb-2">
                        Muammo tavsifi
                    </h3>


                    <p class="text-gray-700 leading-relaxed">

                        {{ $ticket->description }}

                    </p>


                </div>



            </div>





            <!-- Comments -->


            <div class="bg-white shadow-lg rounded-2xl p-8 mb-8">


                <h2 class="text-2xl font-bold mb-6">

                    💬 Izohlar

                </h2>




                @forelse($ticket->comments as $comment)


                    <div class="mb-5 bg-gray-50 rounded-xl p-5">


                        <div class="flex justify-between">


                            <strong class="text-indigo-600">

                                {{ $comment->user->name }}

                            </strong>


                            <span class="text-sm text-gray-500">

                                {{ $comment->created_at->format('d.m.Y H:i') }}

                            </span>


                        </div>



                        <p class="mt-3 text-gray-700">

                            {{ $comment->message }}

                        </p>



                    </div>



                @empty


                    <p class="text-gray-500">

                        Hozircha izohlar yo‘q.

                    </p>


                @endforelse



            </div>






            <!-- Add Comment -->


            <div class="bg-white shadow-lg rounded-2xl p-8">


                <h2 class="text-2xl font-bold mb-5">

                    ✍️ Yangi izoh

                </h2>



                <form action="/tickets/{{ $ticket->id }}/comments"
                      method="POST">


                    @csrf



                    <textarea
                        name="message"
                        rows="5"
                        class="w-full border rounded-xl p-4 focus:ring-2 focus:ring-indigo-500"
                        placeholder="Izohingizni yozing..."
                        required></textarea>




                    @error('message')

                        <p class="text-red-600 mt-2">

                            {{ $message }}

                        </p>

                    @enderror





                    <button
                        class="mt-4 bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl">

                        Yuborish

                    </button>


                </form>



            </div>




            <div class="mt-6">


                <a href="/dashboard"
                   class="bg-gray-700 hover:bg-black text-white px-5 py-3 rounded-xl">

                    ← Ortga

                </a>


            </div>




        </div>


    </div>


</x-app-layout>