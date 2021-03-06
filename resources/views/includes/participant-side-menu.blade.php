   <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>Participant</h3>
                <ul class="nav side-menu">
                  <li><a href="{{route('participant-dashboard')}}"><i class="fa fa-home"></i> Dashboard</a></li>


                  
                 <li><a><i class="fa fa-cog"></i> Account Settings <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{route('participant-profile')}}">Profile</a></li>
                      <li><a href="{{route('participant-change-password')}}">Change Password</a></li>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-money"></i> E-Wallet <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{route('participant-balance')}}">Balance</a></li>
                      <li><a href="{{route('participant-funds-withdrawal')}}">Funds Withdrawal</a></li>
                      <li><a href="{{route('participant-payment-history')}}">Payment History</a></li>
                      <li><a href="{{route('participant-withdrawal-history')}}">Withdrawal History</a></li>
                    </ul>
                  </li>

                    <li><a><i class="fa fa-refresh"></i>Referrals <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                      <li><a href="#">Upline</a></li>
                                      <li><a href="#">Downline</a></li>
                                      <li><a href="#">Referral Commission</a></li>
                                    </ul>
                      </li>

                  <li><a><i class="fa fa-cart-arrow-down"></i>DMC Hub <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                      <li><a href="#">Training Hub</a></li>
                                      <li><a href="#">Business Hub</a></li>
                                      <li><a href="#">Shop Hub</a></li>
                                      <li><a href="#">Accelerator</a></li>
                                      <li><a hrefSuspend="#">Invest-4-Me</a></li>
                                      <li><a href="#">Vault</a></li>
                                      <li><a href="#">Leaderboard</a></li>
                                    </ul>
                      </li>
                  <li><a href="{{route('participant-admin-messages')}}"><i class="fa fa-envelope"></i> Messages</a></li>

                  <li><a href="{{route('participant-security-settings')}}"><i class="fa fa-cog"></i> Security Settings</a></li>

                 
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->
            <?php






      Route::get('/profile', function () {
          return view('auth/participant/profile');
      })->name('participant-profile');



      Route::get('/change-password', function () {
          return view('auth/participant/change-password');
      })->name('participant-change-password');



      Route::get('/balance', function () {
          return view('auth/participant/e-wallet');
      })->name('participant-balance');


      Route::get('/funds-withdrawal', function () {
          return view('auth/participant/funds-withdrawal');
      })->name('participant-funds-withdrawal');

         
Route::get('/payment-history', function () {
          return view('auth/participant/payment-history');
      })->name('participant-payment-history');

         
Route::get('/withdrawal-history', function () {
          return view('auth/participant/withdrawal-history');
      })->name('participant-withdrawal-history');
     
Route::get('/security-settings', function () {
          return view('auth/participant/security-settings');
      })->name('participant-security-settings');

      