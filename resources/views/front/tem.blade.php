@extends('front.layout.master')

@section('content')

<div class="row">
    <div class="col-md-4 col-xs-12 col-md-offset-4 my-5">
        <div class="text-center">
            <h3>Login</h3>
            <p>Login to New Khan user account</p>
        </div>
        {{ Form::open(['route' => 'front.login']) }}
            <div class="form-group">
                <input type="text" placeholder="Eamil" name="email" class="form-control">
            </div>
            <div class="form-group">
                <input type="text" placeholder="Password" name="password" class="form-control">
            </div>
            <button type="submit"class="btn btn-danger btn-block">LOGIN</button>

        </form>
        <p class="mt-3 text-center">Don't have account? <a href="{{ route('front.register') }}" class="text-danger ">Register</a></p>
    </div>
</div>

@endsection