<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ScalableTeaching</title>
    @vite('resources/css/app.css')

    @vite('resources/js/app.js')
    <meta name="theme-color" content="#f1f5f9" media="(prefers-color-scheme: light)">
    <meta name="theme-color" content="#1f2937" media="(prefers-color-scheme: dark)">
    @yield('styles')

</head>
<body class="bg-gray-50 dark:bg-gray-700 h-screen" style="min-width: 480px">
<div id="app">
    @env(['staging', 'local'])
        @include('staging.banner')
        @include('staging.modal')
    @endenv
    @includeUnless(isset($hideHeader), 'partials.navbar')
        <div>
            <example-component></example-component>
        </div>
    @yield('content')
</div>

</body>
</html>
