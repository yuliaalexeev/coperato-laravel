<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
            body {
            font-family: 'Nunito', sans-serif;
            background-color: #FFF5EE;
        }
    </style>
</head>

<body class="antialiased">
    <h1>Planets</h1>

    <table>
        <tr>
            <th>Name</th>
            <th>Population</th>
            <th>Diameter</th>
        </tr>
        @foreach ($planets as $planet)
        <tr>
            <td>{{ $planet->name }}</td>
            <td>{{ $planet->population }}</td>
            <td>{{ $planet->diameter }}</td>
        </tr>
        @endforeach
    </table>

</body>

</html>