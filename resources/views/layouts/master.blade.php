<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>EPS Payroll</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />
    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="p-8 bg-gray-200 text-gray-700">
    @yield('content')
    @fluxScripts
    @if (session('status'))
        <script>
            document.addEventListener('livewire:initialized', () => {
                flasher.success('{{ session('status') }}');
            });
        </script>
    @endif
</body>


</html>
