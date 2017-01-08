@extends('admin.base')

@section('content')
    <section class="dd-page-header clearfix">
        <h1 class="pull-left">Our Partners</h1>
        <div class="header-actions pull-right">
            <button type="button" class="btn dd-btn btn-dark" data-toggle="modal" data-target="#create-partner-modal">
                New Partner
            </button>
        </div>
    </section>
    <section class="associate-listing">
        <table class="table">
            <tbody>
            @foreach($partners as $partner)
                <tr>
                    <td><a href="/admin/partners/{{ $partner->id }}">{{ $partner->name }}</a></td>
                    <td>{{ $partner->published ? 'Published' : 'Unpublished' }}</td>
                    <td>{{ $partner->created_at->toFormattedDateString() }}</td>
                </tr>
            @endforeach
            </tbody>

        </table>
    </section>
    @include('admin.forms.modals.partner')
@endsection

@section('bodyscripts')

@endsection