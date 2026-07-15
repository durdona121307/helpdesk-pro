<x-app-layout>

    <x-slot name="header">

        <div>
            <h2 class="text-3xl font-bold text-gray-800">
                👤 Profile
            </h2>

            <p class="text-gray-500 mt-1">
                Hisob sozlamalarini boshqarish
            </p>
        </div>

    </x-slot>



    <div class="py-10">


        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-8">



            <!-- Profile Information -->

            <div class="bg-white rounded-2xl shadow-lg p-8">


                <div class="mb-5">

                    <h3 class="text-xl font-bold text-gray-800">

                        👤 Profil ma'lumotlari

                    </h3>


                    <p class="text-gray-500 mt-1">

                        Ism va email ma'lumotlarini yangilang.

                    </p>

                </div>



                <div class="max-w-xl">

                    @include('profile.partials.update-profile-information-form')

                </div>


            </div>





            <!-- Password -->


            <div class="bg-white rounded-2xl shadow-lg p-8">


                <div class="mb-5">

                    <h3 class="text-xl font-bold text-gray-800">

                        🔒 Parolni o‘zgartirish

                    </h3>


                    <p class="text-gray-500 mt-1">

                        Hisob xavfsizligini saqlang.

                    </p>

                </div>



                <div class="max-w-xl">

                    @include('profile.partials.update-password-form')

                </div>



            </div>






            <!-- Delete Account -->


            <div class="bg-white rounded-2xl shadow-lg p-8 border border-red-100">


                <div class="mb-5">

                    <h3 class="text-xl font-bold text-red-600">

                        ⚠️ Account o‘chirish

                    </h3>


                    <p class="text-gray-500 mt-1">

                        Hisobni butunlay o‘chirish.

                    </p>


                </div>




                <div class="max-w-xl">

                    @include('profile.partials.delete-user-form')

                </div>



            </div>




        </div>


    </div>


</x-app-layout>