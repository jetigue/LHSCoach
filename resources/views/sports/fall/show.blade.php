<x-layout>
    <x-sport-header title="{{ $fallSport->name }}">
        @if(count($athletes)>0)
            <sport-athletes :data="{{ $athletes }}"></sport-athletes>
        @else
            <p>No Athletes</p>
        @endif
    </x-sport-header>
</x-layout>
