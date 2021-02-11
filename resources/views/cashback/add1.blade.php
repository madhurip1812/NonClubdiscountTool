@extends('layouts.app')

@section('content')
<!-- <div class="main-content">
    <div class="container-fluid"> -->
<div class="panel panel-headline">
    <div class="panel-heading">
        <h3 class="panel-title">Add Cashabck</h3>
    </div>
    <div class="panel-body">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif
		<form name="addcashback" id="addcashback" action="{{route('addcashback')}}" method="POST">
			@csrf
		<div class="row">
			<div class="col-md-12">
				<div class="input-group" style="box-shadow: none;">
				<span>Rule For: <span class="text-danger">*</span> </span> &nbsp;&nbsp;&nbsp;
				    <label for="rulefor2"> <input type="radio" name="rulefor" id="rulefor2" value="intellikit" checked> Intellikit</label>&nbsp;&nbsp;&nbsp;
					<label for="rulefor1"> <input type="radio" name="rulefor" id="rulefor1" value="time"> Product/Time</label><!-- &nbsp;&nbsp;&nbsp;
					<label for="rulefor3"> <input type="radio" name="rulefor" id="rulefor3" value="3"> TimeBased</label> -->
				</div>
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-4">
				<span>Rule Name:</span> <span class="text-danger">*</span>
			</div>
			<div class="col-md-4">
				<input type="text" name="rulename" id="rulename" value="" class="form-control" />
			</div>
		</div>

        <div class="row form-group">
			<div class="col-md-4">
				<span>Cashback Coupon:</span> <span class="text-danger">*</span>
			</div>
			<div class="col-md-4">
				<input type="text" name="cashcoupon" id="cashcoupon" value="" class="form-control" />
			</div>
		</div>

		<div class="row form-group">
			<div class="col-md-4">
				<span>Cashback On Coupon:</span> <span class="text-danger">*</span>
			</div>
			<div class="col-md-4">
				<input type="text" name="cashoncoupon" id="cashoncoupon" value="" class="form-control" />
			</div>
		</div>

		<div class="row form-group">
			<div class="col-md-4">
				<span>Cashback Out Coupon:</span> <span class="text-danger">*</span>
			</div>
			<div class="col-md-4">
				<input type="text" name="cashoutcoupon" id="cashoutcoupon" value="" class="form-control" />
			</div>
		</div>

		<div class="row form-group">
			<div class="col-md-4">
				<span>Cashback Validity Days:</span> <span class="text-danger">*</span>
			</div>
			<div class="col-md-4">
				<input type="number" name="cashvaliddays" id="cashvaliddays" value="" class="form-control" />
			</div>
		</div>

		<div class="row form-group">
			<div class="col-md-4">
				<span>Cashback Percentage:</span> <span class="text-danger">*</span>
			</div>
			<div class="col-md-4">
				<input type="text" name="cashperc" id="cashperc" value="" class="form-control" />
			</div>
		</div>

		<div class="row form-group">
			<div class="col-md-4">
				<span>Cashback MaxAmount:</span> <span class="text-danger">*</span>
			</div>
			<div class="col-md-4">
				<input type="text" name="cashmaxamnt" id="cashmaxamnt" value="" class="form-control" />
			</div>
		</div>

		<div class="row form-group">
			<div class="col-md-4">
				<span>Cashback Min Purchase:</span> <span class="text-danger">*</span>
			</div>
			<div class="col-md-4">
				<input type="text" name="cashminpurc" id="cashminpurc" value="" class="form-control" />
			</div>
		</div>

		<div class="row form-group intellikitsubscbox">
			<div class="col-md-4">
				<span>Intellikit 3 Months Subscription Box No:</span> <span class="text-danger">*</span>
			</div>
			<div class="col-md-4">
				<select name="intellikit3monthssubscrboxno" id="intellikit3monthssubscrboxno" class="form-control">
					<option value="">select</option>
					@for($i = 1; $i <= 3; $i++)
					<option value="{{$i}}">{{$i}}</option>
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
				<span>Intellikit 6 Months Subscription Box No:</span> <span class="text-danger">*</span>
			</div>
			<div class="col-md-4">
				<select name="intellikit6monthssubscrboxno" id="intellikit6monthssubscrboxno"  class="form-control">
					<option value="">select</option>
					@for($i = 1; $i <= 6; $i++)
					<option value="{{$i}}">{{$i}}</option>
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
				<span>Intellikit 9 Months Subscription Box No:</span> <span class="text-danger">*</span>
			</div>
			<div class="col-md-4">
				<select name="intellikit9monthssubscrboxno" id="intellikit9monthssubscrboxno"  class="form-control">
					<option value="">select</option>
					@for($i = 1; $i <= 9; $i++)
					<option value="{{$i}}">{{$i}}</option>
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
				<span>Intellikit 12 Months Subscription Box No:</span> <span class="text-danger">*</span>
			</div>
			<div class="col-md-4">
				<select name="intellikit12monthssubscrboxno" id="intellikit12monthssubscrboxno"  class="form-control">
					<option value="">select</option>
					@for($i = 1; $i <= 12; $i++)
					<option value="{{$i}}">{{$i}}</option>
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
				<input type="number" name="emailtemplateid" id="emailtemplateid" value="" class="form-control" />
			</div>
		</div>

		<div class="row form-group">
			<div class="col-md-4">
				<span>Cashback StartDate:</span> <span class="text-danger">*</span>
			</div>
			<div class="col-md-4">
				<input type="date" name="cashstartdate" id="cashstartdate" value="" class="form-control" />
			</div>
			<div class="col-md-2">
				<span>Time:</span> 
				<select name="cashstarttimehr" id="cashstarttimehr">
					@for($i = 0; $i < 60; $i++)
					<option value="@if($i < 10){{0}}{{$i}}@else{{$i}}@endif">@if($i < 10){{'0'}}{{$i}}@else{{$i}}@endif</option>
					@endfor
				</select>
				<select name="cashstarttimemins" id="cashstarttimemins">
					@for($i = 0; $i < 60; $i++)
					<option value="@if($i < 10){{0}}{{$i}}@else{{$i}}@endif">@if($i < 10){{'0'}}{{$i}}@else{{$i}}@endif</option>
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


		<div class="row form-group">
			<div class="col-md-4">
				<span>Cashback EndDate:</span> <span class="text-danger">*</span>
			</div>
			<div class="col-md-4">
				<input type="date" name="cashenddate" id="cashenddate" value="" class="form-control" />
			</div>
			<div class="col-md-2">
				<span>Time:</span> 
				<select name="cashendtimehr" id="cashendtimehr">
					@for($i = 0; $i < 60; $i++)
					<option value="@if($i < 10){{0}}{{$i}}@else{{$i}}@endif">@if($i < 10){{'0'}}{{$i}}@else{{$i}}@endif</option>
					@endfor
				</select>
				<select name="cashendtimemins" id="cashendtimehrmins">
					@for($i = 0; $i < 60; $i++)
					<option value="@if($i < 10){{0}}{{$i}}@else{{$i}}@endif">@if($i < 10){{'0'}}{{$i}}@else{{$i}}@endif</option>
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
				<input type="text" name="productids" id="productids" value="" class="form-control" />
			</div>
		</div>

		<div class="row form-group">
			<div class="col-md-4">
				<label for="isactive"> <input type="checkbox" name="isactive" id="isactive" value="1"> IsActive <span class="text-danger">*</span></label>
			</div>
			
		</div>

		<div class="row form-group">
			<div class="col-md-4">
				<span>CreatedBy:</span>
			</div>
			<div class="col-md-4">
				<span>{{session('username')}}</span>
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-4">
				<span>Created Date:</span>
			</div>
			<div class="col-md-4">
				<span>{{date('Y-m-d H:i:s')}}</span>
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-4">
				<span>ModifiedBy:</span>
			</div>
			<div class="col-md-4">
				<span>{{session('username')}}</span>
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-4">
				<span>Modified Date:</span>
			</div>
			<div class="col-md-4">
				<span>{{date('Y-m-d H:i:s')}}</span>
			</div>
		</div>
		<div class="row form-group text-center">
			<div class="col-md-12">
				<input type="submit" value="Save Details" class="btn btn-primary btn-lg" />
			</div>
		</div>
		</form>
 </div>
</div>
<!--     </div>
</div> -->
@endsection