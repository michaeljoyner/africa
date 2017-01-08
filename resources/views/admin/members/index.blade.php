@extends('admin.base')

@section('content')
    <section class="dd-page-header clearfix">
        <h1 class="pull-left">The Team</h1>
        <div class="header-actions pull-right">
            <button type="button" class="btn dd-btn btn-dark" data-toggle="modal" data-target="#create-member-modal">
                New Member
            </button>
        </div>
    </section>
    <section class="associate-listing">
        <table class="table">
            <tbody>
            @foreach($members as $member)
                <tr>
                    <td><a href="/admin/members/{{ $member->id }}">{{ $member->name }}</a></td>
                    <td>{{ $member->published ? 'Published' : 'Unpublished' }}</td>
                    <td>{{ $member->created_at->toFormattedDateString() }}</td>
                </tr>
            @endforeach
            </tbody>

        </table>
    </section>
    @include('admin.forms.modals.member')
@endsection

@section('bodyscripts')

@endsection