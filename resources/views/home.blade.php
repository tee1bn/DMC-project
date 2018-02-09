@extends('layouts.app')

@section('content')
<div class="container">

    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
    <div class="row">
        @if (isset($wallet))
        <div class="col-md-4">
            <div class="panel panel-default">
                    <div class="panel-heading">Earnings</div>

                    
                    <div class="panel-body">
                        <p>Available Balance:  ₦{{$wallet->available_balance}}</p>
                        <p>Balance:  ₦{{$wallet->balance}}</p>
                        <a class="btn btn-success btn-lg btn-block" href="" value="Pay Now!">
                                <i class="fa fa-plus-circle fa-lg"></i>  Withdraw Funds
                        </a>
                    </div>
               
            </div>
            @endif
        </div>
        <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Referral Histories for {{Auth::user()->username}}</div>

                    
                    <div class="panel-body">
                        <table class="">
                            <thead>
                                <th >S/N</th>
                                <th >Name</th>
                                <th >Username</th>
                                <th >Date</th>
                            </thead>
                            <tbody>
                                @foreach ($first_referrals as $indexKey => $first_referral)
                                    <tr>
                                    <td style="width:100px">{{$indexKey + 1}}</td>
                                    <td style="width:200px">{{$first_referral->firstname}} {{$first_referral->lastname}}</td>
                                    <td style="width:100px">{{$first_referral->username}}</td>
                                    <td style="width:150px">{{date('d F, Y', strtotime($first_referral->created_at))}}</td>
                                    </tr>
                                @endforeach 
                            </tbody>
                        </table>
                    </div>
                </div>
            
        </div>
    </div>
    <div class="row">

</div>
    <div class="row">
    <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">Pro Package Monthly Due</div>

                    <form method="POST" action="{{ route('pay') }}" accept-charset="UTF-8" class="form-horizontal" role="form">
                        <div class="ro" styl="margin-bottom:40px;">
                        <div class=""style="padding:15px !important">
                            <p>
                                <div>
                                    PRO Due
                                    ₦ 10, 000
                                </div>
                            </p>
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
                            <button class="btn btn-success btn-lg btn-block" type="submit" value="Pay Now!">
                            <i class="fa fa-plus-circle fa-lg"></i>  PRO Dues ₦ 10,000 (Online)
                            </button>
                            </p>
                        </div>
                        </div>
                    </form>
                    <form style="padding:15px" method="POST" action="{{ route('manual.payment') }}" accept-charset="UTF-8" class="form-horizontal" role="form">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="type" value="pro_sub">
                            <input type="hidden" name="amount" value="10000">
                            <button class="btn btn-success btn-lg btn-block" type="submit" value="Pay Now!">
                            <i class="fa fa-plus-circle fa-lg"></i> Subscribe To PRO ₦ 10,000 (Offline)
                            </button>
                    </form>
                </div>
        </div>
        <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">Subscriptions (Upgrade Plans)</div>

                    <form method="POST" action="{{ route('pay') }}" accept-charset="UTF-8" class="form-horizontal" role="form">
                        <div class="ro" styl="margin-bottom:40px;">
                        <div class=""style="padding:15px !important">
                            <p>
                                <div>
                                Upgrade to PRO
                                    ₦ 40, 000
                                </div>
                            </p>
                            <input type="hidden" name="email" value="{{Auth::user()->email}}"> {{-- required --}}
                            <input type="hidden" name="orderID" value="345">
                            <input type="hidden" name="amount" value="4000000"> {{-- required in kobo --}}
                            <input type="hidden" name="quantity" value="1">
                            <input type="hidden" name="metadata" value="{{ json_encode($array = ['name' => Auth::user()->firstname , 'id'=>Auth::user()->id,]) }}" > {{-- For other necessary things you want to add to your payload. it is optional though --}}
                            <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> {{-- required --}}
                            <input type="hidden" name="key" value="{{ config('paystack.secretKey') }}"> {{-- required --}}
                            {{ csrf_field() }} {{-- works only when using laravel 5.1, 5.2 --}}

                            <input type="hidden" name="_token" value="{{ csrf_token() }}"> {{-- employ this in place of csrf_field only in laravel 5.0 --}}


                            <p>
                            <button class="btn btn-success btn-lg btn-block" type="submit" value="Pay Now!">
                            <i class="fa fa-plus-circle fa-lg"></i> Upgrade to PRO ₦ 40,000 (Online)
                            </button>
                            </p>
                        </div>
                        </div>
                    </form>
                    <form style="padding:15px" method="POST" action="{{ route('manual.payment') }}" accept-charset="UTF-8" class="form-horizontal" role="form">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="type" value="pro_payment">
                            <input type="hidden" name="amount" value="40000">
                            <button class="btn btn-success btn-lg btn-block" type="submit" value="Pay Now!">
                            <i class="fa fa-plus-circle fa-lg"></i> Upgrade to PRO ₦ 40,000 (Offline)
                            </button>
                    </form>
                </div>
        </div>
        <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">Subscriptions (Upgrade Plans)</div>

                    <form method="POST" action="{{ route('pay') }}" accept-charset="UTF-8" class="form-horizontal" role="form">
                        <div class="ro" styl="margin-bottom:40px;">
                        <div style="padding:15px">
                            <p>
                                <div>
                                Upgrade to Elite #120,000
                                    ₦ 120, 000
                                </div>
                            </p>
                            <input type="hidden" name="email" value="otemuyiwa@gmail.com"> {{-- required --}}
                            <input type="hidden" name="orderID" value="346">
                            <input type="hidden" name="amount" value="12000000"> {{-- required in kobo --}}
                            <input type="hidden" name="quantity" value="1">
                            <input type="hidden" name="metadata" value="{{ json_encode($array = ['key_name' => 'value',]) }}" > {{-- For other necessary things you want to add to your payload. it is optional though --}}
                            <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> {{-- required --}}
                            <input type="hidden" name="key" value="{{ config('paystack.secretKey') }}"> {{-- required --}}
                            {{ csrf_field() }} {{-- works only when using laravel 5.1, 5.2 --}}

                            <input type="hidden" name="_token" value="{{ csrf_token() }}"> {{-- employ this in place of csrf_field only in laravel 5.0 --}}


                            <p>
                            <button class="btn btn-success btn-lg btn-block" type="submit" value="Pay Now!">
                            <i class="fa fa-plus-circle fa-lg"></i> Upgrade to Elite ₦ 120,000 (Online)
                            </button>
                            </p>
                        </div>
                        </div>
                    </form>
                    <form style="padding:15px" method="POST" action="{{ route('manual.payment') }}" accept-charset="UTF-8" class="form-horizontal" role="form">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="type" value="elite_payment">
                            <input type="hidden" name="amount" value="120000">
                            <button class="btn btn-success btn-lg btn-block" type="submit" value="Pay Now!">
                            <i class="fa fa-plus-circle fa-lg"></i> Upgrade to Elite ₦ 120,000 (Offline)
                            </button>
                    </form>
                </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Ranks & Reward</div>

                    
                    <div class="panel-body">
                        <table class="">
                            <thead>
                                <th style="width:100px" colspan="1">Rank</th>
                                <th colspan="2">Requirement</th>
                                <th colspan="2">Bonus Item</th>
                                <th colspan="2">Cash Reward</th>
                            </thead>
                            <tbody>
                                @foreach ($ranks as $rank)
                                <tr>
                                    <td style="width:150px" colspan="1">{{$rank->rank_name}}</td>
                                    <td style="width:300px;padding:15px" colspan="2">{{$rank->requirements}}</td>
                                    <td style="width:150px;padding:15" colspan="2">{{$rank->bonus_item}}</td>
                                    <td  style="width:100px" colspan="2">₦{{$rank->cash_reward}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Transactions Table</div>

                    
                    <div class="panel-body">
                        <table class="">
                            <thead>
                                <th style="width:100px" colspan="1">S/N</th>
                                <th colspan="2">Type</th>
                                <th colspan="2">Form</th>
                                <th colspan="2">Lock</th>
                                <th colspan="2">Status</th>
                                <th colspan="2">Referral</th>
                                <th colspan="2">Amount</th>
                                <th colspan="2">Date</th>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $indexKey => $transaction)
                                <tr>
                                    <td style="width:150px" colspan="1">{{$indexKey + 1}}</td>
                                    <td style="width:150px;padding:15px" colspan="2">{{$transaction->type}}</td>
                                    <td style="width:150px;padding:15" colspan="2">{{$transaction->form}}</td>
                                    <td  style="width:100px" colspan="2">
                                        @if ($transaction->lock == '0')
                                            <strong class="text-success">No</strong>
                                        @else
                                        <strong class="text-danger">Yes</strong>
                                        @endif
                                    </td>
                                    <td  style="width:100px" colspan="2">{{$transaction->status}}</td>
                                    <td  style="width:100px" colspan="2">
                                        @if ($transaction->form != 'bonus')
                                        {{$transaction->getReferralUsername()}}
                                        @else
                                         N/A
                                        @endif
                                    </td>
                                    <td  style="width:100px" colspan="2">₦{{$transaction->amount}}</td>
                                    
                                    <td  style="width:150px" colspan="2">{{date('d F, Y', strtotime($transaction->created_at))}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3"> 


        <div class="panel-default">
            <div class="panel-heading"><h3>Level-1 Referrals <!--<small>20 Users</small>--></h3></div>
            <div class="panel-body">
        
                <table id="example" class="table table-stripped display" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Username</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $reff = [];?>
                    @foreach ($first_referrals as $indexKey => $first_referral)
                        @if ($first_referral->recruited_by == Auth::user()->id)
                            <?php $reff[] = $first_referral->id;?>
                            <tr>
                            <td>{{$indexKey + 1}}</td>
                            <td>{{$first_referral->username}}</td>
                            </tr>
                        @endif
                    @endforeach 
                                                    
                    </tbody>
                </table>
            </div>
        </div>


        <div class="panel-default">
            <div class="panel-heading"><h3>Level-2 Referrals <!--<small>20 Users</small>--></h3></div>
            <div class="panel-body">
                        
                <table id="example" class="table table-stripped display" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Username</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $reff2 = [];?>
                    @foreach ($first_referrals as $first_referral)
                        @if ($first_referral->recruited_by != Auth::user()->id)
                            @foreach($reff as $ref)
                                @if ($ref == $first_referral->recruited_by)
                                    <?php $reff2[] = $first_referral->id;?>
                                    <tr>
                                    <td>{{$indexKey + 1}}</td>
                                    <td>{{$first_referral->username}}</td>
                                    </tr>
                                @endif
                            @endforeach
                        
                        @endif
                    @endforeach  
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
                                                                
                    </tbody>
                </table>
            </div>
        </div>
        <div class="panel-default">
            <div class="panel-heading"><h3>Level-3 Referrals <!--<small>20 Users</small>--></h3></div>
            <div class="panel-body">
                
                <table id="example" class="table table-stripped display" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Username</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($first_referrals as $first_referral)
                    @if ($first_referral->recruited_by != Auth::user()->id)
                        @foreach($reff2 as $ref2)
                            @if ($ref2 == $first_referral->recruited_by)
                            <tr>
                                                    <td>{{$indexKey + 1}}</td>
                                                    <td>{{$first_referral->username}}</td>
                                                    </tr>
                            @endif
                        @endforeach
                    
                    @endif
                @endforeach
                                        
                                                        
                        </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
