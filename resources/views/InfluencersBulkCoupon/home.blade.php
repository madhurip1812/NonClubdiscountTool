@extends('layouts.FitLayoutapp')
@section('header')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
@endsection
@section('content')
 
    <div class="col-md-12 " >
            <div class="card">
                <div class="card-header">
                    <label class="mt-2 mb-0"><h5><b>Influencers Bulk Coupon Code Update</b></h5></label>
                    <div class="float-right"> 
                        <a class="btn btn-dark" type="button" href="{{asset('storage/SampleFiles/InfluencersBulkCouponUpload.csv')}}" download="InfluencersBulkCouponUpload.csv"> 
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
                                            <button type="submit" name="btnSaveAll" id="btnSaveAll" class="btn btn-success">Upload Coupons</button>
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