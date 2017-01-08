@extends('admin.base')

@section('content')
    <section class="dd-page-header clearfix">
        <h1 class="pull-left">Our Sponsors</h1>
        <div class="header-actions pull-right">
            <button type="button" class="btn dd-btn btn-dark" data-toggle="modal" data-target="#create-sponsor-modal">
                New Sponsor
            </button>
        </div>
    </section>
    <section class="associate-listing">
        <table class="table">
            <tbody>
            @foreach($sponsors as $sponsor)
                <tr>
                    <td><a href="/admin/associates/{{ $sponsor->id }}">{{ $sponsor->name }}</a></td>
                    <td>{{ $sponsor->published ? 'Published' : 'Unpublished' }}</td>
                    <td>{{ $sponsor->created_at->toFormattedDateString() }}</td>
                </tr>
            @endforeach
            </tbody>

        </table>
    </section>
    @include('admin.forms.modals.sponsor')
@endsection

@section('bodyscripts')

@endsection