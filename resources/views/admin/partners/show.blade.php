@extends('admin.base')

@section('content')
    <section class="dd-page-header clearfix">
        <h1 class="pull-left">{{ $partner->name }}</h1>
        <div class="header-actions pull-right">
            <a href="/admin/partners/{{ $partner->id }}/edit" class="btn dd-btn btn-light">Edit</a>
            @include('admin.partials.deletebutton', [
                'objectName' => $partner->name,
                'deleteFormAction' => '/admin/partners/' . $partner->id
            ])
        </div>
    </section>
    <section class="associate-show row">
        <div class="col-md-6">
            <p class="lead">Show partner on site?</p>
            <toggle-switch identifier="1"
                           true-label="yes"
                           false-label="no"
                           :initial-state="{{ $partner->published ? 'true' : 'false' }}"
                           toggle-url="/admin/partners/{{ $partner->id }}/publish"
                           toggle-attribute="publish"
            ></toggle-switch>
            <p class="lead">{!! nl2br($partner->writeup) !!}</p>
            <div class="social-icon-row">
                @foreach($partner->socialLinks as $link)
                    <a href="{{ $link->url }}">
                        @include('svgicons.social.' . $link->platform)
                    </a>
                @endforeach
            </div>
        </div>
        <div class="col-md-6 single-image-uploader-box">
            <single-upload default="{{ $partner->modelImage('thumb') }}"
                           url="/admin/partners/{{ $partner->id }}/image"
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

