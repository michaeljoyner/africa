<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title', 'Afrika Freedom Climbers')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1 shrink-to-fit=no">
    <link rel="stylesheet" href="{{ elixir('css/fapp.css') }}">
    @yield('head')
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="/manifest.json">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="apple-mobile-web-app-title" content="Afrika Freedom Climbers ">
    <meta name="application-name" content="Afrika Freedom Climbers ">
    <meta name="theme-color" content="#A62931">
    <script>
        var Laravel = {
            csrfToken: '{{ csrf_token() }}'
        }
    </script>
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,700|Roboto:900" rel="stylesheet">
</head>
<body>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<div class="main-container" id="app">
    @include('front.partials.navbar')
    <div class="page-content">
        @yield('content')
    </div>
    @include('front.partials.footer')
</div>
<script src="{{ elixir('js/front.js') }}"></script>
@yield('bodyscripts')
        <!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
<script>
    window.ga=function(){ga.q.push(arguments)};ga.q=[];ga.l=+new Date;
    ga('create','UA-XXXXX-Y','auto');ga('send','pageview')
</script>
<script src="https://www.google-analytics.com/analytics.js" async defer></script>
</body>
</html>