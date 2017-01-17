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
        <p class="body-text large-text page-text centered-text">Whether you want to explore hiking trails around South Africa or get more information about how to get started in your quest to explore high altitude peaks, we’ll be happy to guide you through your journey. Complete the form below and provide us with a brief background regarding your project.</p>
        <contact-form></contact-form>
    </section>

@endsection

@section('bodyscripts')


@endsection