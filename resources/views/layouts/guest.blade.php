<!DOCTYPE html>
<html
    data-theme="emerald"
    lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login Page</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="h-screen flex items-center justify-center">



    <div class="w-full max-w-4xl bg-white shadow-lg rounded-lg overflow-hidden flex flex-col md:flex-row">



        <!-- Login Form -->
        <div class="w-full md:w-1/2 p-8">
        <x-application-logo class="w-20 h-20 fill-current text-gray-500" />


        {{ $slot }}

        </div>
        <!-- Background Image -->
        <div class="w-full md:w-1/2 h-64 md:h-auto bg-cover bg-center" style="background-image: url('https://images.pexels.com/photos/886521/pexels-photo-886521.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1');">
        </div>
    </div>
</body>
</html>
