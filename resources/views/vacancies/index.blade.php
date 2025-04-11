<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vacancies') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{ route('vacancies.create') }}" class="btn btn-primary mb-4">Create Vacancy</a>

                    <table class="table table-zebra table-sm">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Applications</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($vacancies as $vacancy)
                                <tr>
                                    <td>{{ $vacancy->id }}</td>
                                    <td>{{ $vacancy->title }}</td>
                                    <td>{{ ucfirst($vacancy->status) }}</td>
                                    <td>{{ $vacancy->applications_count }}</td>
                                    <td>
                                        <a href="{{ route('vacancies.show', $vacancy) }}" class="btn btn-neutral btn-sm">Details</a>
                                        <a href="{{ route('vacancies.edit', $vacancy) }}" class="btn btn-neutral btn-sm">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
