<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Role') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

        <form method="POST" action="{{ route('role.store') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text"
                name="name" :value="old('name')" required autofocus />

                <x-input-error :messages="$errors->get('name')" />
            </div>

            <!-- Description -->
            <div class="mt-4">
                <x-input-label for="description" :value="__('Description')" />
                <x-text-input id="description" class="block mt-1 w-full" type="text"
                name="description" :value="old('description')" autofocus />

                <x-input-error :messages="$errors->get('description')" />
            </div>

            <div class="flex items-center justify-end mt-6">
                <a class="btn btn-ghost" href="{{ route('role.index') }}">
                    {{ __('Cancel') }}
                </a>
                <x-primary-button class="ml-4">
                    {{ __('Save Role') }}
                </x-primary-button>
            </div>
        </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>