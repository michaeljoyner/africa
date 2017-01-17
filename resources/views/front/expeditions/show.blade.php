@extends('front.base')

@section('title')
    {{ $expedition->name }} - An Afrika Freedom Climbers Expedition
@endsection

@section('head')
    <style>
        .expedition-banner {
            background: url({{ $expedition->modelImage('banner') }});
            background-size: cover;
        }
    </style>
    @include('front.partials.ogmeta', [
        'ogDescription' => $expedition->description,
        'ogTitle' => $expedition->name . ' - An Afrika Freedom Climbers Expedition',
        'ogImage' => url($expedition->modelImage())
    ])
@endsection

@section('content')
    <header class="page-header expedition-banner thinner">

    </header>
    <section class="page-section expedition-show">
        <h1 class="section-heading">{{ $expedition->name }}</h1>
        <p class="expedition-location body-text"><span class="light-heading">Where: </span>{{ $expedition->location }}</p>
        @if($expedition->start_date)
        <p class="expedition-start-date body-text"><span class="light-heading">Starts: </span>{{ $expedition->start_date }}</p>
        @endif
        @if($expedition->end_date)
        <p class="expedition-start-date body-text"><span class="light-heading">Ends: </span>{{ $expedition->end_date }}</p>
        @endif
        @if($expedition->duration)
        <p class="expedition-duration body-text"><span class="light-heading">Duration: </span>{{ $expedition->duration }}</p>
        @endif
        <p class="expedition-capacity body-text"><span class="light-heading">Places available: </span>{{ $expedition->capacity }}</p>
        @if($expedition->places_remaining)
            <p class="expedition-capacity body-text"><span class="light-heading">Places remaining: </span>{{ $expedition->places_remaining }}</p>
        @endif
        <p class="expedition-difficulty body-text"><span class="light-heading">Difficulty: </span>{{ $expedition->difficulty }}</p>
        <p class="body-text page-text">{!! nl2br($expedition->writeup) !!}</p>
        <signup-widget expedition-slug="{{ $expedition->slug }}"
                       expedition-name="{{ $expedition->name }}"
        ></signup-widget>
    </section>
@endsection