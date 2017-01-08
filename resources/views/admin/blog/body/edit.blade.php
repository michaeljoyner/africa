@extends('admin.base')

@section('head')
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

@endsection

@section('content')
    <section class="dd-page-header clearfix">
        <h1 class="pull-left">{{ $post->title }}</h1>
        <div class="header-actions pull-right">
            <a href="/admin/posts/{{ $post->id }}" class="btn btn-light dd-btn">Post Overview</a>
        </div>
    </section>

    <editor post-id="{{ $post->id }}"
            post-content='{{ $post->body }}'
            content-lang="{{ 'en' }}"
    ></editor>
@endsection

@section('bodyscripts')

@endsection