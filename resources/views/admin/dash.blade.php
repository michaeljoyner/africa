@extends('admin.base')

@section('head')
    <style>
        .dash_banner_image {
            max-width: 60%;
            display: block;
            margin: -100px auto 0;
        }

        h1 {
            text-align: center;
        }
    </style>
@endsection

@section('content')
    <img class="dash_banner_image" src="/images/logos/logo_dim.jpg" alt="">
    <h1 class="text-uppercase">Welcome to your admin section. Use the nav bar to add content.</h1>
@endsection