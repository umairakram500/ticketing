@extends('admin.layouts.app')

@section('title', 'New Khan')
@section('title', 'Welcom to the New Khan')
@section('content')

        <!-- Row starts -->
        <div class="row gutter">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="panel">
                    <div class="website-performance">
                        <div class="row gutter">
                            <div class="col-lg-7 col-md-6 col-sm-6 col-xs-6">
                                <div class="performance">
                                    <h5>Sales</h5>
                                    <div class="performance-graph">
                                        <div id="sales" class="chart-height5"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-6 col-sm-6 col-xs-6">
                                <div class="performance-stats">
                                    <h3 id="salesOdometer" class="odometer">0</h3>
                                    <p>21.2%<i class="icon-triangle-up up"></i></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="panel">
                    <div class="website-performance">
                        <div class="row gutter">
                            <div class="col-lg-7 col-md-6 col-sm-6 col-xs-6">
                                <div class="performance">
                                    <h5>Expenses</h5>
                                    <div class="performance-graph">
                                        <div id="expenses" class="chart-height5"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-6 col-sm-6 col-xs-6">
                                <div class="performance-stats">
                                    <h3 id="expensesOdometer" class="odometer">0</h3>
                                    <p>15.7%<i class="icon-triangle-down down"></i></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="panel">
                    <div class="website-performance">
                        <div class="row gutter">
                            <div class="col-lg-7 col-md-6 col-sm-6 col-xs-6">
                                <div class="performance">
                                    <h5>Profits</h5>
                                </div>
                                <div class="performance-graph">
                                    <div id="profits" class="chart-height5"></div>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-6 col-sm-6 col-xs-6">
                                <div class="performance-stats">
                                    <h3 id="profitsOdometer" class="odometer">0</h3>
                                    <p>19.3%<i class="icon-triangle-up up"></i></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Row ends -->

        <!-- Row starts -->
        <div class="row gutter">
            <div class="col-md-3 col-sm-3 col-xs-6">
                <div class="panel height1">
                    <div class="panel-heading">
                        <h4>Users</h4>
                    </div>
                    <div class="panel-body">
                        <div class="sessions">
                            <h2 class="text-warning">20</h2>
                            {{--<div id="users" class="graph"></div>--}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6">
                <div class="panel height1">
                    <div class="panel-heading">
                        <h4>Customers</h4>
                    </div>
                    <div class="panel-body">
                        <div class="sessions">
                            <h2 class="text-danger">500</h2>
                            {{--<div id="sessions" class="graph"></div>--}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6">
                <div class="panel height1">
                    <div class="panel-heading">
                        <h4>Saff</h4>
                    </div>
                    <div class="panel-body">
                        <div class="sessions">
                            <h2 class="text-success">50</h2>
                            {{--<div id="duration" class="graph"></div>--}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6">
                <div class="panel height1">
                    <div class="panel-heading">
                        <h4>Bounce Rate</h4>
                    </div>
                    <div class="panel-body">
                        <div class="sessions">
                            <h2 class="text-info">12.4%</h2>
                            {{--<div id="bouncerate" class="graph"></div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Row ends -->

        <!-- Row starts -->
        <div class="row gutter">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="row gutter">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="panel height1">
                            <div class="panel-heading">
                                <h4>Money Spend</h4>
                            </div>
                            <div class="panel-body center-text">
                                <span class="updating-chart">5,3,9,6,5,9,7,3,5,2,5,3,9,6,5,9,7,3,5,2</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="panel height1">
                            <div class="panel-heading">
                                <h4>Online</h4>
                            </div>
                            <div class="panel-body">
                                <div id="power-gauge"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row gutter">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="panel height1">
                            <div class="panel-heading">
                                <h4>OS Stats</h4>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-xs-4">
                                        <div class="os">
                                            <div id="mac"></div>
                                            <p class="no-margin">Website</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-4">
                                        <div class="os">
                                            <div id="windows"></div>
                                            <p class="no-margin">Android App</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-4">
                                        <div class="os">
                                            <div id="linux"></div>
                                            <p class="no-margin">IOS APP</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="panel height2">
                    <div class="panel-heading">
                        <h4>City wise sales</h4>
                    </div>
                    <div class="panel-body">
                        <div class="chart-height3" id="bankAccounts">
                            <svg></svg>
                        </div>
                        {{--<ul class="bank-balance clearfix">
                            <li>Credit: <span class="text-success"> $18,378</span></li>
                            <li>Debit: <span class="text-danger"> $12,590</span></li>
                        </ul>--}}
                    </div>
                </div>
            </div>
        </div>
        <!-- Row ends -->

        <!-- Row starts -->
        {{--<div class="row gutter">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="panel height2">
                    <div class="panel-heading">
                        <h4>Stocks</h4>
                    </div>
                    <div class="panel-body">
                        <ul class="stocks">
                            <li>
                                <p class="clearfix">Apple Inc<span><i class="icon-triangle-up text-success"></i>465.45</span></p>
                            </li>
                            <li>
                                <p class="clearfix">Google Inc<span><i class="icon-triangle-up text-success"></i>821.9</span></p>
                            </li>
                            <li>
                                <p class="clearfix">Yahoo Inc<span><i class="icon-triangle-down text-danger"></i>31.88</span></p>
                            </li>
                            <li>
                                <p class="clearfix">Facebook Inc<span><i class="icon-triangle-up text-success"></i>465.45</span></p>
                            </li>
                            <li>
                                <p class="clearfix">Ebay Inc<span><i class="icon-triangle-down text-danger"></i>66.2</span></p>
                            </li>
                            <li>
                                <p class="clearfix">Amazon Inc<span><i class="icon-triangle-up text-success"></i>278.73</span></p>
                            </li>
                            <li>
                                <p class="clearfix">Microsoft<span><i class="icon-triangle-up text-success"></i>39.64</span></p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="panel height2">
                    <div class="panel-heading">
                        <h4>App Downloads</h4>
                    </div>
                    <div class="panel-body">
                        <ul class="app-downloads">
                            <li>
                                <p class="clearfix">
                                    <i class="icon-appleinc text-danger"></i>IOS<span>5769</span>
                                </p>
                                <div class="progress progress-md">
                                    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100" style="width: 89%">
                                        <span class="sr-only">89% Complete (success)</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <p class="clearfix">
                                    <i class="icon-android text-warning"></i>Android<span>2126</span>
                                </p>
                                <div class="progress progress-md">
                                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100" style="width: 55%">
                                        <span class="sr-only">55% Complete (success)</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <p class="clearfix">
                                    <i class="icon-windows8 text-success"></i>Windows<span>1068</span>
                                </p>
                                <div class="progress progress-md">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="29" aria-valuemin="0" aria-valuemax="100" style="width: 29%">
                                        <span class="sr-only">29% Complete (success)</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <p class="clearfix">
                                    <i class="icon-download5 text-info"></i>Blackberry<span>285</span>
                                </p>
                                <div class="progress progress-md">
                                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 10%">
                                        <span class="sr-only">10% Complete (success)</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="row gutter">
                    <div class="col-md-12">
                        <div class="panel height2">
                            <div class="panel-heading">
                                <h4>Transactions</h4>
                            </div>
                            <div class="panel-body">
                                <ul class="transactions">
                                    <li>
                                        <a href="javascript:void(0)">
													<span class="tra-icon">
														<i class="icon-shield3 text-danger"></i>
													</span>
                                            <span class="tra-type">Month Salary</span>
                                            <span class="tra-amount text-success">+7250</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">
													<span class="tra-icon">
														<i class="icon-aircraft text-success"></i>
													</span>
                                            <span class="tra-type">Trip to Venice</span>
                                            <span class="tra-amount text-danger">-1100</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">
													<span class="tra-icon">
														<i class="icon-shopping-cart text-info"></i>
													</span>
                                            <span class="tra-type">Shopping</span>
                                            <span class="tra-amount text-danger">-1890</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">
													<span class="tra-icon">
														<i class="icon-bowl text-warning"></i>
													</span>
                                            <span class="tra-type">Lunch at work</span>
                                            <span class="tra-amount text-danger">-1250</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">
													<span class="tra-icon">
														<i class="icon-pig text-danger"></i>
													</span>
                                            <span class="tra-type">Money left</span>
                                            <span class="tra-amount text-success">+9650</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>--}}
        <!-- Row ends -->

        <!-- Row starts -->
        {{--<div class="row gutter">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="row gutter">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="panel height1">
                            <div class="panel-heading">
                                <h4>Subscribed Users</h4>
                            </div>
                            <div class="panel-body">
                                <div class="chart-horiz clearfix">
                                    <ul class="sales-bar chart">
                                        <li class="current" title="Trails"><span class="bar" data-number="5679"></span><span class="number">5679</span></li>
                                        <li class="current" title="Subscriptions"><span class="bar" data-number="3458"></span><span class="number">3458</span></li>
                                        <li class="current" title="Expansions"><span class="bar" data-number="1934"></span><span class="number">1934</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="panel height1 center-text">
                            <div id="chartExpenses"></div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="panel height1">
                            <div class="panel-body">
                                <div class="sessions">
                                    <h2 class="left">165<i class="icon-direction up"></i></h2>
                                    <div id="invoice" class="graph"></div>
                                </div>
                                <h5 class="info center-text">Invoices sent</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>--}}
        <!-- Row ends -->

        <!-- Row starts -->
        {{--<div class="row gutter">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="panel height1">
                    <div class="panel-heading">
                        <h4>Weekly Sales</h4>
                    </div>
                    <div class="panel-body">
                        <div class="heatmap">
                            <h2 class="text-danger">859</h2>
                            <div id="cal-heatmap"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="panel height1">
                    <div class="panel-heading">
                        <h4>Tickets</h4>
                    </div>
                    <div class="panel-body">
                        <ul class="tickets">
                            <li>
                                <a href="tasks.html">
                                    <h1 class="high no-of-tickets">21</h1>
                                    <p class="ticket-type">High</p>
                                </a>
                            </li>
                            <li>
                                <a href="tasks.html">
                                    <h1 class="no-of-tickets">6</h1>
                                    <p class="ticket-type">Low</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="panel height1">
                    <div class="panel-heading">
                        <h4>Mobile vs Desktop</h4>
                    </div>
                    <div class="panel-body">
                        <div id="mobileDesktop" class="chart-height2"></div>
                    </div>
                </div>
            </div>
        </div>--}}
        <!-- Row ends -->



@endsection