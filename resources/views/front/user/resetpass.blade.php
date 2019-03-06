@extends('front.layout.master')

@section('content')

  <div class="container">
    <div class="row">
      @include('front.includes.userleft')
      <div class="col-md-9">
        <div class="row">

          <div class="col-md-9 pt-3">
            <div class="custom-heading part-heading three-slashes">
              <h2>Reset Password</h2>
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
            {{ Form::open(['route' => 'front.user.resetpassword']) }}
            <div class="form-group">
              <label for="oldpass">Old Password</label>
              <input type="password" class="form-control" name="oldpass" id="oldpass">
            </div>
            <div class="form-group">
              <label for="newpass">New Password</label>
              <input type="password" class="form-control" name="newpass" id="newpass">
            </div>
            <div class="form-group">
              <label for="repass">Repeat Password</label>
              <input type="password" class="form-control" name="repass" id="repass">
            </div>

            <button class="btn btn-danger px-5">SAVE</button>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection