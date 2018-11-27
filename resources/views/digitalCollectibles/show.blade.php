@extends('layouts.crypto')

@section('content')
<div id="app">
    <main class="py-4">
        <div class="container">
            <a href="/digitalCollectibles" class="btn btn-default">Go Back</a> 
            <h1>{{$item->title}}</h1>
            <div class="col-md-4 col-sm-4">
            <img src="/storage/cover_images/{{$item->image_path}}" style="width:30%" />
            </div>
            <br/><br/>
            <div>
                {!!$item->body!!}
            </div>
            <div>
                <lable>Status</lable>
                {{$item->status}}
            </div>
            <div>
                <lable>Price</lable>
                {{$item->price}}
            </div>
            <hr/>
            @if(!Auth::guest())
                    <a href="/digitalCollectibles/{{$item->id}}/edit" class="btn btn-default">Edit</a>
                    {!!Form::open(['action' => ['DigitalCollectiblesController@destroy', $item->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                    {{Form::hidden('_method', 'DELETE')}}
                    {{Form::submit('Delete', ['class'=> 'btn btn-danger'])}} 
                    {!!Form::close()!!}
            @endif
        </div>
    </main>
</div>
@endsection