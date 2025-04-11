<!DOCTYPE html>
<html 
data-theme="emerald"
lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>



        <div id="toast-container" style="position: fixed; top: 80px; right: 20px; z-index: 9999;"></div>


<script>
    if (window.EventSource) {
        const evtSource = new EventSource('/sse/notifications');


        evtSource.addEventListener("new_notification", function(event) {
            const data = JSON.parse(event.data);
            showToast(data.message, data.url);
            updateNotificationIndicator(data.unread_count);
        });


        evtSource.onerror = function(error) {
            console.error("SSE connection error:", error);
            evtSource.close(); // Close the connection on error
        };


        function showToast(message, link) {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');


            toast.innerHTML = `<a href="${link}" class="block bg-blue-600 text-white px-4 py-2 rounded shadow mb-2 hover:bg-blue-700 transition-all">
                🔔 ${message}
            </a>`;


            container.appendChild(toast);


            setTimeout(() => toast.remove(), 5000);
        }


        function updateNotificationIndicator(unreadCount) {


            const indicators = document.querySelectorAll('.unread-notification.indicator .indicator-item');


            if (unreadCount > 0) {
                indicators.forEach(indicator => {
                    indicator.textContent = unreadCount;
                    indicator.style.display = 'flex';
                });


            } else {
                indicators.forEach(indicator => {
                    indicator.style.display = 'none';
                });                
            }
        }


    } else {
        console.error("Your browser does not support SSE.");
    }
</script>


    </body>

    @stack('scripts')

</html>
