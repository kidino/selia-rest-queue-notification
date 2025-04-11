<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Asset') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-4">Create Asset</h1>
                <form action="{{ route('assets.store') }}" method="POST">
                    @csrf
                    <div class="form-control mb-4">
                        <label for="name" class="label">
                            <span class="label-text">Name</span>
                        </label>
                        <input type="text" id="name" name="name" class="input input-bordered w-full" required>
                    </div>
                    <div class="form-control mb-4">
                        <label for="description" class="label">
                            <span class="label-text">Description</span>
                        </label>
                        <textarea id="description" name="description" class="textarea textarea-bordered w-full"></textarea>
                    </div>
                    <div class="form-control mb-4">
                        <label for="value" class="label">
                            <span class="label-text">Value</span>
                        </label>
                        <input type="number" id="value" name="value" class="input input-bordered w-full" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
