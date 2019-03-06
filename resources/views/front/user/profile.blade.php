@extends('front.layout.master')

@section('content')

  <div class="container">
    <div class="row">
      @include('front.includes.userleft')
      <div class="col-md-9">
        <div class="row">
          {{-- <div class="col-md-3">
               <img src="{{ asset('img/like-arise-dashboard.jpg') }}" class="img-responsive img-rounded" alt="">
           </div>--}}
          <div class="col-md-9 pt-3">
            <div class="custom-heading part-heading three-slashes">
              <h2>User Profile</h2>
            </div>
            {{ Form::open(['route' => 'front.user.profileUpdate']) }}
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" id="name">
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="text" class="form-control" name="email" id="email" value="{{ Auth::user()->email }}">
            </div>
            <button class="btn btn-danger px-5">SAVE</button>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection