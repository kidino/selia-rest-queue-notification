<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Notes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                @if(session('success'))
                    <x-alert-success />
                @endif


@can('create', App\Models\Note::class)
<a href="{{ route('note.create') }}" class="btn btn-primary">
  New Note
</a>
@endcan


<div class="mb-4">{{ $notes->links() }}</div>

                <table class="table table-zebra table-sm">
            <thead class="">
                <tr>
                    <th class="">ID</th>
                    <th class="">Name</th>
                    <th class="">Action</th>
                </tr>
            </thead>
            <tbody>

            @forelse( $notes as $note )
                <tr class="">
                    <td class="">{{ $note->id }}</td>
                    <td class="">{{ $note->title }}</td>
                    <td class="">

                        <a href="{{route('note.edit', $note->id)}}" class="btn btn-neutral btn-sm">
                            Edit
                        </a>                        
                    </td>
                </tr>

            @empty  

            <tr>
                <td class="py-6 px-6 text-center" colspan="3">
                    <p>No data found. Create a new record now.</p>
                    <a href="{{ route('note.create') }}" 
                    class="btn btn-primary">
                        New Note
                    </a>  
                </td>
            </tr>
            @endforelse


            </tbody>
        </table>

                </div>
            </div>
        </div>
    </div>

    @includeif('helper.fade-alert-success', ['status' => session('success')])

</x-app-layout>
