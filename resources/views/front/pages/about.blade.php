@extends('front.layout.master')

@section('content')


<div class="page-title" style="background-image:url({{url('img/bg01.jpg')}})">
  <div class="container">
    <h1 class="entry-title">About Us</h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('front.home') }}">Home</a></li>
      <li class="active">About Us</li>
    </ol>
  </div>
</div>

<section class="our-company">
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <div id="myCarousel" class="carousel slide hidden-lg-down" data-ride="carousel">
          <!-- Indicators -->
          <ol class="carousel-indicators left-bottom-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="{{ asset('img/about-1.jpg')}}" class="img-fluid" alt="Transport Image">
            </div>
            <div class="carousel-item">
              <img src="{{ asset('img/about-2.jpg')}}" class="img-fluid" alt="Transport Image">
            </div>
            <div class="carousel-item">
              <img src="{{ asset('img/about-3.jpg')}}" class="img-fluid" alt="Transport Image">
            </div>
          </div>
        </div>

      </div>
      <div class="col-lg-6">
        <div class="custom-heading part-heading three-slashes">
          <h2>OUR COMPANY</h2>
        </div>
        <div class="description">
          <p> NewKhan is a Transport company in Pakistan founded by Amir Abdullah Khan Rokri (Late) in 1985. NewKhan provices comfortable travling to the customers. We travel in more than 20 cities of Pakistan. NewKhan Transport Company have a workshop for the service and maintance of our buses. At NewKhan, Our staff is well organized.</p>

          <p> Being a Transport Company in Pakistan, we have a large number of buses with economic fares. We Provide 4 different services in differnet cities. New Khan is different from other transport companies. Our buses don't travel Non-Stop. </p>


        </div>

        <button type="button" class="btn btn-primary">OUR LOCATION <i class="fa fa-map-marker"></i> </button>

      </div>
    </div>
  </div>
</section>
	  

<section class="our-mission service-img-list">
  <div class="container">
    <div class="custom-heading section-heading three-slashes">
      <h2>OUR MISSION</h2>
    </div>
	  <section>
  <div class="container">
    <div class="ui-quote">
      <q> The Growth of Our Company Will be Built on Our Solid Foundation </q>
    </div>
  </div>
</section>
    <div class="row">
      <div class="col-lg-4">
        <img src="{{ asset('img/featured-services-01.jpg')}}" class="img-fluid" alt="Transport">
        <div class="content">
          <div class="type"><i class="fa fa-shield"></i></div>
          <h5>SAFETY</h5>
          <p> Safety of our Customers is our first priority. We Provide Safety to Our Customers. You can rely on us for sending packages or traveling with us...</p>
        </div>
      </div>
      <div class="col-lg-4">
         <img src="{{ asset('img/featured-services-02.jpg')}}" class="img-fluid" alt="Transport">
        <div class="content">
          <div class="type"><i class="fa fa-clock-o"></i></div>
          <h5> PUNCTUALITY </h5>
          <p> Time is important for everyone and so for us. You can rely on us to travel on time. We arrive on time and departure on time...</p>
        </div>
      </div>
      <div class="col-lg-4">
         <img src="{{ asset('img/featured-services-03.jpg')}}" class="img-fluid" alt="Transport">
        <div class="content">
          <div class="type"><i class="fa fa-thumbs-o-up"></i></div>
          <h5>SUSTANABILITY</h5>
          <p> Sustainability is one of our mission. We train our staff to treat customers in a good manner and do their work honestly...</p>
        </div>
      </div>
    </div>
  </div>
</section>


<section class="our-member">
  <div class="members-grid">
    <div class="container">
      <div class="custom-heading section-heading three-slashes">
        <h2>OUR MEMBERS</h2>
      </div>
      <div class="row">
        <div class="col-lg-3">
           <img src="{{ asset('img/m1.jpg')}}" class="img-fluid" alt="Transport">
          <div class="content">
            <h3>Name Here</h3>
            <h5>Designation Here</h5>
          </div>
        </div>
        <div class="col-lg-3">
           <img src="{{ asset('img/m2.jpg')}}" class="img-fluid" alt="Transport">
          <div class="content">
            <h3>Name Here</h3>
            <h5>Designation Here</h5>
          </div>
        </div>
        <div class="col-lg-3">
           <img src="{{ asset('img/m3.jpg')}}" class="img-fluid" alt="Transport">
          <div class="content">
            <h3>Name Here</h3>
            <h5>Designation Here</h5>
          </div>
        </div>
        <div class="col-lg-3">
           <img src="{{ asset('img/m4.jpg')}}" class="img-fluid" alt="Transport">
          <div class="content">
            <h3>Name Here</h3>
            <h5>Designation Here</h5>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- ADVISORY
================================================== -->
<section class="advisory">
  <div class="container">
    <div class="row">
      <div class="col-md-10">
        <h2> Are You Looking for Something Else? Ask Us. </h2>
      </div>
      <div class="col-md-2">
        <button type="button" class="btn btn-primary">CONTACT US<i class="fa fa-map-marker"></i></button>
      </div>
    </div>
  </div>
</section>

@endsection