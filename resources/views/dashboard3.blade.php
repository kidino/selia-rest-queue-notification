<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 lg:grid-cols-6 gap-6">

                <div class="bg-white p-6 rounded-lg shadow col-span-1 lg:col-span-2">
                    <h2>Total Users</h2>
                    <p class="text-3xl font-bold" id="widget-total-users"> . . . </p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow col-span-1 lg:col-span-2">
                    <h2>Total Employees</h2>
                    <p class="text-3xl font-bold aj-data" data-aj-url="{{ route('aj-total-employees') }}"> . . .</p>
                </div>

               
                <div class="bg-white p-6 rounded-lg shadow col-span-1 lg:col-span-2">
                    <h2>Total Customers</h2>
                    <p class="text-3xl font-bold aj-data" data-aj-url="{{ route('aj-total-customers') }}"> . . . </p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow col-span-1 lg:col-span-6">
                    <h2>Daily Sales</h2>
                    
                    <canvas class="graph"></canvas>
                </div>



            </div>

            <button class="btn btn-primary" onclick="get_users()">GET USERS</button>



        </div>
    </div>

@push('scripts')
<script>
    window.get_users = function() {
            fetch("{{ route('aj-total-users') }}")
                .then(response => response.json())
                .then(data => {
                    document.getElementById('widget-total-users').innerHTML = data.value;
                })
                .catch(error => console.error('Error fetching total users:', error));
    }

    document.addEventListener('DOMContentLoaded', function () {
        const elements = document.querySelectorAll('.aj-data');
        elements.forEach(element => {
            const url = element.getAttribute('data-aj-url');
            if (url) {
                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        element.innerHTML = data.value;
                    })
                    .catch(error => console.error('Error fetching data for element:', error));
            }
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Fetch daily sales data and render the graph
        fetch("{{ route('aj-daily-sales') }}")
            .then(response => response.json())
            .then(data => {
                const ctx = document.querySelector('.graph').getContext('2d'); // Ensure this references the <canvas>
                new Chart(ctx, {
                    type: 'bar', // Changed from 'line' to 'bar'
                    data: {
                        labels: data.labels, // Dates for the past 30 days
                        datasets: [{
                            label: 'Daily Sales',
                            data: data.sales, // Sales amounts for each day
                            borderColor: 'rgba(75, 192, 192, 1)',
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderWidth: 2,
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top',
                            }
                        },
                        scales: {
                            x: {
                                title: {
                                    display: true,
                                    text: 'Date'
                                }
                            },
                            y: {
                                title: {
                                    display: true,
                                    text: 'Sales Amount'
                                },
                                beginAtZero: true
                            }
                        }
                    }
                });
            })
            .catch(error => console.error('Error fetching daily sales data:', error));
    });
</script>
@endpush

</x-app-layout>
