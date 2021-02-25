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
                   
                    
                
                </div>
            </div>
        </nav>
        <div id="error-success-massage">
                @if (Session::has('success'))
                    <div class="mt-2 row justify-content-center">
                        <div class="col-md-8 alert alert-success text-center " id="success-massage">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            {{Session::get('success')}}
                        </div>
                    </div>
                @endif                            
                @if (Session::has('error'))
                    <div class="mt-2 row justify-content-center" id="error-massage">
                        <div class="col-md-8 alert alert-danger text-center " >
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            {{Session::get('error')}}
                        </div>
                    </div>
                @endif
            </div>
        <main class="py-4">
            @yield('content')
        </main>
            @yield('footer')
    </div>
</body>
</html>
