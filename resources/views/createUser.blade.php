<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crear usuario</title>
</head>
<body>
<div>
    <form action="{{route('user.store')}}" method="post">
        @csrf
        <label for="name">Nombre</label>
        <input type="text" id="name" name="name">

        <label for="email">email</label>
        <input type="email" id="email" name="email">

        <label for="password">email</label>
        <input type="password" id="password" name="password">

        <label for="password_confirmation">email</label>
        <input type="password" id="password_confirmation" name="password_confirmation">

        <button type="submit">Grabar</button>
</div>
<div>
    <a href="{{route('user.list')}}">Ver usuarios de la API</a>
</div>




</form>

</body>
</html>
