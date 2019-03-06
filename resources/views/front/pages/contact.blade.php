@extends('front.layout.master')

@section('content')

<div class="page-title" style="background-image:url({{url('img/bg01.jpg')}})">
  <div class="container">
    <h1 class="entry-title">Contact</h1>
    <ol class="breadcrumb">
      <li><a href="#">Home</a></li>
      <li class="active">Contact</li>
    </ol>
  </div>
</div>

<section class="info-contact">
  <div class="container">
    <div class="row">

      <div class="col-lg-3">

        <div class="custom-heading part-heading three-slashes">
          <h2>CONTACT</h2>
        </div>
        <div class="office">
          <p><i class="fa fa-map-marker"></i>Bund Road Block J, Gulshan-e-Ravi Lahore.</p>
          <p><i class="fa fa-phone"></i> +92 300 8050016 </p>
          <p><i class="fa fa-envelope"></i> info@newkhan.com </p>
          <p><i class="fa fa-clock-o"></i> Mon - Sat: 9:00 - 18:00</p>
        </div>
      </div>
      <div class="contact-content col-lg-9">

        <div class="custom-heading part-heading three-slashes">
          <h2>FILL CONTACT FORM</h2>
        </div>

        <p>We love to listen and we are eagerly waiting to talk to you regarding your project. Get in touch with us if you have any queries and we will get back to you as soon as possible.</p>

        <div class="contact-form">

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


@endsection