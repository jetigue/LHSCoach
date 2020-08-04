<x-welcome-layout>
    <div class="md:w-1/2 lg:w-1/3 md:mt-8 lg:mt-10 mx-auto">
        <div class="relative bg-white w-full max-w-md h-full md:h-auto m-auto md:rounded flex-col flex p-2">
            <header class="border-b-2 border-red-900 flex">
                <div>
                    <h3 class="text-2xl text-gray-800 p-2">
                        Sign Up
                    </h3>
                </div>
            </header>
            <section class="my-3 p-4 bg-gray-100 rounded-lg">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-4">
                        <div class="flex justify-between content-end">
                            <label class="text-red-900"
                                   for="first_name">
                                First Name
                            </label>
                            @if ($errors->has('first_name'))
                                <span class="font-semibold text-red-700 text-xs" role="alert">
                                    {{ $errors->first('first_name') }}
                                </span>
                            @endif
                        </div>
                        <input class="w-full rounded border px-3 py-2 text-lg border shadow-md text-gray-800 font-semibold
                               {{ $errors->has('first_name') ? ' is-invalid' : '' }}"
                               id="first_name"
                               type="text"
                               name="first_name"
                               value="{{ old('first_name') }}"
                               required autofocus>
                    </div>

                    <div class="mb-4">
                        <div class="flex justify-between content-end">
                            <label class="text-red-900"
                                   for="last_name">Last Name</label>
                            @if ($errors->has('last_name'))
                                <span class="font-semibold text-red-700 text-xs" role="alert">
                                    {{ $errors->first('last_name') }}
                                </span>
                            @endif
                        </div>
                        <input class="w-full rounded border px-3 py-2 text-lg border shadow-md text-gray-800 font-semibold
                               {{ $errors->has('last_name') ? ' is-invalid' : '' }}"
                               id="last_name"
                               type="text"
                               name="last_name"
                               value="{{ old('last_name') }}"
                               required>
                    </div>

                    <div class="mb-4">
                        <div class="flex justify-between content-end">
                            <label class="text-red-900"
                                   for="email">Email Address</label>
                            @if ($errors->has('email'))
                                <span class="font-semibold text-red-700 text-xs" role="alert">
                                    {{ $errors->first('email') }}
                                </span>
                            @endif
                        </div>
                        <input class="w-full rounded border px-3 py-2 text-lg border shadow-md text-gray-800 font-semibold
                                {{ $errors->has('email') ? ' is-invalid' : '' }}"
                               id="email"
                               type="email"
                               name="email"
                               value="{{ old('email') }}"
                               required>
                    </div>

                    <div class="mb-4">
                        <div class="flex justify-between content-end">
                            <label class="text-red-900" for="password">Password</label>
                            @if ($errors->has('password'))
                                <span class="font-semibold text-red-700 text-xs" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                        <input class="w-full rounded border px-3 py-2 text-lg border shadow-md text-gray-800 font-semibold
                                {{ $errors->has('password') ? ' is-invalid' : '' }}"
                               id="password"
                               type="password"
                               name="password"
                               required>
                    </div>

                    <div class="mb-4">
                        <div class="flex justify-between content-end">
                            <label class="text-red-900" for="password-confirm">Confirm Password</label>
                        </div>
                        <input class="w-full rounded border px-3 py-2 text-lg border shadow-md text-gray-800 font-semibold
                                {{ $errors->has('password-confirm') ? ' is-invalid' : '' }}"
                               id="password-confirm"
                               type="password"
                               name="password_confirmation"
                               required>
                    </div>

                    <div class="flex justify-between items-center">
                        <div>
                            <a class="text-blue-700 pl-3" href="/login">Or Sign In!</a>
                        </div>
                        <button type="submit"
                                class="w-20 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-bold rounded">
                            Sign Up
                        </button>
                    </div>
                </form>
            </section>
        </div>
    </div>
</x-welcome-layout>
