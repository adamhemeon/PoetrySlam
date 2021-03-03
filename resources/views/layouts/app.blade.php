<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Media Feed') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600" rel="stylesheet">

    <!-- Styles -->
    @if (Cookie::get('remembered_theme') == null)
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @else
        @foreach($themes as $theme)
            @if($theme->id == Cookie::get('remembered_theme'))
                <link rel="stylesheet" type="text/css" href="{{$theme->cdn_url}}">
            @endif
        @endforeach
    @endif

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Media Feed') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <form action="/redirect" method="post"> {{-- withCookie --}}
                            @csrf
                            <label for="theme"></label>
                            <select name="theme" id="theme" onchange='this.form.submit()'>
                                {{ $selected = '' }}
                                <option value="">Default</option>
                                @foreach($themes as $theme)
                                    @if($theme->id == Cookie::get('remembered_theme'))
                                        {{ $selected = 'selected' }}
                                    @else
                                        {{ $selected = '' }}
                                    @endif
                                    <option {{$selected}} value="{{$theme->id}}">{{$theme->name}}</option>
                                @endforeach
                            </select>
                            <noscript><input type="submit" value="Submit"></noscript>
                        </form>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
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

                            <!-- Custom Links -->
                            <li><a class="nav-link" href="/home">Posts</a></li>

                            <!-- Role-Specific Links -->
                            @foreach(Auth::user()->roles as $role)
                                @if($role->name == "Theme Manager")
                                    <li><a class="nav-link" href="/admin/themes">Manage Themes</a></li>
                                @endif
                                @if($role->name == "User Administrator")
                                    <li><a class="nav-link" href="/admin/users">Manage Users</a></li>
                                @endif
                            @endforeach

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
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
<footer class="footer text-muted text-md-center">2020 Created by Adam Hemeon - NSCC INET2005 Final Assignment</footer>
</html>
