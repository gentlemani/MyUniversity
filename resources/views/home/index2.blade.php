<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>

<body>
    <h1>Home</h1>
    @auth
    <p>Bienvenido {{auth()->user()->email ?? ''}}</p>
    @endauth
    <p>Página en proceso...</p>
    <img src="/home01/cat-work.gif">
</body>

</html>