<x-layout>
    <x-sport-header title="Sports">
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
    </x-sport-header>
</x-layout>
