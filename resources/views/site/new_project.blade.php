@extends('layouts.app')

@section('content')
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h2>Dashboard</h2>
            <form class="form-horizontal">
                <div class="form-group">
                    <label for="title" class="col-sm-2 control-label">Title</label>
                    <div class="col-sm-10">
                        <input type="text" name="title" class="form-control" id="title" placeholder="Title">
                    </div>
                </div>
                <div class="form-group">
                    <label for="description" class="col-sm-2 control-label">Description</label>
                    <div class="col-sm-10">
                        <textarea name="description" class="form-control" id="description" rows="5"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="description" class="col-sm-2 control-label">Dates</label>
                    <div class="col-sm-10">
                        <div class="row">
                            <div class="col-xs-6">
                                <input type="text" name="created_at" class="form-control datepicker" id="startDate">
                            </div>
                            <div class="col-xs-6">
                                <input type="text" name="due_at" class="form-control datepicker" id="endDate">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="completed" class="col-sm-2 control-label">Description</label>
                    <div class="col-sm-10">
                        <select class="form-control">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>
                </div>


                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox"> Remember me
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default">Sign in</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
