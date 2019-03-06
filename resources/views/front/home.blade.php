@extends('front.layout.master')

@section('content')

@push('slider')
<style>
  .searchbox { display: block}
</style>
    <div id="rev_slider_3_1_wrapper" class="rev_slider_wrapper fullwidthbanner-container" data-alias="slider-02" style="margin:0px auto;background-color:#E9E9E9;padding:0px;margin-top:0px;margin-bottom:0px;">
  <!-- START REVOLUTION SLIDER 5.2.4.1 auto mode -->
  <div id="rev_slider_3_1" class="rev_slider fullwidthabanner" style="display:none;" data-version="5.2.4.1">
  <ul> 
      <li data-index="rs-4" data-transition="random" data-slotamount="7" data-hideafterloop="0" data-hideslideonmobile="off"  data-easein="default" data-easeout="default" data-masterspeed="300"  data-thumb="{{asset('frontasset/images/revo-slider/slider_2_01-100x50.jpg')}}"  data-rotate="0"  data-saveperformance="off"  data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
        <!-- MAIN IMAGE -->
        <img src="{{ asset('frontasset/images/revo-slider/slider_2_02.jpg')}}"  alt="" title="slider_2_01"  width="1920" height="680" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
        <!-- LAYERS -->

 

        <!-- LAYER NR. 1 -->
        <div class="tp-caption   tp-resizeme"
             id="slide-4-layer-1"
             data-x="['left','left','center','center']" data-hoffset="['375','100','0','0']"
             data-y="['top','top','top','top']" data-voffset="['210','200','200','200']"
             data-width="none"
             data-height="none"
             data-whitespace="nowrap"
             data-transform_idle="o:1;rZ:inherit;"

             data-transform_in="x:left;skX:45px;s:300;e:Power3.easeInOut;"
             data-transform_out="auto:auto;s:300;"
             data-start="1700"
             data-responsive_offset="on"


             style="z-index: 5;text-transform:left;"><img src="images/revo-slider/slider2_text.png" alt="" width="106" height="33" data-ww="" data-hh="" data-no-retina> 
           </div>

        <!-- LAYER NR. 2 -->
        <div class="tp-caption t4   tp-resizeme"
             id="slide-4-layer-2"
             data-x="['left','left','center','center']" data-hoffset="['254','82','0','0']"
             data-y="['top','top','top','top']" data-voffset="['256','256','270','270']"
             data-fontsize="['50','50','40','28']"
             data-lineheight="['50','50','','']"
             data-width="none"
             data-height="none"
             data-whitespace="nowrap"
             data-transform_idle="o:1;"

             data-transform_in="x:-50px;opacity:0;s:500;e:Power3.easeInOut;"
             data-transform_out="auto:auto;s:300;"
             data-start="1700"
             data-splitin="lines"
             data-splitout="none"
             data-responsive_offset="on"

             data-elementdelay="0.1"

             style="z-index: 6;color:black; white-space: nowrap; line-height: 50px;text-transform:left;border-color:rgba(255, 214, 88, 1.00);">FIND YOUR NEXT </div>

             



        <!-- LAYER NR. 3 -->
        <div class="tp-caption t4   tp-resizeme"
             id="slide-4-layer-3"
             data-x="['left','left','center','center']" data-hoffset="['254','82','0','0']"
             data-y="['top','top','top','top']" data-voffset="['317','317','317','317']"
             data-fontsize="['50','50','40','28']"
             data-lineheight="['50','50','','']"
             data-width="none"
             data-height="none"
             data-whitespace="nowrap"
             data-transform_idle="o:1;"

             data-transform_in="x:50px;opacity:0;s:500;e:Power3.easeInOut;"
             data-transform_out="auto:auto;s:300;"
             data-start="1700"
             data-splitin="lines"
             data-splitout="none"
             data-responsive_offset="on"

             data-elementdelay="0.1"

             style="z-index: 7;color:black; white-space: nowrap; line-height: 50px;text-transform:left;border-color:rgba(255, 214, 88, 1.00);">GREAT <span style="color: #FED634;">TRAVEL</span> PROVIDER. </div>

        <!-- LAYER NR. 4 -->
        <div class="tp-caption b1  "
             id="slide-4-layer-4"
             data-x="['left','left','center','center']" data-hoffset="['274','100','0','1']"
             data-y="['top','top','top','top']" data-voffset="['444','420','420','400']"
             data-width="none"
             data-height="none"
             data-whitespace="nowrap"
             data-transform_idle="o:1;"

             data-transform_in="y:bottom;s:1000;e:Sine.easeOut;"
             data-transform_out="auto:auto;s:6000;"
             data-start="1800"
             data-splitin="none"
             data-splitout="none"
             data-responsive_offset="on"
             data-responsive="off"

             style="z-index: 8; white-space: nowrap; color: rgba(204, 204, 204, 1.00);text-transform:left;border-color:rgba(204, 204, 204, 1.00);"><a class=" btn" href="#" data-hover="Read More"><span>Read More  <i class="fa fa-arrow-right"></i></span></a> </div>
      </li>
    </ul>
      
    
    <div class="tp-bannertimer tp-bottom" style="height: 5px; background-color: rgba(0, 0, 0, 0.15);"></div> 
    </div>
</div>

    @endpush


<!-- FEATURED SERVICES
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
<section class="request parallax-window" data-parallax="scroll" data-image-src="{{('frontasset/images/request/request_bg.jpg')}}">
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

<!-- OUR SERVICES
================================================== -->
<section class="featured-services service-img-list">
  <div class="container">
    <div class="custom-heading section-heading mb-5">
      <h1> LATEST NEWS </h1>
    </div>
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

<!-- TESTIMONIALS
================================================== -->
<section class="testimonials parallax-window" data-parallax="scroll" data-image-src="images/testimonials_bg.jpg">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="custom-heading section-heading">
          <h1>TESTIMONIALS</h1>
        </div>
        <div class="owl-carousel owl-theme ui-carousel testimonials-carousel">
          <div class="item">
            <div class="quote last no-image">
              <blockquote class="testimonials-text">
                <p>I’ve been happy with the services provided by Construction LLC. Scooter Libby has been wonderful! He has returned my calls quickly, and he answered all my questions</p>
              </blockquote>
              <cite class="author">
                <span>Name Here</span>
                <span class="title">Designation here</span>
                <!--/.title-->
              </cite>
              <!--/.author-->
            </div>
          </div>
          <div class="item">
            <div class="quote">
              <blockquote class="testimonials-text">
                <p>I have always received good service from Transport. Timing and quality have always met my expectations and everything is communicated in a professional and timely manner.</p>
              </blockquote>
              <cite class="author">
                <span>Name Here</span>
                <span class="title">Designation here</span>
                <!--/.title-->
              </cite>
              <!--/.author-->
            </div>
          </div>
          <div class="item">
            <div class="quote first no-image">
              <blockquote class="testimonials-text">
              <p>I’ve been happy with the services provided by Transport. Scooter Libby has been wonderful! He has returned my calls quickly, and he answered all my questions</p>
              </blockquote>
              <cite class="author">
                <span>Name Here</span>
                <span class="title">Designation here</span>
                <!--/.title-->
              </cite><!--/.author-->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


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


@push('js')
@include('front.includes.scripts')
@endpush