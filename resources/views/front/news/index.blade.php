@extends('front.base')

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