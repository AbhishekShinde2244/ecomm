@extends('master')
@section('content')

<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px"src="{{ asset('storage/' . $Address->profile) }}" alt="Profile Image"><span class="font-weight-bold">{{$user->name}}</span><span class="text-black-50">{{$user->email}}</span><span> </span></div>
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Profile Settings</h4>
                </div>
                <form action="update" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="row mt-2">
                    <div class="col-md-12"><label class="labels">Name</label><input type="text" class="form-control" name="name" placeholder="name" value="{{$user->name}}"></div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels">Mobile Number</label><input name="contact" type="text" class="form-control" placeholder="enter phone number" value="{{$Address->contact}}"></div>
                    <div class="col-md-12"><label class="labels">Address Line 1</label><textarea name="address" type="text" class="form-control" placeholder="enter address line 1">{{$Address->address}}</textarea></div>
                    <div class="col-md-12"><label class="labels">Zipcode</label><input type="text" name="zipcode" class="form-control" placeholder="zipcode" value="{{$Address->zipcode}}"></div>
                    <div class="col-md-12"><label class="labels">State</label><input type="text" name="state" class="form-control" placeholder="enter address line 2" value="{{$Address->state}}"></div>
                    <div class="col-md-12"><label class="labels">Email ID</label><input type="text" name="email" class="form-control" placeholder="enter email id" value="{{$user->email}}"></div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels">Image</label><input type="file" name="profile" class="form-control" >
                 
                          
                        
                      </div>
                </div>
                <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit">Save Profile</button></div>
                </form>
            </div>
        </div>
        
    </div>
</div>
</div>
</div>

@endsection