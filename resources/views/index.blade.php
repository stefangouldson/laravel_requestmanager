@extends('layouts.app')

@section('content')

    <h2>Items</h2>
    @if(count($items)>0)


    <div class="list-group">
        @foreach ($items as $item)

        <a href="{{ route('request.index') }}/{{ $item->id }}/edit" class="list-group-item list-group-item-action">
          <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">{{ $item->text }}</h5>
            <small>{{ $item->created_at }}</small>
          </div>

          {{ Form::open(['action'=>['RequestController@destroy',$item->id], 'method'=>'POST']) }}
          {{ Form::hidden('_method', 'DELETE') }}
          <button type="submit" class="btn btn-danger float-right">Delete</button>
          {{ Form::close() }}
          
          <p class="mb-1">{{ $item->body }}</p>
        </a>

        @endforeach
    </div>

    @else
    <p>No items</p>
    @endif

@endsection
