@extends('admin.base')

@section('content')
    <section class="dd-page-header clearfix">
        <h1 class="pull-left">Edit {{ $partner->name }}</h1>
        <div class="header-actions pull-right">
            <a href="/admin/partners/{{ $partner->id }}" class="btn dd-btn btn-light">Back to Partner</a>
        </div>
    </section>
    <section class="edit-user-form-container">
        @include('admin.forms.associate', ['formAction' => '/admin/partners/' . $partner->id, 'associate' => $partner])
    </section>
@endsection

