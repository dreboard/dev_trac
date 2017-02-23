@extends('layouts.app')

@section('content')
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
                @foreach($ticketInfo as $ticket)
                <h2>{{ $ticket->title }}</h2>
                    <p>{{ $ticket->description }}</p>
                @endforeach

        </div>
    </div>
</div>
@endsection
