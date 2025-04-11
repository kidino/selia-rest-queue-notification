<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if(session('success'))
                    <x-alert-success />
                    @endif

                    @can('create', App\Models\User::class)
                    <a href="{{ route('user.create') }}" class="btn btn-primary">
                        New User
                    </a>
                    @endcan 

                    <div class="mb-4">{{ $users->links() }}</div>


                    <table class="table table-zebra table-sm">
                        <thead class="">
                        <tr>
                            <th class="">ID</th>
                            <th class="">Name</th>
                            <th class="">Email</th>
                            <th class="">Notes</th>
                            <th class="">Roles</th>
                            <th class="">Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach( $users as $user )
                            <tr class="">
                                <td class="">{{ $user->id }}</td>
                                <td class="">{{ $user->name }}</td>
                                <td class="">{{ $user->email }}</td>
                                <td class="">{{ $user->notes_count }}</td>
                                <td class="">
                                    @if($user->roles->count() > 0)
                                        <div class="flex flex-wrap gap-1">
                                            @foreach($user->roles as $role)
                                                <span class="badge badge-accent badge-sm">
                                        {{ $role->name }}
                                    </span>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="text-gray-400 text-sm">No roles assigned</span>
                                    @endif
                                </td>
                                <td class="py-3 px-6">
                                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-neutral btn-sm">
                                        Edit
                                    </a>
                                </td>
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

