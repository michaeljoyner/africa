@extends('admin.base')

@section('head')
    <script src="https://cdn.tiny.cloud/1/tmx4dzpo4heri0p2gbw9szj69j28yzeh8r8a6h626mjg101q/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

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