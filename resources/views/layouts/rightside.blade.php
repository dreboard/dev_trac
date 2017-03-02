<div class="col-md-4">

    <form id="search_form" class="form-inline" method="post"  action="{{ action('TicketController@ticketSearch') }}">
        <div class="form-group">
            <input name="keyword" type="text" class="form-control" value="" id="search" placeholder="Search">
            {{ csrf_field() }}
        </div>
        <button type="submit" class="btn btn-default">Find</button>
    </form>
    <br>
    @if(isset($viewLastTen))
        <ul class="list-group">
            @foreach($viewLastTen as $last_ten)
                <li class="list-group-item">
                    <a href="{{ url("/viewTicket/$last_ten->id") }}">{{ $last_ten->title }} #{{ $last_ten->id }}</a>
                </li>
            @endforeach
        </ul>
    @endif

</div>