@extends('front.base')

@section('content')
    <header class="page-header expeditions-banner thinner">

    </header>
    <section class="page-section">
        <h1 class="section-heading">Expeditions</h1>
        <div class="expeditions-index">
            @foreach($expeditions as $expedition)
                <div class="expedition-index-card">
                    <img src="{{ $expedition->modelImage('thumb') }}" alt="{{ $expedition->name }}">
                    <p class="expedition-name light-heading">{{ $expedition->name }}</p>
                    <p class="expedition-date body-text"><strong>Date: </strong>{{ $expedition->start_date }}</p>
                    <p class="body-text expedition-description">{{ $expedition->description }}</p>
                    <a href="/expeditions/{{ $expedition->slug }}" class="btn block-btn expedition-card-btn">View Expedition</a>
                </div>
            @endforeach
        </div>
    </section>
@endsection