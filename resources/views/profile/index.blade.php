@extends('layouts.app')
    
@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-auto">    
            <div class="card" style="width: 15rem;">
              <div class="card-header text-white bg-dark">
                Welcome <a type="text" href="{{ route('profile.index') }}" class="text-white">{{$user->name}}</a>!
              </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <a href="">Address</a>
                </li>
                <li class="list-group-item">
                    <a href="{{ url('profile/order') }}">Order</a>
                </li>
                <li class="list-group-item">
                    <a href="">Wishlist</a>
                </li>
                <li class="list-group-item">
                    <a href="">Review</a>
                </li>
              </ul>
            </div>
        </div>

        <div class="col-auto"> 
            <div class="card" style="width: 50rem;">
              <div class="card-body bg-light">
                  <div class="form-group">
                    <label>Name : <span>{{$user->name}}</span></label>
                  </div>
                  <div class="form-group">
                    <label>Email : <span>{{$user->email}}</span></label>
                  </div>
                  <div class="form-group">
                    <label>Address : <span></span></label>
                  </div>
                  <div class="float-left">
                    <a href="">Edit Profile</a>
                  </div>
              </div>
            </div>
        </div>

    </div>
</div>



@endsection
