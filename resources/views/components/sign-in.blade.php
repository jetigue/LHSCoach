@if(Auth::guest())
    <button class="text-white text-sm"><a href="/login">Sign In</a></button>
@else

    <div x-data="{ open: false }" class="flex text-white">
        <button x-show="!open" class="text-white text-sm" @click="open = true">
            {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
        </button>
        <div x-show="open" @click.away="open = false">
            <a class="block text-sm" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
@endif
