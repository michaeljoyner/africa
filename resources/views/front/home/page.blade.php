@extends('front.base')

@section('title')
    Afrika Freedom Climbers - Reaching The Summit Of Freedom
@endsection

@section('head')
    @include('front.partials.ogmeta', [
        'ogDescription' => 'Afrika Freedom Climbers is a non-profit organisation that provides women and children, particularly from rural areas in South Africa, with the opportunity to be trained in and participate in high altitude mountaineering sport.',
        'ogTitle' => 'Afrika Freedom Climbers - Reaching The Summit Of Freedom',
        'ogImage' => url('/images/logos/logo_og.jpg')
    ])
@endsection

@section('content')
    <header class="page-header home-banner">
        <div class="logo-backer"></div>
        <img src="/images/logos/logo_tagline_white.png" alt="Afrika Freedom Climbers">
    </header>
    <section class="page-section about-section" id="about">
        <h1 class="section-heading">About</h1>
        <p class="body-text page-text large-text">Afrika Freedom Climbers (AFC) is a non-profit organisation founded in September 2013 by three South African women who identified a gap in participation of women in mountaineering sport. We provide women and children, particularly from rural areas in South Africa, with the opportunity to be trained and participate in high altitude mountaineering sport. The services we offer include provision of information about how to participate in high altitude mountaineering sport; arranging high altitude mountain expeditions; and fundraising for specific projects that promote women in adventure sport.</p>
        <p class="body-text page-text large-text"><strong>Mission:<br /> </strong>To break down barriers to the greater outdoors and diversify the South African mountaineering community.</p>
        <p class="body-text page-text large-text"><strong>Vision:<br /> </strong>A diverse community of South African mountaineers.</p>
        <p class="body-text page-text large-text">
            <strong>Values:<br /> </strong>
            1. Stewardship: We leave nothing but footprints behind.<br />
            2. Diversity: Healthy debates and differences of opinion are encouraged.<br />
            3. Integrity: We are honest, ethical and fair.
        </p>
    </section>
    
    <img src="/images/dividers/divider.png" alt="Afrika Freedom Climbers page divider" class="page-divider">
    <section class="page-section" id="team">
        <h1 class="section-heading">Team</h1>
        <div class="team-container">
            @foreach($members as $member)
                @include('front.partials.associate', ['associate' => $member, 'round' => 'round'])
            @endforeach
        </div>
    </section>
    <img src="/images/dividers/divider2.png" alt="Afrika Freedom Climbers page divider" class="page-divider">
    <section class="page-section" id="partners">
        <h1 class="section-heading">Partners</h1>
        <div class="team-container">
            @foreach($partners as $partner)
                @include('front.partials.associate', ['associate' => $partner, 'round' => 'square'])
            @endforeach
        </div>
    </section>
    <img src="/images/dividers/divider3.png" alt="Afrika Freedom Climbers page divider" class="page-divider">
    <section class="page-section" id="sponsors">
        <h1 class="section-heading">Sponsors</h1>
        <div class="team-container">
            @foreach($sponsors as $sponsor)
                @include('front.partials.associate', ['associate' => $sponsor, 'round' => 'square'])
            @endforeach
        </div>
    </section>
    <img src="/images/dividers/divider4.png" alt="Afrika Freedom Climbers page divider" class="page-divider">
    <section class="page-section" id="compliance">
        <h1 class="section-heading">Compliance</h1>
        <p class="body-text page-text centered-text">At Afrika Freedom Climbers, we completely embrace transparency and we are are a fully compliant charity organisation. Below you will find all the documents that we are required to make public, feel free to click on any title to download.</p>
        <div class="compliance-documents">
            @foreach($documents as $document)
                <div class="document">
                    @if(ends_with($document->path, '.pdf'))
                        <img src="/images/defaults/docs/pdf.png" alt="{{ $document->title }}">
                    @elseif(ends_with($document->path, '.doc') || ends_with($document->path, '.docx'))
                        <img src="/images/defaults/docs/word.png" alt="{{ $document->title }}">
                    @else
                        <img src="/images/defaults/docs/doc.png" alt="{{ $document->title }}">
                    @endif
                    <a href="{{ $document->url() }}" download class="light-heading document-title">{{ $document->title }}</a>
                </div>
            @endforeach
        </div>
    </section>


@endsection