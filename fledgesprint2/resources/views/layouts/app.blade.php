<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Fledge - Job Search')</title>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">
    @section('navbar')
    <x-navbar />
    @show

    @yield('content')

    @section('footer')
    <x-footer />
    @endsection
</body>

</html>
