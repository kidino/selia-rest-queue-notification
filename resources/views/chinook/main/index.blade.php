<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Chinook Dashboard
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-4">Welcome to the Chinook Database App</h1>
                <!-- <a href="#" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">
                    Go to Feature (Coming Soon)
                </a> -->

                <a href="{{ route('chinook.employee.nplus1.bad') }}" 
                    class="btn btn-primary">Employees (BAD)</a>

                    <a href="{{ route('chinook.employee.nplus1.fixed') }}" 
                    class="btn btn-primary">Employees (GOOD)</a>


<a href="{{ route('chinook.customer.index1') }}" 
                    class="btn btn-secondary mb-3">Customers (BAD)</a>

                    <a href="{{ route('chinook.customer.index2') }}" 
                    class="btn btn-secondary mb-3">Customers (GOOD)</a>

                
                    <a href="{{ route('chinook.album.index1') }}" 
                    class="btn btn-info mb-3">Album (BAD)</a>
                
                    <a href="{{ route('chinook.album.index2') }}" 
                    class="btn btn-info mb-3">Album (GOOD)</a>

                    <a href="{{ route('chinook.album.index3') }}" 
                    class="btn btn-info mb-3">Album (GOOD + PAGINATION)</a>

                    <a href="{{ route('chinook.tracks.all_columns') }}"
                        class="btn btn-success mb-3">Tracks (All Columns, No Pagination)</a>

                    <a href="{{ route('chinook.tracks.selected_columns') }}"
                        class="btn btn-success mb-3">Tracks (Selected Columns Only)</a>
                    


            </div>
        </div>
    </div>
</x-app-layout>
