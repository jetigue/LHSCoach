<x-welcome-layout>
    <div class="md:w-1/2 lg:w-1/3 md:mt-8 lg:mt-10 mx-auto">
        <div class="relative bg-white w-full max-w-md h-full md:h-auto m-auto md:rounded flex-col flex p-2">
            <header class="border-b-2 border-red-900 flex">
                <div>
                    <h3 class="text-2xl text-gray-800 p-2">
                        {{ __('Reset Password') }}
                    </h3>
                </div>
            </header>
            <section class="my-3 p-4 bg-gray-100 rounded-lg">

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="mb-3">
                        <div class="flex justify-between items-center">
                            <label class="text-red-900" for="email">{{ __('E-Mail Address') }}</label>
                            @if ($errors->has('email'))
                            <span class="font-semibold text-red-700 text-xs" role="alert">
                                {{ $errors->first('email') }}
                            </span>
                            @endif
                        </div>
                        <input class="w-full rounded border px-3 py-2 text-lg border shadow-md text-gray-800 font-semibold @error('email') is-invalid @enderror"
                               id="email"
                               type="email"
                               name="email"
                               value="{{ old('email') }}"
                               required
                               autocomplete="email"
                               autofocus>
                            @error('email')
                                <span class="font-red-900 text-sm font-semibold" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                    </div>

                    <div class="mb-3">
                        <div class="flex justify-between items-center p-1">
                            <button type="submit" class="w-full py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-bold rounded">
                                {{ __('Send Password Reset Link') }}
                            </button>

                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</x-welcome-layout>
