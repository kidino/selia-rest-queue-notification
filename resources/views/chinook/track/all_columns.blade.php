<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tracks (All Columns, No Pagination)
        </h2>
    </x-slot>
    <div class="py-6 px-6 overflow-auto">


        <table class="table-auto min-w-full text-sm bg-white">
            <thead>
                <tr>
                    <th class="px-4 py-2 border-b text-left">ALBUM</th>
                    @foreach (array_keys($tracks->first()->getAttributes()) as $column)
                        <th class="px-4 py-2 border-b text-left">{{ $column }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($tracks as $track)
                    <tr>
                        <td>{{ $track->album->title }}</td>
                        @foreach ($track->getAttributes() as $value)
                            <td class="px-4 py-2 border-b">{{ $value }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>


    </div>
</x-app-layout>
