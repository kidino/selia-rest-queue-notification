<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Employee List (Bad Query Example)
        </h2>
    </x-slot>
    <div class="py-6 px-6">
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">ID</th>
                    <th class="py-2 px-4 border-b">Name</th>
                    <th class="py-2 px-4 border-b">Manager</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $employee->id }}</td>
                        <td class="py-2 px-4 border-b">{{ $employee->first_name }} {{ $employee->last_name }}</td>
                        <td class="py-2 px-4 border-b">
                            {{ $employee->manager ? $employee->manager->first_name . ' ' . $employee->manager->last_name : 'None' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
