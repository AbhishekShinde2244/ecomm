@extends('master')
@section('content')

<div class="container" style="height:85vh;">
    <div class="row   ">
        <div class="col-md-12 text-center mt-5">        <h1>Login</h1></div>
        <div class="col-md-4 offset-4 bg-light p-2 card">
        <form class="" action="login" method="post">
       @csrf

  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  <div class="form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <button type="submit" class="btn btn-primary">Login</button>
</form>
        </div>
    </div>
</div>

@endsection
