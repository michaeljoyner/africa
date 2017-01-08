@extends('front.base')

@section('content')
    <header class="page-header gallery-banner">

    </header>
    <section class="page-section">
        <h1 class="section-heading">Gallery</h1>
        <div class="albums-grid">
            @foreach($albums as $media)
                <div class="media-image-card">
                    <dd-lightbox :open="false"
                                 title="{{ $media->title }}"
                                 main-src="{{ $media->modelImage('thumb') }}"
                                 :gallery-images='{{
                 json_encode($media->galleryImages()->map(function($image) { return ['src' => $image->getUrl()]; })->toArray())
                 }}'
                    ></dd-lightbox>
                    <p class="media-image-card-title heavy-heading">{{ $media->title }}</p>
                </div>
            @endforeach
        </div>
    </section>
@endsection