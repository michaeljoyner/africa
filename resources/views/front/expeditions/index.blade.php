@extends('front.base')

@section('title')
    Expeditions - Afrika Freedom Climbers
@endsection

@section('head')
    @include('front.partials.ogmeta', [
        'ogDescription' => 'Afrika Freedom Climbers arrange high altitude mountain expeditions in order to raise funds and promote women in adventure sports. Browse through the expeditions we currently offer and feel free to get in touch.',
        'ogTitle' => 'Expeditions - Afrika Freedom Climbers',
        'ogImage' => url('/images/logos/logo_og.jpg')
    ])
@endsection

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