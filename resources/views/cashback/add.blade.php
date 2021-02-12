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
</head>
<body>
	<div id="app">
		<div id="overlay" style="display:none;">
			<div class="spinner"></div>
			<br/>
			Loading...
		</div>
		<main class="py-4">
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
        			<label class="mt-2 mb-0"><h4>Add Cashback</h4></label>
        			<div class="float-right"> 
        				<a class="btn btn-dark" type="button" href="http://13.126.132.179:789/">
        					Back
        				</a> 
        			</div>
        		</div>
        		<div class="card-body">
        			@if (session('status'))
        			<div class="alert alert-success" role="alert">
        				{{ session('status') }}
        			</div>
        			@endif
        			<form name="addcashback" id="addcashback" action="{{route('addcashback')}}" method="POST">
        				@csrf
        				<div class="row">
        					<input type="hidden" name="cashcouponid" id="cashcouponid" value="@if(!empty($cashBackData)&&!empty($cashBackData->CashBackCouponID)){{$cashBackData->CashBackCouponID}}@endif" />
        					<div class="col-md-12">
        						<div class="input-group" style="box-shadow: none;">
        							<span>Rule For: <span class="text-danger">*</span> </span> &nbsp;&nbsp;&nbsp;
        							<label for="rulefor2"> <input type="radio" name="rulefor" id="rulefor2" value="intellikit" @if(!empty($cashBackData)&&!empty($cashBackData->CashbackRulefor) && ($cashBackData->CashbackRulefor=='intellikit')){{'checked'}}@elseif(empty($cashBackData)){{'checked'}}@endif> Intellikit</label>&nbsp;&nbsp;&nbsp;
					<label for="rulefor1"> <input type="radio" name="rulefor" id="rulefor1" value="time" @if(!empty($cashBackData)&&!empty($cashBackData->CashbackRulefor) && ($cashBackData->CashbackRulefor=='time')){{'checked'}}@endif> Product/Time</label><!-- &nbsp;&nbsp;&nbsp;
					<label for="rulefor3"> <input type="radio" name="rulefor" id="rulefor3" value="3"> TimeBased</label> -->
				</div>
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-4">
				<span>Rule Name:</span> <span class="text-danger">*</span>
			</div>
			<div class="col-md-4">
				<input type="text" name="rulename" id="rulename" value="@if(!empty($cashBackData)&&!empty($cashBackData->CashBackCoupon)){{$cashBackData->CashBackCoupon}}@endif" class="form-control" />
			</div>
		</div>

		<!-- <div class="row form-group">
			<div class="col-md-4">
				<span>Cashback Coupon:</span> <span class="text-danger">*</span>
			</div>
			<div class="col-md-4">
				<input type="text" name="cashcoupon" id="cashcoupon" value="@if(!empty($cashBackData)&&!empty($cashBackData->CashBackCoupon)){{$cashBackData->CashBackCoupon}}@endif" class="form-control" />
			</div>
		</div> -->

		<div class="row form-group">
			<div class="col-md-4">
				<span>Cashback On Coupon:</span> <span class="text-danger">*</span>
			</div>
			<div class="col-md-4">
				<input type="text" name="cashoncoupon" id="cashoncoupon" value="@if(!empty($cashBackData)&&!empty($cashBackData->CashBackOnCoupon)){{$cashBackData->CashBackOnCoupon}}@endif" class="form-control" />
			</div>
		</div>

		<div class="row form-group">
			<div class="col-md-4">
				<span>Cashback Out Coupon:</span> <span class="text-danger">*</span>
			</div>
			<div class="col-md-4">
				<input type="text" name="cashoutcoupon" id="cashoutcoupon" value="@if(!empty($cashBackData)&&!empty($cashBackData->CashBackOutCoupon)){{$cashBackData->CashBackOutCoupon}}@endif" class="form-control" />
			</div>
		</div>

		<div class="row form-group">
			<div class="col-md-4">
				<span>Cashback Validity Days:</span> <span class="text-danger">*</span>
			</div>
			<div class="col-md-4">
				<input type="number" name="cashvaliddays" id="cashvaliddays" value="@if(!empty($cashBackData)&&!empty($cashBackData->CouponValidityDays)){{$cashBackData->CouponValidityDays}}@endif" class="form-control" />
			</div>
		</div>

		<div class="row form-group">
			<div class="col-md-4">
				<span>Cashback Percentage:</span> <span class="text-danger">*</span>
			</div>
			<div class="col-md-4">
				<input type="text" name="cashperc" id="cashperc" value="@if(!empty($cashBackData)&&!empty($cashBackData->CashBackPercentage)){{$cashBackData->CashBackPercentage}}@endif" class="form-control" />
			</div>
		</div>

		<div class="row form-group">
			<div class="col-md-4">
				<span>Cashback MaxAmount:</span> <span class="text-danger">*</span>
			</div>
			<div class="col-md-4">
				<input type="text" name="cashmaxamnt" id="cashmaxamnt" value="@if(!empty($cashBackData)&&!empty($cashBackData->CashBackMaxAmount)){{$cashBackData->CashBackMaxAmount}}@endif" class="form-control" />
			</div>
		</div>

		<div class="row form-group">
			<div class="col-md-4">
				<span>Cashback Min Purchase:</span> <span class="text-danger">*</span>
			</div>
			<div class="col-md-4">
				<input type="text" name="cashminpurc" id="cashminpurc" value="@if(!empty($cashBackData)&&!empty($cashBackData->CashBackOnMinmumPurchase)){{$cashBackData->CashBackOnMinmumPurchase}}@endif" class="form-control" />
			</div>
		</div>

		<div class="row form-group intellikitsubscbox">
			<div class="col-md-4">
				<span>Intellikit 3 Months Subscription Box No:</span>
			</div>
			<div class="col-md-4">
				<select name="intellikit3monthssubscrboxno" id="intellikit3monthssubscrboxno" class="form-control">
					<option value="">select</option>
					@for($i = 1; $i <= 3; $i++)
					<option value="{{$i}}{{'_3'}}" @if(!empty($subscriptionData) && count($subscriptionData) > 0 && $subscriptionData[0]->subscriptiontype == '3' && $subscriptionData[0]->subscriptionboxno == $i){{'selected'}}@endif>{{$i}}</option>
					@endfor
				</select>
			</div>
			<!-- <div class="col-md-2">
				<label for="intellikit3monthsboxisactive"> <input type="checkbox" name="intellikit3monthsboxisactive" id="intellikit3monthsboxisactive" value="" /> IsActive</label>
			</div> -->
			<input type="hidden" name="intellikit3monthssubscrtype" id="intellikit3monthssubscrtype" value="3">
		</div>

		<div class="row form-group intellikitsubscbox">
			<div class="col-md-4">
				<span>Intellikit 6 Months Subscription Box No:</span>
			</div>
			<div class="col-md-4">
				<select name="intellikit6monthssubscrboxno" id="intellikit6monthssubscrboxno"  class="form-control">
					<option value="">select</option>
					@for($i = 1; $i <= 6; $i++)
					<option value="{{$i}}{{'_6'}}" @if(!empty($subscriptionData) && count($subscriptionData) > 0 && $subscriptionData[0]->subscriptiontype == '6' && $subscriptionData[0]->subscriptionboxno == $i){{'selected'}}@endif>{{$i}}</option>
					@endfor
				</select>
			</div>
			<!-- <div class="col-md-2">
				<label for="intellikit6monthsboxisactive"> <input type="checkbox" name="intellikit6monthsboxisactive" id="intellikit6monthsboxisactive" value="" /> IsActive</label>
			</div> -->
			<input type="hidden" name="intellikit6monthssubscrtype" id="intellikit6monthssubscrtype" value="6">
		</div>

		<div class="row form-group intellikitsubscbox">
			<div class="col-md-4">
				<span>Intellikit 9 Months Subscription Box No:</span>
			</div>
			<div class="col-md-4">
				<select name="intellikit9monthssubscrboxno" id="intellikit9monthssubscrboxno"  class="form-control">
					<option value="">select</option>
					@for($i = 1; $i <= 9; $i++)
					<option value="{{$i}}{{'_9'}}" @if(!empty($subscriptionData) && count($subscriptionData) > 0 && $subscriptionData[0]->subscriptiontype == '9' && $subscriptionData[0]->subscriptionboxno == $i){{'selected'}}@endif>{{$i}}</option>
					@endfor
				</select>
			</div>
			<!-- <div class="col-md-2">
				<label for="intellikit9monthsboxisactive"> <input type="checkbox" name="intellikit9monthsboxisactive" id="intellikit9monthsboxisactive" value="" /> IsActive</label>
			</div> -->
			<input type="hidden" name="intellikit9monthssubscrtype" id="intellikit9monthssubscrtype" value="9">
		</div>

		<div class="row form-group intellikitsubscbox">
			<div class="col-md-4">
				<span>Intellikit 12 Months Subscription Box No:</span>
			</div>
			<div class="col-md-4">
				<select name="intellikit12monthssubscrboxno" id="intellikit12monthssubscrboxno"  class="form-control">
					<option value="">select</option>
					@for($i = 1; $i <= 12; $i++)
					<option value="{{$i}}{{'_12'}}" @if(!empty($subscriptionData) && count($subscriptionData) > 0 && $subscriptionData[0]->subscriptiontype == '12' && $subscriptionData[0]->subscriptionboxno == $i){{'selected'}}@endif>{{$i}}</option>
					@endfor
				</select>
			</div>
			<!-- <div class="col-md-2">
				<label for="intellikit12monthsboxisactive"> <input type="checkbox" name="intellikit12monthsboxisactive" id="intellikit12monthsboxisactive" value="" /> IsActive</label>
			</div> -->
			<input type="hidden" name="intellikit12monthssubscrtype" id="intellikit12monthssubscrtype" value="12">
		</div>

		<div class="row form-group">
			<div class="col-md-4">
				<span>EmailTemplateID:</span> <span class="text-danger">*</span>
			</div>
			<div class="col-md-4">
				<input type="number" name="emailtemplateid" id="emailtemplateid" value="@if(!empty($cashBackData)&&!empty($cashBackData->EmailTemplateID)){{$cashBackData->EmailTemplateID}}@endif" class="form-control" />
			</div>
		</div>

		<div class="row form-group cashstartenddates">
			<div class="col-md-4">
				<span>Cashback StartDate:</span> <span class="text-danger">*</span>
			</div>
			<div class="col-md-4">
				<input type="date" name="cashstartdate" id="cashstartdate" value="@if(!empty($cashBackData)&&!empty($cashBackData->CashBackStartDate)){{date('Y-m-d',strtotime($cashBackData->CashBackStartDate))}}@endif" class="form-control" />
			</div>
			<div class="col-md-2">
				<span>Time:</span> 
				<select name="cashstarttimehr" id="cashstarttimehr">
					@for($i = 0; $i < 60; $i++)
					<option value="@if($i < 10){{0}}{{$i}}@else{{$i}}@endif" @if(!empty($cashBackData)&&!empty($cashBackData->CashBackStartDate) && (date('H',strtotime($cashBackData->CashBackStartDate)) == $i) ){{'selected'}}@endif>@if($i < 10){{'0'}}{{$i}}@else{{$i}}@endif</option>
					@endfor
				</select>
				<select name="cashstarttimemins" id="cashstarttimemins">
					@for($i = 0; $i < 60; $i++)
					<option value="@if($i < 10){{0}}{{$i}}@else{{$i}}@endif" @if(!empty($cashBackData)&&!empty($cashBackData->CashBackStartDate) && (date('i',strtotime($cashBackData->CashBackStartDate)) == $i) ){{'selected'}}@endif>@if($i < 10){{'0'}}{{$i}}@else{{$i}}@endif</option>
					@endfor
				</select>
			</div>
		</div>

		<!-- <div class="row form-group product">
			<div class="col-md-4">
				<span>Cashback Start Time:</span>
			</div>
			
			<div class="col-md-4">
				<select name="cashproductstarttimehr" id="cashproductstarttimehr">
					@for($i = 0; $i < 60; $i++)
					<option value="@if($i < 10){{0}}{{$i}}@else{{$i}}@endif">@if($i < 10){{'0'}}{{$i}}@else{{$i}}@endif</option>
					@endfor
				</select>
				<select name="cashproductsstarttimemins" id="cashproductsstarttimemins">
					@for($i = 0; $i < 60; $i++)
					<option value="@if($i < 10){{0}}{{$i}}@else{{$i}}@endif">@if($i < 10){{'0'}}{{$i}}@else{{$i}}@endif</option>
					@endfor
				</select>
			</div>
		</div> -->


		<div class="row form-group cashstartenddates">
			<div class="col-md-4">
				<span>Cashback EndDate:</span> <span class="text-danger">*</span>
			</div>
			<div class="col-md-4">
				<input type="date" name="cashenddate" id="cashenddate" value="@if(!empty($cashBackData)&&!empty($cashBackData->CashBackEndDate)){{date('Y-m-d',strtotime($cashBackData->CashBackEndDate))}}@endif" class="form-control" />
			</div>
			<div class="col-md-2">
				<span>Time:</span> 
				<select name="cashendtimehr" id="cashendtimehr">
					@for($i = 0; $i < 60; $i++)
					<option value="@if($i < 10){{0}}{{$i}}@else{{$i}}@endif" @if(!empty($cashBackData)&&!empty($cashBackData->CashBackEndDate) && (date('H',strtotime($cashBackData->CashBackEndDate)) == $i) ){{'selected'}}@endif>@if($i < 10){{'0'}}{{$i}}@else{{$i}}@endif</option>
					@endfor
				</select>
				<select name="cashendtimemins" id="cashendtimehrmins">
					@for($i = 0; $i < 60; $i++)
					<option value="@if($i < 10){{0}}{{$i}}@else{{$i}}@endif" @if(!empty($cashBackData)&&!empty($cashBackData->CashBackEndDate) && (date('i',strtotime($cashBackData->CashBackEndDate)) == $i) ){{'selected'}}@endif>@if($i < 10){{'0'}}{{$i}}@else{{$i}}@endif</option>
					@endfor
				</select>
			</div>
		</div>

        <!-- <div class="row form-group product">
			<div class="col-md-4">
				<span>Cashback End Time:</span>
			</div>
			
			<div class="col-md-4">
				<select name="cashproductsendtimehr" id="cashproductsendtimehr">
					@for($i = 0; $i < 60; $i++)
					<option value="@if($i < 10){{0}}{{$i}}@else{{$i}}@endif">@if($i < 10){{'0'}}{{$i}}@else{{$i}}@endif</option>
					@endfor
				</select>
				<select name="cashproductsendtimemins" id="cashproductsendtimemins">
					@for($i = 0; $i < 60; $i++)
					<option value="@if($i < 10){{0}}{{$i}}@else{{$i}}@endif">@if($i < 10){{'0'}}{{$i}}@else{{$i}}@endif</option>
					@endfor
				</select>
			</div>
		</div> -->

		<div class="row form-group product">
			<div class="col-md-4">
				<span>Product IDs:</span> <span class="text-danger">*</span>
			</div>
			<div class="col-md-4">
				<input type="text" name="productids" id="productids" value="@if(!empty($cashBackData)&&!empty($cashBackData->ProductIDs) ){{$cashBackData->ProductIDs}}@endif" class="form-control" />
			</div>
		</div>

		<div class="row form-group">
			<div class="col-md-4">
				<label for="isactive"> <input type="checkbox" name="isactive" id="isactive" value="1" @if(!empty($cashBackData)&&!empty($cashBackData->IsActive) ){{'checked'}}@endif> IsActive <span class="text-danger">*</span></label>
			</div>
			
		</div>

		<div class="row form-group">
			<div class="col-md-4">
				<span>CreatedBy:</span>
			</div>
			<div class="col-md-4">
				<span>@if(!empty($cashBackData)&&!empty($cashBackData->CreatedBy) ){{$cashBackData->CreatedBy}}@else {{$user->username}} @endif</span>
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-4">
				<span>Created Date:</span>
			</div>
			<div class="col-md-4">
				<span>@if(!empty($cashBackData)&&!empty($cashBackData->CreatedDate) ){{$cashBackData->CreatedDate}}@else {{date('Y-m-d H:i:s')}} @endif</span>
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-4">
				<span>ModifiedBy:</span>
			</div>
			<div class="col-md-4">
				<span>@if(!empty($cashBackData)&&!empty($cashBackData->LastModifiedBy) ){{$cashBackData->LastModifiedBy}}@else {{$user->username}} @endif</span>
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-4">
				<span>Modified Date:</span>
			</div>
			<div class="col-md-4">
				<span>@if(!empty($cashBackData)&&!empty($cashBackData->LastModifiedDate) ){{$cashBackData->LastModifiedDate}}@else {{date('Y-m-d H:i:s')}} @endif</span>
			</div>
		</div>
		<div class="row form-group text-center">
			<div class="col-md-12">
				<input type="submit" value="Save Details" class="btn btn-primary btn-lg" />
				<a href="{{route('listcashback')}}" class="btn btn-success btn-lg" >Search</a>
			</div>
		</div>
	</form>
</div>
</div>
</div>
</main>
</div>
<script type="text/javascript" src="{{ asset('js/custom.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/formValidations.js')}}"></script>
</body>
</html>