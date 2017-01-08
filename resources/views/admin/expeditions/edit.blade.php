@extends('admin.base')

@section('content')
    <section class="dd-page-header clearfix">
        <h1 class="pull-left">Edit {{ $expedition->name }}</h1>
        <div class="header-actions pull-right">
            <a href="/admin/expeditions/{{ $expedition->id }}" class="btn dd-btn btn-light">Back to Expedition</a>
        </div>
    </section>
    <section class="edit-user-form-container">
    </section>
    @include('admin.forms.expedition')
@endsection

