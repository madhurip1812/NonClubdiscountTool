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
   </div>
   @endif
</div>
<div class="col-md-12 " >
   <div class="card">
      <div class="card-header">
         <label class="mt-2 mb-0"><h4>B2B Cashback</h4></label>
      </div>
      <div class="card-body">
         @if (session('status'))
         <div class="alert alert-success" role="alert">
            {{ session('status') }}
         </div>
         @endif
         <div class="row">
            <div class="col-md-12">
               <table class="table table-bordered table-striped">
                  <tr>
                     <th>CashbackRuleName</th>
                     <th>POID</th>
                     <th>UserID</th>
                     <th>CouponDiscount</th>
                     <th>CreatedDate</th>
                  </tr>
                  @forelse ($objB2BCashbackOrderMaster as $key=>$value)
                  <tr>
                     <td>{{$id ?? ''}}</td>
                     <td>{{$value->POID ?? ''}}</td>
                     <td>{{$value->UserID ?? ''}}</td>
                     <td>{{$value->CouponDiscount ?? ''}}</td>
                     <td>{{$value->CreatedDate ? date('d/m/Y',strtotime($value->CreatedDate )): ''}}</td>
                  </tr>
                  @empty
                  <tr><td colspan="5" class="text-danger text-center"><h4> No Record Found</h4></td></tr>
                  @endforelse
               </table>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection