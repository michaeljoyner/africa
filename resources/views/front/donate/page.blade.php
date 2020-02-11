@extends('front.base')

@section('title')
    Contact Us - Afrika Freedom Climbers
@endsection

@section('head')
    @include('front.partials.ogmeta', [
        'ogDescription' => 'Have you got the taste for adventure or the desire to help? Want to get involved? Have good ideas or just feel you would like to contribute? Contact us at Afrika Freedom Climbers, we would love to hear from you',
        'ogTitle' => 'Contact Us - Afrika Freedom Climbers',
        'ogImage' => url('/images/logos/logo_og.jpg')
    ])
@endsection

@section('content')
    <header class="page-header thinner" style="background: url(/images/banners/donate.jpg); background-position-y: 50%; background-size: cover;background-position-x: 100%;">

    </header>
    <section class="page-section">
        <h1 class="section-heading">Donate</h1>
        <p class="body-text large-text page-text centered-text">Afrika Freedom Climbers is a registered non-profit company (NPC).</p>
        <p class="body-text large-text page-text centered-text">Since 2015 (except for 2019 due to funding challenges), we have been hosting an annual “Ain’t No Mountain High Enough” mountaineering camp for five schools around the Bojanala District in the North West province of South Africa. The objective of the camp is to encourage students who don’t excel in mainstream sports to pursue alternative ways to lead a physically active lifestyle.</p>
        <p class="body-text large-text page-text centered-text">At these camps, we provide hiking gear, food, security and facilitate team building workshops - all of which require funds. You can support us by donating. Refer to our banking details below:</p>

        <p class="body-text large-text page-text">Account name: Afrika Freedom Climbers NPC</p>
        <p class="body-text large-text page-text">Bank: First National Bank</p>
        <p class="body-text large-text page-text">Account No: 62836697055</p>
        <p class="body-text large-text page-text">Branch Code: 252145</p>
        <p class="body-text large-text page-text">Branch Name: Hatfield</p>
        <p class="body-text large-text page-text">Swift code: FIRNZAJJ</p>
        <p class="body-text large-text page-text">Bank Address: Shop 39, Lynwood Road, Hillcrest Boulevard Shopping Center, Hatfield</p>
        <p class="body-text large-text page-text"></p>

        <p class="body-text large-text page-text">Registration Details</p>
        <p class="body-text large-text page-text">Company Reg: 2013/169626/08</p>
    </section>

@endsection

@section('bodyscripts')


@endsection