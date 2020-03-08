@extends('layouts.admin')

@section('admin-content')

    <edit-post :post="{{ $post->toJson() }}"></edit-post>

@endsection