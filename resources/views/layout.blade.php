<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>@yield('titulo')</title>
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}"> 
        <link rel="stylesheet" href="{{asset('css/fa.css')}}"> 
        
        <style>
        .container{ width:100%; height:100%;}
            
            html, body {
            height: 100%;
            margin: 0;
            }
            body{
            background: #536976;  
            background: -webkit-linear-gradient(to right, #292E49, #536976); 
            background: linear-gradient(to right, #292E49, #536976);

            background-repeat: no-repeat; height:100%;
            }
            
            a:link {
            color: black;
            background-color: transparent;
            text-decoration: none;
            }

            a:visited {
            color: black;
            background-color: transparent;
            text-decoration: none;
            }

            a:hover {
            color: black;
            background-color: transparent;
            text-decoration: underline;
            }

            a:active {
            color: black;
            background-color: transparent;
            text-decoration: underline;
            }
            h1{
                text-shadow: 3px 3px 3px rgba(255, 255, 255, 0.4);
                text-align: center;
            }
            
        </style>
        
        
    </head>
    <body>
    <div class="container">
        <h1>@yield('header')</h1>
        <div>
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
    </div>
</div>
        <script src="{{asset('js/jquery-3.5.1.min.js')}}"></script>
        <script src="{{asset('js/bootstrap.js')}}"></script>
        <script src="{{asset('js/fa.js')}}"></script>
</body>
</html>






