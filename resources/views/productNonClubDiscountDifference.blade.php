@extends('layouts.app')
@section('header')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
@endsection
@section('content')
@php($fromNo = ($productNonClubDiscountDifference->currentPage() - 1) * $productNonClubDiscountDifference->perPage() +1)
@php($toNo = $fromNo - 1 + $productNonClubDiscountDifference->count())
    <div class="col-md-12 " >
            <div class="card">
                <div class="card-header">
                    <label class="mt-2 mb-0"><h4>Non Club Discount Difference Conditions</h4></label>
                    <div class="float-right"> 
                        <a class="btn btn-dark" type="button" href="{{url('editAllDiscountRules?product=true')}}"> 
                            Choose Rule to edit
                        </a> 
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                        <table class="table" id="productRuleTable">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" class="cls-prod-column">Product ID</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Non CLub Discount Difference</th>
                                    <th scope="col">Non Club Discount Difference Type</th>
                                    <th scope="col" class="cls-lmdate-column">Last Modified Date</th>
                                    <th scope="col">Last Modified By</th>
                                </tr>
                            </thead>
                            <tbody>
                            	@foreach($productNonClubDiscountDifference as $key => $value)
                                <tr id="{{$value->productid}}">
                                    <td>{{$value->productid}}</td>
                                    <td>{{$value->product->productname ?? ''}}</td>
                                    <td>{{$value->nonclubdiscountdifference}}</td>
                                    <td>{{$value->nonclubdiscountdifferencetype}}</td>
                                    <td>{{$value->lastmodifieddate ? date('d/m/Y',strtotime($value->lastmodifieddate)) : ''}}</td>
                                    <td>{{$value->lastmodifiedby}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row pt-1"> 
                            <div class="col-md-5 float-left font-weight-bold">
                                Showing {{$fromNo}} to {{$toNo}} of {{$productNonClubDiscountDifference->total()}} entries
                            </div>
                            <div class="col-md-7">
                                <div class="pull-right">
                                    {!! $productNonClubDiscountDifference->appends(Request::all())->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection
@section('footer')
<script type="text/javascript">
    $('#productRuleTable').DataTable({
        "paging": false,
        "info": false,
    });
</script>
@endsection
