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
</head>
<body>
    <div id="app">
        <v-app>
            @guest
            @else
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @endguest 
           
            <admin-header :auth-user="{{ Auth::user() }}"/>
            <v-content>
                <v-container
                    fluid
                    fill-height
                    class="grey lighten-4"
                    >
                    @yield('admin-content')
                </v-container>
            </v-content>
        </v-app>
    </div>
    <div id="ldr">
        <div class="loader">
            <img src="https://cdn.shortpixel.ai/spai/q_glossy+ret_img+to_webp/https://mel-7.com/wp-content/uploads/2019/03/romel-indemne.svg" alt="Romel Indemne">
        </div>
    </div>
</body>
</html>
