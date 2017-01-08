@extends('admin.base')

@section('content')
    <section class="dd-page-header clearfix">
        <h1 class="pull-left">Gallery Albums</h1>
        <div class="header-actions pull-right">
            <button type="button" class="btn dd-btn btn-dark" data-toggle="modal" data-target="#create-album-modal">
                New Album
            </button>
        </div>
    </section>
    <section class="album-listing">
        @foreach($albums as $album)
            <a href="/admin/albums/{{ $album->id }}">
                <div class="album-index-card">
                    <img src="{{ $album->modelImage('thumb') }}" alt="">
                    <p class="text-uppercase">{{ $album->title }}</p>
                </div>
            </a>
        @endforeach
    </section>
    @include('admin.forms.modals.album')
@endsection
