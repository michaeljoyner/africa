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
        <p class="expedition-location body-text"><span class="light-heading">Where: </span>{{ $expedition->location }}</p>
        <p class="expedition-start-date body-text"><span class="light-heading">When: </span>{{ $expedition->start_date }}</p>
        <p class="expedition-duration body-text"><span class="light-heading">Duration: </span>{{ $expedition->duration }}</p>
        <p class="expedition-capacity body-text"><span class="light-heading">Number of people: </span>{{ $expedition->capacity }}</p>
        <p class="expedition-difficulty body-text"><span class="light-heading">Difficulty: </span>{{ $expedition->difficulty }}</p>
        <p class="body-text page-text">{!! nl2br($expedition->writeup) !!}</p>
        <signup-widget expedition-slug="{{ $expedition->slug }}"
                       expedition-name="{{ $expedition->name }}"
        ></signup-widget>
    </section>
@endsection