<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

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
                    <div class="container py-0">
                        <div class="row">
                            <div class="col-4 py-0">
                                <a href="/">
                                    <v-img max-width="300px" src="img/gag.png"></v-img>
                                </a>
                            </div>
                            <div class="col-8 py-0 d-flex align-center">
                                <v-text-field
                                    label="Find Jobs"
                                    single-line
                                    outlined
                                    hide-details
                                    dense
                                    color="grey"
                                    class="ml-auto"
                                    style="max-width:480px;"
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
        <div id="ldr">
            <div class="loader">
                <img src="https://cdn.shortpixel.ai/spai/q_glossy+ret_img+to_webp/https://mel-7.com/wp-content/uploads/2019/03/romel-indemne.svg" alt="Romel Indemne">
            </div>
        </div>
        <script src="{{ asset('js/app.js') }}" defer></script>
    </body>
</html>
