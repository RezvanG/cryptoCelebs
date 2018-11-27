<style>
.section-header{
    margin-top: 25px;
    margin-bottom: 25px;
    padding: 15px;
    color: white;
    background-color: #4e84c2;
}

.gallery-item {
    left: 0 !important;
    top: 0 !important;
    vertical-align: top;
    position: relative !important;
    transform: none !important;
    padding: 15px;
    margin: 10px;
    /*background: red; */
}

.img_wrapper{
    cursor: pointer;
}

.title_wrapper{
    /*background-color: #efefef;*/
    background: #fac769;
    padding: 15px;
    text-align: left;
    font-weight: bold;
}

.title_wrapper h4{
    font-weight: 700;
    font-size: 1rem;
}
</style>
@extends('layouts.crypto')

@section('content')
@if(count($newly_added)>0)
<section>
    <div class="container section-header">
        <div class="row justify-content-center">
            <div class="col-12 col-md-12 align-center">
                <h2 class="align-center"><span style="font-weight: bold; font-size:24px;">NEWLY ADDED</span></h2>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="well">
            <div class="row justify-content-center">
                @foreach($newly_added as $item)
                    <div class="col-lg-3 col-md-6 col-sm-8 gallery-item">
                        <div class="img_wrapper">
                          <img src="/storage/cover_images/{{$item->image_path}}" style="height: 300px; width:100%;" />
                        </div>
                        <div class="title_wrapper">
                            <h4 class="item-title">{{$item->title}}</h4>
                            <div class="price-block">
                                <span class="shop-item-price">${{$item->price}}</span>
                            </div>
                        </div>   
                    </div>                     
                @endforeach
                 @else
                <p>No Digital Collectible found.</p>
            </div>
        </div>
    </div>
</section>
@endif

@if(count($recently_sold)>0)
<section>
    <div class="container section-header">
        <div class="row justify-content-center">
            <div class="col-12 col-md-12 align-center">
                <h2 class="align-center"><span style="font-weight: normal; font-size:28px;">RECENTLY SOLD</span></h2>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="well">
            <div class="row justify-content-center">
                @foreach($recently_sold as $item)
                    <div class="col-lg-3 col-md-6 col-sm-8 gallery-item">
                        <div class="img_wrapper">
                          <img src="/storage/cover_images/{{$item->image_path}}" style="height: 300px; width:100%;" />
                        </div>
                        <div class="title_wrapper">
                            <h4 class="item-title">{{$item->title}}</h4>
                            <div class="price-block">
                                <span class="shop-item-price">${{$item->price}}</span>
                            </div>
                        </div>   
                    </div>                     
                @endforeach
                 @else
                <p>No Digital Collectible found.</p>
            </div>
        </div>
    </div>
</section>
@endif


@if(count($best_sellers)>0)
<section>
    <div class="container section-header">
        <div class="row justify-content-center">
            <div class="col-12 col-md-12 align-center">
                <h2 class="align-center"><span style="font-weight: normal; font-size:28px;">BEST SELLERS</span></h2>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="well">
            <div class="row justify-content-center">
                @foreach($best_sellers as $item)
                    <div class="col-lg-3 col-md-6 col-sm-8 gallery-item">
                        <div class="img_wrapper">
                          <img src="/storage/cover_images/{{$item->image_path}}" style="height: 300px; width:100%;" />
                        </div>
                        <div class="title_wrapper">
                            <h4 class="item-title">{{$item->title}}</h4>
                            <div class="price-block">
                                <span class="shop-item-price">${{$item->price}}</span>
                            </div>
                        </div>   
                    </div>                     
                @endforeach
                 @else
                <p>No Digital Collectible found.</p>
            </div>
        </div>
    </div>
</section>
@endif
@endsection

@section('scripts')
<script>
$(document).ready(function(){
    isLocked();
});


function isInstalled() {
   if (typeof web3 !== 'undefined'){
      console.log('MetaMask is installed')
   } 
   else{
      console.log('MetaMask is not installed')
   }
}

function isLocked() {
   web3.eth.getAccounts(function(err, accounts){
      if (err != null) {
         console.log(err)
      }
      else if (accounts.length === 0) {
         console.log('MetaMask is locked')
      }
      else {
         console.log('MetaMask is unlocked')
      }
   });
}
</script>
@endsection