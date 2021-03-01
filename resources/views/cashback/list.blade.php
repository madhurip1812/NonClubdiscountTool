@extends('layouts.app')
@section('content')
@php($user = session('user'))
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
      <label class="mt-2 mb-0"><h4>List Cashabck</h4></label>
    </div>
    <div class="card-body">
      @if (session('status'))
      <div class="alert alert-success" role="alert">
        {{ session('status') }}
      </div>
      @endif
      <form name="listcashback" id="listcashback" action="{{route('listcashback')}}" method="POST">
        @csrf
        <div class="row">
          <div class="col-md-3">
            <span>ID</span>
            <input type="text" name="id" id="id" value="@if(!empty($requestData) && !empty($requestData['id'])){{$requestData['id']}}@endif" class="form-control" placeholder="Enter comma separated ids" />
          </div>
          <div class="col-md-3">
            <span>On Coupon</span>
            <input type="text" name="oncoupon" id="oncoupon" value="@if(!empty($requestData) && !empty($requestData['oncoupon'])){{$requestData['oncoupon']}}@endif" class="form-control" placeholder="Enter Coupon Code" />
          </div>
          <div class="col-md-3">
            <span>Start Date</span>
            <input type="date" name="startdate" id="startdate" value="@if(!empty($requestData) && !empty($requestData['startdate'])){{$requestData['startdate']}}@endif" class="form-control" placeholder="Enter Start Date" />
          </div>
          <div class="col-md-3">
            <span>End Date</span>
            <input type="date" name="enddate" id="enddate" value="@if(!empty($requestData) && !empty($requestData['enddate'])){{$requestData['enddate']}}@endif" class="form-control" placeholder="Enter End Date" />
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <span>Created from Date</span>
            <input type="date" name="createdfromdate" id="createdfromdate" value="@if(!empty($requestData) && !empty($requestData['createdfromdate'])){{$requestData['createdfromdate']}}@endif" class="form-control" placeholder="Enter Created from Date" />
          </div>
          <div class="col-md-3">
            <span>Created to Date</span>
            <input type="date" name="createdtodate" id="createdtodate" value="@if(!empty($requestData) && !empty($requestData['createdtodate'])){{$requestData['createdtodate']}}@endif" class="form-control" placeholder="Enter Created to Date" />
          </div>
          <div class="col-md-2">
            <input type="submit" value="Show" class="btn btn-primary btn-lg" style="margin: 11px 0 0 0;" />
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            @if(!empty($response) && count($response) > 0)
            {{$response->appends($requestData)->links('vendor.pagination.bootstrap-4')}}
            <table class="table table-bordered table-striped">
              <tr>
                <th>ID</th><th>Coupon</th><th>StartDate</th><th>EndDate</th><th>ValidityDays</th><th>Percentage</th><th>MaxAmount</th><th>EmailTemplateID</th><th>CreatedDate</th><th>CreatedBy</th><th>Action</th>
              </tr> 
              @foreach($response as $res)
              <tr>
                <td>@if(!empty($res->CashBackCouponID)){{$res->CashBackCouponID}}@endif</td>
                <td>@if(!empty($res->CashBackCoupon)){{$res->CashBackCoupon}}@endif</td>
                <td>@if(!empty($res->CashBackStartDate)){{$res->CashBackStartDate}}@endif</td>
                <td>@if(!empty($res->CashBackEndDate)){{$res->CashBackEndDate}}@endif</td>
                <td>@if(!empty($res->CouponValidityDays)){{$res->CouponValidityDays}}@endif</td>
                <td>@if(!empty($res->CashBackPercentage)){{$res->CashBackPercentage}}@endif</td>
                <td>@if(!empty($res->CashBackMaxAmount)){{$res->CashBackMaxAmount}}@endif</td>
                <td>@if(!empty($res->EmailTemplateID)){{$res->EmailTemplateID}}@endif</td>
                <td>@if(!empty($res->CreatedDate)){{$res->CreatedDate}}@endif</td>
                <td>@if(!empty($res->CreatedBy)){{$res->CreatedBy}}@endif</td>
                <th>@if(!empty($res->CashBackCouponID))<a href="{{route('addcashback')}}/{{base64_encode($res->CashBackCouponID)}}">Edit</a>@endif</th>
              </tr>
              @endforeach
            </table>
            @elseif(!empty($response) && count($response) == 0)
            <p class="text-danger">No Data Available</p>
            @else
            @endif
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection