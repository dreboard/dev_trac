@extends('layouts.app')

@section('content')
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <form class="form-horizontal" role="form" action="{{ action('TicketController@newTicketSave') }}" method="post" id="newTicketForm">
                <h2>Create New Ticket</h2>
                <div class="form-group">
                    <label for="title" class="col-sm-3 control-label">Title</label>
                    <div class="col-sm-9">
                        <input type="text" name="title" class="form-control" id="title" placeholder="Title" autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label for="description" class="col-sm-3 control-label">Description</label>
                    <div class="col-sm-9">
                        <textarea name="description" class="form-control" id="description" rows="5"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3">Tracking</label>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-6">
                                <label class="radio-inline">
                                    <select name="completed" id="completed" class="form-control">
                                        <option value="0" selected>% Done</option>
                                        <option value="0">0%</option>
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
                                    <input type="text" name="create_date" class="form-control datepicker" id="create_date">
                                </label>
                            </div>
                            <div class="col-sm-6">
                                <label class="radio-inline">
                                    <input type="hidden" name="user_id" value="1">
                                    <input type="hidden" name="project_id" value="1">
                                    <input type="text" name="due_date" class="form-control datepicker" id="due_date">
                                </label>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-4">
            <ul>
                <li>Link 1</li>
                <li>Link 2</li>
                <li>Link 3</li>
            </ul>

        </div>
    </div>
</div>
@endsection
