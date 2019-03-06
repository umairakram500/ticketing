@extends('front.layout.master')

@section('content')
	
<style>
	
.img-fluid:hover
{
	transform: scale(1.2);
	transition: transform ease-out 0.6s;
}

</style>

<div class="page-title" style="background-image:url({{url('img/bg01.jpg')}})">
  <div class="container">
    <h1 class="entry-title">Gallery</h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('front.home') }}">Home</a></li>
      <li class="active">Gallery</li>
    </ol>
  </div>
</div>

<!-- Page Content -->
    <div class="container">

      <div class="row text-center text-lg-left">

        <div class="col-lg-3 col-md-4 col-xs-6  mb-4">
          <a href="#" class="d-block h-100">
            <img src="{{ asset('img/Gallary/30688966_1641421145955590_2774153242455526178_n.jpg')}}" class="img-fluid img-thumbnail" alt="" style="width:1000%;height:100%;object-fit:cover;">
          </a>
        </div>
        <div class="col-lg-3 col-md-4 col-xs-6 mb-4">
          <a href="#" class="d-block mb-4 h-100">
            <img src="{{ asset('img/Gallary/34839916_1697347163696321_1891814660164812800_n.jpg')}}"class="img-fluid img-thumbnail" alt="" style="width:100%;height:100%;object-fit:cover;">
          </a>
        </div>
        <!--
		  <div class="col-lg-3 col-md-4 col-xs-6 mb-4">
          <a href="#" class="d-block mb-4 h-100">
            <img src="{{ asset('img/Gallary/44771655_1888021731295529_5534366700096454656_n.jpg')}}" class="img-fluid img-thumbnail"  alt="" style="width:100%;height:100%;object-fit:cover;">
          </a>
		  </div>
		  -->
        <div class="col-lg-3 col-md-4 col-xs-6 mb-4">
          <a href="#" class="d-block mb-4 h-100">
            <img src="{{ asset('img/Gallary/35193484_1701376489960055_838704347226308608_n.jpg')}}"class="img-fluid img-thumbnail"  alt="" style="width:100%;height:100%;object-fit:cover;">
          </a>
        </div>
        <div class="col-lg-3 col-md-4 col-xs-6 mb-4">
          <a href="#" class="d-block mb-4 h-100">
            <img src="{{ asset('img/Gallary/36992463_1746538392110531_8217440135776567296_n.jpg')}}"class="img-fluid img-thumbnail"  alt="" style="width:100%;height:100%;object-fit:cover;">
          </a>
        </div>
        <div class="col-lg-3 col-md-4 col-xs-6 mb-4">
          <a href="#" class="d-block mb-4 h-100">
            <img src="{{ asset('img/Gallary/35194289_1702948069802897_6650054768142057472_n.jpg')}}"class="img-fluid img-thumbnail"  alt="" style="width:100%;height:100%;object-fit:cover;">
          </a>
        </div>
        <div class="col-lg-3 col-md-4 col-xs-6 mb-4">
          <a href="#" class="d-block mb-4 h-100">
            <img src="{{ asset('img/Gallary/35193484_1701376489960055_838704347226308608_n.jpg')}}"class="img-fluid img-thumbnail"  alt="" style="width:100%;height:100%;object-fit:cover;">
          </a>
        </div>
        <div class="col-lg-3 col-md-4 col-xs-6 mb-4">
          <a href="#" class="d-block mb-4 h-100">
            <img src="{{ asset('img/Gallary/37007059_1743395495758154_3885728415306743808_n.jpg')}}" class="img-fluid img-thumbnail"  alt="" style="width:100%;height:100%;object-fit:cover;">
          </a>
        </div>
		  <!--
        <div class="col-lg-3 col-md-4 col-xs-6 mb-4">
          <a href="#" class="d-block mb-4 h-100">
            <img src="{{ asset('img/Gallary/37959473_1773814992716204_8916884536411815936_n.jpg')}}" class="img-fluid img-thumbnail"  alt="" style="width:100%;height:100%;object-fit:cover;">
          </a>
        </div>
-->
        <div class="col-lg-3 col-md-4 col-xs-6 mb-4">
          <a href="#" class="d-block mb-4 h-100">
            <img src="{{ asset('img/Gallary/47680340_2210578295850779_7099318663815102464_n.jpg')}}" class="img-fluid img-thumbnail"  alt="" style="width:100%;height:100%;object-fit:cover;">
          </a>
        </div>
        <div class="col-lg-3 col-md-4 col-xs-6  mb-4">
          <a href="#" class="d-block mb-4 h-100">
            <img src="{{ asset('img/Gallary/48358419_1950997281664640_3332568646563135488_n.jpg')}}" class="img-fluid img-thumbnail"  alt="" style="width:100%;height:100%;object-fit:cover;">
          </a>
        </div>
        <div class="col-lg-3 col-md-4 col-xs-6  mb-4">
          <a href="#" class="d-block mb-4 h-100">
            <img src="{{ asset('img/Gallary/45817962_2208125706123720_6565539110360973312_n.jpg')}}"class="img-fluid img-thumbnail"  alt="" style="width:100%;height:100%;object-fit:cover;">
          </a>
        </div>
		  <!--
		  <div class="col-lg-3 col-md-4 col-xs-6  mb-4">
          <a href="#" class="d-block mb-4 h-100">
            <img src="{{ asset('img/Gallary/37893703_1770452243052479_1777827220266418176_n.jpg')}}" class="img-fluid img-thumbnail"  alt="" style="width:100%;height:100%;object-fit:cover;">
          </a>
        </div>
        <div class="col-lg-3 col-md-4 col-xs-6  mb-4">
          <a href="#" class="d-block mb-4 h-100">
            <img src="{{ asset('img/Gallary/44771655_1888021731295529_5534366700096454656_n.jpg')}}" class="img-fluid img-thumbnail"  alt="" style="width:100%;height:100%;object-fit:cover;">
          </a>
        </div>

        <div class="col-lg-3 col-md-4 col-xs-6  mb-4">
          <a href="#" class="d-block mb-4 h-100">
            <img src="{{ asset('img/Gallary/43745601_1888021737962195_2082029987086467072_n.jpg')}}" class="img-fluid img-thumbnail"  alt="" style="width:100%;height:100%;object-fit:cover;">
          </a>
        </div>
		  -->
        <div class="col-lg-3 col-md-4 col-xs-6  mb-4">
          <a href="#" class="d-block mb-4 h-100">
            <img src="{{ asset('img/Gallary/34602621_1695305617233809_1259387859769491456_n.jpg')}}" class="img-fluid img-thumbnail"  alt="" style="width:100%;height:100%;object-fit:cover;">
          </a>
        </div>
      </div>

    </div>
    <!-- /.container -->

@endsection