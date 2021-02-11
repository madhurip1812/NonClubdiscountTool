<div id="sidebar-nav" class="sidebar">
    <div class="sidebar-scroll">
        <nav>
            <ul class="nav">
                <li>
                    <a href="#cashbackentity" data-toggle="collapse" class="main-menu @if(in_array(Route::currentRouteName(),config('constants.cashbackRoutes'))) active @else collapsed @endif">
                        <i class="fa fa-cogs" aria-hidden="true"></i>
                        <span>Cashback</span>
                        <i class="fa @if(in_array(Route::currentRouteName(),config('constants.cashbackRoutes'))) fa-chevron-down @else fa-chevron-right @endif pull-right" aria-hidden="true"></i>
                    </a>
                    <div id="cashbackentity" class="collapse @if(in_array(Route::currentRouteName(),config('constants.cashbackRoutes'))) in @endif">
                        <ul class="nav">
                           
                            <li>
                                <a href="{{route('addcashback')}}" class="@if (Route::currentRouteName() == 'addcashback') active @endif">Add</a>
                            </li>
                            <li>
                                <a href="{{route('listcashback')}}" class="@if (Route::currentRouteName() == 'listcashback') active @endif">View</a>
                            </li>
                        </ul>
                    </div>
                </li>
                 <li>
                    <a href="#couponentity" data-toggle="collapse" class="main-menu @if(in_array(Route::currentRouteName(),config('constants.cashbackRoutes'))) active @else collapsed @endif">
                        <i class="fa fa-cogs" aria-hidden="true"></i>
                        <span>Coupon</span>
                        <i class="fa @if(in_array(Route::currentRouteName(),config('constants.cashbackRoutes'))) fa-chevron-down @else fa-chevron-right @endif pull-right" aria-hidden="true"></i>
                    </a>
                    <div id="couponentity" class="collapse @if(in_array(Route::currentRouteName(),config('constants.cashbackRoutes'))) in @endif">
                        <ul class="nav">
                           
                            <li>
                                <a href="{{route('excludeitems')}}" class="@if (Route::currentRouteName() == 'excludeitems') active @endif">Exclude Items</a>
                            </li>
                             <li>
                                <a href="{{route('excludeitemsLog')}}" class="@if (Route::currentRouteName() == 'excludeitemsLog') active @endif">Exclude Items Log</a>
                            </li>
 
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#nonclubdiscountentity" data-toggle="collapse" class="main-menu @if(in_array(Route::currentRouteName(),config('constants.nonclubdiscountRoutes'))) active @else collapsed @endif">
                        <i class="fa fa-cogs" aria-hidden="true"></i>
                        <span>NonClubDiscount</span>
                        <i class="fa @if(in_array(Route::currentRouteName(),config('constants.nonclubdiscountRoutes'))) fa-chevron-down @else fa-chevron-right @endif pull-right" aria-hidden="true"></i>
                    </a>
                    <div id="nonclubdiscountentity" class="collapse @if(in_array(Route::currentRouteName(),config('constants.nonclubdiscountRoutes'))) in @endif">
                        <ul class="nav">
                           
                            <li>
                                <a href="{{route('home')}}" class="@if (Route::currentRouteName() == 'home') active @endif">Edit Rules</a>
                            </li>
                           <!--  <li>
                                <a href="{{route('listcashback')}}" class="@if (Route::currentRouteName() == 'listcashback') active @endif">View</a>
                            </li> -->
                        </ul>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
</div>