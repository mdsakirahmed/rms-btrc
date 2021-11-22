@extends('layouts.backend.app')
@section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Blank Page</h4>
    </div>
    <div class="col-md-7 align-self-center text-end">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb justify-content-end">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Blank Page</li>
            </ol>
            <button type="button" class="btn btn-dark d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create
                New</button>
        </div>
    </div>
</div>

<div class="row">
    <!-- Column -->
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div class="round align-self-center round-success"><i class="ti-wallet"></i></div>
                    <div class="m-l-10 align-self-center">
                        <h3 class="m-b-0">3564</h3>
                        <h5 class="text-muted m-b-0">New Customers</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div class="round align-self-center round-info"><i class="ti-user"></i></div>
                    <div class="m-l-10 align-self-center">
                        <h3 class="m-b-0">342</h3>
                        <h5 class="text-muted m-b-0">New Products</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div class="round align-self-center round-danger"><i class="ti-calendar"></i></div>
                    <div class="m-l-10 align-self-center">
                        <h3 class="m-b-0">56%</h3>
                        <h5 class="text-muted m-b-0">Today's Profit</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div class="round align-self-center round-success"><i class="ti-settings"></i></div>
                    <div class="m-l-10 align-self-center">
                        <h3 class="m-b-0">56%</h3>
                        <h5 class="text-muted m-b-0">New Leads</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
</div>
<!-- Row -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <ul id="webticker-5">
                    <li><i class="cc BTC"></i><span class="text-info"> BDT </span><span
                            class="text-warning"> ৳11.039232</span></li>
                    <li><i class="cc ETH"></i><span class="text-info"> BDT </span><span
                            class="text-warning"> ৳1.2792</span></li>
                    <li><i class="cc GAME"></i><span class="text-info"> BDT </span><span
                            class="text-warning"> ৳11.039232</span></li>
                    <li><i class="cc LBC"></i> <span class="text-info"> BDT </span><span
                            class="text-warning"> ৳0.588418</span></li>
                    <li><i class="cc NEO"></i><span class="text-info"> BDT </span><span
                            class="text-warning"> ৳161.511</span></li>
                    <li><i class="cc STEEM"></i><span class="text-info"> BDT </span><span
                            class="text-warning"> ৳0.551955</span></li>
                    <li><i class="cc LTC"></i><span class="text-info"> BDT </span><span
                            class="text-warning"> ৳177.80</span></li>
                    <li><i class="cc NOTE"></i><span class="text-info"> BDT </span><span
                            class="text-warning"> ৳13.399</span></li>
                    <li><i class="cc MINT"></i><span class="text-info"> BDT </span><span
                            class="text-warning"> ৳0.880694</span></li>
                    <li><i class="cc IOTA"></i><span class="text-info"> BDT </span><span
                            class="text-warning"> ৳2.555</span></li>
                    <li><i class="cc DASH"></i><span class="text-info"> BDT </span><span
                            class="text-warning"> ৳769.22</span></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <!-- col -->
    <div class="col-lg-4 col-md-6">
        <div class="card bg-primary">
            <div class="card-body">
                <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
                    <!-- Carousel items -->
                    <div class="carousel-inner">
                        <div class="carousel-item flex-column">
                            <div class="d-flex no-block al m-r-15ign-items-center">
                                <i class="cc BTC text-white display-6 m-r-15" title="BTC"></i>
                                <div class="m-t-10">
                                    <h5 class="text-white font-medium">Taka</h5>
                                    <h6 class="text-white">Realestate</h6>
                                </div>
                                <div class="ms-auto m-t-15">
                                    <div class="crypto"></div>
                                </div>
                            </div>
                            <div class="row text-center text-white m-t-30">
                                <div class="col-4">
                                    <span class="font-14">% 1h</span>
                                    <p class="font-medium"><i class="fa fa-arrow-up"></i> 0.08</p>
                                </div>
                                <div class="col-4">
                                    <span class="font-14">% 24h</span>
                                    <p class="font-medium"><i class="fa fa-arrow-down"></i> -1.06</p>
                                </div>
                                <div class="col-4">
                                    <span class="font-14">% 7d</span>
                                    <p class="font-medium"><i class="fa fa-arrow-up"></i> -20.10</p>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item flex-column">
                            <div class="d-flex no-block al m-r-15ign-items-center">
                                <i class="cc BTC text-white display-6 m-r-15" title="BTC"></i>
                                <div class="m-t-10">
                                    <h5 class="text-white font-medium">Taka</h5>
                                    <h6 class="text-white">Realestate</h6>
                                </div>
                                <div class="ms-auto m-t-15">
                                    <div class="crypto"></div>
                                </div>
                            </div>
                            <div class="row text-center text-white m-t-30">
                                <div class="col-4">
                                    <span class="font-14">% 1h</span>
                                    <p class="font-medium"><i class="fa fa-arrow-up"></i> 2.08</p>
                                </div>
                                <div class="col-4">
                                    <span class="font-14">% 24h</span>
                                    <p class="font-medium"><i class="fa fa-arrow-down"></i> -3.06</p>
                                </div>
                                <div class="col-4">
                                    <span class="font-14">% 7d</span>
                                    <p class="font-medium"><i class="fa fa-arrow-up"></i> -21.01</p>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item flex-column active">
                            <div class="d-flex no-block al m-r-15ign-items-center">
                                <i class="cc BTC text-white display-6 m-r-15" title="BTC"></i>
                                <div class="m-t-10">
                                    <h5 class="text-white font-medium">Taka</h5>
                                    <h6 class="text-white">Realestate</h6>
                                </div>
                                <div class="ms-auto m-t-15">
                                    <div class="crypto"></div>
                                </div>
                            </div>
                            <div class="row text-center text-white m-t-30">
                                <div class="col-4">
                                    <span class="font-14">% 1h</span>
                                    <p class="font-medium"><i class="fa fa-arrow-up"></i> 0.12</p>
                                </div>
                                <div class="col-4">
                                    <span class="font-14">% 24h</span>
                                    <p class="font-medium"><i class="fa fa-arrow-down"></i> -1.06</p>
                                </div>
                                <div class="col-4">
                                    <span class="font-14">% 7d</span>
                                    <p class="font-medium"><i class="fa fa-arrow-up"></i> -0.08</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- col -->
    <div class="col-lg-4 col-md-6">
        <div class="card bg-cyan">
            <div class="card-body">
                <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
                    <!-- Carousel items -->
                    <div class="carousel-inner">
                        <div class="carousel-item flex-column">
                            <div class="d-flex no-block al m-r-15ign-items-center">
                                <i class="cc DASH-alt text-white display-6 m-r-15" title="DASH"></i>
                                <div class="m-t-10">
                                    <h5 class="text-white font-medium">Dash</h5>
                                    <h6 class="text-white">Trading</h6>
                                </div>
                                <div class="ms-auto m-t-15">
                                    <div class="crypto"></div>
                                </div>
                            </div>
                            <div class="row text-center text-white m-t-30">
                                <div class="col-4">
                                    <span class="font-14">% 1h</span>
                                    <p class="font-medium"><i class="fa fa-arrow-up"></i> 1.18</p>
                                </div>
                                <div class="col-4">
                                    <span class="font-14">% 24h</span>
                                    <p class="font-medium"><i class="fa fa-arrow-down"></i> -1.10</p>
                                </div>
                                <div class="col-4">
                                    <span class="font-14">% 7d</span>
                                    <p class="font-medium"><i class="fa fa-arrow-up"></i> -0.20</p>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item flex-column">
                            <div class="d-flex no-block al m-r-15ign-items-center">
                                <i class="cc DASH-alt text-white display-6 m-r-15" title="DASH"></i>
                                <div class="m-t-10">
                                    <h5 class="text-white font-medium">Dash</h5>
                                    <h6 class="text-white">Trading</h6>
                                </div>
                                <div class="ms-auto m-t-15">
                                    <div class="crypto"></div>
                                </div>
                            </div>
                            <div class="row text-center text-white m-t-30">
                                <div class="col-4">
                                    <span class="font-14">% 1h</span>
                                    <p class="font-medium"><i class="fa fa-arrow-up"></i> 1.18</p>
                                </div>
                                <div class="col-4">
                                    <span class="font-14">% 24h</span>
                                    <p class="font-medium"><i class="fa fa-arrow-down"></i> -1.06</p>
                                </div>
                                <div class="col-4">
                                    <span class="font-14">% 7d</span>
                                    <p class="font-medium"><i class="fa fa-arrow-up"></i> -1.01</p>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item flex-column active">
                            <div class="d-flex no-block al m-r-15ign-items-center">
                                <i class="cc DASH-alt text-white display-6 m-r-15" title="DASH"></i>
                                <div class="m-t-10">
                                    <h5 class="text-white font-medium">Dash</h5>
                                    <h6 class="text-white">Trading</h6>
                                </div>
                                <div class="ms-auto m-t-15">
                                    <div class="crypto"></div>
                                </div>
                            </div>
                            <div class="row text-center text-white m-t-30">
                                <div class="col-4">
                                    <span class="font-14">% 1h</span>
                                    <p class="font-medium"><i class="fa fa-arrow-up"></i> 1.16</p>
                                </div>
                                <div class="col-4">
                                    <span class="font-14">% 24h</span>
                                    <p class="font-medium"><i class="fa fa-arrow-down"></i> -1.10</p>
                                </div>
                                <div class="col-4">
                                    <span class="font-14">% 7d</span>
                                    <p class="font-medium"><i class="fa fa-arrow-up"></i> -0.08</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- col -->
    <div class="col-lg-4 col-md-6">
        <div class="card bg-dark">
            <div class="card-body">
                <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
                    <!-- Carousel items -->
                    <div class="carousel-inner">
                        <div class="carousel-item flex-column">
                            <div class="d-flex no-block al m-r-15ign-items-center">
                                <i class="cc ETH text-white display-6 m-r-15"></i>
                                <div class="m-t-10">
                                    <h5 class="text-white font-medium">Ethereum</h5>
                                    <h6 class="text-white">Exchange</h6>
                                </div>
                                <div class="ms-auto m-t-15">
                                    <div class="crypto"></div>
                                </div>
                            </div>
                            <div class="row text-center text-white m-t-30">
                                <div class="col-4">
                                    <span class="font-14">% 1h</span>
                                    <p class="font-medium"><i class="fa fa-arrow-up"></i> 1.18</p>
                                </div>
                                <div class="col-4">
                                    <span class="font-14">% 24h</span>
                                    <p class="font-medium"><i class="fa fa-arrow-down"></i> -5.16</p>
                                </div>
                                <div class="col-4">
                                    <span class="font-14">% 7d</span>
                                    <p class="font-medium"><i class="fa fa-arrow-up"></i> -20.10</p>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item flex-column">
                            <div class="d-flex no-block al m-r-15ign-items-center">
                                <i class="cc ETH text-white display-6 m-r-15"></i>
                                <div class="m-t-10">
                                    <h5 class="text-white font-medium">Ethereum</h5>
                                    <h6 class="text-white">Exchange</h6>
                                </div>
                                <div class="ms-auto m-t-15">
                                    <div class="crypto"></div>
                                </div>
                            </div>
                            <div class="row text-center text-white m-t-30">
                                <div class="col-4">
                                    <span class="font-14">% 1h</span>
                                    <p class="font-medium"><i class="fa fa-arrow-up"></i> 2.08</p>
                                </div>
                                <div class="col-4">
                                    <span class="font-14">% 24h</span>
                                    <p class="font-medium"><i class="fa fa-arrow-down"></i> -1.16</p>
                                </div>
                                <div class="col-4">
                                    <span class="font-14">% 7d</span>
                                    <p class="font-medium"><i class="fa fa-arrow-up"></i> -1.08</p>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item flex-column active">
                            <div class="d-flex no-block al m-r-15ign-items-center">
                                <i class="cc ETH text-white display-6 m-r-15"></i>
                                <div class="m-t-10">
                                    <h5 class="text-white font-medium">Ethereum</h5>
                                    <h6 class="text-white">Exchange</h6>
                                </div>
                                <div class="ms-auto m-t-15">
                                    <div class="crypto"></div>
                                </div>
                            </div>
                            <div class="row text-center text-white m-t-30">
                                <div class="col-4">
                                    <span class="font-14">% 1h</span>
                                    <p class="font-medium"><i class="fa fa-arrow-up"></i> 1.02</p>
                                </div>
                                <div class="col-4">
                                    <span class="font-14">% 24h</span>
                                    <p class="font-medium"><i class="fa fa-arrow-down"></i> -3.16</p>
                                </div>
                                <div class="col-4">
                                    <span class="font-14">% 7d</span>
                                    <p class="font-medium"><i class="fa fa-arrow-up"></i> -10.00</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card-group">
    <!-- card -->
    <div class="card o-income">
        <div class="card-body">
            <div class="d-flex m-b-30 no-block">
                <h4 class="card-title m-b-0 align-self-center">Market Value</h4>
                <div class="ms-auto">
                    <select class="form-select border-0">
                        <option selected="">Today</option>
                        <option value="1">Tomorrow</option>
                    </select>
                </div>
            </div>
            <div id="income" style="height:260px; width:100%;"></div>
            <ul class="list-inline m-t-30 text-center font-12">
                <li><i class="fa fa-circle text-primary"></i> Taka</li>
                <li><i class="fa fa-circle text-dark"></i> Ethereum </li>
            </ul>
        </div>
    </div>
    <!-- card -->
    <div class="card">
        <div class="card-body">
            <div class="d-flex m-b-30 no-block">
                <h4 class="card-title m-b-0 align-self-center">Invest</h4>
                <div class="ms-auto">
                    <select class="form-select border-0">
                        <option selected="">Today</option>
                        <option value="1">Tomorrow</option>
                    </select>
                </div>
            </div>
            <div id="visitor" style="height:260px; width:100%;"></div>
            <ul class="list-inline m-t-30 text-center font-12">
                <li><i class="fa fa-circle text-primary"></i> Taka</li>
                <li><i class="fa fa-circle text-dark"></i> Ethereum</li>
                <li><i class="fa fa-circle text-info"></i> Ripple</li>
            </ul>
        </div>
    </div>
    <!-- card -->
    <div class="card">
        <div class="p-20 p-t-25">
            <h4 class="card-title">Live Crypto Prices</h4>
        </div>
        <div id="live" style="height: 350px;position: relative;">
            <div class="d-flex no-block p-15 align-items-center">
                <div class="round round-primary"><i class="cc BTC-alt font-16" title="BTC"></i></div>
                <div class="m-l-10 ">
                    <h3 class="m-b-0">BTC</h3>
                    <h6 class="text-muted font-light m-b-0">৳ 7,060.03 <i
                            class="fa fa-angle-down text-danger"></i></h6>
                </div>
            </div>
            <hr>
            <div class="d-flex no-block p-15 align-items-center">
                <div class="round bg-inverse"><i class="cc ETH-alt font-16" title="ETH"></i></div>
                <div class="m-l-10">
                    <h3 class="m-b-0">ETH</h3>
                    <h6 class="text-muted font-light m-b-0">৳ 750.03 <i
                            class="fa fa-angle-up text-success"></i></h6>
                </div>
            </div>
            <hr>
            <div class="d-flex no-block p-15 m-b-15 align-items-center">
                <div class="round round-danger"><i class="cc EOS font-16 text-white" title="EOS"></i>
                </div>
                <div class="m-l-10">
                    <h3 class="m-b-0">XMR</h3>
                    <h6 class="text-muted font-light m-b-0">৳ 7,890.03 <i
                            class="fa fa-angle-down text-danger"></i></h6>
                </div>
            </div>
            <hr>
            <div class="d-flex no-block p-15 m-b-15 align-items-center">
                <div class="round round-success"><i class="cc LTC-alt font-16 text-white"
                        title="LTC"></i></div>
                <div class="m-l-10">
                    <h3 class="m-b-0">LTC</h3>
                    <h6 class="text-muted font-light m-b-0">৳ 8,900.03 <i
                            class="fa fa-angle-up text-success"></i></h6>
                </div>
            </div>
            <hr>
            <div class="d-flex no-block p-15 m-b-15 align-items-center">
                <div class="round round-danger"><i class="cc POT-alt font-16 text-white"
                        title="POT"></i></div>
                <div class="m-l-10">
                    <h3 class="m-b-0">XRP</h3>
                    <h6 class="text-muted font-light m-b-0">৳ 9,6060.03 <i
                            class="fa fa-angle-down text-danger"></i></h6>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- Yearly Sales -->
<!-- ============================================================== -->
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <div class="d-flex m-b-30 align-items-center no-block">
                    <h5 class="card-title">Sales Statistics</h5>
                    <div class="ms-auto">
                        <ul class="list-inline font-12">
                            <li><i class="fa fa-circle text-primary"></i> Taka Sale</li>
                            <li><i class="fa fa-circle text-dark"></i> Ethereum Sale</li>
                        </ul>
                    </div>
                </div>
                <div id="morris-area-chart" style="height: 350px;"></div>
            </div>
            <div class="card-body bg-light">
                <div class="row text-center m-b-20">
                    <div class="col-lg-4 col-md-4 m-t-20">
                        <h2 class="m-b-0 font-light">6000</h2><span class="text-muted">Total sale</span>
                    </div>
                    <div class="col-lg-4 col-md-4 m-t-20">
                        <h2 class="m-b-0 font-light">4000</h2><span class="text-muted">Taka
                            Sale</span>
                    </div>
                    <div class="col-lg-4 col-md-4 m-t-20">
                        <h2 class="m-b-0 font-light">2000</h2><span class="text-muted">Ethereum
                            Sale</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Trading Activities</h5>
                <h6 class="card-subtitle">check out your trading activities</h6>
                <div class="steamline m-t-40">
                    <div class="sl-item">
                        <div class="sl-left bg-primary"><i class="cc BTC-alt" title="BTC"></i></div>
                        <div class="sl-right">
                            <div class="font-medium"> Deal number 126515 <span class="sl-date">
                                    5pm</span></div>
                            <div class="desc"><i class="fa fa-plus text-success"></i> 0.00113 BTC </div>
                        </div>
                    </div>
                    <div class="sl-item">
                        <div class="sl-left bg-inverse"><i class="cc ETH-alt" title="LTC"></i></div>
                        <div class="sl-right">
                            <div class="font-medium">Deal number 123675 <span class="sl-date">
                                    5pm</span></div>
                            <div class="desc"><i class="fa fa-plus text-success"></i> 3.90244 ETH</div>
                        </div>
                    </div>
                    <div class="sl-item">
                        <div class="sl-left bg-success"><i class="cc LTC-alt" title="LTC"></i></div>
                        <div class="sl-right">
                            <div class="font-medium">Deal number 126515 <span class="sl-date">
                                    5pm</span></div>
                            <div class="desc"><i class="fa fa-minus text-danger"></i> 0.00121 LTC </div>
                        </div>
                    </div>
                    <div class="sl-item">
                        <div class="sl-left bg-primary"><i class="cc BTC-alt" title="BTC"></i></div>
                        <div class="sl-right">
                            <div class="font-medium">Deal number 159034 <span class="sl-date">5 minutes
                                    ago</span></div>
                            <div class="desc"><i class="fa fa-plus text-success"></i> 0.01231 BTC</div>
                        </div>
                    </div>
                    <div class="sl-item">
                        <div class="sl-left bg-info"><i class="cc DASH-alt" title="DASH"></i></div>
                        <div class="sl-right">
                            <div class="font-medium"> Deal number 136563 <span class="sl-date">5 minutes
                                    ago</span></div>
                            <div class="desc"><i class="fa fa-minus text-danger"></i> 0.6673 DASH
                                <br><a href="javascript:void(0)"
                                    class="btn m-t-10 m-r-5 btn-rounded btn-outline-success">Apporve</a>
                                <a href="javascript:void(0)"
                                    class="btn m-t-10 btn-rounded btn-outline-danger">Refuse</a> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- CryptoCurrency Table -->
<!-- ============================================================== -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Crypto Market</h4>
                <div class="table-responsive m-t-20">
                    <table id="cc-table" class="table table-bordered table-striped"
                        data-page-length='10'>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Currency</th>
                                <th class="text-end">Price</th>
                                <th class="text-end">Market Cap</th>
                                <th class="text-end">Volume 1D</th>
                                <th class="text-end">Change % (1M)</th>
                                <th class="text-end">Change % (1D)</th>
                                <th class="text-end">Change % (1W)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr role="row">
                                <td><span><a href="JavaScript: void(0);"><i class="cc XRP"
                                                title="XRP"></i></a></span></td>
                                <td>
                                    <h6><a href="JavaScript: void(0);"> Ripple</a></h6>
                                    <small class="text-muted">XRP</small>
                                </td>
                                <td class="text-end">
                                    <p>৳1.67</p>
                                </td>
                                <td class="text-end">
                                    <p>৳61,191,183,730</p>
                                </td>
                                <td class="text-end">
                                    <p>৳10,133,400,000</p>
                                </td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -0.18%</span></td>
                                <td class="no-wrap text-end"><span class="label label-success"><i
                                            class="fa fa-chevron-up"></i> 66.26%</span></td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -16.48%</span></td>
                            </tr>
                            <tr role="row">
                                <td><span><a href="JavaScript: void(0);"><i class="cc ETH"
                                                title="ETH"></i></a></span></td>
                                <td>
                                    <h6><a href="JavaScript: void(0);"> Ethereum</a></h6>
                                    <small class="text-muted">ETH</small>
                                </td>
                                <td class="text-end">
                                    <p>৳1,074.39</p>
                                </td>
                                <td class="text-end">
                                    <p>৳103,792,495,504</p>
                                </td>
                                <td class="text-end">
                                    <p>৳7,764,310,000</p>
                                </td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -1.38%</span></td>
                                <td class="no-wrap text-end"><span class="label label-success"><i
                                            class="fa fa-chevron-up"></i> 26.18%</span></td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -11.47%</span></td>
                            </tr>
                            <tr role="row">
                                <td><span><a href="JavaScript: void(0);"><i class="cc BTC"
                                                title="BTC"></i></a></span></td>
                                <td>
                                    <h6><a href="JavaScript: void(0);"> Taka</a></h6>
                                    <small class="text-muted">BTC</small>
                                </td>
                                <td class="text-end">
                                    <p>৳11,723.48</p>
                                </td>
                                <td class="text-end">
                                    <p>৳179,078,267,295</p>
                                </td>
                                <td class="text-end">
                                    <p>৳17,959,900,000</p>
                                </td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -1.89%</span></td>
                                <td class="no-wrap text-end"><span class="label label-success"><i
                                            class="fa fa-chevron-up"></i> 17.66%</span></td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -15.25%</span></td>
                            </tr>
                            <tr role="row">
                                <td><span><a href="JavaScript: void(0);"><i class="cc ADA"
                                                title="ADA"></i></a></span></td>
                                <td>
                                    <h6><a href="JavaScript: void(0);"> Cardano</a></h6>
                                    <small class="text-muted">ADA</small>
                                </td>
                                <td class="text-end">
                                    <p>৳0.70</p>
                                </td>
                                <td class="text-end">
                                    <p>৳17,633,890,043</p>
                                </td>
                                <td class="text-end">
                                    <p>৳1,677,430,000</p>
                                </td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -2.43%</span></td>
                                <td class="no-wrap text-end"><span class="label label-success"><i
                                            class="fa fa-chevron-up"></i> 40.79%</span></td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -5.81%</span></td>
                            </tr>
                            <tr role="row">
                                <td><span><a href="JavaScript: void(0);"><i class="cc LTC"
                                                title="LTC"></i></a></span></td>
                                <td>
                                    <h6><a href="JavaScript: void(0);"> Litecoin</a></h6>
                                    <small class="text-muted">LTC</small>
                                </td>
                                <td class="text-end">
                                    <p>৳198.80</p>
                                </td>
                                <td class="text-end">
                                    <p>৳10,901,255,520</p>
                                </td>
                                <td class="text-end">
                                    <p>৳1,235,380,000</p>
                                </td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -2.59%</span></td>
                                <td class="no-wrap text-end"><span class="label label-success"><i
                                            class="fa fa-chevron-up"></i> 26.98%</span></td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -15.44%</span></td>
                            </tr>
                            <tr role="row">
                                <td><span><a href="JavaScript: void(0);"><i class="cc XEM"
                                                title="XEM"></i></a></span></td>
                                <td>
                                    <h6><a href="JavaScript: void(0);"> NEM</a></h6>
                                    <small class="text-muted">XEM</small>
                                </td>
                                <td class="text-end">
                                    <p>৳1.09</p>
                                </td>
                                <td class="text-end">
                                    <p>৳9,990,569,999</p>
                                </td>
                                <td class="text-end">
                                    <p>৳153,535,000</p>
                                </td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -1.30%</span></td>
                                <td class="no-wrap text-end"><span class="label label-success"><i
                                            class="fa fa-chevron-up"></i> 43.30%</span></td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -19.68%</span></td>
                            </tr>
                            <tr role="row">
                                <td><span><a href="JavaScript: void(0);"><i class="cc NEO"
                                                title="NEO"></i></a></span></td>
                                <td>
                                    <h6><a href="JavaScript: void(0);"> NEO</a></h6>
                                    <small class="text-muted">NEO</small>
                                </td>
                                <td class="text-end">
                                    <p>৳149.18</p>
                                </td>
                                <td class="text-end">
                                    <p>৳9,644,490,000</p>
                                </td>
                                <td class="text-end">
                                    <p>৳1,310,130,000</p>
                                </td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -4.38%</span></td>
                                <td class="no-wrap text-end"><span class="label label-success"><i
                                            class="fa fa-chevron-up"></i> 36.98%</span></td>
                                <td class="no-wrap text-end"><span class="label label-success"><i
                                            class="fa fa-chevron-up"></i> 31.09%</span></td>
                            </tr>
                            <tr role="row">
                                <td><span><a href="JavaScript: void(0);"><i class="cc DASH"
                                                title="DASH"></i></a></span></td>
                                <td>
                                    <h6><a href="JavaScript: void(0);"> Dash</a></h6>
                                    <small class="text-muted">DASH</small>
                                </td>
                                <td class="text-end">
                                    <p>৳865.25</p>
                                </td>
                                <td class="text-end">
                                    <p>৳6,778,308,110</p>
                                </td>
                                <td class="text-end">
                                    <p>৳193,430,000</p>
                                </td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -0.99%</span></td>
                                <td class="no-wrap text-end"><span class="label label-success"><i
                                            class="fa fa-chevron-up"></i> 30.80%</span></td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -16.40%</span></td>
                            </tr>
                            <tr role="row">
                                <td><span><a href="JavaScript: void(0);"><i class="cc EOS"
                                                title="EOS"></i></a></span></td>
                                <td>
                                    <h6><a href="JavaScript: void(0);"> EOS</a></h6>
                                    <small class="text-muted">EOS</small>
                                </td>
                                <td class="text-end">
                                    <p>৳10.50</p>
                                </td>
                                <td class="text-end">
                                    <p>৳6,460,374,540</p>
                                </td>
                                <td class="text-end">
                                    <p>৳1,566,567,000</p>
                                </td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -4.19%</span></td>
                                <td class="no-wrap text-end"><span class="label label-success"><i
                                            class="fa fa-chevron-up"></i> 25.88%</span></td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -6.45%</span></td>
                            </tr>
                            <tr role="row">
                                <td><span><a href="JavaScript: void(0);"><i class="cc XMR"
                                                title="XMR"></i></a></span></td>
                                <td>
                                    <h6><a href="JavaScript: void(0);"> Monero</a></h6>
                                    <small class="text-muted">XMR</small>
                                </td>
                                <td class="text-end">
                                    <p>৳336.10</p>
                                </td>
                                <td class="text-end">
                                    <p>৳5,249,235,889</p>
                                </td>
                                <td class="text-end">
                                    <p>৳176,640,000</p>
                                </td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -1.90%</span></td>
                                <td class="no-wrap text-end"><span class="label label-success"><i
                                            class="fa fa-chevron-up"></i> 28.77%</span></td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -9.98%</span></td>
                            </tr>
                            <tr role="row">
                                <td><span><a href="JavaScript: void(0);"><i class="cc ETC"
                                                title="ETC"></i></a></span></td>
                                <td>
                                    <h6><a href="JavaScript: void(0);"> Ethereum Classic</a></h6>
                                    <small class="text-muted">ETC</small>
                                </td>
                                <td class="text-end">
                                    <p>৳31.38</p>
                                </td>
                                <td class="text-end">
                                    <p>৳3,189,936,842</p>
                                </td>
                                <td class="text-end">
                                    <p>৳550,173,000</p>
                                </td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -4.09%</span></td>
                                <td class="no-wrap text-end"><span class="label label-success"><i
                                            class="fa fa-chevron-up"></i> 24.95%</span></td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -8.36%</span></td>
                            </tr>
                            <tr role="row">
                                <td><span><a href="JavaScript: void(0);"><i class="cc QTUM"
                                                title="QTUM"></i></a></span></td>
                                <td>
                                    <h6><a href="JavaScript: void(0);"> Qtum</a></h6>
                                    <small class="text-muted">QTUM</small>
                                </td>
                                <td class="text-end">
                                    <p>৳38.28</p>
                                </td>
                                <td class="text-end">
                                    <p>৳2,717,991,874</p>
                                </td>
                                <td class="text-end">
                                    <p>৳878,043,000</p>
                                </td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -3.15%</span></td>
                                <td class="no-wrap text-end"><span class="label label-success"><i
                                            class="fa fa-chevron-up"></i> 26.85%</span></td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -21.15%</span></td>
                            </tr>
                            <tr role="row">
                                <td><span><a href="JavaScript: void(0);"><i class="cc LSK"
                                                title="LSK"></i></a></span></td>
                                <td>
                                    <h6><a href="JavaScript: void(0);"> Lisk</a></h6>
                                    <small class="text-muted">LSK</small>
                                </td>
                                <td class="text-end">
                                    <p>৳23.75</p>
                                </td>
                                <td class="text-end">
                                    <p>৳2,384,607,027</p>
                                </td>
                                <td class="text-end">
                                    <p>৳94,234,400</p>
                                </td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -1.90%</span></td>
                                <td class="no-wrap text-end"><span class="label label-success"><i
                                            class="fa fa-chevron-up"></i> 38.85%</span></td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -9.40%</span></td>
                            </tr>
                            <tr role="row">
                                <td><span><a href="JavaScript: void(0);"><i class="cc OMG"
                                                title="OMG"></i></a></span></td>
                                <td>
                                    <h6><a href="JavaScript: void(0);"> OmiseGO</a></h6>
                                    <small class="text-muted">OMG</small>
                                </td>
                                <td class="text-end">
                                    <p>৳18.89</p>
                                </td>
                                <td class="text-end">
                                    <p>৳1,986,950,969</p>
                                </td>
                                <td class="text-end">
                                    <p>৳101,699,000</p>
                                </td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -2.35%</span></td>
                                <td class="no-wrap text-end"><span class="label label-success"><i
                                            class="fa fa-chevron-up"></i> 38.23%</span></td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -17.34%</span></td>
                            </tr>
                            <tr role="row">
                                <td><span><a href="JavaScript: void(0);"><i class="cc USDT"
                                                title="USDT"></i></a></span></td>
                                <td>
                                    <h6><a href="JavaScript: void(0);"> Tether</a></h6>
                                    <small class="text-muted">USDT</small>
                                </td>
                                <td class="text-end">
                                    <p>৳1.09</p>
                                </td>
                                <td class="text-end">
                                    <p>৳1,622,345,408</p>
                                </td>
                                <td class="text-end">
                                    <p>৳4,241,850,000</p>
                                </td>
                                <td class="no-wrap text-end"><span class="label label-success"><i
                                            class="fa fa-chevron-up"></i> 0.79%</span></td>
                                <td class="no-wrap text-end"><span class="label label-success"><i
                                            class="fa fa-chevron-up"></i> 1.23%</span></td>
                                <td class="no-wrap text-end"><span class="label label-success"><i
                                            class="fa fa-chevron-up"></i> 3.53%</span></td>
                            </tr>
                            <tr role="row">
                                <td><span><a href="JavaScript: void(0);"><i class="cc XVG"
                                                title="XVG"></i></a></span></td>
                                <td>
                                    <h6><a href="JavaScript: void(0);"> Verge</a></h6>
                                    <small class="text-muted">XVG</small>
                                </td>
                                <td class="text-end">
                                    <p>৳0.15</p>
                                </td>
                                <td class="text-end">
                                    <p>৳1,633,900,911</p>
                                </td>
                                <td class="text-end">
                                    <p>৳231,147,000</p>
                                </td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -6.69%</span></td>
                                <td class="no-wrap text-end"><span class="label label-success"><i
                                            class="fa fa-chevron-up"></i> 79.25%</span></td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -25.09%</span></td>
                            </tr>
                            <tr role="row">
                                <td><span><a href="JavaScript: void(0);"><i class="cc ZEC"
                                                title="ZEC"></i></a></span></td>
                                <td>
                                    <h6><a href="JavaScript: void(0);"> Zcash</a></h6>
                                    <small class="text-muted">ZEC</small>
                                </td>
                                <td class="text-end">
                                    <p>৳530.42</p>
                                </td>
                                <td class="text-end">
                                    <p>৳1,616,048,635</p>
                                </td>
                                <td class="text-end">
                                    <p>৳145,864,000</p>
                                </td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -0.99%</span></td>
                                <td class="no-wrap text-end"><span class="label label-success"><i
                                            class="fa fa-chevron-up"></i> 25.35%</span></td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -20.35%</span></td>
                            </tr>
                            <tr role="row">
                                <td><span><a href="JavaScript: void(0);"><i class="cc STRAT"
                                                title="STRAT"></i></a></span></td>
                                <td>
                                    <h6><a href="JavaScript: void(0);"> Stratis</a></h6>
                                    <small class="text-muted">STRAT</small>
                                </td>
                                <td class="text-end">
                                    <p>৳15.55</p>
                                </td>
                                <td class="text-end">
                                    <p>৳1,533,582,626</p>
                                </td>
                                <td class="text-end">
                                    <p>৳55,036,000</p>
                                </td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -1.85%</span></td>
                                <td class="no-wrap text-end"><span class="label label-success"><i
                                            class="fa fa-chevron-up"></i> 34.30%</span></td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -8.87%</span></td>
                            </tr>
                            <tr role="row">
                                <td><span><a href="JavaScript: void(0);"><i class="cc ARDR"
                                                title="ARDR"></i></a></span></td>
                                <td>
                                    <h6><a href="JavaScript: void(0);"> Ardor</a></h6>
                                    <small class="text-muted">ARDR</small>
                                </td>
                                <td class="text-end">
                                    <p>৳1.49</p>
                                </td>
                                <td class="text-end">
                                    <p>৳1,482,874,960</p>
                                </td>
                                <td class="text-end">
                                    <p>৳261,149,070</p>
                                </td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -4.51%</span></td>
                                <td class="no-wrap text-end"><span class="label label-success"><i
                                            class="fa fa-chevron-up"></i> 29.63%</span></td>
                                <td class="no-wrap text-end"><span class="label label-success"><i
                                            class="fa fa-chevron-up"></i> 7.35%</span></td>
                            </tr>
                            <tr role="row">
                                <td><span><a href="JavaScript: void(0);"><i class="cc BCN"
                                                title="BCN"></i></a></span></td>
                                <td>
                                    <h6><a href="JavaScript: void(0);"> Bytecoin</a></h6>
                                    <small class="text-muted">BCN</small>
                                </td>
                                <td class="text-end">
                                    <p>৳0.05</p>
                                </td>
                                <td class="text-end">
                                    <p>৳1,455,618,587</p>
                                </td>
                                <td class="text-end">
                                    <p>৳10,801,700</p>
                                </td>
                                <td class="no-wrap text-end"><span class="label label-success"><i
                                            class="fa fa-chevron-up"></i> 0.65%</span></td>
                                <td class="no-wrap text-end"><span class="label label-success"><i
                                            class="fa fa-chevron-up"></i> 54.18%</span></td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -21.18%</span></td>
                            </tr>
                            <tr role="row">
                                <td><span><a href="JavaScript: void(0);"><i class="cc STEEM"
                                                title="STEEM"></i></a></span></td>
                                <td>
                                    <h6><a href="JavaScript: void(0);"> Steem</a></h6>
                                    <small class="text-muted">STEEM</small>
                                </td>
                                <td class="text-end">
                                    <p>৳4.48</p>
                                </td>
                                <td class="text-end">
                                    <p>৳1,108,959,745</p>
                                </td>
                                <td class="text-end">
                                    <p>৳25,057,000</p>
                                </td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -1.89%</span></td>
                                <td class="no-wrap text-end"><span class="label label-success"><i
                                            class="fa fa-chevron-up"></i> 42.82%</span></td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -6.88%</span></td>
                            </tr>
                            <tr role="row">
                                <td><span><a href="JavaScript: void(0);"><i class="cc BTS"
                                                title="BTS"></i></a></span></td>
                                <td>
                                    <h6><a href="JavaScript: void(0);"> BitShares</a></h6>
                                    <small class="text-muted">BTS</small>
                                </td>
                                <td class="text-end">
                                    <p>৳0.35</p>
                                </td>
                                <td class="text-end">
                                    <p>৳947,954,004</p>
                                </td>
                                <td class="text-end">
                                    <p>৳89,824,706</p>
                                </td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -3.67%</span></td>
                                <td class="no-wrap text-end"><span class="label label-success"><i
                                            class="fa fa-chevron-up"></i> 35.09%</span></td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -39.44%</span></td>
                            </tr>
                            <tr role="row">
                                <td><span><a href="JavaScript: void(0);"><i class="cc DOGE"
                                                title="DOGE"></i></a></span></td>
                                <td>
                                    <h6><a href="JavaScript: void(0);"> Dogecoin</a></h6>
                                    <small class="text-muted">DOGE</small>
                                </td>
                                <td class="text-end">
                                    <p>৳0.06</p>
                                </td>
                                <td class="text-end">
                                    <p>৳941,142,759</p>
                                </td>
                                <td class="text-end">
                                    <p>৳63,248,190</p>
                                </td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -2.48%</span></td>
                                <td class="no-wrap text-end"><span class="label label-success"><i
                                            class="fa fa-chevron-up"></i> 39.89%</span></td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -30.99%</span></td>
                            </tr>
                            <tr role="row">
                                <td><span><a href="JavaScript: void(0);"><i class="cc WAVES"
                                                title="WAVES"></i></a></span></td>
                                <td>
                                    <h6><a href="JavaScript: void(0);"> Waves</a></h6>
                                    <small class="text-muted">WAVES</small>
                                </td>
                                <td class="text-end">
                                    <p>৳8.79</p>
                                </td>
                                <td class="text-end">
                                    <p>৳877,976,009</p>
                                </td>
                                <td class="text-end">
                                    <p>৳39,506,890</p>
                                </td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -2.78%</span></td>
                                <td class="no-wrap text-end"><span class="label label-success"><i
                                            class="fa fa-chevron-up"></i> 22.66%</span></td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -23.46%</span></td>
                            </tr>
                            <tr role="row">
                                <td><span><a href="JavaScript: void(0);"><i class="cc REP"
                                                title="REP"></i></a></span></td>
                                <td>
                                    <h6><a href="JavaScript: void(0);"> Augur</a></h6>
                                    <small class="text-muted">REP</small>
                                </td>
                                <td class="text-end">
                                    <p>৳66.98</p>
                                </td>
                                <td class="text-end">
                                    <p>৳736,499,700</p>
                                </td>
                                <td class="text-end">
                                    <p>৳30,136,309</p>
                                </td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -2.88%</span></td>
                                <td class="no-wrap text-end"><span class="label label-success"><i
                                            class="fa fa-chevron-up"></i> 31.97%</span></td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -36.96%</span></td>
                            </tr>
                            <tr role="row">
                                <td><span><a href="JavaScript: void(0);"><i class="cc KMD"
                                                title="KMD"></i></a></span></td>
                                <td>
                                    <h6><a href="JavaScript: void(0);"> Komodo</a></h6>
                                    <small class="text-muted">KMD</small>
                                </td>
                                <td class="text-end">
                                    <p>৳6.91</p>
                                </td>
                                <td class="text-end">
                                    <p>৳708,479,055</p>
                                </td>
                                <td class="text-end">
                                    <p>৳13,785,890</p>
                                </td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -2.48%</span></td>
                                <td class="no-wrap text-end"><span class="label label-success"><i
                                            class="fa fa-chevron-up"></i> 48.68%</span></td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -11.30%</span></td>
                            </tr>
                            <tr role="row">
                                <td><span><a href="JavaScript: void(0);"><i class="cc DGB"
                                                title="DGB"></i></a></span></td>
                                <td>
                                    <h6><a href="JavaScript: void(0);"> DigiByte</a></h6>
                                    <small class="text-muted">DGB</small>
                                </td>
                                <td class="text-end">
                                    <p>৳0.09</p>
                                </td>
                                <td class="text-end">
                                    <p>৳665,577,230</p>
                                </td>
                                <td class="text-end">
                                    <p>৳30,605,200</p>
                                </td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -2.50%</span></td>
                                <td class="no-wrap text-end"><span class="label label-success"><i
                                            class="fa fa-chevron-up"></i> 40.37%</span></td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -30.84%</span></td>
                            </tr>
                            <tr role="row">
                                <td><span><a href="JavaScript: void(0);"><i class="cc ARK"
                                                title="ARK"></i></a></span></td>
                                <td>
                                    <h6><a href="JavaScript: void(0);"> Ark</a></h6>
                                    <small class="text-muted">ARK</small>
                                </td>
                                <td class="text-end">
                                    <p>৳6.68</p>
                                </td>
                                <td class="text-end">
                                    <p>৳652,059,748</p>
                                </td>
                                <td class="text-end">
                                    <p>৳12,056,300</p>
                                </td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -0.99%</span></td>
                                <td class="no-wrap text-end"><span class="label label-success"><i
                                            class="fa fa-chevron-up"></i> 42.47%</span></td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -24.49%</span></td>
                            </tr>
                            <tr role="row">
                                <td><span><a href="JavaScript: void(0);"><i class="cc SALT"
                                                title="SALT"></i></a></span></td>
                                <td>
                                    <h6><a href="JavaScript: void(0);"> SALT</a></h6>
                                    <small class="text-muted">SALT</small>
                                </td>
                                <td class="text-end">
                                    <p>৳8.90</p>
                                </td>
                                <td class="text-end">
                                    <p>৳639,566,223</p>
                                </td>
                                <td class="text-end">
                                    <p>৳17,684,380</p>
                                </td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -0.50%</span></td>
                                <td class="no-wrap text-end"><span class="label label-success"><i
                                            class="fa fa-chevron-up"></i> 35.95%</span></td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -24.29%</span></td>
                            </tr>
                            <tr role="row">
                                <td><span><a href="JavaScript: void(0);"><i class="cc BAT"
                                                title="BAT"></i></a></span></td>
                                <td>
                                    <h6><a href="JavaScript: void(0);"> Basic Attention Token</a></h6>
                                    <small class="text-muted">BAT</small>
                                </td>
                                <td class="text-end">
                                    <p>৳0.65</p>
                                </td>
                                <td class="text-end">
                                    <p>৳627,186,090</p>
                                </td>
                                <td class="text-end">
                                    <p>৳39,758,910</p>
                                </td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -4.20%</span></td>
                                <td class="no-wrap text-end"><span class="label label-success"><i
                                            class="fa fa-chevron-up"></i> 63.50%</span></td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -10.58%</span></td>
                            </tr>
                            <tr role="row">
                                <td><span><a href="JavaScript: void(0);"><i class="cc GNT"
                                                title="GNT"></i></a></span></td>
                                <td>
                                    <h6><a href="JavaScript: void(0);"> Golem</a></h6>
                                    <small class="text-muted">GNT</small>
                                </td>
                                <td class="text-end">
                                    <p>৳0.75</p>
                                </td>
                                <td class="text-end">
                                    <p>৳608,458,133</p>
                                </td>
                                <td class="text-end">
                                    <p>৳17,960,100</p>
                                </td>
                                <td class="no-wrap text-end"><span class="label label-success"><i
                                            class="fa fa-chevron-up"></i> 2.44%</span></td>
                                <td class="no-wrap text-end"><span class="label label-success"><i
                                            class="fa fa-chevron-up"></i> 39.44%</span></td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -15.84%</span></td>
                            </tr>
                            <tr role="row">
                                <td><span><a href="JavaScript: void(0);"><i class="cc DCR"
                                                title="DCR"></i></a></span></td>
                                <td>
                                    <h6><a href="JavaScript: void(0);"> Decred</a></h6>
                                    <small class="text-muted">DCR</small>
                                </td>
                                <td class="text-end">
                                    <p>৳89.30</p>
                                </td>
                                <td class="text-end">
                                    <p>৳587,788,364</p>
                                </td>
                                <td class="text-end">
                                    <p>৳2,610,730</p>
                                </td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -2.54%</span></td>
                                <td class="no-wrap text-end"><span class="label label-success"><i
                                            class="fa fa-chevron-up"></i> 26.30%</span></td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -15.60%</span></td>
                            </tr>
                            <tr role="row">
                                <td><span><a href="JavaScript: void(0);"><i class="cc GBYTE"
                                                title="GBYTE"></i></a></span></td>
                                <td>
                                    <h6><a href="JavaScript: void(0);"> Byteball Bytes</a></h6>
                                    <small class="text-muted">GBYTE</small>
                                </td>
                                <td class="text-end">
                                    <p>৳862.48</p>
                                </td>
                                <td class="text-end">
                                    <p>৳569,397,493</p>
                                </td>
                                <td class="text-end">
                                    <p>৳2,595,740</p>
                                </td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -1.00%</span></td>
                                <td class="no-wrap text-end"><span class="label label-success"><i
                                            class="fa fa-chevron-up"></i> 54.31%</span></td>
                                <td class="no-wrap text-end"><span class="label label-success"><i
                                            class="fa fa-chevron-up"></i> 24.76%</span></td>
                            </tr>
                            <tr role="row">
                                <td><span><a href="JavaScript: void(0);"><i class="cc PIVX"
                                                title="PIVX"></i></a></span></td>
                                <td>
                                    <h6><a href="JavaScript: void(0);"> PIVX</a></h6>
                                    <small class="text-muted">PIVX</small>
                                </td>
                                <td class="text-end">
                                    <p>৳9.67</p>
                                </td>
                                <td class="text-end">
                                    <p>৳534,840,023</p>
                                </td>
                                <td class="text-end">
                                    <p>৳9,728,770</p>
                                </td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -2.17%</span></td>
                                <td class="no-wrap text-end"><span class="label label-success"><i
                                            class="fa fa-chevron-up"></i> 22.99%</span></td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -22.89%</span></td>
                            </tr>
                            <tr role="row">
                                <td><span><a href="JavaScript: void(0);"><i class="cc FCT"
                                                title="FCT"></i></a></span></td>
                                <td>
                                    <h6><a href="JavaScript: void(0);"> Factom</a></h6>
                                    <small class="text-muted">FCT</small>
                                </td>
                                <td class="text-end">
                                    <p>৳48.88</p>
                                </td>
                                <td class="text-end">
                                    <p>৳426,780,828</p>
                                </td>
                                <td class="text-end">
                                    <p>৳16,881,590</p>
                                </td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -1.57%</span></td>
                                <td class="no-wrap text-end"><span class="label label-success"><i
                                            class="fa fa-chevron-up"></i> 38.43%</span></td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -21.88%</span></td>
                            </tr>
                            <tr role="row">
                                <td><span><a href="JavaScript: void(0);"><i class="cc RDD"
                                                title="RDD"></i></a></span></td>
                                <td>
                                    <h6><a href="JavaScript: void(0);"> ReddCoin</a></h6>
                                    <small class="text-muted">RDD</small>
                                </td>
                                <td class="text-end">
                                    <p>৳0.01</p>
                                </td>
                                <td class="text-end">
                                    <p>৳422,919,857</p>
                                </td>
                                <td class="text-end">
                                    <p>৳19,938,509</p>
                                </td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -3.80%</span></td>
                                <td class="no-wrap text-end"><span class="label label-success"><i
                                            class="fa fa-chevron-up"></i> 71.26%</span></td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -24.36%</span></td>
                            </tr>
                            <tr role="row">
                                <td><span><a href="JavaScript: void(0);"><i class="cc DGD"
                                                title="DGD"></i></a></span></td>
                                <td>
                                    <h6><a href="JavaScript: void(0);"> DigixDAO</a></h6>
                                    <small class="text-muted">DGD</small>
                                </td>
                                <td class="text-end">
                                    <p>৳192.84</p>
                                </td>
                                <td class="text-end">
                                    <p>৳384,080,000</p>
                                </td>
                                <td class="text-end">
                                    <p>৳10,433,210</p>
                                </td>
                                <td class="no-wrap text-end"><span class="label label-success"><i
                                            class="fa fa-chevron-up"></i> 0.35%</span></td>
                                <td class="no-wrap text-end"><span class="label label-success"><i
                                            class="fa fa-chevron-up"></i> 18.65%</span></td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -3.97%</span></td>
                            </tr>
                            <tr role="row">
                                <td><span><a href="JavaScript: void(0);"><i class="cc SYS"
                                                title="SYS"></i></a></span></td>
                                <td>
                                    <h6><a href="JavaScript: void(0);"> Syscoin</a></h6>
                                    <small class="text-muted">SYS</small>
                                </td>
                                <td class="text-end">
                                    <p>৳0.90</p>
                                </td>
                                <td class="text-end">
                                    <p>৳371,045,676</p>
                                </td>
                                <td class="text-end">
                                    <p>৳7,080,720</p>
                                </td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -2.45%</span></td>
                                <td class="no-wrap text-end"><span class="label label-success"><i
                                            class="fa fa-chevron-up"></i> 37.38%</span></td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -10.62%</span></td>
                            </tr>
                            <tr role="row">
                                <td><span><a href="JavaScript: void(0);"><i class="cc MONA"
                                                title="MONA"></i></a></span></td>
                                <td>
                                    <h6><a href="JavaScript: void(0);"> MonaCoin</a></h6>
                                    <small class="text-muted">MONA</small>
                                </td>
                                <td class="text-end">
                                    <p>৳6.55</p>
                                </td>
                                <td class="text-end">
                                    <p>৳370,807,916</p>
                                </td>
                                <td class="text-end">
                                    <p>৳6,624,610</p>
                                </td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -0.55%</span></td>
                                <td class="no-wrap text-end"><span class="label label-success"><i
                                            class="fa fa-chevron-up"></i> 27.55%</span></td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -17.68%</span></td>
                            </tr>
                            <tr role="row">
                                <td><span><a href="JavaScript: void(0);"><i class="cc MAID"
                                                title="MAID"></i></a></span></td>
                                <td>
                                    <h6><a href="JavaScript: void(0);"> MaidSafeCoin</a></h6>
                                    <small class="text-muted">MAID</small>
                                </td>
                                <td class="text-end">
                                    <p>৳0.78</p>
                                </td>
                                <td class="text-end">
                                    <p>৳342,023,814</p>
                                </td>
                                <td class="text-end">
                                    <p>৳6,091,280</p>
                                </td>
                                <td class="no-wrap text-end"><span class="label label-success"><i
                                            class="fa fa-chevron-up"></i> 0.19%</span></td>
                                <td class="no-wrap text-end"><span class="label label-success"><i
                                            class="fa fa-chevron-up"></i> 26.45%</span></td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -21.45%</span></td>
                            </tr>
                            <tr role="row">
                                <td><span><a href="JavaScript: void(0);"><i class="cc NXT"
                                                title="NXT"></i></a></span></td>
                                <td>
                                    <h6><a href="JavaScript: void(0);"> Nxt</a></h6>
                                    <small class="text-muted">NXT</small>
                                </td>
                                <td class="text-end">
                                    <p>৳0.39</p>
                                </td>
                                <td class="text-end">
                                    <p>৳335,555,059</p>
                                </td>
                                <td class="text-end">
                                    <p>৳27,496,200</p>
                                </td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -3.09%</span></td>
                                <td class="no-wrap text-end"><span class="label label-success"><i
                                            class="fa fa-chevron-up"></i> 39.01%</span></td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -19.76%</span></td>
                            </tr>
                            <tr role="row">
                                <td><span><a href="JavaScript: void(0);"><i class="cc XZC"
                                                title="XZC"></i></a></span></td>
                                <td>
                                    <h6><a href="JavaScript: void(0);"> ZCoin</a></h6>
                                    <small class="text-muted">XZC</small>
                                </td>
                                <td class="text-end">
                                    <p>৳80.18</p>
                                </td>
                                <td class="text-end">
                                    <p>৳312,358,936</p>
                                </td>
                                <td class="text-end">
                                    <p>৳6,750,890</p>
                                </td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -1.85%</span></td>
                                <td class="no-wrap text-end"><span class="label label-success"><i
                                            class="fa fa-chevron-up"></i> 27.83%</span></td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -19.29%</span></td>
                            </tr>
                            <tr role="row">
                                <td><span><a href="JavaScript: void(0);"><i class="cc GAME"
                                                title="GAME"></i></a></span></td>
                                <td>
                                    <h6><a href="JavaScript: void(0);"> GameCredits</a></h6>
                                    <small class="text-muted">GAME</small>
                                </td>
                                <td class="text-end">
                                    <p>৳4.85</p>
                                </td>
                                <td class="text-end">
                                    <p>৳311,079,970</p>
                                </td>
                                <td class="text-end">
                                    <p>৳7,081,850</p>
                                </td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -2.95%</span></td>
                                <td class="no-wrap text-end"><span class="label label-success"><i
                                            class="fa fa-chevron-up"></i> 34.50%</span></td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -18.26%</span></td>
                            </tr>
                            <tr role="row">
                                <td><span><a href="JavaScript: void(0);"><i class="cc PART"
                                                title="PART"></i></a></span></td>
                                <td>
                                    <h6><a href="JavaScript: void(0);"> Particl</a></h6>
                                    <small class="text-muted">PART</small>
                                </td>
                                <td class="text-end">
                                    <p>৳33.87</p>
                                </td>
                                <td class="text-end">
                                    <p>৳299,083,213</p>
                                </td>
                                <td class="text-end">
                                    <p>৳972,587</p>
                                </td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -1.60%</span></td>
                                <td class="no-wrap text-end"><span class="label label-success"><i
                                            class="fa fa-chevron-up"></i> 32.63%</span></td>
                                <td class="no-wrap text-end"><span class="label label-success"><i
                                            class="fa fa-chevron-up"></i> 32.65%</span></td>
                            </tr>
                            <tr role="row">
                                <td><span><a href="JavaScript: void(0);"><i class="cc GNO"
                                                title="GNO"></i></a></span></td>
                                <td>
                                    <h6><a href="JavaScript: void(0);"> Gnosis</a></h6>
                                    <small class="text-muted">GNO</small>
                                </td>
                                <td class="text-end">
                                    <p>৳254.19</p>
                                </td>
                                <td class="text-end">
                                    <p>৳280,753,464</p>
                                </td>
                                <td class="text-end">
                                    <p>৳4,359,680</p>
                                </td>
                                <td class="no-wrap text-end"><span class="label label-success"><i
                                            class="fa fa-chevron-up"></i> 0.98%</span></td>
                                <td class="no-wrap text-end"><span class="label label-success"><i
                                            class="fa fa-chevron-up"></i> 53.10%</span></td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -26.90%</span></td>
                            </tr>
                            <tr role="row">
                                <td><span><a href="JavaScript: void(0);"><i class="cc EMC"
                                                title="EMC"></i></a></span></td>
                                <td>
                                    <h6><a href="JavaScript: void(0);"> Emercoin</a></h6>
                                    <small class="text-muted">EMC</small>
                                </td>
                                <td class="text-end">
                                    <p>৳6.22</p>
                                </td>
                                <td class="text-end">
                                    <p>৳269,738,319</p>
                                </td>
                                <td class="text-end">
                                    <p>৳4,283,630</p>
                                </td>
                                <td class="no-wrap text-end"><span class="label label-danger"><i
                                            class="fa fa-chevron-down"></i> -2.08%</span></td>
                                <td class="no-wrap text-end"><span class="label label-success"><i
                                            class="fa fa-chevron-up"></i> 30.50%</span></td>
                                <td class="no-wrap text-end"><span class="label label-success"><i
                                            class="fa fa-chevron-up"></i> 2.45%</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- To do chat and message -->
<!-- ============================================================== -->
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex no-block align-items-center">
                    <div>
                        <h5 class="card-title m-b-0">Market News</h5>
                    </div>
                    <div class="ms-auto">
                        <button class="pull-right btn btn-circle btn-success text-white" data-bs-toggle="modal" data-bs-target="#myModal"><i class="ti-plus"></i></button>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- To do list widgets -->
                <!-- ============================================================== -->
                <div class="to-do-widget scrollable m-t-20" id="todo" style="height: 400px;position: relative;">
                    <!-- .modal for add task -->
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Add Task</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" class="btn-close"aria-label="Close"> <span aria-hidden="true"></span> </button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="form-group">
                                            <label class="form-label">Task name</label>
                                            <input type="text" class="form-control" placeholder="Enter Task Name"> </div>
                                        <div class="form-group">
                                            <label class="form-label">Assign to</label>
                                            <select class="form-select form-control pull-right">
                                                <option selected="">Sachin</option>
                                                <option value="1">Sehwag</option>
                                                <option value="2">Pritam</option>
                                                <option value="3">Alia</option>
                                                <option value="4">Varun</option>
                                            </select>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-success text-white" data-bs-dismiss="modal">Submit</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
                    <ul class="list-task todo-list list-group m-b-0" data-role="tasklist">
                        <li class="list-group-item" data-role="task">
                            <div class="form-check d-flex align-items-start">
                                <input type="checkbox" class="form-check-input flex-shrink-0" id="customCheck">
                                <label class="form-check-label w-100 ms-2 d-md-flex align-items-start font-normal lh-25" for="customCheck">
                                    <span>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been</span> <span class="badge rounded-pill bg-danger ms-auto mb-2 mb-md-0">Today</span>
                                </label>
                            </div>
                            <ul class="assignedto mt-2">
                                <li><img src="../assets/images/users/1.jpg" alt="user" data-bs-toggle="tooltip" data-placement="top" title="" data-original-title="Steave"></li>
                                <li><img src="../assets/images/users/2.jpg" alt="user" data-bs-toggle="tooltip" data-placement="top" title="" data-original-title="Jessica"></li>
                                <li><img src="../assets/images/users/3.jpg" alt="user" data-bs-toggle="tooltip" data-placement="top" title="" data-original-title="Priyanka"></li>
                                <li><img src="../assets/images/users/4.jpg" alt="user" data-bs-toggle="tooltip" data-placement="top" title="" data-original-title="Selina"></li>
                            </ul>
                        </li>
                        <li class="list-group-item" data-role="task">
                            <div class="form-check d-flex align-items-start">
                                <input type="checkbox" class="form-check-input flex-shrink-0" id="customCheck1">
                                <label class="form-check-label w-100 ms-2 d-md-flex align-items-start font-normal lh-25"  for="customCheck1">
                                    <span>Lorem Ipsum is simply dummy text of the printing</span><span class="badge rounded-pill bg-primary ms-auto mb-2 mb-md-0">1 week </span>
                                </label>
                            </div>
                            <div class="item-date"> 26 jun 2017</div>
                        </li>
                        <li class="list-group-item" data-role="task">
                            <div class="form-check d-flex align-items-start">
                                <input type="checkbox" class="form-check-input flex-shrink-0" id="customCheck2">
                                <label class="form-check-label w-100 ms-2 d-md-flex align-items-start font-normal lh-25" for="customCheck2">
                                    <span>Give Purchase report to</span> <span class="badge rounded-pill bg-info ms-auto mb-2 mb-md-0">Yesterday</span>
                                </label>
                            </div>
                            <ul class="assignedto">
                                <li><img src="../assets/images/users/3.jpg" alt="user" data-bs-toggle="tooltip" data-placement="top" title="" data-original-title="Priyanka"></li>
                                <li><img src="../assets/images/users/4.jpg" alt="user" data-bs-toggle="tooltip" data-placement="top" title="" data-original-title="Selina"></li>
                            </ul>
                        </li>
                        <li class="list-group-item" data-role="task">
                            <div class="form-check d-flex align-items-start">
                                <input type="checkbox" class="form-check-input flex-shrink-0" id="customCheck1">
                                <label class="form-check-label w-100 ms-2 d-md-flex align-items-start font-normal lh-25"  for="customCheck1">
                                    <span>Lorem Ipsum is simply dummy text of the printing</span><span class="badge rounded-pill bg-warning ms-auto mb-2 mb-md-0">2 week </span>
                                </label>
                            </div>
                            <div class="item-date"> 26 jun 2017</div>
                        </li>
                        <li class="list-group-item" data-role="task">
                            <div class="form-check d-flex align-items-start">
                                <input type="checkbox" class="form-check-input flex-shrink-0" id="customCheck2">
                                <label class="form-check-label w-100 ms-2 d-md-flex align-items-start font-normal lh-25" for="customCheck2">
                                    <span>Give Purchase report to</span> <span class="badge rounded-pill bg-info ms-auto mb-2 mb-md-0">Yesterday</span>
                                </label>
                            </div>
                            <ul class="assignedto">
                                <li><img src="../assets/images/users/3.jpg" alt="user" data-bs-toggle="tooltip" data-placement="top" title="" data-original-title="Priyanka"></li>
                                <li><img src="../assets/images/users/4.jpg" alt="user" data-bs-toggle="tooltip" data-placement="top" title="" data-original-title="Selina"></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Messages (5 New)</h5>
                <div class="message-box" id="task2" style="height: 430px;position: relative;">
                    <div class="message-widget message-scroll">
                        <!-- Message -->
                        <a href="javascript:void(0)">
                            <div class="user-img"> <img src="../assets/images/users/1.jpg" alt="user"
                                    class="img-circle"> <span
                                    class="profile-status online pull-right"></span> </div>
                            <div class="mail-contnet">
                                <h5>Pavan kumar</h5> <span class="mail-desc">Lorem Ipsum is simply dummy
                                    text of the printing and type setting industry. Lorem Ipsum has
                                    been.</span> <span class="time">9:30 AM</span>
                            </div>
                        </a>
                        <!-- Message -->
                        <a href="javascript:void(0)">
                            <div class="user-img"> <img src="../assets/images/users/2.jpg" alt="user"
                                    class="img-circle"> <span
                                    class="profile-status busy pull-right"></span> </div>
                            <div class="mail-contnet">
                                <h5>Sonu Nigam</h5> <span class="mail-desc">I've sung a song! See you
                                    at</span> <span class="time">9:10 AM</span>
                            </div>
                        </a>
                        <!-- Message -->
                        <a href="javascript:void(0)">
                            <div class="user-img"> <span class="round">A</span> <span
                                    class="profile-status away pull-right"></span> </div>
                            <div class="mail-contnet">
                                <h5>Arijit Sinh</h5> <span class="mail-desc">Simply dummy text of the
                                    printing and typesetting industry.</span> <span class="time">9:08
                                    AM</span>
                            </div>
                        </a>
                        <!-- Message -->
                        <a href="javascript:void(0)">
                            <div class="user-img"> <img src="../assets/images/users/4.jpg" alt="user"
                                    class="img-circle"> <span
                                    class="profile-status offline pull-right"></span> </div>
                            <div class="mail-contnet">
                                <h5>Pavan kumar</h5> <span class="mail-desc">Just see the my
                                    admin!</span> <span class="time">9:02 AM</span>
                            </div>
                        </a>
                        <!-- Message -->
                        <a href="javascript:void(0)">
                            <div class="user-img"> <img src="../assets/images/users/1.jpg" alt="user"
                                    class="img-circle"> <span
                                    class="profile-status online pull-right"></span> </div>
                            <div class="mail-contnet">
                                <h5>Pavan kumar</h5> <span class="mail-desc">Welcome to the Elite
                                    Admin</span> <span class="time">9:30 AM</span>
                            </div>
                        </a>
                        <!-- Message -->
                        <a href="javascript:void(0)">
                            <div class="user-img"> <img src="../assets/images/users/2.jpg" alt="user"
                                    class="img-circle"> <span
                                    class="profile-status busy pull-right"></span> </div>
                            <div class="mail-contnet">
                                <h5>Sonu Nigam</h5> <span class="mail-desc">I've sung a song! See you
                                    at</span> <span class="time">9:10 AM</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Chat</h5>
                <div class="chat-box" id="task3" style="height: 327px;position: relative;">
                    <!--chat Row -->
                    <ul class="chat-list">
                        <!--chat Row -->
                        <li>
                            <div class="chat-img"><img src="../assets/images/users/1.jpg" alt="user">
                            </div>
                            <div class="chat-content">
                                <h5>James Anderson</h5>
                                <div class="box bg-light-info">Lorem Ipsum is simply dummy text of the
                                    printing &amp; type setting industry.</div>
                            </div>
                            <div class="chat-time">10:56 am</div>
                        </li>
                        <!--chat Row -->
                        <li>
                            <div class="chat-img"><img src="../assets/images/users/2.jpg" alt="user">
                            </div>
                            <div class="chat-content">
                                <h5>Bianca Doe</h5>
                                <div class="box bg-light-info">It’s Great opportunity to work.</div>
                            </div>
                            <div class="chat-time">10:57 am</div>
                        </li>
                        <!--chat Row -->
                        <li class="odd">
                            <div class="chat-content">
                                <div class="box bg-light-inverse">I would love to join the team.</div>
                                <br>
                            </div>
                            <div class="chat-time">10:58 am</div>
                        </li>
                        <!--chat Row -->
                        <li>
                            <div class="chat-img"><img src="../assets/images/users/3.jpg" alt="user">
                            </div>
                            <div class="chat-content">
                                <h5>Angelina Rhodes</h5>
                                <div class="box bg-light-info">Well we have good budget for the project
                                </div>
                            </div>
                            <div class="chat-time">11:00 am</div>
                        </li>
                        <!--chat Row -->
                    </ul>
                </div>
            </div>
            <div class="card-body border-top">
                <div class="row">
                    <div class="col-8">
                        <textarea placeholder="Type your message here"
                            class="form-control border-0"></textarea>
                    </div>
                    <div class="col-4 text-end">
                        <button type="button" class="btn btn-info btn-circle btn-lg text-white"><i
                                class="fas fa-paper-plane"></i> </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Page Content -->
@endsection
@push('head')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/node_module_files/datatables.net-bs4/css/dataTables.bootstrap4.css') }}">
<link href="{{ asset('assets/node_module_files/morrisjs/morris.css') }}" rel="stylesheet">
<link href="{{ asset('assets/node_module_files/c3-master/c3.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/dist/css/pages/dashboard1.css') }}" rel="stylesheet">
@endpush

@push('foot')

    <!-- This page plugins -->
    <!-- ============================================================== -->
    <!--morris JavaScript -->
    <script src="assets/node_module_files/raphael/raphael-min.js"></script>
    <script src="assets/node_module_files/morrisjs/morris.min.js"></script>
    <script src="assets/node_module_files/jquery-sparkline/jquery.sparkline.min.js"></script>
    <!-- Popup message jquery -->
    <script src="assets/node_module_files/d3/d3.min.js"></script>
    <script src="assets/node_module_files/c3-master/c3.min.js"></script>
    <!-- Chart JS -->
    <script src="assets/dist/js/dashboard1.js"></script>
    <!-- datatable -->
    <script src="assets/node_module_files/datatables.net/js/jquery.dataTables.min.js"></script>
    <!-- Tickers -->
    <script src="assets/dist/js/jquery.webticker.min.js"></script>
    <script src="assets/dist/js/fastclick.js"></script>
    <script src="assets/dist/js/web-ticker.js"></script>
    <script type="text/javascript">
        $(function () {
            $('#cc-table').DataTable({
                "displayLength": 10
            });
            $("#live").perfectScrollbar();
            $("#task1").perfectScrollbar();
            $("#task2").perfectScrollbar();
            $("#task3").perfectScrollbar();
        });
    </script>



     <!--morris JavaScript -->
     <script src="{{ asset('assets/node_module_files/raphael/raphael-min.js') }}"></script>
     <script src="{{ asset('assets/node_module_files/morrisjs/morris.min.js') }}"></script>
     <script src="{{ asset('assets/node_module_files/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
     <!-- Popup message jquery -->
     <script src="{{ asset('assets/node_module_files/toast-master/js/jquery.toast.js') }}"></script>
     <!-- Chart JS -->
     <script src="{{ asset('assets/dist/js/dashboard1.js') }}"></script>
     <script src="{{ asset('assets/node_module_files/toast-master/js/jquery.toast.js') }}"></script>
     <!-- jQuery peity -->
     <script src="{{ asset('assets/node_module_files/peity/jquery.peity.min.js') }}"></script>
     <script src="{{ asset('assets/node_module_files/peity/jquery.peity.init.js') }}"></script>
@endpush