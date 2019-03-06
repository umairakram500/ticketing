@extends('front.layout.master')

@section('content')

<!-- OUR SERVICES
================================================== -->
<section class="our-services service-icon-list">
  <div class="container">
      <div class="custom-heading section-heading">
        <h1>OUR SERVICES</h1>
      </div>
      <div class="row">
        <div class="col-lg-6">
          <div class="content">
            <div class="row">
              <div class="col-md-3">
                <div class="type">
                  <i class="fa fa-truck"></i>
                </div>
              </div>
              <div class="col-md-9">
                <h3> CARGO </h3>
                <p> It's our aim to provide Cargo and Courier Services to the People of Pakistan.</p>
              </div> 
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="content">
            <div class="row">
              <div class="col-md-3">
                <div class="type">
                  <i class="fa fa-cab" style="font-size: 32px;"></i>
                </div>
              </div>
              <div class="col-md-9">
                <h3> CAB </h3>
                <p> You can easily travel within the city using our CAB service. Take the car with a drive where ever you want t go.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="content">
            <div class="row">
              <div class="col-md-3">
                <div class="type">
                  <i class="fa fa-bus"></i>
                </div>
              </div>
              <div class="col-md-9">
                <h3> METRO </h3>
                <p> For local traveling our Metro Bus Service is also available in different Cities. </p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="content">
            <div class="row">
              <div class="col-md-3">
                <div class="type">
                  <i class="fa fa-bus"></i>
                </div>
              </div>
              <div class="col-md-9">
                <h3> INNER CITY BUS </h3>
                <p>Transport offers a host of logistic management services and supply chain solutions.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>


<!-- REQUEST
================================================== -->
<section class="request parallax-window" data-parallax="scroll" data-image-src="images/request/request_bg.jpg">
  <div class="container">
    <div class="row">
      <div class="request-content col-xl-6 col-xl-offset-6">
        <div class="custom-heading part-heading">
          <h2>REQUEST A QUICK QUOTE</h2>
        </div>

        <p>We love to listen and we are eagerly waiting to talk to you regarding your project. Get in touch with us if you have any queries and we will get back to you as soon as possible.</p>

        <div class="request-form container">

          <form action="#" method="post" novalidate="novalidate">
          <div class="row">
            <div class="col-lg-6">
                <input class="form-control" type="text" name="name" value="" size="40" aria-required="true" aria-invalid="false" placeholder="Your name here">
            </div>
            <div class="col-lg-6">
              <input class="form-control" type="email" name="email" value="" size="40" aria-required="true" aria-invalid="false" placeholder="Your email">
            </div>
            <div class="col-lg-6">
                <input class="form-control" type="text" name="subject" value="" size="40" aria-invalid="false" placeholder="Subject">
            </div>

            <div class="col-lg-6">
                <input class="form-control" type="text" name="phone" value="" size="40" aria-required="true" aria-invalid="false" placeholder="Phone">
            </div>
            <div class="col-xs-12">
              <textarea class="form-control" name="message" cols="40" rows="4" aria-invalid="false" placeholder="Your message"></textarea>
            </div>
            <div class="col-xs-12">
              <input class="btn btn-primary" type="submit" value="SEND MESSAGE">
            </div>
          </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</section>
	  
	  <!-- FEATURED SERVICES
================================================== -->
<section class="featured-services service-img-list">
  <div class="container">
	  <div class="custom-heading section-heading">
        <h1> LATEST NEWS </h1>
      </div>
	  <br>
    <div class="row">
      <div class="col-lg-4">
        <div class="service-item">
          <img img src="{{ asset('img/featured-services-01.jpg')}}" class="img-fluid" alt="Transport">
          <div class="content">
            <div class="type"><i class="fa fa-codepen"></i></div>
            <h5> OUR WEBSITE IS NOW AVAILABLE </h5>
            <p> You can easily book tickets using our website. You can get more services on our Website...</p>
            <button type="button" class="btn btn-primary">READ MORE<i class="fa fa-arrow-right"></i></button>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="service-item">
          <img src="{{ asset('img/featured-services-02.jpg')}}" class="img-fluid" alt="Transport">
          <div class="content">
            <div class="type"><i class="fa fa-fighter-jet"></i></div>
            <h5> WHY NEW KHAN CARGO SERVICE? </h5>
            <p> It's our aim to provide cargo service to public. You can send packages and we will deliever it on time...</p>
            <button type="button" class="btn btn-primary">READ MORE<i class="fa fa-arrow-right"></i></button>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="service-item">
          <img img src="{{ asset('img/featured-services-03.jpg')}}" class="img-fluid" alt="Transport">
          <div class="content">
            <div class="type"><i class="fa fa-home"></i></div>
            <h5> OUR MOBILE APPLICATION IS COMING </h5>
            <p> Finally, after Website, Our Application is coming for iOS and Android. You will be able to book...</p>
            <button type="button" class="btn btn-primary">READ MORE<i class="fa fa-arrow-right"></i></button>
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