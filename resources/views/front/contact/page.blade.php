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
    <header class="page-header contact-banner thinner">

    </header>
    <section class="page-section">
        <h1 class="section-heading">Contact Us</h1>
        <p class="body-text large-text page-text centered-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam maxime, quibusdam? Accusamus accusantium assumenda.</p>
        <contact-form></contact-form>
    </section>

@endsection

@section('bodyscripts')


@endsection