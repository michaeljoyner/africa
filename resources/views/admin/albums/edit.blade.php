@extends('admin.base')

@section('content')
    <section class="dd-page-header clearfix">
        <h1 class="pull-left">Edit {{ $album->title }}</h1>
        <div class="header-actions pull-right">
            <a href="/admin/albums/{{ $album->id }}" class="btn dd-btn btn-light">Back to Album</a>
        </div>
    </section>
    <section class="edit-user-form-container">
        @include('admin.forms.album')
    </section>
@endsection

