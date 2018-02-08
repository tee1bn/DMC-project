@extends('layouts/admin')



@section('body')

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>User Management</h3>
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
                    <h2>Users</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">



<table class="table table-striped table-bordered" id="datatable">
    <thead>
      <tr>
        <th>S/N</th>
        <th>Message</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>John</td>
        <td>Doe</td>
        <td>
           <div class="btn-group">
    <button type="button" class="btn btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">
        Action <span class="caret"></span></button>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Edit</a></li>
            <li><a href="#">Suspend</a></li>
            <li><a href="#">Delete</a></li>
          </ul>
  </div>
        </td>
      </tr>
    </tbody>
  </table>











                  </div>
                </div>
              </div>
            </div>













          </div>
        </div>
        <!-- /page content -->

        @endsection