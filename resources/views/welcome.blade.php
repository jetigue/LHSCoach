
<x-welcome-layout>
    <div class="flex flex-col w-full min-h-screen bg-gray-800 text-white">
            <div class="flex flex-col min-h-ful items-center my-auto pb-64">

                <div class="text-3xl md:text-5xl lg:text-6xl font-thin">
                    Physical Tracker
                </div>
                @auth
                    <div class="flex w-1/3 md:justify-between flex-wrap">
                        <a class="flex w-full md:w-1/3 justify-center py-2" href="/athletes">Athletes</a>
                        <a class="flex w-full md:w-1/3 justify-center py-2" href="/physicals">Physicals</a>
                        <a class="flex w-full md:w-1/3 justify-center py-2" href="/sports">Sports</a>
                    </div>
                @endauth
            </div>
    </div>
</x-welcome-layout>

