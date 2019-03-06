<div class="col-md-3">

    <div class="profile-sidebar border my-3 p-0 pt-3 rounded">
        <div class="profile-userpic text-center">
            <img src="{{ asset('img/like-arise-dashboard.jpg') }}" class="img-responsive" alt="">
        </div>
        <div class="profile-usertitle">
            <div class="profile-usertitle-name">
                {{ Auth::user()->name }}
            </div>
            <div class="profile-usertitle-job">
                Developer
            </div>
        </div>
        <div class="profile-usermenu">
            <ul class="nav">
                <li class="active"><a href="{{ route('front.user.dashboard') }}"> <i class="fa fa-home"></i> Dashboard
                    </a></li>
                <li><a href="{{ route('front.user.profile') }}"><i class="fa fa-user"></i> Account Settings </a></li>
                <li><a href="{{ route('front.user.resetpass') }}"><i class="fa fa-key"></i>Change Password </a></li>
                <li><a href="#"><i class="fa fa-flag"></i> Help </a></li>
            </ul>
        </div>
        <!-- END MENU -->
    </div>

</div>