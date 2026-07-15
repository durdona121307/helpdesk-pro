<nav x-data="{ open: false }" class="bg-white shadow-sm border-b">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-between h-16">


            <!-- Logo + Links -->
            <div class="flex items-center">


                <a href="{{ route('dashboard') }}"
                   class="text-2xl font-bold text-indigo-600">
                    🚀 Helpdesk-Pro
                </a>


                <div class="hidden sm:flex ml-10 space-x-6">


                    <a href="{{ route('dashboard') }}"
                       class="text-gray-700 hover:text-indigo-600 font-medium">

                        Dashboard

                    </a>



                    @if(auth()->user()->isAdmin())

                        <a href="/admin/dashboard"
                           class="text-gray-700 hover:text-indigo-600 font-medium">

                            🛠 Admin Panel

                        </a>

                    @endif


                </div>


            </div>




            <!-- User Menu -->

            <div class="hidden sm:flex items-center">


                <div class="mr-5 text-right">

                    <div class="font-semibold text-gray-800">
                        {{ Auth::user()->name }}
                    </div>

                    <div class="text-xs text-gray-500">
                        {{ Auth::user()->email }}
                    </div>

                </div>



                <form method="POST" action="{{ route('logout') }}">

                    @csrf


                    <button
                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition">

                        Logout

                    </button>


                </form>


            </div>




            <!-- Mobile button -->

            <div class="flex items-center sm:hidden">

                <button @click="open=!open"
                        class="p-2 rounded-lg text-gray-500 hover:bg-gray-100">

                    ☰

                </button>

            </div>



        </div>


    </div>



    <!-- Mobile menu -->

    <div x-show="open"
         class="sm:hidden border-t p-4">


        <a href="{{ route('dashboard') }}"
           class="block py-2">

            Dashboard

        </a>


        @if(auth()->user()->isAdmin())

            <a href="/admin/dashboard"
               class="block py-2">

                🛠 Admin Panel

            </a>

        @endif


    </div>


</nav>