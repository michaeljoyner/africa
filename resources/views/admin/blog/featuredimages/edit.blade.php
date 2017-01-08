@extends('admin.base')


@section('content')
    <section class="dd-page-header clearfix">
        <h1 class="pull-left">Select a Featured Image</h1>
        <div class="header-actions pull-right">
            <a href="/admin/posts/{{ $post->id }}" class="btn dd-btn btn-dark">Back to Post</a>
        </div>
    </section>
    <featured-images post-id="{{ $post->id }}"></featured-images>
@endsection