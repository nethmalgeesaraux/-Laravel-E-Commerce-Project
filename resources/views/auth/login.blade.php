<x-app-layout>

  <!-- Main Content Start -->

    <div class="relative flex items-center justify-center h-64 text-white bg-center bg-cover bg-sky-700" style="background-image: url('assets/images/page-banner.jpg');">
    <div class="absolute inset-0 bg-black bg-opacity-40"></div>
    <div class="relative z-10 text-center">
        <h2 class="mb-2 text-4xl font-bold">Login</h2>
        <ul class="flex justify-center space-x-2 text-sm">
            <li><a href="{{route('home.index')}}" class="hover:text-primary">Home</a></li>
            <li>/</li>
            <li class="text-primary">Login</li>
        </ul>
    </div>
</div>

<section class="py-20">
    <div class="container px-4 mx-auto">
        <div class="flex justify-center">
            <div class="w-full lg:w-1/2">
                <div class="p-8 border rounded-lg shadow-sm bg-gray-50">
                    <h4 class="mb-6 text-2xl font-bold text-center">Login to Your Account</h4>
                    
                    <form method="POST" action="{{ route('login') }}" class="space-y-4">
                        @csrf
                    
                        <div>
                            <input id="email" name="email" type="email" placeholder="Email *" class="w-full p-3 transition border rounded focus:outline-none focus:border-primary":value="old('email')" required autofocus autocomplete="username" />
                            @error('email')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                        </div>
                        
                        <div>
                            <input id="password" name="password" type="password" placeholder="Password" class="w-full p-3 transition border rounded focus:outline-none focus:border-primary"  required autocomplete="current-password"/>
                             @error('password')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="flex items-center">
                            <input type="checkbox" id="remember_me" name="remember" class="w-4 h-4 border-gray-300 rounded cursor-pointer text-primary focus:ring-primary" />
                            <label for="remember_me" class="ml-2 text-sm text-gray-600 cursor-pointer">Remember me</label>
                        </div>
                        
                        <div>
                            <button type="submit" class="w-full py-3 font-medium text-white transition rounded shadow-lg bg-primary hover:bg-blue-600">
                                Login
                            </button>
                        </div>
                    </form>
                    
                    <div class="mt-6 space-y-2 text-sm text-center">
                        <p><a href="{{ route('password.request') }}" class="text-gray-500 transition hover:text-primary">Lost your password?</a></p>
                        <p class="text-gray-600">
                            No account? 
                            <a href="{{ route('register')}}" class="font-bold text-primary hover:underline">Create one here.</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- Main Content End -->

    <!-- Session Status 
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

         Email Address 
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        Password 
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block w-full mt-1"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        Remember Me
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="text-indigo-600 border-gray-300 rounded shadow-sm focus:ring-indigo-500" name="remember">
                <span class="text-sm text-gray-600 ms-2">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form> -->
</x-app-layout>
