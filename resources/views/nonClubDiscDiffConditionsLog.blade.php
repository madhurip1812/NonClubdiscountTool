@extends('layouts.app')
@section('header')

@endsection
@section('content')

    <div class="col-md-12 alert alert-danger @if ($errors->any()) '' @else dont-display @endif" role="alert" id="error-msg-block-common">
        @foreach ($errors->all() as $message)
            <span class="col-md-11" id="error-msg-span-common">
                {{ $message }}
            </span>
        @endforeach
        <a href="#" class=" col-md-1 close" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </a>
    </div>

<div class="col-md-12">
    <div class=" justify-content-center " >
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        <div class="card row">
            <div class="card-header ">
                <h4> Non Club Discount Difference Conditions Log</h4>
            </div>
            <div class="card-body">
                <form id="form-disc-diff-log" action="{{route('getDiffConditionLogData')}}">
                <div class="col-md-12 row">
                    
                    <div class="col-md-4">
                        <label class="col-md-3">Start Date : </label>
                        <input type="text" class="datepicker" name="log_start_date" id="log_start_date" value="{{!empty($startDate)?$startDate:''}}">
                    </div>
                    <div class="col-md-4">
                        <label class="col-md-3">End Date : </label>
                        <input type="text" class="datepicker" name="log_end_date" id="log_end_date" value="{{!empty($endDate)?$endDate:''}}">
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-success btn-md" type="submit"> 
                            Get Data
                        </button>
                    </div>
                    
                </div>
                </form>
                <div class="col-md-12 row" style="margin-top: 10px;">
                    @include('discountDiffLogTable')
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('footer')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="{{ asset('js/NonClubMemberDisc.js') }}" ></script>
<script>
  $(function() {
    $( ".datepicker" ).datepicker();
  });
    
</script>
@endsection
