<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">


                
        <form method="POST" action="{{ route('user.store') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" 
                name="name" :value="old('name')" required autofocus />

                <x-input-error :messages="$errors->get('name')" />


            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" 
                name="email" :value="old('email')" required />

                <x-input-error :messages="$errors->get('email')" />

            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" 
                name="password" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" 
                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="btn btn-ghost" href="{{ route('user.index') }}">
                    {{ __('Cancel') }}
                </a>

                <x-primary-button class="ml-4">
                    {{ __('Add') }}
                </x-primary-button>
            </div>
        </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
