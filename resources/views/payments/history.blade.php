@extends('layouts.theapp')

@section('title')
Referrals
@endsection
@section('content')

<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>E-Wallet <small>Ewallet/Earnings/Withdrawal/Payment histories</small></h3>
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
                <div class="col-md-3">
                        <div class="x_panel">
                                <div class="x_title">
                                  <h2>E wallet</h2>
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
                                @if (!empty($wallet))
                                 <p>Available Balance: ₦{{$wallet->available_balance}}</p>
                                 <p>Balance: ₦{{$wallet->balance}}</p>
                                 @else
                                 <p>Available Balance: ₦0.00</p>
                                 <p>Balance: ₦0.00</p>
                                 @endif
                                </div>
                              </div>
                </div>
              <div class="col-md-9">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Payments History<small> transactions</small></h2>
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
                    <p class="text-muted font-13 m-b-30">
                     <!-- DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>-->
                    </p>
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>S/N</th>
                          <th>Type</th>
                          <th>Form</th>
                          <th>Lock</th>
                          <th>Status</th>
                          <th>Referral</th>
                          <th>Amount</th>
                          <th>Date</th>
                        </tr>
                      </thead>


                      <tbody>
                      @foreach ($transactions as $indexKey => $transaction)
                      <tr>
                          <td>{{$indexKey + 1}}</td>
                          <td>{{$transaction->type}}</td>
                          <td>{{$transaction->form}}</td>
                          <td>
                              @if ($transaction->lock == '0')
                                  <strong class="text-success">No</strong>
                              @else
                              <strong class="text-danger">Yes</strong>
                              @endif
                          </td>
                          <td>{{$transaction->status}}</td>
                          <td>
                              @if ($transaction->form != 'bonus')
                              {{$transaction->getReferralUsername()}}
                              @else
                               N/A
                              @endif
                          </td>
                          <td>₦{{$transaction->amount}}</td>
                          
                          <td>{{date('d F, Y', strtotime($transaction->created_at))}}</td>
                      </tr>
                      @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>

        @endsection