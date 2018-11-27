@extends('layouts.crypto')

@section('content')
<div id="app">
    <main class="py-4">
        <div class="container">
            @include('inc.messages')
            <h1>Edit Digital Collectible</h1>
            {!! Form::open(['action' => ['DigitalCollectiblesController@update', $item->id], 'method'=> 'POST', 'enctype'=>'multipart/form-data']) !!}
                <div class="form-group">
                    {{Form::label('title', 'Title')}}
                    {{Form::text('title', $item->title, ['class'=>'form-control', 'placeholder' => 'Title'])}}
                </div>
                <div class="form-group">
                    {{Form::label('body', 'Body')}}
                    {{Form::textarea('body', $item->body, ['id' => 'article-ckeditor', 'class' =>'form-control', 'placeholder' => 'Body Text'])}}
                </div>
                <div class="form-group">
                    {{Form::label('price', 'Price')}}
                    {{Form::text('price', '', ['class' =>'form-control input-sm', 'placeholder' => 'Price'])}}
                </div>
                <div class="form-group">
                    {{Form::label('status', 'Status')}}
                    {{Form::select('status', array('1' => 'New', '2' => 'Sold'), $item->status, ['class' => 'form-control'])}}
                </div>
                <div class="form-group">
                    {{Form::file('cover_image')}}
                </div>
                {{Form::hidden('_method','PUT')}}
                {{Form::submit('Submit', ['class'=> 'btn btn-primary'])}}
            {!! Form::close() !!}
        </div>
    </main>
</div>
@endsection