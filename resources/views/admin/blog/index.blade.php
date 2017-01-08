@extends('admin.base')

@section('content')
    <section class="dd-page-header clearfix">
        <h1 class="pull-left">News Posts</h1>
        <div class="header-actions pull-right">
            <button type="button" class="btn dd-btn btn-dark" data-toggle="modal" data-target="#create-post-modal">
                New Post
            </button>
        </div>
    </section>
    <section class="article-listing">
        <table class="table">
            <tbody>
            @foreach($posts as $post)
                <tr>
                    <td><a href="/admin/posts/{{ $post->id }}">{{ $post->title }}</a></td>
                    <td>{{ $post->author->name }}</td>
                    <td>{{ $post->published ? 'Published' : 'Unpublished' }}</td>
                </tr>
            @endforeach
            </tbody>

        </table>
    </section>
    @include('admin.forms.modals.createpost')
@endsection

@section('bodyscripts')

@endsection