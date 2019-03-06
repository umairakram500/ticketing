@extends('front.layout.master')

@section('content')

  <div class="row">
    <div class="col-md-4 col-xs-12 col-md-offset-4 my-5">
      <div class="text-center">
        <h3>Register</h3>
        <p>Register to New Khan user account</p>
      </div>
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      {{ Form::open(['route' => 'front.register']) }}
        <div class="form-group">
          <input type="text" name="name" value="{{ old('name') }}" placeholder="Full Name" class="form-control">
        </div>
        <div class="form-group">
          <input type="text" name="email" value="{{ old('email') }}" placeholder="Email" class="form-control">
        </div>
        <div class="form-group">
          <input type="text" placeholder="Phone" name="phone" value="{{ old('phone') }}" class="form-control">
        </div>
        <div class="form-group">
          <input type="password" placeholder="Password" name="password" class="form-control">
        </div>
        <div class="form-group">
          <input type="password" placeholder="Conform Password" name="repass" class="form-control">
        </div>
        <button type="submit"class="btn btn-danger btn-block">Register</button>

      </form>
      <p class="mt-3 text-center">have an account? <a href="{{ route('front.login') }}" class="text-danger
      ">Login</a></p>
    </div>
  </div>

@endsection