<div class="flex flex-col w-full bg-gray-800 text-white">
    <div class="flex w-full justify-end content items-center py-4 px-4">
        <x-sign-in></x-sign-in>
    </div>

    <div class="flex justify-center lg:items-start md:h-16 lg:justify-start lg:px-10">
        {{ $slot }}
    </div>

    <x-navbar></x-navbar>
</div>

