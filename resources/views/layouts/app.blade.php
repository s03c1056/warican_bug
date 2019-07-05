<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>割can</title>
    <script src="{{ secure_asset('js/app.js') }}" ></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{ secure_asset('js/api_ajax.js') }}" ></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ secure_asset('css/warican.css') }}">    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
   
</head>

<body>

    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-color shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Warican
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('ログイン') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('新規会員登録') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('ログアウト') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        
     @yield('content')

    <footer>
       <nav>
            <ul class="undermenu">
                <li class="a2">
                    <div class="a1a">
                        <img src="/image/underhome.png" alt="" class="a2a">
                        <a href="{{ url ('/') }}">Home</a>
                    </div>
                </li>

                <li class="a3">
                    <div class="a1a">
                        <img src="/image/underomise.png" alt="" class="a2a">
                        <a href="https://tabelog.com/">お店探索</a>
                    </div>
                </li>

                <li class="a4">
                    <div class="a1a">
                        <img src="/image/undershotai.png" alt="" class="a2a">
                        <a href="{{ url ('/') }}">招待</a>
                    </div>
                </li>

                <li class="a5">
                    <div class="a1a">
                        <img src="/image/underq&a.png" alt="" class="a2a">
                        <a href="{{ url ('/') }}">Q&A</a>
                    </div>
                </li>
                
                <li class="a1">
                    <div class="a1a">
                        <img src="/image/underuser.png" alt="" class="a2a">
                        <a href="{{ url ('/') }}">基本情報</a>
                    </div>
                </li>
            </ul>
        </nav>
    </footer>
</body>

</html>