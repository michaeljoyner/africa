@extends('admin.base')

@section('content')
    <section class="dd-page-header clearfix">
        <div class="header-actions pull-right">
            <a href="/admin/documents/{{ $document->id }}/edit" class="btn dd-btn btn-light">Edit</a>
            @include('admin.partials.deletebutton', [
                'objectName' => $document->title,
                'deleteFormAction' => '/admin/documents/' . $document->id
            ])
        </div>
    </section>
    <section class="associate-show row">
        <div class="col-md-6">
            <h1>{{ $document->title }}</h1>
            <p class="lead">Should document be available to public?</p>
            <toggle-switch identifier="1"
                           true-label="yes"
                           false-label="no"
                           :initial-state="{{ $document->published ? 'true' : 'false' }}"
                           toggle-url="/admin/documents/{{ $document->id }}/publish"
                           toggle-attribute="publish"
            ></toggle-switch>
            <p class="lead">To set the file for this document, click on the file icon on the right. The most recent
                document uploaded will be the one available if you make it public. Acceptable file types are word
                documents, pdf files, plain text and common image formats.</p>
        </div>
        <div class="col-md-6 single-image-uploader-box">
            <document-upload default="{{ $document->url() }}"
                             url="/admin/documents/{{ $document->id }}/file"
                             shape="square"
                             size="preview"
                             :preview-width="420"
                             :preview-height="594"
            ></document-upload>
        </div>
    </section>
    @include('admin.partials.deletemodal')
@endsection

@section('bodyscripts')
    @include('admin.partials.modalscript')
@endsection

