<div class="article-index-card">
    <div class="article-image">
        <img src="{{ $article->titleImg('thumb') }}" alt="{{ $article->title }}">
    </div>
    <div class="article-overview">
        <h3 class="article-title heavy-heading">{{ $article->title }}</h3>
        <p class="article-published-date light-heading">{{ $article->published_on->toFormattedDateString() }}</p>
        <p class="body-text">{{ $article->description }}</p>
    </div>
</div>