<x-app-layout>

    <!-- Main Content Start -->

    <div class="relative flex items-center justify-center h-64 text-white bg-center bg-cover bg-sky-700" style="background-image: url('assets/images/page-banner.jpg');">
        <div class="absolute inset-0 bg-black bg-opacity-40"></div>
        <div class="relative z-10 text-center">
            <h2 class="mb-2 text-4xl font-bold">Register</h2>
            <ul class="flex justify-center space-x-2 text-sm">
                <li><a href="{{route('home.index')}}" class="hover:text-primary">Home</a></li>
                <li>/</li>
                <li class="text-primary">Register</li>
            </ul>
        </div>
    </div>

    <section class="py-20">
        <div class="container px-4 mx-auto">
            <div class="flex justify-center">
                <div class="w-full lg:w-1/2">
                    <div class="p-8 border rounded-lg shadow-sm bg-gray-50">
                        <h4 class="mb-2 text-2xl font-bold text-center">Create New Account</h4>
                        <p class="mb-8 text-sm text-center text-gray-500">
                            Already have an account?
                            <a href="{{ route('login') }}" class="text-primary hover:underlin">Log in instead!</a>
                        </p>

                        <form method="POST" action="{{ route('register') }}" class="space-y-4">
                            @csrf
                            <div>
                                <input type="text" id="name" name="name" placeholder="Name" class="w-full p-3 transition border rounded focus:outline-none focus:border-primary" :value="old('name')" required autofocus autocomplete="name" />
                                @error('name')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <input type="email" id="email" name="email" placeholder="Email Address *" class="w-full p-3 transition border rounded focus:outline-none focus:border-primary" :value="old('email')" required autocomplete="username" />
                                @error('email')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <input type="text" id="mobile" name="mobile" placeholder="Mobile" class="w-full p-3 transition border rounded focus:outline-none focus:border-primary" :value="old('mobile')" required autocomplete="mobile" />
                                @error('mobile')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <input type="password" placeholder="Password" id="password" name="password" class="w-full p-3 transition border rounded focus:outline-none focus:border-primary" required autocomplete="new-password" />
                                @error('password')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <input type="password" placeholder="Confirm Password" id="password_confirmation" name="password_confirmation" class="w-full p-3 transition border rounded focus:outline-none focus:border-primary" required autocomplete="new-password" />
                            </div>

                            <div class="pt-4">
                                <button type="submit" class="w-full py-3 font-medium text-white transition rounded shadow-lg bg-primary hover:bg-blue-600">
                                    Register
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content End -->

    <!-- <form method="POST" action="{{ route('register') }}">
        @csrf

        Name 
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block w-full mt-1" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        Email Address 
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

          Modile Address 
        <div class="mt-4">
            <x-input-label for="mobile" :value="__('Mobile')" />
            <x-text-input id="mobile" class="block w-full mt-1" type="text" name="mobile" :value="old('mobile')" required autocomplete="mobile" />
            <x-input-error :messages="$errors->get('mobile')" class="mt-2" />
        </div>

       Password 
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block w-full mt-1"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        Confirm Password 
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block w-full mt-1"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form> -->
</x-app-layout>