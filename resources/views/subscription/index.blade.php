@extends('layouts.theapp')

@section('title')
Referrals
@endsection
@section('content')
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Pricing Tables</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" style="height:600px;">
                  <div class="x_title">
                    <h2>Pricing Tables Design</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">
                    <div class="row">

                      <div class="col-md-12">

                        <!-- price element -->
                        <div class="col-md-4">
                          <div class="pricing ui-ribbon-container">
                            <div class="ui-ribbon-wrapper">
                              <div class="ui-ribbon">
                                30% Off
                              </div>
                            </div>
                            <div class="title">
                              <h2>Pro Package Monthly Due</h2>
                              <h1>₦10,000</h1>
                              <span>Monthly</span>
                            </div>
                            <div class="x_content">
                              <div class="">
                                <div class="pricing_features">
                                  <ul class="list-unstyled text-left">
                                    <li><i class="fa fa-check text-success"></i> 2 years access <strong> to all storage locations</strong></li>
                                    <li><i class="fa fa-check text-success"></i> <strong>Unlimited</strong> storage</li>
                                    <li><i class="fa fa-check text-success"></i> Limited <strong> download quota</strong></li>
                                    <li><i class="fa fa-check text-success"></i> <strong>Cash on Delivery</strong></li>
                                    <li><i class="fa fa-check text-success"></i> All time <strong> updates</strong></li>
                                    <li><i class="fa fa-times text-danger"></i> <strong>Unlimited</strong> access to all files</li>
                                    <li><i class="fa fa-times text-danger"></i> <strong>Allowed</strong> to be exclusing per sale</li>
                                  </ul>
                                </div>
                              </div>
                              <div class="pricing_footer">
                                    <form method="POST" action="{{ route('pay') }}" accept-charset="UTF-8" class="form-horizontal" role="form">
                                        <div class="ro" styl="margin-bottom:40px;">
                                        <div class="" >
                                            <input type="hidden" name="email" value="{{Auth::user()->email}}"> {{-- required --}}
                                            <input type="hidden" name="orderID" value="344">
                                            <input type="hidden" name="amount" value="1000000"> {{-- required in kobo --}}
                                            <input type="hidden" name="quantity" value="1">
                                            <input type="hidden" name="metadata" value="{{ json_encode($array = ['name' => Auth::user()->firstname , 'id'=>Auth::user()->id,]) }}" > {{-- For other necessary things you want to add to your payload. it is optional though --}}
                                            <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> {{-- required --}}
                                            <input type="hidden" name="key" value="{{ config('paystack.secretKey') }}"> {{-- required --}}
                                            {{ csrf_field() }} {{-- works only when using laravel 5.1, 5.2 --}}

                                            <input type="hidden" name="_token" value="{{ csrf_token() }}"> {{-- employ this in place of csrf_field only in laravel 5.0 --}}


                                            <p>
                                            <button type="submit" class="btn btn-success btn-block" role="button">PRO Due ₦ 10,000 (Online Payment)</button>
                                            </p>
                                        </div>
                                        </div>
                                    </form>
                                    <form method="POST" action="{{ route('manual.payment') }}" accept-charset="UTF-8" class="form-horizontal" role="form">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="type" value="pro_sub">
                                            <input type="hidden" name="amount" value="10000">
                                            <button type="submit" class="btn btn-primary btn-block" role="button">PRO Due ₦ 10,000 (Offline Payment)</button>
                                    </form>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- price element -->

                        <!-- price element -->
                        <div class="col-md-4">
                          <div class="pricing">
                            <div class="title">
                              <h2>PRO Upgrade</h2>
                              <h1>₦40,000</h1>
                              <span>Monthly</span>
                            </div>
                            <div class="x_content">
                              <div class="">
                                <div class="pricing_features">
                                  <ul class="list-unstyled text-left">
                                    <li><i class="fa fa-check text-success"></i> 2 years access <strong> to all storage locations</strong></li>
                                    <li><i class="fa fa-check text-success"></i> <strong>Unlimited</strong> storage</li>
                                    <li><i class="fa fa-check text-success"></i> Limited <strong> download quota</strong></li>
                                    <li><i class="fa fa-check text-success"></i> <strong>Cash on Delivery</strong></li>
                                    <li><i class="fa fa-check text-success"></i> All time <strong> updates</strong></li>
                                    <li><i class="fa fa-times text-danger"></i> <strong>Unlimited</strong> access to all files</li>
                                    <li><i class="fa fa-times text-danger"></i> <strong>Allowed</strong> to be exclusing per sale</li>
                                  </ul>
                                </div>
                              </div>
                              <div class="pricing_footer">
                              <form method="POST" action="{{ route('pay') }}" accept-charset="UTF-8" class="form-horizontal" role="form">
                                        <div class="ro" styl="margin-bottom:40px;">
                                        <div class="" >
                                            <input type="hidden" name="email" value="{{Auth::user()->email}}"> {{-- required --}}
                                            <input type="hidden" name="orderID" value="344">
                                            <input type="hidden" name="amount" value="4000000"> {{-- required in kobo --}}
                                            <input type="hidden" name="quantity" value="1">
                                            <input type="hidden" name="metadata" value="{{ json_encode($array = ['name' => Auth::user()->firstname , 'id'=>Auth::user()->id,]) }}" > {{-- For other necessary things you want to add to your payload. it is optional though --}}
                                            <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> {{-- required --}}
                                            <input type="hidden" name="key" value="{{ config('paystack.secretKey') }}"> {{-- required --}}
                                            {{ csrf_field() }} {{-- works only when using laravel 5.1, 5.2 --}}

                                            <input type="hidden" name="_token" value="{{ csrf_token() }}"> {{-- employ this in place of csrf_field only in laravel 5.0 --}}


                                            <p>
                                            <button type="submit" class="btn btn-success btn-block" role="button">PRO Upgrade ₦40,000 (Online Payment)</button>
                                            </p>
                                        </div>
                                        </div>
                                    </form>
                                    <form method="POST" action="{{ route('manual.payment') }}" accept-charset="UTF-8" class="form-horizontal" role="form">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="type" value="pro_payment">
                                            <input type="hidden" name="amount" value="40000">
                                            <button type="submit" class="btn btn-primary btn-block" role="button">PRO Upgrade ₦40,000 (Offline Payment)</button>
                                    </form>
                                  </div>
                            </div>
                          </div>
                        </div>
                        <!-- price element -->

                        <!-- price element -->
                        <div class="col-md-4">
                          <div class="pricing">
                            <div class="title">
                              <h2>ELITE Upgrade</h2>
                              <h1>₦100,000</h1>
                              <span>One-time</span>
                            </div>
                            <div class="x_content">
                              <div class="">
                                <div class="pricing_features">
                                  <ul class="list-unstyled text-left">
                                    <li><i class="fa fa-check text-success"></i> 2 years access <strong> to all storage locations</strong></li>
                                    <li><i class="fa fa-check text-success"></i> <strong>Unlimited</strong> storage</li>
                                    <li><i class="fa fa-check text-success"></i> Limited <strong> download quota</strong></li>
                                    <li><i class="fa fa-check text-success"></i> <strong>Cash on Delivery</strong></li>
                                    <li><i class="fa fa-check text-success"></i> All time <strong> updates</strong></li>
                                    <li><i class="fa fa-check text-success"></i> <strong>Unlimited</strong> access to all files</li>
                                    <li><i class="fa fa-check text-success"></i> <strong>Allowed</strong> to be exclusing per sale</li>
                                  </ul>
                                </div>
                              </div>
                              <div class="pricing_footer">
                              <form method="POST" action="{{ route('pay') }}" accept-charset="UTF-8" class="form-horizontal" role="form">
                              <div class="ro" styl="margin-bottom:40px;">
                              <div class="" >
                                  <input type="hidden" name="email" value="{{Auth::user()->email}}"> {{-- required --}}
                                  <input type="hidden" name="orderID" value="344">
                                  <input type="hidden" name="amount" value="10000000"> {{-- required in kobo --}}
                                  <input type="hidden" name="quantity" value="1">
                                  <input type="hidden" name="metadata" value="{{ json_encode($array = ['name' => Auth::user()->firstname , 'id'=>Auth::user()->id,]) }}" > {{-- For other necessary things you want to add to your payload. it is optional though --}}
                                  <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> {{-- required --}}
                                  <input type="hidden" name="key" value="{{ config('paystack.secretKey') }}"> {{-- required --}}
                                  {{ csrf_field() }} {{-- works only when using laravel 5.1, 5.2 --}}

                                  <input type="hidden" name="_token" value="{{ csrf_token() }}"> {{-- employ this in place of csrf_field only in laravel 5.0 --}}


                                  <p>
                                  <button type="submit" class="btn btn-success btn-block" role="button">ELITE Upgrade ₦100,000 (Online Payment)</button>
                                  </p>
                              </div>
                              </div>
                          </form>
                          <form method="POST" action="{{ route('manual.payment') }}" accept-charset="UTF-8" class="form-horizontal" role="form">
                                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                  <input type="hidden" name="type" value="elite_payment">
                                  <input type="hidden" name="amount" value="100000">
                                  <button type="submit" class="btn btn-primary btn-block" role="button">ELITE Upgrade ₦100,000 (Offline Payment)</button>
                          </form>
                                  </div>
                            </div>
                          </div>
                        </div>
                        <!-- price element -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endsection