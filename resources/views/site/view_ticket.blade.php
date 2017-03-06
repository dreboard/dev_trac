@extends('layouts.app')

@section('content')
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
                @foreach($ticketInfo as $ticket)
                <h2>{{ $ticket->title }} #{{ $ticket->id }}</h2>
                    <p>{{ $ticket->completed }}% completed</p>
                    <p>{{ $ticket->description }}</p>
                <button type="button" class="btn btn-primary" id="showEditForm">Edit Ticket</button>

                @endforeach
                    <table class="table table-bordered">
                        <tr>
                            <th>Number</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Due</th>
                        </tr>

                        @foreach($ticketInfo as $ticket)
                            <tr>
                                <td>#{{ $ticket->id }}</td>
                                <td>{{ $ticket->status }}</td>
                                <td>{{ $ticket->create_date }}</td>
                                <td>{{ $ticket->due_date }}</td>
                            </tr>
                        @endforeach

                    </table>
                    <hr />
                    <h3>Notes <button type="button" class="btn btn-primary" id="addNoteBtn">Add Note</button></h3>
                    <form class="form-horizontal" role="form" action="{{ action('TicketController@editTicket') }}" method="post" id="addNoteForm">
                        <div class="form-group">
                            <label for="description" class="col-sm-3 control-label">Description</label>
                            <div class="col-sm-9">
                                <textarea name="description" class="form-control" id="description" rows="5">{{ $ticket->description }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-9 col-sm-offset-3">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-primary" id="addNoteBtn">Add Note</button>
                            </div>
                        </div>
                    </form>
                    <table class="table table-bordered">
                        <tr>
                            <th>Date</th>
                            <th>Note</th>
                            <th>Created By</th>
                        </tr>

                        @foreach($ticketInfo as $ticket)
                            <tr>
                                <td>{{ $ticket->create_date }}</td>
                                <td>{{ $ticket->description }}</td>
                                <td>{{ $ticket->id }}</td>
                            </tr>
                        @endforeach

                    </table>

                    <form class="form-horizontal" role="form" action="{{ action('TicketController@editTicket') }}" method="post" id="editTicketForm">

                        <div class="form-group">
                            <label for="title" class="col-sm-3 control-label">Title</label>
                            <div class="col-sm-9">
                                <input type="text" name="title" class="form-control" id="title" placeholder="Title" value="{{ $ticket->title }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-sm-3 control-label">Description</label>
                            <div class="col-sm-9">
                                <textarea name="description" class="form-control" id="description" rows="5">{{ $ticket->description }}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-3">Tracking</label>
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label class="radio-inline">
                                            <select name="completed" id="completed" class="form-control">
                                                @if(isset($ticket->status))
                                                    <option value="{{$ticket->completed}}" selected>% {{$ticket->completed}}</option>
                                                @else
                                                    <option value="0" selected>0%</option>
                                                @endif

                                                <option value="10">10%</option>
                                                <option value="20">20%</option>
                                                <option value="30">30%</option>
                                                <option value="40">40%</option>
                                                <option value="50">50%</option>
                                                <option value="60">60%</option>
                                                <option value="70">70%</option>
                                                <option value="80">80%</option>
                                                <option value="90">90%</option>
                                                <option value="100">100%</option>
                                            </select>
                                        </label>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="radio-inline">
                                            <select name="hours" id="hours" class="form-control">
                                                <option value="0" selected>Spent Time</option>
                                                <option value="0">0</option>
                                                <option value=".25">15 Minutes</option>
                                                <option value=".5">30 Minutes</option>
                                                <option value=".75">45 Minutes</option>
                                                <option value="1">1 Hours</option>
                                                <option value="2">2 Hours</option>
                                                <option value="3">3 Hours</option>
                                                <option value="4">4 Hours</option>
                                                <option value="5">5 Hours</option>
                                                <option value="6">6 Hours</option>
                                                <option value="7">7 Hours</option>
                                                <option value="8">8 Hours</option>
                                            </select>
                                        </label>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- /.form-group -->
                        <div class="form-group">
                            <label class="control-label col-sm-3">Due Dates</label>
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label class="radio-inline">
                                            <input type="text" name="create_date" class="form-control datepicker" id="create_date" value="{{$ticket->create_date}}">
                                        </label>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="radio-inline">
                                            <input type="hidden" name="user_id" value="1">
                                            <input type="hidden" name="project_id" value="1">
                                            <input type="hidden" name="id" value="{{$ticket->id}}">
                                            <input type="text" name="due_date" class="form-control datepicker" id="due_date" value="{{$ticket->due_date}}">
                                        </label>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">Status</label>
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label class="radio-inline">
                                            <select name="status" id="status" class="form-control">
                                                @if(isset($ticket->status))
                                                    <option value="{{$ticket->status}}" selected>{{$ticket->status}}</option>
                                                @else
                                                    <option value="new" selected>New</option>
                                                @endif

                                                <option value="working">Working</option>
                                                <option value="complete">Complete</option>
                                                <option value="closed">Closed</option>
                                            </select>
                                        </label>
                                    </div>
                                    <div class="col-sm-6">
                                        <select name="priority" id="priority" class="form-control">
                                            @if(isset($ticket->priority))
                                                <option value="{{$ticket->priority}}" selected>{{$ticket->priority}}</option>
                                            @else
                                                <option value="new" selected>New</option>
                                            @endif
                                            <option value="low" selected>Low</option>
                                            <option value="medium">Medium</option>
                                            <option value="high">High</option>
                                            <option value="urgent">Urgent</option>
                                        </select>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-9 col-sm-offset-3">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-primary" id="editTicketBtn">Update</button>
                            </div>
                        </div>
                    </form>
        </div>
        @include('layouts.rightside');
    </div>
</div>
@endsection
