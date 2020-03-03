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

    </head>
    <body>
        <div id="app">
            <v-app>
                <header class="elevation-3">
                    <div class="container">
                        <div class="row">
                            <div class="col-4 py-0">
                                <a href="/">
                                    <v-img max-width="200px" src="https://grandiose.net/wp-content/uploads/2019/10/grandiose-logo-v3.svg"></v-img>
                                </a>
                            </div>
                            <div class="col-8 py-0 d-flex align-center">
                                <v-text-field
                                    label="Search Jobs"
                                    single-line
                                    outlined
                                    hide-details
                                    dense
                                    class="ml-auto"
                                    style="max-width:300px;"
                                ></v-text-field>
                            </div>
                        </div>
                    </div>
                </header>
                <v-content>
                    <div class="container">
                        this is the content
                    </div>
                </v-content>
            </v-app>
        </div>
        <script src="{{ asset('js/app.js') }}" defer></script>
    </body>
</html>
