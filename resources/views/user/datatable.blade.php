<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Users
        </h2>
    </x-slot>
 
    @push('styles')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.tailwind.min.css">
    @endpush

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                {{ $dataTable->table() }}

                </div>
            </div>
        </div>
    </div>
<style>

.dt-paging {
  display: flex;
  justify-content: flex-end;
  margin-top: 1rem;
}

.dt-paging nav {
  display: flex;
}

.dt-paging .pagination {
  display: flex;
  list-style: none;
  padding-left: 0;
  margin-bottom: 0;
}

.dt-paging-button {
  margin: 0 2px;
}

.dt-paging-button button.page-link {
  border: 1px solid #dee2e6;
  background-color: #fff;
  color: #007bff;
  border-radius: 0.25rem;
  padding: 0.375rem 0.75rem;
  transition: background-color 0.2s ease, color 0.2s ease;
}

/* Hover effect */
.dt-paging-button button.page-link:hover {
  background-color: #e9ecef;
  color: #0056b3;
}

/* Active page styling */
.dt-paging-button.active button.page-link {
  background-color: #007bff;
  color: #fff;
  border-color: #007bff;
  cursor: default;
}

/* Disabled buttons */
.dt-paging-button.disabled button.page-link {
  color: #6c757d;
  background-color: #fff;
  border-color: #dee2e6;
  cursor: not-allowed;
  pointer-events: none;
}

#users-table_wrapper input.form-control {
  border: 1px solid #ccc;
  border-radius: 0.25rem;
}

</style>
    @push('scripts')
        <script src="https://cdn.datatables.net/1.13.6/js/dataTables.tailwind.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    @endpush

</x-app-layout>