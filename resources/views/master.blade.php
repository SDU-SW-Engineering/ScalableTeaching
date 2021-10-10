<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Web Technologies</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script type="text/javascript" src="{{ asset('js/app.js') }}" defer></script>

</head>
<body class="{{ $bg ?? 'bg-white dark:bg-gray-800' }} h-screen">
@includeUnless(isset($hideHeader), 'partials.navbar')
@yield('content')

<script type="text/javascript" defer>
    window.onload = function()
    {
        PetiteVue.createApp().mount()
    }
</script>
</body>
</html>
