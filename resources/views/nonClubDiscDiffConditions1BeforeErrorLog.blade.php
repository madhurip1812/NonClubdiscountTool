@extends('layouts.app')
@section('header')

@endsection
@section('content')
<div class="col-md-12">
    <div class=" justify-content-center " >
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        <div class="card row">
            <div class="card-header ">
                <label><h4> Non Club Discount Difference Conditions</h4></label>
                <div class="float-right"> 
                    <a class="btn btn-dark" type="button" href="{{url('editAllDiscountRules')}}"> 
                        Choose Rule to edit
                    </a> 
                </div>
            </div>
            <div class="card-body"> 
        @foreach($categories as $key => $value)
            @if(count($value['catdiscount_rule'])>0)
                <div class="" id="accordion{{$key}}">
                    <div class="card">
                        <div class="custom-card-header collapse-heading-div" id="heading{{$value['productcatid']}}">
                            <label class="font-weight-bold collapse-heading" data-toggle="collapse" data-target="#collapse{{$value['productcatid']}}" aria-expanded="true" aria-controls="collapse{{$value['productcatid']}}">
                                {{$value['categoryname'] ?? ''}}
                            </label>
                        </div>
                        <div id="collapse{{$value['productcatid']}}" class="custom-card-body collapse" aria-labelledby="heading{{$value['productcatid']}}" data-parent="#accordion{{$key}}" >
                            @foreach($value['subcategory'] as $subkey => $subvalue)
                                @if(count($subvalue['subcatdiscount_rule']) >0 )
                                <div id="subaccordion{{$subkey}}" class="border-bottom">
                                    <div class="row">
                                        <div class="col-md-3 collapse-heading-div" id="subheading{{$subvalue['subcatid']}}">
                                            <label class="collapse-heading font-weight-bold" data-toggle="collapse" data-target="#subcollapse{{$subvalue['subcatid']}}" aria-expanded="true" aria-controls="subcollapse{{$subvalue['subcatid']}}" id="{{$subvalue['subcatid']}}">
                                                {{$subvalue['subcategoryname'] ?? ''}}
                                            </label>
                                        </div>
                                        <div id="subcollapse{{$subvalue['subcatid']}}" class="collapse col-md-9" aria-labelledby="subheading{{$subvalue['subcatid']}}" data-parent="#subaccordion{{$subkey}}">
                                            <div class="alert alert-danger dont-display" role="alert" id="error-msg-block{{$subvalue['subcatid']}}">
                                                <button type="button" class="close" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <span id="error-msg-span{{$subvalue['subcatid']}}"></span>
                                            </div>
                                            <div class="alert alert-success dont-display" role="alert" id="success-msg-block{{$subvalue['subcatid']}}">
                                                <span id="success-msg-span{{$subvalue['subcatid']}}"></span>
                                                <button type="button" class="close" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="table-responsive pt-1" id="typeLevelDiv{{$subvalue['subcatid']}}">
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>                           
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>
    </div>
</div>
@endsection
@section('footer')
<script src="{{ asset('js/NonClubMemberDisc.js') }}" ></script>
@endsection
