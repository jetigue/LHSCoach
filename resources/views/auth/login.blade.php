<x-welcome-layout>
    <div class="min-h-full md:w-1/2 lg:w-1/3 md:mt-8 lg:mt-10 mx-auto">
        <div class="relative bg-white w-full max-w-md h-full md:h-auto m-auto md:rounded flex-col flex p-2">
            <header class="border-b-2 border-red-900 flex">
                <div>
                    <h3 class="text-2xl text-gray-800 p-2">
                        Sign In
                    </h3>
                </div>
            </header>
            <section class="my-3 p-4 bg-gray-100 rounded-lg">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <div class="flex justify-between items-center">
                            <label class="text-red-900" for="email">Email Address</label>
                            @if ($errors->has('email'))
                            <span class="font-semibold text-red-700 text-xs" role="alert">
                                {{ $errors->first('email') }}
                            </span>
                            @endif
                        </div>
                        <input class="w-full rounded border px-3 py-2 text-lg border shadow-md text-gray-800 font-semibold {{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                    </div>

                    <div class="mb-4">
                        <div class="flex justify-between items-center">
                            <label class="text-red-900" for="email">Password</label>
                            @if ($errors->has('password'))
                            <span class="font-semibold text-red-700 text-xs" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                        <input class="w-full rounded border px-3 py-2 text-lg border shadow-md text-gray-800 font-semibold
                                {{ $errors->has('password') ? ' is-invalid' : '' }}"
                               id="password" type="password" name="password" {{--value="{{ old('password') }}"--}}
                               required>
                    </div>

                    <div class="mb-3">
                        <div class="flex justify-between items-center p-1">
                            <button type="submit" class="w-20 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-bold rounded">
                                Login
                            </button>
                            <div class="flex items-center">
                                <input class="" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class=" ml-2 text-red-900" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-between items-center pt-4">
                        <div>
                            <a class="text-blue-700 pl-3" href="/register">Sign Up!</a>
                        </div>
                        <div>
                            @if (Route::has('password.request'))
                                <a class="text-blue-700" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</x-welcome-layout>
