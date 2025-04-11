<x-app-layout>
    <x-slot name="header">
    <p  class="text-sm text-gray-500 mb-3"><a href="{{ route('vacancies.index') }}">&laquo; Back to Vacancies</a></p>

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vacancy Applications') }}
        </h2>
        <p class="text-sm text-gray-500">{{ $vacancy->title }}</p>


    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="flex border-b border-gray-200">
                        <a href="{{ route('vacancies.show', $vacancy) }}" 
                           class="px-4 py-2 text-sm font-medium {{ request()->routeIs('vacancies.show') ? 'border-b-2 border-indigo-500 text-indigo-600' : 'text-gray-500 hover:text-gray-700' }}">
                            Details
                        </a>
                        <a href="{{ route('vacancies.applications.index', $vacancy) }}" 
                           class="px-4 py-2 text-sm font-medium {{ request()->routeIs('vacancies.applications.index') ? 'border-b-2 border-indigo-500 text-indigo-600' : 'text-gray-500 hover:text-gray-700' }}">
                            Applications
                            <span class="ml-2 text-xs bg-gray-200 text-gray-600 rounded-full px-2 py-1">{{ $vacancy->applications->count() }}</span>
                        </a>
                    </div>

                    <div class="mt-4">
                        <table class="table table-zebra table-sm">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Resume</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($applications as $application)
                                    <tr>
                                        <td>{{ $application->id }}</td>
                                        <td>{{ $application->name }}</td>
                                        <td>{{ $application->email }}</td>
                                        <td>{{ $application->phone }}</td>
                                        <td>
                                            <a href="{{ asset('storage/' . $application->resume_path) }}" class="btn btn-neutral btn-sm" target="_blank">Download</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
