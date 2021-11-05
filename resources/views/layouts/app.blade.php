<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Latest compiled and minified CSS -->
    <link href="{{ asset('assets/css/bootstrap_5_1_1.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('titre')</title>

    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- Styles -->
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
</head>
<body style="position: relative;">
    <nav class="navbar navbar-light bg-light fixed-top border-bottom">
        <div class="container-fluid">
            <nav class="navbar navbar-light bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{ asset('assets/logo.jpg') }}" alt="" width="40" height="40" class="d-inline-block align-text-top">
                    {{ config('app.name') }}
                    </a>
                </div>
            </nav>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            @auth
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">
                        
                            {{ Auth::user()->name }}
                        
                    </h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('home') }}">{{ __('Actualiés') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile') }}">{{ __('Profile') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('settings.home') }}">{{ __('Réglages') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}">{{ __('Déconnexion') }}</a>
                    </li>
                    <li class="nav-item mt-2">
                        <button  type="button" class="btn btn-secondary"  data-bs-toggle="modal" data-bs-target="#modalsearchuser" >{{ __('Chercher') }}</button>
                    </li>
                    
                </div>
            

            @else
            <div class="offcanvas-header">
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('login') }}">{{ __('Connexion') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
            @endauth
        </div>
    </nav>
    @auth
    <a href="{{ route('notification') }}" style="width: 160px;" class="btn btn-primary fixed-bottom"> {{ __('Notifications') }} <span class="badge bg-secondary">{{ \App\Http\Controllers\SettingController::notificationCount() }}</span></a>
    @endauth
    <div class="py-5">
        <div class="container py-5">
            @yield('content')
        </div>
    </div>
    
    
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script> -->
    <script type="text/javascript" src="{{ asset('assets/js/popper_2_9_3.js')  }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/bootstrap_5_1_1.js')  }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery.js')  }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/myfunc.js')  }}"></script>
</body>
</html>
