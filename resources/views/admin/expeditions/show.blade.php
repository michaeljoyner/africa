@extends('admin.base')

@section('content')
    <section class="dd-page-header clearfix">
        <h1 class="pull-left">{{ $expedition->name }}</h1>
        <div class="header-actions pull-right">
            <a href="/admin/expeditions/{{ $expedition->id }}/edit" class="btn dd-btn btn-light">Edit</a>
            @include('admin.partials.deletebutton', [
                'objectName' => $expedition->name,
                'deleteFormAction' => '/admin/expeditions/' . $expedition->id
            ])
        </div>
    </section>
    <section class="associate-show row">
        <div class="col-md-4">
            <p class="lead">Show expedition on site?</p>
            <toggle-switch identifier="1"
                           true-label="yes"
                           false-label="no"
                           :initial-state="{{ $expedition->published ? 'true' : 'false' }}"
                           toggle-url="/admin/expeditions/{{ $expedition->id }}/publish"
                           toggle-attribute="publish"
            ></toggle-switch>
            <p class="inf-label">SEO Description</p>
            <p class="lead">{{ $expedition->description }}</p>
        </div>
        <div class="col-md-8 single-image-uploader-box">
            <single-upload default="{{ $expedition->modelImage('banner') }}"
                           url="/admin/expeditions/{{ $expedition->id }}/image"
                           shape="square"
                           size="preview"
                           :preview-width="700"
                           :preview-height="300"
            ></single-upload>
        </div>
    </section>
    <hr>
    <section>
        <p class="info-label">Writeup</p>
        <p class="lead">{!! nl2br($expedition->writeup) !!}</p>
    </section>
    <hr>
    <section class="row">
        <div class="col-md-5">
            <p class="info-label">Location</p>
            <p class="info-field-value">{{ $expedition->location }}</p>
            <p class="info-label">Start Date</p>
            <p class="info-field-value">{{ $expedition->start_date }}</p>
            <p class="info-label">Duration</p>
            <p class="info-field-value">{{ $expedition->duration }}</p>
        </div>
        <div class="col-md-offset2 col-md-5">
            <p class="info-label">Number of People</p>
            <p class="info-field-value">{{ $expedition->capacity }}</p>
            <p class="info-label">Difficulty</p>
            <p class="info-field-value">{{ $expedition->difficulty }}</p>
        </div>
    </section>
    @include('admin.partials.deletemodal')
@endsection

@section('bodyscripts')
    @include('admin.partials.modalscript')
@endsection

