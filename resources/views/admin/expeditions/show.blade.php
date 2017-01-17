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
            <p class="helpful-tip">The image you upload needs to work at two different ratios, 4:3 and 10:3. So if there is any important detail try ensure it is centered in the image, and generally try use images wider than 1400px and having a ratio close to 10:3</p>
            <single-upload default="{{ $expedition->modelImage('banner') }}"
                           url="/admin/expeditions/{{ $expedition->id }}/image"
                           shape="square"
                           size="preview"
                           :preview-width="700"
                           :preview-height="210"
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
            <p class="info-field-value">{{ $expedition->location ?? 'not set' }}</p>
            <p class="info-label">Start Date</p>
            <p class="info-field-value">{{ $expedition->start_date ?? 'not set' }}</p>
            <p class="info-label">End Date</p>
            <p class="info-field-value">{{ $expedition->end_date ?? 'not set' }}</p>
            <p class="info-label">Duration</p>
            <p class="info-field-value">{{ $expedition->duration ?? 'not set' }}</p>
        </div>
        <div class="col-md-offset2 col-md-5">
            <p class="info-label">Places Available</p>
            <p class="info-field-value">{{ $expedition->capacity ?? 'not set' }}</p>
            <p class="info-label">Places Remaining</p>
            <p class="info-field-value">{{ $expedition->places_remaining ?? 'not set' }}</p>
            <p class="info-label">Difficulty</p>
            <p class="info-field-value">{{ $expedition->difficulty ?? 'not set' }}</p>
        </div>
    </section>
    @include('admin.partials.deletemodal')
@endsection

@section('bodyscripts')
    @include('admin.partials.modalscript')
@endsection

