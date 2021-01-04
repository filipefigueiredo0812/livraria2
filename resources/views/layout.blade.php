<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>@yield('titulo')</title>
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}"> 
        <link rel="stylesheet" href="{{asset('css/a.css')}}"> 
        <style>
        .container{ width:100%; height:100%;}
            
            html, body {
            height: 100%;
            margin: 0;
            }
            body{
              background: #EDE574;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #E1F5C4, #EDE574);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #E1F5C4, #EDE574); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */


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
            h3{
                
                text-align: center;
            }

            $light-gray:        #f8f9fa;
$menu-bg:           $light-gray;
$menu-hover:        darken($menu-bg, 9%);

.menu--main {
  display: block;
  position: absolute;
  bottom: 0;

  li {
    display: inline-block;
    position: relative;
    cursor: pointer;
    padding: 15px 20px;
    background-color: $menu-bg;
    margin-right: -4px;  // get rid of spacing between list items
    //transition: all 0.2s;

    &:hover {
      background-color: $menu-hover;
    }
    &:hover .sub-menu {      
      max-height: 300px;
      visibility: visible;
      bottom: 100%;  // align to top of parent element
      transition: all 0.4s linear;
    }
  }
  .sub-menu {
    display: block;
    visibility: hidden;
    position: absolute;
    //top: 100%;  // align to bottom of
    left: 0;
    box-shadow: none;
    max-height: 0;
    width: 150px;
    
    overflow: hidden;
    
    li {
      display: block;
    }
  }
}
            
        </style>
        
        
    </head>
    <body>
    <div class="container">
        <h1>@yield('header')</h1>
        <div>
        @yield('conteudo')

    @if(session()->has('msg'))
            <br><br>
            <div class="alert alert-danger" role="alert">
            <h4>{{session('msg')}}</h4>
            </div>
    @endif        
    
            
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
      </li>
      @if(Gate::allows('admin'))
      <li class="nav-item">
        <a class="nav-item nav-link" href="{{route('users.index')}}">Users</a>
      </li>
      @endif
      @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            
                        @endguest
      
    </ul>
  </div>
</nav>
            
        </div>
    </div>
</div>
        <script src="{{asset('js/jquery-3.5.1.min.js')}}"></script>
        <script src="{{asset('js/bootstrap.min.js')}}"></script>
        <script src="{{asset('js/all.min.js')}}"></script>
</body>
</html>






