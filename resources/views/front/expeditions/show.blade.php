@extends('front.base')

@section('head')
    <style>
        .expedition-banner {
            background: url({{ $expedition->modelImage('banner') }});
            background-size: cover;
        }
    </style>
@endsection

@section('content')
    <header class="page-header expedition-banner">

    </header>
    <section class="page-section expedition-show">
        <h1 class="section-heading">{{ $expedition->name }}</h1>
        <p class="expedition-location light-heading">Where: {{ $expedition->location }}</p>
        <p class="expedition-start-date light-heading">When: {{ $expedition->start_date }}</p>
        <p class="body-text page-text">{!! nl2br($expedition->writeup) !!}</p>
        <p class="expedition-duration light-heading">Duration: {{ $expedition->duration }}</p>
        <p class="expedition-capacity light-heading">Number of People: {{ $expedition->capacity }}</p>
        <p class="expedition-difficulty light-heading">Difficulty: {{ $expedition->difficulty }}</p>
        <signup-widget expedition-slug="{{ $expedition->slug }}"
                       expedition-name="{{ $expedition->name }}"
        ></signup-widget>
    </section>
@endsection