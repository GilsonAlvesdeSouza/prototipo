<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> {{$titulo}} </title>
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
</head>
<body>
<div class="container">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <ul class="navbar ml-auto" >
            <li>Home</li>
            <li>Sobre</li>
            <li>Sair</li>
        </ul>
    </nav>
</div>
<div class="container">
    <div class="jumbotron">
        <h1>@yield("cabecalho")</h1>
    </div>

    @yield("conteudo")

</div>
<script src="{{ asset('js/app/js') }}"></script>
</body>
</html>
