@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <router-view :user="{{ Auth::user() }}"></router-view>
    </div>
</div>
@endsection
