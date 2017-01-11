<nav class="main-navbar">
    <div class="branding">
        <a href="/">
            <span class="scrolled-branding">Afrika Freedom Climbers</span>
            {{--<img src="/images/logos/navlogo.png" alt="Africa Freedom Climbers logo">--}}
            <span class="branding-text">AFC</span>
        </a>
    </div>
    <div class="menu-container">
        <label for="nav-trigger" class="nav-trigger-icon">@include('svgicons.menu')</label>
        <input type="checkbox" id="nav-trigger">
        <ul class="main-nav-list">
            <li class="nav-item heavy-text @if(\Illuminate\Support\Facades\Request::path() === '/') active @endif">
                <a href="/">Home</a>
            </li>
            <li class="nav-item heavy-text @if(starts_with(\Illuminate\Support\Facades\Request::path(), 'expeditions')) active @endif">
                <a href="/expeditions">Expeditions</a>
            </li>
            <li class="nav-item heavy-text @if(starts_with(\Illuminate\Support\Facades\Request::path(), 'gallery')) active @endif">
                <a href="/gallery">Gallery</a>
            </li>
            <li class="nav-item heavy-text @if(starts_with(\Illuminate\Support\Facades\Request::path(), 'news')) active @endif">
                <a href="/news">News</a>
            </li>
            <li class="nav-item heavy-text  @if(starts_with(\Illuminate\Support\Facades\Request::path(), 'contact')) active @endif">
                <a href="/contact">Contact Us</a>
            </li>
        </ul>
    </div>
</nav>