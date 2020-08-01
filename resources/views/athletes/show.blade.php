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

        <div class="">
            <profile-physicals :data="{{ $physicals }}"></profile-physicals>
        </div>
    </div>
</x-layout>
