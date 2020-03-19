<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

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
            @if (\Route::current()->getName() != 'login')
                <header class="elevation-3">
                    <div class="container py-0">
                        <div class="row">
                            <div class="col-4 py-0">
                                <a href="{{ URL::to('/') }}">
                                    <v-img max-width="300px" src="{{ URL::to('/img/gag.png') }}"></v-img>
                                </a>
                            </div>
                        </div>
                    </div>
                </header>
            @endif
            <v-content>
                @yield('content')
            </v-content>
    </div>
    <div id="ldr">
        <div class="loader">
            <img src="https://cdn.shortpixel.ai/spai/q_glossy+ret_img+to_webp/https://mel-7.com/wp-content/uploads/2019/03/romel-indemne.svg" alt="Romel Indemne">
        </div>
    </div>
</body>
</html>
