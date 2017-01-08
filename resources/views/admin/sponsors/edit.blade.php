@extends('admin.base')

@section('content')
    <section class="dd-page-header clearfix">
        <h1 class="pull-left">Edit {{ $sponsor->name }}</h1>
        <div class="header-actions pull-right">
            <a href="/admin/associates/{{ $sponsor->id }}" class="btn dd-btn btn-light">Back to Sponsor</a>
        </div>
    </section>
    <section class="edit-user-form-container">
        @include('admin.forms.associate', ['formAction' => '/admin/associates/' . $sponsor->id, 'associate' => $sponsor])
    </section>
@endsection

