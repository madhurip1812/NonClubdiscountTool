<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Non Club Member Discount') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <script src="{{ asset('js/jquery.min.js')}}"></script>
    <script src="{{ asset('js/fontawesome/944cc5f91a.js')}}"></script>
    <script src="{{ asset('plugins/jquery-validation/dist/jquery.validate.min.js')}}"></script>
    <link href="{{ asset('css/select2.min.css')}}" rel="stylesheet" />
    <script src="{{ asset('js/select2.min.js')}}"></script>
    <!--- datatable --->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.dataTables.min.css')}}"/>
    <script type="text/javascript" src="{{ asset('js/jquery.dataTables.min.js')}}"></script>
    
    <script type="text/javascript" src="{{ asset('js/formValidations.js')}}"></script>
    <script src="{{ asset('js/fitjuniorplan.js') }}" ></script>
<!--- datatable --->
    @yield('header')
</head>
<body>
    @php($user = session('user'))
    <div id="app">
        <div id="overlay" style="display:none;">
                <div class="spinner"></div>
                <br/>
                Loading...
            </div>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <a class="ml-2 navbar-brand" href="#">
                <img src="{{asset('/images/fc_logo.png')}}" width="100%">
            </a>
            <div class="container">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                   <!--  <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="btn btn-primary btn-sm" href="{{url('/nonClubDiscDiffConditions')}}">Non Club Discount</a>
                        </li>
                        <li class="nav-item ml-3">
                            <a class="btn btn-primary btn-sm" href="{{url('/prodNonClubDiscDiff')}}">Product Non Club Discount</a>
                        </li>
                        <li class="nav-item ml-3">
                            <a class="btn btn-primary btn-sm" href="{{url('/nonClubDiscDiffConditionsLog')}}">Discount Log</a>
                        </li>
                        <li class="nav-item ml-3">
                            <a class="btn btn-primary btn-sm" href="{{url('/prodNonClubDiscDiffLog')}}">Product Discount Log</a>
                        </li>
                        <li class="nav-item ml-3">
                            <a class="btn btn-primary btn-sm" href="{{url('/cronLog')}}">Cron Log</a>
                        </li>
                        <li class="nav-item ml-3">
                            <a class="btn btn-primary btn-sm" href="{{url('/addcashback')}}">Add Cashback</a>
                        </li>
                        <li class="nav-item ml-3">
                            <a class="btn btn-primary btn-sm" href="{{url('/PreCartOffer')}}">Pre Cart Offer</a>
                        </li>
                        <li class="nav-item ml-3">
                            <a class="btn btn-sm btn-danger" href="{{url('logout')}}">Logout</a>
                        </li>
                    </ul> -->
                    <div class="btn-group ">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Club/Non Club Discount
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{url('/nonClubDiscDiffConditions')}}">Non Club Discount Difference</a>
                            <a class="dropdown-item" href="{{url('/prodNonClubDiscDiff')}}">Product Non Club Discount Difference</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{url('/nonClubDiscDiffConditionsLog')}}">Discount Difference Log</a>
                            <a class="dropdown-item" href="{{url('/prodNonClubDiscDiffLog')}}">Product Discount Log</a>
                            <a class="dropdown-item" href="{{url('/cronLog')}}">Cron Log</a>
                        </div>
                    </div>
                    <div class="btn-group ml-3">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Offer
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{url('/listcashback')}}">Search Cashback</a>
                            <a class="dropdown-item" href="{{url('/addcashback')}}">Add Cashback</a>
                            <a class="dropdown-item" href="{{url('/PreCartOffer')}}">Pre Cart Offer</a>
                            <a class="dropdown-item" href="{{url('/couponpurchaserdetail')}}">Coupon Purchaser Detail</a>
                        </div>
                    </div>
                </div>
                @if (Session::has('user'))
                    <a class="btn btn-danger" href="{{url('logout')}}">Logout</a>
                @endif                
            </div>
        </nav>
        <main class="py-4">
            @yield('content')
        </main>
        @yield('footer')
    </div>
</body>
</html>
