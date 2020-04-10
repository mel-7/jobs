@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <applicant-side-nav></applicant-side-nav>
        <router-view></router-view>
    </div>
</div>
@endsection
