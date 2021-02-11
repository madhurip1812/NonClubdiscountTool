@extends('layouts.app')
@section('header')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
@endsection
@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="col-md-12 alert alert-danger" role="alert" id="error-msg-block-common">
                <ul>
                @foreach ($errors->all() as $message)
                    <li>{{ $message }}</li>
                @endforeach
                </ul>
            </div>
        @endif
        @if (Session::has('success'))
            <div class="alert alert-success" role="alert" id="success-msg-block-prod">
                <span id="success-msg-span-prod">{{ Session::get('success') }}</span>
                <!-- <button type="button" class="close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> -->
            </div>
        @endif
    </div>
    <div class="col-md-12 " >
            <div class="card">
                <div class="card-header">
                    <label class="mt-2 mb-0"><h4>Upload CSV</h4></label>
                    <div class="float-right"> 
                        <a class="btn btn-dark" type="button" href="{{asset('storage/SampleFiles/ProductNonClubDiscount.csv')}}" download="ProductNonClubDiscount.csv"> 
                            Download Sample
                        </a> 
                    </div>
                </div>
                <div class="card-body">
                    <div class="">
                        <form method="post" action="{{url('uploadNonClubDiscount')}}" enctype="multipart/form-data">
                            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                            <div class="row pt-1">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="col-md-4 col-form-label-custom text-md-right font-weight-bold" >
                                                {{ __('Choose file') }}
                                            </label>                
                                            <div class="custom-file col-md-7">
                                                <input type="file" class="custom-file-input" id="ProductsFileUpload" name="csv_file">
                                                <label class="custom-file-label" for="fileUpload">Upload file...</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <button type="submit" name="btnSaveAll" id="btnSaveAll" class="btn btn-success">Upload Products</button>
                                        </div>
                                    </div>      
                                </div>     
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
@endsection
@section('footer')
@endsection