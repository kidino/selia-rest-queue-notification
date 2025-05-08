<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tracks (Selected Columns Only)
        </h2>
    </x-slot>
    <div class="py-6 px-6 overflow-auto">
        <table class="table-auto min-w-full text-sm bg-white">
            <thead>
                <tr>
                    <th class="px-4 py-2 border-b">ID</th>
                    <th class="px-4 py-2 border-b">Name</th>
                    <th class="px-4 py-2 border-b">Milliseconds</th>
                    <th class="px-4 py-2 border-b">Bytes</th>
                    <th class="px-4 py-2 border-b">Unit Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tracks as $track)
                    <tr>
                        <td class="px-4 py-2 border-b">{{ $track->id }}</td>
                        <td class="px-4 py-2 border-b">{{ $track->name }}</td>
                        <td class="px-4 py-2 border-b">{{ $track->milliseconds }}</td>
                        <td class="px-4 py-2 border-b">{{ $track->bytes }}</td>
                        <td class="px-4 py-2 border-b">{{ $track->unit_price }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>