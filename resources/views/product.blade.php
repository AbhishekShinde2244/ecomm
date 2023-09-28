
@extends('master')
@section('content')

<section class="py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-6"><img style="width:180px" class="card-img-top mb-5 mb-md-0 img-thumbnail" src="{{$details['gallery']}}" alt="..."></div>
                    <div class="col-md-6">
                        <div class="small mb-1">SKU: LR#{{$details['id']}}</div>
                        <h1 class="display-5 fw-bolder">{{$details['name']}}</h1>
                        <div class="fs-5 mb-5">
                            <span class="text-decoration-line-through">Rs: {{$details['price']}}</span>
                           
                        </div>
                        <p class="lead">{{$details['description']}}</p>
                        <div class="d-flex">
                            <form action="/add_to_cart" method="post" class="d-flex justify-content-between">
                            @csrf
                            <input class="form-control text-center mr-2 me-3" name="productId" value="{{$details['id']}}" id="productId" type="hidden" style="max-width: 3rem">

                            <input class="form-control text-center mr-2 me-3" name="quantity" id="inputQuantity" type="number" value="1" style="max-width: 3rem">
                            <button class="btn btn-outline-dark flex-shrink-0" type="submit">
                                <i class="bi-cart-fill me-1"></i>
                                Add to cart
                            </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


           

            <div class=" bg-dark text-white text-center">
                <h4>More like {{$details['name']}}</h4>
            </div>
            <div class=" product-slider d-flex">

        @foreach($similer as $item)
        <div class="card m-2 p-2">
            <div class="card-body">
            <img src="{{$item['gallery']}}"  alt="" class="product-img">
            </div>
            <div class="bg-light">
                <p>{{$item['name']}}</p>
                <p>RS: {{$item['price']}}</p>
            </div>
            <div>
                <a href="product/{{$item['id']}}" class="btn btn-primary">view product</a>
            </div>
          
        </div>
      
        @endforeach

       
    </div>          
        </section>
@endsection
