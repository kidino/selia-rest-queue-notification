<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 lg:grid-cols-6 gap-6">

            <x-total-users-widget />
            <x-total-employees-widget />
            <x-total-customers-widget />

            </div>

        </div>
    </div>
</x-app-layout>
