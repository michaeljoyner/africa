@extends('admin.base')

@section('content')
    <section class="dd-page-header clearfix">
        <h1 class="pull-left">{{ $member->name }}</h1>
        <div class="header-actions pull-right">
            <a href="/admin/members/{{ $member->id }}/edit" class="btn dd-btn btn-light">Edit</a>
            @include('admin.partials.deletebutton', [
                'objectName' => $member->name,
                'deleteFormAction' => '/admin/members/' . $member->id
            ])
        </div>
    </section>
    <section class="associate-show row">
        <div class="col-md-6">
            <p class="lead">Show team member on site?</p>
            <toggle-switch identifier="1"
                           true-label="yes"
                           false-label="no"
                           :initial-state="{{ $member->published ? 'true' : 'false' }}"
                           toggle-url="/admin/members/{{ $member->id }}/publish"
                           toggle-attribute="publish"
            ></toggle-switch>
            <p class="lead">{!! nl2br($member->writeup) !!}</p>
            <div class="social-icon-row">
                @foreach($member->socialLinks as $link)
                    <a href="{{ $link->url }}">
                        @include('svgicons.social.' . $link->platform)
                    </a>
                @endforeach
            </div>
        </div>
        <div class="col-md-6 single-image-uploader-box">
            <single-upload default="{{ $member->modelImage('thumb') }}"
                           url="/admin/members/{{ $member->id }}/image"
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

