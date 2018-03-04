@extends('layouts.default')
@section('content')

    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <div class="row">
            <button type="button" class="btn btn-default btn-sm pull-right characterModalBtn" data-toggle="modal" data-target="#characterModal">
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span> Add Character
            </button>
        </div>
        <br>

        <form method="post" action="/race/add">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Add Race</h3>
                        </div>
                        <div class="panel-body">

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="type">Parent</label>
                                <select name="parentId" class="form-control">
                                    <option></option>
                                    @foreach (\App\Race::whereNull('parentId')->get() as $race)
                                        <option value="{{ $race->id }}">{{ $race->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="age">Age</label>
                                <input type="text" name="age" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="alignment">Alignment</label>
                                <input type="text" name="alignment" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="size">Size</label>
                                <input type="text" name="size" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="speed">Speed</label>
                                <input type="number" name="speed" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="speed">Ability Score Increase</label>
                                <input type="number" name="speed" class="form-control">
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script type="text/javascript">
    $(document).ready(function() {

    });
    </script>
@stop