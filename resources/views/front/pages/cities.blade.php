@extends('front.layout.master')

@section('content')

<style>

a img
{
	
	overflow: hidden;
	border: none !important;
}
.img-fluid:hover
{
	
	transition: transform ease-out 0.8s;
}
a img:hover
{
	transform: scale(1.04);
}

.city-gallary img {
  width: 100%;
  height: 250px;
  object-fit: cover;
}
.city-gallary .city {
  position: relative;
}
.city-gallary .city .overly {
  position: absolute;
  width: 100%;
  height: 100%;
  top: 0;
  background: rgba(0, 0, 0, 0.35);
}
.city-gallary .city .overly h1 {
  position: absolute;
  color: #fff;
  left: 20px;
  bottom: 5px;
}
</style>



<div class="page-title" style="background-image:url({{url('img/bg01.jpg')}})">
  <div class="container">
    <h1 class="entry-title">Cities</h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('front.home') }}">Home</a></li>
      <li class="active">Cities</li>
    </ol>
  </div>
</div>
<!-- Page Content -->
    <div class="container">

      <div class="row text-center text-lg-left city-gallary">

        <div class="col-lg-4 col-md-4 col-xs-6  mb-4">
          <a href="#" class="d-block h-100 city">
           <img src="{{ asset('img/faisalabad.jpg')}}" class="img-fluid img-thumbnail" alt="Faisalabad">
            <div class="overly">
              <h1>Faisalabad</h1>
            </div>
          </a>
        </div>
        <div class="col-lg-4 col-md-4 col-xs-6 mb-4">
          <a href="#" class="d-block mb-4 h-100 city">
            <img src="{{ asset('img/islamabad.jpg')}}" class="img-fluid img-thumbnail" alt="Islamabad">
            <div class="overly">
              <h1>Islamabad</h1>
            </div>
          </a>
        </div>
        <div class="col-lg-4 col-md-4 col-xs-6 mb-4">
          <a href="#" class="d-block mb-4 h-100 city">
            <img src="{{ asset('img/karachi.jpg')}}" class="img-fluid img-thumbnail" alt="karachi" >
            <div class="overly">
              <h1>Karachi</h1>
            </div>
          </a>
		  </div>
        <div class="col-lg-4 col-md-4 col-xs-6 mb-4">
          <a href="#" class="d-block mb-4 h-100 city">
            <img src="{{ asset('img/Badshahi-Mosque.jpg')}}" class="img-fluid img-thumbnail" alt="Lahore" >
            <div class="overly">
              <h1>Lahore</h1>
            </div>
          </a>
        </div>
        <div class="col-lg-4 col-md-4 col-xs-6 mb-4">
          <a href="#" class="d-block mb-4 h-100 city">
            <img src="{{ asset('img/quetaa city.jpg')}}" class="img-fluid img-thumbnail" alt="quetta" >
            <div class="overly">
              <h1>Quetta</h1>
            </div>
          </a>
        </div>

        <div class="col-lg-4 col-md-4 col-xs-6 mb-4">
          <a href="#" class="d-block mb-4 h-100 city">
            <img src="{{ asset('img/gujranwala.jpg')}}" class="img-fluid img-thumbnail" alt="gujranwala">
            <div class="overly">
              <h1>Gujranwala</h1>
            </div>
          </a>
        </div>

        <div class="col-lg-4 col-md-4 col-xs-6 mb-4">
          <a href="#" class="d-block mb-4 h-100 city">
            <img src="{{ asset('img/sialkot city.jpg')}}" class="img-fluid img-thumbnail" alt="sialkot" >
            <div class="overly">
              <h1>Sialkot</h1>
            </div>
          </a>
        </div>
        <div class="col-lg-4 col-md-4 col-xs-6 mb-4">
          <a href="#" class="d-block mb-4 h-100 city">
            <img src="{{ asset('img/jhang.jpg')}}" class="img-fluid img-thumbnail" alt="jhang" >
            <div class="overly">
              <h1>Jhang</h1>
            </div>
          </a>
        </div>
        <div class="col-lg-4 col-md-4 col-xs-6 mb-4">
          <a href="#" class="d-block mb-4 h-100 city">
            <img src="{{ asset('img/muree.jpg')}}" class="img-fluid img-thumbnail" alt="">
            <div class="overly">
              <h1>Muree</h1>
            </div>
          </a>
        </div>
        

    </div>
	  </div>
    <!-- /.container -->


@endsection