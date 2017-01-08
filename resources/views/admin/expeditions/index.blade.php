@extends('admin.base')

@section('content')
    <section class="dd-page-header clearfix">
        <h1 class="pull-left">Expeditions</h1>
        <div class="header-actions pull-right">
            <button type="button" class="btn dd-btn btn-dark" data-toggle="modal" data-target="#create-expedition-modal">
                New Expedition
            </button>
        </div>
    </section>
    <section class="associate-listing">
        <table class="table">
            <tbody>
            @foreach($expeditions as $expedition)
                <tr>
                    <td><a href="/admin/expeditions/{{ $expedition->id }}">{{ $expedition->name }}</a></td>
                    <td>{{ $expedition->published ? 'Published' : 'Unpublished' }}</td>
                    <td>{{ $expedition->created_at->toFormattedDateString() }}</td>
                </tr>
            @endforeach
            </tbody>

        </table>
    </section>
    @include('admin.forms.modals.expedition')
@endsection

@section('bodyscripts')

@endsection