@extends('master')
@section('content')
<div class=" container-fluid my-5 ">
    <div class="row justify-content-center ">
        <div class="col-xl-10">
            <div class="card shadow-lg ">
                <div class="row p-2 mt-3 justify-content-between mx-sm-2">
                    <div class="col">
                       
                    </div>
                    <div class="col">
                        <div class="row justify-content-start ">
                            <div class="col">
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                    </div>
                </div>
                <div class="row  mx-auto justify-content-center text-center">
                    @if($Subtotal!==0)

                    
                    <div class="col-12 mt-3 ">
                        <nav aria-label="breadcrumb" class="second ">
                            <ol class="breadcrumb indigo lighten-6 first  ">
                                <li class="breadcrumb-item font-weight-bold "><a class="black-text text-uppercase " href="../"><span class="mr-md-3 mr-1">BACK TO SHOP</span></a><i class="fa fa-angle-double-right " aria-hidden="true"></i></li>
                                <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase" href="#"><span class="mr-md-3 mr-1">SHOPPING BAG</span></a><i class="fa fa-angle-double-right text-uppercase " aria-hidden="true"></i></li>
                                <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase active-2" href="#"><span class="mr-md-3 mr-1">CHECKOUT</span></a></li>
                            </ol>
                        </nav>
                    </div>
                    @else
                    <div class="col-12 mt-3 ">
                        <nav aria-label="breadcrumb" class="second ">
                            <ol class="breadcrumb indigo lighten-6 first  ">
                                <li class="breadcrumb-item font-weight-bold "><a class="black-text text-uppercase " href="../"><span class="mr-md-3 mr-1">BACK TO SHOP</span></a><i class="fa fa-angle-double-right " aria-hidden="true"></i></li>
                                <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase" href="#"><span class="mr-md-3 mr-1">SHOPPING BAG</span></a></li>
                            </ol>
                        </nav>
                    </div>
                    @endif
                </div>
             
                @if($status!=1)
                <div class="row justify-content-around">
              
                @if($Subtotal!==0)

                    <div class="col-md-5">


                        <div class="card border-0">
                            <div class="card-header pb-0">
                                <h2 class="card-title space ">Checkout</h2>
                                <p class="card-text text-muted mt-4  space">SHIPPING DETAILS</p>
                                <hr class="my-0">
                            </div>
                            <div class="card-body">
                            @if(isset($Address->address))
                                <div class="row justify-content-between">

                              
   

                                    <div class="col-auto mt-0"><p><b>{{$Address->address}},<br>{{$Address->state}},{{$Address->zipcode}}</b></p></div>
          
                                    <div class="col-auto"><p><b>{{Session::get('user')['email'];}}</b><br><b>{{$Address->contact}}</b> </p></div>
                                </div>
                                @else
    <p>No address found. Please Add One Address <a href="profile"><i class="fa fa-edit"></i></a></p>
@endif
                              
                                <div class="row mb-md-5">
                                    <div class="col">
                                    <div class="col-md-7 col-lg-6 mx-auto">
                                      <input type="text" class="form-control" placeholder="Enter Cupone Code">  
                                    <button  type="button" class="btn btn-block btn-outline-primary btn-lg">Add Cupon</button></div>

                                    </div>
                                </div>    
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card border-0 ">
                            <div class="card-header card-2">
                                <p class="card-text text-muted mt-md-4  mb-2 space">YOUR ORDER <span class=" small text-muted ml-2 cursor-pointer">EDIT SHOPPING BAG</span> </p>
                                <hr class="my-2">
                            </div>

                      
                            <div class="card-body pt-0">
                            @foreach($items as $item)

                       
                               <div class="row  justify-content-between">
                                    <div class="col-auto col-md-7">
                                        <div class="media flex-column flex-sm-row">
                                            <img class=" img-fluid" src="{{$item->gallery}}" width="62" height="62">
                                            <div class="media-body  my-auto">
                                                <div class="row ">
                                                    <div class="col-auto d-flex"><a href="delete/{{$item->id}}"><i class="fa fa-trash text-danger"></i> </a>  <p class="mb-0"><b>{{$item->name}}</b></p><small class="text-muted"></small></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" pl-0 flex-sm-col col-auto  my-auto"> <p class="boxed-1">{{$item->quantity}}</p></div>
                                    <div class=" pl-0 flex-sm-col col-auto  my-auto "><p><b>RS : {{$item->price}}</b></p> </div>
                                </div>
                                <hr class="my-2">
                                  
                                @endforeach
                               
                                <hr class="my-2">
                                <div class="row ">
                                    <div class="col">
                                        <div class="row justify-content-between">
                                            <div class="col-4"><p class="mb-1"><b>Subtotal</b></p></div>
                                            <div class="flex-sm-col col-auto"><p class="mb-1"><b>RS : {{$Subtotal}}</b></p></div>
                                        </div>
                                        <div class="row justify-content-between">
                                            <div class="col"><p class="mb-1"><b>Shipping</b></p></div>
                                            <div class="flex-sm-col col-auto"><p class="mb-1"><b>RS : {{$Shipping}}</b></p></div>
                                        </div>
                                        <div class="row justify-content-between">
                                            <div class="col-4"><p ><b>Total</b></p></div>
                                            <div class="flex-sm-col col-auto"><p  class="mb-1"><b>RS : {{$Shipping+$Subtotal}}</b></p> </div>
                                        </div><hr class="my-0">
                                    </div>
                                </div>
                                <div class="row mb-5 mt-4 ">
                                    <div class="col">

                                    <form action="{!!route('payment')!!}" method="POST" >                        
                        <script src="https://checkout.razorpay.com/v1/checkout.js"
                                data-key="{{ env('RAZOR_KEY') }}"
                                data-amount="{{$paise}}"
                                order_id="order_L0nS83FfCHaWqV"
                                invoice_id= "inv_L0nS7JIyuX6Lyb"
                                data-buttontext="Pay {{$paise / 100}} INR"
                                data-name="LaraCom"
                                data-description="Payment"                                
                                data-prefill.name="name"
                                data-prefill.email="email"
                                data-theme.color="#ff7529">
                        </script>
                      
                        <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                    
                    </form>
                                    </div>
                               
                                </div>
                            </div>


                        </div>
                    </div>
                  
                     @endif
                     @endif
                     @if($Subtotal==0)
                    <div class="col-md-12 text-center p-5">
                        <div class="card">
                           <h3 class="text-white bg-dark"> Your Cart is empty !...</h3>
                        </div>
                    </div>
                    @endif
              
                  
                  
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
