<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }
        </style>
    </head>
    <body>
        <div style="margin: 48px;">
            <h2>Uruchamianie kontenerów dockera</h2>
            <code>docker-compose up -d</code>
            <hr>
            <h2>Bash dockerowy</h2>
            <code>docker-compose exec php bash</code>
            <hr>
            <h2>Rzeczy, które robimy z basha dockera</h2>
            <ul>
                <li>migracje</li>
                <li>wszystko composerowe</li>
                <li>php artisan tinker</li>
                <li>ogolnie artisanowe rzeczy zwiazane z baza danych (ale juz np tworzenie migracji lokalnie) - to co wymaga polaczenia z baza</li>
            </ul>
            <hr>
            <h2>Rzeczy ktore robimy lokalnie</h2>
            <ul>
                <li>wszystko zwiazane z gitem</li>
                <li>tworzenie nowych struktur poprzez artisana, czyli np. modeli, kontrolerow, migracji</li>
            </ul>
        </div>
    </body>
</html>
