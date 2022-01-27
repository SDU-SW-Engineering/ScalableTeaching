<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ScalableTeaching</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-50 dark:bg-gray-700 h-screen" style="min-width: 480px">
<div id="app">
    @includeUnless(isset($hideHeader), 'partials.navbar')
    @yield('content')
</div>

<script type="text/javascript" src="{{ mix('js/app.js') }}"></script>
@yield('scripts')
</body>
</html>
