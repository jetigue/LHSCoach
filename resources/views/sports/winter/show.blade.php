<x-layout>
    <div class="flex w-full p-10">
        <div class="flex flex-col w-full">
            <header class="w-full md:w-1/2 font-thin lg:text-5xl py-4 text-red-900">
                {{ $winterSport->name }}
            </header>
            @if(count($athletes)>0)
                <sport-athletes :data="{{ $athletes }}"></sport-athletes>
            @else
                <p>No Athletes</p>
            @endif

        </div>
    </div>
</x-layout>
