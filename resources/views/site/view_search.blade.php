@extends('layouts.app')

@section('content')
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <h3>{{ __('site.search_results')}}</h3>

            <table class="table table-bordered">
                <tr>
                    <th>Number</th>
                    <th>Title</th>
                    <th>Created</th>
                    <th>Due</th>
                </tr>

                @foreach($searchResults as $ticket)
                    <tr>
                        <td>#{{ $ticket->id }}</td>
                        <td><a href="{{ url("/viewTicket/$ticket->id") }}"> {{ $ticket->title }}</a></td>
                        <td>{{ $ticket->create_date }}</td>
                        <td>{{ $ticket->due_date }}</td>
                    </tr>
                @endforeach

            </table>
        </div>
        @include('layouts.rightside');
    </div>
</div>
@endsection
