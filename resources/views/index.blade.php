@extends('master')
@section('content')

<div class="container-fluid">
    <div class="row   ">
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    @foreach($sliders as $item)
    <div class="carousel-item {{ $item['id'] == 1 ? 'active' : '' }}">
      <img class="d-block" src="{{$item['image']}}" alt="First slide" >

    </div>
    @endforeach
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
        </div>
    </div>




    <!--------->

    <div class=" product-slider d-flex align-items-end">
        @foreach($products as $item)
        <a href="product/{{$item['id']}}">
        <div class=" m-2 p-2">
            <div class="card-body p-0">
            <img src="{{$item['gallery']}}"  alt="" class="product-img">
            </div>
            <div class="bg-light">
                <p>{{$item['name']}}</p>
                <p>RS: {{$item['price']}}</p>
            </div>
            <div>
              
            </div>
          
        </div>
            </a>
        @endforeach

       
    </div>
</div>

@endsection
