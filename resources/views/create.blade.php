@extends('layouts.app')

@section('content')

<h2>Insert New Item</h2>

{{ Form::open(['action'=>'RequestController@store', 'method'=>'POST'])}}

    <div class="form-group">
        <label for="text">Text</label>
        <input type="text" class="form-control" name="text" placeholder="Enter Text">
    </div>

    <div class="form-group">
        <label for="body">Body</label>
        <input type="text" name="body" class="form-control" placeholder="Enter Body">
    </div>

    <button type="submit" class="btn btn-primary" name="button">Submit</button>
{{ Form::close()}}
@endsection
