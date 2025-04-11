<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notifications') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">


    @forelse(auth()->user()->notifications as $notification)
        <div class="p-4 mb-2 rounded border @if($notification->read_at) bg-gray-100 @else bg-white shadow @endif">
            <p>{{ $notification->data['message'] }}</p>
           
            @if(isset($notification->data['changed_fields']))
                <p class="text-sm text-gray-500">Changed: {{ implode(', ', $notification->data['changed_fields']) }}</p>
            @endif
           
            @if(isset($notification->data['new_roles']))
                <p class="text-sm text-gray-500">New roles: {{ implode(', ', $notification->data['new_roles']) }}</p>
            @endif
           
            <p class="text-sm text-gray-400">Received: {{ $notification->created_at->diffForHumans() }}</p>


            @if(is_null($notification->read_at))
                <form method="POST" action="{{ route('notifications.markAsRead', $notification->id) }}">
                    @csrf
                    <button class="text-sm text-blue-600 hover:underline mt-1">Mark as read</button>
                </form>
            @endif
        </div>
    @empty
        <p>No notifications yet.</p>
    @endforelse


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
