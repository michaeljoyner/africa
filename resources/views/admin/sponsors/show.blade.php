@extends('admin.base')

@section('content')
    <section class="dd-page-header clearfix">
        <h1 class="pull-left">{{ $sponsor->name }}</h1>
        <div class="header-actions pull-right">
            <a href="/admin/associates/{{ $sponsor->id }}/edit" class="btn dd-btn btn-light">Edit</a>
            @include('admin.partials.deletebutton', [
                'objectName' => $sponsor->name,
                'deleteFormAction' => '/admin/associates/' . $sponsor->id
            ])
        </div>
    </section>
    <section class="associate-show row">
        <div class="col-md-6">
            <p class="lead">Publish sponsor on site?</p>
            <toggle-switch identifier="1"
                           true-label="yes"
                           false-label="no"
                           :initial-state="{{ $sponsor->published ? 'true' : 'false' }}"
                           toggle-url="/admin/associates/{{ $sponsor->id }}/publish"
                           toggle-attribute="publish"
            ></toggle-switch>
            <p class="lead">{!! nl2br($sponsor->writeup) !!}</p>
            <div class="social-icon-row">
                @foreach($sponsor->socialLinks as $link)
                    <a href="{{ $link->url }}">
                        @include('svgicons.social.' . $link->platform)
                    </a>
                @endforeach
            </div>
        </div>
        <div class="col-md-6 single-image-uploader-box">
            <p class="helpful-tip">Try upload images that are perfect squares and larger than 300px x 300px</p>
            <single-upload default="{{ $sponsor->modelImage('thumb') }}"
                           url="/admin/associates/{{ $sponsor->id }}/image"
                           shape="square"
                           size="large"
            ></single-upload>
        </div>
    </section>
    @include('admin.partials.deletemodal')
@endsection

@section('bodyscripts')
    @include('admin.partials.modalscript')
@endsection

