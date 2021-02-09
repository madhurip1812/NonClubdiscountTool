@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="flex-center position-ref full-height">
                        <div class="content" style="margin-top: 10% !important;">
                            <div class="title m-b-md text-center">
                                <img src="{{asset('/images/fc_logo.jpg')}}" width="50%" >
                            </div>
                            <div class="links text-center">
                                <h1>Club Membership Discounting System</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
