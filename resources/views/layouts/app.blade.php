<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
@font-face {
    font-family: Comfortaa;
    src: url("./Comfortaa/Comfortaa-VariableFont_wght.ttf");
  }

  html{
      background-color: #A9DEEF;
      font-family: Comfortaa;
    }

  a{
     color: black;
     text-decoration: none;
    }

  .page{
    display: flex;
    justify-content: space-between;
  }

  .orda_mail{
      font-size: 28px;
      text-align: center;
    }
  .orda_mail>p{
     margin: 0;
    }
    .logo{
    display: flex;
     width: 100%;
     background-color: white;
     border-radius: 10px;
     border: 1px solid black;
     margin: 30px 0;
     align-items: center;
     padding: 3px;
    }

    .panel{
     display: flex;
     width: 100%;
     background-color: white;
     border-radius: 10px;
     border: 1px solid black;
     margin: 5px 0;
     align-items: center;
     padding: 3px;
    }

   .imgPanel{
     width: 40px;
     height: 40px;
    }

    .newMessage{
     font-size: 24px;
     text-align: center;
     padding: 0 5px;
    }
   .newMessage>p{
      margin:  0;
    }

  .mails{
      width: 90%;
      background-color: white;
      border-radius: 10px;
      border: 1px solid black;
      margin: 110px 20px;
      height: calc(100vh - 220px);
      padding: 20px;
  }

  textarea {
    resize: none;
    width: 100%;
    height: 30px;
  }


  .person{
      border: 0;
      width: 80%;
  }

  .flex-end {
    display: flex;
    justify-content: flex-end;
  }

  .img{
    width: 40px;
    height: auto;
  }</style>


</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
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
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
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
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
