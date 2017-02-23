@extends('layouts.app')

@section('content')
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h2>Tickets</h2>
            <ul>
                @foreach($tickets as $ticket)
                    <li><a href="{{ url("/viewTicket/$ticket->id") }}">{{ $ticket->title }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
