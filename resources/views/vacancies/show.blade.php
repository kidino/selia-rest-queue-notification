<x-app-layout>
    <x-slot name="header">

        <p  class="text-sm text-gray-500 mb-3"><a href="{{ route('vacancies.index') }}">&laquo; Back to Vacancies</a></p>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vacancy Details') }}
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
                        <h3 class="text-lg font-bold">{{ $vacancy->title }}</h3>
                        <p>{{ $vacancy->description }}</p>
                        <p>Status: <span class="badge {{ $vacancy->status === 'open' ? 'badge-success' : 'badge-error' }}">{{ ucfirst($vacancy->status) }}</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
