<!doctype html>
<html lang="" class="page-home">
<head>

  <meta charset="utf-8">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>New Khan</title>

  <link rel="apple-touch-icon" href="apple-touch-icon.png">
  <!-- Place favicon.ico in the root directory -->
  
  
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,600italic,700' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Oswald:400,700,300' rel='stylesheet' type='text/css'>
  
   <link rel="stylesheet" href="{{ asset('frontasset/css/main.css')}}">
  <link rel="stylesheet" href="{{ asset('css/bootstrap-4-utilities.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontasset/css/datedropper.min.css')}}">

  <link rel="stylesheet" href="{{ asset('frontasset/components/font-awesome/css/font-awesome.css')}}" />
  <link rel="stylesheet" href="{{ asset('frontasset/components/owl.carousel/dist/assets/owl.carousel.css')}}" />
  <link rel="stylesheet" href="{{ asset('frontasset/components/jQuery.mmenu/dist/core/css/jquery.mmenu.all.css')}}" />
  <link rel="stylesheet" href="{{ asset('frontasset/components/lightslider/dist/css/lightslider.min.css')}}" />
  <link rel="stylesheet" href="{{ asset('frontasset/components/lightgallery/dist/css/lightgallery.css')}}" />
  <link rel="stylesheet" href="{{ asset('frontasset/components/owl.carousel/dist/assets/owl.theme.default.min.css')}}" />

  <!-- Slider -->
  <link rel="stylesheet" href="{{ asset('frontasset/components/slider/css/settings.css')}}" />
  <link rel="stylesheet" href="{{ asset('frontasset/components/slider/css/slider.css')}}" />
  <!-- alertify CSS -->
  <link rel="stylesheet" href="{{ asset('css/alertify.min.css') }}"/>
  @stack('css')
 
  <style>
.mobile{display:none;}
@media(max-width:567px)
{
.mobile{display:block;}
}
.font15{font-size:18px;}
    .searchbox select,
    .searchbox input,
    .searchbtn {
      border-radius: 25px;
      margin-bottom: 5px;
    }

    .searchbox {
      width: 300px;
      font-size: 30px !important;
      margin-right: 10px;
      background-color: white;
      min-height: 500px;
      padding: 30px 20px 20px 20px;
      background-color: rgba(255, 255, 255, 0.9);
      position: absolute;
      top: 0;
      right: 0;
      display: none;
    }
    .leftsearch .searchbox {
      position: relative;
      width:100%;
      display: block;
    }
    .top-nitem { line-height: 50px; list-style-type: none; display: inline; }
    ul.account {
      line-height: 24px;
    }
ul.account li a {
  display: block;
  background: #fff;
  padding: 0 10px;
}
ul.account li a:hover {
  background: #ddd;
}
  </style>
 

</head>
<body>

  <div id="page" class="hfeed site">
    
<nav id="mobile-menu" class="mobile">
  <ul>
    <li><a href="#">Home</a></li>
    <li><a href="{{ route('front.about')}}">About us</a></li>
    <li><a href="#contact">Contact</a></li>
  </ul>
</nav>

<header class="site-header style-1">
  <div class="container">
    <div class="row">
      <div class="col-xs-10 col-lg-2 site-branding">
        <a href="{{ route('front.home') }}" rel="home">
          <img src="{{ asset('img/logo.png')}}" alt="Transport – Transport, Logistic &amp; Warehouse WP">
        </a>
      </div>
      <div class="col-lg-10 hidden-md-down">
        <div class="site-info">
          <div class="top-menu-bar">
            <div class="row">
              <div class="col-md-8 col-xl-9">
                <div class="top-menu">
                  <ul id="top-menu" class="menu pull-left">
                    <li class="top-nitem">
                      <a href="#">Best Luxury Travel Services</a>
                    </li>
                    
                  </ul>

                  <ul class="menu pull-right nav navbar-nav">
                    @guest
                    <li class="top-nitem">
                      <a href="{{ route('front.login') }}" class="mx-2">Login</a>
                    </li>
                    <li class="top-nitem">
                      <a href="{{ route('front.register') }}" class="mx-2">Register</a>
                    </li>
                    @endguest

                    @auth
                    <li class="top-nitem dropdown">
                      <a href="{{ route('front.user.dashboard') }}" class="mx-2">My Account</a>
                      <ul class="dropdown-menu account border">
                        <li><a href="{{ route('front.user.dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ route('front.user.profile') }}">Profile</a></li>
                        <li><a href="{{ route('front.user.profile') }}">Edit Profile</a></li>
                      </ul>
                    </li>
                    <li class="top-nitem">
                      <a href="{{ route('front.logout') }}" class="mx-2">Logout</a>
                    </li>
                    @endauth


                  </ul>
                </div>
              </div>

              <div class="col-md-4 col-xl-3">
                <div class="social-menu">
                  <ul id="social-menu-top" class="menu">
                    <li class="menu-item">
                      <a href="http://facebook.com"><i class="fa fa-facebook"></i></a>
                    </li>
                    <li class="menu-item">
                      <a href="http://twitter.com"><i class="fa fa-google-plus"></i></a>
                    </li>
                    <li class="menu-item">
                      <a href="http://plus.google.com"><i class="fa fa-twitter"></i></a>
                    </li>
                    <li class="menu-item">
                      <a href="http://linkedin.com"><i class="fa fa-youtube-play"></i></a></li>
                    <li id="menu-item680" class="menu-item">
                      <a href="http://foursquare.com"><i class="fa fa-vimeo-square"></i></a></li>
                    <li id="menu-item681" class="menu-item">
                      <a href="/feed"><i class="fa fa-dribbble"></i></a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="contact-bar">
            <div class="row">
              <div class="col-lg-10 col-xl-11">
                <div class="contact-detail">
                  <div class="row">
                    <div class="col-md-4 col-xl-3 col-xl-offset-1">
                      <i class="fa fa-phone"></i>
                      <h3>+92 300 8050016</h3>
                      <span>info@newkhan.com</span>
                    </div>
                    <div class="col-md-4">
                      <i class="fa fa-home"></i>
                      <h3>Bund Road Block J,</h3>
                      <span>Gulshan-e-Ravi Lahore.</span>
                    </div>
                    <div class="col-md-4">
                      <i class="fa fa-clock-o"></i>
                      <h3>Mon - Sun : 12AM - 11PM</h3>
                      <span>Opening Time</span>
                    </div>
                  </div>
                </div>
              </div>
              
             
            </div>
          </div>
        </div>
      </div>
      <div class="col-xs-2 col-lg-1 hidden-lg-up">
        <a class="trigger-menu" href="#mobile-menu"></a>
      </div>
    </div>
  </div>
</header>


<nav class="navbar mega navbar-dark bg-dark hidden-lg-down">
  <div class="container">
    <ul class="nav navbar-nav">

      <li class="nav-item dropdown active">
        <a class="nav-link" href="{{ route('front.home') }}" role="button" aria-haspopup="true" aria-expanded="false">HOME <span class="sr-only">(current)</span></a>
      </li>

      <li class="nav-item dropdown mega-fw">
        <a class="nav-link" role="button" aria-haspopup="true" aria-expanded="false" href="{{ route('front.about') }}">ABOUT US</a>
        
      </li>      

      <li class="nav-item dropdown">
        <a class="nav-link" href="{{ route('front.history') }}">HISTORY</a>
      </li>
		
		<li class="nav-item dropdown">
        <a class="nav-link" href="{{ route('front.cities') }}">CITIES</a>
      </li>
		
		<li class="nav-item dropdown">
        <a class="nav-link" href="{{ route('front.gallary') }}">GALLERY</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('front.contact') }}">CONTACT US</a>
      </li>

      <li class="pull-right"><a id="shedulelink" class="btn btn-warning nav-link font15">Get Shedule Now</a></li>

    </ul>
    

  </div>
</nav>
<?php
    $allfrom = \App\Models\City::All();
          //dd($allfrom);
?>
<div class="tp-caption" style="z-index: 6;color:black; white-space: nowrap; line-height: 50px;text-transform:left;border-color:rgba(255, 214, 88, 1.00); font-size:50px; float:right !important; position: relative;">
  @include('front.includes.searchbox')
</div>

@stack('slider')



@yield('content')





<!-- OUR CLIENTS
================================================== -->
{{-- <section class="our-clients">
  <div class="container">
    <div class="custom-heading section-heading">
      <h1>OUR CLIENTS</h1>
    </div>
    <div class="row">
      <div class="col-lg-2 col-sm-4 col-xs-6">
        <a href="#">
          <img src="images/clients/client-01.png" alt="Transport Clients Image" title="CLIENT 01" class="thumbnail img-fluid">
        </a>
      </div>
      <div class="col-lg-2 col-sm-4 col-xs-6">
        <a href="#">
          <img src="images/clients/client-02.png" alt="Transport Clients Image" title="CLIENT 02" class="thumbnail img-fluid">
        </a>
      </div>
      <div class="col-lg-2 col-sm-4 col-xs-6">
        <a href="#">
          <img src="images/clients/client-03.png" alt="Transport Clients Image" title="CLIENT 03" class="thumbnail img-fluid">
        </a>
      </div>
      <div class="col-lg-2 col-sm-4 col-xs-6">
        <a href="#">
          <img src="images/clients/client-04.png" alt="Transport Clients Image" title="CLIENT 04" class="thumbnail img-fluid">
        </a>
      </div>
      <div class="col-lg-2 col-sm-4 col-xs-6">
        <a href="#">
          <img src="images/clients/client-05.png" alt="Transport Clients Image" title="CLIENT 05" class="thumbnail img-fluid">
        </a>
      </div>
      <div class="col-lg-2 col-sm-4 col-xs-6">
        <a href="#">
          <img src="images/clients/client-06.png" alt="Transport Clients Image" title="CLIENT 06" class="thumbnail img-fluid">
        </a>
      </div>
      <div class="col-lg-2 col-sm-4 col-xs-6">
        <a href="#">
          <img src="images/clients/client-07.png" alt="Transport Clients Image" title="CLIENT 07" class="thumbnail img-fluid">
        </a>
      </div>
      <div class="col-lg-2 col-sm-4 col-xs-6">
        <a href="#">
          <img src="images/clients/client-08.png" alt="Transport Clients Image" title="CLIENT 08" class="thumbnail img-fluid">
        </a>
      </div>
      <div class="col-lg-2 col-sm-4 col-xs-6">
        <a href="#">
          <img src="images/clients/client-09.png" alt="Transport Clients Image" title="CLIENT 09" class="thumbnail img-fluid">
        </a>
      </div>
      <div class="col-lg-2 col-sm-4 col-xs-6">
        <a href="#">
          <img src="images/clients/client-10.png" alt="Transport Clients Image" title="CLIENT 10" class="thumbnail img-fluid">
        </a>
      </div>
      <div class="col-lg-2 col-sm-4 col-xs-6">
        <a href="#">
          <img src="images/clients/client-11.png" alt="Transport Clients Image" title="CLIENT 11" class="thumbnail img-fluid">
        </a>
      </div>
      <div class="col-lg-2 col-sm-4 col-xs-6">
        <a href="#">
          <img src="images/clients/client-12.png" alt="Transport Clients Image" title="CLIENT 12" class="thumbnail img-fluid">
        </a>
      </div>
    </div>
  </div>
</section> --}}



<footer class="site-footer">
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <aside class="widget widget_text"><h3 class="widget-title"><span>About Us</span></h3>
          <div class="textwidget">
            <p>
              <img alt="Transport Logo" src="{{ asset('img/logo.png')}}"><br>
              Transport offers a host of logistic management services and supply chain solutions. We provide innovative solutions with the best people, processes, and technology.
            </p>
          </div>
        </aside>
        <div class="social-menu">
            <ul id="social-menu-footer" class="menu">
              <li class="menu-item">
                <a href="http://facebook.com"><i class="fa fa-facebook"></i></a>
              </li>
              <li class="menu-item">
                <a href="http://twitter.com"><i class="fa fa-google-plus"></i></a>
              </li>
              <li class="menu-item">
                <a href="http://plus.google.com"><i class="fa fa-twitter"></i></a>
              </li>
              <li class="menu-item">
                <a href="http://linkedin.com"><i class="fa fa-youtube-play"></i></a></li>
              <li class="menu-item">
                <a href="http://foursquare.com"><i class="fa fa-vimeo-square"></i></a></li>
              <li class="menu-item">
                <a href="/feed"><i class="fa fa-dribbble"></i></a>
              </li>
            </ul>
          </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4">
        <aside id="better-menu-widget-2" class="widget better-menu-widget">
          <h3 class="widget-title"><span>Information</span></h3>
          <div class="menu-information-container">
            <ul id="menu-information" class="menu">
              <li><a href="{{ route('front.about') }}">About Us</a></li>
              <li><a href="{{ route('front.history') }}">History</a></li>
              <li><a href="{{ route('front.gallary') }}">Gallery</a></li>
              <li><a href="{{ route('front.cities') }}">Cities</a></li>
              <li><a href="{{ route('front.contact') }}">Contact Us</a></li>	
            </ul>
          </div>
        </aside>
      </div>
      <div class="col-sm-6 col-md-4">
        <aside class="widget widget_text">
          <h3 class="widget-title"><span>Transport Office</span></h3>
          <div class="textwidget">
            <div class="office">
              <p><i class="fa fa-map-marker"></i> Bund Road Block J, Gulshan-e-Ravi Lahore.</p>
              <p><i class="fa fa-phone"></i> +92 300 8050016 </p>
              <p><i class="fa fa-envelope"></i> info@newkhan.com </p>
              <p><i class="fa fa-clock-o"></i> Mon - Sun : 12AM - 11PM</p>
            </div>
          </div>
        </aside>
      </div>
    </div>
  </div>
</footer>

<div class="copyright">
  <div class="container">
    <div class="row">
      <div class="col-md-4 left">
        Powered By <a target="_blank" href="{{ route('front.home') }}">Invictus
          Solutions (Pvt) Ltd.</a>.
      </div>
      <div class="col-md-8">
        <div class="right">
          © Copyrights <?= date('Y') ?>. All rights reserved.
        </div>
      </div>
    </div>
  </div>
</div>


  </div>
  
  <script src="{{ asset('frontasset/components/jquery/dist/jquery.js')}}"></script>

  <!-- REVOLUTION JS FILES -->
  <script type="text/javascript" src="{{ asset('frontasset/components/slider/js/jquery.themepunch.tools.min.js')}}"></script>
  <script type="text/javascript" src="{{ asset('frontasset/components/slider/js/jquery.themepunch.revolution.min.js')}}"></script>
 
  <script src="{{ asset('frontasset/js/datedropper.min.js')}}"></script>

  <!-- SLIDER REVOLUTION 5.0 EXTENSIONS  (Load Extensions only on Local File Systems !  The following part can be removed on Server for On Demand Loading) -->
  <script type="text/javascript" src="{{ asset('frontasset/components/slider/js/extensions/revolution.extension.actions.min.js')}}"></script>
  <script type="text/javascript" src="{{ asset('frontasset/components/slider/js/extensions/revolution.extension.carousel.min.js')}}"></script>
  <script type="text/javascript" src="{{ asset('frontasset/components/slider/js/extensions/revolution.extension.kenburn.min.js')}}"></script>
  <script type="text/javascript" src="{{ asset('frontasset/components/slider/js/extensions/revolution.extension.layeranimation.min.js')}}"></script>
  <script type="text/javascript" src="{{ asset('frontasset/components/slider/js/extensions/revolution.extension.migration.min.js')}}"></script>
  <script type="text/javascript" src="{{ asset('frontasset/components/slider/js/extensions/revolution.extension.navigation.min.js')}}"></script>
  <script type="text/javascript" src="{{ asset('frontasset/components/slider/js/extensions/revolution.extension.parallax.min.js')}}"></script>
  <script type="text/javascript" src="{{ asset('frontasset/components/slider/js/extensions/revolution.extension.slideanims.min.js')}}"></script>
  <script type="text/javascript" src="{{ asset('frontasset/components/slider/js/extensions/revolution.extension.video.min.js')}}"></script>

  <script src="{{ asset('frontasset/components/owl.carousel/dist/owl.carousel.js')}}"></script>
  <script src="{{ asset('frontasset/components/countUp.js/dist/countUp.min.js')}}"></script>
  <script src="{{ asset('frontasset/components/jQuery.mmenu/dist/core/js/jquery.mmenu.min.all.js')}}"></script>
  <script src="{{ asset('frontasset/components/tether/tether.min.js')}}"></script><!-- Tether for Bootstrap -->
  <script src="{{ asset('frontasset/components/bootstrap/dist/js/bootstrap.js')}}"></script>
  <script src="{{ asset('frontasset/components/parallax.js/parallax.min.js')}}"></script>
  <script src="{{ asset('frontasset/components/sliphover/src/jquery.sliphover.js')}}"></script>
  <script src="{{ asset('frontasset/components/lightslider/dist/js/lightslider.min.js')}}"></script>
  <script src="{{ asset('frontasset/components/lightgallery/dist/js/lightgallery.min.js')}}"></script>
  <script src="{{ asset('frontasset/components/lightgallery/dist/js/lightgallery-all.min.js')}}"></script>

  <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false&amp;language=en"></script>
  <script src="{{ asset('frontasset/js/vendor/gmap3.min.js')}}"></script>
  <script src="{{ asset('frontasset/js/vendor/jquery.elevateZoom-3.0.8.min.js')}}"></script>

  <script src="{{ asset('frontasset/js/main.js')}}"></script>

  <!-- jQuery Toaster js -->
  <script src="{{ asset('js/alertify.min.js') }}"></script>

<script type="text/javascript">
  var tpj=jQuery;
  tpj.noConflict();
  var revapi3;
  tpj(document).ready(function() {
    if(tpj("#rev_slider_3_1").revolution == undefined){
      revslider_showDoubleJqueryError("#rev_slider_3_1");
    }else{
      revapi3 = tpj("#rev_slider_3_1").show().revolution({
        sliderType:"standard",
        jsFileLocation:"//transport.thememove.com/wp-content/plugins/revslider/public/images/revo-slider/js/",
        sliderLayout:"auto",
        dottedOverlay:"none",
        delay:6000,
        navigation: {
          keyboardNavigation:"off",
          keyboard_direction: "horizontal",
          mouseScrollNavigation:"off",
          mouseScrollReverse:"default",
          onHoverStop:"on",
          touch:{
            touchenabled:"on",
            swipe_threshold: 75,
            swipe_min_touches: 1,
            swipe_direction: "horizontal",
            drag_block_vertical: false
          }
          ,
          // arrows: {
          //   style:"hades",
          //   enable:true,
          //   hide_onmobile:false,
          //   hide_onleave:false,
          //   tmp:'<div class="tp-arr-allwrapper">  <div class="tp-arr-imgholder"></div></div>',
          //   left: {
          //     h_align:"left",
          //     v_align:"center",
          //     h_offset:20,
          //     v_offset:0
          //   },
          //   right: {
          //     h_align:"right",
          //     v_align:"center",
          //     h_offset:20,
          //     v_offset:0
          //   }
          // }
        },
        responsiveLevels:[1240,1024,778,480],
        visibilityLevels:[1240,1024,778,480],
        gridwidth:[1920,1024,778,480],
        gridheight:[680,768,960,720],
        lazyType:"none",
        shadow:0,
        spinner:"spinner3",
        stopLoop:"off",
        stopAfterLoops:-1,
        stopAtSlide:-1,
        shuffle:"off",
        autoHeight:"off",
        hideThumbsOnMobile:"off",
        hideSliderAtLimit:0,
        hideCaptionAtLimit:0,
        hideAllCaptionAtLilmit:0,
        debugMode:false,
        fallbacks: {
          simplifyAll:"off",
          nextSlideOnWindowFocus:"off",
          disableFocusListener:false,
        }
      });
    }
  }); /*ready*/

  (function () {
    alertify.set('notifier','position', 'top-right');

    @if(Session::has('flash_success'))
    alertify.success('{{ Session::get( 'flash_success' ) }}');
    @endif

    @if(Session::has('flash_error'))
    alertify.error('{{ Session::get( 'flash_error' ) }}');
    @endif

})();

jQuery('input.datepicker').dateDropper();
</script>
  @include('front.includes.scripts')
  @stack('js')

</body>
</html>
