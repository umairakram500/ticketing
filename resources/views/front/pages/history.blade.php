@extends('front.layout.master')

@section('content')

<style type="text/css">
	.mydate{
		width: 60px;
    height: 60px;
    border-radius: 100px;
    color: white;
    font-weight: bold;
    background-color: #232331;
    padding-top: 17px;
    text-align: center;
    font-size: 1rem;
    position: absolute;
    float: right;
    top: 17px;
    z-index: 1;
    right: -32px;
    box-shadow: 0px 0px 14px 5px rgb(255, 255, 255);

	}
  .mydate-2{
        width: 60px;
    height: 60px;
    border-radius: 100px;
    color: white;
    font-weight: bold;
    background-color: #232331;
    padding-top: 17px;
    text-align: center;
    font-size: 1rem;
    position: absolute;
    float: left;
    top: 17px;
    z-index: 1;
    left: -32px;
    box-shadow: 0px 0px 14px 5px rgb(255, 255, 255);


  }
  .polygon{
    clip-path: polygon(0 0, 0% 100%, 100% 50%);
    background-color: #ca1f26;
  }
  .polygon-2{
    clip-path: polygon(100% 0, 100% 100%, 0 50%);
    background-color: #ca1f26;
  }
  .bar{
    width: 10px;
    background-color: black;
    height: 1200px;
    margin: auto;
    border-radius: 5px;
  }
  .myicon{
    background-color: red;
    width: 30px;
    height: 30px;
    border-radius: 30px;
    text-align: center;
    padding: 5px;
    position: relative;
    left: -10px;
    color: white;
  }
  .myheight{
    height: 100px;
  }
  .height1{
    height:176px;
  }
  .height2{
    height:225px;
  }
  .height3{
    height:153px;
  }
  .height4{
    height:344px;
  }

  @media(max-width: 991px){
    .hideme, .polygon, .polygon-2{
      display: none;
    }
    .mydate{
      left: -32px;
    }
    .myheight{
      height: 3rem;
    }
    .pad2{
      padding-left: 3rem!important;
    padding-right: 16px!important;
    }
    .mar{
      margin:0px 25px 0px 25px;
    }
    .mydate, .mydate-2{
      background-color: #ca1f26;
    }
    .height1, .height2, .height3, .height4{
      height: 30px;
    }
    
  }


</style>

<div class="page-title" style="background-image:url({{url('img/bg01.jpg')}})">
    <div class="container">
        <h1 class="entry-title">Our History</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('front.home') }}">Home</a></li>
            <li class="active">History</li>
        </ol>
    </div>
</div>
<!--///////////////////////////////////////////////////-->
<div class="container mb-5 pb-5">
  <div class="row">
    <div class="col-lg-5 col-md-12 col-sm-12 mar">
      
      
        <div class="col-md-10 bg-white border p-3 pr-5 pad2" >
          
    New Khan started its business in 1956 (Non-A.C Buses) with the vision of providing safe, comfortable and economical means of travel to the people of Pakistan.
 

    <div class="mydate">1956</div>
        
</div>
        <div class="col-md-2 polygon" style="height: 100px">
          
        </div>
      
     <div class="col-md-12 height1"></div>
      

        <div class="col-md-10 bg-white border p-3 pr-5 pad2" >
    New Khan is the pioneer in providing air conditioned transport facilities to the general public and started new AC bus service in 1983 in the name of New Khan Road Runners. New Khan takes pride in being the largest and still the fastest luxury transport network in the country. So that, wherever you might want to travel, New Khan Road Runners are there to take you to your destination in absolute comfort and safety. The world’s most luxurious vehicles Mercedes-Benz was also part of our fleet in the past. 
    <div class="mydate">1983</div>
        </div>
        <div class="col-lg-2 polygon" style="height: 100px">
          
        </div>

        <div class="col-md-12 height2"></div>
        <div class="col-md-10 bg-white border p-3 pr-5 pad2" >
    At present we are operating air-conditioned buses on different routes within Punjab, & KPK.  Besides of Company’s owned buses more than 400 buses of different owners are also part of our network and depart on daily basis from our Stands under the umbrella of “NEWKHAN”.
    <div class="mydate">2019</div>
        </div>
        <div class="col-lg-2 polygon" style="height: 100px">
          
        </div>
      
    </div>

    <div class="col-md-2 hideme">
      <div class="bar" >
        <span><i class="fa fa-home myicon" style="top: 36px"></i></span>
        <span><i class="fa fa-home myicon" style="top: 160px"></i></span>
        <span><i class="fa fa-home myicon" style="top: 302px"></i></span>
        <span><i class="fa fa-home myicon" style="top: 620px"></i></span>
        <span><i class="fa fa-home myicon" style="top: 810px"></i></span>
        
      </div>
      
    </div>
    <div class="col-lg-5 col-md-12 col-sm-12 mar">
      <div class="col-md-12 height3" ></div>
      <div class="col-md-2 polygon-2" style="height: 100px">
          
        </div>
      <div class="col-md-10 bg-white border p-3 pl-5">
    With this aim in view, we introduced night traveling for the first time in Pakistan in 1960, giving the people a choice of more traveling hours. New Khan is one of top line passenger Transport Company in the country.
    <div class="mydate-2">1960</div>
        </div>

        <div class="col-md-12 height4"></div>
        <div class="col-md-2 polygon-2" style="height: 100px">
          
        </div>

        <div class="col-md-10 bg-white border p-3 pl-5">
    New Khan started its 3rd variant of passenger transport service in 1999 by introducing new Company namely New Khan Metro Bus Service, It was Intra-City bus service operating within the city of Lahore. We had the largest fleet of 265 buses operating on 9 different routes in Lahore.
    <div class="mydate-2">1999</div>
        </div>
        
      
    </div>
  </div>
</div>
@endsection