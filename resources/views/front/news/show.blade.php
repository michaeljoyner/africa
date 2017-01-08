@extends('front.base')

@section('content')
    <article class="page-section article-show">
        <h1 class="section-heading">{{ $article->title }}</h1>
        <p class="article-published-date light-heading">{{ $article->published_on->toFormatteddateString() }}</p>
        <div class="social-sharing-icons">
            <a href="https://twitter.com/home?status={{ urlencode($article->title . ' ' . Request::url()) }}">
                @include('svgicons.social.twitter')
            </a>
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::url()) }}">
                @include('svgicons.social.facebook')
            </a>
            <a href="mailto:?&subject=Read&body={{ Request::url() }}">
                @include('svgicons.social.email')
            </a>
        </div>
        <section class="article-body">
            {!! $article->body !!}
        </section>
        <a href="/news" class="btn block-btn back-to-news">Back to News</a>
    </article>
@endsection