<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Note') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

        <form method="POST" action="{{ route('note.update', $note->id) }}">
            @csrf
            @method('PATCH')

            <!-- title -->
            <div>
                <x-input-label for="title" :value="__('Title')" />
                <x-text-input id="title" class="block mt-1 w-full" type="text" 
                name="title" :value="old('title', $note->title)" required autofocus />

                <x-input-error :messages="$errors->get('title')" />
            </div>

            <!-- content -->
            <div class="mt-4">
                <x-input-label for="content" :value="__('Content')" />

                <x-textarea id="content" class="block mt-1 w-full" rows="10" 
                name="content" required >{{ old('content', $note->content) }}</x-textarea>

                <x-input-error :messages="$errors->get('content')" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="btn btn-ghost" href="{{ route('note.index') }}">
                    {{ __('Cancel') }}
                </a>

                <x-primary-button class="ml-4">
                    {{ __('Save') }}
                </x-primary-button>
            </div>
        </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>