<x-layout>
    <div class="flex flex-col w-full p-10">
        <div class="flex flex-col">
            <header class="flex w-full text-2xl md:text-3xl lg:text-5xl font-semibold text-red-900 justify-center">
                {{ $athlete->first_name }} {{ $athlete->last_name }}
            </header>
            <div class="flex w-full border-t border-b py-1 flex-wrap justify-between">
                <div class="flex w-full md:w-1/3 text-gray-500 py-1 items-center">Sex &nbsp;
                    <span class="text-gray-800 font-semibold">{{ $athlete->gender }}</span>
                </div>

                <div class="flex w-full md:w-1/3 text-gray-500 py-1 items-center md:justify-center">Birthdate &nbsp;
                    <span class="text-gray-800 font-semibold">{{ $athlete->dob->format('n/d/Y') }}</span>
                </div>


                <div class="flex w-full md:w-1/3 text-gray-500 py-1 items-center md:justify-end">Class of &nbsp;
                    <span class="text-gray-800 font-semibold">{{ $athlete->grad_year }}</span>
                    <span class="text-red-900 font-semibold">&nbsp;{{ $athlete->class }}</span>
                </div>
            </div>
        </div>

        <div class="w-full py-8">
            <header class="w-full md:w-1/2 font-thin text-xl lg:text-3xl py-2 text-red-900">Sports</header>
            @if (
                $athlete->fall_sport_id !== 1 ||
                $athlete->winter_sport_id !== 1 ||
                $athlete->spring_sport_id !== 1
                )
                @unless ($athlete->fall_sport_id === 1)
                <div class="flex w-full text-lg px-2">
                    <div class="text-gray-500 mr-3">Fall</div>
                    <a class="hover:font-semibold hover:underline"
                        href="/fall/sports/{{ $athlete->fallSport->slug }}">
                        {{ $athlete->fallSport->name }}
                    </a>
                </div>
                @endunless
                @unless ($athlete->winter_sport_id === 1)
                <div class="flex w-full text-lg px-2">
                    <div class="text-gray-500 mr-3">Winter</div>
                    <a class="hover:font-semibold hover:underline"
                        href="/winter/sports/{{ $athlete->winterSport->slug }}">
                        {{ $athlete->winterSport->name }}
                    </a>
                </div>
                @endunless
                @unless ($athlete->spring_sport_id === 1)
                <div class="flex w-full text-lg px-2">
                    <div class="text-gray-500 mr-3">Spring</div>
                    <a class="hover:font-semibold hover:underline"
                        href="/spring/sports/{{ $athlete->springSport->slug }}">
                        {{ $athlete->springSport->name }}
                    </a>
                </div>
                @endunless
            @else
                <div class="px-2 font-semibold">None</div>
            @endif
        </div>

        @if (count($physicals) > 0)
            <profile-physicals :data="{{ $physicals }}"></profile-physicals>
        @else
            <header class="w-full md:w-1/2 font-thin text-xl lg:text-3xl py-2 text-red-900">
                Physicals
            </header>
            <div class="px-2 font-semibold">None</div>
        @endif




    </div>
</x-layout>
