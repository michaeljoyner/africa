@extends('admin.base')

@section('content')
    <section class="dd-page-header clearfix">
        <h1 class="pull-left">Compliance Documents</h1>
        <div class="header-actions pull-right">
            <button type="button" class="btn dd-btn btn-dark" data-toggle="modal" data-target="#create-document-modal">
                New Document
            </button>
        </div>
    </section>
    <section class="associate-listing">
        <table class="table">
            <tbody>
            @foreach($documents as $document)
                <tr>
                    <td><a href="/admin/documents/{{ $document->id }}">{{ $document->title }}</a></td>
                    <td>{{ $document->published ? 'Published' : 'Unpublished' }}</td>
                    <td>{{ $document->updated_at->toFormattedDateString() }}</td>
                </tr>
            @endforeach
            </tbody>

        </table>
    </section>
    @include('admin.forms.modals.document')
@endsection

@section('bodyscripts')

@endsection