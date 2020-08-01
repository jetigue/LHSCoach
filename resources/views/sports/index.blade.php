<x-layout>
    <div class="flex w-full p-10">
        <div class="flex flex-col w-full">
            <header class="w-full md:w-1/2 font-thin lg:text-5xl py-4 text-red-900">Sports</header>

            <div class="flex w-full flex-wrap">
                <div class="w-full lg:w-1/3 lg:px-2" id="fallSport">
                    <fall-sports :data="{{ $fallSports }}"></fall-sports>
                </div>
                <div class="w-full lg:w-1/3 lg:px-2" id="winterSport">
                    <winter-sports :data="{{ $winterSports }}"></winter-sports>
                </div>
                <div class="w-full lg:w-1/3 lg:px-2" id="springSport">
                    <spring-sports :data="{{ $springSports }}"></spring-sports>
                </div>
            </div>
        </div>
    </div>
</x-layout>
