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
        <link href="https://unpkg.com/vuetify/dist/vuetify.min.css" rel="stylesheet">

    </head>
    <body>
        <div id="app">
            <template>
                <v-card
                  color="grey lighten-4"
                  flat
                  height="200px"
                  tile
                >
                  <v-toolbar dense>
                    <v-app-bar-nav-icon></v-app-bar-nav-icon>
              
                    <v-toolbar-title>Title</v-toolbar-title>
              
                    <v-spacer></v-spacer>
              
                    <v-btn icon>
                      <v-icon>mdi-magnify</v-icon>
                    </v-btn>
              
                    <v-btn icon>
                      <v-icon>mdi-heart</v-icon>
                    </v-btn>
              
                    <v-btn icon>
                      <v-icon>mdi-dots-vertical</v-icon>
                    </v-btn>
                  </v-toolbar>
                </v-card>
              </template>
        </div>
        <script src="{{ asset('js/app.js') }}" defer></script>
    </body>
</html>
