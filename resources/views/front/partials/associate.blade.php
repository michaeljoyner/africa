<div class="team-member">
    <img src="{{ $associate->modelImage('thumb') }}" alt="{{ $associate->name }}" class="{{ $round ?? '' }}">
    <p class="member-name light-heading">{{ $associate->name }}</p>
    <p class="member-info body-text">{{ $associate->writeup }}</p>
    <div class="social-icon-row">
        @foreach($associate->socialLinks as $link)
            <a href="{{ $link->url }}">
                @include('svgicons.social.' . $link->platform)
            </a>
        @endforeach
    </div>
</div>