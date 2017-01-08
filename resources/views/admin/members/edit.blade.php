@extends('admin.base')

@section('content')
    <section class="dd-page-header clearfix">
        <h1 class="pull-left">Edit {{ $member->name }}</h1>
        <div class="header-actions pull-right">
            <a href="/admin/members/{{ $member->id }}" class="btn dd-btn btn-light">Back to Team Member</a>
        </div>
    </section>
    <section class="edit-user-form-container">
        @include('admin.forms.associate', ['formAction' => '/admin/members/' . $member->id, 'associate' => $member])
    </section>
@endsection

