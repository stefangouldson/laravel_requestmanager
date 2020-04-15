@extends('layouts.app')

@section('content')

<h2>Update Item</h2>

{{ Form::open(['action'=>['RequestController@update', $item->id], 'method'=>'POST'])}}
{{ Form::hidden('_method', 'PUT')}}
    <div class="form-group">
        <label for="text">Text</label>
        <input type="text" class="form-control" name="text" placeholder="Edit Text" value="{{ $item->text }}">
    </div>

    <div class="form-group">
        <label for="body">Body</label>
        <input type="text" name="body" class="form-control" placeholder="Edit Body" value="{{ $item->body }}">
    </div>

    <button type="submit" class="btn btn-primary" name="button">Update</button>
{{ Form::close()}}
@endsection
