@extends('layouts.theapp')

@section('title')
Downline Tree
@endsection
@section('content')

<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Downlines <small>(unilevels)</small></h3>
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
                    <div class="x_panel">
                            <div class="x_title">
                              <h2><i class="fa fa-align-left"></i> Downline tree view  <small>(unilevels)</small></h2>
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
          
                              <!-- start accordion -->
                              <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                                <div class="panel">
                                  <a class="panel-heading" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <h4 class="panel-title">Level-One Referrals</h4>
                                  </a>
                                  <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                    <div class="panel-body">
                                      <table class="table table-bordered">
                                      <thead>
                                                      <tr>
                                                        <th>#</th>
                                                        <th>First Name</th>
                                                        <th>Last Name</th>
                                                        <th>Username</th>
                                                      </tr>
                                                    </thead>
                                        <?php $reff = [];?>
                                        @foreach ($first_referrals as $indexKey => $first_referral)
                                        <?php $count=1;?>
                                            @if ($first_referral->recruited_by == Auth::user()->id)
                                                <?php $reff[] = $first_referral->id;?>
                                                <tr>
                                                <td>{{$count}}</td>
                                                <td>{{$first_referral->firstname}}</td>
                                                <td>{{$first_referral->lastname}}</td>
                                                <td>{{$first_referral->username}}</td>
                                                </tr>
                                                <?php $count++?>  
                                            @endif
                                        @endforeach 
                                        </tbody>
                                      </table>
                                    </div>
                                  </div>
                                </div>
                                <div class="panel">
                                  <a class="panel-heading collapsed" role="tab" id="headingTwo" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <h4 class="panel-title">Level-Two Referrals</h4>
                                  </a>
                                  <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                            <table class="table table-bordered">
                                            <thead>
                                                      <tr>
                                                        <th>#</th>
                                                        <th>First Name</th>
                                                        <th>Last Name</th>
                                                        <th>Username</th>
                                                      </tr>
                                                    </thead>
                                                    <?php $reff2 = [];?>
                                                    @foreach ($first_referrals as $first_referral)
                                                        @if ($first_referral->recruited_by != Auth::user()->id)
                                                            @foreach($reff as $ref)
                                                            <?php $count=1;?>
                                                                @if ($ref == $first_referral->recruited_by)
                                                                    <?php $reff2[] = $first_referral->id;?>
                                                                    <tr>
                                                                    <td>{{$count}}</td>
                                                                    <td>{{$first_referral->firstname}}</td>
                                                                    <td>{{$first_referral->lastname}}</td>
                                                                    <td>{{$first_referral->username}}</td>
                                                                    </tr>
                                                                    <?php $count++?>
                                                                @endif
                                                            @endforeach
                                                        
                                                        @endif
                                                    @endforeach  
                                                    </tbody>
                                            </table>
                                    </div>
                                  </div>
                                </div>
                                <div class="panel">
                                  <a class="panel-heading collapsed" role="tab" id="headingThree" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <h4 class="panel-title">Level-Three Referrals</h4>
                                  </a>
                                  <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                    <div class="panel-body">
                                            <table class="table table-bordered">
                                                    <thead>
                                                      <tr>
                                                        <th>#</th>
                                                        <th>First Name</th>
                                                        <th>Last Name</th>
                                                        <th>Username</th>
                                                      </tr>
                                                    </thead>
                                                    @foreach ($first_referrals as $first_referral)
                                                    @if ($first_referral->recruited_by != Auth::user()->id)
                                                        @foreach($reff2 as $ref2)
                                                        <?php $count=1;?>
                                                            @if ($ref2 == $first_referral->recruited_by)
                                                            <tr>
                                                                                    <td>{{$count}}</td>
                                                                                    <td>{{$first_referral->firstname}}</td>
                                                                                    <td>{{$first_referral->lastname}}</td>
                                                                                    <td>{{$first_referral->username}}</td>
                                                                                    </tr>
                                                                                    <?php $count++;?>
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
                              <!-- end of accordion -->
          
          
                            </div>
                          </div>
              </div>

            </div>
          </div>
        </div>
        <!-- /page content -->
@endsection