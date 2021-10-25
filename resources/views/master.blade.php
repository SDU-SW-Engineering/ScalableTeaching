<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Web Technologies</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <script type="text/javascript" src="{{ mix('js/app.js') }}" defer></script>
</head>
<body class="bg-gray-50 dark:bg-gray-700 h-screen" style="min-width: 480px">
<div id="app">
    @includeUnless(isset($hideHeader), 'partials.navbar')
    @yield('content')
</div>

@yield('script')
</body>
</html>
