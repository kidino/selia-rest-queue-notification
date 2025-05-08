<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Customer List (Bad Query Example)
        </h2>
    </x-slot>
    <div class="py-6 px-6">
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">ID</th>
                    <th class="py-2 px-4 border-b">Name</th>
                    <th class="py-2 px-4 border-b">Support Rep</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $customer)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $customer->id }}</td>
                        <td class="py-2 px-4 border-b">{{ $customer->first_name }} {{ $customer->last_name }}</td>
                        <td class="py-2 px-4 border-b">
                            {{ $customer->supportRep ? $customer->supportRep->first_name . ' ' . $customer->supportRep->last_name : 'None' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
