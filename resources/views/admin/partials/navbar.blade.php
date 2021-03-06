<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/" target="_blank">
                <img src="{{ asset('images/tofront.svg') }}" width="20" height="20" alt="logo"/>
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="/admin/members"
                       @if(starts_with(Request::path(), 'admin/member')) class="active" @endif
                    >Team Members</a>
                </li>
                <li><a href="/admin/expeditions" @if(starts_with(Request::path(), 'admin/expeditions'))
                    class="active" @endif>Expeditions</a></li>
                <li class="dropdown">
                    <a href="#"
                       class="dropdown-toggle @if(starts_with(Request::path(), 'admin/partner') || starts_with(Request::path(), 'admin/associate')) active @endif"
                       data-toggle="dropdown"
                       role="button"
                       aria-haspopup="true"
                       aria-expanded="false"
                    >Associates <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/admin/partners">Partners</a></li>
                        <li><a href="/admin/associates">Sponsors</a></li>
                    </ul>
                </li>
                <li><a href="/admin/posts" @if(starts_with(Request::path(), 'admin/post')) class="active" @endif>News</a></li>
                <li><a href="/admin/albums" @if(starts_with(Request::path(), 'admin/album')) class="active" @endif>Gallery</a></li>
                <li><a href="/admin/documents" @if(starts_with(Request::path(), 'admin/document')) class="active" @endif>Compliance</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li><a href="/admin/users">Users</a></li>
                <li class="dropdown">
                    <a href="#"
                       class="dropdown-toggle"
                       data-toggle="dropdown"
                       role="button"
                       aria-haspopup="true"
                       aria-expanded="false"
                    >{{ Auth::user()->email }} <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/admin/users/{{ Auth::user()->id }}/password/edit">Reset Password</a></li>
                        <li><a href="/admin/logout">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>