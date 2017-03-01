<div class="col-md-4">

    <form id="search_form" class="form-inline">
        <div class="form-group">
            <input type="text" class="form-control" value="" id="search" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Find</button>
    </form>
    <br>
    <ul class="list-group">
        @foreach($viewLastTen as $last_ten)
            <li class="list-group-item">
                <a href="{{ url("/viewTicket/$last_ten->id") }}">{{ $last_ten->title }} #{{ $last_ten->id }}</a>
            </li>
        @endforeach
    </ul>

</div>