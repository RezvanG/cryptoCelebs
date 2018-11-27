@extends('layouts.crypto')

@section('content')
<div id="app">
    <main class="py-4">
        <div class="container">
            <h3>Digital Collectibles</h3>
            @if(count($digitalCollectibles)>0)
                @foreach($digitalCollectibles as $item)
                    <div class="well">
                        <div class="row">
                            <div class="col-md-4 col-sm-4">
                                <img src="/storage/cover_images/{{$item->image_path}}" style="width:30%" />
                            </div>
                            <div class="col-md-8 col-sm-8">
                                <h3><a href="/digitalCollectibles/{{$item->id}}">{{$item->title}}</a></h3>  
                                <small>{!!$item->body!!}</small>                     
                            </div>
                        </div>
                    </div>
                @endforeach
                {{$digitalCollectibles->links()}}
            @else
                <p>No Digital Collectible found.</p>
            @endif
        </div>
    </main>
</div>
@endsection