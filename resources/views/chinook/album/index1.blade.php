<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Albums (Bad Query Example)
        </h2>
    </x-slot>
    <div class="py-6 px-6">
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                <th class="py-2 px-4 border-b">ID</th>
                <th class="py-2 px-4 border-b">Title</th>
                <th class="py-2 px-4 border-b"># of Tracks</th>
                <th class="py-2 px-4 border-b">Total Duration (HH:MM:SS)</th>
                <th class="py-2 px-4 border-b">Total Size (MB)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($albums as $album)
                    <tr>
                    <td class="py-2 px-4 border-b">{{ $album->id }}</td>
                    <td class="py-2 px-4 border-b">{{ $album->title }}</td>
                    <td class="py-2 px-4 border-b">{{ $album->tracks->count() }}</td>
                        <td class="py-2 px-4 border-b">
                            @php
                                $totalSeconds = $album->tracks->sum('milliseconds') / 1000;
                                $hours = floor($totalSeconds / 3600);
                                $minutes = floor(($totalSeconds % 3600) / 60);
                                $seconds = $totalSeconds % 60;
                            @endphp
                            {{ sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds) }}
                        </td>
                        <td class="py-2 px-4 border-b">
                            {{ round($album->tracks->sum('bytes') / (1024 * 1024), 2) }} MB
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
