<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>@yield('titulo-pagina')</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/all.min.css')}}">

    <script src="{{asset('js/jquery-3.5.1.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/all.min.js')}}"></script>
</head>
<body>
    <h1 style="text-shadow: 3px 3px 3px rgba(255, 255, 255, 0.4);  text-align:center;">@yield('header')</h1>
    @yield('conteudo')
    
    
    
    <div class="navbar">
            
            <nav class="navbar fixed-bottom navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="{{route('livros.index')}}"><i class="fas fa-home"></i></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-item nav-link" href="{{route('livros.index')}}">Livros</a>
      </li>
      <li class="nav-item">
        <a class="nav-item nav-link" href="{{route('generos.index')}}">Generos</a>
      </li>
      <li class="nav-item">
        <a class="nav-item nav-link" href="{{route('editoras.index')}}">Editoras</a>
      </li>
        <li class="nav-item">
        <a class="nav-item nav-link" href="{{route('autores.index')}}">Autores</a>
    </ul>
  </div>
</nav>
            
        </div>
</body>
</html>