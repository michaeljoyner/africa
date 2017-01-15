<nav class="main-navbar">
    <div class="branding">
        <a href="/">
            <span class="scrolled-branding @if(Request::path() === '/') scrollable @endif">Afrika Freedom Climbers</span>
            {{--<img src="/images/logos/navlogo.png" alt="Africa Freedom Climbers logo">--}}
            <span class="branding-text">AFC</span>
        </a>
    </div>
    <div class="menu-container">
        <label for="nav-trigger" class="nav-trigger-icon">@include('svgicons.menu')</label>
        <input type="checkbox" id="nav-trigger">
        <ul class="main-nav-list">
            <li class="nav-item heavy-text @if(Request::path() === '/') active @endif">
                <a href="/">Home</a>
                <span class="nav-caret"> @include('svgicons.downcaret')</span>
                <ul class="secondary-nav-list">
                    <li class="secondary-nav-item">
                        <a href="@if(Request::path() !== '/')/@endif#about">About</a>
                    </li>
                    <li class="secondary-nav-item">
                        <a href="@if(Request::path() !== '/')/@endif#team">Team</a>
                    </li>
                    <li class="secondary-nav-item">
                        <a href="@if(Request::path() !== '/')/@endif#partners">Partners</a>
                    </li>
                    <li class="secondary-nav-item">
                        <a href="@if(Request::path() !== '/')/@endif#sponsors">Sponsors</a>
                    </li>
                    <li class="secondary-nav-item">
                        <a href="@if(Request::path() !== '/')/@endif#compliance">Compliance</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item heavy-text @if(starts_with(Request::path(), 'expeditions')) active @endif">
                <a href="/expeditions">Expeditions</a>
            </li>
            <li class="nav-item heavy-text @if(starts_with(Request::path(), 'gallery')) active @endif">
                <a href="/gallery">Gallery</a>
            </li>
            <li class="nav-item heavy-text @if(starts_with(Request::path(), 'news')) active @endif">
                <a href="/news">News</a>
            </li>
            <li class="nav-item heavy-text  @if(starts_with(Request::path(), 'contact')) active @endif">
                <a href="/contact">Contact Us</a>
            </li>
        </ul>
    </div>
</nav>