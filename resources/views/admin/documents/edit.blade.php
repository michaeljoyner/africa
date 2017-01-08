@extends('admin.base')

@section('content')
    <section class="dd-page-header clearfix">
        <h1 class="pull-left">Edit {{ $document->title }}</h1>
        <div class="header-actions pull-right">
            <a href="/admin/documents/{{ $document->id }}" class="btn dd-btn btn-light">Back to Document</a>
        </div>
    </section>
    <section class="edit-user-form-container">
        @include('admin.forms.document')
    </section>
@endsection

