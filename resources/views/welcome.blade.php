
<x-welcome-layout>

    <div class="flex flex-col min-h-full items-center pb-56 my-auto">
        <div class="text-3xl md:text-5xl lg:text-6xl font-thin">
            Longhorn Coach
        </div>
        @auth
            <div class="flex w-1/3 md:justify-between flex-wrap">
                <a class="flex w-full md:w-1/3 justify-center py-2" href="/athletes">Athletes</a>
                <a class="flex w-full md:w-1/3 justify-center py-2" href="/physicals">Physicals</a>
                <a class="flex w-full md:w-1/3 justify-center py-2" href="/sports">Sports</a>
            </div>
        @endauth
    </div>

</x-welcome-layout>

