<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 lg:grid-cols-6 gap-6">

                <div class="bg-white p-6 rounded-lg shadow col-span-1 lg:col-span-2">
                    <h2>Total Users</h2>
                    <p class="text-3xl font-bold">{{ $total_users }}</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow col-span-1 lg:col-span-2">
                    <h2>Total Employees</h2>
                    <p class="text-3xl font-bold">{{ $total_employees }}</p>
                </div>

               
                <div class="bg-white p-6 rounded-lg shadow col-span-1 lg:col-span-2">
                    <h2>Total Customers</h2>
                    <p class="text-3xl font-bold">{{ $total_customers }}</p>
                </div>

                <x-total-users-widget />

            </div>

            <!-- <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div> -->



        </div>
    </div>
</x-app-layout>
