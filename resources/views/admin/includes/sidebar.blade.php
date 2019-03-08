<div class="vertical-nav {{ isset($_COOKIE['sidebar_sm'])?'vertical-nav-sm':'' }}">

    <!-- Collapse menu starts -->
    <button class="collapse-menu">
        <i class="icon-menu2"></i>
    </button>
    <!-- Collapse menu ends -->

    <!-- Current user starts -->
    <div class="user-details clearfix">
        <a href="profile.html" class="user-img">
            <img src="{{ asset('storage/avatars/'.(auth()->user()->avatar??'user.jpg')) }}" alt="User Info">
            <span class="likes-info">9</span>
        </a>
        <h5 class="user-name">{{ auth()->user()->name }}</h5>
    </div>
    <!-- Current user ends -->

    <!-- Sidebar menu start -->
    <ul class="menu clearfix">

        <li class="{{request()->is('admin/dashboard')?'selected':''}}">
            <a href="{{ route('admin.dashboard') }}">
                <i class="fa fa-dashboard"></i>
                <span class="menu-item">Dashboard</span>
            </a>
        </li>

        <!-- Routes -->
        {{--@if(Auth::user()->permission('routes'))--}}
        <li class="{{request()->is('admin/route*')?'selected':''}}">
            <a href="{{ route('admin.route.index') }}">
                <i class="fa fa-road"></i>
                <span class="menu-item">Routes</span>
            </a>
        </li>
        {{--@endif--}}

        <!-- schedules -->
        {{--@if(Auth::user()->permission('schedules'))--}}
        <li class="{{request()->is('admin/schedules*')?'selected active':''}}">
            <a href="{{ route('admin.schedules.index') }}">
                <i class="icon-calendar7"></i>
                <span class="menu-item">Schedules</span>
            </a>
        </li>
        {{--@endif--}}

        <!-- Fares -->
        {{--@if(Auth::user()->permission('fares'))--}}
        <li class="{{request()->is('admin/fares*')?'selected active':''}}">
            <a href="{{ route('admin.fares.index') }}">
                <i class="fa fa-money"></i>
                <span class="menu-item">Fares</span>
            </a>
        </li>
        {{--@endif--}}



        {{--@if(Auth::user()->permission('schedules'))--}}
        {{--<li class="{{request()->is('admin/departure*')?'selected active':''}}">
            <a href="{{ route('admin.departure.create') }}">
                <i class="fa fa-file-text"></i>
                <span class="menu-item">Departure</span>
            </a>
        </li>--}}
        {{--@endif--}}

        {{--@if(Auth::user()->permission('schedules'))--}}
        <li class="{{request()->is('admin/voucher')?'selected active':''}}">
            <a href="{{ route('admin.voucher.create') }}">
                <i class="fa fa-files-o"></i>
                <span class="menu-item">Route Expense</span>
            </a>
        </li>
        {{--@endif--}}

        <li class="{{request()->is('admin/cashier/closing/voucher*')?'selected active':''}}">
            <a href="{{ route('admin.cashier.close.voucher') }}">
                <i class="fa fa-money"></i>
                <span class="menu-item">Closing Voucher</span>
            </a>
        </li>

        <li class="{{request()->is('admin/ticket*')?'selected active':''}}">
            <a href="{{ route('admin.ticket.index') }}">
                <i class="fa fa-ticket"></i>
                <span class="menu-item">Tickets</span>
                <span class="down-arrow"></span>
            </a>
            <ul class="collapse">
                <li>
                    <a href="{{ route('admin.ticket.booking') }}"
                       class="{{request()->is('admin/ticket/booking')?'current':''}}">
                        Book</a>
                </li>
                <li>
                    <a href="{{ route('admin.ticket.ticketing') }}"
                       class="{{request()->is('admin/ticket/ticketing')?'current':''}}">
                        Issue</a>
                </li>
            </ul>
        </li>

        <!-- users -->
        {{--@if(Auth::user()->permission('users'))--}}
            <li class="{{request()->is('admin/users*')||request()->is('admin/roles*')||request()->is('admin/designation*')||request()->is('admin/department*')?'selected active':''}}">
                <a href="{{ route('admin.users.index') }}">
                    <i class="fa fa-users"></i>
                    <span class="menu-item">Users</span>
                    <span class="down-arrow"></span>
                </a>
                <ul class="collapse">
                    <li>
                        <a href="{{ route('admin.users.index') }}"
                           class="{{request()->is('admin/users')?'current':''}}">
                            Users List</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.users.create') }}"
                           class="{{request()->is('admin/users/create')?'current':''}}">
                            Add User</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.roles.index') }}"
                           class="{{request()->is('admin/roles*')?'current':''}}">User Roles</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.designation.index') }}"
                           class="{{request()->is('admin/designation')?'current':''}}">
                            Designations</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.department.index') }}"
                           class="{{request()->is('admin/department')?'current':''}}">
                            Department</a>
                    </li>
                </ul>
            </li>
            {{--@endif--}}

        <!-- Cities -->
        {{--@if(Auth::user()->permission('cities'))--}}
        <li class="{{request()->is('admin/city*')?'selected':''}}">
            <a href="{{ route('admin.city.index') }}">
                <i class="fa fa-building"></i>
                <span class="menu-item">Cities</span>
            </a>
        </li>
        {{--@endif--}}

        <!-- Terminals -->
        {{--@if(Auth::user()->permission('terminals'))--}}
        <li class="{{request()->is('admin/terminal*')?'selected':''}}">
            <a href="{{ route('admin.terminal.index') }}">
                <i class="fa fa-hand-o-right"></i>
                <span class="menu-item">Terminals / Stops</span>
            </a>
        </li>
        {{--@endif--}}



        <!-- staff -->
        {{--@if(Auth::user()->permission('Staff'))--}}
        <li class="{{request()->is('admin/staff*')?'selected active':''}}">
            <a href="{{ route('admin.staff.index') }}">
                <i class="fa fa-users"></i>
                <span class="menu-item">Staff</span>
                <span class="down-arrow"></span>
            </a>
            <ul class="collapse">
                <li>
                    <a href="{{ route('admin.staff.index') }}"
                       class="{{request()->is('admin/staff')?'current':''}}">
                        Staff List</a>
                </li>
                <li>
                    <a href="{{ route('admin.staff.create') }}"
                       class="{{request()->is('admin/staff/create')?'current':''}}">
                        Add Staff</a>
                </li>
                <li>
                    <a href="{{ route('admin.staff.stafftype.index') }}"
                       class="{{request()->route()->getName()=='admin.staff.stafftype.index'?'current':''}}">
                        Staff Type</a>
                </li>
                <li>
                    <a href="{{ route('admin.staff.stafftype.create') }}"
                       class="{{request()->is('admin/staff/stafftype/create')?'current':''}}">
                        Add Staff Type</a>
                </li>
            </ul>
        </li>
        {{--@endif--}}

        <!-- buses -->
        {{--@if(Auth::user()->permission('buses'))--}}
        <li class="{{request()->is('admin/bus*')?'selected active':''}}">
            <a href="{{ route('admin.bus.index') }}">
                <i class="fa fa-bus"></i>
                <span class="menu-item">Buses</span>
                <span class="down-arrow"></span>
            </a>
            <ul class="collapse">
                <li>
                    <a href="{{ route('admin.bus.index') }}"
                       class="{{request()->is('admin/bus')?'current':''}}">
                        Buses List</a>
                </li>
                <li>
                    <a href="{{ route('admin.bus.create') }}"
                       class="{{request()->is('admin/bus/create')?'current':''}}">
                        Add Bus</a>
                </li>
                <li>
                    <a href="{{ route('admin.bus.luxurytype.index') }}"
                       class="{{request()->route()->getName()=='admin.bus.luxurytype.index'?'current':''}}">
                        Luxury Type</a>
                </li>
                <li>
                    <a href="{{ route('admin.bus.luxurytype.create') }}"
                       class="{{request()->is('admin/bus/luxurytype/create')?'current':''}}">
                        Add Luxury Type</a>
                </li>
            </ul>
        </li>
        {{--@endif--}}

        <!-- expense -->
        {{--@if(Auth::user()->permission('expense'))--}}
        <li class="{{request()->is('admin/expense_type*')?'selected':''}}">
            <a href="{{ route('admin.expense_type.index') }}">
                <i class="fa fa-money"></i>
                <span class="menu-item">Expense Types</span>
            </a>
        </li>

        {{--@endif--}}

                <!-- cargo -->

        {{--@if(Auth::user()->permission('cargo'))--}}
            <li class="{{request()->is('admin/cargo*')?'selected active':''}}">
                <a href="{{ route('admin.cargo.index') }}">
                    <i class="icon-aircraft"></i>
                    <span class="menu-item">Cargo</span>
                    <span class="down-arrow"></span>
                </a>
                <ul class="collapse">
                    <li>
                        <a href="{{ route('admin.cargo.index') }}"
                           class="{{request()->is('admin/cargo')?'current':''}}">
                            Pending Packages</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.cargo.create') }}"
                           class="{{request()->is('admin/cargo/create')?'current':''}}">
                            Add Cargo Collection</a>
                    </li>

                    <li>
                        <a href="{{ route('admin.cargo.category.index') }}"
                           class="{{request()->is('admin/cargo/category*')?'current':''}}">
                            Categories</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.cargo.goodstype.index') }}"
                           class="{{request()->is('admin/cargo/goodstype*')?'current':''}}">
                            Goods Types</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.cargo.packing.index') }}"
                           class="{{request()->is('admin/cargo/packing*')?'current':''}}">
                            Packing Types</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.cargo.shipment.index') }}"
                           class="{{request()->is('admin/cargo/shipment*')?'current':''}}">
                            Shipment Status</a>
                    </li>

                </ul>
            </li>
        {{--@endif--}}
    </ul>
    <!-- Sidebar menu snd -->
</div>