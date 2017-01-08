@extends('admin.base')

@section('content')
    <section class="dd-page-header clearfix">
        <div class="header-actions pull-right">
            <a href="/admin/albums/{{ $album->id }}/edit" class="btn dd-btn btn-light">Edit</a>
            @include('admin.partials.deletebutton', [
                'objectName' => $album->title,
                'deleteFormAction' => '/admin/albums/' . $album->id
            ])
        </div>
    </section>
    <section class="associate-show row">
        <div class="col-md-6">
            <h1>{{ $album->title }}</h1>
            <p class="lead">Should album be public?</p>
            <toggle-switch identifier="1"
                           true-label="yes"
                           false-label="no"
                           :initial-state="{{ $album->published ? 'true' : 'false' }}"
                           toggle-url="/admin/albums/{{ $album->id }}/publish"
                           toggle-attribute="publish"
            ></toggle-switch>
            <p class="lead">The album should have at least a main image, which can be uploaded on the right. The main image counts as part of the gallery and doesn't need to be included with gallery images below. For all album/gallery images, try use images greater than 800px wide.</p>
        </div>
        <div class="col-md-6 single-image-uploader-box">
            <single-upload default="{{ $album->modelImage('thumb') }}"
                             url="/admin/albums/{{ $album->id }}/main-image"
                             shape="square"
                             size="preview"
                             :preview-width="400"
                             :preview-height="300"
            ></single-upload>
        </div>
    </section>
    <hr>
    <section class="album-gallery-section">
        <h2>Album Gallery</h2>
        <dropzone url="/admin/api/albums/{{ $album->id }}/gallery/images"></dropzone>
        <gallery-show gallery="{{ $album->id }}"
                      geturl="/admin/api/albums/{{ $album->id }}/gallery/images"
                      delete-url = "/admin/api/albums/{{ $album->id }}/gallery/images/"
        >
        </gallery-show>
    </section>
    @include('admin.partials.deletemodal')
@endsection

@section('bodyscripts')
    @include('admin.partials.modalscript')
@endsection

