@extends('front.base')

@section('title')
    News - Afrika Freedom Climbers
@endsection

@section('head')
    @include('front.partials.ogmeta', [
        'ogDescription' => 'Keep up with the latest news, events and opinions of Afrika Freedom Climbers',
        'ogTitle' => 'News - Afrika Freedom Climbers',
        'ogImage' => url('/images/logos/logo_og.jpg')
    ])
@endsection

@section('content')
    <header class="page-header news-banner thinner">

    </header>
    <section class="page-section">
        <h1 class="section-heading">Our News</h1>
        @foreach($articles as $article)
            <a href="/news/{{ $article->slug }}">
                @include('front.news.articlecard')
            </a>
        @endforeach
    </section>
    <div class="pagination">
        {!! $articles->links() !!}
    </div>
@endsection