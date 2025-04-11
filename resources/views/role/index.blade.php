<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Roles') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                @if(session('success'))
                    <x-alert-success />
                @endif

@can('create', App\Models\Role::class)
<a href="{{ route('role.create') }}" class="btn btn-primary">
  New Role
</a>
@endcan 

<div class="mb-4"></div>


                <table class="table table-zebra table-sm">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

            @foreach( $roles as $role )
                <tr class="border-b border-gray-300 hover:bg-gray-100">
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->name }}</td>
                    <td>{{ $role->description }}</td>
                    <td><a class="btn btn-neutral btn-sm" href="{{route('role.edit', $role->id)}}">Edit</a></td>
                </tr>
            @endforeach


            </tbody>
        </table>

                </div>
            </div>
        </div>
    </div>

    @includeif('helper.fade-alert-success', ['status' => session('success')])


</x-app-layout>
