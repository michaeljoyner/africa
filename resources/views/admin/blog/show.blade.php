@extends('admin.base')

@section('content')
    <section class="dd-page-header clearfix">
        {{--<h1 class="pull-left">{{ $post->title }}</h1>--}}
        <div class="header-actions pull-right">
            <publish-button :virgin="{{ $post->hasNeverBeenPublished() ? 'true' : 'false' }}"
                            url="/admin/api/posts/{{ $post->id }}/publish"
                            :published="{{ $post->published ? 'true' : 'false' }}"
            ></publish-button>
            <a href="/admin/posts/{{ $post->id }}/featuredimage" class="btn dd-btn">Featured Image</a>
            <a href="/admin/posts/{{ $post->id }}/edit" class="btn dd-btn">Edit Info</a>
            <a href="/admin/posts/{{ $post->id }}/body/edit" class="btn dd-btn btn-light">Edit Content</a>
            @include('admin.partials.deletebutton', [
                'objectName' => $post->title,
                'deleteFormAction' => '/admin/posts/' . $post->id
            ])
        </div>
    </section>
    <section class="row">
        <div class="col-md-6">
            <h1>{{ $post->title }}</h1>
            <p class="lead">{{ $post->description }}</p>
        </div>
        <div class="col-md-6">
            <img src="{{ $post->titleImg('web') }}" class="img-responsive" alt="" class="post-show-featured-image">
        </div>
    </section>
    @include('admin.partials.deletemodal')
@endsection

@section('bodyscripts')
    @include('admin.partials.modalscript')
@endsection

