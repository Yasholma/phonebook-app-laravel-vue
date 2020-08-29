<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Phonebook | Home</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
</head>

<body>

    <div id="app">
        <pb-header></pb-header>
        <div class="container">
            <router-view></router-view>
        </div>
        <pb-footer></pb-footer>
    </div>

    <script src="{{ asset('/js/app.js') }}"></script>
    <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>

</body>

</html>
