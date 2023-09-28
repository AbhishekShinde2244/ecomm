<?php
use App\Http\Controllers\ProductController;

$total = ProductController::cartItem();
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="../">Ecomm</a>
  <a class="nav-link" href="../">Home <span class="sr-only">(current)</span></a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse " id="navbarSupportedContent">
    <ul class="navbar-nav m-auto ">
      <li class="nav-item active">
      </li>
      <form class="form-inline my-2 my-lg-0" method="GET" action="/search">
      <input class="form-control mr-sm-2" style="width: 1000px;" name="query" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
    </ul>

    <ul class="navbar-nav m-auto">

    @if(Session::has('user'))
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-user" aria-hidden="true" title="login"> {{Session::get('user')['name']}}</i>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Orders</a>
          <a class="dropdown-item" href="profile">Profile</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="/logout">LogOut <i class="fa fa-sign-out" aria-hidden="true"></i> </a>
        </div>
      </li>
      @else
      <li class="nav-item  ml-2"> 
      <a class="nav-link" href="/login" aria-haspopup="true" aria-expanded="false">  <i class="fa fa-user" aria-hidden="true"></i> </a>
       </li>
       @endif
        <li class="nav-item  ml-2">  <a class="nav-link" href="cart" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-shopping-bag" aria-hidden="true" title="Cart"> ({{$total=0+$total}})</i>
        </a></li>
    </ul>
   

  </div>
</nav>
