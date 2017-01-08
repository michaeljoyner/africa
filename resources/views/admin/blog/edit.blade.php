@extends('admin.base')

@section('content')
    <section class="dd-page-header clearfix">
        <h1 class="pull-left">{{ $post->title }}</h1>
        <div class="header-actions pull-right">
            <a href="/admin/posts/{{ $post->id }}" class="btn dd-btn btn-light">Back to Post</a>
        </div>
    </section>
    <section class="edit-user-form-container">
        @include('admin.forms.post')
    </section>
@endsection

