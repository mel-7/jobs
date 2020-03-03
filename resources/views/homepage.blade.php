<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Ghassan Aboud Group Vacancies') }}</title>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        {{-- <link href="https://unpkg.com/vuetify/dist/vuetify.min.css" rel="stylesheet"> --}}

    </head>
    <body>
        <div id="app">
            <v-card>
                <div class="d-flex flex-row">
                    <div class="logo">
                        <a href="/" class="d-flex">
                            <img src="https://gagroup.net/wp-content/uploads/2017/09/GHASSAN-ABOUD-GROUP-LOGO-03-e1562127584772.png" alt="Ghassan Aboud Group">
                        </a>
                    </div>  
                    <v-text-field
                    solo
                    flat
                    hide-details
                    label="Search"
                    append-inner-icon="mdi-magnify"
                    style="border:1px solid #eee;"
                    ></v-text-field>
                </div>
            </v-card>
        </div>
        <script src="{{ asset('js/app.js') }}" defer></script>
    </body>
</html>
