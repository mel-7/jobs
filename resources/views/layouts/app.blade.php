<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="page">
    <div id="app">
        <v-app>
            @if (\Route::current()->getName() != 'login')
                <header class="elevation-3">
                    <div class="container py-0">
                        <div class="row">
                            <div class="col-4 py-0 d-flex align-center">
                                <a href="{{ URL::to('/') }}">
                                    <v-img max-width="150px" src="{{ URL::to('/img/gag.png') }}"></v-img>
                                </a>
                            </div>
                            <v-spacer></v-spacer>
                            @guest
                                <div class="col-2 d-flex justify-end">
                                    <div class="my-2 mr-2">
                                        <v-btn text color="primary" href="{{ route('login') }}">{{ __('Login') }}</v-btn>
                                    </div>
                                    @if (Route::has('register'))
                                    <div class="my-2">
                                        <v-btn color="primary" href="{{ route('register') }}">{{ __('Register') }}</v-btn>
                                    </div>
                                    @endif
                                </div>
                            @else
                                <div class="d-flex align-center px-3">
                                    <v-menu
                                        v-model="menu"
                                        :close-on-content-click="false"
                                        :nudge-width="150"
                                        transition="slide-y-transition"
                                        offset-y
                                        :nudge-bottom="3"
                                    >
                                        <template v-slot:activator="{ on }">
                                            <v-btn text icon v-on="on">
                                                <v-avatar size="36">
                                                <img src="https://mel-7.com/wp-content/uploads/2019/04/romel-indemne-v1.jpg" alt="Romel Indemne">
                                                </v-avatar>
                                            </v-btn>
                                        </template>
                                        <v-card>
                                            <v-list>
                                                <v-list-item>
                                                <v-list-item-avatar>
                                                    <img src="https://mel-7.com/wp-content/uploads/2019/04/romel-indemne-v1.jpg" alt="Romel Indemne">
                                                </v-list-item-avatar>
                                                <v-list-item-content>
                                                    <v-list-item-title> {{ Auth::user()->name }} </v-list-item-title>
                                                    <v-list-item-subtitle>{{ Auth::user()->email }}</v-list-item-subtitle>
                                                </v-list-item-content>
                                                </v-list-item>
                                            </v-list>
                                            <v-divider></v-divider>
                                            <v-card-actions>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                                <v-btn depressed v-on:click="logout" width="100%">Logout</v-btn>
                                            </v-card-actions>
                                        </v-card>
                                    </v-menu>
                                </div>
                            @endguest
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
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
