<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="{{asset('css/app.css') }}">
    <title>Cadastro de Produtos</title>

    <style>
        body{
            padding: 20px;
        }
        .navbar {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    
    <div class="container">

        @component('component_navbar', ['urlAtual' => $urlAtual])   {{-- recebe $urlAtual das páginas que extendem este layout 'app.blade.php' --}}         
        @endcomponent         
            
        <main role="main">  {{-- O elemento <main> define o conteúdo principal dentro do <body> em seu documento ou aplicação. --}} 
            @hasSection('body')  {{-- Mostra a sessão 'body' SE ela existir nos arquivos filhos que herdam este layout --}} 
                    @yield('body')         
            @endif
        </main>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>