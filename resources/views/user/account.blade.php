@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <applicant-side-nav></applicant-side-nav>
        <router-view :user="{{ Auth::user() }}"></router-view>
        {{-- <div class="col-md-8">
            <div class="card">
                <div class="card-header">Account</div>

                <div class="card-body">
                    This is account page
                </div>
            </div>
        </div> --}}
    </div>
</div>
@endsection
